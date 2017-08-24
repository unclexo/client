<?php
namespace User\Factory\Form;

use User\Form\RegisterForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RegisterFormFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return RegisterForm
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$filter = $serviceLocator->get('NoteRegisterFilter');
		$form = new RegisterForm();
		$form->setInputFilter($filter);
		return $form;
	}
}