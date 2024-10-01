<?php

namespace Drupal\my_form_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Christmas Dinner Subscription form.
 */
class ChristmasDinnerForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'christmas_dinner_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // First name field.
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First name'),
      '#required' => TRUE,
    ];

    // Last name field.
    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last name'),
      '#required' => TRUE,
    ];

    // Number of guests field (select list).
    $form['number_of_guests'] = [
      '#type' => 'select',
      '#title' => $this->t('Number of guests'),
      '#options' => array_combine(range(1, 10), range(1, 10)),
      '#default_value' => 1,
      '#description' => $this->t('Select the number of guests attending (1-10).'),
      '#required' => TRUE,
    ];

    // Number of meat/fish choices.
    $form['number_of_meat_choices'] = [
      '#type' => 'number',
      '#title' => $this->t('Number of meat/fish choices'),
      '#min' => 0,
      '#default_value' => 0,
      '#required' => TRUE,
      '#description' => $this->t('Enter the number of meat/fish choices.'),
    ];

    // Number of vegetarian choices.
    $form['number_of_vegetarian_choices'] = [
      '#type' => 'number',
      '#title' => $this->t('Number of vegetarian choices'),
      '#min' => 0,
      '#default_value' => 0,
      '#required' => TRUE,
      '#description' => $this->t('Enter the number of vegetarian choices.'),
    ];

    // Number of vegan choices.
    $form['number_of_vegan_choices'] = [
      '#type' => 'number',
      '#title' => $this->t('Number of vegan choices'),
      '#min' => 0,
      '#default_value' => 0,
      '#required' => TRUE,
      '#description' => $this->t('Enter the number of vegan choices.'),
    ];

    // Alcohol-free option.
    $form['alcohol_free'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Alcohol-free table'),
      '#description' => $this->t('Check this box if your table would like to be alcohol-free.'),
    ];

    // Submit button.
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve and log all form values.
    $values = $form_state->getValues();
    $this->messenger()->addMessage($this->t('Thank you, @first_name, for subscribing!', [
      '@first_name' => $values['first_name']
    ]));
    $this->messenger()->addMessage($this->t('You have registered @guests guests, with @meat meat/fish, @vegetarian vegetarian, and @vegan vegan choices.', [
      '@guests' => $values['number_of_guests'],
      '@meat' => $values['number_of_meat_choices'],
      '@vegetarian' => $values['number_of_vegetarian_choices'],
      '@vegan' => $values['number_of_vegan_choices']
    ]));
    if ($values['alcohol_free']) {
      $this->messenger()->addMessage($this->t('Your table will be alcohol-free.'));
    } else {
      $this->messenger()->addMessage($this->t('Your table will include alcohol options.'));
    }
  }

}
