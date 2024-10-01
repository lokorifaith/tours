<?php

namespace Drupal\my_block_demo\Controller;

use Drupal\Core\Controller\ControllerBase;

class BedSizeController extends ControllerBase {

  /**
   * Display for small bed.
   */
  public function smallBed() {
    return [
      '#markup' => $this->t('This is the small bed size page.'),
    ];
  }

  /**
   * Display for medium bed.
   */
  public function mediumBed() {
    return [
      '#markup' => $this->t('This is the medium bed size page.'),
    ];
  }

  /**
   * Display for large bed.
   */
  public function largeBed() {
    return [
      '#markup' => $this->t('This is the large bed size page.'),
    ];
  }

  /**
   * Private method for getting the bed size image.
   * 
   * @param string $size
   *   The size of the bed (small, medium, large).
   *
   * @return string
   *   The URL of the image for the bed size.
   */
  private function getBedImage($size) {
    switch ($size) {
      case 'small':
        return '/images/bed-small.png';
      case 'medium':
        return '/images/bed-medium.png';
      case 'large':
        return '/images/bed-large.png';
      default:
        return '/images/bed-default.png';
    }
  }
}
