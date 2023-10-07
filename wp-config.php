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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-nest' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         '9kf*:opLgjF6CN[P 2Wm}yD>4W*@i%vX?sfqdVMpni3;pCs8mAm!1lfR=29ekc>f' );
define( 'SECURE_AUTH_KEY',  '#nwv,hm_Qt=FzoK=[_LrPU/~-&op[H)3F8>[Bm)h?TX))QNpWO,@,,R!$*Sd@:Yu' );
define( 'LOGGED_IN_KEY',    'K+Xx3rOXMgEW9  bo#HDto:>;K54s7%:1N.k;0CX!kJ3?bgE)a<jf92xNcuGU->`' );
define( 'NONCE_KEY',        'vgZ?.S<l}9y$z`+b<uAFE,{.Il^h)tD:~UjFiCaUk3c B6?R%O)Da?z__=e2,:FM' );
define( 'AUTH_SALT',        'IdmTc$G0Q=ht3b+;{7{EXk?tIaWWoybnx@8ciEU+F&>*59^YNooh^O~bXIog!%?E' );
define( 'SECURE_AUTH_SALT', '+B4Vmy^x_@wa(y7dzeu%VJPfyw>)PY5/yx&ox%FQw/myuU<.&2s|$>PGVbzKdvL?' );
define( 'LOGGED_IN_SALT',   'rG36=|L,.]Z5eNSz7<dO$:ZnTwlwOY3u1wZ$J|mE$BQd`HNw/tC{fKG(6<k*6`s7' );
define( 'NONCE_SALT',       'P0Np3%ik7S=egbq%[OqYH:b:vR%G))t*f#@j~ErC[7#0*bo*WQ@+dJkWkrKXdrEP' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
