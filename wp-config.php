<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
// [System edited file at 2023-03-21T05:11:26.000081121Z ]
// define('DB_NAME', 'konstantinos');
define( 'DB_NAME','awj2nsocppjhwdjy_konstantinos');

/** MySQL database username */
// [System edited file at 2023-03-21T05:11:26.000120861Z ]
// define('DB_USER', 'yscr_bbGKPX');
define( 'DB_USER','awj2nsocppjhwdjy_yscrbbGKPX');

/** MySQL database password */
define('DB_PASSWORD', 'UGXwaFSGIEzr');

/** MySQL hostname */
define('DB_HOST', 'mysql');

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
define('AUTH_KEY',         '2z621xOEvivBMruwKCsKfyEcqTmmvJK2Vx6luEHDV5JI3HVAJJMrEpRdpN5XIHnY');
define('SECURE_AUTH_KEY',  'fai93c9S1P6bqsdqxxyMRjAc1D7k7GdxiU9zTPEbfuEhy8mOF9Hmrhi2bMO19NIl');
define('LOGGED_IN_KEY',    'ProG5wh0KAoYeXzmUXBO9HzditwjVbshsDGGCraVTd6yijzUEPaORews5jGvmPnu');
define('NONCE_KEY',        'jPwMqDO8LD82XlnW6dkQSeSdEjmXk9KgIyIvSU8DM8GUEUPoCKtr5MO1WC9xCAB4');
define('AUTH_SALT',        'V9CkqXYfvoqPNQJSvFnScAReV9JW9D00SfeCBwBqrQ8co83wBrVRtJ3pQ714PCif');
define('SECURE_AUTH_SALT', 'pxKqN3wpwraSxcztGU8UT79gkYzBxDk19agrR0z6kLIyKJl0zoduGijXGsv48nwO');
define('LOGGED_IN_SALT',   '2QQ0NnEwgesGlHVr4n9Wdv8fBQYAm8zKjSNAAB3SYuaPuWw6w5FW7fxoAWnAlpbX');
define('NONCE_SALT',       'C8WxPHOD0YKsbfinrNcWwT7gSGmz9AMuvzjHhdwFDbB7eaJevL8pvaLMurf7ytR9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'asb_';

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

/* kko 15/8/2023 */
@ini_set('upload_max_size' , '256M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
