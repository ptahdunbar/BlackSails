<?php
/**
 * Plugin Name:  Register default themes directory.
 * Plugin URI:   http://github.com/ptahdunbar/register-default-themes-directory
 * Description:  Register the default WordPress themes directory.
 * Version:      1.0.0
 * Author:       Ptah Dunbar
 * Author URI:   http://github.com/ptahdunbar
 * License:      GPL2+
 */

add_action('muplugins_loaded', 'pressvarrs_register_default_themes_directory', 5);
function pressvarrs_register_default_themes_directory()
{
	if ( apply_filters('register_default_themes_directory', true) ) {
		register_theme_directory(ABSPATH . 'wp-content/themes/');
	}
}