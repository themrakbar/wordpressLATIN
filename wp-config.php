<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_latin' );

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
define( 'AUTH_KEY',         'w>-I GT`@Oe]aMm/&G[ GN3,~Bka86;u]I taUFYB D?mpsUS /sa/Y.tqoS$CkS' );
define( 'SECURE_AUTH_KEY',  'Ibok(%uNYxLL@Xvfx(}?n)8g*r7v)3_z974~_aL>uE}O!mo0o#&#Sn<J?Nse,U-w' );
define( 'LOGGED_IN_KEY',    '2Ikn6[qLfGYlNAZExz>u.Kt-@W`z64Ealj09v+QD*b6]TkHl`YKMdyb^2x0XYcv2' );
define( 'NONCE_KEY',        'vm5XH9?#fUkZ7zhG8pp^eJ>Y0]](#zIos5ri]_/u)`tf(2uG+`6m8]f%;PeAEA_Z' );
define( 'AUTH_SALT',        ':*%C#>} ,PBuML`eH7YdV#hJo_XGY#+Ta=0|K^McQB=u(~97+2YaM9=2r~r_ lc;' );
define( 'SECURE_AUTH_SALT', 'WlKMFUcy;LbhQ$%XiHg;1nLck^+p5?L(m!ge@Ola-,)FQOW`BYEOR-S,]%Cz7yB9' );
define( 'LOGGED_IN_SALT',   '$wY{Fb6^tMxHDEacQ?O~E5H]PaQ/;{SxtASwm`[NR^|o.yZ(|50o7i.S@y%4-8jl' );
define( 'NONCE_SALT',       '/gklS[q(-Eot*8;fgx-J#Q`g2KRH-WQ=Gx}lH/j+y^<Ax@D*- ZKa@V(LG2MAyW4' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
