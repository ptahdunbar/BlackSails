#!/bin/sh

echo "DevOps provisioning: php"

# PHP
if ! which php > /dev/null 2>&1; then
	sudo apt-get -y install php5-fpm php5-mysql php5-cli
	sudo apt-get -y install php5-curl php5-gd php5-imagick php5-mcrypt php5-memcache php5-ps php5-sqlite php5-tidy php5-xmlrpc php5-xsl libapache2-mod-php5
fi

# php.ini
sudo sed -i 's/;cgi.fix_pathinfo=0/cgi.fix_pathinfo=1/g' /etc/php5/fpm/php.ini

# composer
if ! which composer > /dev/null 2>&1; then
	curl -sS https://getcomposer.org/installer | php
	sudo mv composer.phar /usr/local/bin/composer
	sudo chown root: /usr/local/bin/composer
	sudo chmod +x /usr/local/bin/composer
fi

# wp-cli
if ! which wp > /dev/null 2>&1; then
	curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
	sudo chmod +x wp-cli.phar
	sudo mv wp-cli.phar /usr/local/bin/wp
	sudo chown root: /usr/local/bin/composer
fi

sudo service php5-fpm restart

clear

echo "-+-+-+- software versions:"
php --version
composer --version
wp --version --allow-root

echo "-+-+-+- service status:"
service php5-fpm status
exit