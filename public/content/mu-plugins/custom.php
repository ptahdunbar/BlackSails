<?php

namespace Wpskapp;

add_action('manage_sites_custom_column', __NAMESPACE__ . '\get_blog_id_column', 10, 2 );
function get_blog_id_column( $column_name, $blog_id )
{
    if ( 'blog_id' !== $column_name ) {
        return $column_name;
    }

    echo $blog_id;
}

add_filter('wpmu_blogs_columns',  __NAMESPACE__ . '\add_blog_id' );
function add_blog_id( $columns )
{
    $columns['blog_id'] = 'ID';

    return $columns;
}

// Use WP_ENV
add_action('template_redirect', __NAMESPACE__ . '\prevent_site_indexing');
function prevent_site_indexing()
{
    if ( defined('WP_ENV') && WP_ENV !== 'production' ) {
        add_action('pre_option_blog_public', '__return_zero');
    }
}

// No upload limit
add_filter('pre_site_option_upload_space_check_disabled', '__return_true');