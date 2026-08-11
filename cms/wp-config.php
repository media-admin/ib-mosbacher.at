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
define('AUTH_KEY',         'k)kQX7{$h&(:Dm=ep:%5BkNJ6j6205}uo|WeV+*k2fc75x9p+inEvT_ZB@@Wo.ny');
define('SECURE_AUTH_KEY',  'B 9-<TVR[&iqlh+(W:hrjHJh-R2R+sR8y_o5E)fuxTD:OqivxcjrL[ilajh?;CQ!');
define('LOGGED_IN_KEY',    'q[POt+qzywEN|Sb@U8=+oHjBE:RVLjrMmmG[NnZ4m7<Q/nD6m1%<vydf[V8R(lU?');
define('NONCE_KEY',        '8VH,5G0N6jh^S#oz%-.HPM,B{#a/LP.P2_z)}:&5A,z|LUo$;Kq=+C8?>gOX#;CS');
define('AUTH_SALT',        'BNrD+5`JB,2IY/h;_j({Yny83?fZ+M|^78?|@kSo+W=a^>r3qYu@c+9/)YT%-7KH');
define('SECURE_AUTH_SALT', '8C#k.5Y_|9H*Z/VQ3)Q)mk`%Gsa{CHAjONf_jSQPz;+#cU,0;L`z_SdIv,7q M*f');
define('LOGGED_IN_SALT',   '6.abL@`<d#uSaEe9fyCfS|^H3_x!$!#-ULx-_d=S6y^cLW3!a!jpHRyw4]22/N>;');
define('NONCE_SALT',       '8f]*c)c<K(skK-Kjg+f(SZTsU%]V~MzG-&n9&}zzTLIK6@~8$&}|W5|.%onfZ[}R');


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

define( 'ML_DEBUG_HERO', true );

/* That's all, stop editing! Happy publishing. */

/* HTTPS hinter Valet/Proxy */
$_SERVER['HTTPS'] = 'on';
define( 'FORCE_SSL_ADMIN', true );

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
