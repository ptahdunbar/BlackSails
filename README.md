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

### Choice 0: Convert protected env file `.env.encrypted` to `.env`
```
make env
```

* Default password is `WordPress` 

### Choice 1: Start fresh, convert `.env.template` to `.env`
```
make reset
```
* run `make lock` to save `.env` to `.env.encrypted`


### Choice 2: Pass environment settings in via apache
```
SetEnv DB_NAME wordpress
SetEnv DB_USER root
SetEnv DB_PASSWORD root
SetEnv WP_HOME http://wp.dev
SetEnv WP_ENV development
```

### Choice 3: Pass environment settings in via nginx
```
fastcgi_param DB_NAME "wordpress";
fastcgi_param DB_USER "root";
fastcgi_param DB_PASSWORD "root";
fastcgi_param WP_HOME "http://wp.dev";
fastcgi_param WP_ENV "development";
```

3. All done. Visit the site :D