wget -O - https://download.newrelic.com/548C16BF.gpg | sudo apt-key add -

sudo sh -c 'echo "deb http://apt.newrelic.com/debian/ newrelic non-free" > /etc/apt/sources.list.d/newrelic.list'

sudo apt-get update
sudo apt-get install newrelic-php5
sudo newrelic-install install

echo newrelic.license="6afb302ecf8f306d1d78190da805807e1b28ed7e" > /etc/php5/apache2/conf.d/newrelic.conf