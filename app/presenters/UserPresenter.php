<?php
use Nette\Security\User;
/**
 * Homepage presenter.
*/
class UserPresenter extends BasePresenter
{
	private $userLogIn;
	public function __construct(Nette\Database\Connection $database, Nette\Security\User $storage, Nette\Http\Request $url){
		parent::__construct($database,$storage,$url);
		$this->database = new UserModel($database);
		$this->userLogIn = new Authenticator($database);
		if($this->httpRequest->getMethod() != 'POST'){
			$this->error('Wrong request',Nette\Http\Response::S400_BAD_REQUEST);
			exit;
		}
	}
	
	public function renderLogin(){	
		$name = $this->httpRequest->getPost('name');
		$password = $this->httpRequest->getPost('password');
		if($this->userLogIn->authenticate(array($name,$password)))
			$this->user->login($name,$password);
		$this->sendAPIResponse(array('status' => $this->user->isLoggedIn()));
	}
	
	public function renderLogout(){
		$this->user->logout();
		$this->sendAPIResponse(array('status'=>$this->user->isLoggedIn()));
	}
	
	public function renderReservations()
	{
		if ($this->user->isLoggedIn()) {
			$idUser = $this->user->getIdentity()->getId();
			$a = $this->database->getUserReservations($idUser);
			$this->sendAPIResponse($a);
		} else {
			$this->sendAPIResponse($a = array('error' => 'You need log in'));
		}
	}
	
	public function renderRegistration(){
		$userName = self::checkUserData('name');
		$userPassword = $this->checkHttpRequest('password');
		$userPassword = $this->userLogIn->getUserPassword($userPassword);
		$userEmail = self::checkUserData('email');
		if($this->database->createUser($userName,$userPassword,$userEmail)){
			$this->sendAPIResponse(array('success' =>'User '.$userName.' is successfully created'));
		}else{
			$this->sendAPIResponse(array('error' => 'User '.$userName.' already exists'));
		}
	}
	
	public function checkUserData($input){
		$userInput = $this->checkHttpRequest($input);
		if($this->database->isUserExisting($input,$userInput)){
			$this->sendAPIResponse(array('error' => $userInput.' already taken'));
		}
		return $userInput;
	}
}
