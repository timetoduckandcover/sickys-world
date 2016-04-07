<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'facewp-products facewp-product-tabs ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
if ( $animation_type ) {
    $class_to_filter .= ' wow-animation ' . esc_attr( $animation_type );
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes = array();

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if ( $animation_delay ) {
    $wrapper_attributes[] = 'data-wow-delay="'. esc_attr( $animation_delay ) .'"';
}
if ( $animation_duration && $animation_duration != '1s' ) {
    $wrapper_attributes[] = 'data-wow-duration="'. esc_attr( $animation_duration ) .'"';
}

global $woocommerce_loop;

$woocommerce_loop['view_type'] = $view_type;
$woocommerce_loop['columns'] = $columns;
$woocommerce_loop['show_navigation'] = false;
$woocommerce_loop['show_pagination'] = $show_pagination;
$woocommerce_loop['pagination_position'] = 'horizontal';

$index = WPBakeryShortCode_FaceWP_Abbey_Product_Tabs::getIndex();

if ( $categories ) {
    $tax_query = array(
        array(
            'taxonomy' 		=> 'product_cat',
            'terms' 		=> array_map( 'sanitize_title', explode( ',', $categories ) ),
            'field' 		=> 'slug',
            'operator' 		=> 'IN',
        )
    );
} else {
    $tax_query = array();
}

$recent_products_args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => $per_page,
    'orderby'             => $orderby,
    'order'               => $order,
    'meta_query'          => WC()->query->get_meta_query(),
    'tax_query' 			=> $tax_query,
);

$meta_query   = WC()->query->get_meta_query();
$meta_query[] = array(
    'key'   => '_featured',
    'value' => 'yes'
);

$featured_products_args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => $per_page,
    'orderby'             => $orderby,
    'order'               => $order,
    'meta_query'          => $meta_query,
    'tax_query' 			=> $tax_query,
);

$sale_product_args = array(
    'posts_per_page'	=> $per_page,
    'orderby' 			=> $orderby,
    'order' 			=> $order,
    'no_found_rows' 	=> 1,
    'post_status' 		=> 'publish',
    'post_type' 		=> 'product',
    'meta_query' 		=> WC()->query->get_meta_query(),
    'post__in'			=> array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
    'tax_query' 			=> $tax_query,
);

$output = '';
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

ob_start();
?>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a role="tab" data-toggle="tab" href="#recent-products-<?php echo esc_attr( $index ); ?>"><?php echo esc_html( $recent_products_tab_label ); ?></a></li>
    <li role="presentation"><a role="tab" data-toggle="tab" href="#featured-products-<?php echo esc_attr( $index ); ?>"><?php echo esc_html( $featured_products_tab_label ); ?></a></li>
    <li role="presentation"><a role="tab" data-toggle="tab" href="#sale-products-<?php echo esc_attr( $index ); ?>"><?php echo esc_html( $sale_products_tab_label ); ?></a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="recent-products-<?php echo esc_attr( $index ); ?>">
        <?php $products = new WP_Query( $recent_products_args ); ?>

        <?php woocommerce_product_loop_start(); ?>

        <?php while ( $products->have_posts() ) : $products->the_post(); ?>

            <?php wc_get_template_part( 'content', 'product' ); ?>

        <?php endwhile; // end of the loop. ?>

        <?php woocommerce_product_loop_end(); ?>

        <?php
        woocommerce_reset_loop();
        wp_reset_postdata();
        ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="featured-products-<?php echo esc_attr( $index ); ?>">
        <?php $products = new WP_Query( $featured_products_args ); ?>

        <?php woocommerce_product_loop_start(); ?>

        <?php while ( $products->have_posts() ) : $products->the_post(); ?>

            <?php wc_get_template_part( 'content', 'product' ); ?>

        <?php endwhile; // end of the loop. ?>

        <?php woocommerce_product_loop_end(); ?>

        <?php
        woocommerce_reset_loop();
        wp_reset_postdata();
        ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="sale-products-<?php echo esc_attr( $index ); ?>">
        <?php $products = new WP_Query( $sale_product_args ); ?>

        <?php woocommerce_product_loop_start(); ?>

        <?php while ( $products->have_posts() ) : $products->the_post(); ?>

            <?php wc_get_template_part( 'content', 'product' ); ?>

        <?php endwhile; // end of the loop. ?>

        <?php woocommerce_product_loop_end(); ?>

        <?php
        woocommerce_reset_loop();
        wp_reset_postdata();
        ?>
    </div>
</div>
<?php
$output .= ob_get_clean();
$output .= '</div>';

echo '' . $output;