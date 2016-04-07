<?php
function facewp_abbey_scripts() {
    // @todo remove prefix to pass theme review
    // @todo add theme version in scrips
    wp_enqueue_style( 'facewp-pe-icon-7-stroke', FaceWP_Abbey_THEME_URL . '/assets/lib/pe-icon-7-stroke/css/pe-icon-7-stroke.css' );
    wp_enqueue_style( 'facewp-style-font-awesome', FaceWP_Abbey_THEME_URL . '/assets/lib/font-awesome/css/font-awesome.min.css' );
    //todo: fix kirki load font. remove when done.
    wp_enqueue_style( 'facewp-style-font-lato', 'https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext' );
    wp_enqueue_style( 'facewp-style-font-montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,700' );

    // Slide Menu
    wp_enqueue_script( 'slide-menu', FaceWP_Abbey_THEME_URL . '/assets/lib/slide-menu.js', array( 'jquery' ), null, true );

    // Slick
    wp_enqueue_style( 'facewp-style-slick', FaceWP_Abbey_THEME_URL . '/assets/lib/slick/slick.css' );
    wp_enqueue_style( 'facewp-style-slick-theme', FaceWP_Abbey_THEME_URL . '/assets/lib/slick/slick-theme.css' );
    wp_enqueue_script( 'facewp-js-slick', FaceWP_Abbey_THEME_URL . '/assets/lib/slick/slick.min.js', array( 'jquery' ), null, true );

    // Magnific Popup
    wp_enqueue_style( 'facewp-style-magnific', FaceWP_Abbey_THEME_URL . '/assets/lib/magnific-popup/magnific-popup.css' ); // @todo: merged into theme?
    wp_enqueue_script( 'facewp-js-magnific', FaceWP_Abbey_THEME_URL . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), null, true );

    // Swipebox
    wp_enqueue_style( 'facewp-swipebox', FaceWP_Abbey_THEME_URL . '/assets/lib/swipebox/css/swipebox.css', array(), null );
    wp_enqueue_script( 'facewp-swipebox', FaceWP_Abbey_THEME_URL . '/assets/lib/swipebox/js/jquery.swipebox.js', array( 'jquery' ), '20150330', true );

    // elevatezoom
    wp_enqueue_script( 'facewp-js-elevatezoom', FaceWP_Abbey_THEME_URL . '/assets/lib/elevatezoom/jquery.elevateZoom-3.0.8.min.js', array( 'jquery' ), null, true );

    // Bootstrap
    wp_enqueue_script( 'facewp-js-bootstrap', FaceWP_Abbey_THEME_URL . '/assets/lib/bootstrap/bootstrap.min.js', array( 'jquery' ), null, true );

    // Count Down
    wp_enqueue_script( 'facewp-js-countdown', FaceWP_Abbey_THEME_URL . '/assets/lib/countdown/jquery.countdown.js', array( 'jquery' ), null, true );

    // Isotope
    wp_enqueue_script( 'facewp-js-isotope', FaceWP_Abbey_THEME_URL . '/assets/lib/isotope/isotope.pkgd.min.js', array( 'jquery' ), null, true );

    // Count Up
    wp_register_script( 'facewp-js-count-up', FaceWP_Abbey_THEME_URL . '/assets/lib/countUp/countUp.min.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'facewp-js-snap', FaceWP_Abbey_THEME_URL . '/assets/lib/snap.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'facewp-js-wow', FaceWP_Abbey_THEME_URL . '/assets/lib/wow.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'facewp-js-masonry', FaceWP_Abbey_THEME_URL . '/assets/lib/masonry/masonry.pkgd.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'facewp-js-imagesLoaded', FaceWP_Abbey_THEME_URL . '/assets/lib/masonry/imagesloaded.pkgd.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'fitvids', FaceWP_Abbey_THEME_URL . '/assets/lib/fitvids/fitvids.js', array( 'jquery' ), null, true );

    // Google Maps
    wp_register_script( 'googleapis', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), null , false );

    if( ! is_single() ) {
        wp_dequeue_script( 'jm_like_post' );
    }
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_style( 'facewp-style', FaceWP_Abbey_THEME_URL . '/style.css' );
    wp_enqueue_style( 'facewp-main', FaceWP_Abbey_THEME_URL . '/assets/css/main.css' );

    wp_enqueue_script( 'facewp-js-main', FaceWP_Abbey_THEME_URL . '/assets/js/main.js', array( 'jquery' ), null, true );
    wp_localize_script( 'facewp-js-main', 'facewp_abbey_params', array(
        'ajax_url'         => esc_js( admin_url( 'admin-ajax.php' ) ),
        'wc_ajax_url'      => class_exists( 'WooCommerce' ) && version_compare( WC_VERSION, '2.4', '>=' ) ? WC_AJAX::get_endpoint( "%%endpoint%%" ) : '',
        'i18n_days'        => __( 'Days', 'facewp-abbey' ),
        'i18n_hours'       => __( 'Hours', 'facewp-abbey' ),
        'i18n_mins'        => __( 'Mins', 'facewp-abbey' ),
        'i18n_secs'        => __( 'Secs', 'facewp-abbey' ),
        'promo_popup_show' => Kirki::get_option( 'facewp', 'promo_popup_show' ),
    ) );
}

add_action( 'wp_enqueue_scripts', 'facewp_abbey_scripts' );

/**
 * Setup custom css.
 */
function facewp_abbey_custom_css() {
    $facewp_abbey_custom_css = Kirki::get_option( 'facewp', 'custom_css' );
    wp_add_inline_style( 'facewp-main', html_entity_decode( $facewp_abbey_custom_css, ENT_QUOTES ) );
}

add_action( 'wp_enqueue_scripts', 'facewp_abbey_custom_css' );