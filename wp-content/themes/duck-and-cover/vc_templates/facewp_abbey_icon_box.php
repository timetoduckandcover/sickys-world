<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

if ( 'custom' != $icon_type ) {
	vc_icon_element_fonts_enqueue( $icon_type );
}

$classes = array( 'icon-box' );

$classes[] = $box_style;
$classes[] = $css_class;
if ( $el_class ) {
	$classes[] = $el_class;
}

$link_open_html = '';
$link_end_html = '';

if ( 'none' != $read_more ) {
	$url = vc_build_link( $link );
	$link_open_html = '<a href="' . esc_attr( $url['url'] ) . '" title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">';
	$link_end_html = '</a>';
}

$icon_styles = array();
if ( 'style3' == $box_style ) {
	if ( $icon_background_color ) {
		$icon_styles[] = 'background-color: ' . $icon_background_color;
	}
	if ( $icon_color_border ) {
		$icon_styles[] = 'border-color: ' . $icon_color_border;
	}
}
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="background-color: <?php echo esc_attr( $box_bg_color ); ?>;">
	<?php if ( 'box' == $read_more ) : ?>
		<?php echo '' . $link_open_html; ?>
	<?php endif; ?>

	<span class="icon-box-icon" style="<?php echo esc_attr( implode( ';', $icon_styles ) ); ?>">
		<?php if ( 'custom' != $icon_type ) : ?>
			<i class="<?php echo esc_attr( isset( ${'icon_' . $icon_type} ) ? ${'icon_' . $icon_type} : 'fa fa-adjust' ); ?>" style="font-size: <?php echo esc_attr( $icon_size ); ?>; color: <?php echo esc_attr( $custom_color ? $custom_color : '' ); ?>;"></i>
		<?php else :
			$img = wpb_getImageBySize( array(
				'attach_id' => $icon_image,
				'thumb_size' => $icon_image_width,
			) );

			echo '' . $img['thumbnail'];
		endif; ?>
	</span>

	<?php if ( $title ) : ?>
		<h5 class="icon-box-title" style="color: <?php echo esc_attr( $title_color ) ?>;">
			<?php if ( 'title' == $read_more ) echo '' . $link_open_html; ?>
			<?php echo '' . $title; ?>
			<?php if ( 'title' == $read_more ) echo '' . $link_end_html; ?>
		</h5>
	<?php endif; ?>

	<?php if ( $content ) : ?>
		<div class="icon-box-content" style="color: <?php echo esc_attr( $content_color ) ?>;"><?php echo '' . $content; ?></div>
	<?php endif; ?>

	<?php if ( 'more' == $read_more ) {
		echo '<div class="icon-box-read-more">' . $link_open_html . $read_text . $link_end_html . '</div>';
	} ?>

	<?php if ( 'box' == $read_more ) : ?>
		<?php echo '' . $link_end_html; ?>
	<?php endif; ?>
</div>