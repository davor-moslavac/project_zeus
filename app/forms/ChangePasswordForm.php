<?php
namespace Vokuro\Forms;

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Password,
    Phalcon\Forms\Element\Submit,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Confirmation;

class ChangePasswordForm extends FormBase
{

    public function initialize()
    {
        // Password
        $password = new Password('password', ['class' => 'form-control']);

        $password->addValidators([
            new PresenceOf([
                'message' => 'Password is required'
            ]),
            new StringLength([
                'min' => 8,
                'messageMinimum' => 'Password is too short. Minimum 8 characters'
            ]),
            new Confirmation([
                'message' => 'Password doesn\'t match confirmation',
                'with' => 'confirmPassword'
            ])
        ]);

        $password->setLabel('Password');

        $this->add($password);

        // Confirm Password
        $confirmPassword = new Password('confirmPassword', ['class' => 'form-control']);

        $confirmPassword->addValidators([
            new PresenceOf([
                'message' => 'The confirmation password is required'
            ])
        ]);

        $confirmPassword->setLabel('Confirm Password');

        $this->add($confirmPassword);

        $this->add(new Submit('save', [
            'value' => 'Save',
            'class' => 'btn btn-success'
        ]));
    }
}
