<?php
use Nette\Security\User;
/**
 * Homepage presenter.
*/
class UserPresenter extends BasePresenter
{
	public function __construct(Nette\Database\Connection $database, Nette\Security\User $storage, Nette\Http\Request $url){
		parent::__construct($database,$storage,$url);
		$this->database = new UserModel($database);
		/*if($this->httpRequest->getMethod() != 'POST'){
			$this->error('Wrong request',Nette\Http\Response::S400_BAD_REQUEST);
			exit;
		}*/
	}
	public function renderLogin(){	
		$name = $this->httpRequest->getPost('name');
		$password = $this->httpRequest->getPost('password');
		$hashedPassword = sha1($password.self::$user_salt);
		$row = $this->database->getUserByName($name);
		if (!$row) {
			$this->sendAPIResponse(array('error'=>'The username is incorrect.'));
			exit;
		} elseif ($hashedPassword != $row['password']) {
			$this->sendAPIResponse(array('error'=>'The password is incorrect '));
			exit;
		}
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
		if($this->httpRequest=='POST'){
			$userName = $this->httpRequest->getPost('name');
			$userPassword = $this->httpRequest->getPost('password');
			$userEmail = $this->httpRequest->getPost('email');
			if($this->database->createUser($userName,$userPassword,$userEmail)){
				$this->sendAPIRequest(array('success' =>'User '.$userName.' is successfully created'));
			}else{
				$this->sendAPIRequest(array('error' => 'User '.$userName.' already exists'));
			}
		}else{
			$this->sendAPIRequest(array('error'=>'Wrong method'));
		}
	}
}
