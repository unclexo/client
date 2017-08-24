<?php 
namespace Common\Factory\Session;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\SessionManager;

class SessionManagerFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return SessionManager
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{	
        $sessionConfig = $serviceLocator->get('NoteSessionConfig');
        $sessionManager = new SessionManager();
        $sessionManager->setConfig($sessionConfig);
        return $sessionManager;
	}
}