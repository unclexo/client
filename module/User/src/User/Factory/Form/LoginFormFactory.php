<?php
namespace User\Factory\Form;

use User\Form\LoginForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginFormFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return LoginForm
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$filter = $serviceLocator->get('NoteLoginFilter');
		$form = new LoginForm();
		$form->setInputFilter($filter);
		return $form;
	}
}