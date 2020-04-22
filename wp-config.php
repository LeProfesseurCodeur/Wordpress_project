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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '^e[W.n:s=ZeI52*QX+[^OYDNE7jH*a0:y[Gat*(CCF3N5W6CL)!U1$3%sOn`^@st' );
define( 'SECURE_AUTH_KEY',  'q(hA+w2t5XzslA;[-`$*,|aYQR0+[P6/fuW7g}EDGxIQFuB/z.?j%;Dutaf|1;nx' );
define( 'LOGGED_IN_KEY',    '#4@$)y.$UwY+y2`HAZGim(F9hqyo8$PgDd[M%}%VmS[%wMEZ1XH:7|GY&Z7Afi?E' );
define( 'NONCE_KEY',        'M#T_xtTa%W/g/g9|iW6QvJ`1U,]b2E{d+=Gr/Emi:D(*>(p%CMQP279cq(@>ZbyM' );
define( 'AUTH_SALT',        '7[O]>uINs 8eYyU2T3kpuT%L~l(|u9*GuzG!QrT~/-qwMd{UunR)8ajl`-7NRJ*m' );
define( 'SECURE_AUTH_SALT', '4jMi,M}}x[]KK{HX4CI};+jkV:1N/&g5?E8&KPI6qU-2/.sRM f1V^t$p10dwTU0' );
define( 'LOGGED_IN_SALT',   'JU0i{cs2ag5l3Z&<kOu$DDp:6y.{*lqSto4%Cmld W[^J$)~`)R){dtNMEqnn(h.' );
define( 'NONCE_SALT',       '[x:`32neu4BxGf,R]^0-=;oa!lKe0,XrZ~{o?l2tY,!]zhKrc%{Y9[coP@YF2]E%' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
