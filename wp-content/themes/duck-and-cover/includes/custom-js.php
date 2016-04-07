<?php function facewp_abbey_js_custom_code() { ?>
    <?php echo html_entity_decode( Kirki::get_option( 'facewp', 'custom_js' ) ); ?>
<?php }

add_action( 'wp_footer', 'facewp_abbey_js_custom_code' );
