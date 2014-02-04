<?php

if (!isset($_SERVER['argv'][2])) {
	echo '
Add new user to database.

Usage: create-user.php <name> <password>
';
	exit(1);
}

list(, $user, $password) = $_SERVER['argv'];

$container = require __DIR__ . '/../app/bootstrap.php';
$container->getByType('App\UserManager')->add($user, $password);

echo "User $user was added.\n";
