<?php
namespace User\Entity;

interface UserEntityInterface extends EntityInterface
{
	/**
	 * Set user email
	 *
	 * @param string $email
	 */
	public function setEmail($email);

	/**
	 * Get user email
	 *
	 * @return string
	 */
	public function getEmail();	

	/**
	 * Set user name
	 *
	 * @param string $username
	 */
	public function setUsername($username);

	/**
	 * Get user name 
	 *
	 * @return string
	 */
	public function getUsername();	

	/**
	 * Set user password 
	 *
	 * @param string $password
	 */
	public function setPassword($password);

	/**
	 * Get user password 
	 *
	 * @return string
	 */
	public function getPassword();

	/**
	 * Set user location 
	 *
	 * @param string $location
	 */
	public function setLocation($location);

	/**
	 * Get user location 
	 *
	 * @return string
	 */
	public function getLocation();

	/**
	 * Set user gender 
	 *
	 * @param string $gender
	 */
	public function setGender($gender);

	/**
	 * Get user gender 
	 *
	 * @return string
	 */
	public function getGender();	
}