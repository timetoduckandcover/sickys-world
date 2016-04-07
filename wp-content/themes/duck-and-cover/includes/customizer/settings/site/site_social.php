<?php
/**
 * Top Social
 * ==============
 */
$section  = 'site_social';
$priority = 1;

Kirki::add_field( 'facewp', array(
	'type'        => 'color-alpha',
	'setting'     => 'social_links_color',
	'label'       => esc_html__( 'Color', 'facewp-abbey' ),
	'description' => esc_html__( 'Choose color for social icon.', 'facewp-abbey' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.social-links li a',
			'property' => 'color',
		),
		array(
			'element'  => '.social-links li a:after',
			'property' => 'background-color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'        => 'color-alpha',
	'setting'     => 'social_links_color_hover',
	'description' => esc_html__( 'Choose color for social icon on hover.', 'facewp-abbey' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.social-links li a:hover',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'        => 'repeater',
	'label'       => esc_html__( 'Social items', 'facewp-abbey' ),
	'description' => esc_html__( 'You can add/remove and sort your social network link in this section', 'facewp-abbey' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'settings'    => 'social_links',
	'default'     => array(
        array(
            'social_name' => esc_html__( 'Follow Us', 'facewp-abbey' ),
            'link_url'    => '',
        ),
		array(
			'social_name' => esc_html__( 'Facebook', 'facewp-abbey' ),
			'link_url'    => 'http://facebook.com',
		),
        array(
            'social_name' => esc_html__( 'Twitter', 'facewp-abbey' ),
            'link_url'    => 'http://twitter.com',
        ),
        array(
            'social_name' => esc_html__( 'Instagram', 'facewp-abbey' ),
            'link_url'    => 'https://www.instagram.com/',
        ),
        array(
            'social_name' => esc_html__( 'Vine', 'facewp-abbey' ),
            'link_url'    => 'https://vine.co/',
        ),

	),
	'fields'      => array(
		'social_name' => array(
			'type'    => 'text',
			'label'   => esc_html__( 'Name', 'facewp-abbey' ),
			'default' => '',
		),
		'link_url'    => array(
			'type'    => 'text',
			'label'   => esc_html__( 'URL', 'facewp-abbey' ),
			'default' => '',
		),
	),
) );