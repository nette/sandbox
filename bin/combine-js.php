<?php

$combinedFile = __DIR__ . '/../www/js/combined.js';


// concatenate
if (!is_file("$combinedFile.src")) {
	echo "Missing source file $combinedFile.src\n";
	exit(1);
}

$code = '';
echo "Concatenating\n";
foreach (file("$combinedFile.src", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $file) {
	if (strpos($file, '/') === FALSE) {
		$file = dirname($combinedFile) . '/' . $file;
	}
	echo "$file\n";
	$content = file_get_contents($file);
	if (!$content) {
		echo "Missing file $file\n";
		exit(1);
	}
	$code .= $content . "\n";
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
