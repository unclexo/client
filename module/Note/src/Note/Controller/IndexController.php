<?php 
namespace Note\Controller;

use Common\Client\ApiClient;
use Note\Entity\WallEntity;
use User\Entity\UserEntityInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Form\FormInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	/**
	 * @var AuthenticationService
	 */
	protected $authService;

	/**
	 * @var UserEntityInterface
	 */
	protected $userEntity;

	/**
	 * @var FormInterface
	 */
	protected $noteForm;

	/**
	 * @var InputFilterInterface
	 */
	protected $noteFilter;

	/**
	 * Constructor
	 * 
	 * @param AuthenticationService $authService
	 * @param UserEntityInterface $userEntity
	 * @param FormInterface $noteForm
	 * @param InputFilterInterface $noteFilter
	 */
	public function __construct(
		AuthenticationService $authService,
		UserEntityInterface $userEntity,
		FormInterface $noteForm,
		InputFilterInterface $noteFilter
	) {
		$this->authService = $authService;
		$this->userEntity = $userEntity;
		$this->noteForm = $noteForm;
		$this->noteFilter = $noteFilter;
	}

	public function indexAction()
	{
		if (!$this->authService->hasIdentity()) {
			return $this->redirect()->toRoute('user-login');
		}

		$userIdentity = $this->authService->getIdentity();

		// echo '<pre>';
		// print_r($userIdentity);
		// echo '</pre>';

		$username = $this->params()->fromRoute('username');
		$userData = ApiClient::getUser($username);

		if (false !== $userData) {
			$hydrator = new ClassMethods();
			$userProfile = $hydrator->hydrate($userData, $this->userEntity);
		} else {
			$this->getResponse()->setStatusCode(404);
			return;
		}

		$hydrator = new ClassMethods();
		$noteData = ApiClient::getNotes($username);
		$wallFeeds = $hydrator->hydrate($noteData, new WallEntity());

		$paginator = new Paginator(new ArrayAdapter($wallFeeds->getFeeds()));
		$paginator->setItemCountPerPage(10);
		$paginator->setCurrentPageNumber($this->params()->fromRoute('page'));

		$view = array();
		$form = $this->noteForm;
		$request = $this->getRequest();
		$noteState = $this->flashMessenger();

		if ($request->isPost()) {
			$data = $request->getPost()->toArray();
			$form->setData($data);

			if ($form->isValid()) {
				$data = $form->getData();
				if ($this->createNote($userIdentity, $data)) {
					$noteState->addSuccessMessage('New note posted!');
					return $this->redirect()->toRoute('note', array('username' => $userIdentity->getUsername()));
				} else {
					$noteState->addSuccessMessage('Erorr while creating new note. Please try again later!');
					return $this->redirect()->toRoute('note', array('username' => $userIdentity->getUsername()));
				}
			}
		}

		$form->setAttribute('action', $this->url()->fromRoute('note', array('username' => $userProfile->getUsername())));

		$view['user'] = $userProfile;
		$view['noteForm'] = $form;
		$view['notes'] = $paginator;
		$view['isMyNote'] = !empty($userIdentity) ? $userIdentity->getUsername() == $username : false;
		return $view;	
	}

	/**
	 * Create note
	 *
	 * @param object $userIdentity
	 * @param array $data
	 * @return bool
	 */
	protected function createNote($userIdentity, $data)
	{
		$specifiedFeilds = array();
		$specifiedFeilds['userId'] = $userIdentity->getId();
		$specifiedFeilds['note'] = $data['note'];

		$response = ApiClient::createNote($specifiedFeilds);
		return $response['result'];
	}
}