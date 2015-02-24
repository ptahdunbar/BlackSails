<?php
/**
 * Download and install plugins for theme reviewing.
 */
class Themer_Command extends \WP_CLI_Command
{
    /**
     * Prints a greeting.
     *
     * ## OPTIONS
     *
     * <name>
     * : The name of the person to greet.
     *
     * ## EXAMPLES
     *
     *     vendor/bin/wp example ahoy Captain
     *
     * @synopsis <name>
     */
    function install( $args, $assoc_args )
    {
        list( $name ) = $args;

//        wp plugin install wordpress-importer --activate
//        wp plugin install developer --activate
//        wp plugin install theme-check --activate
//        wp plugin install theme-mentor --activate
//        wp plugin install theme-checklist --activate
//        wp plugin install what-the-file --activate
//        wp plugin install vip-scanner --activate
//        wp plugin install wordpress-database-reset --activate
//        wp plugin install toolbar-theme-switcher --activate
//        wp plugin install rtl-tester
//        wp plugin install piglatin
//        wp plugin install debug-bar  --activate
//        wp plugin install debug-bar-console  --activate
//        wp plugin install debug-bar-cron  --activate
//        wp plugin install debug-bar-extender  --activate
//        wp plugin install rewrite-rules-inspector  --activate
//        wp plugin install log-deprecated-notices  --activate
//        wp plugin install log-viewer  --activate
//        wp plugin install monster-widget  --activate
//        wp plugin install user-switching  --activate
//        wp plugin install regenerate-thumbnails  --activate
//        wp plugin install simply-show-ids  --activate
//        wp plugin install theme-test-drive  --activate
//        wp plugin install wordpress-beta-tester  --activate

        # Import the unit data.
//        curl -O https://wpcom-themes.svn.automattic.com/demo/theme-unit-test-data.xml
//        wp import theme-unit-test-data.xml --authors=create
//        rm theme-unit-test-data.xml

//        wp search-replace 'wpthemetestdata.wordpress.com' 'themereview.wordpress.dev' --skip-columns=guid
    }
}

WP_CLI::add_command('themer', 'Themer_Command');