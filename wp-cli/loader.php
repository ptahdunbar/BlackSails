<?php
/**
 * Loads custom wp-cli commands from this directory.
 */
 
 // Setup WP_ENV so the app knows that this is coming from a cli request.
if ( ! defined('WP_ENV') ) {
	define('WP_ENV', 'wp-cli');
}

// Exclude files from inside the wp-cli/ dir that you don't want included by wp-cli.
$skip = [ 'loader.php' ];

foreach ( glob(dirname(__FILE__) . '/*.php') as $wpcli_command ) {
    if ( in_array( basename($wpcli_command), $skip ) ) {
        continue;
    }

    require_once $wpcli_command;
}
