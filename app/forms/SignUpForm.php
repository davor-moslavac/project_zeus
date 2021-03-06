<?php
namespace MediaRatings\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\File;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class SignUpForm extends FormBase
{

    public function initialize($entity = null, $options = null)
    {
        //$this->setAction('/profiles/search');

        $name = new Text('name', ['class' => 'form-control']);

        $name->setLabel('Name');

        $name->addValidators([
            new PresenceOf([
                'message' => 'The name is required'
            ])
        ]);

        $this->add($name);

        // Email
        $email = new Text('email', ['class' => 'form-control']);

        $email->setLabel('E-Mail');

        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ]),
            new Email([
                'message' => 'The e-mail is not valid'
            ])
        ]);

        $this->add($email);

        // Interests
        //$this->add((new Element\MultiCheckbox('interests', ['1' => '1', '2' => '2', '3' => '3', '4' => '4']))->setLabel('Interests')->addValidator(new PresenceOf(['message' => 'field-is-required'])));

        // Date of birth
        // $dobKey = 'dob';
        // $dob = new Element\DateOfBirth($dobKey);
        // $dob
        //     ->setLabel("Date of birth")
        //     ->setDefault([
        //         'D' => $this->request->getPost($dobKey.'D'),
        //         'M' => $this->request->getPost($dobKey.'M'),
        //         'Y' => $this->request->getPost($dobKey.'Y')
        //     ])
        //     ->setAttributes(['class' => 'form-control'])
        //     ->setUserOption('type', 'select')
        //     ->setUserOption('help', "We need this to confirm you are at least 18.");
        // $this->add($dob);


        $img = new File('img', ['class' => 'form-control']);
        $img->setLabel('Avatar');
        
        $this->add($img);

        // Password
        $password = new Password('password', ['class' => 'form-control']);

        $password->setLabel('Password');

        $password->addValidators([
            new PresenceOf([
                'message' => 'The password is required'
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

        $this->add($password);

        // Confirm Password
        $confirmPassword = new Password('confirmPassword', ['class' => 'form-control']);

        $confirmPassword->setLabel('Confirm Password');

        $confirmPassword->addValidators([
            new PresenceOf([
                'message' => 'The confirmation password is required'
            ])
        ]);

        $this->add($confirmPassword);

        // Remember
        $terms = new Check('terms', [
            'value' => 'yes'
        ]);

        $terms->setLabel('Accept terms and conditions');

        $terms->addValidator(new Identical([
            'value' => 'yes',
            'message' => 'Terms and conditions must be accepted'
        ]));

        $this->add($terms);

        // Sign Up
        $this->add(new Submit('sign', [
            'value' => 'Submit',
            'class' => 'btn btn-success'
        ]));
    }

    /**
     * Prints messages for a specific element
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}
