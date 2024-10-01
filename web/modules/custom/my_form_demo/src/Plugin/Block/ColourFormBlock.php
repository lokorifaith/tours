<?php

namespace Drupal\my_form_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Colour Form' Block.
 *
 * @Block(
 *   id = "colour_form_block",
 *   admin_label = @Translation("Colour and Christmas Dinner Form Block"),
 * )
 */
class ColourFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Retrieve the ColourForm form.
    $colour_form = \Drupal::formBuilder()->getForm('\Drupal\my_form_demo\Form\ColourForm');

    // Retrieve the ChristmasDinnerForm form.
    $christmas_form = \Drupal::formBuilder()->getForm('\Drupal\my_form_demo\Form\ChristmasDinnerForm');

    // Combine both forms into a render array.
    $build = [
      'colour_form' => $colour_form,
      'christmas_form' => $christmas_form,
    ];

    return $build;
  }

}
