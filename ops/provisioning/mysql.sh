#!/bin/sh

echo "DevOps provisioning: MySQL"

# MySQL
if ! mysql --version > /dev/null 2>&1; then
	sudo DEBIAN_FRONTEND=noninteractive apt-get -y -q install mysql-server mysql-client
fi

# update root password
mysqladmin -uroot -proot password root

# my.cnf
sudo sed -i 's/127.0.0.1/0.0.0.0/g' /etc/mysql/my.cnf

clear

echo "-+-+-+- software versions:"
mysql --version

echo "-+-+-+- service status:"
service mysql status
exit