<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'facewp-products ';
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
$woocommerce_loop['show_navigation'] = $show_navigation;
$woocommerce_loop['show_pagination'] = $show_pagination;
$woocommerce_loop['pagination_position'] = $pagination_position;

$woocommerce_loop['countdown'] = true;

if ( empty( $tag ) ) {
    $tax_query = array();
} else {
    $tax_query = array(
        array(
            'taxonomy' => 'product_tag',
            'field'    => 'slug',
            'terms'    => $tag,
        ),
    );
}

$query_args = array(
    'posts_per_page' => $per_page,
    'orderby'        => $orderby,
    'order'          => $order,
    'no_found_rows'  => 1,
    'post_status'    => 'publish',
    'post_type'      => 'product',
    'meta_query'     => WC()->query->get_meta_query(),
    'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
    'tax_query'      => $tax_query,
);

$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args ) );

$output = '';
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

if ( $products->have_posts() ) {

    do_action( "woocommerce_shortcode_before_facewp_abbey_hot_deals_loop" );

    woocommerce_product_loop_start();

    while ( $products->have_posts() ) {
        $products->the_post();

        wc_get_template_part( 'content', 'product' );
    }

    woocommerce_product_loop_end();

    do_action( "woocommerce_shortcode_after_facewp_abbey_hot_deals_loop" );

}

woocommerce_reset_loop();
wp_reset_postdata();

$output .= '</div>';

echo '' . $output;