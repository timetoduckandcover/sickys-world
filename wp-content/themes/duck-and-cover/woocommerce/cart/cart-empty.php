<?php
/**
 * Empty cart page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

?>
<div class="container cart-empty">
    <div class="icon-page">
        <span class="pe-7s-cart"></span>
        <span class="pe-7s-close"></span>
    </div>
    <p class="page-title"><?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></p>

    <?php do_action( 'woocommerce_cart_is_empty' ); ?>

    <p class="return-to-shop"><a class="button primary-button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php _e( 'Return To Shop', 'woocommerce' ) ?></a></p>

</div>
