<?php

namespace Drupal\my_form_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ColourController.
 *
 * Handles displaying content based on the favourite colour.
 */
class ColourController extends ControllerBase {

  /**
   * Returns content for the /colour/{favourite_colour} path.
   *
   * @param string $favourite_colour
   *   The favourite colour from the URL.
   *
   * @return array
   *   A render array.
   */
  public function content($favourite_colour) {
    return [
      '#markup' => $this->t('Your favourite colour is: @favourite_colour', ['@favourite_colour' => $favourite_colour]),
    ];
  }

}
