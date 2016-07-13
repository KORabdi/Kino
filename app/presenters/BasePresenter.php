<?php

use Nette\Database\Connection;
/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    protected $user;
    protected $httpRequest;
    protected $database;
    protected $requestValidation;
    
    public function __construct(Nette\Database\Connection $database, Nette\Security\User $storage, Nette\Http\Request $url)
    {
    	$this->user = $storage;
    	$this->httpRequest = $url;
    }
    
    public function sendAPIResponse($movie){
    	$this->sendResponse(new Nette\Application\Responses\JsonResponse($movie));
    }
    
    //TODO: Send API Error
    
    public function checkUserLogin(){
        if (!$this->user->isLoggedIn()) {
            sendAPIError('User is not logged');
        }
    }
}
