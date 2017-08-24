<?php
namespace Common;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
	public function onBootstrap(MvcEvent $e)
	{
		$eventManager = $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);

		// A listener for route permisson checkup
		$eventManager->attach(MvcEvent::EVENT_ROUTE, array($this, 'routePermission'));
	}

	/**
	 * Load module configurations
	 *
	 * @return string
	 */
	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	/**
	 * Load services
	 *
	 * @return string
	 */
	public function getServiceConfig()
	{
		return include __DIR__ . '/config/service.config.php';
	}

	/**
	 * Configure namespaces to be loaded for this module
	 * 
	 * @return array
	 */
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
				),
			),
		);
	}	

	/**
	 * Check acl permissions for current request
	 *
	 * @param MvcEvent $e
	 * @return void
	 */
	public function routePermission(MvcEvent $e) 
	{
		$route = $e->getRouteMatch()->getMatchedRouteName();

		$app = $e->getApplication();
		$serviceManager = $app->getServiceManager();
		$authService = $serviceManager->get("NoteAuthService");

		$viewModel = $e->getViewModel();

		$userRole = 'guest';
		if ($authService->hasIdentity()) {
			$userRole = 'member';
			$loggedInUser = $authService->getIdentity();
			$viewModel->loggedInUser = $loggedInUser;
		}

		$viewModel->userRole = $userRole;

		if (!$viewModel->acl->isAllowed($userRole, $route)) {
			$response = $e->getResponse();
			$response->setStatusCode(404);
			return;
		}
	}
}