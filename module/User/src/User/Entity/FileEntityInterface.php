<?php
namespace User\Entity;

interface FileEntityInterface extends EntityInterface
{
	/**
	 * Set user ID
	 *
	 * @param int $userId
	 */
	public function setUserId($userId);

	/**
	 * Get user ID
	 *
	 * @return int
	 */
	public function getUserId();		

	/**
	 * Set a file name
	 *
	 * @param string $filename
	 */
	public function setFilename($filename);

	/**
	 * Get a file name
	 *
	 * @return string
	 */
	public function getFilename();
}