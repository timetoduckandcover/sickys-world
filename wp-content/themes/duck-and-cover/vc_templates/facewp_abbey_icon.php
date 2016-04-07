<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class     = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );

$url       = vc_build_link( $link );
$has_style = false;
if ( strlen( $background_style ) > 0 ) {
	$has_style = true;
	if ( strpos( $background_style, 'outline' ) !== false ) {
		$background_style .= ' vc_icon_element-outline'; // if we use outline style it is border in css
	} else {
		$background_style .= ' vc_icon_element-background';
	}
}

$iconClass = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : 'fa fa-adjust';

$style = '';


if ( false !== strpos( $background_style, 'outline' ) ) {
	$style = 'border-color:' . $custom_background_color . ';';
} else {
	$style = 'background-color:' . $custom_background_color . ';';
}
$style .= 'color:' . $custom_color . ';';

?>
<div
	class="vc_icon_element vc_icon_element-outer<?php echo strlen( $css_class ) > 0 ? ' ' . trim( esc_attr( $css_class ) ) : ''; ?> <?php echo esc_attr( $class ); ?> vc_icon_element-align-<?php echo esc_attr( $align ); ?><?php if ( $has_style ): echo ' vc_icon_element-have-style'; endif; ?>">
	<div
		class="vc_icon_element-inner <?php if ( $has_style ): echo ' vc_icon_element-have-style-inner'; endif; ?> vc_icon_element-style-<?php echo esc_attr( $background_style ); ?> "
		style="<?php echo esc_attr( $style ) ?>"><span
			class="vc_icon_element-icon <?php echo esc_attr( $iconClass ); ?>" <?php echo( $size ? 'style="font-size:' . esc_attr( $size ) . '"' : '' ) ?>></span><?php
		if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
			echo '<a class="vc_icon_element-link" href="' . esc_attr( $url['url'] ) . '" title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '"></a>';
		}
		?>
	</div>
</div>