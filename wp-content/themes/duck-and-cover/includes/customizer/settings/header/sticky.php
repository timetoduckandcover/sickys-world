<?php
$section  = 'header_sticky';
$priority = 1;

Kirki::add_field( 'facewp', array(
	'type'     => 'color',
	'settings' => 'header_sticky_background_color',
	'label'    => __( 'Background Color', 'facewp-abbey' ),
	'section'  => $section,
	'default'  => 'rgba(34, 34, 34, 0.85)',
	'priority' => $priority ++,
	'output' => array(
		array(
			'element'  => '#header.header-sticky',
			'property' => 'background-color',
		),
	),
) );