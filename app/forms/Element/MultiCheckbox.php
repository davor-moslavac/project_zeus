<?php

namespace MediaRatings\Forms\Element;

/**
 * Custom checkbox form element.
 */
class MultiCheckbox extends \Phalcon\Forms\Element\Select
{

	/**
	 * Custom checkbox button element
	 * @author         
	 * @version        1.0
	 * @since          1.0
	 */
    public function render($attributes = NULL)
    {	
    	$html = '';
        $active = '';
        $checked = '';
        $attrs = '';
        
        foreach ($this->getAttributes() as $key => $value) $attrs .= ' ' . $key . '="' . $value . '"';
        
        $options = $this->getOptions();
        $values = $this->getValue();
        if (count($values) < 1) $values = [];

        foreach ($options as $value => $label) 
        {
            if (in_array($value, $values))
            {
                $active = ' active';
                $checked = ' checked="checked"';
            }
        	$html .= '<label class="col-xs-' . 12 / count($options) . ' btn btn-checkbox' . $active . '"><input type="checkbox" value="' . $value . '" name="' . $this->getName() . '[]"' . $attrs . $checked . '>' . $label . '</label>';
            $active = '';
            $checked = '';
        }

        return $html;
    }
    
}