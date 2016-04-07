<?php
global $product;
if ( ! $product->is_in_stock() ) : ?>
    <div class="out-of-stock-overlay">
        <span class="badge-out-of-stock"><?php echo esc_html__( 'Out of stock', 'facewp-abbey' ); ?></span>
    </div>
<?php endif; ?>