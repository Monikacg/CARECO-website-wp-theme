<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/2/c/careco/www/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager

define('DB_NAME', 'carecono01');

/** MySQL database username */
define('DB_USER', 'carecono01');

/** MySQL database password */
define('DB_PASSWORD', 'tone-Jolestri-gojim-7vevskole');

/** MySQL hostname */
define('DB_HOST', 'carecono01.mysql.domeneshop.no');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '5bF+w1ZVJ>)LspsnOpTUD#jYlhIMBZq.&E>LLCi1TiR@*[nkvJ9a!9uE;y1V-$S9g');
define('SECURE_AUTH_KEY',  'Golb>>pE(6FYUG)ZJ<-zE$tfq#S$6p!pJEX0I`qR)FG|H*v2.pBJ]C*dA+Q{>k,eN');
define('LOGGED_IN_KEY',    'n:PXeCm?=v7:(,7=XenrXZ*}iLewDg/Y[Hgq>J%zL>Kx=2}Hg4Q50Mr<2q`Nf_e+3');
define('NONCE_KEY',        '|HwgI{f_[MeUnjE:kGyXUoPN2^%L?<bioxFJ6Q@tTDIq1d8Rmu{7aYYy$iR*N{GxY');
define('AUTH_SALT',        '_N+1Eank8G{7jQ[R!8n7Q;AxGS/CTVP$IJP{<?SYfzMOm)fc,/@+p37SBDWIlpuQn');
define('SECURE_AUTH_SALT', '!iUm)crl1n*B}<`PrA]MH=QG}hw^Zz`#bg6rr[32Z-BazMYa2y_D_FlJutHDCpuI5');
define('LOGGED_IN_SALT',   'q}Gv<>+gv*FBMkI4>8W0$Y$sjDh@=rEhMcvxahZFygK>tEClQg?p7>X#PB?*J0yf(');
define('NONCE_SALT',       '99b]<OtSq>*z3OyqfT>r2jv^%!20PJ$hXTxAUcZS!qC/Sd+@Uq(5&^C!v(3tZH0Up');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'hycx0_';

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
