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
		$userName = $this->check('name');
		if($this->database->isUserExisting('name',$userName)){
			$this->sendAPIResponse(array('error' => 'User name '.$userName.' already taken'));
		}
		$userPassword = $this->check('password');
		$userPassword = sha1($userPassword.$this->userLogIn->user_salt);
		$userEmail = $this->check('email');
		if($this->database->isUserExisting('email',$userEmail)){
			$this->sendAPIResponse(array('error' => 'User name '.$userName.' already taken'));
		}
		if($this->database->createUser($userName,$userPassword,$userEmail)){
			$this->sendAPIResponse(array('success' =>'User '.$userName.' is successfully created'));
		}else{
			$this->sendAPIResponse(array('error' => 'User '.$userName.' already exists'));
		}
	}
}
