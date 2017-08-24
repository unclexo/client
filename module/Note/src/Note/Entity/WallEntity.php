<?php
namespace Note\Entity;

use Note\Entity\NoteEntity;
use Zend\Stdlib\Hydrator\ClassMethods;

class WallEntity
{
	/**
	 * @var array
	 */
	protected $feeds = array();

	/**
	 * Set feed
	 *
	 * @return null
	 */
	public function setFeeds($feeds)
	{
		$hydrator = new ClassMethods();
		foreach ($feeds as $feed) {
			$this->feeds[] = $hydrator->hydrate($feed, new NoteEntity());
		}
	}

	/**
	 * Get feed
	 *
	 * @return array
	 */
	public function getFeeds()
	{
		return $this->feeds;
	}
}