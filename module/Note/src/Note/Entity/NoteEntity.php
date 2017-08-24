<?php 
namespace Note\Entity;

use Note\Entity\NoteEntityInterface;

class NoteEntity implements NoteEntityInterface
{
	/**
	 * @var int
	 */
    public $id;

	/**
	 * @var int
	 */
    public $userId;

	/**
	 * @var string
	 */
    public $note;

	/**
	 * @var string
	 */
    public $createdAt;

	/**
	 * @var string
	 */
    public $updatedAt;

	/**
	 * Set note ID
	 *
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Get note ID
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set user ID
	 *
	 * @param int $userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	/**
	 * Get user ID
	 *
	 * @return int
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * Set note
	 *
	 * @param string $note
	 */
	public function setNote($note)
	{
		$this->note = $note;
	}

	/**
	 * Get note
	 *
	 * @return string
	 */
	public function getNote()
	{
		return $this->note;
	}	

	/**
	 * Set note created date
	 *
	 * @param string $createdAt
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	/**
	 * Get note created date
	 *
	 * @return string
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set note modified date
	 *
	 * @param string $updatedAt
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}

	/**
	 * Get note modified date
	 *
	 * @return string
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}
}