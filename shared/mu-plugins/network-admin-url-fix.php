<?php
/**
 * Plugin Name:  Network Admin URL fixer
 * Plugin URI:   http://github.com/ptahdunbar/network-admin-url-fix
 * Description:  Prevents any network admin urls from breaking.
 * Version:      1.0.0
 * Author:       Ptah Dunbar
 * Author URI:   http://github.com/ptahdunbar
 * License:      GPL2+
 */

/**
 * Fix network admin URL to include the "/wp/" base
 *
 * @see https://core.trac.wordpress.org/ticket/23221
 * @credit https://gist.github.com/danielbachhuber/9379135
 */
add_filter('network_site_url', 'pressvarrs_network_site_url', 10, 3);
function pressvarrs_network_site_url($url, $path, $scheme)
{
	$urls_to_fix = array(
		'/wp-admin/network/',
		'/wp-login.php',
		'/wp-activate.php',
		'/wp-signup.php',
	);

	foreach( $urls_to_fix as $maybe_fix_url ) {
		$fixed_wp_url = '/wp' . $maybe_fix_url;
		if ( false !== stripos( $url, $maybe_fix_url )
			&& false === stripos( $url, $fixed_wp_url ) ) {
			$url = str_replace( $maybe_fix_url, $fixed_wp_url, $url );
		}
	}

	return $url;
}