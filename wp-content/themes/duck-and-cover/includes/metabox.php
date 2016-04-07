<?php
add_filter( 'facewp_abbey_page_meta_box_presets', 'facewp_abbey_page_meta_box_presets' );
function facewp_abbey_page_meta_box_presets( $presets ) {
    $presets[] = 'footer_preset';
    $presets[] = 'header_preset';

    return $presets;
}

add_action( 'cmb2_admin_init', 'facewp_abbey_register_page_metabox' );
function facewp_abbey_register_page_metabox() {
    $prefix = 'facewp_abbey_';

    $cmb = new_cmb2_box( array(
        'id'           => $prefix . 'metabox',
        'title'        => __( 'Page Settings', 'facewp-abbey' ),
        'object_types' => array( 'page' ),
        'context'      => 'side',
        'priority'     => 'default',
        'show_names'   => true,
    ) );

    // Menus
    $menu_options = array(
        '' => esc_html__( 'Select', 'facewp-abbey' ),
    );
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); ;

    foreach ( $menus as $menu ) {
        $menu_options[ $menu->slug ] = $menu->name;
    }

    // Sidebars
    $sidebars = get_option( 'facewp_abbey_custom_sidebars' );
    if ( ! is_array( $sidebars ) ) {
        $sidebars = array();
    }

    $sidebar_options = array(
        '' => esc_html__( 'Select', 'facewp-abbey' ),
    );
    foreach ( $sidebars as $sidebar ) {
        $sidebar_options[ $sidebar ] = $sidebar;
    }

    $fields = array(
        array(
            'name' => __( 'Body Wrapper', 'facewp-abbey' ),
            'id'   => $prefix . 'body_wrapper',
            'type'    => 'select',
            'options' => array(
                ''              => esc_html__( 'Select', 'facewp-abbey' ),
                'wide'          => esc_html__( 'Wide', 'facewp-abbey' ),
                'boxed'         => esc_html__( 'Boxed', 'facewp-abbey' ),
            ),
        ),
        array(
            'name' => __( 'Page Layout', 'facewp-abbey' ),
            'id'   => $prefix . 'page_layout',
            'type'    => 'select',
            'options' => array(
                ''              => esc_html__( 'Select', 'facewp-abbey' ),
                'wide'          => esc_html__( 'Wide', 'facewp-abbey' ),
                'boxed'         => esc_html__( 'Boxed', 'facewp-abbey' ),
            ),
        ),
        array(
            'name' => __( 'Primary Menu', 'facewp-abbey' ),
            'id'   => $prefix . 'primary_menu',
            'type'    => 'select',
            'options' => $menu_options,
        ),
        array(
            'name' => __( 'Sidebar Position', 'facewp-abbey' ),
            'id'   => $prefix . 'sidebar_position',
            'type'    => 'select',
            'options' => array(
                ''              => esc_html__( 'Select', 'facewp-abbey' ),
                'no-sidebar'    => esc_html__( 'No Sidebar', 'facewp-abbey' ),
                'left-sidebar'  => esc_html__( 'Left Sidebar', 'facewp-abbey' ),
                'right-sidebar' => esc_html__( 'Right Sidebar', 'facewp-abbey' ),
            ),
        ),
        array(
            'name' => __( 'Sidebar', 'facewp-abbey' ),
            'id'   => $prefix . 'sidebar',
            'type'    => 'select',
            'options' => $sidebar_options,
        ),
    );

    // Header & Footer presets
    $presets = apply_filters( 'facewp_abbey_page_meta_box_presets', array() );
    $preset_meta_boxes = array();

    if ( ! empty( $presets ) ) {
        foreach ( $presets as $preset ) {
            if ( ! empty( Kirki::$fields[ $preset ] ) && ! empty( Kirki::$fields[ $preset ]['choices'] ) ) {
                $kirki_preset = Kirki::$fields[ $preset ];
                $options      = array( '' => '' );

                foreach ( $kirki_preset['choices'] as $preset_choice_value => $preset_choice ) {
                    $options[ $preset_choice_value ] = $preset_choice['label'];
                }

                $preset_meta_boxes[] = array(
                    'name'    => $kirki_preset['label'],
                    'desc'    => isset( $kirki_preset['description'] ) ? $kirki_preset['description'] : '',
                    'id'      => $prefix . $preset,
                    'type'    => 'select',
                    'options' => $options,
                );
            }
        }
    }

    $reverse_preset_meta_boxes = array_reverse( $preset_meta_boxes );

    foreach ( $reverse_preset_meta_boxes as $preset_meta_box ) {
        $fields[] = $preset_meta_box;
    }

    $fields[] = array(
        'name' => __( 'Sticky Header', 'facewp-abbey' ),
        'id'   => $prefix . 'sticky_header',
        'desc' => __( 'Enable sticky header.', 'cmb2' ),
        'type' => 'checkbox',
    );

    $fields[] = array(
        'name' => __( 'Overlay Header', 'facewp-abbey' ),
        'id'   => $prefix . 'overlay_header',
        'desc' => __( 'Enable overlay header.', 'cmb2' ),
        'type' => 'checkbox',
    );

    $fields[] = array(
        'name' => __( 'Background Image', 'facewp-abbey' ),
        'desc' => __( 'Choose background image of page.', 'cmb2' ),
        'id'   => $prefix . 'background_image',
        'type' => 'file',
    );

    $fields[] = array(
        'name' => __( 'Background Repeat', 'facewp-abbey' ),
        'id'   => $prefix . 'background_repeat',
        'type'    => 'select',
        'options' => array(
            ''          => esc_html__( 'Select', 'facewp-abbey' ),
            'no-repeat' => esc_html__( 'No Repeat', 'facewp-abbey' ),
            'repeat'    => esc_html__( 'Repeat', 'facewp-abbey' ),
            'repeat-x'  => esc_html__( 'Repeat Horizontally', 'facewp-abbey' ),
            'repeat-y'  => esc_html__( 'Repeat Vertically', 'facewp-abbey' ),
        ),
    );

    $fields[] = array(
        'name' => __( 'Background Position', 'facewp-abbey' ),
        'id'   => $prefix . 'background_position',
        'type'    => 'select',
        'options' => array(
            ''              => esc_html__( 'Select', 'facewp-abbey' ),
            'left top'      => esc_html__( 'Left Top', 'facewp-abbey' ),
            'left center'   => esc_html__( 'Left Center', 'facewp-abbey' ),
            'left bottom'   => esc_html__( 'Left Bottom', 'facewp-abbey' ),
            'center top'    => esc_html__( 'Center Top', 'facewp-abbey' ),
            'center center' => esc_html__( 'Center Center', 'facewp-abbey' ),
            'center bottom' => esc_html__( 'Center Bottom', 'facewp-abbey' ),
            'right top'     => esc_html__( 'Right Top', 'facewp-abbey' ),
            'right center'  => esc_html__( 'Right Center', 'facewp-abbey' ),
            'right bottom'  => esc_html__( 'Right Bottom', 'facewp-abbey' ),
        ),
    );

    $fields[] = array(
        'name' => __( 'Background Attachment', 'facewp-abbey' ),
        'id'   => $prefix . 'background_attachment',
        'type'    => 'select',
        'options' => array(
            ''       => esc_html__( 'Select', 'facewp-abbey' ),
            'scroll' => esc_html__( 'Scroll', 'facewp-abbey' ),
            'fixed'  => esc_html__( 'Fixed', 'facewp-abbey' ),
        ),
    );

    foreach ( $fields as $field ) {
        $cmb->add_field( $field );
    }
}