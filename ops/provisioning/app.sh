#!/bin/sh

echo "DevOps provisioning: app"

# add user to group: virtualbox
if [ -f /home/vagrant ]; then
	sudo usermod -a -G www-data vagrant
fi

# add user to group: aws
if [ -f /home/ubuntu ]; then
	sudo usermod -a -G www-data ubuntu
fi

# Create db
mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS wordpress;"

# Link up vhost file
ln -s /srv/ops/apache.vhost.conf /etc/apache2/sites-enabled/pressvarrs
#ln -s /srv/ops/nginx.vhost.conf /etc/nginx/sites-enabled/pressvarrs

# setup the .env file
if [ ! -e /srv/.env ]; then
	echo "Created .env config file! Please review before continuing."
	cp /srv/.env.defaults /srv/.env
fi

# reboot for any changes
sudo service apache2 restart