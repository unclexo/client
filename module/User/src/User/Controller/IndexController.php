<?php 
namespace User\Controller;

use Common\Client\ApiClient;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\FormInterface;
use Zend\Session\Container as SessionContainer;

class IndexController extends AbstractActionController
{
	/**
	 * @var AuthenticationService
	 */	
	protected $authService;

	/**
	 * @var FormInterface
	 */	
	protected $loginForm;

	/**
	 * @var FormInterface
	 */	
	protected $infoForm;	

	/**
	 * @var FormInterface
	 */	
	protected $registrationForm;

	/**
	 * @var string
	 */	
	protected $uploadPath;	

	/**
	 * Constructor
	 * 
	 * @param AuthenticationService $authService
	 * @param FormInterface $loginForm
	 * @param FormInterface $infoForm
	 * @param FormInterface $registrationForm
	 */
	public function __construct(
		AuthenticationService $authService,
		FormInterface $loginForm,
		FormInterface $infoForm,
		FormInterface $registrationForm,
		$uploadPath
	) {
		$this->authService = $authService;
		$this->loginForm = $loginForm;
		$this->infoForm = $infoForm;
		$this->registrationForm = $registrationForm;
		$this->uploadPath = $uploadPath;
	}

	public function indexAction()
	{
		// Redirect if logged in
		$this->ifLoggedInRedirect();

		$view = array();
		$form = $this->registrationForm;
		$request = $this->getRequest();
		$signupState = $this->flashMessenger();

		if ($request->isPost()) {
			$data = $request->getPost()->toArray();
			$form->setData($data);

			if ($form->isValid()) {
				$data = $form->getData();

				// send data to API
				$response = ApiClient::createUser($data);
				if (true === $response['result']) {
					$signupState->addSuccessMessage('Your account has been created. Please login!');
					return $this->redirect()->toRoute('user-login');
				} else {
					$signupState->addErrorMessage('Erorr while creating your account. Please try again later');
					return $this->redirect()->toRoute('user-registration');
				} 	
			}
		}

		$view['registerForm'] = $form;
		return $view;		
	}

	public function loginAction()
	{
		// Redirect if logged in
		$this->ifLoggedInRedirect();

		$view = array();
		$form = $this->loginForm;
		$request = $this->getRequest();
		$loginState = $this->flashMessenger();
		
		if ($request->isPost()) {
			$data = $request->getPost()->toArray();
			$form->setData($data);

			if ($form->isValid()) {
				$data = $form->getData();
				$this->authService->getAdapter()
					->setIdentity($data['username'])
					->setCredential($data['password'])
					->setClientId('test_client')
					->setClientSecret('test_secret'); 

				$result = $this->authService->authenticate();
				if ($result->isValid()) {
					return $this->redirect()->toRoute('note', array('username' => $data['username']));
				} else {
                    foreach ($result->getMessages() as $message) {
                        $loginState->addErrorMessage($message);
                    }
                    return $this->redirect()->toRoute('user-login');
				}
			}
		}

		$view['loginForm'] = $form;
		return $view;
	}

	public function infoAction()
	{
		if (!$this->authService->hasIdentity()) {
			return $this->redirect()->toRoute('user-login');
		}
		
		$userIdentity = $this->authService->getIdentity();

		$view = array();
		$form = $this->infoForm;
		$request = $this->getRequest();
		$updateState = $this->flashMessenger();

		if ($request->isPost()) {
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
			$form->setData($data);

			if ($form->isValid()) {
				$data = $form->getData();
				$avatar = !empty($data['avatar']['name']) ? $data['avatar']['name'] : null;
				$data['avatar'] = $this->createAvater($avatar);

                unset($data['csrf']);
                unset($data['info']);

                $response = ApiClient::updateUser($userIdentity->getId(), $data);
                if (true === $response['result']) {
                	$updateState->addSuccessMessage('Update was successful');
                	return $this->redirect()->toRoute('user-info');
                }
			}
		}

		$view['infoForm'] = $form;
		return $view;
	}

	public function logoutAction()
	{
		if ($this->authService->hasIdentity()) {
			$userIdentity = $this->authService->getIdentity();
			$session = new SessionContainer('NoteOauthSession');
			$token = $session->accessToken; 
			$response = ApiClient::revokeUser($userIdentity->getUsername(), $token);
			$this->authService->clearIdentity();		
		}
		return $this->redirect()->toRoute('user-login');
	}

	/**
	 * Encode binary data
	 *
	 * @param string $avatar
	 * @return mixed
	 */
	protected function createAvater($avatar)
	{
		if (empty($avatar)) {
			return false;
		}
		
		$adapter = new \Zend\File\Transfer\Adapter\Http();
		$adapter->setDestination($this->uploadPath);

        $extension = explode('.', $avatar);
        $extension = end($extension);
        $newFilename = sprintf('%s.%s', sha1(uniqid(time(), true)), $extension);
        $target = $this->uploadPath . DIRECTORY_SEPARATOR . $newFilename;

        $adapter->addFilter('File\Rename',
            array(
                'target' => $target,
                'overwrite' => true,
            )
        );

    	if ($adapter->receive($avatar)) {
    		$data = base64_encode(file_get_contents($target));
    		if (file_exists($target)) {
    			unlink($target);
    		}
    	} else {
    		return false;
    	}

    	return (string) $data;
	}

	/**
	 * Redirect already logged in user
	 */
	protected function ifLoggedInRedirect()
	{
		if ($this->authService->hasIdentity()) {
			$userIdentity = $this->authService->getIdentity();
			return $this->redirect()->toRoute('note', array('username' => $userIdentity->getUsername()));
		}
	}					
}