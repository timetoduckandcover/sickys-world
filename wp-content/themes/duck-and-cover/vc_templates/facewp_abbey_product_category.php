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

$output = '';
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= do_shortcode('[product_category per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'" category="'.$category.'"]');
$output .= '</div>';

echo '' . $output;