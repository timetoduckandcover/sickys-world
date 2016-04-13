// Header box content
<div class="container main-content <?php echo esc_attr( facewp_abbey_get_page_layout() ); ?>">

// Footer pull in widgets
<?php require_once( get_template_directory() . '/footer/' . Kirki::get_option( 'facewp', 'footer_type' ) . '.php' ); ?>
