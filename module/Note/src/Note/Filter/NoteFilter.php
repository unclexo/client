<?php 
namespace Note\Filter;

use Zend\InputFilter\InputFilter;

class NoteFilter extends InputFilter
{
	/**
	 * Contructor
	 */
	public function __construct()
	{
		$this->addFilters();
	}

	public function addFilters()
	{
		$this->add(array(
			'name' => 'note',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 10,
						'max' => 1000,
					),
				),
			),
		));				
	}		
}