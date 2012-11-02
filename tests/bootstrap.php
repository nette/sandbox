<?php

require __DIR__ . '/../libs/autoload.php';

if (!include __DIR__ . '/../libs/Nette/tester/Tester/bootstrap.php') {
	die('Install Nette Tester using `composer update --dev`');
}

function id($val) {
	return $val;
}

$configurator = new Nette\Config\Configurator;
$configurator->setDebugMode(FALSE);
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(__DIR__ . '/../app')
	->register();

$configurator->addConfig(__DIR__ . '/../app/config/config.neon');
$configurator->addConfig(__DIR__ . '/../app/config/config.local.neon', $configurator::NONE); // none section
return $configurator->createContainer();
