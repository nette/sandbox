<?php


/**
 * Model base class.
 */
class Model extends Nette\Object
{
	/** @var Nette\Database\Connection */
	public $database;



	public function __construct(Nette\Database\Connection $database)
	{
		$this->database = $database;
	}



	public function createAuthenticatorService()
	{
		return new Authenticator($this->database->table('users'));
	}

}
