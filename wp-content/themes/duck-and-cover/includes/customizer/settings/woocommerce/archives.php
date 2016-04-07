<?php
/**
 * Woocommerce Archives
 * ====================
 */
$section  = 'woocommerce_archives';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'legend',
    'setting'     => 'woocommerce_archives_layout_legend',
    'label'       => esc_html__( 'Layout', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'radio',
    'settings' => 'woocommerce_archives_page_layout',
    'label'    => __( 'Page Layout', 'facewp-abbey' ),
    'section'  => $section,
    'default'  => 'boxed',
    'priority' => $priority++,
    'choices'  => array(
        'wide'       => esc_html__( 'Wide', 'facewp-abbey' ),
        'boxed'      => esc_html__( 'Boxed', 'facewp-abbey' ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'radio',
    'settings' => 'woocommerce_archives_sidebar_position',
    'label'    => __( 'Sidebar Position', 'facewp-abbey' ),
    'section'  => $section,
    'default'  => 'left-sidebar',
    'priority' => $priority++,
    'choices'  => array(
        'no-sidebar'    => esc_html__( 'No Sidebar', 'facewp-abbey' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'facewp-abbey' ),
        'right-sidebar' => esc_html__( 'Right Sidebar', 'facewp-abbey' ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'legend',
    'setting'  => 'woocommerce_archives_product_layout_legend',
    'label'    => esc_html__( 'Product Layout', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority ++,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'select',
    'settings' => 'woocommerce_archives_product_layout',
    'label'    => __( 'Product Layout', 'facewp-abbey' ),
    'section'  => $section,
    'default'  => 'grid',
    'priority' => $priority ++,
    'choices'  => array(
        'list' => esc_html__( 'List', 'facewp-abbey' ),
        'grid' => esc_html__( 'Grid', 'facewp-abbey' ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'legend',
    'setting'     => 'woocommerce_archives_sub_categories_legend',
    'label'       => esc_html__( 'Sub-Categories', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_sub_categories_show_image',
    'label'       => esc_html__( 'Show Image', 'facewp-abbey' ),
    'description' => esc_html__( 'Enable this setting to show images of sub-categories', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 0,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_sub_categories_show_name',
    'label'       => esc_html__( 'Show Name', 'facewp-abbey' ),
    'description' => esc_html__( 'Enable this setting to show names of sub-categories', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_sub_categories_show_product_count',
    'label'       => esc_html__( 'Show Number of Products', 'facewp-abbey' ),
    'description' => esc_html__( 'Enable this setting to show number of products in sub-category', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 0,
    'required'  => array(
        array(
            'setting'  => 'woocommerce_archives_sub_categories_show_name',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'textfield',
    'setting'     => 'woocommerce_archives_sub_categories_image_size',
    'label'       => esc_html__( 'Image Size', 'facewp-abbey' ),
    'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "shop_catalog" size.', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 'shop_catalog',
    'required'  => array(
        array(
            'setting'  => 'woocommerce_archives_sub_categories_show_image',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

Kirki::add_field( 'infinity', array(
    'type'        => 'select',
    'setting'     => 'woocommerce_archives_sub_categories_display_style',
    'label'       => esc_html__( 'Display Style', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 'carousel',
    'required'  => array(
        array(
            'setting'  => 'woocommerce_archives_sub_categories_show_image',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
    'choices'     => array(
        'carousel' => __( 'Carousel', 'facewp-abbey' ),
        'grid'     => __( 'Grid', 'facewp-abbey' ),
        'masonry'  => __( 'Masonry', 'facewp-abbey' ),
    ),
    'description' => esc_html__( 'Note: When you choose Masonry, please set "Image Size" to "full" to see the effect.', 'facewp-abbey' ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'number',
    'setting'     => 'woocommerce_archives_sub_categories_per_row_desktop',
    'label'       => esc_html__( 'Number of Sub-Categories per Row on Desktop', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '4',
    'required'  => array(
        array(
            'setting'  => 'woocommerce_archives_sub_categories_display_style',
            'operator' => '!=',
            'value'    => 'masonry',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'number',
    'setting'     => 'woocommerce_archives_sub_categories_per_row_tabs',
    'label'       => esc_html__( 'Number of Sub-Categories per Row on Tabs', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '4',
    'required'  => array(
        array(
            'setting'  => 'woocommerce_archives_sub_categories_display_style',
            'operator' => '!=',
            'value'    => 'masonry',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'number',
    'setting'     => 'woocommerce_archives_sub_categories_per_row_mobile',
    'label'       => esc_html__( 'Number of Sub-Categories per Row on Mobile', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '4',
    'required'  => array(
        array(
            'setting'  => 'woocommerce_archives_sub_categories_display_style',
            'operator' => '!=',
            'value'    => 'masonry',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'legend',
    'setting'     => 'woocommerce_archives_content_product_legend',
    'label'       => esc_html__( 'Content Product', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_content_product_show_badge_hot',
    'label'       => esc_html__( 'Show Badge Hot', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_content_product_show_badge_sale',
    'label'       => esc_html__( 'Show Badge Sale', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_content_product_show_badge_sale_percent',
    'label'       => esc_html__( 'Show Badge Sale as Percent', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
    'required'  => array(
        array(
            'setting'  => 'woocommerce_archives_content_product_show_badge_sale',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_content_product_enable_swap_image',
    'label'       => esc_html__( 'Enable Swap Image', 'facewp-abbey' ),
    'description' => esc_html__( 'Enable Swap Image on hover', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_content_product_show_quickview',
    'label'       => esc_html__( 'Show Quick View', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_content_product_show_wishlist',
    'label'       => esc_html__( 'Show Wishlist', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_content_product_show_category',
    'label'       => esc_html__( 'Show Category', 'facewp-abbey' ),
    'description' => esc_html__( 'Enable this setting to show Category', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'woocommerce_archives_content_product_show_rating',
    'label'       => esc_html__( 'Show Rating', 'facewp-abbey' ),
    'description' => esc_html__( 'Enable this setting to show Rating', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 0,
) );