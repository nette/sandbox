<?php

$wwwBase = __DIR__ . '/../www/js';
$bowerBase = __DIR__ . '/../vendor-assets';
$combinedJs = "$wwwBase/combined.js";
$files = array(
	"$bowerBase/jquery/dist/jquery.js",
	"$bowerBase/nette-forms/src/assets/netteForms.js",
	"$wwwBase/main.js",
);


// concatenate
$code = '';
echo "Concatenating\n";
foreach ($files as $file) {
	if (!is_file($file)) {
		echo "Missing file $file. Did you install it using `bower install`?\n";
		exit(1);
	}
	echo "$file\n";
	$code .= file_get_contents($file) . "\n";
}


// minify
echo "Minifying\n";
$minified = @file_get_contents('http://closure-compiler.appspot.com/compile', FALSE, stream_context_create(array(
	'http' => array(
		'method' => 'POST',
		'header' => 'Content-type: application/x-www-form-urlencoded',
		'content' => 'output_info=compiled_code&js_code=' . urlencode($code),
	)
)));
if ($minified) {
	echo round(strlen($code) / 1024) . "kB -> " . round(strlen($minified) / 1024) . "kB\n";
	$code = $minified;
} else {
	$error = error_get_last();
	echo "Unable to minfy: $error[message]\n";
}


// save
file_put_contents($combinedFile, $code);
echo "Saved to $combinedFile\n";
