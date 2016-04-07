<?php
$section  = 'woocommerce_general';
$priority = 1;

Kirki::add_field( 'facewp', array(
	'type'     => 'legend',
	'setting'  => 'woocommerce_general_catalog_mode_legend',
	'label'    => esc_html__( 'Catalog Mode', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Kirki::add_field( 'facewp', array(
	'type'     => 'toggle',
	'setting'  => 'woocommerce_general_catalog_mode',
	'label'    => esc_html__( 'Enable Catalog Mode', 'facewp-abbey' ),
	'description' => esc_html__( 'Disable sales in your e-commerce and turn it into an e-commerce into an online catalogue', 'facewp-abbey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 0,
) );