<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce_loop;
$woocommerce_loop['archive_product_layout'] = WC()->session->archive_product_layout;

get_header( 'shop' ); ?>
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( have_posts() ) : ?>

			<div class="container breadcrumb-row">
					<div class="row">
							<div class="col-md-7 start-xs duck-collection-breadcrumbs">
									<?php if ( Kirki::get_option( 'facewp', 'site_breadcrumb_enable' ) == 1 ) : ?>
											<?php woocommerce_breadcrumb(); ?>
									<?php endif; ?>
							</div>

							<?php if ( have_posts() ) : ?>
									<div class="col-md-3 col-md-push-2 end-xs duck-collection-dropdowns">
											<ul>
												<li>
													<a href="javascript:;" class="duck-grid-switch fa fa-th-large" id="duck-grid-large"></a>
												</li>
												<li>
													<a href="javascript:;" class="duck-grid-switch fa fa-th" id="duck-grid-small"></a>
												</li>
											</ul>
											<span>
												<?php $args = array( 'post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => -1 );
													$products = new WP_Query( $args );
													echo $products->found_posts;?>
													 products available
											</span>
									</div>
							<?php endif; ?>
					</div>
			</div>

      <?php woocommerce_product_loop_start(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', ( empty( $woocommerce_loop['archive_product_layout'] ) || 'grid' == $woocommerce_loop['archive_product_layout'] ) ? 'product' : 'product-list' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php else : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' ); ?>
