<?php

use \WP_CLI\Utils;
/**
 * Implements example command.
 */
class WP_CLI_Environmentalize extends WP_CLI_Command
{

    /**
     * Makes wp-config to load settings from ENV variables.
     *
     * It injects getenv into wp-config define functions.
     * Except DB_NAME, DB_USER, DB_PASSWORD all ENV variables match WordPress
     * constants. In mentioned three cases `DB_` prefix is changed to `MYSQL_`
     * to make it compatible with MySQL/MariaDB docker images.
     *
     * @when before_wp_load
     */
    function __invoke()
    {
        if ( Utils\locate_wp_config() ) {
            WP_CLI::error( "The 'wp-config.php' file already exists. Remove it to environmentalize this WP." );
        }

        $sedCommand = file_get_contents(__DIR__ . '/../templates/sed.txt');

        $assoc_args = [];
        $assoc_args['extra-php'] = file_get_contents(__DIR__ . '/../templates/extra-php.txt');

        $out = Utils\mustache_render('wp-config.mustache', $assoc_args);

        $bytes_written = file_put_contents(ABSPATH . 'wp-config.php', $out);

        $result = 0;
        system($sedCommand . ' ' . ABSPATH . 'wp-config.php', $result);

        if ($result == 0) {
            return WP_CLI::success(ABSPATH . 'wp-config.php environmentalized!');
        }

        return WP_CLI::error(ABSPATH . 'wp-config.php NOT environmentalized!');
    }
}
