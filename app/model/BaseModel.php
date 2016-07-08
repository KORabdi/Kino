<?php

class BaseModel extends Nette\Object{
	
	protected $database;
	
	public function __construct(Nette\Database\Connection $database)
	{
		$this->database = $database;
	}
}