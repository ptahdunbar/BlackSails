<?php
/**
 * Updates config/app.php with unique keys and salts for WordPress authentication.
 */
class Salt_Command extends \WP_CLI_Command
{
    function generate($args, $assoc_args)
    {
        $file = realpath(dirname( __DIR__ ) . '/../.env');
	    $force = false;

	    if ( isset($assoc_args['force']) OR in_array('-f', $args) ) {
		    $force = true;
	    }

        if ( ! file_exists($file) ) {
            WP_CLI::error("File doesn't exists");
        }

        if ( stripos(file_get_contents($file), 'AUTH_KEY') !== false && ! $force ) {
            WP_CLI::warning("Auth keys and salts already added.");
            return;
        }

        $keys = [
            'AUTH_KEY',
            'SECURE_AUTH_KEY',
            'LOGGED_IN_KEY',
            'NONCE_KEY',
            'AUTH_SALT',
            'SECURE_AUTH_SALT',
            'LOGGED_IN_SALT',
            'NONCE_SALT'
        ];

        $salts = array_map(function($item){
            $item .= '="' . $this->generate_salty_string( 64, true, true ) . '"';
            return $item;
        }, $keys);

        array_unshift($salts, "\n");

        file_put_contents($file, implode($salts, "\n"), FILE_APPEND | LOCK_EX);

        WP_CLI::success("Auth keys and salts added.");
    }

    /**
     * Generates a random password drawn from the defined set of characters.
     *
     * @since 2.5.0
     *
     * @param int $length The length of password to generate
     * @param bool $special_chars Whether to include standard special characters. Default true.
     * @param bool $extra_special_chars Whether to include other special characters. Used when
     *   generating secret keys and salts. Default false.
     * @return string The random password
     **/
    private function generate_salty_string( $length = 12, $special_chars = true, $extra_special_chars = false ) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        if ( $special_chars )
            $chars .= '!@#$%^&*()';
        if ( $extra_special_chars )
            $chars .= '-_ []{}<>~`+=,.;:/?|';

        $password = '';
        for ( $i = 0; $i < $length; $i++ ) {
            $password .= substr($chars, rand(0, strlen($chars) - 1), 1);
        }

        return $password;
    }
}

WP_CLI::add_command('salt', 'Salt_Command');