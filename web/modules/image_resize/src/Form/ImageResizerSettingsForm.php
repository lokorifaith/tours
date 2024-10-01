<?php

namespace Drupal\image_resize\Form;

use Drupal\Component\Utility\Bytes;
use Drupal\Core\Batch\BatchBuilder;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Queue\QueueFactory;
use Drupal\file\Entity\File;
use Drupal\file\Plugin\Field\FieldType\FileItem;
use Drupal\imagemagick\Plugin\ImageToolkit\ImagemagickToolkit;
use Drupal\Tests\TestFileCreationTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Image resizer settings form.
 */
class ImageResizerSettingsForm extends ConfigFormBase {

  /**
   * The queue factory.
   *
   * @var \Drupal\Core\Queue\QueueFactory
   */
  protected QueueFactory $queueFactory;

  public static function create(ContainerInterface $container) {
    $form = parent::create($container);
    $form->queueFactory = $container->get('queue');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['image_resize.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'image_resize_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('image_resize.settings');

    $results = \Drupal::entityQueryAggregate('file')
      ->accessCheck(FALSE)
      ->aggregate('filemime', 'COUNT')
      ->aggregate('filesize', 'SUM')
      ->condition('filemime', 'image/', 'STARTS_WITH')
      ->groupBy('filemime')
      ->execute();

    $mimetype_options = [];
    foreach ($results as $result) {
      $mimetype_options[$result['filemime']] = [
        'mimetype' => $result['filemime'],
        'count' => $result['filemime_count'],
        'size' => format_size($result['filesize_sum']),
      ];
    }

    $form['selection_wrapper'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Selection settings'),
      '#description' => $this->t('The mime type numbers are the total amount of files, including those that may have been resized already or do not need to be resized.'),
    ];

    $form['selection_wrapper']['mimetypes'] = [
      '#type' => 'tableselect',
      '#header' => [
        'mimetype' => $this->t('Mimetype'),
        'count' => $this->t('Total count'),
        'size' => $this->t('Total file size'),
      ],
      '#options' => $mimetype_options,
      '#default_value' => array_combine($config->get('mimetypes'), $config->get('mimetypes')),
    ];

    // If there is a min filesize, enrich the table with that information.
    if ($config->get('min_filesize')) {
      $results = \Drupal::entityQueryAggregate('file')
        ->accessCheck(FALSE)
        ->aggregate('filemime', 'COUNT')
        ->aggregate('filesize', 'SUM')
        ->condition('filemime', 'image/', 'STARTS_WITH')
        ->condition('filesize', Bytes::toNumber($config->get('min_filesize')), '>')
        ->groupBy('filemime')
        ->execute();

      $form['selection_wrapper']['mimetypes']['#header']['large_count'] = $this->t('Count of large files');
      $form['selection_wrapper']['mimetypes']['#header']['large_size'] = $this->t('Total sum of large files');

      foreach ($results as $result) {
        $form['selection_wrapper']['mimetypes']['#options'][$result['filemime']]['large_count'] = $result['filemime_count'];
        $form['selection_wrapper']['mimetypes']['#options'][$result['filemime']]['large_size'] = format_size($result['filesize_sum']);
      }
    }

    $form['selection_wrapper']['min_filesize'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Minimum filesize'),
      '#default_value' => $config->get('min_filesize'),
      '#description' => $this->t('Only attempt to resize images above the given file size. Enter a value like "512" (bytes), "80 KB" (kilobytes) or "50 MB" (megabytes) in order to restrict the allowed file size.'),
      '#size' => 10,
      '#element_validate' => [[FileItem::class, 'validateMaxFilesize']],
    ];

    $form['resize_wrapper'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Resize settings'),
      '#description' => $this->t('Images will be converted if either the size is set and lower or a type is enforced and does not match the source type. Detecting the quality is not yet supported.'),
    ];

    $form['resize_wrapper']['resize_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Resize mode'),
      '#options' => [
        'min' => $this->t('Minimum size'),
        'max' => $this->t('Maximal size'),
      ],
      '#empty_option' => $this->t('- Do not resize -'),
      '#default_value' => $config->get('resize_type'),
      '#description' => $this->t('Defines how the width and height settings are applied. With minimum size, both width and height of the image will be at least the configured limits, with maximum size, both width and height of the image will be less than the configured limits.'),
    ];

    $form['resize_wrapper']['width'] = [
      '#type' => 'number',
      '#title' => $this->t('Width'),
      '#default_value' => $config->get('width'),
      '#description' => $this->t('Images will be resized if both the width and the height of the image are above the defined values, the aspect ratio will be kept and the shorter side will be reduced to the defined size.'),
      '#size' => 10,
      '#min' => 0,
    ];

    $form['resize_wrapper']['height'] = [
      '#type' => 'number',
      '#title' => $this->t('Height'),
      '#default_value' => $config->get('height'),
      '#size' => 10,
      '#min' => 0,
    ];

    $form['resize_wrapper']['size_threshold'] = [
      '#type' => 'number',
      '#title' => $this->t('Size threshold'),
      '#description' => $this->t('To avoid resizing images that are only minimally larger than the defined size, an amount of pixels can defined that is applied as a threshold. Only images larger than this threshold are resized. For example, a max width and height of 3000x3000px and a threshold of 50 will only resize images that are larger than 3050x3050, but if they are, they will be resized to 3000x3000.'),
      '#default_value' => $config->get('size_threshold'),
      '#size' => 10,
      '#min' => 0,
    ];

    /** @var \Drupal\Core\ImageToolkit\ImageToolkitInterface $toolkit */
    $toolkit = \Drupal::service('image.toolkit.manager')->getDefaultToolkit();
    $extensions = $toolkit->getSupportedExtensions();
    $form['resize_wrapper']['extension'] = [
      '#type' => 'select',
      '#title' => $this->t('Enforce image type'),
      '#options' => array_combine($extensions, $extensions),
      '#empty_option' => $this->t('- Keep existing type -'),
      '#default_value' => $config->get('extension'),
      '#description' => $this->t('If an image type is selected, the images will also be converted to the chosen type.'),
    ];

    $form['resize_wrapper']['quality'] = [
      '#type' => 'number',
      '#title' => $this->t('Override quality'),
      '#description' => $this->t('Customize the quality used when resizing and converting images. It is recommended to set this to a higher quality than the default quality as it is applied to the source image and is non-reversible. The quality varies depending on the image type as well.'),
      '#default_value' => $config->get('quality'),
    ];
    if (!$toolkit instanceof ImagemagickToolkit) {
      $form['resize_wrapper']['quality']['#disabled'] = TRUE;
      $form['resize_wrapper']['quality']['#description'] = $this->t('Only the imagemagick toolkit supports this setting, for others the default quality of the toolkit is used.');
    }

    if ($config->get('mimetypes')) {
      $form['queue_wrapper'] = [
        '#type' => 'fieldset',
        '#title' => $this->t('Resize queue'),
        '#description' => $this->t('Shows the current state of the resize queue and allows to requeue images if settings changed. A requeue process should not be started if there are still items in the queue. Settings must be saved before starting any queue operations.')
      ];
      $queue = $this->queueFactory->get('image_resize');
      $queue->createQueue();

      $form['queue_wrapper']['queue_count'] = [
        '#type' => 'item',
        '#title' => $this->t('Items in resize queue'),
        '#markup' => $queue->numberOfItems(),
      ];

      $form['queue_wrapper']['reprocess'] = [
        '#type' => 'submit',
        '#value' => $this->t('Requeue existing images'),
        '#submit' => ['::requeueSubmit'],
      ];
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = $this->config('image_resize.settings');
    $config->set('mimetypes', array_values(array_filter($form_state->getValue('mimetypes'))));
    $config->set('extension', $form_state->getValue('extension'));
    $config->set('resize_type', $form_state->getValue('resize_type'));
    $config->set('width', $form_state->getValue('width'));
    $config->set('height', $form_state->getValue('height'));
    $config->set('size_threshold', $form_state->getValue('size_threshold'));
    $config->set('quality', $form_state->getValue('quality'));
    $config->set('min_filesize', $form_state->getValue('min_filesize'));
    $config->save();

    $this->messenger()->addStatus($this->t('The configuration options have been saved. To apply the new settings to existing images, they need to be requeued.'));
  }

  /**
   * Requeue submit callback.
   */
  public function requeueSubmit(array &$form, FormStateInterface $form_state) {

    $batch_builder = (new BatchBuilder())
      ->setTitle($this->t('Requeue images...'))
      ->setFinishCallback([static::class, 'finishRequeueBatch'])
      ->setInitMessage($this->t('Initializing'))
      ->setProgressMessage($this->t('Requeued image @current of @total.'))
      ->setErrorMessage($this->t('Requeue has encountered an error.'))
      ->addOperation([static::class, 'requeueBatch']);

    batch_set($batch_builder->toArray());
  }

  /**
   * Batch operation callback to import a row.
   *
   * @param string $evn
   *   The EVN.
   * @param array $row
   *   The row to import.
   * @param array|object $context
   *   The batch context.
   */
  public static function requeueBatch(&$context) {

    $config = \Drupal::config('image_resize.settings');

    if (empty($context['sandbox'])) {
      $context['sandbox']['progress'] = 0;

      $query = \Drupal::entityQuery('file')
        ->accessCheck(FALSE)
        ->condition('filemime', $config->get('mimetypes'), 'IN');

      if ($config->get('min_filesize')) {
        $query->condition('filesize', Bytes::toNumber($config->get('min_filesize')), '>');
      }

      $context['sandbox']['total'] = $query->count()->execute();
    }

    $limit = 100;
    $query = \Drupal::entityQuery('file')
      ->accessCheck(FALSE)
      ->condition('filemime', $config->get('mimetypes'), 'IN')
      ->sort('filesize', 'DESC');

    if ($config->get('min_filesize')) {
      $query->condition('filesize', Bytes::toNumber($config->get('min_filesize')), '>');
    }
    $ids = $query->range($context['sandbox']['progress'], $limit)->execute();

    /** @var \Drupal\Core\Queue\QueueInterface $queue */
    $queue = \Drupal::service('queue')->get('image_resize');
    foreach ($ids as $id) {
      $queue->createItem($id);
      $context['sandbox']['progress']++;
    }
    $context['message'] = t('Requeued image @progress of @total.', ['@progress' => $context['sandbox']['progress'], '@total' => $context['sandbox']['total']]);
    if ($context['sandbox']['progress'] != $context['sandbox']['total']) {
      $context['finished'] = $context['sandbox']['progress'] / $context['sandbox']['total'];
    }
  }

  /**
   * Finish batch.
   *
   * @param bool $success
   *   Indicate that the batch API tasks were all completed successfully.
   * @param array $results
   *   An array of all the results that were updated in update_do_one().
   * @param array $operations
   *   A list of the operations that had not been completed by the batch API.
   */
  public static function finishRequeueBatch($success, $results, $operations) {
    \Drupal::messenger()->addMessage(t('Requeue completed.'));
  }


}
