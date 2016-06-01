<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $woocommerce_loop;

if ( empty( $woocommerce_loop['view_type'] ) ) {
    $woocommerce_loop['view_type'] = 'grid';
}

$woocommerce_loop['archive_product_layout'] = ! empty( $woocommerce_loop['archive_product_layout'] ) ? $woocommerce_loop['archive_product_layout'] : 'grid';

$classes = array();

$classes[] = 'products-' . $woocommerce_loop['view_type'];
$classes[] = 'product-layout-' . $woocommerce_loop['archive_product_layout'];

// @todo: get setting from kirki
$columns = ! empty( $woocommerce_loop['columns'] ) ? $woocommerce_loop['columns'] : 4;

switch ( $columns ) {
    case 1: $columns_md = 1; $columns_xs = 1; $columns_ls = 1; break;
    case 2: $columns_md = 2; $columns_xs = 2; $columns_ls = 1; break;
    case 3: $columns_md = 3; $columns_xs = 2; $columns_ls = 1; break;
    case 4: $columns_md = 3; $columns_xs = 1; $columns_ls = 1; break;
    case 5: $columns_md = 3; $columns_xs = 2; $columns_ls = 1; break;
    case 6: $columns_md = 5; $columns_xs = 3; $columns_ls = 2; break;
    case 7: $columns_md = 6; $columns_xs = 3; $columns_ls = 2; break;
    case 8: $columns_md = 6; $columns_xs = 3; $columns_ls = 2; break;
    default: $columns = 4; $columns_md = 3; $columns_xs = 2; $columns_ls = 1;
}

$attributes = array();

if ( 'carousel' == $woocommerce_loop['view_type'] ) {
    $classes[] = 'pagination-' . $woocommerce_loop['pagination_position'];

    if ( 'yes' == $woocommerce_loop['show_navigation'] ) {
        $attributes[] = 'data-show-navigation="true"';
    } else {
        $attributes[] = 'data-show-navigation="false"';
    }
    if ( 'yes' == $woocommerce_loop['show_pagination'] ) {
        $attributes[] = 'data-show-pagination="true"';
    } else {
        $attributes[] = 'data-show-pagination="false"';
    }
}
?>
<ul class="products row items <?php echo esc_attr( implode( ' ', $classes ) ) ?>" <?php echo implode( ' ', $attributes ); ?> data-columns-lg="<?php echo esc_attr( $columns ); ?>" data-columns-md="<?php echo esc_attr( $columns_md ); ?>" data-columns-xs="<?php echo esc_attr( $columns_xs ); ?>" data-columns-ls="<?php echo esc_attr( $columns_ls ); ?>">
