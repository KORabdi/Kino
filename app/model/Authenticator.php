<?php

use Nette\Security,
	Nette\Utils\Strings;


/**
 * Users authenticator.
 */
class Authenticator extends BaseModel implements Security\IAuthenticator
{
	const
		TABLE_NAME = 'users',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'name',
		COLUMN_PASSWORD = 'password',
		COLUMN_ROLE = 'role';
	public static $user_salt = "AEcx199opQ";

	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();

		if (!$row) {
			throw new Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);

		} elseif (sha1($password . self::$user_salt)!=$row[self::COLUMN_PASSWORD]) {
			throw new Security\AuthenticationException('The password is incorrect ', self::INVALID_CREDENTIAL);
		}
		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD]);
		return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
	}
	
	public function getUserPassword($input){
		return sha1($input . self::$user_salt);
	}

}
