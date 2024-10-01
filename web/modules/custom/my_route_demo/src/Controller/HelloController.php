<?php
namespace Drupal\my_route_demo\Controller;
use Drupal\Core\Controller\ControllerBase;
class HelloController extends ControllerBase {
 public function hello() {
   return [
     '#markup' => 'Hello. It is a fine day indeed!',
   ];
 }

 public function helloName($first_name, $last_name) {
  return [
    '#markup' => $this->t('Hello faith  lokori', [
      '@first_name' => $first_name,
      '@last_name' => $last_name,
    ]),
  ];
}

}