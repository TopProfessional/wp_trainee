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
define( 'DB_NAME', 'test1bd' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '1#V^cL9QtpILiCBpbFMRl=kqj?z<U3ApPr=L)a=h04.R/X^[d~?``3q{`ox<5w($' );
define( 'SECURE_AUTH_KEY',  '[^:pC#`3<eNj2~hc rX[0uS,M%{Gyyg?f3REVzz8}.m0q(lhgf16#!xsao608VW[' );
define( 'LOGGED_IN_KEY',    'a@BdU@HtMx=Vx8QC=S,#AO3{?AE28j|YAFn9ckM@G,P8lx5Pf>ZxPgj36wZkzF:u' );
define( 'NONCE_KEY',        '$!5PyP2lo.IgIceAz7 p~BRbP[x(P-`8hhky]dO!R([<dN{yx_|{$C}gXvkFq<iF' );
define( 'AUTH_SALT',        '`T+eFC$a&xaxr}~Ct?LPN)h-GJW0.zQn*]D{Y0E7m~$oRzd(&a?c}E=g0LZsO)>f' );
define( 'SECURE_AUTH_SALT', 'Q0o4]q$J[?y)j/6n/m<4OE5>++v{Pd{kvjT;Bf@[nH_y39)n[$X%T>`m42m@>htZ' );
define( 'LOGGED_IN_SALT',   '%F$J:)@b|h@3B.xpp;pr6q0@G`UNHTL=5RljHCRkfhKrv;%RqaM^-W?|ujTo?*5X' );
define( 'NONCE_SALT',       'yq>)48L6AOUp$I0h|]5qjm,~_y#2J9vSUwFP#`-N0&+Rw{a{<qNAx%f2Li2Sj_9l' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
