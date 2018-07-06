<?php

declare(strict_types=1);

namespace App\Tests;

use Nette;
use Tester;
use Tester\Assert;


$container = require __DIR__ . '/bootstrap.php';


/**
 * @testCase
 */
class ExampleTest extends Tester\TestCase
{
	/** @var Nette\DI\Container $container */
	private $container;


	public function __construct(Nette\DI\Container $container)
	{
		$this->container = $container;
	}


	public function setUp() : void
	{
	}


	public function testSomething() : void
	{
		Assert::true(true);
	}
}

$test = new ExampleTest($container);
$test->run();
