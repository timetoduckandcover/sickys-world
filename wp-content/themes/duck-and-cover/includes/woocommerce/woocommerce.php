<?php
$woocommerce_path = FaceWP_Abbey_THEME_DIR . 'includes/woocommerce/';

require_once( $woocommerce_path . 'template-tags.php' );

add_action( 'woocommerce_init', 'facewp_abbey_init_woocommerce' );
function facewp_abbey_init_woocommerce() {
    // Catalog Mode
    $catalog_mode = Kirki::get_option( 'facewp', 'woocommerce_general_catalog_mode' );
    if ( $catalog_mode ) {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
        remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
        remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
        remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
    }

    // List/Grid
    $wc = WC();

    if ( ! empty( $wc->session ) ) {
        if ( ! $wc->session->get( 'archive_product_layout' ) ) {
            $wc->session->set( 'archive_product_layout', Kirki::get_option( 'facewp', 'woocommerce_archives_product_layout' ) );
        }

        if ( ! empty( $_GET['archive_product_layout'] ) ) {
            $wc->session->set( 'archive_product_layout', $_GET['archive_product_layout'] );
        }
    }
}

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'facewp_abbey_dequeue_styles' );
function facewp_abbey_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
    unset( $enqueue_styles['woocommerce-layout'] );        // Remove the layout
    unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
    return $enqueue_styles;
}

// Title of Loop
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'facewp_abbey_woocommerce_template_loop_product_title', 10 );
function facewp_abbey_woocommerce_template_loop_product_title() {
    wc_get_template( 'loop/title.php' );
}

// Remove Link Actions of Loop
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// Swap Image
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'facewp_abbey_template_loop_product_thumbnail', 10 );

//Button
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 1 );

// Category
if ( Kirki::get_option( 'facewp', 'woocommerce_archives_content_product_show_category' ) == 1 ) {
    add_action( 'woocommerce_shop_loop_item_title', 'facewp_abbey_wc_loop_category', 5 );
}

// Breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

//Star
if ( Kirki::get_option( 'facewp', 'woocommerce_archives_content_product_show_rating' ) == 0 ) {
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
}

// Quick View
add_action( 'wp_ajax_facewp_abbey_wc_quickview', 'facewp_abbey_wc_quickview' );
add_action( 'wp_ajax_nopriv_facewp_abbey_wc_quickview', 'facewp_abbey_wc_quickview' );
add_action( 'wc_ajax_facewp_abbey_wc_quickview', 'facewp_abbey_wc_quickview' );

if ( ! function_exists( 'facewp_abbey_wc_loop_category' ) ) {

    /**
     * Show the product category in the product loop. By default this is an H5
     */
    function facewp_abbey_wc_loop_category() {
        wc_get_template( 'loop/category.php' );
    }
}

function facewp_abbey_wc_quickview() {
    global $post, $product;
    $post    = get_post( $_GET['product_id'] );
    $product = wc_get_product( $post->ID );

    if ( post_password_required() ) {
        echo get_the_password_form();

        return;
    }

    wc_get_template( 'quickview.php' );

    die();
}

// Category Title
remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
add_action( 'woocommerce_shop_loop_subcategory_title', 'facewp_abbey_woocommerce_template_loop_category_title', 10 );
function facewp_abbey_woocommerce_template_loop_category_title( $category ) {
    wc_get_template( 'loop/category-title.php', array( 'category' => $category ) );
}

