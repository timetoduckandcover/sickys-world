<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array(
	'col-xs-12',
);
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="product-thumb">
		<a href="<?php the_permalink(); ?>">

			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>

		</a>
	</div>
    <div class="product-summary">
        <?php
        /**
         * facewp_woocommerce_shop_loop_list_product_item_summary hook
         *
         * @hooked facewp_abbey_wc_loop_category - 5
         * @hooked woocommerce_template_loop_product_title - 10
         * @hooked woocommerce_template_single_rating - 15
         * @hooked woocommerce_template_single_price - 20
         * @hooked woocommerce_template_single_excerpt - 25
         * @hooked woocommerce_template_loop_add_to_cart - 30
         */
        do_action( 'facewp_woocommerce_shop_loop_list_product_item_summary' );
        ?>
    </div>

	<?php

	/**
	 * woocommerce_after_shop_loop_item hook
	 *
	 */
	do_action( 'woocommerce_after_shop_loop_item' );

	?>

</li>
