<?php

namespace Auth\Form;

use Laminas\Form\Element\Email;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;

class RegisterForm extends Form
{
    public function __construct()
    {
        parent::__construct('register_form');
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
            'name' => 'repeatPassword',
            'type' => Password::class,
            'options' => ['label' => 'Repeat Password'],
            'attributes' => ['required' => true]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => ['value' => 'Register']
        ]);
        $inputFilter = new InputFilter();
        $inputFilter->add([
            'name' => 'email',
            'required' => true,
            'validators' => [['name' => 'EmailAddress']]
        ]);
        $inputFilter->add([
            'name' => 'password',
            'required' => true,
            'validators' => [['name' => 'StringLength', 'options' => ['min' => 8]]]
        ]);
        $inputFilter->add([
            'name' => 'repeatPassword',
            'required' => true,
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => ['min' => 8]
                ],
                [
                    'name' => 'Identical',
                    'options' => [
                        'token' => 'password',
                        'message' => 'Passwords do not match!'
                    ]
                ]
            ]
        ]);
        $this->setInputFilter($inputFilter);
    }
}