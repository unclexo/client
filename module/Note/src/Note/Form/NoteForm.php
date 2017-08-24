<?php 
namespace Note\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class NoteForm extends Form
{
	/**
	 * Contructor
	 */	
	public function __construct($name = null)
	{
		parent::__construct('note-form');

		$this->setAttribute('method', 'post');
		$this->setAttribute('class', 'form-horizontal');

		$this->addInputFields();
	}

	public function addInputFields()
	{
		$this->add(array(
			'name' => 'note',
			'type' => 'Zend\Form\Element\Textarea',
			'attributes' => array(
				'class' => 'form-control note',
				'placeholder' => 'Write down your note',
				'maxlength' => 1000,
				'rows' => 5,
			),
		));	

		$this->add(array(
			'name' => 'write',
			'attributes' => array(
				'type' => 'submit',
				'value' => 'Write down',
				'class' => 'btn btn-custom',
			),
		));

		$this->add(new Element\Csrf('csrf'));
	}
}