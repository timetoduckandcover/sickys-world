<?php
/**
 * Single Product Sale Flash
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post, $product;

$html = '';

if ( Kirki::get_option( 'facewp', 'woocommerce_archives_content_product_show_badge_hot' ) ) {
    if ( 'yes' == get_post_meta( $post->ID, '_featured', true ) ) {
        $html .= '<span class="badge-hot">' . __( 'Hot', 'facewp-abbey' ) . '</span>';
    }
}

if ( Kirki::get_option( 'facewp', 'woocommerce_archives_content_product_show_badge_sale' ) && $product->is_on_sale() ) {
    if ( Kirki::get_option( 'facewp', 'woocommerce_archives_content_product_show_badge_sale_percent' ) && $product->regular_price > 0 ) {
        $html .= '<span class="badge-sale">' . ( -round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 ) ) . '%</span>';
    } else {
        $html .= apply_filters( 'woocommerce_sale_flash', '<span class="badge-sale">' . __( 'Sale', 'facewp-abbey' ) . '</span>', $post, $product );
    }
}
if ( ! $product->is_in_stock() ) {
    $html .= apply_filters( 'woocommerce_sale_flash', '<span class="badge-out-of-stock">' . __( 'Out of stock', 'facewp-abbey' ) . '</span>', $post, $product );;
}
if ( true && $product->is_on_sale() || ! $product->is_in_stock() ||  'yes' == get_post_meta( $post->ID, '_featured', true ) ) {
    echo '<div class="labels">';
    echo '' . $html;
    echo '</div>';
}

