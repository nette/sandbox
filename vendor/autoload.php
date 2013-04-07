<?php

// This is default autoload.php. It can be overwritten by Composer.

if (!is_file(__DIR__ . '/../libs/Nette/loader.php')) {
	die("Nette Framework is expected to be in directory '" . dirname(__DIR__) . "/libs/Nette' but not found. Check if the path is correct or edit file '" . __FILE__ . "'.");
}

require __DIR__ . '/../libs/Nette/loader.php';
