<?php
namespace User\Factory\Controller;

use User\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return IndexController
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$serviceManager = $serviceLocator->getServiceLocator();
		$authService = $serviceManager->get('NoteAuthService');
		$loginForm = $serviceManager->get('NoteLoginForm');
		$updateForm = $serviceManager->get('NoteInfoForm');
		$registrationForm = $serviceManager->get('NoteRegisterForm');
		$config = $serviceManager->get('config');
		$uploadPath = $config['upload_config']['upload_path'];
		return new IndexController(
			$authService,
			$loginForm, 
			$updateForm, 
			$registrationForm,
			$uploadPath
		);
	}
}