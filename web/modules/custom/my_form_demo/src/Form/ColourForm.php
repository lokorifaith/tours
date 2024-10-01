<?php

namespace Drupal\my_form_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements a simple Colour form.
 */
class ColourForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'colour_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Adding a description to inform the user about allowed values.
    $form['colour'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Favourite Colour'),
      '#description' => $this->t('The colour must be red, green, or blue.'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the submitted colour value.
    $colour = $form_state->getValue('colour');

    // Define an array of allowed colours.
    $allowed_colours = ['red', 'green', 'blue'];

    // Check if the submitted colour is not in the allowed colours array.
    if (!in_array(strtolower($colour), $allowed_colours)) {
      // Set an error message on the 'colour' form element.
      $form_state->setErrorByName('colour', $this->t('The colour must be one of: red, green, or blue.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the submitted colour value.
    $colour = $form_state->getValue('colour');

    // Display a message with the favourite colour.
    $this->messenger()->addMessage($this->t('Your favourite colour is @colour.', ['@colour' => $colour]));

    // Redirect the user to the /colour/<favourite colour> path.
    $form_state->setRedirect(
      'my_form_demo.colour_page',
      ['favourite_colour' => $colour]
    );
  }

}
