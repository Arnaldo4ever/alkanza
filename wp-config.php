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
define('DB_NAME', 'alkanza');

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
define('AUTH_KEY',         'h53`>QF>uhq3~SF!5|tZEb2oPz$!@9GqU3fOMJB9G!(vIB4|r3Ddp~5^*bR)Fw^f');
define('SECURE_AUTH_KEY',  'az>taFp.`VrR(*]zA1oYSLNwpn&4dT&e8=ydET?,2>KtmkeG2a-q_#H:Uh#AeEA(');
define('LOGGED_IN_KEY',    'e3F)VEN[%h[q.7$nX3lcxu}83S/5mO<Cm<+Xd$-m--nU>#5Qf)U<`SQN!eCDSz?H');
define('NONCE_KEY',        'eW8ERS$us?X},zu:5:y94)*y[q!BH}9tjzi^j+/N!Zo,)z1yu9d^3!/d>GNK};EY');
define('AUTH_SALT',        '$7C0E7Sz>76C%`%}z^+!Ny}@ZD0:o9M=Y_acq4(RW+8s.}I^B&Gx}|[OOJ[%~/L2');
define('SECURE_AUTH_SALT', '62R8wbhxD/]_[YcLmpjHVf~hEsTo`4NAoudqSlN2Z;)R5vM]]RjHF=qkfZ/$VQkw');
define('LOGGED_IN_SALT',   'O>*rO?G7$*K1s00-cB0ugr6m14AlNTiw=I>IUpYGT|;Ye)$CksZd.NHR;Q<kjinZ');
define('NONCE_SALT',       '4^Ho(n5hgmKaIvTpARNz>l}]fUBu;*!3_]ow}]}&W992~nF)qUO$iGCUf!n@wT-;');

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
