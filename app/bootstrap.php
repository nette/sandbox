<?php

/**
 * My Application bootstrap file.
 */
use Nette\Diagnostics\Debugger,
	Nette\Application\Routers\Route;


// Load Nette Framework
require LIBS_DIR . '/Nette/loader.php';


// Enable Nette Debugger for error visualisation & logging
Debugger::$logDirectory = __DIR__ . '/../log';
Debugger::$strictMode = TRUE;
Debugger::enable();


// Configure application
$configurator = new Nette\Configurator;
$configurator->container->params['tempDir'] = __DIR__ . '/../temp';

// Create Dependency Injection container from config.neon file
$container = $configurator->loadConfig(__DIR__ . '/config.neon');


// Setup router
$router = $container->router;
$router[] = new Route('index.php', 'Homepage:default', Route::ONE_WAY);
$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');


// Configure and run the application!
$application = $container->application;
//$application->catchExceptions = TRUE;
$application->errorPresenter = 'Error';
$application->run();
