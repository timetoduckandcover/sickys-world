<?php
$section  = 'header_preset';
$priority = 1;

Kirki::add_field( 'infinity', array(
	'type'        => 'preset',
	'settings'    => 'header_preset',
	'label'       => __( 'Header Preset', 'facewp-abbey' ),
	'section'   => $section,
	'priority'    => $priority ++,
	'description' => esc_html__( 'Choose header style from our predefined presets', 'facewp-abbey' ),
	'default'     => '1',
	'choices'     => array(
		'1' => array(
			'label'    => __( 'Preset 1', 'facewp-abbey' ),
			'settings' => array(
				'header_type' => 'header_01',
			),
		),
		'2' => array(
			'label'    => __( 'Preset 2', 'facewp-abbey' ),
			'settings' => array(
				'header_type' => 'header_02',
			),
		),
		'3' => array(
			'label'    => __( 'Preset 3', 'facewp-abbey' ),
			'settings' => array(
			),
		),
		'4' => array(
			'label'    => __( 'Preset 4', 'facewp-abbey' ),
			'settings' => array(
                'header_type' => 'header_04',
                'header_primary_menu_align' => 'right',
                'header_primary_menu_border' => '1px 0px 0px 0px'
			),
		),
		'5' => array(
			'label'    => __( 'Preset 5', 'facewp-abbey' ),
			'settings' => array(
				'header_type' => 'header_05',
			),
		),
        '6' => array(
            'label'    => __( 'Preset 6', 'facewp-abbey' ),
            'settings' => array(
                'header_type' => 'header_06',
                'header_primary_menu_item_link_color' => '#FFF',
	            'header_primary_menu_align' => 'left',
                'site_logo' => 'http://abbey.facewp.com/wp-content/uploads/2016/03/logo-02.png',
            ),
        ),
		'7' => array(
			'label'    => __( 'Preset 7', 'facewp-abbey' ),
			'settings' => array(
				'header_type' => 'header_01',
				'header_primary_menu_item_link_color' => '#FFF',
				'site_logo' => 'http://abbey.facewp.com/wp-content/uploads/2016/03/logo-02.png',
				'header_color_main' => '#ffffff',
				'header_color_meta' => '#ffffff',
				'header_sticky_background_color' => 'rgba(34, 34, 34, 0.85)'
			),
		),
	),
) );