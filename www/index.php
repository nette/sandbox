<?php

$params = array();

// absolute filesystem path to this web root
$params['wwwDir'] = __DIR__;

// absolute filesystem path to the application root
$params['appDir'] = realpath(__DIR__ . '/../app');

// uncomment this line if you must temporarily take down your site for maintenance
// require $params['appDir'] . '/templates/maintenance.phtml';

// load bootstrap file
require $params['appDir'] . '/bootstrap.php';
