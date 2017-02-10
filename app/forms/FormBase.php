<?php

namespace Vokuro\Forms;

use Phalcon\Forms\Element\Hidden,
    Phalcon\Validation\Validator\Identical;


class FormBase extends \Phalcon\Forms\Form
{  
    /**
     * Initialize CSRF
     * @author         
     * @version        1.0
     * @since          0.1.0
     * @return         void
     */
    public function initialize()
    {
        $csrf = new Hidden('csrf', ['name' => $this->security->getTokenKey()]);
        $csrf->addValidator(new Identical(['value' => $this->security->getSessionToken(),'message' => 'CSRF validation failed']));
        $this->add($csrf);
    }

    public function getType($element = null)
    {
        if (is_object($element))
        {
            $type = explode('\\', get_class($element));
            $type = $type[count($type) - 1];
            return strtolower($type);
        }

        return FALSE;
    }

}
