#!/bin/sh

echo "DevOps provisioning: nginx"

# web server
if ! which nginx > /dev/null 2>&1; then
	sudo apt-get install -y nginx
fi

# add user to group: www-data
sudo usermod -a -G www-data vagrant

rm /etc/nginx/sites-available/*
rm /etc/nginx/sites-enabled/*

sudo service nginx restart
clear

echo "-+-+-+- software versions:"
nginx -v

echo "-+-+-+- service status:"
service nginx status
exit