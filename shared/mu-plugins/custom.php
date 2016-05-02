<?php
/**
 * Pending a home.
 */

// Upload size limit is 1GB
add_filter('upload_size_limit', 'blacksails_upload_size_limit');
function blacksails_upload_size_limit()
{
	return 1073741824; // pow( 2, 30 )
}

// No upload limit
add_filter('pre_site_option_upload_space_check_disabled', function(){
	return 1;
});