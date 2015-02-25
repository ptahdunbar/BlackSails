#!/bin/sh

IP=$(vagrant awsinfo -m pressvarrs -k public_ip | grep -oE "\b([0-9]{1,3}\.){3}[0-9]{1,3}\b")

echo "Updating .env values with the AWS Public IP: $IP"

# remove existing values
sed -i '' -e '/WP_HOME/d' .env
sed -i '' -e '/WP_SITEURL/d' .env

# add new values
echo "\n" >> .env
echo "WP_HOME=http://$IP" >> .env
echo "WP_SITEURL=http://$IP/wp" >> .env
