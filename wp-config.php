<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'fUUsvQRM9pKtDqcNy691RU/pFvm57uLY4kxURneKHcntcLhzQj2KBVISSAyRSItTtWndq70IR14dY/La+8aREA==');
define('SECURE_AUTH_KEY',  'qNQ2zOnzXQ6PQfjg/PSxdgX6y21HX1NIppESJsI07dm8g3i0H/4+aSU5V32v42J5es8chkVS6wI4X25x0YDFWg==');
define('LOGGED_IN_KEY',    'LGUBeIx+nSLubDu6e91mS1mF40RiODr9dVk1pqFsRCrewofX1Uszeu9gRH52yEOyljC+X58TZ/NbIaht4FVA2g==');
define('NONCE_KEY',        'H1OHtfneHChi76frwsJoviMSpDOOD1QI4pfeDjNEBY+mb6XV3u1xxqkcUa0XS9XgPO/j1DfaVBAZIls6/K5oHg==');
define('AUTH_SALT',        'IA8vlKQ7CAU1H47MTLPj9zH8jVZJ3aPauLjIV45ABOdDmCDBzHFEZukNgBU4gAIho/x+a7O9p6ZQesKysYIWJA==');
define('SECURE_AUTH_SALT', 'RsdPZWyHnM9QNkIBKC1Kjnijg6VYtFsPJWqpYpuVp8bYbCJyjnnb64VI0XKs16OXoWnCCjLOS14EIf0nS45mQA==');
define('LOGGED_IN_SALT',   'OXZr9QJvOfsnYcvB515QjA41TYVoc7ZNvDOBNEQ4Y/Pir7kxxAJgLvmC4rK90WBQ8Giu1RZgx8bfIBpLsS7qTw==');
define('NONCE_SALT',       'DgyqU4E+hRqI31Mr2cdeWucU8UYcWM4BWOH14QfYMWQF/ogWHY/m+Watb/R7O1Qv5ysPmpqdgAaVwpsMR1w1YQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
