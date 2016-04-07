<?php
$section  = 'header_style';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'     => 'color-alpha',
    'setting'  => 'header_bg',
    'label'    => esc_html__( 'Header BG', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => PRIMARY_BACKGROUND_COLOR,
    'output'   => array(
        array(
            'element'  => '#header',
            'property' => 'background-color',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => 'header_06',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'color-alpha',
    'setting'  => 'header_06_bg',
    'label'    => esc_html__( 'Header Type 06 BG', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'rgba(0, 0, 0, .7)',
    'output'   => array(
        array(
            'element'  => '#header.header-06',
            'property' => 'background-color',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '==',
            'value'    => 'header_06',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'color',
    'setting'  => 'header_color_main',
    'label'    => esc_html__( 'Text Color', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => PRIMARY_COLOR,
    'output'   => array(
        array(
            'element'  => '#header, #header a',
            'property' => 'color',
        ),
        array(
            'element'  => '.nav-main .menu > li > a:before,
                           #language-switcher-menu:after,
                           #currency-switcher-menu:after',
            'property' => 'background-color',
        ),
    ),
    'required'  => array(
        array(
            'setting'  => 'header_type',
            'operator' => '!=',
            'value'    => 'header_06',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'color',
    'setting'  => 'header_color_meta',
    'label'    => esc_html__( 'Meta Text Color', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => SECONDARY_COLOR,
    'output'   => array(
        array(
            'element'  => '[class*="header-"] .amount, .header-text-sec',
            'property' => 'color',
        ),
    ),
) );

//todo: customizer for mobile menu.

Kirki::add_field( 'facewp', array(
    'type'     => 'color',
    'setting'  => 'header06_cart_bg',
    'label'    => esc_html__( 'Cart BG( Header Type 06 )', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => PRIMARY_BACKGROUND_COLOR,
    'output'   => array(
        array(
            'element'  => '.header-06 .header-left-cart',
            'property' => 'background-color',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'color',
    'setting'  => 'header06_cart_color',
    'label'    => esc_html__( 'Cart Color( Header Type 06 )', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => PRIMARY_COLOR,
    'output'   => array(
        array(
            'element'  => '#header.header-06 .header-left-cart a',
            'property' => 'color',
        ),
    ),
) );
