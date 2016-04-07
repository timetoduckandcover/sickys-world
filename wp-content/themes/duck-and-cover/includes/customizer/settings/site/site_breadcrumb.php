<?php
/**
 * Site General
 * ================
 */
$section  = 'site_breadcrumb';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'site_breadcrumb_enable',
    'label'       => esc_html__( 'Show Breadcrumb', 'facewp-abbey' ),
    'description' => esc_html__( 'Enabling this option will display breadcrumb', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 1,
) );