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
define('DB_NAME', 'fptcity');

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
define('AUTH_KEY',         'C+D%Y,ToKCo6bqyDmhosK|<cgQq4LDlr54-Bqf]vY)MODS4Eno~Mk1UE6x!Hh(g!');
define('SECURE_AUTH_KEY',  '>aBMFIA++h-vGx28/ 0tLH~XpFU_^CL|hPB3$Iy7V}PfSRs%co],MSNwN58]Nv-:');
define('LOGGED_IN_KEY',    '@NE|`ot>PB2+!s<_ukEabwr-Ak|a#<G,Oz~l~; 5t>!N|,>Xs2r/MS%VDXA;VQ9?');
define('NONCE_KEY',        '`b!+G6dMRU:xpdqj3FncUYcwSi+$>paF./IG`gu-A46<Q!.UZ%seuv$ocQFWa,!Y');
define('AUTH_SALT',        '+z-5992_^IhCP|uH &M/|IJ9uMJLq?A3HrK+0+:QkRJ{yhld:ZM`~D(wJOTJ-!YP');
define('SECURE_AUTH_SALT', '&yuZJS1p*Ob-*,E]=WK{f=t&K>)M2s,mzW|!TWizL!#!H6}iv*b.][.h|3Aviov:');
define('LOGGED_IN_SALT',   '+3I%-MMHjF%Zd^0Y6)4T+t}hM?F8-08o@b9|pI7ABWjj#m9*s:UEG>!|ZYU:)|=Z');
define('NONCE_SALT',       'N4_#0$?r!neh)f01l>4t{iL +^w+FuUqYBb{-b,=uhv$nO:ga5(g+Lp^<RXYlw*R');

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
