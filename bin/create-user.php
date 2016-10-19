<?php

if (!isset($_SERVER['argv'][3])) {
	echo '
Add new user to database.

Usage: create-user.php <name> <email> <password>
';
	exit(1);
}

list(, $name, $email, $password) = $_SERVER['argv'];

$container = require __DIR__ . '/../app/bootstrap.php';
/** @var App\Model\UserManager $manager */
$manager = $container->getByType(App\Model\UserManager::class);

try {
	$manager->add($name, $email, $password);
	echo "User $name was added.\n";

} catch (App\Model\DuplicateNameException $e) {
	echo "Error: duplicate name.\n";
	exit(1);
}
