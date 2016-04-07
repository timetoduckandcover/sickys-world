<?php
/**
 * FaceWP Theme Customizer
 *
 * @package FaceWP
 */

/**
 * Remove Default Sections
 */
function facewp_abbey_remove_customizer_sections( $wp_customize ) {
    $wp_customize->remove_section( 'header_image' );
}

add_action( 'customize_register', 'facewp_abbey_remove_customizer_sections' );

/**
 * Setting Customizer
 */

Kirki::add_config( 'facewp', array(
    'options_type' => 'theme_mod',
    'capability'   => 'edit_theme_options',
) );

$panel_priority = 0;
$panels = apply_filters( 'facewp_abbey_customizer_panels', array(
    'site' => array(
        'title'       => esc_html__('General Settings', 'facewp-abbey'),
        'priority'    => 1,
    ),
    'header' => array(
        'title'       => esc_html__('Header Settings', 'facewp-abbey'),
        'priority'    => 2,
    ),
    'footer' => array(
        'title'       => esc_html__('Footer Settings', 'facewp-abbey'),
        'priority'    => 3,
    ),
    'woocommerce' => array(
        'title'       => esc_html__('Woocommerce Settings', 'facewp-abbey'),
        'priority'    => 4,
    ),
    'post' => array(
        'title'       => esc_html__('Post Settings', 'facewp-abbey'),
        'priority'    => 5,
    ),
) );

$section_priority = 0;
$sections = apply_filters( 'facewp_abbey_customizer_sections', array(
    //Site
    'site_layout' => array(
        'title'       => esc_html__('Theme Layout', 'facewp-abbey'),
        'panel'       => 'site',
        'priority'    => $section_priority++,
    ),
    'site_logo' => array(
        'title'       => esc_html__('Logo and Icons', 'facewp-abbey'),
        'panel'       => 'site',
        'priority'    => $section_priority++,
    ),
    'site_font' => array(
        'title'       => esc_html__('Typography', 'facewp-abbey'),
        'panel'       => 'site',
        'priority'    => $section_priority++,
    ),
    'site_style' => array(
        'title'       => esc_html__('Style', 'facewp-abbey'),
        'panel'       => 'site',
        'priority'    => $section_priority++,
    ),
    'site_social' => array(
        'title'       => esc_html__('Social', 'facewp-abbey'),
        'panel'       => 'site',
        'priority'    => $section_priority++,
    ),
    'site_breadcrumb' => array(
        'title'       => esc_html__('Breadcrumb', 'facewp-abbey'),
        'panel'       => 'site',
        'priority'    => $section_priority++,
    ),

    //Header
    'header_preset' => array(
        'title'       => esc_html__('Preset', 'facewp-abbey'),
        'panel'       => 'header',
        'priority'    => $section_priority++,
    ),
    'header_type' => array(
        'title'       => esc_html__('General', 'facewp-abbey'),
        'panel'       => 'header',
        'priority'    => $section_priority++,
    ),
    'header_style' => array(
        'title'       => esc_html__('Style', 'facewp-abbey'),
        'panel'       => 'header',
        'priority'    => $section_priority++,
    ),
    'header_primary_menu' => array(
        'title'       => esc_html__( 'Primary Menu', 'facewp-abbey' ),
        'panel'       => 'header',
        'priority'    => $section_priority++,
    ),
    'header_menu_dropdown' => array(
        'title'       => esc_html__( 'Menu Dropdown', 'facewp-abbey' ),
        'panel'       => 'header',
        'priority'    => $section_priority++,
    ),
    'header_vertical_menu' => array(
        'title'       => esc_html__( 'Vertical Menu', 'facewp-abbey' ),
        'panel'       => 'header',
        'priority'    => $section_priority++,
    ),
    'header_sticky' => array(
        'title'       => esc_html__( 'Sticky Header', 'facewp-abbey' ),
        'panel'       => 'header',
        'priority'    => $section_priority++,
    ),

    //Post
    'post_archives' => array(
        'title'       => esc_html__('Post Archives', 'facewp-abbey'),
        'panel'       => 'post',
        'priority'    => $section_priority++,
    ),
    'post_single' => array(
        'title'       => esc_html__('Single Post', 'facewp-abbey'),
        'panel'       => 'post',
        'priority'    => $section_priority++,
    ),
    'post_general' => array(
        'title'       => esc_html__('General', 'facewp-abbey'),
        'panel'       => 'post',
        'priority'    => $section_priority++,
    ),
    'post_layout' => array(
        'title'       => esc_html__('Layout', 'facewp-abbey'),
        'panel'       => 'post',
        'priority'    => $section_priority++,
    ),
    //Page
    'page' => array(
        'title'       => esc_html__('Page Settings', 'facewp-abbey'),
        'priority'    => $section_priority++,
    ),

    //Footer
    'footer_preset' => array(
        'title'       => esc_html__('Preset', 'facewp-abbey'),
        'panel'       => 'footer',
        'priority'    => $section_priority++,
    ),
    'footer_general' => array(
        'title'       => esc_html__('General', 'facewp-abbey'),
        'panel'       => 'footer',
        'priority'    => $section_priority++,
    ),
    'footer_color' => array(
        'title'       => esc_html__('Color', 'facewp-abbey'),
        'panel'       => 'footer',
        'priority'    => $section_priority++,
    ),
    'footer_copyright' => array(
        'title'       => esc_html__('Copyright', 'facewp-abbey'),
        'panel'       => 'footer',
        'priority'    => $section_priority++,
    ),
    'footer_extra_info' => array(
        'title'       => esc_html__('Extra Information', 'facewp-abbey'),
        'panel'       => 'footer',
        'priority'    => $section_priority++,
    ),

    //Woocommerce
    'woocommerce_general' => array(
        'title'       => esc_html__('General', 'facewp-abbey'),
        'panel'       => 'woocommerce',
        'priority'    => $section_priority++,
    ),
    'woocommerce_archives' => array(
        'title'       => esc_html__('Product Archives', 'facewp-abbey'),
        'panel'       => 'woocommerce',
        'priority'    => $section_priority++,
    ),
    'woocommerce_single' => array(
        'title'       => esc_html__('Single Product', 'facewp-abbey'),
        'panel'       => 'woocommerce',
        'priority'    => $section_priority++,
    ),
    'woocommerce_style' => array(
        'title'       => esc_html__('Style', 'facewp-abbey'),
        'panel'       => 'woocommerce',
        'priority'    => $section_priority++,
    ),

    // Promo Popup
    'promo_popup' => array(
        'title'       => esc_html__('Promo Popup', 'facewp-abbey'),
        'priority'    => $section_priority,
    ),

    //Custom Code
    'custom_code' => array(
        'title'       => esc_html__('Custom Code', 'facewp-abbey'),
        'priority'    => $section_priority++,
    ),
) );

