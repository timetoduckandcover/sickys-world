<?php
/*
Plugin Name: FaceWP Toolkit
Description: Toolkit for FaceWP Theme
Author: FaceWP
Version: 1.2
Author URI: http://FaceWP.com
*/

define( 'FaceWP_Toolkit_URL', plugins_url( '', __FILE__ ) . '/'  );
define( 'FaceWP_Toolkit_PATH', plugin_dir_path( __FILE__ )  );

require_once( 'import/class-facewp-admin-import.php' );
require_once( 'export/class-facewp-admin-export.php' );

require_once ( 'widgets/widgets.php' );
require_once ( 'tf.php' );