<?php
class TranslationsPresenter extends BasePresenter
{	
	public function __construct(Nette\Database\Connection $database, Nette\Security\User $storage, Nette\Http\Request $url){
		parent::__construct($database,$storage,$url);
		$this->database = new TranslationsModel($database);
	}
	public function renderDefault()
	{
			$translations = $this->database->getTranslations();
			$this->sendAPIResponse($translations);
	}
}
