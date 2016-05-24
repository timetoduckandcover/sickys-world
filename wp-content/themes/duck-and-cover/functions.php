<?php

define( 'FacewWP_THEME_PREFIX', 'facewp_abbey_' );
define( 'FaceWP_Abbey_EMAIL', 'hifacewp@gmail.com' );
define( 'FaceWP_Abbey_THEME_DIR', get_template_directory() . '/' );
define( 'FaceWP_Abbey_THEME_URL', get_template_directory_uri() );

// Custom image sizes
// add_image_size('thumb-size', 410);
// add_image_size('list-size', 600);
add_image_size('single-size', 930);
add_image_size('full-size', 2000);
add_image_size('custom-crop', 500, 500, array( 'center', 'center' ));

// Filters
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 1000;' ), 20 );

require_once( FaceWP_Abbey_THEME_DIR . 'core/core.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/init.php' );

// Post thumbnails
function my_theme_thumb() {
set_post_thumbnail_size( 400, 400, true );
}
add_action( 'after_setup_theme', 'my_theme_thumb', 11 );

// Remove additional information tab
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
  unset( $tabs['additional_information'] );  	// Remove the additional information tab
  return $tabs;
}

// Rename description tab
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
	$tabs['description']['title'] = __( 'Tech' );		// Rename the description tab
	return $tabs;
}

// Replace paypal icon
function replacePayPalIcon($iconUrl) {
	return get_bloginfo('stylesheet_directory') . '/assets/img/paypal-new-logo.png';
}
add_filter('woocommerce_paypal_icon', 'replacePayPalIcon');
