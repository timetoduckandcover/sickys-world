<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="col-xs-12" style="margin:20px 0;clear: both;">
	<script src="//foursixty.com/media/scripts/fs.slider.v2.js" data-feed-id="sickysworld"  data-theme="slider_v2" data-cell-size="33.333%" data-for-url="true"></script><style>div.fs-has-links { text-indent: -9999px; position: static; font-weight: 500; } .fs-has-links::after {  padding: 10px 15px; background-color: #fff; color: rgba(255, 0, 0, 0.8); content: "SHOP IT"; text-indent: 0; display: block; font-size: 10pt; margin: 10px; }.fs-wrapper { height: auto } .fs-entry-container { height: 0 !important; width: 33.333% !important; padding-top: 33.333% !important; }.fs-desktop .fs-timeline-entry div.fs-text-container { display: flex; flex-direction: column;align-items: center; justify-content: center; display: -webkit-flex;  -webkit-flex-direction: column;  -webkit-align-items: center;  -webkit-justify-content: center;  display: -ms-flexbox;  -ms-flex-direction: column;  -ms-flex-align: center;  -ms-flex-pack: center; transition: opacity .25s; } .fs-desktop .fs-timeline-entry .fs-text-container:hover { opacity: 1; } .fs-wrapper div.fs-text-container .fs-entry-title, div.fs-detail-title{font-family:Helvetica Neue, Helvetica, Arial, sans-serif;font-style:italic;font-weight:normal;}div.fs-text-container .fs-entry-date, div.fs-detail-container .fs-post-info, div.fs-wrapper div.fs-has-links::after, .fs-text-product, .fs-overlink-text{font-family:Helvetica Neue, Helvetica, Arial, sans-serif;font-style:normal;font-weight:bold;}.fs-slider-next-button, .fs-slider-prev-button { opacity: 1; }.fs-wrapper div.fs-text-container * {color:#fff}.fs-wrapper div.fs-text-container {background-color:rgba(255, 0, 0, 0.8); margin: 0px}div.fs-entry-date{display:none}div.fs-entry-title{display:none}.fs-wrapper div.fs-timeline-entry{ margin: 1px }</style>
</div>

<?php

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="col-xs-12 woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>

			<?php if ( $single_custom_tab_title = get_post_meta( get_the_ID(), 'facewp_abbey_custom_tab_title', true ) ) : ?>
				<li class="single_custom_tab">
					<a href="#tab-single_custom_tab"><?php echo apply_filters( 'woocommerce_product_single_custom_tab_title', esc_html( $single_custom_tab_title ) ); ?></a>
				</li>
			<?php endif; ?>
			<?php if ( $custom_tab_title = Kirki::get_option( 'facewp', 'woocommerce_single_custom_tab_title' ) ) : ?>
				<li class="custom_tab">
					<a href="#tab-custom_tab"><?php echo apply_filters( 'woocommerce_product_custom_tab_title', esc_html( $custom_tab_title ) ); ?></a>
				</li>
			<?php endif; ?>
		</ul>

		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
			</div>
		<?php endforeach; ?>

		<?php if ( $single_custom_tab_title && $single_custom_tab_content = get_post_meta( get_the_ID(), 'facewp_abbey_custom_tab_content', true ) ) : ?>
			<div class="panel entry-content wc-tab" id="tab-single_custom_tab">
				<?php echo do_shortcode( $single_custom_tab_content ); ?>
			</div>
		<?php endif; ?>
		<?php if ( $custom_tab_title && $custom_tab_content = Kirki::get_option( 'facewp', 'woocommerce_single_custom_tab_content' ) ) : ?>
			<div class="panel entry-content wc-tab" id="tab-custom_tab">
				<?php echo html_entity_decode( do_shortcode( $custom_tab_content ), ENT_QUOTES, 'UTF-8' ); ?>
			</div>
		<?php endif; ?>

		<!-- Duck custom tab -->
		<div class="panel entry-content wc-tab" id="duck-description">
			<input type="hidden" name="name" class="toggle-description-hide" value="<?php the_field('show_description_tab');?>">
			<?php if( get_field('description_tab_image_1') ): ?>
				<div class="duck-description-frame-1">
					<?php
						$image1_id = get_field('description_tab_image_1');
						$image1_size = 'full-size';
						$image1_array = wp_get_attachment_image_src($image1_id, $image1_size);
						$image1_url = $image1_array[0];
					?>
					<img src="<?php echo $image1_url; ?>" alt="" />
					<div class="duck-description-frame-caption">
						<h2 style="margin-bottom:0;color:<?php the_field('description_tab_title_color');?>"><?php the_field('description_tab_title');?></h2>
						<p style="color:<?php the_field('description_tab_copy_color');?>"><?php the_field('description_tab_copy');?></p>
					</div>
				</div>
			<?php endif; ?>
			<?php if( get_field('description_tab_image_2') ): ?>
				<div class="duck-description-frame-2">
					<?php
						$image2_id = get_field('description_tab_image_2');
						$image2_size = 'full-size';
						$image2_array = wp_get_attachment_image_src($image2_id, $image2_size);
						$image2_url = $image2_array[0];
					?>
						<img src="<?php echo $image2_url; ?>" alt="" />
				</div>
			<?php endif; ?>
			<?php if( get_field('description_tab_image_3') ): ?>
				<div class="duck-description-frame-3">
					<?php
						$image3_id = get_field('description_tab_image_3');
						$image3_size = 'full-size';
						$image3_array = wp_get_attachment_image_src($image3_id, $image3_size);
						$image3_url = $image3_array[0];
					?>
						<img src="<?php echo $image3_url; ?>" alt="" />
				</div>
			<?php endif; ?>
		</div>
	</div>

<?php endif; ?>
