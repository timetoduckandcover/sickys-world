<?php
$section  = 'footer_extra_info';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'footer_extra_info_enable',
    'label'       => esc_html__( 'Show Extra Information', 'facewp-abbey' ),
    'description' => esc_html__( 'Enabling this option will display Extra Information area', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'textarea',
    'setting'   => 'footer_extra_info_content',
    'label'     => esc_html__( 'Content', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => '<img class="alignright" alt="payment" src="http://abbey.facewp.com/wp-content/uploads/2016/01/payment.jpg">',
    'transport' => 'postMessage',
    'required'  => array(
        array(
            'setting'  => 'footer_extra_info_enable',
            'operator' => '==',
            'value'    => 1,
        ),
    ),
) );