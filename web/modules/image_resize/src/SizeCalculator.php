<?php

namespace Drupal\image_resize;

class SizeCalculator {

  public static function resize(string $resize_type, int $current_width, int $current_height, int $max_width, int $max_height): ?array {

    // get the ratio between the current and max width.
    $width_ratio = $current_width / $max_width;
    $height_ratio = $current_height / $max_height;

    // If the resize type is max and at lesat one is above 1, it means the image is larger than the max size.
    if ($resize_type == 'max' && ($width_ratio > 1 || $height_ratio > 1)) {
      // Take the higher ratio and reduce the width and height accoringly.
      $max_ratio = max([$height_ratio, $width_ratio]);
      return [(int) round($current_width / $max_ratio), (int) round($current_height / $max_ratio)];
    }
    // For the min resize type,
    elseif ($resize_type == 'min' && $width_ratio > 1 && $height_ratio > 1) {
      // Take the lower ratio and reduce the width and height accoringly.
      $min_ratio = min([$height_ratio, $width_ratio]);
      return [(int) round($current_width / $min_ratio), (int) round($current_height / $min_ratio)];
    }

    return NULL;
  }

}
