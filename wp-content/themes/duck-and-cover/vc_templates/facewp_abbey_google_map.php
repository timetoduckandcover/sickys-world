<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

wp_enqueue_script( 'googleapis' );

$id = WPBakeryShortCode_FaceWP_Abbey_Google_Map::getIndex();

$classes = array( 'google-map' );

$classes[] = $css_class;
if ( $el_class ) {
	$classes[] = $el_class;
}

$map_style_code = '';

switch ( $map_style ) {
	case 'shades_of_grey':
		$map_style_code = '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]';
		break;
	case 'ultra_light':
		$map_style_code = '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]';
		break;
	case 'apple_map':
		$map_style_code = '[{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]';
		break;
	case 'custom':
		$map_style_code = rawurldecode( call_user_func( 'base' . '64_decode', strip_tags( $map_style_custom ) ) );
		break;
}

if ( 'custom' == $marker_icon && $custom_marker_icon ) {
	$marker_attachment = wpb_getImageBySize( array(
		'attach_id'  => $custom_marker_icon,
		'thumb_size' => 'full',
	) );

	$marker_url = $marker_attachment['p_img_large'][0];
} else {
	$marker_url = FaceWP_Abbey_THEME_URL . '/assets/images/map-marker.png';
}

?>
<div id="google-map-<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="height: <?php echo esc_attr( $height ); ?>">

</div>
<script type="text/javascript">
	(function ($) {
		$(document).ready(function () {
			var mapOptions = {
				zoom: <?php echo esc_js( $zoom ) ?>,
				center: new google.maps.LatLng(<?php echo esc_js( $latitude ) ?>, <?php echo esc_js( $longitude ); ?>),
				mapTypeId: google.maps.MapTypeId.<?php echo esc_js( $map_type ) ?>,
				scrollwheel: <?php echo esc_js( 'disable' == $scrollwheel ? 'false' : true ) ?>,
				streetViewControl: <?php echo 'enable' == $street_view_control ? 'true' : 'false'; ?>,
				mapTypeControl: <?php echo 'enable' == $map_type_control ? 'true' : 'false'; ?>,
				panControl: <?php echo 'enable' == $map_pan_control ? 'true' : 'false'; ?>,
				zoomControl: <?php echo 'enable' == $zoom_control ? 'true' : 'false'; ?>
			};

			var map = new google.maps.Map(document.getElementById( 'google-map-<?php echo esc_js( $id ); ?>' ), mapOptions);

			<?php if ( $map_style_code ) : ?>
			var styledMap = new google.maps.StyledMapType(<?php echo ''. $map_style_code ?>, {name: "Styled Map"});

			map.mapTypes.set('map_style', styledMap);
			map.setMapTypeId('map_style');
			<?php endif; ?>

			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(<?php echo esc_js( $latitude ) ?>, <?php echo esc_js( $longitude ); ?>),
				animation:  google.maps.Animation.DROP,
				map: map,
				icon: '<?php echo esc_url( $marker_url ) ?>'
			});

			<?php if ( trim( $info ) !== '' ) : ?>
				var infowindow = new google.maps.InfoWindow();
				infowindow.setContent('<div class="map_info_text" style="color:#000;"><?php echo trim( preg_replace( '/\s+/', ' ', do_shortcode( $info ) ) ); ?></div>');

				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map, marker);
				});
			<?php endif; ?>
		});
	})(jQuery);
</script>