// Category Thumbnail
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
add_action( 'woocommerce_before_subcategory_title', 'facewp_abbey_subcategory_thumbnail', 10 );
if ( ! function_exists( 'facewp_abbey_subcategory_thumbnail' ) ) {

    /**
     * Show subcategory thumbnails.
     *
     * @param mixed $category
     *
     * @subpackage    Loop
     */
    function facewp_abbey_subcategory_thumbnail( $category ) {
        global $woocommerce_loop;
        $small_thumbnail_size = isset( $woocommerce_loop['image_size'] ) ? $woocommerce_loop['image_size'] : apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );

        $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

        if ( $thumbnail_id ) {
            if ( preg_match( '#(\d+)x(\d+)#', $small_thumbnail_size, $matches ) ) {

                $image = wpb_getImageBySize( array(
                    'attach_id' => $thumbnail_id,
                    'thumb_size' => array( $matches[1], $matches[2] ),
                ) );

                echo '' . $image['thumbnail'];
                return;

            } else {
                $image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );

                $dimensions = array(
                    'width'  => $image[1],
                    'height' => $image[2],
                    'crop'   => 0,
                );
            }
            $image = $image[0];
        } else {
            $image      = wc_placeholder_img_src();

            if ( preg_match( '#(\d+)x(\d+)#', $small_thumbnail_size, $matches ) ) {
                $dimensions = array(
                    'width'  => $matches[1],
                    'height' => $matches[2],
                    'crop'   => 0,
                );
            } else {
                $dimensions = wc_get_image_size( $small_thumbnail_size );
            }
        }

        if ( $image ) {
            // Prevent esc_url from breaking spaces in urls for image embeds
            // Ref: http://core.trac.wordpress.org/ticket/23605
            $image = str_replace( ' ', '%20', $image );

            echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
        }
    }
}

add_action( 'woocommerce_before_shop_loop_item_title', 'facewp_abbey_show_product_loop_out_of_stock', 10 );
function facewp_abbey_show_product_loop_out_of_stock() {
    wc_get_template( 'loop/out-of-stock.php' );
}

// Countdown
add_action( 'woocommerce_shop_loop_item_title', 'facewp_abbey_display_sale_countdown', 1 );
if ( ! function_exists( 'facewp_abbey_display_sale_countdown' ) ) {
    function facewp_abbey_display_sale_countdown() {
        global $woocommerce_loop;

        if ( empty( $woocommerce_loop['countdown'] ) ) {
            return;
        }

        echo facewp_abbey_count_down();
    }
}

// Cart
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );

add_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 10 );
add_action( 'woocommerce_cart_actions', 'woocommerce_button_proceed_to_checkout', 20 );

// Breadcrumbs
add_filter( 'woocommerce_breadcrumb_defaults', 'facewp_woocommerce_breadcrumb' );
function facewp_woocommerce_breadcrumb() {
    return array(
        'delimiter'   => '<span class="pe-7s-angle-right"></span>',
        'wrap_before' => '<nav class="breadcrumbs" >',
        'wrap_after'  => '</nav>',
        'before'      => '',
        'after'       => '',
        'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
    );
}

/**
 * Grid/List Layout
 **/
// Grid/List Toggle
add_filter( 'woocommerce_before_shop_loop', 'facewp_woocommerce_grid_list_toggle', 10 );
function facewp_woocommerce_grid_list_toggle() {
    global $woocommerce_loop;
    ?>
    <a href="<?php echo esc_url( add_query_arg( 'archive_product_layout', 'list' ) ); ?>" class="grid-list-toggle list-toggle <?php echo esc_attr( 'list' == $woocommerce_loop['archive_product_layout'] ? 'active' : '' ) ?>" title="<?php echo esc_attr( 'List', 'facewp-abbey' ); ?>" data-toggle="tooltip" data-placement="top"><i class="fa fa-th-list"></i></a>
    <a href="<?php echo esc_url( add_query_arg( 'archive_product_layout', 'grid' ) ); ?>" class="grid-list-toggle grid-toggle <?php echo esc_attr( 'grid' == $woocommerce_loop['archive_product_layout'] ? 'active' : '' ) ?>" title="<?php echo esc_attr( 'Grid', 'facewp-abbey' ); ?>" data-toggle="tooltip" data-placement="top"><i class="fa fa-th"></i></a>
    <?php
}

