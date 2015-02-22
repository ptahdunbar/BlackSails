<?php
/**
 * Plugin Name:  WP-CLI for Advanced Custom Fields
 * Plugin URI:   https://github.com/hoppinger/advanced-custom-fields-wpcli
 * Description:  Manage Advanced Custom Fields through WP-CLI
 * Version:      Master
 * Author:       hoppinger
 * Author URI:   https://github.com/hoppinger
 * License:      MIT License
 */

$acf_cli_path = WP_CONTENT_DIR . '/plugins/advanced-custom-fields-wpcli/advanced-custom-fields-wpcli.php';

// NOTE: Only available through the `wp` CLI interface.
if ( file_exists($acf_cli_path) && ( defined('WP_CLI') && WP_CLI ) ) {
	require $acf_cli_path;
}