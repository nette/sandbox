#!/usr/bin/env bash

add-apt-repository ppa:ondrej/php -y

apt-get update

apt-get install -y \
	nginx \
	php-fpm \
	composer

if ! [ -L "/var/www/nette-sandbox.vagrant" ]; then
	rm -rf "/var/www/nette-sandbox.vagrant"
	ln -fs "/vagrant" "/var/www/nette-sandbox.vagrant"
fi

if ! [ -L "/etc/nginx/sites-enabled/nette-sandbox.vagrant" ]; then
	rm -rf "/etc/nginx/sites-enabled/nette-sandbox.vagrant"
	ln -fs "/vagrant/server/etc/nginx/sites-available/nette-sandbox.vagrant" "/etc/nginx/sites-enabled/nette-sandbox.vagrant"
fi

cd "/vagrant"
composer install
