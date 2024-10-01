<?php

namespace Drupal\Tests\image_resize\Functional;

/**
 * Retest with imagemagick.
 *
 * @group image_resize
 */
class ResizeImagemagickTest extends ResizeTest {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['imagemagick'];

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    parent::setUp();

    // Change the toolkit.
    \Drupal::configFactory()->getEditable('system.image')
      ->set('toolkit', 'imagemagick')
      ->save();
  }

  /**
   * {@inheritdoc}
   */
  public function assertQualityField() {
    $this->assertSession()->fieldEnabled('quality');
  }

  /**
   * {@inheritdoc}
   */
  public function saveConfiguration(array $edit): void {
    $edit['quality'] = '99';
    $this->submitForm($edit, 'Save configuration');
  }

}
