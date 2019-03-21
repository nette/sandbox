<?php

declare(strict_types=1);

namespace App\Router;


final class RouterFactory
{
	public static function createRouter(): \Nette\Application\Routers\RouteList
	{
		$router = new \Nette\Application\Routers\RouteList();
		$router[] = new \Nette\Application\Routers\Route('<presenter>/<action>', 'Homepage:default');
		return $router;
	}
}
