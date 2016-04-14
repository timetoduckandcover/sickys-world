<?php
$section  = 'custom_code';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'      => 'code',
    'settings'  => 'custom_css',
    'label'     => esc_html__( 'Custom CSS:', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority ++,
    'transport' => 'postMessage',
    'default'   => '',
    'choices'     => array(
        'language' => 'css',
        'theme'    => 'monokai',
        'height'   => 250,
    ),
    'js_vars'   => array(
        array(
            'element'  => '#facewp-main-inline-css',
            'function' => 'html',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'code',
    'settings'  => 'custom_js',
    'label'     => esc_html__( 'Custom JS:', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority ++,
    'transport' => 'postMessage',
    'default'   => '',
    'choices'     => array(
        'language' => 'javascript',
        'theme'    => 'monokai',
        'height'   => 250,
    ),
) );
