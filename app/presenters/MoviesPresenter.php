<?php
class MoviePresenter extends BasePresenter
{	
	public function __construct(Nette\Database\Connection $database, Nette\Security\User $storage, Nette\Http\Request $url){
		parent::__construct($database,$storage,$url);
		$this->database = new MovieModel($database);
	}
	public function renderDefault()
	{
			$translations = $this->database->getMovies();
			$this->sendAPIResponse($translations);
	}
}
