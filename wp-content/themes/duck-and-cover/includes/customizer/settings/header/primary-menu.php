<?php
$section  = 'header_primary_menu';
$priority = 1;

Kirki::add_field( 'facewp', array(
	'type'     => 'legend',
	'setting'  => 'header_primary_menu_legend_general',
	'label'    => esc_html__( 'General', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'select',
	'settings' => 'header_primary_menu_align',
	'label'    => __( 'Align', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => 'center',
	'priority' => $priority ++,
	'choices'  => array(
		'left'   => esc_html__( 'Left', 'facewp-abbey' ),
		'center' => esc_html__( 'Center', 'facewp-abbey' ),
		'right'  => esc_html__( 'Right', 'facewp-abbey' ),
	),
	'output' => array(
		array(
			'element'  => '#primary-menu',
			'property' => 'text-align',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'text',
	'settings' => 'header_primary_menu_border',
	'label'    => __( 'Border', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => '0px 0px 0px 0px',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '#primary-menu',
			'property' => 'border-width',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'settings' => 'header_primary_menu_border_color',
	'label'    => __( 'Border Color', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => '#000000',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '#primary-menu',
			'property' => 'border-color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'legend',
	'setting'  => 'header_primary_menu_legend_menu_item',
	'label'    => esc_html__( 'Menu Item', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'typography',
	'setting'  => 'header_primary_menu_item_font',
	'label'    => esc_html__( 'Font', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => array(
		'font-family'    => HEADING_FONT_FAMILY,
		'font-size'      => '12px',
		'font-weight'    => '700',
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
			'element' => '#primary-menu > .menu-item > a, #primary-menu > ul > li > a',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'select',
	'settings' => 'header_primary_menu_text_transform',
	'label'    => __( 'Text Transform', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => 'uppercase',
	'priority' => $priority ++,
	'choices'  => array(
		'none'      => esc_html__( 'None', 'facewp-abbey' ),
		'uppercase' => esc_html__( 'Uppercase', 'facewp-abbey' ),
		'lowercase' => esc_html__( 'Lowercase', 'facewp-abbey' ),
	),
	'output' => array(
		array(
			'element'  => '#primary-menu > .menu-item > a, #primary-menu > ul > li > a',
			'property' => 'text-transform',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'setting'  => 'header_primary_menu_item_link_color',
	'label'    => esc_html__( 'Link Color', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '#000000',
	'output'   => array(
		array(
			'element' => '#primary-menu > .menu-item > a, #primary-menu > ul > li > a',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'setting'  => 'header_primary_menu_item_icon_color',
	'label'    => esc_html__( 'Icon Color', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '#000000',
	'output'   => array(
		array(
			'element' => '#primary-menu > .menu-item > a > .menu-item-icon',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'setting'  => 'header_primary_menu_item_separator_color',
	'label'    => esc_html__( 'Separator Color', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '#AAAAAA',
	'output'   => array(
		array(
			'element' => '#primary-menu > .menu-item:after, #primary-menu > ul > li:after',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'setting'  => 'header_primary_menu_item_border_bottom_color_hover',
	'label'    => esc_html__( 'Border Bottom on Hover', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '#000000',
	'output'   => array(
		array(
			'element' => '#primary-menu > .menu-item > a:before, #primary-menu > ul > li > a:before',
			'property' => 'border-bottom-color',
		),
	),
) );