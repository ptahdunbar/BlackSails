#!/bin/sh

echo "DevOps provisioning: php"

# PHP
sudo apt-get -y install php5-fpm php5-mysql php5-cli
sudo apt-get -y install php5-curl php5-gd php5-imagick php5-mcrypt php5-memcache php5-ps php5-sqlite php5-tidy php5-xmlrpc php5-xsl libapache2-mod-php5

# php.ini
sudo sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' /etc/php5/fpm/php.ini

sudo sed -i 's/display_errors = Off/display_errors = On/g' /etc/php5/fpm/php.ini
sudo sed -i 's/display_startup_errors = Off/display_startup_errors = On/g' /etc/php5/fpm/php.ini
sudo sed -i 's/expose_php = On/expose_php = Off/g' /etc/php5/fpm/php.ini

#sudo sed -i 's/post_max_size = 8M/post_max_size = 8M/g' /etc/php5/fpm/php.ini
#sudo sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 8M/g' /etc/php5/fpm/php.ini
#sudo sed -i 's/memory_limit = 128M/memory_limit = 128M/g' /etc/php5/fpm/php.ini

# php.ini: opcache
#sudo sed -i 's/;opcache.enable=0/opcache.enable=1/g' /etc/php5/fpm/php.ini
#sudo sed -i 's/;opcache.memory_consumption=64/opcache.memory_consumption=128/g' /etc/php5/fpm/php.ini
#sudo sed -i 's/;opcache.interned_strings_buffer=4/opcache.interned_strings_buffer=8/g' /etc/php5/fpm/php.ini
#sudo sed -i 's/;opcache.max_accelerated_files=2000/opcache.max_accelerated_files=4000/g' /etc/php5/fpm/php.ini
#sudo sed -i 's/;opcache.revalidate_freq=2/opcache.revalidate_freq=4000/g' /etc/php5/fpm/php.ini
#sudo sed -i 's/;opcache.fast_shutdown=0/opcache.fast_shutdown=1/g' /etc/php5/fpm/php.ini
#sudo sed -i 's/;opcache.enable_cli=0/opcache.enable_cli=1/g' /etc/php5/fpm/php.ini

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