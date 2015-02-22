<?php
/**
 * Updates config/app.php with unique keys and salts for WordPress authentication.
 */
class ClI_Command extends \WP_CLI_Command
{
    function copy( $args, $assoc_args )
    {
        $path = dirname( __DIR__ ) . '/wp-cli.yml';
        $revert_back_to_defaults = false;

        $this->setup_local_config($path, $revert_back_to_defaults);
    }

    private function setup_local_config($file, $revert = false)
    {
        if ( ! file_exists($file) ) {
            WP_CLI::error("File doesn't exists");
        }

        $new_file = file($file);

        $key = 0;

        // Not a PHP5-style by-reference foreach, as this file must be parseable by PHP4.
        foreach ( $new_file as $line_num => $line ) {
            if ( ! preg_match( '/^define\(\'([A-Z_]+)\',([ ]+)/', $line, $match ) )
                continue;

            $constant = $match[1];
            $padding  = $match[2];
            $salt = $revert ? 'put your unique phrase here' : $this->generate_salty_string( 64, true, true );

            switch ( $constant ) {
                case 'AUTH_KEY'         :
                case 'SECURE_AUTH_KEY'  :
                case 'LOGGED_IN_KEY'    :
                case 'NONCE_KEY'        :
                case 'AUTH_SALT'        :
                case 'SECURE_AUTH_SALT' :
                case 'LOGGED_IN_SALT'   :
                case 'NONCE_SALT'       :
                    $new_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'" . $salt . "');\r\n";
                    break;
            }
        }

        $handle = fopen($file, 'w');
        foreach($new_file as $line) {
            fwrite( $handle, $line );
        }
        fclose( $handle );
        chmod( $file, 0666 );

        return $new_file;
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

WP_CLI::add_command('cli', 'ClI_Command');