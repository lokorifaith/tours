<?php

namespace Drupal\my_block_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "my_block_demo_hello_block",
 *   admin_label = @Translation("Hello Block"),
 * )
 */
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t("Hello world, I'm a block."),
    ];
  }

}
