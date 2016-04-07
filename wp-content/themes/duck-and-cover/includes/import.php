<?php
add_filter( 'facewp_abbey_import_demos', function ( $demos ) {
	return array(
		'abbey' => array(
			'screenshot' => FaceWP_Abbey_THEME_URL . '/screenshot.jpg',
			'name'       => 'Abbey'
		)
	);
} );

add_filter( 'facewp_abbey_import_types', function ( $type ) {
	return array(
		'all'          => esc_html__( 'All', 'facewp-abbey' ),
		'content'      => esc_html__( 'Content', 'facewp-abbey' ),
		'page_options' => esc_html__( 'Page Options', 'facewp-abbey' ),
		'menus'        => esc_html__( 'Menu', 'facewp-abbey' ),
		'widgets'      => esc_html__( 'Widgets', 'facewp-abbey' ),
		'rev_slider'   => esc_html__( 'Revolution Slider', 'facewp-abbey' ),
		'woocommerce_settings'   => esc_html__( 'WooCommerce Settings', 'facewp-abbey' ),
	);
} );