<?php
$section  = 'header_search';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'header_search_show',
    'label'       => esc_html__( 'Show Search Form', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 1,
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'header_search_categories_show',
    'label'       => esc_html__( 'Show Categories', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 1,
) );