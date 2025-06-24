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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'T3FSd$Us#K{-6:)WxrIOe=fV.x>lG&ji07%Z|L:10~r!dSBsIeDuqhc+|v+s=3e@' );
define( 'SECURE_AUTH_KEY',   '@lh;~D@;)XZ/-Sz.oa_i,2Gr*sNa8SZf 7tuGnNGZ<l&Z{cAW)G)/05{X5 =_<B;' );
define( 'LOGGED_IN_KEY',     'Vv%k`@YTeVYn/FXyh5a}gwiX=-*Agp?`NixZY.>bgG1 O1,mNn>5KS1=.$tt CqQ' );
define( 'NONCE_KEY',         'M(xio;<PL28KTJ=em#@qjr=Tx(;V?Q3|FXXEVg6G3YfQE {3aICh+bICJ~)@mYZg' );
define( 'AUTH_SALT',         'R)2tvzX-n:a.Uu2bt[&K8KOkppLJEf+Dm1%|r`3v_j4]c:Q(HK6:g(F+MP%{MTuX' );
define( 'SECURE_AUTH_SALT',  '|zAWd===$b.U_ksvg?Z&t?(sou}SOMj&9x(umTPKQk?Evv2.c4.F=>IXU(H]dVoo' );
define( 'LOGGED_IN_SALT',    'xO6e[;O`JeNS<,exMx[|@M3<DcsF%V1=e~2 GX>R?UWW@<^uhI2W<r89GTOOz KS' );
define( 'NONCE_SALT',        '~5XIh.PS4j8Dib4VNAm](BY&&.xF|VC~o[VO2.#,Y?uo)|3TVH}kD^}dTMfHLh#e' );
define( 'WP_CACHE_KEY_SALT', 'px0^Ma+%`hRVVk!_D5,=!A449})v._nW^ZA;!I9Zf)~WFlWQ*zmg0&1N-zm_h}K?' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

// ** Disable file editing in the admin dashboard for security ** //
define('DISALLOW_FILE_EDIT', true);

// ** Disable the WordPress default RSS feeds (optional) ** //
define('DISABLE_WP_CRON', true);

// ** Set WP to use object cache (optional) ** //
define('WP_CACHE', true);

// ** Performance: Set higher PHP memory limit (optional) ** //
define('WP_MEMORY_LIMIT', '2048M');

// ** Disable XML-RPC if not used ** //
// define('XMLRPC_REQUEST', false);

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
    define( 'WP_DEBUG', true ); // Enable debug mode
}
if ( ! defined( 'WP_DEBUG_LOG' ) ) {
    define( 'WP_DEBUG_LOG', false ); // Log errors to /wp-content/debug.log
}
if ( ! defined( 'WP_DEBUG_DISPLAY' ) ) {
    define( 'WP_DEBUG_DISPLAY', false ); // Hide errors on production sites
}
if ( ! defined( 'SCRIPT_DEBUG' ) ) {
    define( 'SCRIPT_DEBUG', true ); // Load unminified scripts and stylesheets
}
if ( ! defined( 'SAVEQUERIES' ) ) {
    define( 'SAVEQUERIES', true ); // Log DB queries
}


define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
