<?php
namespace Note\Factory\Form;

use Note\Form\NoteForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NoteFormFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return NoteForm
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$filter = $serviceLocator->get('NoteNoteFilter');
		$form = new NoteForm();
		$form->setInputFilter($filter);
		return $form;
	}
}