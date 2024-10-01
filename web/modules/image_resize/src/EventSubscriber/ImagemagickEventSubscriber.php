<?php

namespace Drupal\image_resize\EventSubscriber;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\imagemagick\Event\ImagemagickExecutionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Imagemagick Event Subscriber.
 */
class ImagemagickEventSubscriber implements EventSubscriberInterface {

  /**
   * Flag whether images is being resized and quality should be adjusted.
   *
   * @var bool
   */
  protected bool $isResizing = FALSE;

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected ConfigFactoryInterface $configFactory;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Set if currently resizing an image.
   *
   * @param bool $isResizing
   *   Whether an image is being resized.
   */
  public function setIsResizing(bool $isResizing): void {
    $this->isResizing = $isResizing;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      // Run before the default event subscriber of imagemagick so that
      // the quality can be customized. String instead of class constant
      // is used to avoid a hard dependency.
      'imagemagick.convert.preExecute' => ['preConvertExecute', 100],
    ];
  }

  /**
   * Fires before the 'convert' command is executed.
   *
   * @param \Drupal\imagemagick\Event\ImagemagickExecutionEvent $event
   *   Imagemagick execution event.
   */
  public function preConvertExecute(ImagemagickExecutionEvent $event) {
    $arguments = $event->getExecArguments();

    // Change image quality.
    if ($this->isResizing && $quality = $this->configFactory->get('image_resize.settings')->get('quality')) {
      $arguments->add('-quality ' . $quality);
    }
  }

}
