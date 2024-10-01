<?php
namespace Drupal\my_services_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Messenger\MessengerInterface;

class AlertsController extends ControllerBase {

  protected $messenger;

  // Inject the Messenger service via the constructor.
  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  // Static create method for dependency injection.
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger')
    );
  }

  // Method to demonstrate three types of alert messages.
  public function alertsDemo() {
    // Generate a status message.
    $this->messenger->addStatus($this->t('This is a status message.'));
    
    // Generate a warning message.
    $this->messenger->addWarning($this->t('This is a warning message.'));
    
    // Generate an error message.
    $this->messenger->addError($this->t('This is an error message.'));
    
    // Return a renderable array for page content.
    return [
      '#markup' => $this->t('This is the page content.'),
    ];
  }
}
