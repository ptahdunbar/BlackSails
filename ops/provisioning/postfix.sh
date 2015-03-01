#!/bin/sh

usage() { echo "Bad usage" 1>&2; exit 1; }

while getopts ":s:p:h:u:" o; do
    case "${o}" in
        s)
            SMTP_PORT=$(echo "$OPTARG" | sed 's/=//')
            ;;
        h)
            SMTP_HOST=$(echo "$OPTARG" | sed 's/=//')
            ;;
        u)
            USERNAME=$(echo "$OPTARG" | sed 's/=//')
            ;;
        p)
            PASSWORD=$(echo "$OPTARG" | sed 's/=//')
            ;;
        *)
            usage
            ;;
    esac
done
shift $((OPTIND-1))

if [ -z "${SMTP_PORT}" ] || [ -z "${SMTP_HOST}" ] || [ -z "${USERNAME}" ] || [ -z "${PASSWORD}" ]; then
    usage
fi

# Postfix
# Note that if your current Internet connection does not allow communication
# over port 25, you will not be able to send mail, even with postfix installed.
echo "postfix postfix/main_mailer_type string 'Internet Site'" | sudo debconf-set-selections
echo "postfix postfix/mailname string $(hostname -f)" | sudo debconf-set-selections

sudo apt-get -y install postfix mailutils libsasl2-2 ca-certificates libsasl2-modules

# Disable ipv6 as some ISPs/mail servers have problems with it
#sudo sed -i 's/inet_protocols = all/inet_protocols = ipv4/g' /etc/postfix/main.cf
sudo sed -i 's/inet_interfaces = all/inet_interfaces = loopback-only/g' /etc/postfix/main.cf
sudo sed -i '/mydestination/d' /etc/postfix/main.cf && sudo echo "mydestination=" >> /etc/postfix/main.cf
sudo sed -i '/relayhost/d' /etc/postfix/main.cf && sudo echo "relayhost = [smtp.gmail.com]:587" >> /etc/postfix/main.cf

if ! grep -lq "smtp_sasl_auth_enable" /etc/postfix/main.cf; then
	echo "smtp_sasl_auth_enable = yes" >> /etc/postfix/main.cf
	echo "smtp_sasl_password_maps = hash:/etc/postfix/sasl_passwd" >> /etc/postfix/main.cf
	echo "smtp_sasl_security_options = noanonymous" >> /etc/postfix/main.cf
	echo "smtp_tls_CAfile = /etc/postfix/cacert.pem" >> /etc/postfix/main.cf
	echo "smtp_use_tls = yes" >> /etc/postfix/main.cf
fi

sudo echo "[$SMTP_HOST]:$SMTP_PORT $USERNAME:$PASSWORD" > /etc/postfix/sasl_passwd

sudo postmap /etc/postfix/sasl_passwd
cat /etc/ssl/certs/Thawte_Premium_Server_CA.pem | sudo tee -a /etc/postfix/cacert.pem

sudo chown root:root /etc/postfix/sasl_passwd /etc/postfix/sasl_passwd.db
sudo chmod 0600 /etc/postfix/sasl_passwd /etc/postfix/sasl_passwd.db

sudo service postfix restart
