<?php 
namespace User\Filter;

use Zend\InputFilter\InputFilter;

class InfoFilter extends InputFilter
{
	public function __construct()
	{
		$this->addFilters();
	}

	public function addFilters()
	{
		$this->add(array(
			'name' => 'location',
			'required' => false,
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
			'name' => 'gender',
			'required' => false,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'InArray',
					'options' => array(
						'haystack' => array('0', '1'),
					),
					'break_chain_on_failure' => true,
				),
			),
		));

		$this->add(array(
			'name' => 'avatar',
			'required' => false,
			'validators' => array(
				array(
					'name' => 'File\Size',
					'options' => array(
						'min' => '1KB',
						'max' => '500KB',
					),
					'break_chain_on_failure' => true,
				),
				array(
					'name' => 'File\ImageSize',
					'options' => array(
						'minWidth' => 100,
						'minHeight' => 100,
						'maxWidth' => 640,
						'maxHeight' => 480,
					),
					'break_chain_on_failure' => true,
				),
				array(
					'name' => 'File\MimeType',
					'options' => array(
                        'mimeType' => array(
                            'image/jpg',
                            'image/png',
                            'image/jpeg',
                        ),
					),
					'break_chain_on_failure' => true,
				),
			),
		));					
	}			
}