<?php

namespace Drupal\image_resize\Plugin\QueueWorker;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Image\ImageFactory;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Queue\QueueWorkerBase;
use Drupal\file\Entity\File;
use Drupal\file_mdm\FileMetadataManagerInterface;
use Drupal\image_resize\EventSubscriber\ImagemagickEventSubscriber;
use Drupal\image_resize\SizeCalculator;
use Drupal\imagemagick\Plugin\ImageToolkit\ImagemagickToolkit;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Process a queue of files to resize.
 *
 * @QueueWorker(
 *   id = "image_resize",
 *   title = @Translation("Image resizer"),
 *   cron = {"time" = 60}
 * )
 */
class ImageResize extends QueueWorkerBase implements ContainerFactoryPluginInterface {

  protected FileSystemInterface $fileSystem;

  protected ConfigFactoryInterface $configFactory;

  protected ImageFactory $imageFactory;

  protected ImagemagickEventSubscriber $imagemagickEventSubscriber;

  protected ?FileMetadataManagerInterface $fileMetadataManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $image_resize = new static($configuration, $plugin_id, $plugin_definition);
    $image_resize->fileSystem = $container->get('file_system');
    $image_resize->configFactory = $container->get('config.factory');
    $image_resize->imageFactory = $container->get('image.factory');
    $image_resize->imagemagickEventSubscriber = $container->get('image_resize.imagemagick_event_subscriber');
    if ($container->has('file_metadata_manager')) {
      $image_resize->fileMetadataManager = $container->get('file_metadata_manager');
    }

