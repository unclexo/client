<?php 
namespace User\Entity;

class FileEntity implements FileEntityInterface
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
    public $filename;

	/**
	 * @var string
	 */    
    public $createdAt;

	/**
	 * @var string
	 */    
    public $updatedAt;

	/**
	 * Set file ID
	 *
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Get file ID
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
	 * @param int $id
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
	 * Set file name
	 *
	 * @param string $filename
	 */
	public function setFilename($filename)
	{
		$this->filename = $filename;
	}

	/**
	 * Get file name 
	 *
	 * @return string
	 */
	public function getFilename()
	{
		return $this->filename;
	}									

	/**
	 * Set file created date
	 *
	 * @param string $createdAt
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	/**
	 * Get file created date 
	 *
	 * @return string
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set file modified date
	 *
	 * @param string $updatedAt
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}

	/**
	 * Get file modified date
	 *
	 * @return string
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}
}