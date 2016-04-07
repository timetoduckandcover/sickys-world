<?php
$section  = 'footer_general';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'radio',
    'setting'     => 'footer_type',
    'label'       => esc_html__( 'Footer Type', 'facewp-abbey' ),
    'description' => esc_html__( 'Choose the footer type you want', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 'footer-03',
    'choices'     => array(
        'footer-01' => 'Type 01',
        'footer-02' => 'Type 02',
        'footer-03' => 'Type 03',
    ),
) );

Kirki::add_field('facewp', array(
    'type'        => 'color',
    'setting'     => 'footer_background_color',
    'label'       => esc_html__('Background Color', 'facewp-abbey'),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport' => 'postMessage',
    'default'   => '#F7F7F7',
    'output' => array(
        array(
            'element'  => '.site-footer',
            'property' => 'background-color',
        ),
    ),
));

Kirki::add_field('facewp', array(
    'type'        => 'color',
    'setting'     => 'footer_color',
    'label'       => esc_html__('Text Color', 'facewp-abbey'),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport' => 'postMessage',
    'default'   => '#000000',
    'output' => array(
        array(
            'element'  => '.site-footer, .site-footer a, .site-footer .facewp-social-widget a, .widget-title',
            'property' => 'color',
        ),
        array(
            'element'  => '.widget-title:after',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.tagcloud a, .fwp-instag .fwp-instag-follow',
            'property' => 'border-color',
        ),
    ),
));

Kirki::add_field('facewp', array(
    'type'        => 'color',
    'setting'     => 'footer_border_color',
    'label'       => esc_html__('Border Color', 'facewp-abbey'),
    'section'     => $section,
    'priority'    => $priority ++,
    'transport' => 'postMessage',
    'default'   => '#FFF',
    'output' => array(
        array(
            'element'  => '.copyright',
            'property' => 'border-color',
        ),
    ),
));

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'footer_back_to_top_enable',
    'label'       => esc_html__( 'Show Back to Top', 'facewp-abbey' ),
    'description' => esc_html__( 'Enabling this option will display Back to Top', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );