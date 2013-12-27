# WP Skeleton Site [![Build Status](https://travis-ci.org/ptahdunbar/wp-skeleton-site.png?branch=develop)](https://travis-ci.org/ptahdunbar/wp-skeleton-site)

> This is a work in progress. Very alpha, subject to sweeping changes at random intervals :)

## Requirements
* PHP 5.4+
* Composer [http://getcomposer.org](http://getcomposer.org)

## Usage
```
composer create-project ptahdunbar/wp-skeleton-site wp.dev
vagrant plugin install bindler
vagrant bindler setup
vagrant plugin bundle
vagrant up
```

## Features

* Supports [PHPUnit](http://phpunit.de/manual/) and [Behat](http://behat.org/) for automated testing.
* Supports [Travis CI](https://travis-ci.org/) for continuous integration.
* Supports [Phing](http://www.phing.info/) for task automation.
* Supports [Composer](http://getcomposer.org/), [WPackagist](http://wpackagist.org/) and [Bower](http://bower.io/) for vendoring dependencies.
* Supports [wp-cli](http://wp-cli.org/) for cli scriting in a WordPress environment.
* Includes a `.pot` as a starting translation file.

### Phing

To run phing, use this command:

```
vendor/bin/phing
```

To run just a specific target, add the target name as the first parameter.

```
vendor/bin/phing target-name
```

#### Phing Targets

* `prepare` - Prepare and configures the environment.
* `lint` - Check the mu-plugins directory for syntax errors.
* `phpunit` - Run the PHPUnit test suite
* `behat` - Run the Behat feature suite
* `phing` - Run the phing command for plugins and themes that contain a build.xml
* `selenium` - Start a selenium server (run this target in a separate shell as it's ongoing).
* `selenium-stop` - Stop a selenium server.

#### Phing property overrides via `build.properties`

You can override default values defined at the top of `build.xml`.
This is usually for overriding mysql connection details, or configuring custom path values.

Simply create a build.properties file in the root of the project then run phing.

```
wp.tests_abspath=/tmp/wordpress-tests
wp.tests_multisite=true
mysql.pass=
```

### PHPUnit

You can test your WordPress mu-plugins using phpunit:

```
vendor/bin/phpunit
```

#### wp-tests-config.php

* You'll need to create and/or modify wp-tests-config.php for your project.
* Running `vendor/bin/phing` or `vendor/bin/phing prepare` regenerates this file based off wp-tests-config-sample.php.
* Load stuff early and set up the test environment using this file.


### Behat

You can test your site features using behat:

```
vendor/bin/behat
```

### Vendors

* Update composer.json to add WordPress plugin dependencies to this project via [wpackagist](http://wpackagist.org/) (add them into `require` or `require-dev`).


#### Thanks
* [WPSkeleton](https://github.com/markjaquith/WordPress-Skeleton), thx [@markjaquith](https://github.com/markjaquith)!
