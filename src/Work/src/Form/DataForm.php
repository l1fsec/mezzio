<?php

declare(strict_types=1);

namespace Work\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

/*
  * 12/08/22 15:35:23
  --------------------------------------------------------------------------------
  TODO Rozsirit o vice form inputu 
  TODO @https://docs.laminas.dev/laminas-form/v3/element/element/
  TODO VISIT!
  --------------------------------------------------------------------------------
  
  * 15/08/22 08:36:23
   --------------------------------------------------------------------------------
    Textarea input <- zde je potreba pouzit Element\Textarea
   // ! Nefunuje textarea v DB, nezobrazuje znaky!
   --------------------------------------------------------------------------------
  
  * 15/08/22 08:07:44
   --------------------------------------------------------------------------------
    // ! Možná jsem to fixnul - odesílání formuláře s textarea musí být taky v proměnných v UsersTable.php
   --------------------------------------------------------------------------------
  
   * 15/08/22 10:46:50
   --------------------------------------------------------------------------------
  ? Nefunguje multi-checkbox, vyhazuje chybu Undefined index: column 
   --------------------------------------------------------------------------------
  
  * 15/08/22 13:35:00
   --------------------------------------------------------------------------------
   ? Nefunguje datetime input, vyhazuje chybu ve vygenerovaném fomruláři
   ? -> The input does not appear to be a valid date <-
   ! RESOLVE 
   --------------------------------------------------------------------------------
  
 */

class DataForm extends Form
{
    public function init()
    {
        parent::init();
        $this->setName('new_data');
        $this->setAttribute('method', 'post');

        // Pridavame fields - jmeno
        $this->add([
            'type' => Element\Text::class,
            'name' => 'name',
            'options' => [
                'label' => 'Jméno',

            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 10,
                'class' => 'form-control',
                'placeholder' => 'Zadejte jméno',
                'title' => 'Zadejte jméno',
            ],

        ]);

        // Prijmeni input
        $this->add([
            'type' => Element\Text::class,
            'name' => 'surname',
            'options' => [
                'label' => 'Přijmení',
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 10,
                'class' => 'form-control',
                'placeholder' => 'Zadejte přijmení',
                'title' => 'Zadejte přijmení',
            ],
        ]);

        // Email input
        $this->add([
            'type' => Element\Email::class,
            'name' => 'email',
            'options' => [
                'label' => 'Email',
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 30,
                'class' => 'form-control',
                'placeholder' => 'Zadejte email',
                'title' => 'Zadejte email',
            ]
        ]);

        // Password input
        $this->add([
            'type' => Element\Password::class,
            'name' => 'password',
            'options' => [
                'label' => 'Heslo',
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 30,
                'placeholder' => 'Zadejte heslo',
                'title' => 'Zadejte heslo',
                'class' => 'form-control',
            ]
        ]);

        // Konfirmace hesla - zde je potreba pouzit Element\Password
        $this->add([
            'type' => Element\Password::class,
            'name' => 'confirm_password',
            'options' => [
                'label' => 'Potvrďte heslo',
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 30,
                'placeholder' => 'Enter password confirm',
                'title' => 'Enter password confirm',
                'class' => 'form-control',
            ]
        ]);

        // Textarea input
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'textarea',
            'options' => [
                'label' => 'Něco o sobě...',
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 30,
                'placeholder' => 'Zadejte krátký text o sobě..',
                'title' => 'Zadejte text',
                'class' => 'form-control',
            ]
        ]);

        /**
         * $this->add([
         *   'type' => Element\MultiCheckbox::class,
         *    'name' => 'multi-checkbox',
         *    'options' => [
         *       'label' => 'Jakého pohlaví jste?',  // ! Tohle proste nejde...
         *     'value_options' => [
         *          '0' => 'Muž',
         *          '1' => 'Žena',
         *          '2' => 'Jiné',
         *      ]
         *  ],
         * ]);
         */

        //Radio button input


        /*   $this->add([
            'type' => Element\DateTimeLocal::class,
            'name' => 'datetime',
            'options' => [
                'label' => 'Datum a čas',
                'format' => 'Y-m-d\TH:i', // TODO @ https://numenta.com/resources/htm/htm-studio/date-time-formats/
            ],
                'attributes' => [
                'min' => '2010-01-01T00:00:00',
                'max' => '2020-01-01T00:00:00',
                'step' => '1',
                'class' => 'form-control',
            ]

        ]); */

        $this->add([
            'type' => Element\Radio::class,
            'name' => 'radio',
            'options' => [
                'label' => 'Jakého pohlaví jste?',
                'value_options' => [
                    '0' => 'Muž',
                    '1' => 'Žena',
                    '2' => 'Jiné',
                ]
            ],
            'attributes' => [
                'required' => true,
                'class' => 'form-control',
            ]
        ]);

        $this->add([
            'type' => Element\Range::class,
            'name' => 'range',
            'options' => [
                'label' => 'Minimum and Maximum Amount',
            ],
            'attributes' => [
                'min' => 0, // default minimum is 0
                'max' => 100, // default maximum is 100
                'step' => 1, // default interval is 1
            ]
        ]);


        // Submit button z elementu
        $this->add([
            'type' => Element\Submit::class,
            'name' => 'create_data',
            'attributes' => [
                'value' => 'Odeslat',
                'class' => 'btn btn-primary',
            ],
        ]);
    }
}
