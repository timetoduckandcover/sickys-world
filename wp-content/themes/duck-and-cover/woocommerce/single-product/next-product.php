<?php
$next_post = get_adjacent_post( true, '', true, 'product_cat' );

if ( ! $next_post ) {
    return;
}

$next_product = wc_get_product( $next_post );
?>
<div class="next-product navigation-product">
    <span class="icon"><a href="<?php echo esc_url( $next_product->get_permalink() ); ?>"><?php echo esc_html( __( 'Next Product', 'facewp-abbey' ) ); ?></a></span>

    <div class="product-info product_list_widget">
        <a href="<?php echo esc_url( $next_product->get_permalink() ); ?>">
            <div class="product-thumb">
                <?php
                if ( $next_post->_thumbnail_id ):
                    echo wp_get_attachment_image( $next_post->_thumbnail_id, 'thumbnail' );
                else:
                    echo '<img src="' . wc_placeholder_img_src() . '" />';
                endif;

                ?>
            </div>
            <h3 class="product-title""><?php echo get_the_title( $next_post ); ?></h3>
            <span class="price"><?php echo '' . $next_product->get_price_html(); ?></span>
        </a>
    </div>
</div>