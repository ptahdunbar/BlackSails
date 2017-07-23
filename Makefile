.DEFAULT_GOAL := all

PROTECTED_FILE=.env
COMPOSER ?= 'composer'

.PHONY: all
all: help open i

help:
	@printf "\033[36m        _    __                               					\n"
	@printf "\033[36m        \    /|_)  (_ |  _ | _ _|_  _ ._    /\ ._ ._ 	\n"
	@printf "\033[36m         \/\/ |    __)|<(/_|(/_ |_ (_)| |  /--\|_)|_)	\n"
	@printf "\033[36m                                               |  |		\n"
	@printf "\033[m\n"

i:
	$(COMPOSER) install

d:
	$(COMPOSER) update

# to create an encrypted file
open:
	openssl cast5-cbc -d -in ${PROTECTED_FILE}.encrypted -out ${PROTECTED_FILE}
	chmod 600 ${PROTECTED_FILE}

# for decrypt an encrypted file
close:
	openssl cast5-cbc -e -in ${PROTECTED_FILE} -out ${PROTECTED_FILE}.encrypted
