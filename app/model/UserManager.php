<?php

namespace Model;

use Nette,
	Nette\Utils\Strings;


/**
 * Users management.
 */
class UserManager extends Nette\Object implements Nette\Security\IAuthenticator
{
	const
		TABLE_NAME = 'users',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'username',
		COLUMN_PASSWORD = 'password',
		COLUMN_ROLE = 'role',
		PASSWORD_MAX_LENGTH = 4096;


	/** @var Nette\Database\Context */
	private $database;


	/**
	 * @param Nette\Database\Context
	 */
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


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
			throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);

		} elseif (!self::verifyPassword($password, $row[self::COLUMN_PASSWORD])) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);

		} elseif (PHP_VERSION_ID >= 50307 && substr($row[self::COLUMN_PASSWORD], 0, 3) === '$2a') {
			$row->update(array(
				self::COLUMN_PASSWORD => self::hashPassword($password),
			));
		}

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD]);
		return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
	}


	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @return void
	 */
	public function add($username, $password)
	{
		$this->database->table(self::TABLE_NAME)->insert(array(
			self::COLUMN_NAME => $username,
			self::COLUMN_PASSWORD => self::hashPassword($password),
		));
	}


	/**
	 * Computes salted password hash.
	 * @param  string
	 * @return string
	 */
	public static function hashPassword($password, $options = NULL)
	{
		if ($password === Strings::upper($password)) { // perhaps caps lock is on
			$password = Strings::lower($password);
		}
		$password = substr($password, 0, self::PASSWORD_MAX_LENGTH);
		$options = $options ?: implode('$', array(
			'algo' => PHP_VERSION_ID < 50307 ? '$2a' : '$2y', // blowfish
			'cost' => '07',
			'salt' => Strings::random(22),
		));
		return crypt($password, $options);
	}


	/**
	 * Verifies that a password matches a hash.
	 * @return bool
	 */
	public static function verifyPassword($password, $hash)
	{
		return self::hashPassword($password, $hash) === $hash
			|| (PHP_VERSION_ID >= 50307 && substr($hash, 0, 3) === '$2a' && self::hashPassword($password, $tmp = '$2x' . substr($hash, 3)) === $tmp);
	}

}
