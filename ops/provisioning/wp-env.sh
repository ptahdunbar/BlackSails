#!/bin/sh

# get the value of WP_ENV or die
if [ -f .env ]; then
	source .env 2> /dev/null
	echo $WP_ENV
else
	echo "WP_ENV not defined yet."
	exit 1
fi