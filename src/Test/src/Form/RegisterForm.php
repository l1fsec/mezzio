<?php

declare(strict_types=1);

namespace Test\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class RegisterForm extends Form
{
    public function init()
    {
        parent::init();
        $this->setName('new_account');
        $this->setAttribute('method', 'post');

        # Pridavame fields
        $this->add([
            'type' => Element\Text::class,
            'name' => 'firstname',
            'options' => [
                'label' => 'firstname',
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 10,
                'class' => 'form-control',
                'placeholder' => 'Enter firstname',
                'title' => 'Enter firstname',
            ],

        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'surname',
            'options' => [
                'label' => 'Surname',
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 10,
                'class' => 'form-control',
                'placeholder' => 'Enter surname',
                'title' => 'Enter surname',
            ],
        ]);
        $this->add([
            'type' => Element\Password::class,
            'name' => 'password',
            'options' => [
                'label' => 'Password',
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 30,
                'placeholder' => 'Enter password',
                'title' => 'Enter password',
                'class' => 'form-control',

            ]
        ]);
        $this->add([
            'type' => Element\Password::class,
            'name' => 'confirm_password',
            'options' => [
                'label' => 'Password confirm',
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 30,
                'placeholder' => 'Enter password confirm',
                'title' => 'Enter password confirm',
                'class' => 'form-control',
            ]
        ]);
        $this->add([
            'type' => Element\Submit::class,
            'name' => 'create_account',
            'attributes' => [
                'value' => 'Register',
                'class' => 'btn btn-primary',
            ],
        ]);
    }
}
