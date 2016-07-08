<?php

class RegistrationPresenter extends BasePresenter{
	// Promeny
	
	// Konstruktor
	public function __construct(Nette\Database\Connection $database, Nette\Security\User $storage, Nette\Http\Request $url){
		parent::__construct($database, $storage, $url);
		$this->database = new RegistrationModel($database);
	}
	// Metody

}