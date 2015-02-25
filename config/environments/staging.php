<?php

/** Database settings for WordPress */
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');

/** Site URL settings */
define('WP_HOME', getenv('WP_HOME') ?: sprintf('http://%s', $_SERVER['HTTP_HOST']));
define('WP_SITEURL', getenv('WP_SITEURL') ?: sprintf('http://%s/wp', $_SERVER['HTTP_HOST']));

/** Environment settings */
ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);
