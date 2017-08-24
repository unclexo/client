<?php 
namespace Common\Factory\Session;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Config\SessionConfig;

class SessionConfigFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return SessionConfig
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{	
        $globalConfig = $serviceLocator->get('config');
        $config = $globalConfig['session_config'];
        $sessionConfig = new SessionConfig();
        $sessionConfig->setOptions($config);
        return $sessionConfig;
	}
}