    return $image_resize;
  }

  /**
   * {@inheritdoc}
   */
  public function processItem($data) {

    $start = microtime(TRUE);

    /** @var \Drupal\file\FileInterface $file */
    $file = File::load($data);
    if (!$file) {
      return;
    }

    // Testing, if the file does not exist and image file proxy is enabled,
    // fetch it. if still doesn't exist afterward. end with an error.
    if (!file_exists($file->getFileUri()) && $this->configFactory->get('stage_file_proxy.settings')->get('origin')) {
      $remote_url =  $this->configFactory->get('stage_file_proxy.settings')->get('origin') . $file->createFileUrl();
      $contents = file_get_contents($remote_url);
      if ($contents) {

        $directory = dirname($file->getFileUri());
        $this->fileSystem->prepareDirectory($directory, FileSystemInterface::CREATE_DIRECTORY);
        file_put_contents($file->getFileUri(), $contents);
      }
    }

    if (!file_exists($file->getFileUri())) {
      \Drupal::logger('image_resize')->error('File @uri (ID @id) does not exist.', ['@id' => $file->id(), '@name' => $file->getFileUri()]);
      return;
    }

    $config = $this->configFactory->get('image_resize.settings');

    // Find file size based on referencing image field.
    $references = file_get_file_references($file, NULL, EntityStorageInterface::FIELD_LOAD_REVISION, 'image');
    $referencing_item = NULL;

    foreach ($references as $field_name => $field_references) {
      foreach ($field_references as $entity_references) {
        foreach ($entity_references as $referencing_entity) {
          foreach ($referencing_entity->get($field_name) as $item) {
            if ($item->target_id == $file->id()) {
              $referencing_item = $item;
              break 4;
            }
          }
        }
      }
    }

    $width = NULL;
    $height = NULL;
    $image = NULL;
    if ($referencing_item && $referencing_item->width && $referencing_item->height) {
      $width = $referencing_item->width;
      $height = $referencing_item->height;
    }
    else {
      // Fall back to detecting the image size from the file itself if no
      // reference was found.
      $image = $this->imageFactory->get($file->getFileUri());

      if ($image->isValid()) {
        $width = $image->getWidth();
        $height = $image->getHeight();
      }
    }

    if (!$width || !$height) {
      \Drupal::logger('image_resize')->error('Unable to detect width or height for image with ID @id', ['@id' => $file->id()]);
      return;
    }

    // Detect if a conversion is necessary.
    $convert = FALSE;
    $new_width = NULL;
    $new_height = NULL;
    if ($config->get('resize_type') && $config->get('width') && $config->get('height') && $new_size = SizeCalculator::resize($config->get('resize_type'), $width, $height, $config->get('width'), $config->get('height'))) {
      [$new_width, $new_height] = $new_size;
      $convert = TRUE;
    }
    if ($config->get('extension')) {
      $current_extension = pathinfo($file->getFileUri(), PATHINFO_EXTENSION);
      if ($config->get('extension') != $current_extension) {
        $convert = TRUE;
      }
    }

    if (!$convert) {
      // Nothing to do.
      return;
    }

    // Load the image if that hasn't happened yet.
    if (!$image) {
      $image = $this->imageFactory->get($file->getFileUri());
      if (!$image->isValid()) {
        \Drupal::logger('image_resize')->error('Image with ID @id is not a valid file', ['@id' => $file->id()]);
        return;
      }
    }

    // Scale the image to the defined aspect ratio.
    if ($new_width && $new_height) {
      $image->scale($new_width, $new_height);
    }

    $new_uri = NULL;
    if ($config->get('extension')) {
      $current_extension = pathinfo($file->getFileUri(), PATHINFO_EXTENSION);
      if ($config->get('extension') != $current_extension) {
        $image->convert($config->get('extension'));
        $new_uri = str_replace('.' . $current_extension, '.' . $config->get('extension'), $file->getFileUri());
      }
    }

    $this->imagemagickEventSubscriber->setIsResizing(TRUE);

    if (!$image->save($new_uri)) {
      \Drupal::logger('image_resize')->error('Failed to resize image ID @id', ['@id' => $file->id()]);
      return;
    }

    $this->imagemagickEventSubscriber->setIsResizing(FALSE);

    // Update the file entity. if the file URI changed, delete the old file and update the uri, name and
    // mime type.
    $old_name = $file->getFilename();
    if ($new_uri) {
      $this->fileSystem->delete($file->getFileUri());

      $file->setFileUri($new_uri);
      $file->setFilename(basename($new_uri));
      $guesser = \Drupal::service('file.mime_type.guesser');
      $file->setMimeType($guesser->guessMimeType($new_uri));
    }

    // Update the size.
    $original_size = $file->getSize();
    $file->setSize(filesize($file->getFileUri()));
    $file->save();

    // Reload the image to detect the new size.
    $image = $this->imageFactory->get($file->getFileUri());
    $image->isValid();
    $new_width = $image->getWidth();
    $new_height = $image->getHeight();

    // Update metadata on references, especially media entities typically have
    // two fields referencing it, avoid extra saves.
    $entities_to_save = [];
    foreach ($references as $field_name => $field_references) {
      foreach ($field_references as $entity_references) {
        /** @var \Drupal\Core\Entity\FieldableEntityInterface $referencing_entity */
        foreach ($entity_references as $referencing_entity) {
          foreach ($referencing_entity->get($field_name) as $item) {
            if ($item->target_id == $file->id() && $item->width != $width || $item->height != $new_height)  {
              $item->width = $new_width;
              $item->height = $new_height;
              $entities_to_save[$referencing_entity->getEntityTypeId() . ':' . $referencing_entity->id()] = $referencing_entity;
            }
          }
        }
      }
    }

    foreach ($entities_to_save as $entity_to_save) {
      $entity_to_save->save();
    }

    $end = microtime(TRUE);
    $diff = round($end - $start, 2);

    $arguments = [
      '@name' => $old_name,
      '@id' => $file->id(),
      '@new_name' => $file->getFilename(),
      '@original_size' => format_size($original_size),
      '@new_size' => format_size($file->getSize()),
      '@size_diff' => format_size($original_size - $file->getSize()),
      '@original_resolution' => $width . 'x' . $height,
      '@new_resolution' => $new_width . 'x' . $new_height,
      '@time' => $diff,
      '@updated_references_count' => count($entities_to_save),
    ];
    \Drupal::logger('image_resize')->notice('Image @name (ID @id, @original_size, @original_resolution) converted to @new_name (@new_size, @new_resolution) in @times, saved @size_diff and updated @updated_references_count referencing entities.', $arguments);
  }

}
