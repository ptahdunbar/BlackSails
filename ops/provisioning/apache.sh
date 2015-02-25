#!/bin/sh

echo "DevOps provisioning: apache2"

# apache2
if ! which apache > /dev/null 2>&1; then
	sudo apt-get install -y apache2 apache2-mpm-worker apache2-utils libapache2-mod-log-slow libapache2-mod-php5 libapache2-mod-upload-progress libapache2-mod-fcgid
	sudo apt-get install -y libapache2-mod-geoip
	sudo a2enmod actions alias rewrite ssl
fi

rm /etc/apache2/sites-available/*  > /dev/null 2>&1
rm /etc/apache2/sites-enabled/*  > /dev/null 2>&1
sudo rm -fr /var/www

sudo ln -s /srv/web /var/www

sudo service apache2 restart

clear

echo "-+-+-+- software versions:"
apache2ctl -v

echo "-+-+-+- service status:"
service apache2 status
exit