<?php
/**
 * Plugin Name:  Home is home
 * Plugin URI:   https://github.com/ptahdunbar/home-is-home
 * Description:  Bugfix with wp-cli `wp core install` not properly setting the home option in the db, resulting in subdirectory being in the url which you probably don't want for Multi-site install.
 * Version:      Master
 * Author:       ptahdunbar
 * Author URI:   https://github.com/ptahdunbar
 * License:      GPL2+
 */

add_action('wp_install', '__pressvarr_fix_home_url');
function __pressvarr_fix_home_url()
{
	global $wpdb;

	$home_url_in_db = $wpdb->get_var("SELECT option_value FROM $wpdb->options WHERE option_name = 'home'");

	if ( $home_url_in_db !== WP_HOME ) {
		$wpdb->query($wpdb->prepare("UPDATE $wpdb->options SET option_value = '%s' WHERE option_name = 'home'", WP_HOME));
	}
}