<?php 
namespace Note\Factory\Controller;

use Note\Controller\IndexController;
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
		$userEntity = $serviceManager->get("NoteUserEntity");
		$noteForm = $serviceManager->get("NoteNoteForm");
		$noteFilter = $serviceManager->get("NoteNoteFilter");
		return new IndexController(
			$authService,
			$userEntity,
			$noteForm,
			$noteFilter
		);
	}
}