<?php

if (!defined('WP_CLI')) {
    return;
}

require_once __DIR__ . '/src/WP_CLI_Environmentalize.php';

WP_CLI::add_command( 'environmentalize', 'WP_CLI_Environmentalize' );
