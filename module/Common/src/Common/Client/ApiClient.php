<?php
namespace Common\Client;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Json\Decoder as JsonDecoder;
use Zend\Json\Json;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\Session\Container;

class ApiClient
{
	/**
	 * @var \Zend\Http\Client
	 */
	protected static $client = null;

	/**
	 * @var \Zend\Session\Container
	 */
	protected static $session = null;

	/**
	 * Host endpoint
	 * 
	 * @var string
	 */
	protected static $host = 'http://server.dev';

	/**
	 * Endpoint for creating a new note
	 * 
	 * @var string
	 */
	protected static $createNote = '/api/v1/note';

	/**
	 * Endpoint for updating a note
	 * 
	 * @var string
	 */
	protected static $updateNote = '/api/v1/note/%d';	

	/**
	 * Endpoint for retrieving user's notes
	 *
	 * @var string
	 */
	protected static $notes = '/api/v1/note/%s';	

	/**
	 * Endpoint for creating a new user
	 *
	 * @var string
	 */
	protected static $createUser = '/api/v1/user/create';

	/**
	 * Endpoint for logging a user
	 *
	 * @var string
	 */
	protected static $loginUser = '/api/v1/user/login';

	/**
	 * Endpoint for retrieving a single user's data
	 *
	 * @var string
	 */
	protected static $getUser = '/api/v1/user/get/%s';

	/**
	 * Endpoint for updating a user's info
	 *
	 * @var string
	 */
	protected static $updateUser = '/api/v1/user/update/%d';	

	/**
	 * Endpoint for revoking user's access token
	 *
	 * @var string
	 */
	protected static $revokeUser = '/api/v1/user/revoke/%s/%s';

	/**
	 * Request to create a new note
	 *
	 * @param array $data
	 * @return \Zend\Http\Response
	 */
	public static function createNote($data)
	{
		$url = self::$host . self::$createNote;
		return self::sendRequest($url, $data, Request::METHOD_POST);
	}

	/**
	 * Request to update a new note
	 *
	 * @param int $id
	 * @param array $data
	 * @return \Zend\Http\Response
	 */
	public static function updateNote($id, $data)
	{
		$url = self::$host . sprintf(self::$updateNote, $id);
		return self::sendRequest($url, $data, Request::METHOD_PUT);
	}

	/**
	 * Request to retrieve notes based on username
	 *
	 * @param string $username
	 * @return \Zend\Http\Response
	 */
	public static function getNotes($username)
	{
		$url = self::$host . sprintf(self::$notes, $username);
		return self::sendRequest($url);
	}

	/**
	 * Request to create a new user
	 *
	 * @param array $data
	 * @return \Zend\Http\Response
	 */
	public static function createUser($data)
	{
		$url = self::$host . self::$createUser;
		return self::sendRequest($url, $data, Request::METHOD_POST);
	}

	/**
	 * Request to get a user logged in
	 *
	 * @param array $data
	 * @return \Zend\Http\Response
	 */
	public static function loginUser($data)
	{
		$keys = array('username', 'password', 'clientId', 'clientSecret');
		foreach ($keys as $key) {
			if (!in_array($key, array_keys($data))) {
				throw new \Exception("This \"{$key}\" is required while sending data for logging in");
			}
		}

		$loginDetails = array(
			'grant_type' => 'password',
			'username' => $data['username'],
			'password' => $data['password']
		);
		$url = self::$host . self::$loginUser;
		return self::sendAuthRequest($url, $loginDetails, $data['clientId'], $data['clientSecret']);
	}

	/**
	 * Request to retrieve a specific user info
	 *
	 * @param string $username
	 * @return \Zend\Http\Response
	 */
	public static function getUser($username)
	{
		$url = self::$host . sprintf(self::$getUser, $username);
		return self::sendRequest($url);
	}

	/**
	 * Request to update a user's info
	 *
	 * @param int $id
	 * @param array $data
	 * @return \Zend\Http\Response
	 */
	public static function updateUser($id, $data)
	{
		$url = self::$host . sprintf(self::$updateUser, $id);
		return self::sendRequest($url, $data, Request::METHOD_PUT);
	}

	/**
	 * Request to revoke a user access token
	 *
	 * @param string $id User ID which is a username in OAuth2's "access_token_table"
	 * @param string $token
	 * @return \Zend\Http\Response
	 */
	public static function revokeUser($id, $token)
	{
		$url = self::$host . sprintf(self::$revokeUser, $id, $token);
		return self::sendRequest($url, null, Request::METHOD_DELETE);
	}

	/**
	 * Get session container
	 *
	 * @return Zend\Session\Container
	 */
	public static function getAuthSession()
	{
		if (null === self::$session) {
			self::$session = new Container('NoteOauthSession');
		}
		return self::$session;
	}

	/**
	 * Get Client
	 *
	 * @return \Zend\Http\Client
	 */
	protected static function getClient()
	{
		if (null === self::$client) {
			self::$client = new Client();
		}
		return self::$client;
	}

	/**
	 * Main method to perform sending request to the endponts
	 *
	 * @param string $url
	 * @param array $data
	 * @param string $method
	 * @return \Zend\Http\Response
	 */
	protected static function sendRequest($url, array $data = null, $method = Request::METHOD_GET)
	{
		$client = self::getClient();
		$client->resetParameters();
		$client->setEncType(Client::ENC_URLENCODED);
		$client->setUri($url);
		$client->setMethod($method);

        if (null === $data) {
            $data = array();
        }

        // This must need for subsequent requests to the API endpoints
        $data['access_token'] = self::getAuthSession()->accessToken;

        if (null !== $data && ($method == Request::METHOD_POST || $method == Request::METHOD_PUT)) {
            $client->setParameterPost($data);
        }
        if (null !== $data && ($method == Request::METHOD_GET || $method == Request::METHOD_DELETE)) {
            $client->setParameterGet($data);
        }

		$response = $client->send();

        // echo '<pre>';
        // print_r($response->getBody());
        // echo '</pre>';

		if ($response->isSuccess()) {
            return JsonDecoder::decode($response->getBody(), Json::TYPE_ARRAY);
		} else {
			$logger = new Logger();
			$logger->addWriter(new Stream('data/logs/api-general-request.log'));
			$logger->debug($response->getBody());
			return false;
		}
	}

	protected static function sendAuthRequest($url, $data, $clientId, $clientSecret)
	{
		$client = self::getClient();
		$client->resetParameters();
		$client->setEncType(Client::ENC_URLENCODED);
		$client->setUri($url);
		$client->setMethod(Request::METHOD_POST);
		$client->setAuth($clientId, $clientSecret);

        // This must need for subsequent requests to the API endpoints
        $data['access_token'] = self::getAuthSession()->accessToken;	

		$client->setParameterPost($data);

		$response = $client->send();

        // echo '<pre>';
        // print_r($response->getBody());
        // echo '</pre>';
        // exit();

		if ($response->isSuccess()) {
			return JsonDecoder::decode($response->getBody(), Json::TYPE_ARRAY);
		} else {
			$logger = new Logger();
			$logger->addWriter(new Stream('data/logs/api-auth-request.log'));
			$logger->debug($response->getBody());
			return false;
		}
	}
}