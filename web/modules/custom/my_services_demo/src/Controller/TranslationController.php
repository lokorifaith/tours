<?php
namespace Drupal\my_services_demo\Controller;

use Drupal\Core\Controller\ControllerBase;

class TranslationController extends ControllerBase {

  // Method to demonstrate the use of t() placeholders.
  public function translationDemo() {
    // Create variables using different placeholders (@, %, and :).
    $msg1 = $this->t('Hello, @name!', ['@name' => 'Faith']);
    $msg2 = $this->t('%action is required for this task.', ['%action' => 'Translation']);
    $msg3 = $this->t(':item has been successfully processed.', [':item' => 'The file']);

    // Return a renderable array to print the messages on screen.
    return [
      '#markup' => $msg1 . '<br>' . $msg2 . '<br>' . $msg3,
    ];
  }
}
