<?php


/**
 * Users authenticator.
 */
class Authenticator extends BaseModel
{
	const
		TABLE_NAME = 'users',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'name',
		COLUMN_PASSWORD = 'password',
		COLUMN_ROLE = 'role';
	public static $user_salt = "AEcx199opQ";

	public function authenticate($username,$password)
	{
		$row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();
		if (!$row) {
			return NULL;

		} elseif (sha1($password . self::$user_salt)!=$row[self::COLUMN_PASSWORD]) {
			return FALSE;
		}
		return TRUE;
	}

}
