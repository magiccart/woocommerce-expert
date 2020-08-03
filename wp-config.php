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
define('DB_NAME', 'test');

/** MySQL database username */
define('DB_USER', 'test');

/** MySQL database password */
define('DB_PASSWORD', 'test');

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
/*
$(wget https://api.wordpress.org/secret-key/1.1/salt/ -q -O -)
*/
define('AUTH_KEY',         '=2>9>-S+O,~I|lUHfq -uPS,Zf)drA??Z#O-*E6Fm?6rj-b_{b+#N?Uy}yh!:CF]');
define('SECURE_AUTH_KEY',  '3B:Duw1/`yU_)@}dcYr2)[+=sY?m=|{TaJNn+KS.F4$-AO} JAD*gbD5(K>H5ug5');
define('LOGGED_IN_KEY',    '?/o+:oPI]/S[a} lT>,NDfGhaBK|TPew!-xMfG!C e~>vRF}~A+5vc2c_W4;yJI>');
define('NONCE_KEY',        'OH1olD#NkmUiCm-: |`KWwh8d9I*c>b%8Ui* RpOV*v4xB+sQi!PPMRK;.o@3/zd');
define('AUTH_SALT',        '+%-n(zGW|y/==H-Pw[/D,r@YQamlYiN]0W3#ZI&2z4C3B[9,-3.|fct{>$jvq<R+');
define('SECURE_AUTH_SALT', 'Mq*F6s+C}l.}PEh..xq21}.;C&|Dhu85fa[+XTfOm{eVI.6Cc%4xNeY~xl^6}2Iz');
define('LOGGED_IN_SALT',   'O|dV<!Z,?FxN</~^{vS$+2j4pdu-1-y>Z-V6.N2>0]nGhUEEy!lIHzZ`L Y|R89-');
define('NONCE_SALT',       'VxX@uZ_OY)0}KMrE*$4IgE|;#xFE~ONeb~--njTYlvbA<NbdxzXE.x2,p@9dMJ!x');

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
