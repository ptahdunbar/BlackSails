# Black Sails

> This is a work in progress. Subject to sweeping changes at random intervals until the 1.0.0 :)

### Prerequisites
* [VirtualBox](https://www.virtualbox.org/) or [AWS account](http://aws.amazon.com/) or [DigitalOcean account](http://digitalocean.com/) or [MAMP](https://www.mamp.info/en/) or [WAMP](http://www.wampserver.com/en/).
* Latest version [Vagrant](http://www.vagrantup.com/).

# Install
```
git clone git@github.com:ptahdunbar/BlackSails.git
````

# Getting started with Vagrant
* Start by running the `vagrant` command to test that it's working.
* Next, edit `vagrant.json` and describe/confirm your dev environment (see `Vagrantfile` or [Vagrant.json](https://github.com/ptahdunbar/Vagrant.json)).
* `vagrant up`
* `vagrant up --provider=aws` If you're deploying to AWS.
* `vagrant up --provider=digital_ocean` If you're deploying to digital ocean.

## Vagrant.json

This project makes use of [Vagrant.json](https://github.com/ptahdunbar/Vagrant.json) for environment configuration and provisioning.

## Getting Help

[Submit an issue](https://github.com/ptahdunbar/BlackSails/issues/new) and I can provide further assistance.
