<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'testimonial-container',
    $style,
    $nav_style,
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if ( 'yes' == $autoplay ) {
    $wrapper_attributes[] = 'data-autoplay="true"';
}

if ( 'yes' == $display_nav ) {
    $wrapper_attributes[] = 'data-nav="true"';
}

if ( 'yes' == $display_dots ) {
    $wrapper_attributes[] = 'data-dots="true"';
}

$wrapper_attributes[] = 'data-items="'. esc_attr( $items_per_slide ) .'"';

$output = '';
?>
<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
<?php do_action( 'woothemes_testimonials', array(
    'limit'          => $limit,
    'orderby'        => $orderby,
    'order'          => $order,
    'display_author' => 'yes' == $display_author ? true : false,
    'display_avatar' => 'yes' == $display_avatar ? true : false,
    'display_url'    => 'yes' == $display_url ? true : false,
    'size'           => $size,
) );
?>
</div>