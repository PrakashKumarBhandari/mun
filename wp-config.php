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
define( 'DB_NAME', 'mun' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~$nIp^R/kv,`&`8I*4ZeD4Wz1Gqwe.ehc,vtZPh0aRb@07e!f,mb%bS]%MV2h?O8');
define('SECURE_AUTH_KEY',  'DOb{m|DR;}>~|10]Cq(S0-r0iV82G_}~Q&Gib3zZY1[]p~U=@!gEfmOH1=OW~<Jl');
define('LOGGED_IN_KEY',    'XGad8(d2352/a8+E(},gP3+^@rT; v7-NaB?I#L)8P&A_cp<tUD2BCmG==1^Y%t9');
define('NONCE_KEY',        'b:Fo{w+m4*R5V5O7^DxHtI_=I+pdHU6C $_Kp`dw|wVYdIa]H3 ;+DLek*+9C0-:');
define('AUTH_SALT',        'LE+<b-*5(5PM7P Q[oMZc_ 5?z;sm u7)sZ!RE2/6C}D-tyKuOE.X$<Tgx(7Rmo9');
define('SECURE_AUTH_SALT', 'a%h|oap1Ua4~ra:fj;#I[!8i`^6L4uiIVNL^$*g&!g~V8PJ(A%DA2y03!p6{G5[?');
define('LOGGED_IN_SALT',   ',oHRP(!Wu+{7aGsrg#$7-*X@k>u1gOTR&_I9iYky G<6#6hn:Vp/g#2)4~2 %,0<');
define('NONCE_SALT',       'W?oU|5>Vp2&ny!(xz|`9U]y~y?AJB9H]Xl*8Np;:ma3RL|NpHDg`}pi#=ye[1<~]');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mun_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
