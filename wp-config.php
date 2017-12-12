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

// echo "datos";

define('DB_NAME', 'marca');

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
define('AUTH_KEY',         'k4~c6@`{E@.~3n(Z><Yb)>-<N*rZPV%8{K^{z.W(rpYUSAA^FB1,7ohw+h:sM= 1');
define('SECURE_AUTH_KEY',  'vqkL>l#nM|F{G4qgzi#ig%LIr,kvlQmvH<EEy8.W}.F~%vTX]=f ,gq<e^Se (WU');
define('LOGGED_IN_KEY',    'Trr{j]OF#nUQERz18]aIp&I8hg.m/@cbvQu14<NLnC`[A<Ok8=H|)<rH*%=fDkj_');
define('NONCE_KEY',        'sj_zblvv>vhvSC!+tI#gyR9(b&REAWf,tS)e_!.9V&rOPzwHI_#u2)3TFjw:hEh0');
define('AUTH_SALT',        '8%tflk+#h^qR0o@%5xS1 aa]izuJHAf1t4yDv,X21}^aR3+NLzwR)J>jlhJX`%W!');
define('SECURE_AUTH_SALT', 'M-[Cv!X5TSf%yZeI#QQtKc@R7_m ZqHq%?cVMJyd7Q8iPVlT3)H`X16HtGXue|Ym');
define('LOGGED_IN_SALT',   'MqVH>2,(LP-;sOFGlbW~#X[PYxDV]M=.u03[E9F>(SMRs(2M8$~TN0_DhC19,d3A');
define('NONCE_SALT',       '@;*.zko%#tbDcu%5_&EE=m7xV)zkRPWESSUoU|..HIR7_>YG<]GiJNw~u?x^P<1(');

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
