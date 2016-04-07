<?php
/**
 * Woocommerce Single Product
 * ==========================
 */
$section  = 'woocommerce_single';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'     => 'legend',
    'setting'  => 'woocommerce_single_layout_legend',
    'label'    => esc_html__( 'Layout', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'radio',
    'settings' => 'woocommerce_single_page_layout',
    'label'    => __( 'Page Layout', 'facewp-abbey' ),
    'section'  => $section,
    'default'  => 'wide',
    'priority' => $priority++,
    'choices'  => array(
        'wide'       => esc_html__( 'Wide', 'facewp-abbey' ),
        'boxed'      => esc_html__( 'Boxed', 'facewp-abbey' ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'radio',
    'settings' => 'woocommerce_single_sidebar_position',
    'label'    => __( 'Sidebar Position', 'facewp-abbey' ),
    'section'  => $section,
    'default'  => 'no-sidebar',
    'priority' => $priority++,
    'choices'  => array(
        'no-sidebar'    => esc_html__( 'No Sidebar', 'facewp-abbey' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'facewp-abbey' ),
        'right-sidebar' => esc_html__( 'Right Sidebar', 'facewp-abbey' ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'legend',
    'setting'  => 'woocommerce_single_product_next_prev_navigation_legend',
    'label'    => esc_html__( 'Product Next-Prev Navigation', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'toggle',
    'setting'  => 'woocommerce_single_product_navigation',
    'label'    => esc_html__( 'Show Product Navigation', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'legend',
    'setting'  => 'woocommerce_single_image_legend',
    'label'    => esc_html__( 'Image', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'radio',
    'settings' => 'woocommerce_single_thumbnails_type',
    'label'    => __( 'Thumbnails Type', 'facewp-abbey' ),
    'section'  => $section,
    'default'  => 'horizontal',
    'priority' => $priority++,
    'choices'  => array(
        'vertical'   => esc_html__( 'Vertical', 'facewp-abbey' ),
        'horizontal' => esc_html__( 'Horizontal', 'facewp-abbey' ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'toggle',
    'setting'  => 'woocommerce_single_enable_lightbox',
    'label'    => esc_html__( 'Enable Lightbox for product images', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'select',
    'settings' => 'woocommerce_single_zoom_effect',
    'label'    => __( 'Zoom Effect', 'facewp-abbey' ),
    'section'  => $section,
    'default'  => 'inner',
    'priority' => $priority++,
    'choices'  => array(
        'disable' => esc_html__( 'Disable', 'facewp-abbey' ),
        'lens'    => esc_html__( 'Lens', 'facewp-abbey' ),
        'window'  => esc_html__( 'Window', 'facewp-abbey' ),
        'inner'   => esc_html__( 'Inner', 'facewp-abbey' ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'select',
    'setting'  => 'woocommerce_single_zoom_lens_shape',
    'label'    => esc_html__( 'Lens Size', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'square',
    'choices'  => array(
        'square' => esc_html__( 'Square', 'facewp-abbey' ),
        'round'  => esc_html__( 'Round', 'facewp-abbey' ),
    ),
    'required' => array(
        array(
            'setting'  => 'woocommerce_single_zoom_effect',
            'operator' => '!=',
            'value'    => 'disable',
        ),
        array(
            'setting'  => 'woocommerce_single_zoom_effect',
            'operator' => '!=',
            'value'    => 'inner',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'textfield',
    'setting'  => 'woocommerce_single_zoom_lens_size',
    'label'    => esc_html__( 'Lens Size', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => '200',
    'required' => array(
        array(
            'setting'  => 'woocommerce_single_zoom_effect',
            'operator' => '!=',
            'value'    => 'disable',
        ),
        array(
            'setting'  => 'woocommerce_single_zoom_effect',
            'operator' => '!=',
            'value'    => 'inner',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'textfield',
    'setting'     => 'woocommerce_single_zoom_window_width',
    'label'       => esc_html__( 'Zoom Window Width', 'facewp-abbey' ),
    'description' => esc_html__( 'Width of the zoom window', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '400',
    'required'    => array(
        array(
            'setting'  => 'woocommerce_single_zoom_effect',
            'operator' => '==',
            'value'    => 'window',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'textfield',
    'setting'     => 'woocommerce_single_zoom_window_height',
    'label'       => esc_html__( 'Zoom Window Height', 'facewp-abbey' ),
    'description' => esc_html__( 'Height of the zoom window', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '400',
    'required'    => array(
        array(
            'setting'  => 'woocommerce_single_zoom_effect',
            'operator' => '==',
            'value'    => 'window',
        ),
    ),
) );

// Custom Tab
Kirki::add_field( 'facewp', array(
    'type'     => 'legend',
    'setting'  => 'woocommerce_single_custom_tab_legend',
    'label'    => esc_html__( 'Custom Tab', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'textfield',
    'setting'     => 'woocommerce_single_custom_tab_title',
    'label'       => esc_html__( 'Custom Tab Title', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '',
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'textarea',
    'setting'   => 'woocommerce_single_custom_tab_content',
    'label'     => esc_html__( 'Custom Tab Content', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => '',
) );
