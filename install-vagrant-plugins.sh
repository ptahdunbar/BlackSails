#!/bin/sh

echo "Installing vagrant plugins"

# extra vagrant commands
vagrant plugin install vagrant-exec
vagrant plugin install vagrant-rsync
vagrant plugin install vagrant-pristine

# go faster vagrant
vagrant plugin install vagrant-cachier

# Vbox guest tools fix
vagrant plugin install vagrant-vbguest

# chef
vagrant plugin install vagrant-omnibus

# local dev
vagrant plugin install vagrant-hostsupdater

# providers
vagrant plugin install vagrant-aws
vagrant plugin install vagrant-rackspace
vagrant plugin install vagrant-digitalocean

exit