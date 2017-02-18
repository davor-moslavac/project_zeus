<?php
namespace MediaRatings\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class ProfilesForm extends FormBase
{

    public function initialize($entity = null, $options = null)
    {
        if (isset($options['edit']) && $options['edit']) {
            $id = new Hidden('id');
        } else {
            $id = new Text('id', ['class' => 'form-control']);
            $id->setLabel('Id');
        }

        $this->add($id);

        $name = new Text('name', [
            'placeholder' => 'Name',
            'class' => 'form-control'
        ]);

        $name->setLabel('Name');

        $name->addValidators([
            new PresenceOf([
                'message' => 'The name is required'
            ])
        ]);

        $this->add($name);

        $active = new Select('active', [
            'Y' => 'Yes',
            'N' => 'No'
        ], ['class' => 'form-control']);

        $active->setLabel('Active');

        $this->add($active);
    }
}
