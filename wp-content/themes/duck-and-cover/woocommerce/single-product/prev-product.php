<?php
$prev_post = get_adjacent_post( true, '', false, 'product_cat' );

if ( ! $prev_post ) {
    return;
}

$prev_product = wc_get_product( $prev_post );
?>
<div class="prev-product navigation-product">
    <span class="icon"><a href="<?php echo esc_url( $prev_product->get_permalink() ); ?>"><?php echo esc_html( __( 'Previous', 'facewp-abbey' ) ); ?></a></span>

    <div class="product-info product_list_widget">
        <a href="<?php echo esc_url( $prev_product->get_permalink() ); ?>">
            <div class="product-thumb">
                <?php
                if ( $prev_post->_thumbnail_id ):
                    echo wp_get_attachment_image( $prev_post->_thumbnail_id, 'thumbnail' );
                else:
                    echo '<img src="' . wc_placeholder_img_src() . '" />';
                endif;
                ?>
            </div>
            <h3 class="product-title"><?php echo get_the_title( $prev_post ); ?></h3>
            <span class="price"><?php echo '' . $prev_product->get_price_html(); ?></span>
        </a>
    </div>
</div>
