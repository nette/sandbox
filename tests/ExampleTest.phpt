<?php

namespace Test;

use Nette;
use Tester;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';


/**
 * @testCase
 */
class ExampleTest extends Tester\TestCase
{
	use \Testbench\TCompiledContainer;

	private $container;


	function setUp()
	{
		$this->container = $this->getContainer();
	}


	function testSomething()
	{
		Assert::true(TRUE);
	}

}


$test = new ExampleTest();
$test->run();
