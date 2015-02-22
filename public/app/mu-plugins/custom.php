<?php

// Upload size limit is 1GB
add_filter( 'upload_size_limit', function() {
	return 1073741824; // pow( 2, 30 )
});

// No upload limit for VIPs
add_filter( 'pre_site_option_upload_space_check_disabled', function(){
	return 1;
});