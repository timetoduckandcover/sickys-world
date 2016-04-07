<?php
$section  = 'woocommerce_style';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'     => 'legend',
    'setting'  => 'woocommerce_single_product_legend',
    'label'    => esc_html__( 'Single Product', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'color-alpha',
    'setting'  => 'navigation_shop_bg',
    'label'    => esc_html__( 'Breadcumb Box BG', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => '#F7F7F7',
    'output'   => array(
        array(
            'element'  => '.navigation-shop,.product-meta',
            'property' => 'background-color',
        ),
    ),
) );