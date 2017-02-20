<?php

namespace MediaRatings\Forms\Element;

use Phalcon\Forms\Element;
use Phalcon\Forms\ElementInterface;

/**
 * Submit button element for forms
 * 
 * @author           
 * @version          1.0
 * @since            1.0
 */

class DateOfBirth extends Element implements ElementInterface
{

	public function render ($attr = NULL)
	{
		$attributes = $this->_attributes;
		if (!count($this->_name)) $this->_name = 'dob';
		if (!isset($attributes['id'])) unset($attributes['id']);
		if (!isset($attributes['name'])) unset($attributes['name']);

		if (is_null($attr)) $attr = array();
		if (is_null($attributes)) $attributes = array();

		$attributes = array_merge($attributes, $attr);

		if (isset($attributes['class'])) $attributes['class'] .= ' dob-';
		else $attributes['class'] = ' dob-';

		$options['D'] = range(1, 31);
		$options['M'] = [
			1   => 'January',
			2   => 'February',
			3   => 'March',
			4   => 'April',
			5   => 'May',
			6   => 'June',
			7   => 'July',
			8   => 'August',
			9   => 'September',
			10  => 'October',
			11  => 'November',
			12  => 'December'
		 ];
		$options['Y'] = range(date('Y')-12, date('Y')-120);

		$values = $this->getDefault();

		$html = '';

		foreach ($options as $field => $option) {
			$html .= '<select id="'. $this->_name . $field .'" name="'. $this->_name . $field .'"'; 
		
			foreach ($attributes as $attribute=>$value)
			{
				if ($attribute == 'class') $value .= $field;
				$html .= ' '. $attribute .'="'. $value .'"';
			}

			$html .= '>';

			switch ($field)
			{
				case 'D':
					$html .= '<option value="@"';
					if (!$values['D']) $html .= ' selected';
					$html .= ' disabled>Day</option>';
					break;
				case 'M':
					$html .= '<option value="@"';
					if (!$values['M']) $html .= ' selected';
					$html .= ' disabled>Month</option>';
					break;
				case 'Y':
					$html .= '<option value="@"';
					if (!$values['Y']) $html .= ' selected';
					$html .= ' disabled>Year</option>';
					break;
			}

			if ($field == 'M') {
				foreach ($option as $monthNum => $monthName) {
					$html .= '<option ' . ($values[$field] == $monthNum ? 'selected ' : '');
					$html .= 'value="'. $monthNum .'">'. $monthName .'</option>';
				}
			}
			else
			{
				foreach ($option as $row) {
					$html .= '<option ' . ($values[$field] == $row ? 'selected ' : '');
					$html .= 'value="'. $row .'">'. $row .'</option>';
				}
			}
			
			$html .= '</select>';

		}

		

		return $html;
	}

}