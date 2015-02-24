#!/bin/sh

echo "DevOps provisioning: app"

mysql -uroot -proot -e "DROP DATABASE IF EXISTS wordpress;"
mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS wordpress;"

ln -s /srv/config/apache/vhost.conf /etc/apache2/sites-enabled/pressvarrs.dev
#ln -s /srv/ops/nginx/vhost.conf /etc/nginx/sites-enabled/pressvarrs.dev

sudo service apache2 restart

if [ ! -f /srv/.env ]; then
	cp /srv/.env.defaults /srv.env
fi