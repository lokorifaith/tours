<?php
namespace Drupal\my_services_demo\Controller;
use Drupal\Core\Controller\ControllerBase;
class UserController extends ControllerBase {
    public function currentUserDemo() {
        // Get the current user object
        $current_user = \Drupal::currentUser();
        
        // Get the username of the current user
        $username = $current_user->getDisplayName();
        
        // Return a render array that prints "Hello, Jane"
        return [
          '#markup' => $this->t('Hello, @username', ['@username' => $username]),
        ];
      }

      public function currentUseremail() {
        // Get the current user object
        $current_user = \Drupal::currentUser();
        
        // Get the email of the current user
        $user_email = $current_user->getEmail();
        
        // Return a render array that prints "Hello, Jane, your email is jane@example.com"
        return [
          '#markup' => $this->t('Hello, @username, your email is @user_email', [
            '@username' => $current_user->getDisplayName(),
            '@user_email' => $user_email,
          ]),
        ];
      }
}