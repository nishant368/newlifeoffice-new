<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'new2life_newsite');

/** MySQL database username */
define('DB_USER', 'new2life_3');

/** MySQL database password */
define('DB_PASSWORD', 'hi3eZ7iP');

/** MySQL hostname */
define('DB_HOST', 'db146d.pair.com');

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
define('AUTH_KEY',         '-~kVn#mtMV{G,JmX eB]O&rb0p+j)s+~u(9|BZLWbB1$`V*(}1VPY?GEu4W9o-$5');
define('SECURE_AUTH_KEY',  'tvPo!dT3@hh9fNWb_{n`KO?!-iDx;v2-1Gc?F<|i)LauJ0Qw5-4d_+|YZZCe=lIh');
define('LOGGED_IN_KEY',    '`dgqJA4YsN1n%YeZ|eiZ)V }OhcSh[dhOl 8HZcPUV#:YVj#W#|l~lYSY0NX(-]J');
define('NONCE_KEY',        '{/FV0O._0srL]gHaU+Gx%?Rm;3W7|l.x4!=Zn3H|,]]]Tj {st:cF|daDmn.c.-m');
define('AUTH_SALT',        '>!5@ztT.:cqyw=Aj^y+,Ch2OA!U}1q.e9| dA>xi,g0Eo]R[@Xv3:<;|+MGz$bC$');
define('SECURE_AUTH_SALT', 'D!om*37$1_#U4g)<Bn]i,?+mC_XyOg:hAVp3-Lh8Z|`&k@Ds4(vc!w,9WJs3;N|~');
define('LOGGED_IN_SALT',   'qCgC1uY6XY4{fY(m{mU[sR_--CyTychHOK-qN/zO-ZS9H}g(,q/OPzsB}$`%n1L{');
define('NONCE_SALT',       'cm?`szImoDl[s|!!-@F#=+*:<ouT,_+osRksJ)NW-5+z*`_3e2IQW(|84rGN4:e`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_dev_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
