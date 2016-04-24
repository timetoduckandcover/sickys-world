<?php

define( 'FacewWP_THEME_PREFIX', 'facewp_abbey_' );
define( 'FaceWP_Abbey_EMAIL', 'hifacewp@gmail.com' );
define( 'FaceWP_Abbey_THEME_DIR', get_template_directory() . '/' );
define( 'FaceWP_Abbey_THEME_URL', get_template_directory_uri() );

// Custom image sizes
add_image_size('thumb-size', 410);
add_image_size('list-size', 600);
add_image_size('single-size', 930);
add_image_size('full-size', 2000);

// Filters
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 1000;' ), 20 );

require_once( FaceWP_Abbey_THEME_DIR . 'core/core.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/init.php' );
