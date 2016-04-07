<?php
$section  = 'header_vertical_menu';
$priority = 1;

Kirki::add_field( 'facewp', array(
	'type'     => 'legend',
	'setting'  => 'header_vertical_menu_legend_general',
	'label'    => esc_html__( 'General', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'text',
	'settings' => 'header_vertical_menu_heading_text',
	'label'    => __( 'Heading Text', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => esc_html__( 'TOP CATEGORIES', 'facewp-abbey' ),
	'priority' => $priority ++,
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'text',
	'settings' => 'header_vertical_menu_border',
	'label'    => __( 'Border', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => '1px 1px 1px 1px',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '.header-04 .toggle-menu-wrap .menu',
			'property' => 'border-width',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'settings' => 'header_vertical_menu_border_color',
	'label'    => __( 'Border Color', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => '#000000',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '.header-04 .toggle-menu-wrap .menu#menu-side',
			'property' => 'border-color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'legend',
	'setting'  => 'header_vertical_menu_legend_menu_item',
	'label'    => esc_html__( 'Menu Item', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'typography',
	'setting'  => 'header_vertical_menu_item_font',
	'label'    => esc_html__( 'Font', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => array(
		'font-family'    => BODY_FONT_FAMILY,
		'font-size'      => '16px',
		'font-weight'    => '400',
	),
	'choices'  => array(
		'font-style'     => false,
		'font-family'    => true,
		'font-size'      => true,
		'font-weight'    => true,
		'line-height'    => false,
		'letter-spacing' => false,
	),
	'output'   => array(
		array(
			'element' => '.toggle-menu-wrap .menu#menu-side > .menu-item:not(.more) > a',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'setting'  => 'header_vertical_menu_item_link_color',
	'label'    => esc_html__( 'Link Color', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '#000000',
	'output'   => array(
		array(
			'element' => '.header-04 .toggle-menu-wrap .menu#menu-side > .menu-item > a',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'setting'  => 'header_vertical_menu_item_icon_color',
	'label'    => esc_html__( 'Icon Color', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '#000000',
	'output'   => array(
		array(
			'element' => '.header-04 .toggle-menu-wrap .menu#menu-side > .menu-item > a > .menu-item-icon, .header-04 .toggle-menu-wrap .menu#menu-side > .menu-item > a:not(.has-icon):after',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'setting'  => 'header_vertical_menu_item_border_bottom_color_hover',
	'label'    => esc_html__( 'Border Bottom on Hover', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '#000000',
	'output'   => array(
		array(
			'element' => '.header-04 .toggle-menu-wrap .menu#menu-side > .menu-item > a > .menu-item-text:after',
			'property' => 'border-bottom-color',
		),
	),
) );