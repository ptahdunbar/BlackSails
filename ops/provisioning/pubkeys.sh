#!/bin/sh

if [ -z $1 ]; then
	echo "no users are passed in.\n";
	exit 1
fi

for zeUser in "$@"
do
	echo "[github_ssh_keys]: $zeUser"

	if [ ! -e /home/$zeUser ]; then
		sudo useradd -d /home/$zeUser $zeUser
	fi

	## create new non-root user
	sudo usermod -a -G www-data $zeUser
	sudo mkdir -p /home/$zeUser/.ssh

	if [ ! -e ~/$zeUser.keys ]; then
		sudo wget https://github.com/$zeUser.keys
	fi

	if [ -e ~/$zeUser.keys ]; then
		sudo cat $zeUser.keys > /home/$zeUser/.ssh/authorized_keys
	fi

	sudo chown -R $zeUser: /home/$zeUser
	sudo chmod 600 /home/$zeUser/.ssh/authorized_keys
	sudo chmod 700 /home/$zeUser/.ssh/
done

echo "[github_ssh_keys]: successfully completed :)"
exit