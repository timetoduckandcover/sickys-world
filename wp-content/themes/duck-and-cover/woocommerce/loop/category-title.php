<?php if ( Kirki::get_option( 'facewp', 'woocommerce_archives_sub_categories_show_name' ) ) : ?>
	<div class="categories-overlay">
		<div class="overlay-inner">
			<p>
				<?php
				echo '' . $category->name;
				?>
			</p>
			<?php
			if ( $category->count > 0 && Kirki::get_option( 'facewp', 'woocommerce_archives_sub_categories_show_product_count' ) ) {
				echo apply_filters( 'woocommerce_subcategory_count_html', ' <p class="count">' . $category->count . ' ' . esc_html( __( 'Products', 'facewp-abbey' ) ) . '</p>', $category );
			}
			?>
		</div>
	</div>
<?php endif; ?>