<?php

namespace Auth\Form;

use Laminas\Form\Element\Email;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct('login_form');
        $this->add([
            'name' => 'email',
            'type' => Email::class,
            'options' => ['label' => 'Email'],
            'attributes' => ['required' => true]
        ]);
        $this->add([
            'name' => 'password',
            'type' => Password::class,
            'options' => ['label' => 'Password'],
            'attributes' => ['required' => true]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => ['value' => 'Register']
        ]);

        $input_filter = new InputFilter();
        $input_filter->add([
            'name' => 'email',
            'required' => true,
            'validators' => [['name' => 'EmailAddress']]
        ]);
        $input_filter->add([
            'name' => 'password',
            'required' => true,
            'validators' => [['name' => 'StringLength', 'options' => ['min' => 8]]]
        ]);
        $this->setInputFilter($input_filter);
    }
}