# WP Skeleton Site - WIP. [![Build Status](https://travis-ci.org/ptahdunbar/wp-skeleton-site.png?branch=develop)](https://travis-ci.org/ptahdunbar/wp-skeleton-site)

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
* Supports [Composer](http://getcomposer.org/) and [Bower](http://bower.io/) for vendoring dependencies.
* Includes a `.pot` as a starting translation file.

#### Thanks
* [WPSkeleton](https://github.com/markjaquith/WordPress-Skeleton), thx [@markjaquith](https://github.com/markjaquith)!