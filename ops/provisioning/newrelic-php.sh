# https://docs.newrelic.com/docs/agents/php-agent

ENV=/var/www/.env

if [[ -e $ENV ]]; then
    echo "Sourcing $ENV"
    source $ENV
else
    echo "Failed to load env settings"
    exit 1
fi

if [[ -n "$NEW_RELIC_APP_NAME" || -n $NEW_RELIC_LICENSE_KEY ]]; then
    echo "Updating New Relic application name"
    echo newrelic-php5 newrelic-php5/application-name string "$NEW_RELIC_APP_NAME" | debconf-set-selections

    echo "Updating New Relic license key"
    echo newrelic-php5 newrelic-php5/license-name string "$NEW_RELIC_LICENSE_KEY" | debconf-set-selections

#    echo "newrelic.license=\"$NEW_RELIC_LICENSE_KEY\"" > /etc/php5/apache2/conf.d/newrelic.conf
fi


wget -O - https://download.newrelic.com/548C16BF.gpg | sudo apt-key add -
sudo sh -c 'echo "deb http://apt.newrelic.com/debian/ newrelic non-free" > /etc/apt/sources.list.d/newrelic.list'
sudo apt-get update
sudo apt-get install -y newrelic-php5
sudo newrelic-install install