<?php
/**
 * Custom template tags used to integrate this theme with WooCommerce.
 *
 * @package FaceWP
 */

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 * @since  1.0.0
 */
if ( ! function_exists( 'facewp_abbey_cart_link' ) ) {
    function facewp_abbey_cart_link() {
        if ( Kirki::get_option( 'facewp', 'woocommerce_general_catalog_mode' ) ) {
            return;
        }
        ?>
        <div class="mini-cart header-item dropdown">
            <a class="cart-contents" data-toggle="dropdown" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>">
                <span class="icon-header cart-icon pe-7s-shopbag"></span>
                <strong class="cart-text">Shopping Bag</strong>
                <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>
            </a>
            <div class="cart-details dropdown-menu">
                <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
            </div>
        </div>
        <?php
    }
}

if ( ! function_exists( 'facewp_abbey_get_product_thumbnail' ) ) {

    /**
     * Get the product thumbnail, or the placeholder if not set.
     *
     * @subpackage	Loop
     * @param string $size (default: 'shop_catalog')
     * @param int $deprecated1 Deprecated since WooCommerce 2.0 (default: 0)
     * @param int $deprecated2 Deprecated since WooCommerce 2.0 (default: 0)
     * @return string
     */
    function facewp_abbey_get_product_thumbnail( $size = 'shop_catalog' ) {
        global $post;

        $result = array();

        if ( has_post_thumbnail() ) {
            $result[0] = get_the_post_thumbnail( $post->ID, $size, array( 'class' => 'primary-image' ) );
        } else if ( wc_placeholder_img_src() ) {
            $result[0] = wc_placeholder_img( $size );
        }

        $gallery = get_post_meta( $post->ID, '_product_image_gallery', true );
        if ( Kirki::get_option( 'facewp', 'woocommerce_archives_content_product_enable_swap_image' ) && ! empty( $gallery ) ) {
            $gallery = explode( ',', $gallery );
            $result[1] = wp_get_attachment_image( $gallery[0] , $size, false, array( 'class' => 'swap-image' ) );
        }

        return $result;
    }
}

if ( ! function_exists( 'facewp_abbey_template_loop_product_thumbnail' ) ) {
    function facewp_abbey_template_loop_product_thumbnail() {
        echo implode( '', facewp_abbey_get_product_thumbnail( 'shop_catalog' ) );
    }
}

if ( ! function_exists( 'facewp_abbey_widget_template_product_thumbnail' ) ) {
    function facewp_abbey_widget_template_product_thumbnail() {
        echo implode( '', facewp_abbey_get_product_thumbnail( 'shop_thumbnail' ) );
    }
}

if ( ! function_exists( 'facewp_abbey_count_down' ) ) {
    function facewp_abbey_count_down() {
        global $post;

        $product_id = $post->ID;

        $time_from = get_post_meta( $product_id, '_sale_price_dates_from', true );
        $time_to  = get_post_meta( $product_id, '_sale_price_dates_to', true );

        $time_current = strtotime( current_time( "Y-m-d G:i:s" ) );

        if ( $time_current < $time_from || $time_current > $time_to ) {
            // @todo: show message for coming sale
            return '';
        }

        if ( '' == $time_to ) {
            return '';
        }

        ob_start();
        ?>
        <div class="product-countdown" data-sale-year="<?php echo esc_attr( date( 'Y', $time_to ) ); ?>" data-sale-month="<?php echo esc_attr( date( 'm', $time_to ) - 1 ); ?>" data-sale-day="<?php echo esc_attr( date( 'd', $time_to ) ); ?>"></div>
        <?php
        return ob_get_clean();
    }
}

if ( ! function_exists( 'facewp_abbey_category_loop_start' ) ) {
    function facewp_abbey_category_loop_start( $echo = true ) {
        $columns    = Kirki::get_option( 'facewp', 'woocommerce_archives_sub_categories_per_row_desktop' );
        $columns_md = Kirki::get_option( 'facewp', 'woocommerce_archives_sub_categories_per_row_tabs' );
        $columns_xs = Kirki::get_option( 'facewp', 'woocommerce_archives_sub_categories_per_row_mobile' );

        $classes = array();

        if ( Kirki::get_option( 'facewp', 'woocommerce_archives_sub_categories_show_image' ) ) {
            $classes[] = 'product-category-list-image';
        }

        $classes[] = Kirki::get_option( 'facewp', 'woocommerce_archives_sub_categories_display_style' );

        ob_start();
        ?>
        <ul class="product-category-list" data-show-pagination="false" data-column-lg="<?php echo esc_attr( $columns ); ?>" data-columns-md="<?php echo $columns_md ?>" data-columns-xs="<?php echo $columns_xs ?>" data-columns-ls="1">
        <?php
        if ( $echo )
            echo ob_get_clean();
        else
            return ob_get_clean();
    }
}

if ( ! function_exists( 'facewp_abbey_category_loop_end' ) ) {
    function facewp_abbey_category_loop_end( $echo = true ) {
        ob_start();
        ?>
        </ul>
        <?php
        if ( $echo )
            echo ob_get_clean();
        else
            return ob_get_clean();
    }
}