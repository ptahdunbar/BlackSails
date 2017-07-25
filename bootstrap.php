<?php
/**
 * Find and include .env or .env.local from /public or the parent directory
 * and pull in required environment variables to bootstrap.
 */

/** Find the root path in current or parent directory. */
$path_to_environment = __DIR__;
$environment_file = '.env';
$parent_directory = str_replace(
    basename(__DIR__)
    , ''
    , $path_to_environment
);

if ( file_exists($path_to_environment . '/' . $environment_file) ) {
    $path_to_environment = __DIR__ . '/';

} else if ( file_exists($path_to_environment . '/' . $environment_file . '.local') ) {
    $path_to_environment = __DIR__ . '/';
    $environment_file .= '.local';

} else if ( file_exists($parent_directory . $environment_file) ) {
    $path_to_environment = $parent_directory;

} else if ( file_exists($parent_directory . $environment_file . '.local') ) {
    $path_to_environment = $parent_directory;
    $environment_file .= '.local';
} else {
    die('Missing .env file. Please provide an .env file');
}

/** Load dependencies from composer. */
require_once __DIR__ . '/vendor/autoload.php';

/** Loads environment vars from the .env file */
$dotenv = new Dotenv\Dotenv($path_to_environment, $environment_file);
$dotenv->load();
$dotenv->required([
    'DB_NAME',
    'DB_USER',
    'DB_PASSWORD',
    'WP_ENV',
]);
