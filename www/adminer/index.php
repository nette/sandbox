<?php

$root = __DIR__ . '/../../libs/dg/adminer-custom';

if (!is_file($root . '/index.php')) {
	echo "Install Adminer using `composer update`\n";
	exit(1);
}


if (isset($_GET['file'])) {
	$file = $_GET['file'];
	if (preg_match('#^(?:static/)?[\w.-]+\.(\w+)$#', $file, $m) && is_file("$root/$file")) {

		if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
			header('HTTP/1.1 304 Not Modified');
			exit;
		}

		header('Expires: ' . gmdate('D, d M Y H:i:s', strtotime('1 month')) . ' GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

		if ($m[1] === 'css') {
			header('Content-Type: text/css; charset=utf-8');
		} elseif ($m[1] === 'js') {
			header('Content-Type: text/javascript; charset=utf-8');
		} elseif ($m[1] === 'gif' || $m[1] === 'png' ||$m[1] === 'jpg') {
			header("Content-Type: image/$m[1]");
		}
		include "$root/$file";
		exit;
	}
}


include $root . '/index.php';
