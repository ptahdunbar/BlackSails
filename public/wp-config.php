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

/** Load database info and environment specific settings. */
$local_config = dirname( __FILE__ ) . '/local-config.php';

/** Absolute path to the WordPress directory. */
if ( ! defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

if ( file_exists($local_config) ) {
    require_once $local_config;

} else if ( isset($_POST['action']) && 'generate' == $_POST['action'] ) {

    /**
     * Copy local-config-sample.php to local-config.php
     * to speed up the installation.
     */
    if ( ! copy(str_replace('.php', '-sample.php', $local_config), $local_config) ) {
        throw new Exception('Failed to copy local-config-sample.php to local-config.php');
    }

    chmod( $local_config, 0666 );

} else {
    // A config file doesn't exist, load up minimal WP.
    define('WPINC', 'wp-includes');
    define('WP_CONTENT_DIR', ABSPATH . 'wp-content');

    require_once ABSPATH . WPINC . '/load.php';
    require_once ABSPATH . WPINC . '/version.php';
    require_once ABSPATH . WPINC . '/functions.php';

    wp_check_php_mysql_versions();
    wp_load_translations_early();
    wp_fix_server_vars();

    $path = wp_guess_url() . '/wp-admin/setup-config.php';

    // Die with an error message
    $die  = __( "There doesn't seem to be a <code>local-config.php</code> file. I need this before we can get started." ) . '</p>';
    $die .= '<p>' . __( "You can create a <code>local-config.php</code> file through a web interface, but this doesn't work for all server setups. The safest way is to manually create the file." ) . '</p>';
    $die .= '<form action="" method="post"><input type="hidden" name="action" value="generate" />';
    $die .= '<p><input type="submit" class="button button-large" value="' . __( "Create a local-config.php File" ) . '" />';
    $die .= '</form>';

    wp_die( $die, __( 'WP Skeleton &rsaquo; Error' ) );
}

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
    define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
}

/** Custom content url. */
if ( ! defined('WP_CONTENT_URL') ) {
    define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );
}

/** Database Charset to use in creating database tables. */
if ( ! defined('DB_CHARSET') ) {
    define('DB_CHARSET', 'utf8');
}

/** The Database Collate type. Don't change this if in doubt. */
if ( ! defined('DB_COLLATE') ) {
    define('DB_COLLATE', '');
}

if ( ! isset($table_prefix) ) {
    $table_prefix  = 'wp_';
}

if ( ! defined('WPLANG') ) {
    define('WPLANG', '');
}

if ( ! defined('WP_MEMORY_LIMIT') ) {
    define('WP_MEMORY_LIMIT', '64M');
}

//if ( defined('WP_DEBUG') && ! WP_DEBUG )
//    define('WP_DEBUG_DISPLAY', false);

/** The default base theme. */
if ( ! defined('WP_DEFAULT_THEME') ) {
    define('WP_DEFAULT_THEME', 'wp-skeleton-theme');
}

/**#@-*/

/** That's all, stop editing! Happy blogging. **/

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';