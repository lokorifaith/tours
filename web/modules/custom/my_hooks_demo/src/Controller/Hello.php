<?php

namespace Drupal\my_hooks_demo\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase {

  public function hello() {
    return [
      '#markup' => $this->t('Hello from My Hooks Demo!'),
    ];
  }
}
