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
}
