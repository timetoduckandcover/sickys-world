<?php
/**
 * Single Product Image
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$lightbox_enable = Kirki::get_option( 'facewp', 'woocommerce_single_enable_lightbox' );
$zoom_type       = Kirki::get_option( 'facewp', 'woocommerce_single_zoom_effect' );

if ( 'window' == $zoom_type ) {
    $zoom_window_width  = Kirki::get_option( 'facewp', 'woocommerce_single_zoom_window_width' );
    $zoom_window_height = Kirki::get_option( 'facewp', 'woocommerce_single_zoom_window_height' );
} else if ( 'lens' == $zoom_type ) {
    $lens_size = Kirki::get_option( 'facewp', 'woocommerce_single_zoom_lens_size' );
}

if ( 'window' == $zoom_type || 'lens' == $zoom_type ) {
    $lens_shape = Kirki::get_option( 'facewp', 'woocommerce_single_zoom_lens_shape' );
}

global $post, $woocommerce, $product;

$attachment_ids = $product->get_gallery_attachment_ids();

?>

<div class="main-images">
    <div>
        <?php
        if ( has_post_thumbnail() ) {

            $image_title   = esc_attr( get_the_title( get_post_thumbnail_id() ) );
            $image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
            $image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
            $image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                'title'           => $image_title,
                'alt'             => $image_title,
                'data-zoom-image' => $image_link,
            ) );

            $attachment_count = count( $product->get_gallery_attachment_ids() );

            if ( $attachment_count > 0 ) {
                $gallery = '[product-gallery]';
            } else {
                $gallery = '';
            }

            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image" title="%s">%s</a>', $image_link, $image_caption, $image ), $post->ID );

            if ( $lightbox_enable ) {
                echo sprintf( '<a href="%s" class="swipebox zoom-lightbox"><span class="zoom-icon pe-7s-expand1"></span></a>', $image_link );
            }
        } else {

            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

        }
        ?>
    </div>
    <?php if ( $attachment_ids ) : ?>
        <?php foreach ( $attachment_ids as $attachment_id ) {

            $image_link = wp_get_attachment_url( $attachment_id );

            if ( ! $image_link ) {
                continue;
            }

            echo '<div>';

            $image_title   = esc_attr( get_the_title( $attachment_id ) );
            $image_caption = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

            $image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ), 0, $attr = array(
                'title' => $image_title,
                'alt'   => $image_title,
            ) );

            echo sprintf( '<a href="%s" title="%s">%s</a>', $image_link, $image_caption, $image );

            if ( $lightbox_enable ) {
                echo sprintf( '<a href="%s" class="swipebox zoom-lightbox"><span class="zoom-icon pe-7s-expand1"></span></a>', $image_link );
            }

            echo '</div>';
        } ?>
    <?php endif; ?>
</div>
<?php if ( Kirki::get_option( 'facewp', 'woocommerce_single_thumbnails_type' ) !== 'vertical' ) :
    do_action( 'woocommerce_product_thumbnails' );
endif;
?>

<script type="text/javascript">
    jQuery( document ).ready( function( $ ) {
        var $mainImages = $( '.main-images' ),
            $thumbnails = $( '.thumbnails' );

        <?php if ( 'disable' != $zoom_type ) : ?>
        $mainImages
            .on( 'beforeChange', function() {
                $( '.main-images img' ).removeData( 'elevateZoom' )
                $( '.zoomContainer' ).remove();
            } )
            .on( 'init afterChange', function() {
                $( '.main-images .slick-current img' ).elevateZoom( {
                    zoomContainer: $(this).find('.slick-current'),
                    <?php if ( 'window' == $zoom_type ) : ?>
                    zoomWindowWidth: <?php echo esc_js( $zoom_window_width ); ?>,
                    zoomWindowHeight: <?php echo esc_js( $zoom_window_height ); ?>,
                    <?php elseif ( 'lens' == $zoom_type ) : ?>
                    lensSize: <?php echo esc_js( $lens_size ); ?>,
                    <?php endif; ?>
                    <?php if ( ! empty( $lens_shape ) ) : ?>
                    lensShape: '<?php echo esc_js( $lens_shape ); ?>',
                    <?php endif; ?>
                    zoomType: '<?php echo esc_js( $zoom_type ) ?>',
                    cursor: 'crosshair',
                    responsive: true
                } );
            } );
        <?php endif; ?>

        $mainImages.slick( {
            slidesToShow: 1,
            slidesToScroll: 1,
            swipe: false,
            touchMove: false,
            arrows: true,
            prevArrow: '<span class="pe-7s-angle-left slick-arrow-prev"></span>',
            nextArrow: '<span class="pe-7s-angle-right slick-arrow-next"></span>',
            dots: false,
            asNavFor: '.thumbnails',
        } );

        $thumbnails.slick( {
            <?php if ( Kirki::get_option( 'facewp', 'woocommerce_single_thumbnails_type' ) == 'vertical' ) : ?>
            vertical: true,
            centerPadding: 0,
            <?php endif; ?>
            slidesToShow: 6,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<span class="pe-7s-angle-left slick-arrow-prev"></span>',
            nextArrow: '<span class="pe-7s-angle-right slick-arrow-next"></span>',
            dots: false,
            asNavFor: '.main-images',
            focusOnSelect: true
        } );

        <?php if ( $lightbox_enable ) : ?>
        $( '.slick-slide:not(.slick-cloned) .swipebox' ).swipebox();
        <?php endif; ?>

        $( '.thumbnails a, .main-images a' ).on( 'click', function( evt ) {
            evt.preventDefault();
        } );
    } );
</script>
