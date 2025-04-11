<?php

namespace User\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;

class UserProfileForm extends Form
{
    public function __construct()
    {
        parent::__construct('user_form');

        foreach (['firstName', 'lastName', 'mobilePhone', 'country', 'city', 'address'] as $field) {
            $this->add([
                'name' => $field,
                'type' => Element\Text::class,
                'options' => ['label' => ucfirst($field)],
                'attributes' => ['required' => false],
            ]);
        }

        $this->add([
            'name' => 'email',
            'type' => Element\Email::class,
            'options' => ['label' => ucfirst('email')],
            'attributes' => ['required' => true],
        ]);

        $input_filter = new InputFilter();
        $input_filter->add([
            'name' => 'email',
            'required' => true,
            'validators' => [['name' => 'EmailAddress']]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Element\Submit::class,
            'options' => ['value' => 'Save'],
        ]);

        $this->setInputFilter($input_filter);
    }
}