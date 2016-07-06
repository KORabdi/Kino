<?php

class BaseModel{
	
	protected $database;
	
	public function __construct(Nette\Database\Connection $database)
	{
		$this->database = $database;
	}
}