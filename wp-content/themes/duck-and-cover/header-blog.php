<?php
/**
 * The header for blog.
 *
 * @package FaceWP
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <link rel="shortcut icon" href="<?php echo Kirki::get_option( 'facewp', 'site_favicon' ); ?>">
        <link rel="apple-touch-icon" href="<?php echo Kirki::get_option( 'facewp', 'site_apple_touch_icon' ); ?>" />
    <?php } ?>

    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
    <link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?> Atom Feed" href="<?php bloginfo( 'atom_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>

</head>

<?php
$facewp_abbey_header_type = Kirki::get_option( 'facewp', 'header_type' );

$facewp_core = FaceWPC();

$facewp_core->set( 'facewp_abbey_page_layout', facewp_abbey_get_page_layout() );
$facewp_core->set( 'facewp_abbey_sidebar_position', facewp_abbey_get_sidebar_position() );
$facewp_core->set( 'facewp_abbey_sidebar', facewp_abbey_get_sidebar() );
?>

<body <?php body_class(); ?>>

<div id="slide-menu">
    <?php
    $facewp_abbey_language_switcher = facewp_abbey_language_switcher('language-switcher-mobile-menu');
    $facewp_abbey_currency_switcher = facewp_abbey_currency_switcher('currency-switcher-mobile-menu');
    if ( $facewp_abbey_language_switcher || $facewp_abbey_currency_switcher ) {
        ?>
        <div class="col-xs-12 center-xs" id="slide-menu-top">
            <div class="switchers-wrap">
                <?php echo '' . $facewp_abbey_currency_switcher; ?>
                <?php echo '' . $facewp_abbey_language_switcher; ?>
            </div>
            <a class="header-item" href="#"><span class="icon-header pe-7s-user"></span></a>
            <a class="header-item" href="#"><span class="icon-header pe-7s-like"></span></a>
        </div>
    <?php } ?>

    <div class="search-type-2 col-md-12">
        <?php echo facewp_abbey_get_search_form(); ?>
    </div>
    <?php if ( has_nav_menu( 'primary' ) ) : ?>
        <?php wp_nav_menu( array(
            'theme_location'  => 'primary',
            'menu_id'         => 'mobile-menu',
            'menu_class'      => 'mobile-menu',
            'container'       => 'nav',
            'container_id'    => 'mobile-menu-container',
            'container_class' => 'mobile-menu-container',
            'walker'          => new FaceWP_Abbey_Mobile_Walker_Nav_Menu(),
        ) ); ?>
    <?php endif; ?>
    <div class="col-xs-12">
        <?php echo facewp_abbey_social_links(); ?>
    </div>
</div>

<div id="page" class="page-wrapper">
    <?php require_once( get_template_directory() . '/header/' . Kirki::get_option( 'facewp', 'header_type' ) . '.php' ); ?>

    <div class="main-content">
