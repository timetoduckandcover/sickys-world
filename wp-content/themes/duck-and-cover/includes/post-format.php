<?php

if ( ! function_exists( 'facewp_abbey_register_post_save_action' ) ) {
  function facewp_abbey_register_post_save_action() {
    $post_formats = get_theme_support( 'post-formats' );

    if ( ! empty( $post_formats[0] ) && is_array( $post_formats[0] ) ) {
      if ( in_array( 'quote', $post_formats[0] ) ) {
        add_action( 'save_post', 'facewp_abbey_post_format_save' );
      }
    }
  }

  add_action( 'admin_init', 'facewp_abbey_register_post_save_action' );
}

if ( ! function_exists( 'facewp_abbey_post_format_save' ) ) {
  function facewp_abbey_post_format_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
    }
    if ( ! defined( 'XMLRPC_REQUEST' ) ) {
      if ( isset( $_POST['_format_quote_text'] ) ) {
        update_post_meta( $post_id, '_format_quote_text', $_POST['_format_quote_text'] );
      }
      if ( isset( $_POST['_format_gallery_type'] ) ) {
        update_post_meta( $post_id, '_format_gallery_type', $_POST['_format_gallery_type'] );
      }
    }
  }
}