<?php
/**
 * Product loop category
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $product;
?>
<h5 class="product-category-name">
    <?php
    $products_cats = $product->get_categories();
    list($firstpart) = explode(',', $products_cats);
    echo '' . $firstpart;
    ?>
</h5>