<?php
/**
 * Loads custom wp-cli commands from this directory.
 */

$skip = [ 'loader.php' ];

foreach ( glob(dirname(__FILE__) . '/*.php') as $wpcli_command ) {
    if ( in_array( basename($wpcli_command), $skip ) ) {
        continue;
    }

    require_once $wpcli_command;
}