<?php

namespace Test;

use Nette;
use Tester;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class HomepagePresenterTest extends Tester\TestCase
{
	use \Testbench\TPresenter;

	function testHomepageAction()
	{
		$response = $this->checkAction('Homepage:');
		Assert::type('Nette\Application\Responses\TextResponse', $response);
	}

}


$test = new HomepagePresenterTest();
$test->run();
