<?php 
namespace User\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class RegisterForm extends Form
{
	
	public function __construct($name = null)
	{
		parent::__construct('user-registration');

		$this->setAttribute('method', 'post');
		$this->setAttribute('class', 'form-horizontal');

		$this->addInputFields();
	}

	public function addInputFields()
	{
		$this->add(array(
			'name' => 'username',
			'type' => 'Zend\Form\Element\Text',
			'options' => array(
				'label' => 'Username',
				'label_attributes' => array(
					'class' => 'control-label',
				),
			),
		));

		$this->add(array(
			'name' => 'email',
			'type' => 'Zend\Form\Element\Text',
			'options' => array(
				'label' => 'Email',
				'label_attributes' => array(
					'class' => 'control-label',
				),
			),
		));		

		$this->add(array(
			'name' => 'password',
			'type' => 'Zend\Form\Element\Password',
			'options' => array(
				'label' => 'Password',
				'label_attributes' => array(
					'class' => 'control-label',
				),
			),
		));

		$this->add(array(
			'name' => 'repeat_password',
			'type' => 'Zend\Form\Element\Password',
			'options' => array(
				'label' => 'Confirm Password',
				'label_attributes' => array(
					'class' => 'control-label',
				),
			),
		));		

		$this->add(new Element\Csrf('csrf'));

		$this->add(array(
			'name' => 'register',
			'attributes' => array(
				'type' => 'submit',
				'value' => 'Sign up',
			),
		));
	}
}