// Product List Layout
add_action( 'facewp_woocommerce_shop_loop_list_product_item_summary', 'facewp_abbey_wc_loop_category', 5 );
add_action( 'facewp_woocommerce_shop_loop_list_product_item_summary', 'woocommerce_template_loop_product_title', 10 );
add_action( 'facewp_woocommerce_shop_loop_list_product_item_summary', 'woocommerce_template_single_rating', 15 );
add_action( 'facewp_woocommerce_shop_loop_list_product_item_summary', 'woocommerce_template_single_price', 20 );
add_action( 'facewp_woocommerce_shop_loop_list_product_item_summary', 'woocommerce_template_single_excerpt', 25 );
add_action( 'facewp_woocommerce_shop_loop_list_product_item_summary', 'woocommerce_template_loop_add_to_cart', 30 );

/**
 * Single Product
 **/
//Category
add_action( 'woocommerce_single_product_summary', 'facewp_abbey_wc_loop_category', 1 );

//Meta
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 12 );

//Share
add_action( 'woocommerce_share', 'facewp_single_share_product', 5 );
function facewp_single_share_product() {
    global $post, $product;
    //Get the Thumbnail URL
    $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );
    ?>

    <div class="product-socials-wrapper">
        <b style="display:inline-block;" class="uppercase"><?php _e( 'Share', 'facewp-abbey' ); ?></b>
        <a href="//www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
        <a href="//twitter.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
        <a href="//plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
        <a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url( $src[0] ) ?>&amp;description=<?php echo urlencode( get_the_title() ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
    </div><!--.product-socials-wrapper-->

    <?php
}

//Variable Product
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
add_action( 'woocommerce_single_variation', 'facewp_abbey_woocommerce_single_variation_add_to_cart_button', 20 );
function facewp_abbey_woocommerce_single_variation_add_to_cart_button() {
    global $product;
    ?>
    <div class="variations_button">
        <?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
        <button type="submit" class="single_add_to_cart_button button secondary-button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
        <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
        <input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
        <input type="hidden" name="variation_id" class="variation_id" value="" />
    </div>
    <?php
}

//Add Container for Up Sell and Related Product
add_action( 'woocommerce_after_single_product_summary', 'facewp_abbey_woocommerce_single_wrapper_start_related_product', 14 );
function facewp_abbey_woocommerce_single_wrapper_start_related_product() {
    ?>
    <div class="container boxed">
    <div class="row">
    <?php
}

add_action( 'woocommerce_after_single_product_summary', 'facewp_abbey_woocommerce_single_wrapper_end_related_product', 25 );
function facewp_abbey_woocommerce_single_wrapper_end_related_product() {
    ?>
    </div>
    </div>
    <?php
}


add_action( 'woocommerce_before_single_product_summary', 'facewp_abbey_show_product_sale_flash', 10 );
function facewp_abbey_show_product_sale_flash() {
    wc_get_template( 'loop/out-of-stock.php' );
}

// Custom Tab Meta Box
add_action( 'cmb2_admin_init', 'facewp_abbey_register_custom_tab_metabox' );
function facewp_abbey_register_custom_tab_metabox() {
    $prefix = 'facewp_abbey_';

    $cmb = new_cmb2_box( array(
                             'id'           => $prefix . 'custom_tab',
                             'title'        => __( 'Product Custom Tab', 'facewp-abbey' ),
                             'object_types' => array( 'product' ),
                             'context'      => 'normal',
                             'priority'     => 'default',
                             'show_names'   => true,
                         ) );

    $fields = array(
        array(
            'name' => __( 'Custom Tab', 'facewp-abbey' ),
            'id'   => $prefix . 'custom_tab_title',
            'type' => 'text',
        ),
        array(
            'name'    => __( 'Custom Tab Content', 'facewp-abbey' ),
            'id'      => $prefix . 'custom_tab_content',
            'type'    => 'wysiwyg',
            'options' => array(
                'textarea_rows' => 5,
            ),
        ),
    );

    foreach ( $fields as $field ) {
        $cmb->add_field( $field );
    }
}
