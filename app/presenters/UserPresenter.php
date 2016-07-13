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
            $method = $this->httpRequest->getMethod();
            $this->requestValidation = new requestValid();
            $this->requestValidation->setMethod($method);
            $this->requestValidation->checkPost();
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
            // Getting POST params from request
            $userName = $this->httpRequest->getPost('name');
            $userPassword = $this->httpRequest->getPost('password');
            $userEmail = $this->getRequestParam('email');
            
            // Validate them
            $validation = $this->requestValidation;
            $validation->checkName($userName);
            $validation->checkPassword($userPassword);
            $validation->checkEmail($userEmail);
            
            self::isUserExisting($userName,'name');
            self::isUserExisting($userEmail,'email');
            $userPasswordHashed = $this->auth->getUserPassword($userPassword); 
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
