<?php

use Tracy\Debugger;


/**
 * @return Nette\Callback
 */
function callback($callback, $m = NULL)
{
	return new Nette\Callback($callback, $m);
}


/**
 * Tracy\Debugger::dump() shortcut.
 */
function dump($var)
{
	foreach (func_get_args() as $arg) {
		Debugger::dump($arg);
	}
	return $var;
}


/**
 * Tracy\Debugger::log() shortcut.
 */
function dlog($var = NULL)
{
	if (func_num_args() === 0) {
		Debugger::log(new Exception, 'dlog');
	}
	foreach (func_get_args() as $arg) {
		Debugger::log($arg, 'dlog');
	}
	return $var;
}
