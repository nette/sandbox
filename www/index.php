<?php

declare(strict_types=1);

if (PHP_VERSION_ID < 70400) {
	exit('Nette Sandbox requires a PHP version 7.4 or newer. You are running ' . PHP_VERSION . '.');
}

require __DIR__ . '/../vendor/autoload.php';

$configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();
$application = $container->getByType(Nette\Application\Application::class);
$application->run();
