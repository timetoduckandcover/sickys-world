<?php
$section  = 'header_type';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'radio',
    'setting'     => 'header_type',
    'label'       => esc_html__( 'Header Type', 'facewp-abbey' ),
    'description' => esc_html__( 'Choose the header type you want', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 'header_01',
    'choices'     => array(
        'header_01' => 'Type 01',
        'header_02' => 'Type 02',
        //        'header_03' => 'Type 03',
        'header_04' => 'Type 04',
        'header_05' => 'Type 05',
        'header_06' => 'Type 06',
        //        'header_07' => 'Type 07',
        //        'header_08' => 'Type 08',
        //        'header_09' => 'Type 09',
        //        'header_10' => 'Type 10',
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'number',
    'settings'  => 'header01-padding',
    'label'     => esc_html__( 'Padding( Top & Bottom )', 'facewp-abbey' ),
    'description'     => esc_html__( 'Padding of Header Type 01', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => 20,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-01',
            'property' => 'padding-top',
            'units'    => 'px',
        ),
        array(
            'element'  => '.header-01',
            'property' => 'padding-bottom',
            'units'    => 'px',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_01',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => '.header-01',
            'property' => 'padding-top',
            'function' => 'css',
        ),
        array(
            'element'  => '.header-01',
            'property' => 'padding-bottom',
            'function' => 'css',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'number',
    'settings'  => 'header02-topbar-padding',
    'label'     => esc_html__( 'Padding( Top & Bottom )', 'facewp-abbey' ),
    'description'     => esc_html__( 'Top Bar Header Type 02', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => 11,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-02 .header-top',
            'property' => 'padding-top',
            'units'    => 'px',
        ),
        array(
            'element'  => '.header-02 .header-top',
            'property' => 'padding-bottom',
            'units'    => 'px',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_02',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => '.header-02 .header-top',
            'property' => 'padding-top',
            'function' => 'css',
        ),
        array(
            'element'  => '.header-02 .header-top',
            'property' => 'padding-bottom',
            'function' => 'css',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'number',
    'settings'  => 'header02-middle-padding',
    'description'     => esc_html__( 'Logo of Header Type 02', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => 31,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-02 .header-middle',
            'property' => 'padding-top',
            'units'    => 'px',
        ),
        array(
            'element'  => '.header-02 .header-middle',
            'property' => 'padding-bottom',
            'units'    => 'px',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_02',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => '.header-02 .header-middle',
            'property' => 'padding-top',
            'function' => 'css',
        ),
        array(
            'element'  => '.header-02 .header-middle',
            'property' => 'padding-bottom',
            'function' => 'css',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'number',
    'settings'  => 'header04-topbar-padding',
    'label'     => esc_html__( 'Padding( Top & Bottom )', 'facewp-abbey' ),
    'description'     => esc_html__( 'Top Bar Header Type 04', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => 12,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-04 .header-top',
            'property' => 'padding-top',
            'units'    => 'px',
        ),
        array(
            'element'  => '.header-04 .header-top',
            'property' => 'padding-bottom',
            'units'    => 'px',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_04',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => '.header-04 .header-top',
            'property' => 'padding-top',
            'function' => 'css',
        ),
        array(
            'element'  => '.header-04 .header-top',
            'property' => 'padding-bottom',
            'function' => 'css',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'number',
    'settings'  => 'header04-middle-padding',
    'description'     => esc_html__( 'Middle of Header Type 04', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => 30,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-04 .header-middle',
            'property' => 'padding-top',
            'units'    => 'px',
        ),
        array(
            'element'  => '.header-04 .header-middle',
            'property' => 'padding-bottom',
            'units'    => 'px',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_04',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => '.header-04 .header-middle',
            'property' => 'padding-top',
            'function' => 'css',
        ),
        array(
            'element'  => '.header-04 .header-middle',
            'property' => 'padding-bottom',
            'function' => 'css',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'number',
    'settings'  => 'header05-topbar-padding',
    'label'     => esc_html__( 'Padding( Top & Bottom )', 'facewp-abbey' ),
    'description'     => esc_html__( 'Top Bar Header Type 05', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => 9,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-05 .header-top',
            'property' => 'padding-top',
            'units'    => 'px',
        ),
        array(
            'element'  => '.header-05 .header-top',
            'property' => 'padding-bottom',
            'units'    => 'px',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_05',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => '.header-05 .header-top',
            'property' => 'padding-top',
            'function' => 'css',
        ),
        array(
            'element'  => '.header-05 .header-top',
            'property' => 'padding-bottom',
            'function' => 'css',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'number',
    'settings'  => 'header06-logo-padding',
    'label'     => esc_html__( 'Padding( Top & Bottom )', 'facewp-abbey' ),
    'description'     => esc_html__( 'Logo of Header Type 06', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => 30,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-06 #logo',
            'property' => 'padding-top',
            'units'    => 'px',
        ),
        array(
            'element'  => '.header-06 #logo',
            'property' => 'padding-bottom',
            'units'    => 'px',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_06',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => '.header-06 #logo',
            'property' => 'padding-top',
            'function' => 'css',
        ),
        array(
            'element'  => '.header-05 #logo',
            'property' => 'padding-bottom',
            'function' => 'css',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'number',
    'settings'  => 'header06-cart-padding',
    'description'     => esc_html__( 'Cart of Header Type 06', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => 20,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.header-06 .header-left-cart',
            'property' => 'margin-top',
            'units'    => 'px',
        ),
        array(
            'element'  => '.header-06 .header-left-cart',
            'property' => 'margin-bottom',
            'units'    => 'px',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_06',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => '.header-06 .header-left-cart',
            'property' => 'margin-top',
            'function' => 'css',
        ),
        array(
            'element'  => '.header-05 .header-left-cart',
            'property' => 'margin-bottom',
            'function' => 'css',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'textarea',
    'setting'   => 'header_contact_info',
    'label'     => esc_html__( 'Header Contact Info', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => esc_html__( '<ul class="header-contact-info">
                    <li>
                        <i class="icon-header pe-7s-call"></i><span class="header-text-pri">CALL US</span><span class="header-text-sec">(001) 55 1939</span>
                    </li>
                    <li>
                        <i class="icon-header pe-7s-mail"></i><span class="header-text-pri">MAIL US</span><span class="header-text-sec">info@abbeytheme.com</span>
                    </li>
                </ul>', 'facewp-abbey' ),
    'transport' => 'postMessage',
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => 'header_01',
        ),
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => 'header_05',
        ),
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => 'header_06',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'textarea',
    'setting'   => 'header05_welcome_text',
    'label'     => esc_html__( 'Header Contact Info', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => esc_html__( '<span style="font-size: 12px; text-transform: uppercase;">Welcome You to Abbey</span>', 'facewp-abbey' ),
    'transport' => 'postMessage',
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_05',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'textarea',
    'setting'   => 'header05_contact_info',
    'label'     => esc_html__( 'Header Contact Info', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => esc_html__( '
                    <ul class="header-contact-info">
                        <li>
                            <i class="icon-header pe-7s-call"></i>
                            <div>
                                <span class="header-text-pri">CALL US</span><span class="header-text-sec">(001) 55 1939</span>
                            </div>
                        </li>
                        <li>
                           <i class=" icon-header pe-7s-mail"></i>
                            <div>
                                <span class="header-text-pri">MAIL US</span><span class="header-text-sec">info@abbeytheme.com</span>
                            </div>
                        </li>
                    </ul>
                    ', 'facewp-abbey' ),
    'transport' => 'postMessage',
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_05',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'textarea',
    'setting'   => 'header06_contact_info',
    'label'     => esc_html__( 'Contact Info', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => esc_html__( '<ul class="header-contact-info">
                    <li>
                        <i class="icon-header pe-7s-call"></i><span class="header-text-sec">(001) 55 1939</span>
                    </li>
                    <li>
                        <i class="icon-header pe-7s-mail"></i><span class="header-text-sec">info@abbeytheme.com</span>
                    </li>
                </ul>', 'facewp-abbey' ),
    'transport' => 'postMessage',
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_06',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'textarea',
    'setting'   => 'header06_footer_text',
    'label'     => esc_html__( 'Copyright (Header Type 06)', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => esc_html__( 'Copyright 2015. </ br> All rights reserved.', 'facewp-abbey' ),
    'transport' => 'postMessage',
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_06',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'textarea',
    'setting'   => 'header06_footer_text',
    'label'     => esc_html__( 'Copyright (Header Type 06)', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => esc_html__( 'Copyright 2015. </ br> All rights reserved.', 'facewp-abbey' ),
    'transport' => 'postMessage',
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_06',
        ),
    ),
) );

