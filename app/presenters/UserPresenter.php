<?php
use Nette\Security\User;
/**
 * Homepage presenter.
*/
class UserPresenter extends BasePresenter
{
	private $auth;
	public function __construct(Nette\Database\Connection $database, Nette\Security\User $storage, Nette\Http\Request $url){
            parent::__construct($database,$storage,$url);
            $this->database = new UserModel($database);
            $this->auth = new Authenticator($database);
            $this->httpRequest = $url;
	}
        
        public function startup() {
            parent::startup();
            $this->checkPost();
        }


        public function renderLogin(){	
            $name = $this->httpRequest->getPost('name');
            $password = $this->httpRequest->getPost('password');
            self::authorizate($name,$password);
            $this->sendAPIResponse(array('status' => $this->user->isLoggedIn()));
	}
	
	public function renderLogout(){
            $this->user->logout();
            $this->sendAPIResponse(array('status'=>$this->user->isLoggedIn()));
	}
	
	public function renderReservations()
	{
            $this->checkUserLogin();
            $idUser = $this->user->getIdentity()->getId();
            $reservations = $this->database->getUserReservations($idUser);
            $this->sendAPIResponse($reservations);
	}

	public function renderRegistration(){
            $userName = $this->getRequestParam('name',array('empty','string'));
            self::isUserExisting($userName,'name');
            $userPassword = $this->getRequestParam('password',array('empty','password'));
            // TODO: password param
            $userPasswordHashed = $this->auth->getUserPassword($userPassword); 
            $userEmail = $this->getRequestParam('email',array('empty','email'));
            self::isUserExisting($userEmail,'email');
            // TODO: email param PS: Look to Nette\Forms and make something similar with it
            // TODO: Make database maker
            if($this->database->createUser($userName,$userPasswordHashed,$userEmail)){
            	$this->sendAPIResponse(array('success' =>'User '.$userName.' is successfully created'));
            }else{
            	$this->sendAPIError('User '.$userName.' already exists');
            }
	}
	
	public function isUserExisting($input,$param){
            if($this->database->isUserExisting($param,$input)){
                $this->sendAPIError('User already taken');
            }
	}
        
        public function authorizate($name,$password){
            if($this->auth->authenticate(array($name,$password))){
                $this->user->login($name,$password);
            }
        }
}
