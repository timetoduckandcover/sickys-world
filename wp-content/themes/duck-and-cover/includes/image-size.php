<?php
/*
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
if ( ! function_exists( 'facewp_abbey_add_image_size' ) ) :
    function facewp_abbey_add_image_size() {
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'facewp-abbey-full-thumb', 1170, 0, true );
        add_image_size( 'facewp-abbey-grid-thumb', 370, 0, true );
        add_image_size( 'facewp-abbey-list-thumb', 370, 300, true );
        add_image_size( 'facewp-abbey-grid-style1', 370, 390, true );
        add_image_size( 'facewp-abbey-grid-style2', 960, 500, true );
    }
endif;
add_action( 'after_setup_theme', 'facewp_abbey_add_image_size' );