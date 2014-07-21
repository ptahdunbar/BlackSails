<?php
/**
 * The base configuration of WordPress.
 *
 * Be sure to create a local-config.php and insert your
 * database credentials and other environment specific settings.
 * See local-config-sample.php for more info.
 *
 * @package WordPress
 */

/**
 * Use this to constant WordPress to a specific environment.
 *
 * Examples are: dev, stag, prod.
 *
 * FYI: 'test' is used by the automated testing framework.
 */
if ( ! defined('WP_ENV') ) {
    define('WP_ENV', 'dev');
}

/** Absolute path to the WordPress directory. */
if ( ! defined('ABSPATH') ) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

/** @var string $__root_dir Path to config dir */
$__root_dir = realpath(dirname(__FILE__) . '/../');

/** Include composer autoload */
if ( file_exists($__root_dir . '/vendor/autoload.php') ) {
    include_once $__root_dir . '/vendor/autoload.php';
}

/** Include global settings **/
include_once $__root_dir . '/config/global-config.php';

/** Include environment settings **/
include_once $__root_dir . '/config/' . WP_ENV .'-config.php';

/** Custom /logs path. */
if ( WP_DEBUG ) {
    ini_set('error_log', dirname(__FILE__) . '/../logs/' . WP_ENV . '-debug.log');
}

/**#@-*/

/** That's all, stop editing! Happy Press'n! **/

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';