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
 * Use WP_ENV to load environment specific settings.
 *
 * Apache:
 *  SetEnv WP_ENV "production"
 *
 * Nginx:
 *  fastcgi_param WP_ENV production;
 *
 * WP-CLI:
 * export WP_ENV=production
 *
 * NOTE: 'test' is used by the automated testing framework.
 */
if ( ! defined('WP_ENV') ) {
	define('WP_ENV', getenv('WP_ENV') ?: 'production');
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

/** Include environment settings **/
$env_config = $__root_dir . '/config/' . WP_ENV .'-config.php';
if ( file_exists($env_config) ) {
	include_once $env_config;
}

/** Include global settings **/
include_once $__root_dir . '/config/global-config.php';

/** Custom error logs path. */
if ( defined('WP_DEBUG') && WP_DEBUG ) {
	ini_set('error_log', ERROR_LOG);
}

/**#@-*/

/** That's all, stop editing! Happy Press'n! **/

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';