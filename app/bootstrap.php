<?php

/**
 * My Application bootstrap file.
 */


use Nette\Diagnostics\Debugger;
use Nette\Environment;
use Nette\Application\Routers\Route;


// Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
require LIBS_DIR . '/Nette/loader.php';


// Enable Nette\Debug for error visualisation & logging
Debugger::$strictMode = TRUE;
Debugger::enable();


// Load configuration from config.neon file
Environment::loadConfig();


// Configure application
$application = Environment::getApplication();
$application->errorPresenter = 'Error';
//$application->catchExceptions = TRUE;


// Setup router
$application->onStartup[] = function() use ($application) {
	$router = $application->getRouter();

	$router[] = new Route('index.php', 'Homepage:default', Route::ONE_WAY);

	$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
};


// Run the application!
$application->run();
