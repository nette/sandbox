Nette Framework Sandbox
=======================

The basic skeleton of application.


What is [Nette Framework](http://nette.org)?
--------------------------------------------

Nette Framework is a popular tool for PHP web development. It is designed to be
the most usable and friendliest as possible. It focuses on security and
performance and is definitely one of the safest PHP frameworks.

Nette Framework speaks your language and helps you to easily build better websites.


Installing
----------

The best way to install Nette Framework is to download latest package
from http://nette.org/download or create new project using Composer:

1. Install Composer: (see http://getcomposer.org/download)

		curl -s http://getcomposer.org/installer | php

2. Create new project via Composer:

		php composer.phar create-project nette/sandbox myApplication dev-master
		cd myApplication

Make directories `temp` and `log` writable. Navigate your browser
to the `www` directory and you will see a welcome page. PHP 5.4 allows
you run `php -S localhost:8888 -t www` to start the webserver and
then visit `http://localhost:8888` in your browser.


It is CRITICAL that file `app/config/config.neon` & whole `app`, `log`
and `temp` directory are NOT accessible directly via a web browser! If you
don't protect this directory from direct web access, anybody will be able to see
your sensitive data. See [security warning](http://nette.org/security-warning).
