<?php

/**#@-*/

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/** Custom content directory. */
if ( ! defined('WP_CONTENT_DIR') ) {
	define('WP_CONTENT_DIR', ABSPATH . '../content');
}

/** Custom content url. */
if ( ! defined('WP_CONTENT_URL') && isset($_SERVER['HTTP_HOST']) ) {
	define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );
}

/** Database charset to use in creating database tables. */
if ( ! defined('DB_CHARSET') ) {
	define('DB_CHARSET', 'utf8');
}

/** The Database Collate type. Don't change this if in doubt. */
if ( ! defined('DB_COLLATE') ) {
	define('DB_COLLATE', '');
}

global $table_prefix;

if ( ! isset($table_prefix) ) {
	$table_prefix  = 'wp_';
}

if ( ! defined('WPLANG') ) {
	define('WPLANG', '');
}

if ( ! defined('ERROR_LOG') ) {
	define('ERROR_LOG', dirname(__FILE__) . '/../logs/' . WP_ENV . '-debug.log');
}

/**#@-*/