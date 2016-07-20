<?php

/** Custom content directory. */
define('CONTENT_DIR', 'content');
define('WP_CONTENT_DIR', WP_ROOT . '/' . CONTENT_DIR);
define('WP_CONTENT_URL', getenv('WP_HOME') . CONTENT_DIR);

/** Set up our global environment constant. */
define('WP_ENV', getenv('WP_ENV') ?: 'production');

/** Include environment settings */

/** Database settings for WordPress */
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');

/** Site URL settings */
if ( ! isset($_SERVER['HTTP_HOST']) ) $_SERVER['HTTP_HOST'] = '';
define('WP_HOME', getenv('WP_HOME') ?: sprintf('http://%s', $_SERVER['HTTP_HOST']));
define('WP_SITEURL', getenv('WP_SITEURL') ?: sprintf('http://%s/wp', $_SERVER['HTTP_HOST']));

/**
 * Add your custom wp-config.php settings below
 *
 * @link http://codex.wordpress.org/Editing_wp-config.php
 */
define('WP_DEBUG', false);
define('SAVEQUERIES', WP_DEBUG);
define('SCRIPT_DEBUG', WP_DEBUG);

//define('WP_ALLOW_MULTISITE', true);
//define('SUNRISE', 'on');

/** DB Settings */
define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8');
define('DB_COLLATE', getenv('DB_COLLATE') ?:'');

/** WordPress Database Table prefix. */
$GLOBALS['table_prefix'] = getenv('DB_PREFIX') ?: 'wp_';

/**#@-*/

/**#@+
 * Unique Keys and Salts for WordPress Authentication.
 * @see https://api.wordpress.org/secret-key/1.1/salt/
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 */
define('AUTH_KEY', getenv('AUTH_KEY') ?: 'put your unique phrase here');
define('SECURE_AUTH_KEY', getenv('SECURE_AUTH_KEY') ?: 'put your unique phrase here');
define('LOGGED_IN_KEY', getenv('LOGGED_IN_KEY') ?: 'put your unique phrase here');
define('NONCE_KEY', getenv('NONCE_KEY') ?: 'put your unique phrase here');
define('AUTH_SALT', getenv('AUTH_SALT') ?: 'put your unique phrase here');
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT') ?: 'put your unique phrase here');
define('LOGGED_IN_SALT', getenv('LOGGED_IN_SALT') ?: 'put your unique phrase here');
define('NONCE_SALT', getenv('NONCE_SALT') ?: 'put your unique phrase here');
