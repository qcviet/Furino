<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          ')=$}L</TyDFq89X`>Tk@*X^~B.E6],2S6rv]wr2=d<@ng=ytOrE%m~{D~AW4<taw' );
define( 'SECURE_AUTH_KEY',   '%Y(sGMkfUNJ~qB/e`W7]-x@?s*5iUbD(7|/Sx%K-]AbAFVo-_q=%OM9t/v@(8`KR' );
define( 'LOGGED_IN_KEY',     'Ak[k 3C^#dfQ*<6<k)Z6QnJ:1At%GR(U0jL3pe /%wP)1RiKxX&K;pb8lULu;fUP' );
define( 'NONCE_KEY',         'lwPF0s|M7S9lPN;Al~HfC++aetJYMI3e_%=?rt4Rsg+FoJeIYB:v;hD6= 5aJLO&' );
define( 'AUTH_SALT',         '_M3Cj85jU,/!^f@g^2lk#O}eyc}@nUlm1f-@.)fz5_^)k[d2kXN]eb~9GmI=Q@zC' );
define( 'SECURE_AUTH_SALT',  '1!;O&.`5(P&0Z;?}Nb&O!3mGrLTf)pv#[ksgc7gmJrXHM:mk3gvh{ADOkO3{/=in' );
define( 'LOGGED_IN_SALT',    '.^I+_%k!/F`-ua3?T3HQ)KoJ0I+$9c/ f!-4|EJA]xa,Ik%X(E!2VeqWpqoZVJ{9' );
define( 'NONCE_SALT',        ':~k/hEx1_!dvnH?f6iyQz%VZIdz Wyl&{n9],)d<^!A#P9hw+QnJn %sz2]{IoVC' );
define( 'WP_CACHE_KEY_SALT', 'YewYFk9!cS!h^PfRB9)|Q.kut45OTRY5^({}rAFU/K]$a[_N[HINM-YqAb>-Mt_W' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
