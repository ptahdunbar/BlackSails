# WP

> This is a work in progress. Subject to sweeping changes at random intervals until the 1.0.0 :)

## Installation (in three easy steps!)

0. Clone the repository

```
git clone https://github.com/ptahdunbar/wp.git .
```

1. Download dependencies via composer (runs `composer install`)

```
make
```

2. Configure the site with environment variables

###### Choice 0: Convert protected env file `.env.encrypted` to `.env`
```
make env
```

* Default password is `WordPress` 

###### Choice 1: Start fresh, convert `.env.template` to `.env`
```
make reset
```
* run `make lock` to save `.env` to `.env.encrypted`


###### Choice 2: Pass environment settings in via apache
```
SetEnv DB_NAME wordpress
SetEnv DB_USER root
SetEnv DB_PASSWORD root
SetEnv WP_HOME http://wp.dev
SetEnv WP_ENV development

# Multisite support (sub directory)
SetEnv ENABLE_MULTISITE "1"
SetEnv SUBDOMAIN_INSTALL "0"
SetEnv MULTISITE "1"
SetEnv DOMAIN_CURRENT_SITE "wp.dev”
SetEnv PATH_CURRENT_SITE "/"
SetEnv SITE_ID_CURRENT_SITE "1"
SetEnv BLOG_ID_CURRENT_SITE "1"
```

###### Choice 3: Pass environment settings in via nginx
```
fastcgi_param DB_NAME "wordpress";
fastcgi_param DB_USER "root";
fastcgi_param DB_PASSWORD "root";
fastcgi_param WP_HOME "http://wp.dev";
fastcgi_param WP_ENV "development";

# Multisite support (sub directory)
fastcgi_param ENABLE_MULTISITE "1";
fastcgi_param SUBDOMAIN_INSTALL "0";
fastcgi_param MULTISITE "1";
fastcgi_param DOMAIN_CURRENT_SITE "wp.dev";
fastcgi_param PATH_CURRENT_SITE "/";
fastcgi_param SITE_ID_CURRENT_SITE "1";
fastcgi_param BLOG_ID_CURRENT_SITE "1";
```

3. All done. Visit the site :D
