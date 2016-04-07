<?php
$section  = 'site_logo';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'image',
    'setting'     => 'site_logo',
    'label'       => esc_html__( 'Logo', 'facewp-abbey' ),
    'description' => esc_html__( 'Choose a default logo image to display', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'http://abbey.facewp.com/wp-content/uploads/2016/01/logo.png',
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'image',
    'setting'     => 'site_logo_retina',
    'label'       => esc_html__( 'Retina', 'facewp-abbey' ),
    'description' => esc_html__( 'Choose a image for retina logo', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '',
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'image',
    'setting'     => 'site_favicon',
    'label'       => esc_html__( 'Upload Favicon', 'facewp-abbey' ),
    'description' => esc_html__( 'Choose a default favicon to display', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 'http://abbey.facewp.com/data/images/favicon-16x16.png',
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'image',
    'setting'     => 'site_apple_touch_icon',
    'label'       => esc_html__( 'Apple Touch Icon', 'facewp-abbey' ),
    'description' => esc_html__( 'File must be .png format. Optimal dimensions: 152px x 152px', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 'http://abbey.facewp.com/data/images/favicon-16x16.png',
) );
