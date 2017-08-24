<?php
namespace Note\Entity;

interface EntityInterface
{
	/**
	 * Set note ID
	 *
	 * @param int $id
	 */
	public function setId($id);

	/**
	 * Get note ID
	 *
	 * @return int
	 */
	public function getId();										

	/**
	 * Set note created date
	 *
	 * @param string $createdAt
	 */
	public function setCreatedAt($createdAt);

	/**
	 * Get note created date 
	 *
	 * @return string
	 */
	public function getCreatedAt();	

	/**
	 * Set note modified date
	 *
	 * @param string $updatedAt
	 */
	public function setUpdatedAt($updatedAt);

	/**
	 * Get note modified date
	 *
	 * @return string
	 */
	public function getUpdatedAt();		
}