<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'facewp-widget-products ';
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

$output = '';
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
ob_start();
the_widget( 'WC_Widget_Products', $atts, array( 'widget_id' => 'facewp_abbey_widget_products_' . $number . '_' . $orderby . '_' . $order . '_' . $hide_free . '_' . $show_hidden ) );
$output .= ob_get_clean();
$output .= '</div>';

echo '' . $output;