foreach ( $panels as $panel_id => $panel ) {
    Kirki::add_panel( $panel_id, $panel );
}

foreach ( $sections as $section_id => $section ) {
    Kirki::add_section( $section_id, $section );
}

/**
 * Include settings
 * ================
 */
//Site
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/site/site_layout.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/site/site_logo.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/site/site_font.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/site/site_social.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/site/site_style.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/site/site_breadcrumb.php' );

//Header
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/header/preset.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/header_general.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/header_style.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/header_search.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/header/primary-menu.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/header/menu-dropdown.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/header/vertical-menu.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/header/sticky.php' );

//Woocommerce
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/woocommerce/general.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/woocommerce/archives.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/woocommerce/single.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/woocommerce/style.php' );

//Post
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/post/archives.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/post/single.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/post_general.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/post_layout.php' );

//Page
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/page.php' );

//Footer
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/footer_preset.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/footer_general.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/footer_copyright.php' );
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/footer_extra_info.php' );

// Promo Popup
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/promo-popup.php' );

//Custom Code
require_once( FaceWP_Abbey_THEME_DIR . 'includes/customizer/settings/custom_code.php' );

function facewp_abbey_custom_background_cb() {
    // $background is the saved custom image, or the default image.
    $background = set_url_scheme( get_background_image() );

    if ( is_page() ) {
        $_background_image      = get_post_meta( get_the_ID(), 'facewp_abbey_background_image', true );
        $_background_position   = get_post_meta( get_the_ID(), 'facewp_abbey_background_position', true );
        $_background_repeat     = get_post_meta( get_the_ID(), 'facewp_abbey_background_repeat', true );
        $_background_attachment = get_post_meta( get_the_ID(), 'facewp_abbey_background_attachment', true );


        if ( $_background_image ) {
            $background = $_background_image;
        }
    }

    // $color is the saved custom color.
    // A default has to be specified in style.css. It will not be printed here.
    $color = get_background_color();

    if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
        $color = false;
    }

    if ( ! $background && ! $color )
        return;

    $style = $color ? "background-color: #$color;" : '';

    if ( $background ) {
        $image = " background-image: url('$background');";

        $repeat = ( ! empty( $_background_image ) && ! empty( $_background_repeat ) ) ? $_background_repeat : get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
        if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
            $repeat = 'repeat';
        $repeat = " background-repeat: $repeat;";

        if ( ! empty( $_background_image ) && ! empty( $_background_position ) ) {
            $position = ' background-position: ' . $_background_position . ';';
        } else {
            $position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
            if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
                $position = 'left';
            $position = " background-position: top $position;";
        }

        if ( ! empty( $_background_image ) && ! empty( $_background_attachment ) ) {
            $attachment = ' background-attachment: ' . $_background_attachment . ';';
        } else {
            $attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
            if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
                $attachment = 'scroll';
            $attachment = " background-attachment: $attachment;";
        }

        $style .= $image . $repeat . $position . $attachment;
    }
    ?>
    <style type="text/css" id="custom-background-css">
        body.custom-background { <?php echo trim( $style ); ?> }
    </style>
    <?php
}
