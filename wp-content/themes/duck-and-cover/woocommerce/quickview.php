<div class="quickview-container container">
    <div class="row product">
        <div class="col-lg-6 images">
            <?php
            do_action( 'woocommerce_before_single_product_summary' );
            ?>
        </div>

        <div class="col-md-6 product-summary">
            <?php
            do_action( 'woocommerce_single_product_summary' );
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php
    $wc_assets_path = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/';
    $wc_script_path = $wc_assets_path . 'js/frontend/';
    ?>
    var wc_add_to_cart_params = <?php echo json_encode(apply_filters( 'wc_add_to_cart_params', array(
        'ajax_url'                => WC()->ajax_url(),
        'ajax_loader_url'         => apply_filters( 'woocommerce_ajax_loader_url', $wc_assets_path . 'images/ajax-loader@2x.gif' ),
        'i18n_view_cart'          => esc_attr__( 'View Cart', 'woocommerce' ),
        'cart_url'                => get_permalink( wc_get_page_id( 'cart' ) ),
        'is_cart'                 => is_cart(),
        'cart_redirect_after_add' => get_option( 'woocommerce_cart_redirect_after_add' )
    ) )) ?>;
    var wc_cart_fragments_params = <?php echo json_encode(apply_filters( 'wc_cart_fragments_params', array(
        'ajax_url'      => WC()->ajax_url(),
        'fragment_name' => apply_filters( 'woocommerce_cart_fragment_name', 'wc_fragments' )
    ) )) ?>;
    var wc_add_to_cart_variation_params = <?php echo json_encode(apply_filters( 'wc_add_to_cart_variation_params', array(
        'i18n_no_matching_variations_text' => esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'woocommerce' ),
        'i18n_unavailable_text'            => esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ),
    ) )) ?>;
    jQuery(document).ready(function ($) {
        $.getScript('<?php echo esc_url( $wc_script_path . 'add-to-cart.min.js' ); ?>');
        $.getScript('<?php echo esc_url( $wc_script_path . 'add-to-cart-variation.min.js' ); ?>');
    });
</script>