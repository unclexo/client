<?php
namespace User\Factory\Form;

use User\Form\InfoForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class InfoFormFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return InfoForm
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$filter = $serviceLocator->get('NoteInfoFilter');
		$form = new InfoForm();
		$form->setInputFilter($filter);
		return $form;
	}
}