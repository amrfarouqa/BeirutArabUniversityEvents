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
define('DB_NAME', 'BAU');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '<!UDNn8vzY6qu|KZCqsb]~+U37&xLr1v(c=a.5^^/m#7oM2n)S2Ge(6^|5xf&cR^');
define('SECURE_AUTH_KEY',  'HbZmT;Ymm:#Aq`jag{r[An_Oc,]3!~0eh0_5=riZ{}gU>R|_)iDUmJ{|ZLoF6T:e');
define('LOGGED_IN_KEY',    '9rs?)^hyuCX#W;6>xxfqy}z8z@^VV{vLR$x{hY)70Cilww21J@SV27;IId1^6>-p');
define('NONCE_KEY',        'rh}J_O-%y`NuusVAM/mMvkAYG92n]}tOE14lh)Tp0%QD@Wb:.s@3sj]p6CXw!hHd');
define('AUTH_SALT',        'm|uCY]8RfSgT)X,q(}<PDf)!.}z#g.YkLwZ<0STZ@0tsU9#TH,D!&`N^Q WVLz)z');
define('SECURE_AUTH_SALT', 'U3]uNlm$G5MeSrYgWcY`y3_lM}GBt|`8@EMay^Gw3_x!i2:r<_.,:)K%Nt+Td_X#');
define('LOGGED_IN_SALT',   '<s:ikUqwpQl,9i ={KDf ng?Y>^J@Dv;2eu6H&;TbAp@?d9g>EEgmS0( VO~#Fo;');
define('NONCE_SALT',       'e^RGE<NX.$v:^pnq<Dm&K,)T9+S!yv^$`H$WUTw9y!7<])NTi#0G3[C&G ME9=&;');

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
