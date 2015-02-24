<?php
/**
 * Implements a wp-cli command.
 */
class Example_Command extends \WP_CLI_Command
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
    function ahoy( $args, $assoc_args )
    {
        list( $name ) = $args;

        // Print a success message
        WP_CLI::success("Ahoy, $name! wp-cli works ;D");
    }
}

WP_CLI::add_command('example', 'Example_Command');