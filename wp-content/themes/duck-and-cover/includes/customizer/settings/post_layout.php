<?php
$section  = 'post_layout';
$priority = 1;

Kirki::add_field( '', array(
    'type'     => 'radio',
    'settings' => 'blog_layout',
    'label'    => __( 'Blog Layout', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'full',
    'choices'  => array(
        'full'    => esc_html__( 'Full Post Layout', 'facewp-abbey' ),
        'masonry' => esc_html__( 'Masonry Post Layout', 'facewp-abbey' ),
        'list'    => esc_html__( 'List Post Layout', 'facewp-abbey' ),
    ),
) );

Kirki::add_field( '', array(
    'type'     => 'radio',
    'settings' => 'blog_archive_layout',
    'label'    => esc_html__( 'Blog Archive Layout', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => 'full',
    'choices'  => array(
        'full'    => esc_html__( 'Full Post Layout', 'facewp-abbey' ),
        'masonry' => esc_html__( 'Masonry Post Layout', 'facewp-abbey' ),
        'list'    => esc_html__( 'List Post Layout', 'facewp-abbey' ),
    ),
) );

Kirki::add_field( '', array(
    'type'     => 'radio',
    'settings' => 'post_summary',
    'label'    => esc_html__( 'Homepage/Archive Post Summary Type', 'facewp-abbey' ),
    'section'  => $section,
    'default'  => 'excerpt',
    'priority' => $priority++,
    'choices'  => array(
        'full'      => esc_html__( 'Full Post', 'facewp-abbey' ),
        'read-more' => esc_html__( 'Use Read More Tag', 'facewp-abbey' ),
        'excerpt'   => esc_html__( 'Use Excerpt', 'facewp-abbey' ),
    ),
) );