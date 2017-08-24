<?php 
namespace User\Entity;

class UserEntity implements UserEntityInterface
{
	const GENDER_MALE = 1;
	const DOMAIN_NAME = 'http://server.dev/uploads/';

	/**
	 * @var int
	 */
    public $id;

	/**
	 * @var string
	 */    
    public $email;

	/**
	 * @var string
	 */    
    public $username;

	/**
	 * @var string
	 */        
    public $password;

	/**
	 * @var string
	 */    
    public $location;

	/**
	 * @var string
	 */    
    public $gender;

	/**
	 * @var int
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
	 * Set user ID
	 *
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Get user ID
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}	

	/**
	 * Set user email
	 *
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * Get user email
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set user name
	 *
	 * @param string $username
	 */
	public function setUsername($username)
	{
		$this->username = $username;
	}

	/**
	 * Get user name 
	 *
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}	

	/**
	 * Set user password 
	 *
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * Get user password 
	 *
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set user location 
	 *
	 * @param string $location
	 */
	public function setLocation($location)
	{
		$this->location = $location;
	}

	/**
	 * Get user location 
	 *
	 * @return string
	 */
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * Set user gender 
	 *
	 * @param string $gender
	 */
	public function setGender($gender)
	{
		$this->gender = $gender;
	}

	/**
	 * Get user gender 
	 *
	 * @return string
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * Set filename
	 *
	 * @param string $filename
	 */
	public function setFilename($filename)
	{
		$this->filename = $filename;
	}

	/**
	 * Get filename
	 *
	 * @return string
	 */
	public function getFilename()
	{
		return $this->filename;
	}	

	/**
	 * Get avatar URL
	 *
	 * @return string
	 */
	public function getAvatarUrl()
	{
		return ($this->getFilename() !== null) ? self::DOMAIN_NAME . $this->getFilename() : null;
	}		

	/**
	 * Get user gender as string 
	 *
	 * @return string
	 */
	public function getGenderString()
	{
		return $this->gender == self::GENDER_MALE ? 'Male' : 'Female';
	}									

	/**
	 * Set user created date
	 *
	 * @param string $createdAt
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	/**
	 * Get user created date 
	 *
	 * @return string
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set user modified date
	 *
	 * @param string $updatedAt
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}

	/**
	 * Get user modified date
	 *
	 * @return string
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * Cast properties to an array
	 * 
	 * @return array
	 */
	public function toArray()
	{
		return get_object_vars($this);
	}
}