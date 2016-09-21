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

    <!-- Load jQuery before any other scripts -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

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

  <!-- Google Tag Manager -->
  <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NHGQNZ"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-NHGQNZ');</script>
  <!-- End Google Tag Manager -->

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

  <!-- START Sticky Promo CTA -->
  <?php $args = array(
    'post_type' => 'sticky_promo_cta',
    'posts_per_page' => 1
  );
  $the_query = new WP_Query( $args );
  ?>

  <?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php if( get_field('image') ): ?>
      <div class="sticky-promo-cta-wrapper">
        <?php
          $imagepromo_id = get_field('image');
          $imagepromo_size = 'full-size';
          $imagepromo_array = wp_get_attachment_image_src($imagepromo_id, $imagepromo_size);
          $imagepromo_url = $imagepromo_array[0];
        ?>
        <a id="sticky-promo-cta" href="<?php the_field('link');?>">
          <img src="<?php echo $imagepromo_url; ?>" alt="" />
        </a>
        <i class="sticky-glued"><a href="javascript:;" class="sticky-promo-close"></a></i>
      </div>
    <?php else: ?>
      <div class="sticky-promo-cta-wrapper sticky-rotate">
        <a id="sticky-promo-cta" href="<?php the_field('link');?>"><?php the_field('text');?></a>
        <i><a href="javascript:;" class="sticky-promo-close"></a></i>
      </div>
    <?php endif; ?>
  <?php endwhile; endif; ?>
  <?php wp_reset_query();?>
  <!-- END Sticky Promo CTA -->

  <!-- START Newsletter popup -->
  <div class="duck-newsletter-popup">
    <div class="duck-newsletter-popup-inner">
      <a href="javascript:;" class="js-close-duck-popup duck-popup-close-top fa fa-times"></a>
      <div class="duck-newsletter-center-mobile">
        <div class="duck-newsletter_logo">
          <img src="<?php bloginfo('template_directory'); ?>/assets/img/sicky-logo.png" alt="" />
        </div>
        <h3>Share our vision.</h3>
        <span class="duck-newsletter-text">Join in the creative pursuit with us and get</span>
        <span class="duck-newsletter-20">20% OFF</span>
        <span class="duck-newsletter-text">your first pair of frames.</span>
          <!-- Begin MailChimp Signup Form -->
          <div id="mc_embed_signup">
          <form action="//sickysworld.us6.list-manage.com/subscribe/post?u=c7c2970520d9777ddd5f5f245&amp;id=1f12d1e387" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
            <div class="mc-field-group">
            	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Enter your email address" />
              <input type="submit" value="GIMME, GIMME" name="subscribe" id="mc-embedded-subscribe" class="button" />
              <a href="javascript:;" class="js-close-duck-popup nah-full-price">Nah, I like to pay full price</a>
            </div>
          	<div id="mce-responses" class="clear">
          		<div class="response" id="mce-error-response" style="display:none"></div>
          		<div class="response" id="mce-success-response" style="display:none"></div>
              <a href="javascript:;" class="js-close-duck-popup close-duck-popup">Close</a>
          	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true">
              <input type="text" name="b_c7c2970520d9777ddd5f5f245_1f12d1e387" tabindex="-1" value="">
            </div>
            </div>
          </form>
          </div>
          <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='MMERGE3';ftypes[3]='imageurl';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
          <!--End mc_embed_signup-->
        </div>
    </div>
  </div>
  <!-- END Newsletter popup -->

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
              <div class="container" style="text-align: center;">
                <span class="page-title duck-collection-header-title"><?php woocommerce_page_title(); ?></span>
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
              </div>

                <?php $facewp_abbey_category_output = woocommerce_product_subcategories( array(
                                                                                'before' => facewp_abbey_category_loop_start( false ),
                                                                                'after'  => facewp_abbey_category_loop_end( false ),
                                                                            ) ); ?>

            <?php endif; ?>
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
