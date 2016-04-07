<?php
add_filter( 'wp_setup_nav_menu_item', 'facewp_abbey_add_custom_nav_fields' );
function facewp_abbey_add_custom_nav_fields( $menu_item ) {
	$menu_item->nolink                 = get_post_meta( $menu_item->ID, '_menu_item_nolink', true );
	$menu_item->hide                   = get_post_meta( $menu_item->ID, '_menu_item_hide', true );
	$menu_item->menu_type              = get_post_meta( $menu_item->ID, '_menu_item_menu_type', true );
	$menu_item->sub_menu_position      = get_post_meta( $menu_item->ID, '_menu_item_sub_menu_position', true );
	$menu_item->sub_menu_columns       = get_post_meta( $menu_item->ID, '_menu_item_sub_menu_columns', true );
	$menu_item->columns                = get_post_meta( $menu_item->ID, '_menu_item_columns', true );
	$menu_item->background_image       = get_post_meta( $menu_item->ID, '_menu_item_background_image', true );
	$menu_item->background_position    = get_post_meta( $menu_item->ID, '_menu_item_background_position', true );
	$menu_item->background_repeat      = get_post_meta( $menu_item->ID, '_menu_item_background_repeat', true );
	$menu_item->icon_class             = get_post_meta( $menu_item->ID, '_menu_item_icon_class', true );
	$menu_item->badge_label            = get_post_meta( $menu_item->ID, '_menu_item_badge_label', true );
	$menu_item->badge_text_color       = get_post_meta( $menu_item->ID, '_menu_item_badge_text_color', true );
	$menu_item->badge_background_color = get_post_meta( $menu_item->ID, '_menu_item_badge_background_color', true );
	$menu_item->widget_area            = get_post_meta( $menu_item->ID, '_menu_item_widget_area', true );

	return $menu_item;

}

add_action( 'wp_update_nav_menu_item', 'facewp_abbey_update_custom_nav_fields', 10, 3 );
function facewp_abbey_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	$fields = array(
		'nolink',
		'hide',
		'menu_type',
		'sub_menu_position',
		'sub_menu_columns',
		'columns',
		'background_image',
		'background_position',
		'background_repeat',
		'icon_class',
		'badge_label',
		'badge_text_color',
		'badge_background_color',
		'widget_area',
	);

	foreach ( $fields as $field ) {
		if ( isset( $_POST[ 'menu-item-' . $field ][ $menu_item_db_id ] ) ) {
			$value = $_POST[ 'menu-item-' . $field ][ $menu_item_db_id ];

		} else {
			if ( ! isset( $args[ 'menu-item-' . $field ] ) ) {
				$value = "";
			} else {
				$value = $args[ 'menu-item-' . $field ];
			}
		}

		update_post_meta( $menu_item_db_id, '_menu_item_' . $field, $value );
	}
}

add_filter( 'wp_edit_nav_menu_walker', 'facewp_abbey_edit_walker', 10, 2 );
function facewp_abbey_edit_walker( $walker, $menu_id ) {

	return 'FaceWP_Abbey_Walker_Nav_Menu_Edit';

}

if ( is_admin() ) {
	include_once( 'class-walker-nav-menu-edit.php' );
}

include_once( 'class-type1-walker-nav-menu.php' );
include_once( 'class-mobile-walker-nav-menu.php' );