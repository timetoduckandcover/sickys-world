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
	</div>

<?php endif; ?>
