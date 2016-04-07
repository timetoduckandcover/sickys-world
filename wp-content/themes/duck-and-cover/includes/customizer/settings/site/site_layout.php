<?php
$section  = 'site_layout';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'legend',
    'setting'     => 'site_layout_legend',
    'label'       => esc_html__( 'Layout', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'radio',
    'settings' => 'site_body_wrapper',
    'label'    => __( 'Body Wrapper', 'facewp-abbey' ),
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
    'settings' => 'site_page_layout',
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
    'settings' => 'site_sidebar_position',
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
