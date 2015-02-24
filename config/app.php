<?php

/** Load dependencies from composer. */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/** Loads environment vars from the .env file */
$dotenv = new Dotenv\Dotenv;
$dotenv->load(dirname(__DIR__));
$dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_HOME', 'WP_SITEURL']);

/** Set up our global environment constant. */
define('WP_ENV', getenv('WP_ENV') ?: 'development');

/** Include environment settings */
require_once dirname(__DIR__) . '/config/environments/' . WP_ENV . '.php';

/**
 * Add your custom wp-config.php settings below
 *
 * @link http://codex.wordpress.org/Editing_wp-config.php
 */

//define('WP_ALLOW_MULTISITE', true);
//define('SUNRISE', 'on');

/** The root directory that houses `wp` */
define('WP_ROOT', dirname(__DIR__) . '/web');

/** Custom content directory. */
define('APP_DIR', '/app');
define('WP_CONTENT_DIR', WP_ROOT . APP_DIR);
define('WP_CONTENT_URL', WP_HOME . APP_DIR);

/** DB Settings */
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

/** WordPress Database Table prefix. */
$GLOBALS['table_prefix'] = getenv('DB_PREFIX') ?: 'wp_';

/**#@-*/ /* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined('ABSPATH') && ! defined('WP_CLI') ) {
	define('ABSPATH', WP_ROOT . '/wp/');
}

/**#@+
 * Unique Keys and Salts for WordPress Authentication.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 */
define('AUTH_KEY', getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY', getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', getenv('LOGGED_IN_KEY'));
define('NONCE_KEY', getenv('NONCE_KEY'));
define('AUTH_SALT', getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', getenv('LOGGED_IN_SALT'));
define('NONCE_SALT', getenv('NONCE_SALT'));

/** Include additional wp-cli commands */
if ( defined('WP_CLI') && WP_CLI ) {
//	printf("WP_ENV: %s\n", WP_ENV);

	foreach ( glob(dirname(__DIR__) . '/ops/scripts/*.php') as $wpcli_command ) {
		require_once $wpcli_command;
	}
}