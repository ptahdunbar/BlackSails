<?php

/** Load dependencies from composer. */
require_once __DIR__ . '/vendor/autoload.php';

/** Require local config **/
require __DIR__ . '/bootstrap.php';

/** Database settings for WordPress */
define('DB_NAME', getenv('DB_NAME') ?: 'wordpress');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: 'root');
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');

/** Include environment settings */
define('WP_ENV', getenv('WP_ENV') ?: 'development');
define('WP_HOME', getenv('WP_HOME'));
define('WP_SITEURL', WP_HOME);

/**
 * Add your custom wp-config.php settings below
 *
 * @link http://codex.wordpress.org/Editing_wp-config.php
 */
define('WP_DEBUG', (bool) getenv('WP_DEBUG') ?: false);
define('SAVEQUERIES', (bool) getenv('SAVEQUERIES') ?: false);
define('SCRIPT_DEBUG', (bool) getenv('SCRIPT_DEBUG') ?: false);
define('WP_CACHE', (bool) getenv('WP_CACHE') ?: false);

/* Add multsite config here */
define('WP_ALLOW_MULTISITE', (bool) getenv('WP_ALLOW_MULTISITE'));

if ( (bool) getenv('ENABLE_MULTISITE') ) {
    define('MULTISITE', (bool) getenv('MULTISITE'));
    define('SUBDOMAIN_INSTALL', (bool) getenv('SUBDOMAIN_INSTALL'));

    define('DOMAIN_CURRENT_SITE', getenv('DOMAIN_CURRENT_SITE'));
    define('PATH_CURRENT_SITE', getenv('PATH_CURRENT_SITE'));

    define('SITE_ID_CURRENT_SITE', intval( getenv('SITE_ID_CURRENT_SITE') ));
    define('BLOG_ID_CURRENT_SITE', intval( getenv('BLOG_ID_CURRENT_SITE') ));

}

// No file edits unless explicitly allowed in local-config.php
define('DISALLOW_FILE_MODS', (bool) getenv('DISALLOW_FILE_MODS') ?: false );

/** DB Settings */
define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8');
define('DB_COLLATE', getenv('DB_COLLATE') ?: '');

/** WordPress Database Table prefix. */
global $table_prefix;
$table_prefix = getenv('DB_PREFIX') ?: 'wp_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined('ABSPATH') ) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
