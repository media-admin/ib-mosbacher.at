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
define( 'DB_NAME', 'ib-mosbacher_at' );

/** Database username */
define( 'DB_USER', 'media-admin' );

/** Database password */
define( 'DB_PASSWORD', 'Tr1-I7ad#1n' );

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
define( 'AUTH_KEY',          'rT0&sF4kI$0 lLw*L4#uMh7HQhEK&+TP#oE4`m!3Hu/^[w4V&3nps`FY^h$M~Vh9' );
define( 'SECURE_AUTH_KEY',   'sHRE9{Nj,?0fs~TP@ZBi#aVK9^0OmL?zM1D4kMBa)Zf-eQWQ#pWS<45]?Dg@r2Qa' );
define( 'LOGGED_IN_KEY',     'MvhF+7J3GZCJm?AdRm,5uZah+2#]lc*M_N+N=BGwcRduDp8(YgVeghtb6)2%LY9-' );
define( 'NONCE_KEY',         'US:7w/yy/D9E$~dWWLslm;s)K:dF}**yqD@k(8f6}RnVfj^`Z2M*[DvdhUgQd00Z' );
define( 'AUTH_SALT',         'B+N^WFJ(tVl[T^TK(-9wVAnj{[:Px<=[g0=`#Y4S2hJCM~xNRVFtfXpfn[CnOw L' );
define( 'SECURE_AUTH_SALT',  'm9k{@(@ox:Qohy#7B8eHi73HTop(F}iH:.zF5B(G1?CRu)6%{ siD,7?#kb|f=U_' );
define( 'LOGGED_IN_SALT',    'G#ogXPU~,v|yR*&K>u1>7ES_5(/-&RbEp&Cmd$6)P?mMbg~K:GqhwHa_$H[*rCu#' );
define( 'NONCE_SALT',        'h/d*MuBw-`x3H4M$i:g!6/(2^z[Lx.wRBZ{y8l3,0#EJt$#z4${$0JlDi}Q?D+Dv' );
define( 'WP_CACHE_KEY_SALT', 'Ue?3(zp,(aNnn@j=QuWaC;J>[#]fVbY]q GWXLNnnGHP?<b83$,Z?+MODQFlaZh0' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ibm_';


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
