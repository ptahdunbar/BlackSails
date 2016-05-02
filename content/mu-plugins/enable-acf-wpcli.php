<?php
/**
 * Plugin Name:  Enable the ACF wp-cli Extension.
 * Plugin URI:   https://github.com/ptahdunbar/enable-acf-wpcli
 * Description:  Automatically enables the ACF wp-cli Extension.
 * Version:      1.0.0
 * Author:       ptahdunbar
 * Author URI:   https://github.com/ptahdunbar
 * License:      GPL2+
 */

/* @see https://github.com/hoppinger/advanced-custom-fields-wpcli */
$acf_wpcli_loader = '/advanced-custom-fields-wpcli/advanced-custom-fields-wpcli.php';
$acf_cli_path = WP_PLUGIN_DIR . $acf_wpcli_loader;

// NOTE: Only available through the `wp` CLI interface.
if ( ( defined('WP_CLI') && WP_CLI ) && file_exists($acf_cli_path) ) {
	require $acf_cli_path;
}