<?php
// Step 1: Specify WP_ENV.
if ( ! getenv('WP_ENV') ) {
	echo "Error. Please export the value of WP_ENV\n";
	echo "\n";
	echo "Example:\n";
	echo "export WP_ENV=production\n";
	echo "export WP_ENV=staging\n";
	echo "export WP_ENV=testing\n";
	echo "export WP_ENV=development\n";
	echo "export WP_ENV=\n";
	echo "\n";
	die();
} else {
	define('WP_ENV', getenv('WP_ENV'));
}

printf("WP_ENV = %s\n", WP_ENV);

// Include wp-cli scripts
$include_files = glob(__DIR__ . '/scripts/*.php');
$include_files_pretty = array_map(function($filepath) {
	return str_replace(__DIR__ . '/', '', $filepath);
}, $include_files);

printf("WP-CLI scripts loaded: %s\n", var_export($include_files_pretty, true));
foreach ( $include_files as $wpcli_command ) {
	require_once $wpcli_command;
}

// PHP notice bugfix
//global $wp_plugin_paths;
//if ( empty($wp_plugin_paths) ) {
//	$wp_plugin_paths = [];
//}

// Bugfix with HTTPS and wp-cli.
//\WP_CLI::add_hook('before_invoke:core', function(){
//	$configurator = \WP_CLI::get_configurator()->to_array();
//
//	if ( $configurator[1] && isset($configurator[1]['core install']) && $configurator[1]['core install']['url'] ) {
//		if ( stripos($configurator[1]['core install']['url'], 'https://') !== false ) {
//			$_SERVER['HTTPS'] = 'on';
//		}
//	}
//});