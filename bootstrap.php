<?php
/**
 * Load environment variables needed for bootstrap.
 * Check environment if already set, else check for .env, else, bail.
 */

$required_variables = [
    'DB_NAME',
    'DB_USER',
    'DB_PASSWORD',
    'WP_HOME',
    'WP_ENV',
];

/** Find the root path in current or parent directory. */
$found_envfile = false;
$path_to_environment = __DIR__;
$environment_file = '.env';
$parent_directory = str_replace(
    basename(__DIR__)
    , ''
    , $path_to_environment
);

if ( file_exists($path_to_environment . '/' . $environment_file) ) {
    $path_to_environment = __DIR__ . '/';
    $found_envfile = true;

} else if ( file_exists($path_to_environment . '/' . $environment_file . '.local') ) {
    $path_to_environment = __DIR__ . '/';
    $environment_file .= '.local';
    $found_envfile = true;

} else if ( file_exists($parent_directory . $environment_file) ) {
    $path_to_environment = $parent_directory;
    $found_envfile = true;

} else if ( file_exists($parent_directory . $environment_file . '.local') ) {
    $path_to_environment = $parent_directory;
    $environment_file .= '.local';
    $found_envfile = true;
}


/* Priority is given to a file existing on disk. */
if ( $found_envfile ) {
    /** Loads environment vars from the .env file */
    $dotenv = new Dotenv\Dotenv($path_to_environment, $environment_file);
    $dotenv->load();
    $dotenv->required($required_variables);
} else {
    foreach ($required_variables as $required_variable) {
        if (
            ! $env_value = \Dotenv\Loader::getEnvironmentVariable($required_variable)
        ) {
            exit(sprintf(
                'Missing required variable %s for bootstrap. Exit.',
                $required_variable
            ));
        }

        /* @HACK Need to initialize the object before calling setEnvironmentVariable. */
        $dotload = new \Dotenv\Loader($path_to_environment, false);
        $dotload->setEnvironmentVariable($required_variable, $env_value);
    }
}