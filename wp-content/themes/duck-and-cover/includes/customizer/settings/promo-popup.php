<?php
$section  = 'promo_popup';
$priority = 1;

Kirki::add_field( 'facewp', array(
	'type'        => 'toggle',
	'setting'     => 'promo_popup_show',
	'label'       => esc_html__( 'Show Promo Popup', 'facewp-abbey' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
) );

Kirki::add_field( 'facewp', array(
	'type'      => 'textarea',
	'setting'   => 'promo_popup_content',
	'label'     => esc_html__( 'Popup Content', 'facewp-abbey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => '',
) );

Kirki::add_field( 'facewp', array(
	'type'        => 'textfield',
	'setting'     => 'promo_popup_width',
	'label'       => esc_html__( 'Popup Width (in px)', 'facewp-abbey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '700',
) );

Kirki::add_field( 'facewp', array(
	'type'        => 'textfield',
	'setting'     => 'promo_popup_height',
	'label'       => esc_html__( 'Popup Height (in px)', 'facewp-abbey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '350',
) );

Kirki::add_field( 'facewp', array(
	'type'      => 'color-alpha',
	'setting'   => 'promo_popup_background_color',
	'label'     => esc_html__( 'Popup Background Color', 'facewp-abbey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => '',
) );

Kirki::add_field( 'facewp', array(
	'type'      => 'image',
	'setting'   => 'promo_popup_background_image',
	'label'     => esc_html__( 'Popup Background Image', 'facewp-abbey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => '',
) );

Kirki::add_field( 'facewp', array(
	'type'      => 'select',
	'setting'   => 'promo_popup_background_repeat',
	'label'     => esc_html__( 'Popup Background Repeat', 'facewp-abbey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 'no-repeat',
	'choices' => array(
		'no-repeat' => esc_html__( 'No Repeat', 'facewp-abbey' ),
		'repeat'    => esc_html__( 'Repeat All', 'facewp-abbey' ),
		'repeat-x'  => esc_html__( 'Repeat Horizontally', 'facewp-abbey' ),
		'repeat-y'  => esc_html__( 'Repeat Vertically', 'facewp-abbey' ),
	),
	'required'    => array(
		array(
			'setting'  => 'promo_popup_background_image',
			'operator' => '!=',
			'value'    => '',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'      => 'select',
	'setting'   => 'promo_popup_background_attachment',
	'label'     => esc_html__( 'Popup Background Attachment', 'facewp-abbey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 'fixed',
	'choices' => array(
		'fixed'  => esc_html__( 'Fixed', 'facewp-abbey' ),
		'scroll' => esc_html__( 'Scroll', 'facewp-abbey' ),
	),
	'required'    => array(
		array(
			'setting'  => 'promo_popup_background_image',
			'operator' => '!=',
			'value'    => '',
		),
	),
) );

Kirki::add_field( 'facewp', array(
	'type'      => 'select',
	'setting'   => 'promo_popup_background_position',
	'label'     => esc_html__( 'Popup Background Position', 'facewp-abbey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 'left top',
	'choices' => array(
		'left top'      => esc_html__( 'left top', 'facewp-abbey' ),
		'left center'   => esc_html__( 'left center', 'facewp-abbey' ),
		'left center'   => esc_html__( 'left center', 'facewp-abbey' ),
		'left bottom'   => esc_html__( 'left bottom', 'facewp-abbey' ),
		'center top'    => esc_html__( 'center top', 'facewp-abbey' ),
		'center center' => esc_html__( 'center center', 'facewp-abbey' ),
		'center bottom' => esc_html__( 'center bottom', 'facewp-abbey' ),
		'right top'     => esc_html__( 'right top', 'facewp-abbey' ),
		'right center'  => esc_html__( 'right center', 'facewp-abbey' ),
		'right bottom'  => esc_html__( 'right bottom', 'facewp-abbey' ),
	),
	'required'    => array(
		array(
			'setting'  => 'promo_popup_background_image',
			'operator' => '!=',
			'value'    => '',
		),
	),
) );