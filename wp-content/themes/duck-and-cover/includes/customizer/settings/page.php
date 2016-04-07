<?php
$section  = 'page';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'        => 'toggle',
    'setting'     => 'page_share',
    'label'       => esc_html__( 'Hide Share Buttons', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => '0',
) );