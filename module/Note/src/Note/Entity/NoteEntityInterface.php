<?php
namespace Note\Entity;

interface NoteEntityInterface extends EntityInterface
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
	 * Set note
	 *
	 * @param string $note
	 */
	public function setNote($note);

	/**
	 * Get note
	 *
	 * @return string
	 */
	public function getNote();										
}