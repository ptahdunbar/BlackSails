.DEFAULT_GOAL := all

PROTECTED_FILE=.env
COMPOSER ?= './composer.phar'

.PHONY: all
all: help composer_install composer

help:
	@printf "\033[36m        _    __                               					\n"
	@printf "\033[36m        \    /|_)  (_ |  _ | _ _|_  _ ._    /\ ._ ._ 	\n"
	@printf "\033[36m         \/\/ |    __)|<(/_|(/_ |_ (_)| |  /--\|_)|_)	\n"
	@printf "\033[36m                                               |  |		\n"
	@printf "\033[m\n"

composer_install:
	if [ ! -e './composer.phar' ]; then \
		php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; \
		php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"; \
		php composer-setup.php; \
		php -r "unlink('composer-setup.php');"; \
	fi

composer:
	$(COMPOSER) install

# to create an encrypted file
open:
	openssl cast5-cbc -d -in ${PROTECTED_FILE}.encrypted -out ${PROTECTED_FILE}
	chmod 600 ${PROTECTED_FILE}

# for decrypt an encrypted file
close:
	openssl cast5-cbc -e -in ${PROTECTED_FILE} -out ${PROTECTED_FILE}.encrypted
