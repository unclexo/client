<?php 
namespace Common\Factory\Authentication;

use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthenticationServiceFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return AuthenticationService
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{		
		$storage = $serviceLocator->get('NoteAuthStorage');
		$adapter = $serviceLocator->get('NoteAuthAdapter');
		$authService = new AuthenticationService();
		$authService->setStorage($storage);
		$authService->setAdapter($adapter);
		return $authService;
	}
}