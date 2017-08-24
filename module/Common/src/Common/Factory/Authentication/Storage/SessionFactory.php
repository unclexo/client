<?php 
namespace Common\Factory\Authentication\Storage;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\Storage\Session;

class SessionFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return Session
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{	
        $sessionManager = $serviceLocator->get('NoteSessionManager');
		return new Session('NoteOauthSession', null, $sessionManager);
	}
}