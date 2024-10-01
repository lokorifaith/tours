<?php

namespace Drupal\my_block_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Provides a 'Date' Block.
 *
 * @Block(
 *   id = "my_block_demo_date_block",
 *   admin_label = @Translation("Date Block"),
 * )
 */
class DateBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Get the current date and time.
    $date = new DrupalDateTime();

    // Format the date to include the day, week number, year, and time.
    $formatted_date = $date->format('l \o\f \w\e\e\k W \o\f Y');
    $formatted_time = $date->format('H:i:s');

    // Return the block content.
    return [
      '#markup' => $this->t('Hi, today is @date. The time is @time.', [
        '@date' => $formatted_date,
        '@time' => $formatted_time,
      ]),
    ];
  }

}
