<?php
/**
 * Woocommerce Archives
 * ====================
 */
$section  = 'post_archives';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'legend',
    'setting'     => 'post_archives_layout_legend',
    'label'       => esc_html__( 'Layout', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'radio',
    'settings' => 'post_archives_page_layout',
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
    'settings' => 'post_archives_sidebar_position',
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

Kirki::add_field( 'facewp', array(
    'type'        => 'legend',
    'setting'     => 'post_archives_big_title_legend',
    'label'       => esc_html__( 'Big Title', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
) );

//Kirki::add_field( 'facewp', array(
//    'type'     => 'color',
//    'setting'  => 'post_archives_big_title_color',
//    'label'    => esc_html__( 'Background Color', 'facewp-abbey' ),
//    'section'  => $section,
//    'priority' => $priority++,
//    'default'  => '#EEEEEE',
//) );

Kirki::add_field( 'facewp', array(
    'type'        => 'image',
    'setting'     => 'post_archives_big_title_image',
    'label'       => esc_html__( 'Background Image', 'facewp-abbey' ),
    'description' => esc_html__( 'Choose a default image to display', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'http://abbey.facewp.com/wp-content/uploads/2016/01/big_title_01.jpg',
) );
