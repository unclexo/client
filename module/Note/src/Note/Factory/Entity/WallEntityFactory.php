<?php
namespace Note\Factory\Entity;

use Note\Entity\WallEntity;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WallEntityFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return WallEntity
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$noteEntity = $serviceLocator->get('NoteNoteEntity');
		return new WallEntity($noteEntity);
	}
}