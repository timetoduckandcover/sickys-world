<?php
$section  = 'header_menu_dropdown';
$priority = 1;

Kirki::add_field( 'facewp', array(
	'type'     => 'legend',
	'setting'  => 'header_menu_dropdown_legend_general',
	'label'    => esc_html__( 'General', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'settings' => 'header_menu_dropdown_background_color',
	'label'    => __( 'Background Color', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => '#ffffff',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '.menu > .menu-item .sub-menu, .menu > ul > li .children',
			'property' => 'background-color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'settings' => 'header_menu_dropdown_border_color',
	'label'    => __( 'Border Color', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => '#000000',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '.menu > .menu-item .sub-menu, .menu > ul > li .children',
			'property' => 'border-color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'settings' => 'header_menu_dropdown_link_color',
	'label'    => __( 'Link Color', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => '#000000',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '#header .menu > .menu-item li > a, #header .menu > ul > li li > a',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'settings' => 'header_menu_dropdown_icon_color',
	'label'    => __( 'Icon Color', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => '#000000',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '.menu > .menu-item li > a .menu-item-icon, .menu > .menu-item .sub-menu > li > a:not(.has-icon):after',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'settings' => 'header_menu_dropdown_border_bottom_color_hover',
	'label'    => __( 'Border Bottom Color on Hover', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => '#000000',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '.menu > li li > a .menu-item-text:after',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'legend',
	'setting'  => 'header_menu_dropdown_legend_mega_menu',
	'label'    => esc_html__( 'Mega Menu', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'settings' => 'header_menu_dropdown_mega_menu_title_color',
	'label'    => __( 'Color', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => '#1F1F1F',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '#header .menu > .menu-item.menu-item-mega-menu > .sub-menu > li > a',
			'property' => 'color',
		),
	),
) );

// @todo: Add more customizer setting for menu