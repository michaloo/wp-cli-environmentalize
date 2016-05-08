Makes wp-config to load settings from ENV variables.

It injects getenv into wp-config define functions.
Except DB_NAME, DB_USER, DB_PASSWORD all ENV variables match WordPress
constants. In mentioned three cases `DB_` prefix is changed to `MYSQL_`
to make it compatible with MySQL/MariaDB docker images.
