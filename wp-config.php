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
define('DB_NAME', 'sickysworld');

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
define('AUTH_KEY',         'V[Ui=0^B$k;c-:Q9|Qwb),tB2gC#UPj]@CWzg2S+wKS?XVxG$qnN.8.WRU9.hUk^');
define('SECURE_AUTH_KEY',  '~qT02Xt>KQ<5Ec{0:.wXt;!^0&rag`#VaYegC@JALhB3(83~u$$x:@MiSy{;%*hz');
define('LOGGED_IN_KEY',    '|3uo/C> 6#HXDx`+)D rvKnY7P]LH~<EaO$Ay<l:ehrzkx;rR*RkOBrj0qsT&J7t');
define('NONCE_KEY',        'kbM{{/Wcq;dSoYet]zbU2mDt#@4I{(EmfhOp1N|0={MWRTg$/eV9oW$K%]!dU-Eo');
define('AUTH_SALT',        'fbW-@Y:94I#Pw eA6Zi6ilRF8voQqQ7wQ}Jx]gRp_ir9QZtzBFh>rQY`z,;d(BGI');
define('SECURE_AUTH_SALT', 'wK$A}j1VhfEQevyU^r~ 2pww5B&QkG`a/CF[S1)EkS1}WJ?+LxOj[xTnn$r2uy%{');
define('LOGGED_IN_SALT',   'v7wJD< 4@)s,00w/lrMey/<Qcu<OJacK3~%2qu*L7[p8X^zZ>G%bXHXnI|u(Pvj+');
define('NONCE_SALT',       ')D0{CfxrZb.Ii$T`lr8S(G1x*1--EXIRLup]-@w![8SPy_J N[DC-!9U!!1D?eA{');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
