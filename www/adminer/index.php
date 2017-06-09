<?php

declare(strict_types=1);

$localhost = ! isset($_SERVER['HTTP_X_FORWARDED_FOR'])
	&& isset($_SERVER['REMOTE_ADDR'])
	&& in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);

if (!$localhost)
{
	$localhost = isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] === 'nette-sandbox.vagrant';
}

if (!$localhost)
{
	header('HTTP/1.1 403 Forbidden');
	echo 'Adminer is available only from localhost';
	for ($i = 2e3; $i; $i--) echo substr(" \t\r\n", rand(0, 3), 1);
	exit;
}


$root = __DIR__ . '/../../vendor/dg/adminer-custom';

if (!is_file($root . '/index.php')) {
	echo "Install Adminer using `composer install`\n";
	exit(1);
}


require $root . '/index.php';
