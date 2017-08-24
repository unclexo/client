<?php
namespace User;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Module
{
	public function onBootstrap(MvcEvent $e)
	{
		// Bootstrap the ACL
		$this->bootstrapAcl($e);

		$eventManager = $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);
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
	 * Load controllers
	 *
	 * @return string
	 */
	public function getControllerConfig()
	{
		return include __DIR__ . '/config/controller.config.php';
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
	 * @return null
	 */
	protected function bootstrapAcl($e)
	{
		$viewModel = $e->getViewModel();
		if (null === $viewModel->acl) {
			$acl = new Acl;
		} else {
			$acl = $viewModel->acl;
		}

		$aclConfig = include __DIR__ . '/config/module.acl.php';
		foreach ($aclConfig['roles'] as $role) {
			if (!$acl->hasRole($role)) {
				$role = new Role($role);
				$acl->addRole($role);
			} else {
				$role = $acl->getRole($role);
			}

			if (array_key_exists($role->getRoleId(), $aclConfig['permissions'])) {
				foreach ($aclConfig['permissions'][$role->getRoleId()] as $resource) {
					if (!$acl->hasResource($resource)) {
						$acl->addResource(new Resource($resource));
					}
					$acl->allow($role, $resource);
				}
			}
		}

		$viewModel->acl = $acl;
	}	
}