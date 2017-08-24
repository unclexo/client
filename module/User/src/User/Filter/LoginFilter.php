<?php 
namespace User\Filter;

use Zend\InputFilter\InputFilter;

class LoginFilter extends InputFilter
{
	public function __construct()
	{
		$this->addFilters();
	}

	public function addFilters()
	{
		$this->add(array(
			'name' => 'username',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
					'options' => array(
						'min' => 3,
						'max' => 40,
					),
					'break_chain_on_failure' => true,
				),
			),
		));

		$this->add(array(
			'name' => 'password',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'NotEmpty',
					'break_chain_on_failure' => true,
				),
				array(
					'name' => 'StringLength',
					'options' => array(
						'min' => 8,
						'max' => 60,
					),
					'break_chain_on_failure' => true,
				),
			),
		));				
	}		
}