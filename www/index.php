<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

App\Booting::boot()
	->createContainer()
	->getByType(Nette\Application\Application::class)
	->run();
