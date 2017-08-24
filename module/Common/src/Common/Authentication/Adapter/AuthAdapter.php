<?php

namespace Common\Authentication\Adapter;

use Common\Client\ApiClient;
use User\Entity\UserEntity;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator\ClassMethods;

use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;
use Zend\Session\Container;

class AuthAdapter implements AdapterInterface
{
    /**
     * @var string
     */
    private $identity = null;

    /**
     * @var string
     */
    private $credential = null;

    /**
     * @var string
     */
    private $clientId = null;

    /**
     * @var string
     */
    private $clientSecret = null;

    /**
     * Check initial configurations
     *
     * @return void
     */
    public function initialize()
    {
        $type = array('email', 'username');

        if (null === $this->identity) {
            throw new \Exception("No identity provided for authetication!");
        }
        if (null === $this->credential) {
            throw new \Exception("No credential provided for authetication!");
        }
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface
     *               If authentication cannot be performed
     */
    public function authenticate()
    {
        $this->initialize();

        $result = ApiClient::loginUser(array(
            'username' => $this->getIdentity(),
            'password' => $this->getCredential(),
            'clientId' => $this->getClientId(),
            'clientSecret' => $this->getClientSecret(),
        ));     

        if (array_key_exists('access_token', $result) && !empty($result['access_token'])) {

            $session = new Container('NoteOauthSession');
            $session->setExpirationSeconds($result['expires_in']);
            $session->accessToken = $result['access_token'];

            // $session->getManager()->getConfig()->getGcMaxlifetime();
            // $session->getManager()->getConfig()->getCookieLifetime();
            // exit;

            $hydrator = new ClassMethods();
            $user = $hydrator->hydrate(ApiClient::getUser($this->getIdentity()), new UserEntity());

            $response = new Result(Result::SUCCESS, $user, array('Authentication successful'));
        } else {
            $response = new Result(Result::FAILURE, NULL , array('Invalid credentials'));
        }

        return $response;
    }

    /**
     * Set user identiry
     *
     * @param string $identity
     * @return AuthAdapter
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * Get user identiry
     *
     * @return string
     */
    public function getIdentity()
    {
        return $this->identity;
    } 

    /**
     * Set user credential
     *
     * @param string $credential
     * @return AuthAdapter
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;
        return $this;
    }

    /**
     * Get user credential
     *
     * @return string
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * Set client ID for OAuth2
     *
     * @param string $clientId
     * @return AuthAdapter
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * Get client ID
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set client secret for OAuth2
     *
     * @param string $clientSecret
     * @return AuthAdapter
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * Get client secret
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }  
}