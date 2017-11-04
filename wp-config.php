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
define('DB_NAME', 'movies');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'j9g7y1i0');

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
define('AUTH_KEY',         'm,)b)Ui;r<W*NmFh?I_?`uqAnHO@(HP(cMJ,i/4#4Kevv+W~623.8xrh4My~q8p`');
define('SECURE_AUTH_KEY',  'u}JVWDOkf6]O7-_=dB7h2jl4mlpI]6KtHe*m1,}kN6!V7pKJEUY,~qS.bq96=LZd');
define('LOGGED_IN_KEY',    'jppnJG25S{=>Z $yU`&Uu7~3>Ps}z_^f9]jj4/Gn67-Ua7!S[<]57-D22V&ckf?y');
define('NONCE_KEY',        'exd6p5Oxf;Lc]K%a&AYq{Hxf1IeF!@Wh$ZAk;#b<7xlU& <)Av_vUsM+i^t/./2]');
define('AUTH_SALT',        'DK+6LS^~,1q2$,0ppc&w|]Cv2U@|23Wnmnr%[f{Fj+,$cm_O{OB5BmuGSKJZ6e-e');
define('SECURE_AUTH_SALT', '-%CN2L@wZm|46QBAW]dlDoB*hBgy6yhJ0=^Xaoi!f] ^(Q.gbn!?TqW*hV5PIo$K');
define('LOGGED_IN_SALT',   '}Bb6G|Tbi]&E`R?ZWj`?#G2t7QR@$y&G;0!)zeH>>d{Z_]8-WD[A20eA*k9>dGl/');
define('NONCE_SALT',       'I%F3|StG]O 9%T(X$Qw@MgL_rL(0Px/El>)_Fw4[D@U8rXd 4fxdE#&2$C:+eUa2');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mov_';

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
