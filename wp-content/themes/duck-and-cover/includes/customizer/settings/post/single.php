<?php
/**
 * Woocommerce Single Product
 * ==========================
 */
$section  = 'post_single';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'legend',
    'setting'     => 'post_single_layout_legend',
    'label'       => esc_html__( 'Layout', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'radio',
    'settings' => 'post_single_page_layout',
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
    'settings' => 'post_single_sidebar_position',
    'label'    => __( 'Sidebar Position', 'facewp-abbey' ),
    'section'  => $section,
    'default'  => 'right-sidebar',
    'priority' => $priority++,
    'choices'  => array(
        'no-sidebar'    => esc_html__( 'No Sidebar', 'facewp-abbey' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'facewp-abbey' ),
        'right-sidebar' => esc_html__( 'Right Sidebar', 'facewp-abbey' ),
    ),
) );

Kirki::add_field( 'infinity', array(
    'type'        => 'toggle',
    'setting'     => 'post_single_title_enable',
    'label'       => esc_html__( 'Enable Single Page Title', 'customizer' ),
    'description' => esc_html__( 'Turn on this option if you want to show page title in single product page', 'customizer' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '1',
) );

Kirki::add_field( 'infinity', array(
    'type'     => 'text',
    'setting'  => 'post_single_title',
    'label'    => esc_html__( 'Single Page Title', 'customizer' ),
    'section'  => $section,
    'priority' => $priority ++,
    'default'  => 'Blog',
    'required' => array(
        array(
            'setting'  => 'post_single_title_enable',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );

