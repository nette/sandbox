<?php

// uncomment this line if you must temporarily take down your site for maintenance
// require '.maintenance.php';

// absolute filesystem path to this web root
$params['wwwDir'] = __DIR__;

// absolute filesystem path to the application root
$params['appDir'] = realpath(__DIR__ . '/../app');

// load bootstrap file
require $params['appDir'] . '/bootstrap.php';
