#!/bin/sh

echo "DevOps provisioning: base"
date > /etc/vagrant_provisioned_at

if [ ! -e "~/.provisioned_at" ]; then
	sudo apt-get update
	#sudo apt-get update && sudo apt-get -y upgrade && sudo apt-get -y dist-upgrade && sudo apt-get -y autoremove
	touch .provisioned_at
fi

# Set the Server Timezone to CST
echo "America/New_York" > /etc/timezone
dpkg-reconfigure -f noninteractive tzdata

# tools
sudo apt-get -y install python-software-properties python-setuptools
sudo apt-get -y install vim htop debconf-utils
sudo apt-get -y install git-core subversion
sudo apt-get -y install ntp
sudo apt-get -y install cachefilesd
sudo echo "RUN=yes" > /etc/default/cachefilesd

# see http://docs.moodle.org/dev/Table_of_locales
LOCALE_LANGUAGE="en_US"
LOCALE_CODESET="en_US.UTF-8"
sudo locale-gen $LOCALE_LANGUAGE $LOCALE_CODESET

echo "-+-+-+- software versions:"
git --version

exit