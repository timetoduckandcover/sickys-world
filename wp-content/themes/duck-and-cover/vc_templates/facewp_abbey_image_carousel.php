<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$carousel_id = 'image-carousel-' . WPBakeryShortCode_FaceWP_Abbey_Image_Carousel::getCarouselIndex();

$pretty_rand = 'link_image' === $onclick ? ' rel="prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']"' : '';

if ( 'link_image' === $onclick ) {
    wp_enqueue_script( 'prettyphoto' );
    wp_enqueue_style( 'prettyphoto' );
}

if ( '' === $images ) {
    $images = '-1,-2,-3';
}

if ( 'custom_link' === $onclick ) {
    $custom_links = explode( ',', $custom_links );
}

$images = explode( ',', $images );
$i = - 1;

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

?>
<div class="image-carousel <?php echo esc_attr( $el_class ); ?>" id="<?php echo esc_attr( $carousel_id ); ?>">
    <div class="carousel">
        <?php foreach ( $images as $attach_id ) :  ?>
            <?php
            $i ++;
            if ( $attach_id > 0 ) {
                $post_thumbnail = wpb_getImageBySize( array(
                    'attach_id' => $attach_id,
                    'thumb_size' => $image_size,
                ) );
            } else {
                $post_thumbnail = array();
                $post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
                $post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
            }
            $thumbnail = $post_thumbnail['thumbnail'];
            ?>
            <div class="item">
                <?php if ( 'link_image' === $onclick ) :  ?>
                    <?php $p_img_large = $post_thumbnail['p_img_large']; ?>
                    <a class="prettyphoto"
                        href="<?php echo esc_url( $p_img_large[0] ); ?>" <?php echo $pretty_rand; ?>>
                        <?php echo '' . $thumbnail ?>
                    </a>
                <?php elseif ( 'custom_link' === $onclick && isset( $custom_links[ $i ] ) && '' !== $custom_links[ $i ] ) :  ?>
                    <a
                        href="<?php echo esc_url( $custom_links[ $i ] ); ?>"<?php echo( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) ?>>
                        <?php echo '' . $thumbnail ?>
                    </a>
                <?php else : ?>
                    <?php echo '' . $thumbnail ?>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
</div>
<script>
    jQuery(document).ready(function ($) {
        var $carousel = $('#<?php echo esc_js( $carousel_id ); ?>');
        $carousel.find('.carousel').slick({
            margin: <?php echo esc_js( $item_space ); ?>,
            <?php if ( 'yes' == $autoplay ) : ?>
                autoplay: true,
                autoplaySpeed: <?php echo esc_js( $speed ); ?>,
            <?php endif; ?>

            <?php if ( 'yes' == $hide_prev_next_buttons ) : ?>
                arrows: false,
            <?php else : ?>
                arrows: true,
                prevArrow: '<span class="pe-7s-angle-left slick-arrow-prev"></span>',
                nextArrow: '<span class="pe-7s-angle-right slick-arrow-next"></span>',
            <?php endif; ?>

            <?php if ( 'yes' == $hide_dots_navigation ) : ?>
                dots: false,
            <?php else : ?>
                dots: true,
            <?php endif; ?>
            mobileFirst: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: <?php echo esc_js( $items_on_desktop ); ?>,
                        slidesToScroll: <?php echo esc_js( $items_on_desktop ); ?>,
                    }
                },
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: <?php echo esc_js( $items_on_tabs ); ?>,
                        slidesToScroll: <?php echo esc_js( $items_on_tabs ); ?>,
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: <?php echo esc_js( $items_on_mobile ); ?>,
                        slidesToScroll: <?php echo esc_js( $items_on_mobile ); ?>,
                    }
                }
            ]
        });
    });
</script>