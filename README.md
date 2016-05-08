# WP-CLI Environmentalize

[WP-CLI](https://wp-cli.org/) package to "environmentalize" Wordpress installation.

Makes `wp-config.php` to load settings from ENV variables.

## Installation

In your WP-CLI installation run:

`wp package install michaloo/wp-cli-environmentalize`

## Usage

In your Wordpress installation run

`wp environmentalize`

If no `wp-config.php` file is found, one based on default WP-CLI template is created.
Created `wp-config.php` file has `getenv` injected into Wordpress  `define` functions.
If you want to replace exisiting `wp-config.php`, please remove or rename it before
the command.

In addition to the config, there is `.env` file with all available ENV variables
created.

Except DB_NAME, DB_USER, DB_PASSWORD all ENV variables names match WordPress
constants names. DB_CHARSET Wordpress constant value is set from DB_CHARSET ENV variable.

In mentioned three cases `DB_` prefix is changed to `MYSQL_`
to make it compatible with MySQL/MariaDB Docker images ([refer to ]).

## Related projects

* [WP-CLI](https://wp-cli.org/)
* [MariaDB Image](https://hub.docker.com/_/mariadb/)
