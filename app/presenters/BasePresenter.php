<?php

use Nette\Database\Connection;
/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    protected $user;
    protected $httpRequest;
    protected static $user_salt = "AEcx199opQ";
    protected $database;
    
    public function __construct(Nette\Database\Connection $database, Nette\Security\User $storage, Nette\Http\Request $url)
    {
    	$this->user = $storage;
    	$this->httpRequest = $url;
    }
    
    public function sendAPIResponse($movie){
    	$this->sendResponse(new Nette\Application\Responses\JsonResponse($movie));
    }
    
    public function checkPost(){
        if($this->httpRequest->getMethod() != 'POST'){
            sendAPIError('Wrong method');
        }
    }
        
    public function checkUserLogin(){
        if (!$this->user->isLoggedIn()) {
            sendAPIError('User is not logged');
        }
    }
    
    public function getRequestParam($name,$check = array()){
        $param = $this->httpRequest->getPost($name);
        if(is_null($param) && array_key_exists('empty', $check)){
            sendAPIError('Param '.$name.' is empty');
        }
        if(is_numeric($param) && array_key_exists('int', $check)){
            sendAPIError('Param '.$name.'is not number');
        }
        if(is_string($param) && array_key_exists('string', $check)){
            sendAPIError('Param '.$name.'is not string');
        }
        return $param;
    }   
}
