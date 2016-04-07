<?php
$section  = 'footer_copyright';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'footer_copyright_enable',
    'label'       => esc_html__( 'Show Copyright', 'facewp-abbey' ),
    'description' => esc_html__( 'Enabling this option will display copyright area', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'textarea',
    'setting'   => 'footer_copyright_content',
    'label'     => esc_html__( 'Content', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => '2016 - <a href="http://facewp.com">FaceWP</a>. All Rights Reserved.',
    'transport' => 'postMessage',
    'required'  => array(
        array(
            'setting'  => 'footer_copyright_enable',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );