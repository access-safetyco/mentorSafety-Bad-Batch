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
define( 'DB_NAME', 'andcapical_wp_pc59m' );

/** Database username */
define( 'DB_USER', 'andcapical_wp_x7fz0' );

/** Database password */
define( 'DB_PASSWORD', '_1jvQ4ZCipi5LUr%' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

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
define('AUTH_KEY', 'LZ7P;tnT&0U13U5A3BCM_3@Rtb0(C0x[9:/]8%H&a1%u!79iPE0lL0n2x7RQ5o;*');
define('SECURE_AUTH_KEY', '0uGv~lUD)z:_vV4tiJqT*2b/5W#]S*~*!1/:j9qAf@p35JiIzmLd]u;[5TtQH313');
define('LOGGED_IN_KEY', 'LWy71IqG[0IBlGan5%]%~4r8B32!R6zZ4m9~#vYU(0(s+5TU#(J*%oJYJF-ETZr/');
define('NONCE_KEY', '3W!rPk@Gp0~C50/T|Z%b16lyz8xe7bjc7MN6b(/_2Oe/#v3*u7:k|uQV7%ylA71+');
define('AUTH_SALT', '47~d9GH0Fq(zEC7/+3_4+:8jQJ322090XX;0J-]Wz8:Gd4*uz;wJ(4h+YBwM1K6e');
define('SECURE_AUTH_SALT', '[UYS@trc~E)v2C81V]h[3dE0Eg#+pYbRJeb1*682A_O*CiK*DD2Eb#ARSg%CeO7*');
define('LOGGED_IN_SALT', '86(!-3W&e9H~4()U]sd16m]IV0X6o02:D8-|rPhc%45z7m_1P~RVO7NAsEcU4]:|');
define('NONCE_SALT', 'Ca9D]la_Vfm6z5!oj~6E2Kaz605yvaFsz%b7+2-*h]|1eG5Pzn9Q4qor(6Ba#0G_');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'VxPnnTfB_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
define('WP_AUTO_UPDATE_CORE', false);

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
