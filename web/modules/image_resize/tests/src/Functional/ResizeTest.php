<?php

namespace Drupal\Tests\image_resize\Functional;

use Drupal\file\Entity\File;
use Drupal\media\Entity\Media;
use Drupal\media\Entity\MediaType;
use Drupal\Tests\BrowserTestBase;
use Drupal\Tests\TestFileCreationTrait;

/**
 * Tests the UI and queue plugin.
 *
 * @group image_resize
 */
class ResizeTest extends BrowserTestBase {

  use TestFileCreationTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['image_resize', 'media'];

  /**
   * Default theme.
   *
   * @var string
   */
  protected $defaultTheme = 'stark';

  /**
   * Created test file entities.
   *
   * @var \Drupal\file\FileInterface
   */
  protected array $files;

  /**
   * Created test media entities.
   *
   * @var \Drupal\media\MediaInterface
   */
  protected array $medias;

  /**
   * Name of the string field.
   *
   * @var string
   */
  protected string $sourceFieldName;

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    parent::setUp();

    $media_type = MediaType::create([
      'id' => 'image',
      'label' => 'Image',
      'source' => 'image',
    ]);
    $media_type->save();

    // Create the source field.
    $source_field = $media_type->getSource()->createSourceField($media_type);
    $source_field->getFieldStorageDefinition()->save();
    $source_field->save();
    $this->sourceFieldName = $source_field->getName();
    $media_type
      ->set('source_configuration', [
        'source_field' => $source_field->getName(),
      ])
      ->save();

    foreach ($this->getTestFiles('image') as $image) {
      $this->files[$image->uri] = File::create([
        'uri' => $image->uri,
      ]);
      $this->files[$image->uri]->save();

      $this->medias[$image->uri] = Media::create([
        'bundle' => 'image',
        $source_field->getName() => $this->files[$image->uri],
      ]);
      $this->medias[$image->uri]->save();
    }
  }

  /**
   * Tests the UI and resize queue.
   */
  public function testResizeQueue() {
    $admin = $this->drupalCreateUser(['administer site configuration']);
    $this->drupalLogin($admin);

    $this->drupalGet('admin/config/media/image-resizer');
    $this->assertSession()->pageTextNotContains('Resize queue');
    $this->assertSession()->elementNotExists('css', '.form-item-queue-count');
    $this->assertQualityField();

    $edit = [
      'mimetypes[image/jpeg]' => TRUE,
      'resize_type' => 'min',
      // Filter for images so that only one will be matched (image-test.jpg, 1901 byte).
      'min_filesize' => 1900,
      // Set a size that will resize most of the test images.
      'width' => 10,
      'height' => 10,
    ];
    $this->saveConfiguration($edit);
    $this->assertSession()->pageTextContains('The configuration options have been saved. To apply the new settings to existing images, they need to be requeued.');

    // Now the resize queue elements should be displayed.
    $this->assertSession()->pageTextContains('Resize queue');
    $this->assertSession()->elementTextContains('css', '.form-item-queue-count', '0');

    // Now requeue.
    $this->submitForm([], 'Requeue existing images');
    $this->assertSession()->elementTextContains('css', '.form-item-queue-count', '1');

    \Drupal::service('cron')->run();

    $this->drupalGet('admin/config/media/image-resizer');
    $this->assertSession()->elementTextContains('css', '.form-item-queue-count', '0');

    // Reload the file and media and check them.
    $file = File::load($this->files['public://image-test.jpg']->id());
    $image = \Drupal::service('image.factory')->get($file->getFileUri());

    $this->assertTrue($image->isValid());
    $this->assertEquals(20, $image->getWidth());
    $this->assertEquals(10, $image->getHeight());

    $media = Media::load($this->medias['public://image-test.jpg']->id());
    $this->assertEquals(20, $media->get('thumbnail')->width);
    $this->assertEquals(10, $media->get('thumbnail')->height);
    $this->assertEquals(20, $media->get($this->sourceFieldName)->width);
    $this->assertEquals(10, $media->get($this->sourceFieldName)->height);
  }

  /**
   * Test resizing with an extension change.
   */
  public function testResizeWebp() {
    $admin = $this->drupalCreateUser(['administer site configuration']);
    $this->drupalLogin($admin);

    $this->drupalGet('admin/config/media/image-resizer');

    $edit = [
      'mimetypes[image/jpeg]' => TRUE,
      // Set a size that will resize most of the test images.
      'width' => 20,
      'height' => 20,
      'extension' => 'webp',
    ];
    $this->saveConfiguration($edit);
    $this->assertSession()->pageTextContains('The configuration options have been saved. To apply the new settings to existing images, they need to be requeued.');

    // Now requeue.
    $this->submitForm([], 'Requeue existing images');
    $this->assertSession()->elementTextContains('css', '.form-item-queue-count', '3');

    \Drupal::service('cron')->run();

    // Reload the file and media and check them.
    $file = File::load($this->files['public://image-test.jpg']->id());
    $image = \Drupal::service('image.factory')->get($file->getFileUri());

    $this->assertTrue($image->isValid());
    $this->assertEquals('image-test.webp', $file->getFilename());
    $this->assertEquals('image/webp', $file->getMimeType());
    $this->assertEquals(20, $image->getWidth());
    $this->assertEquals(10, $image->getHeight());

    $media = Media::load($this->medias['public://image-test.jpg']->id());
    $this->assertEquals(20, $media->get('thumbnail')->width);
    $this->assertEquals(10, $media->get('thumbnail')->height);
    $this->assertEquals(20, $media->get($this->sourceFieldName)->width);
    $this->assertEquals(10, $media->get($this->sourceFieldName)->height);

    $file = File::load($this->files['public://image-2.jpg']->id());
    $image = \Drupal::service('image.factory')->get($file->getFileUri());

    $this->assertTrue($image->isValid());
    $this->assertEquals('image-2.webp', $file->getFilename());
    $this->assertEquals('image/webp', $file->getMimeType());
    $this->assertEquals(20, $image->getWidth());
    $this->assertEquals(15, $image->getHeight());
  }

  /**
   * Assert the quality field.
   */
  public function assertQualityField() {
    $this->assertSession()->fieldDisabled('quality');
  }

  /**
   * Save configuration.
   */
  public function saveConfiguration(array $edit): void {
    $this->submitForm($edit, 'Save configuration');
  }

}
