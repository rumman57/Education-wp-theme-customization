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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wptestsite');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6xg}wbM[3(tb+I>,!xQ)TINt5q]6YvI/1sK<DJ_j7pgthac:[LkhD:8V*<olzZ@D');
define('SECURE_AUTH_KEY',  'zm,p@ES@YyXz)D1T3~p{PpU4L%8rCaKEw *? nLIZ&&b.]X2nsoG/(8k@J8`|]~I');
define('LOGGED_IN_KEY',    '_Xb.qL-GX4Y]C0=L4IUA,:O..FZ5iGCOKl:zv^EH6%/D>,<S}EB@`v)zD[$%*3Db');
define('NONCE_KEY',        'NW={o~6[zy0w11i,7j8amxB_%,&>SHm ,rk_Bv$Njc+[&hd<&m-:exVlmuz>p8>z');
define('AUTH_SALT',        ']S7~U:y7M5ZEnT_>]WWIa$,!F&zjB_fGW?b67;6Gu.sf%s`8j~V9YOBEA$erbv4s');
define('SECURE_AUTH_SALT', 's+hXAEzUJaEH_k3[q[z<gD=Zn58:aX)J@)jdM/eugsg)QScZxw$I]}3p)3(!W8lL');
define('LOGGED_IN_SALT',   'E*2q ]CYQw&R,@jkVQ!}Zo(ere3#oRUajQofa9j(VP3`Fvn}ndloT3$E=w5F$=9:');
define('NONCE_SALT',       'zt0q_|;7P0@P.95E}2h:b-68L]!l8jKVTM&3uu%AQg|c`8K<d=[6^UaduXRzrB(F');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
