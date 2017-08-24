<?php 
namespace User\Entity;

interface EntityInterface
{
	/**
	 * Set ID
	 *
	 * @param int $id
	 */
	public function setId($id);

	/**
	 * Get ID
	 *
	 * @return int
	 */
	public function getId();

	/**
	 * Set created date
	 *
	 * @param string $createdAt
	 */
	public function setCreatedAt($createdAt);

	/**
	 * Get created date 
	 *
	 * @return string
	 */
	public function getCreatedAt();

	/**
	 * Set modified date
	 *
	 * @param string $updatedAt
	 */
	public function setUpdatedAt($updatedAt);

	/**
	 * Get modified date
	 *
	 * @return string
	 */
	public function getUpdatedAt();
}
