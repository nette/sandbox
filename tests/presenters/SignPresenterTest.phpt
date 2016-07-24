<?php

namespace Test;

use Nette;
use Tester;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class SignPresenterTest extends Tester\TestCase
{
	use \Testbench\TPresenter;
	use \Testbench\TCompiledContainer;

	/** @var Nette\Security\User $user */
	private $user;


	function setUp()
	{
		$this->user = $this->getService('Nette\Security\User');
		try {
			/** @var Nette\Database\Connection $connection */
			$connection = $this->getService('Nette\Database\Connection');
			$connection->query('SELECT 1');
		} catch (Nette\Database\ConnectionException $exc) {
			\Tester\Environment::skip('Please setup databse connection in app/config/config.local.neon first');
		}
	}


	function testSignInAction()
	{
		Assert::false($this->user->isLoggedIn());
		$this->checkAction('Sign:in');
		$this->checkForm('Sign:in', 'signInForm', [
			'username' => 'user',
			'password' => 'password',
		], '/');
		Assert::true($this->user->isLoggedIn());
	}


	function testSignUpAction()
	{
		$this->checkAction('Sign:up');
	}


	function testSignOutAction()
	{
		$this->logIn();
		Assert::true($this->user->isLoggedIn());
		$this->checkAction('Sign:out');
		Assert::false($this->user->isLoggedIn());
	}

}


$test = new SignPresenterTest();
$test->run();
