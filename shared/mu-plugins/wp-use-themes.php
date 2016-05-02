<?php
/**
 * Plugin Name:  WP Use Themes
 * Plugin URI:   https://github.com/ptahdunbar/wp-use-themes
 * Description:  Toggle whether to use themes or not late.
 * Version:      1.0.0
 * Author:       ptahdunbar
 * Author URI:   https://github.com/ptahdunbar
 * License:      GPL2+
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * Setting to false will tell WP not to load the theme.
 * NOTE: it still loads functions.php
 *
 * @var bool
 */
if ( ! defined('WP_USE_THEMES') ) {
	define(
		'WP_USE_THEMES',
		apply_filters('wp_use_themes', true)
	);
}