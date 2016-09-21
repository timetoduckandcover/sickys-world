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

// Strip leading zeros from blog posts
add_filter( 'the_permalink', 't5_strip_leading_zeros_in_url' );
add_filter( 'month_link', 't5_strip_leading_zeros_in_url' );
add_filter( 'day_link',   't5_strip_leading_zeros_in_url' );
function t5_strip_leading_zeros_in_url( $url )
{
  // no pretty permalinks
  if ( ! $GLOBALS['wp_rewrite']->get_month_permastruct() )
  {
    return $url;
  }
  return str_replace( '/0', '/', $url );
}

// Only show 3 related products on 1 row
function woocommerce_output_related_products() {
  woocommerce_related_products(3,1);
}

// Change yoast SEO sitemap frequency
add_filter( 'wpseo_sitemap_product_single_change_freq', 'my_custom_freq', 10, 2 );
add_filter( 'wpseo_sitemap_homepage_change_freq', 'my_custom_freq', 10, 2 );
add_filter( 'wpseo_sitemap_blogpage_change_freq', 'my_custom_freq', 10, 2 );
add_filter( 'wpseo_sitemap_post_single_change_freq', 'my_custom_freq', 10, 2 );
add_filter( 'wpseo_sitemap_product_archive_change_freq', 'my_custom_freq', 10, 2 );
add_filter( 'wpseo_sitemap_page_single_change_freq', 'my_custom_freq', 10, 2 );
add_filter( 'wpseo_sitemap_product_brand_term_change_freq', 'my_custom_freq', 10, 2 );
add_filter( 'wpseo_sitemap_product_cat_term_change_freq', 'my_custom_freq', 10, 2 );
function my_custom_freq( $default, $url ) {
  return 'daily';
}

/**
 * Adds product images to the WooCommerce order emails table
 * Uses WooCommerce 2.5 or newer
 *
 * @param string $output the buffered email order items content
 * @param \WC_Order $order
 * @return $output the updated output
 */
function sww_add_images_woocommerce_emails( $output, $order ) {

	// set a flag so we don't recursively call this filter
	static $run = 0;

	// if we've already run this filter, bail out
	if ( $run ) {
		return $output;
	}

	$args = array(
		'show_image'   	=> true,
		'image_size'    => array( 100, 100 ),
	);

	// increment our flag so we don't run again
	$run++;

	// if first run, give WooComm our updated table
	return $order->email_order_items_table( $args );
}
add_filter( 'woocommerce_email_order_items_table', 'sww_add_images_woocommerce_emails', 10, 2 );


/**
 *Reduce the strength requirement on the woocommerce password.
 *
 * Strength Settings
 * 3 = Strong (default)
 * 2 = Medium
 * 1 = Weak
 * 0 = Very Weak / Anything
 */
function reduce_woocommerce_min_strength_requirement( $strength ) {
    return 1;
}
add_filter( 'woocommerce_min_password_strength', 'reduce_woocommerce_min_strength_requirement' );

/**
 * Add discount code to admin-new-order.php template
 */
add_action( 'woocommerce_email_after_order_table', 'add_discount_info', PHP_INT_MAX, 3 );
function add_discount_info( $_order, $sent_to_admin, $plain_text ) {
   if ( true === $sent_to_admin && 0 != $_order->get_total_discount() ) {
       echo '<p>' . 'Discount: ' . $_order->get_discount_to_display() . '</p>';
   }
}
