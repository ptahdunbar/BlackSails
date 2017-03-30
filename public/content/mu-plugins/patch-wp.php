<?php

namespace Wpskapp;

/**
 * Register the default WordPress themes directory.
 */
add_action('muplugins_loaded', __NAMESPACE__ . '\register_default_themes_directory', 5);
function register_default_themes_directory()
{
    register_theme_directory(ABSPATH . 'wp-content/themes/');
}

/**
 * Fix network admin URL to include the "/wp/" base
 * Prevents any network admin urls from breaking.
 *
 * @see https://core.trac.wordpress.org/ticket/23221
 * @credit https://gist.github.com/danielbachhuber/9379135
 */
add_filter('network_site_url', __NAMESPACE__ . '\network_site_url', 10, 3);
function network_site_url($url, $path, $scheme)
{
    return str_replace(WP_HOME, WP_SITEURL, $url);
}

/**
 * Bugfix with wp-cli `wp core install` not properly setting
 * the home option in the db, resulting in subdirectory being
 * in the url which you probably don't want for Multi-site
 */
add_action('wp_install', __NAMESPACE__ . '\fix_home_url');
function fix_home_url()
{
    global $wpdb;

    $home_url_in_db = $wpdb->get_var("SELECT option_value FROM $wpdb->options WHERE option_name = 'home'");

    if ( $home_url_in_db !== WP_HOME ) {
        $wpdb->query($wpdb->prepare("UPDATE $wpdb->options SET option_value = '%s' WHERE option_name = 'home'", WP_HOME));
    }
}

// Make sure its fixed to what we've set
add_action('pre_option_home', __NAMESPACE__ . '\get_home_url');
function get_home_url()
{
    return WP_HOME;
}