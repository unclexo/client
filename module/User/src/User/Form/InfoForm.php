<?php 
namespace User\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class InfoForm extends Form
{
	
	public function __construct($name = null)
	{
		parent::__construct('user-info-update');

		$this->setAttribute('method', 'post');
		$this->setAttribute('class', 'form-horizontal');

		$this->addInputFields();
	}

	public function addInputFields()
	{
		$this->add(array(
			'name' => 'location',
			'type' => 'Zend\Form\Element\Text',
			'options' => array(
				'label' => 'Location',
				'label_attributes' => array(
					'class' => 'control-label',
				),
			),
		));

		$this->add(array(
			'name' => 'gender',
			'type' => 'Zend\Form\Element\Radio',
			'options' => array(
				'label' => 'Gender',
				'label_attributes' => array(
					'class' => 'control-label',
				),
				'value_options' => array(
					0 => 'Female',
					1 => 'Male',
				),
			),
		));		

        $this->add(array(
            'name' => 'avatar',
            'type'  => 'Zend\Form\Element\File',
            'options' => array(
                'label' => 'Avatar',
                'label_attributes' => array(
                    'class' => 'control-label'
                )
            )
        ));		

		$this->add(new Element\Csrf('csrf'));

		$this->add(array(
			'name' => 'info',
			'attributes' => array(
				'type' => 'submit',
				'value' => 'Update',
			),
		));
	}
}