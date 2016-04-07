<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'counter-container',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

wp_enqueue_script( 'waypoints' );
wp_enqueue_script( 'facewp-js-count-up' );

$output = '';
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
if ( '' != $counter_prefix ) {
    $output .= '<span class="counter-prefix">'. esc_html( $counter_prefix ) .'</span>';
}
$output .= '<span id="counter-'. esc_attr( WPBakeryShortCode_FaceWP_Abbey_Counter::getIndex() ) .'" class="counter" data-speed="'. esc_attr( $speed ) . '" data-value="' . esc_attr( $counter_value ) .'" data-separator="' . esc_attr( $counter_sep ) .'" data-decimal="' . esc_attr( $counter_decimal ) . '">0</span>';
if ( '' != $counter_suffix ) {
    $output .= '<span class="counter-suffix">'. esc_html( $counter_suffix ) .'</span>';
}
if ( '' != $counter_title ) {
    $output .= '<div class="counter-title">'. esc_html( $counter_title ) .'</div>';
}
$output .= '</div>';

echo '' . $output;