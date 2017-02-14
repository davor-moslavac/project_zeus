<?php
namespace Vokuro\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Vokuro\Models\Profiles;

class UsersForm extends FormBase
{

    public function initialize($entity = null, $options = null)
    {

        //$this->setAction('/profiles/search');

        // In edition the id is hidden
        if (isset($options['edit']) && $options['edit']) {
            $id = new Hidden('id');
        } else {
            $id = new Text('id', ['placeholder' => 'Id', 'class' => 'form-control']);
        }

        $this->add($id);

        $name = new Text('name', [
            'placeholder' => 'Name',
            'class' => 'form-control'
        ]);

        $name->addValidators([
            new PresenceOf([
                'message' => 'The name is required'
            ])
        ]);

        $this->add($name);

        $email = new Text('email', [
            'placeholder' => 'Email',
            'class' => 'form-control'
        ]);

        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ]),
            new Email([
                'message' => 'The e-mail is not valid'
            ])
        ]);

        $this->add($email);

        $profiles = Profiles::find([
            'active = :active:',
            'bind' => [
                'active' => 'Y'
            ]
        ]);

        $profilesId = new Select('profilesId', $profiles, [
            'using' => [
                'id',
                'name'
            ],
            'class' => 'form-control',
            'useEmpty' => true,
            'emptyText' => '...',
            'emptyValue' => ''
        ]);

        $profilesId->setLabel('Profiles Id');

        $this->add($profilesId);

        $banned = new Select('banned', [
            'Y' => 'Yes',
            'N' => 'No',
        ], ['class' => 'form-control']);

        $profilesId->setLabel('Banned');

        $this->add($profilesId);

        $suspended = new Select('suspended', [
            'Y' => 'Yes',
            'N' => 'No',
        ], ['class' => 'form-control']);

        $suspended->setLabel('Suspended');

        $this->add($suspended);

        $active = new Select('active', [
            'Y' => 'Yes',
            'N' => 'No',
        ], ['class' => 'form-control']);

        $suspended->setLabel('Active');

        $this->add($active);
    }
}
