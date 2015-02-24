#!/bin/sh

echo "DevOps provisioning: base"
date > /etc/vagrant_provisioned_at

sudo apt-get update

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

echo "-+-+-+- software versions:"
git --version

exit