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
define( 'DB_NAME', 'omnisoft' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'IsjI>rj,}y%Q/^*B.AbDFFu~@B7oby,#armPgQ2wko<GmDH8PX /lU|&g#D~6[o:' );
define( 'SECURE_AUTH_KEY',  'r+;?ITs]k-C.W4hsMoDX8ID--5*^NG?DEO5y^S~g}TrQ?a._i~d owm:K2WzgI<D' );
define( 'LOGGED_IN_KEY',    'j*Op3N/-/DYi,VzR/D@1)(-r@.I[&H~i#ywi(.xRL<xx(Ofp+PZ:f1%6Z-=ivy_`' );
define( 'NONCE_KEY',        '9@#`f:0j-3{e->1wys$RcfcVjWd`/Y&Cb~p[rC@w:8bYaNH+Y^u#B$Y$uIn*m:VT' );
define( 'AUTH_SALT',        ':n(W5.Zy^:JGgzQ#5 _Q29WNzV;`-ha7]QdE}eCuCW}l~mTQ%pHFn^]?YvcO*k)A' );
define( 'SECURE_AUTH_SALT', 'pT<[0S|+*=Uu[Wz]!b9ti1 }2@6^L4Sr0.@#vTary1ld2fu{-;,wZp[B?DsDD#6p' );
define( 'LOGGED_IN_SALT',   'b5Sf%vCN^NFza`U/;BK]NWM.Z.4yK67dy6ETsTOAM2t4GGMpI29MQ|^X)2}~=u60' );
define( 'NONCE_SALT',       '%gMeL?^$bH~(1hD*:-ukffXK-w(-)i1^XSg>qi?*b/ruk/uu<.zSA!HCI4@^{[8g' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'omnisoft_';

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
