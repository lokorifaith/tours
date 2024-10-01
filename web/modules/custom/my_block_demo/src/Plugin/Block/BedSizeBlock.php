<?php

namespace Drupal\my_block_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Bed Size' Block.
 *
 * @Block(
 *   id = "bed_size_block",
 *   admin_label = @Translation("Bed Size Block"),
 * )
 */
class BedSizeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Constructs a new BedSizeBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the block.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The current request stack.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, RequestStack $request_stack) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->requestStack = $request_stack;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('request_stack')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Get the current route.
    $current_path = $this->requestStack->getCurrentRequest()->getPathInfo();

    // Determine which bed size is being displayed based on the route.
    if (strpos($current_path, '/bed-size/small') !== FALSE) {
      $bed_size = 'Small';
    }
    elseif (strpos($current_path, '/bed-size/medium') !== FALSE) {
      $bed_size = 'Medium';
    }
    elseif (strpos($current_path, '/bed-size/large') !== FALSE) {
      $bed_size = 'Large';
    }
    else {
      $bed_size = 'Unknown';
    }

    // Return block content based on the route.
    return [
      '#markup' => $this->t('This is the @size bed.', ['@size' => $bed_size]),
    ];
  }
}
