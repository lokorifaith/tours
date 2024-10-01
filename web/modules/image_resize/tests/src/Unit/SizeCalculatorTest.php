<?php

namespace Drupal\Tests\image_resize\Unit;

use Drupal\image_resize\SizeCalculator;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\image_resize\SizeCalculator
 * @group image_resize
 */
class SizeCalculatorTest extends UnitTestCase {

  /**
   * @covers ::resize
   * @dataProvider testResizeProvider
   */
  public function testResize(string $resize_type, int $current_width, int $current_height, int $max_width, int $max_height, ?array $expected_result) {
    $this->assertSame($expected_result, SizeCalculator::resize($resize_type, $current_width, $current_height, $max_width, $max_height));
  }

  /**
   * Data provider for ::testResize.
   */
  public static function testResizeProvider() {
    return [
      ['max', 8000, 7000, 4000, 4000, [4000, 3500]],
      ['max', 2000, 6000, 4000, 4000, [1333, 4000]],
      ['max', 4567, 3456, 4000, 4000, [4000, 3027]],
      ['max', 3500, 4000, 4000, 4000, NULL],
      ['min', 3999, 5000, 4000, 4000, NULL],
      ['min', 4500, 5000, 4000, 4000, [4000, 4444]],
      ['min', 6000, 8000, 4000, 4000, [4000, 5333]],
      ['min', 6000, 8000, 4000, 4000, [4000, 5333]],
      ['min', 6000, 8000, 4000, 4000, [4000, 5333]],
      ['min', 4441, 6697, 3000, 3000, [3000, 4524]],
    ];
  }

}
