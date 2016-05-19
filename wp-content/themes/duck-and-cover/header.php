<?php
/**
 * The header for our theme.
 *
 * @package FaceWP
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <link rel="shortcut icon" href="<?php echo Kirki::get_option( 'facewp', 'site_favicon' ); ?>">
        <link rel="apple-touch-icon" href="<?php echo Kirki::get_option( 'facewp', 'site_apple_touch_icon' ); ?>" />
    <?php } ?>

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


  <!-- START Friendbuy's SmartPixel -->
  <?php
  if ( is_user_logged_in() ) { ?>
    <?php
      $current_user = wp_get_current_user();
    ?>
    <script>
        window['friendbuy'] = window['friendbuy'] || [];
        window['friendbuy'].push(['site', 'site-d487e0af-sickyeyewear.com']);
        window['friendbuy'].push(['track', 'customer',
          {
            id: '<?php echo $current_user->ID; ?>',
            email: '<?php echo $current_user->user_email; ?>',
            first_name: '<?php echo $current_user->user_firstname; ?>',
            last_name: '<?php echo $current_user->user_lastname; ?>'
          }
        ]);
        (function (f, r, n, d, b, y) {
            b = f.createElement(r), y = f.getElementsByTagName(r)[0];b.async = 1;b.src = n;y.parentNode.insertBefore(b, y);
        })(document, 'script', '//djnf6e5yyirys.cloudfront.net/js/friendbuy.min.js');
    </script>
  <?php } ?>
  <!-- END Friendbuy's SmartPixel -->

  <?php $args = array(
    'post_type' => 'sticky_promo_cta',
    'posts_per_page' => 1
  );
  $the_query = new WP_Query( $args );
  ?>

  <?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="sticky-promo-cta-wrapper">
      <a id="sticky-promo-cta" href="<?php the_field('link');?>"><?php the_field('text');?></a>
      <i><a href="javascript:;" class="sticky-promo-close"></a></i>
    </div>
  <?php endwhile; endif; ?>
  <?php wp_reset_query();?>

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
    <?php wp_nav_menu( array(
        'theme_location'  => 'primary',
        'menu_id'         => 'mobile-menu',
        'menu_class'      => 'mobile-menu',
        'container'       => 'nav',
        'container_id'    => 'mobile-menu-container',
        'container_class' => 'mobile-menu-container',
        'walker'          => new FaceWP_Abbey_Mobile_Walker_Nav_Menu(),
    ) ); ?>
    <div class="col-xs-12">
        <?php echo facewp_abbey_social_links(); ?>
    </div>
</div>

<div id="page" class="page-wrapper">
    <?php require_once( get_template_directory() . '/header/' . Kirki::get_option( 'facewp', 'header_type' ) . '.php' ); ?>

    <?php if ( function_exists( 'wc_print_notices' ) && ! ( is_singular() && get_post_type() == 'product' ) ) : ?>
        <?php wc_print_notices(); // @todo style WC notices when add to cart in quick view ?>
    <?php endif; ?>

    <?php if ( function_exists( 'is_product_category' ) && is_product_category() ) : ?>
        <?php if ( is_product_category() ){
            global $wp_query;

            // get the query object
            $cat = $wp_query->get_queried_object();

            // get the thumbnail id using the queried category term_id
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );

            // get the image URL
            $image = wp_get_attachment_url( $thumbnail_id );
        } ;?>
        <div class="duck-collection-header" style="background-image:url(<?php echo $image ;?>);">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
              <div class="container">
                <h1 class="page-title duck-collection-header-title"><?php woocommerce_page_title(); ?></h1>
              </div>

                <?php $facewp_abbey_category_output = woocommerce_product_subcategories( array(
                                                                                'before' => facewp_abbey_category_loop_start( false ),
                                                                                'after'  => facewp_abbey_category_loop_end( false ),
                                                                            ) ); ?>

            <?php endif; ?>
        </div>
        <div class="duck-collection-description">
          <div class="container">
            <?php
            /**
             * woocommerce_archive_description hook
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
            ?>
          </div>
        </div>
    <?php elseif ( function_exists( 'is_product' ) && is_product() ) : ?>
        <div class="container wide navigation-shop navigation-shop-mobile text-center">
            <div class="row row-xs-center">
              <div class="col-xs-12 center-md">
                <?php woocommerce_breadcrumb(); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="duck-nav-links-wrapper">
                  <div class="duck-nav-links duck-nav-prev">
                    <?php if ( Kirki::get_option( 'facewp', 'woocommerce_single_product_navigation' ) ) : ?>
                      <?php wc_get_template( 'single-product/prev-product.php' ); ?>
                    <?php endif; ?>
                  </div>
                  <div class="duck-nav-links duck-nav-next">
                    <?php if ( Kirki::get_option( 'facewp', 'woocommerce_single_product_navigation' ) ) : ?>
                      <?php wc_get_template( 'single-product/next-product.php' ); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="container wide navigation-shop navigation-shop-desktop">
            <div class="row row-xs-center">
              <div class="col-md-2 start-md">
                <?php if ( Kirki::get_option( 'facewp', 'woocommerce_single_product_navigation' ) ) : ?>
                  <?php wc_get_template( 'single-product/prev-product.php' ); ?>
                <?php endif; ?>
              </div>
              <div class="col-md-8 center-md">
                <?php woocommerce_breadcrumb(); ?>
              </div>
              <div class="col-md-2 end-md">
                <?php if ( Kirki::get_option( 'facewp', 'woocommerce_single_product_navigation' ) ) : ?>
                  <?php wc_get_template( 'single-product/next-product.php' ); ?>
                <?php endif; ?>
              </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="main-content">
        <div class="row">
            <div class="col-xs-12 <?php echo esc_attr( ( 'no-sidebar' != FaceWPC()->get( 'facewp_abbey_sidebar_position' ) && is_active_sidebar( FaceWPC()->get( 'facewp_abbey_sidebar' ) ) ) ? 'col-md-12' : '' ); ?>">
