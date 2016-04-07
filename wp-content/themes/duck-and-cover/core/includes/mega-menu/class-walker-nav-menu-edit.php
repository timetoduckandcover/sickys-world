<?php
class FaceWP_Abbey_Walker_Nav_Menu_Edit extends Walker_Nav_Menu {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
	}

	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)', 'facewp-abbey' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)', 'facewp-abbey'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
	<li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo esc_attr( implode(' ', $classes ) ); ?>">
		<div class="menu-item-bar">
			<div class="menu-item-handle">
				<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo esc_attr( $submenu_text ); ?>><?php _e( 'sub item', 'facewp-abbey' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
							echo wp_nonce_url(
								add_query_arg(
									array(
										'action' => 'move-up-menu-item',
										'menu-item' => $item_id,
									),
									remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
								),
								'move-menu_item'
							);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'facewp-abbey'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
							echo wp_nonce_url(
								add_query_arg(
									array(
										'action' => 'move-down-menu-item',
										'menu-item' => $item_id,
									),
									remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
								),
								'move-menu_item'
							);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'facewp-abbey' ); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e( 'Edit Menu Item', 'facewp-abbey' ); ?>" href="<?php
						echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item', 'facewp-abbey' ); ?></a>
					</span>
			</div>
		</div>

		<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
			<?php if ( 'custom' == $item->type ) : ?>
				<p class="field-url description description-wide">
					<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
						<?php _e( 'URL', 'facewp-abbey' ); ?><br />
						<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
					</label>
				</p>
			<?php endif; ?>
			<p class="description description-wide">
				<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
					<?php _e( 'Navigation Label', 'facewp-abbey' ); ?><br />
					<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
				</label>
			</p>
			<p class="field-title-attribute description description-wide">
				<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
					<?php _e( 'Title Attribute', 'facewp-abbey' ); ?><br />
					<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
				</label>
			</p>
			<p class="field-link-target description">
				<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
					<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
					<?php _e( 'Open link in a new window/tab', 'facewp-abbey' ); ?>
				</label>
			</p>
			<p class="field-css-classes description description-thin">
				<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
					<?php _e( 'CSS Classes (optional)', 'facewp-abbey' ); ?><br />
					<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
				</label>
			</p>
			<p class="field-custom description description-wide">
				<label for="edit-menu-item-nolink-<?php echo esc_attr($item_id); ?>">
					<input type="checkbox" id="edit-menu-item-nolink-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" data-item-option name="menu-item-nolink[<?php echo esc_attr( $item_id ); ?>]" value="nolink" <?php checked( $item->nolink, 'nolink' ); ?> />
					<?php _e( "Don't link", 'facewp-abbey' ); ?>
				</label>
			</p>
			<p class="field-custom description description-wide">
				<label for="edit-menu-item-hide-<?php echo esc_attr($item_id); ?>">
					<input type="checkbox" id="edit-menu-item-hide-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" data-item-option name="menu-item-hide[<?php echo esc_attr( $item_id ); ?>]" value="hide" <?php checked( $item->hide, 'hide' ); ?> />
					<?php _e( "Don't show", 'facewp-abbey' ); ?>
				</label>
			</p>
			<p class="field-custom description description-thin description-wide" style="display: <?php echo esc_attr( $depth == 0 ? 'block' : 'none' ); ?>">
				<label for="edit-menu-item-menu-type-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Type', 'facewp-abbey' ); ?><br />
					<select class="widefat" id="edit-menu-item-menu-type<?php echo esc_attr($item_id); ?>" data-item-option name="menu-item-menu_type[<?php echo esc_attr( $item_id ); ?>]">
						<option value="narrow" <?php if ( $item->menu_type == "narrow" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Narrow', 'facewp-abbey' ); ?></option>
						<option value="wide" <?php if ( $item->menu_type == "wide" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Wide', 'facewp-abbey' ); ?></option>
						<option value="full-width" <?php if ( $item->menu_type == "full-width" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Full Width', 'facewp-abbey' ); ?></option>
					</select>
				</label>
			</p>
			<p class="field-custom description description-thin description-wide" style="display: <?php echo esc_attr( $depth == 0 ? 'block' : 'none' ); ?>">
				<label for="edit-menu-item-sub_menu-columns-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Sub-Menu Columns', 'facewp-abbey' ); ?> (<?php _e( 'Only with "Wide" menu type', 'facewp-abbey' ); ?>)<br />
					<select class="widefat" id="edit-menu-item-sub_menu-columns<?php echo esc_attr($item_id); ?>" data-item-option name="menu-item-sub_menu_columns[<?php echo esc_attr( $item_id ); ?>]">
						<option value="" <?php if ( $item->sub_menu_columns == "" ) { echo 'selected="selected"'; } ?>></option>
						<option value="2" <?php if ( $item->sub_menu_columns == "2" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '2 Columns', 'facewp-abbey' ); ?></option>
						<option value="3" <?php if ( $item->sub_menu_columns == "3" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '3 Columns', 'facewp-abbey' ); ?></option>
						<option value="4" <?php if ( $item->sub_menu_columns == "4" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '4 Columns', 'facewp-abbey' ); ?></option>
						<option value="5" <?php if ( $item->sub_menu_columns == "5" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '5 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->sub_menu_columns == "6" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '6 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->sub_menu_columns == "7" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '7 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->sub_menu_columns == "8" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '8 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->sub_menu_columns == "9" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '9 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->sub_menu_columns == "10" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '10 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->sub_menu_columns == "11" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '11 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->sub_menu_columns == "12" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '12 Columns', 'facewp-abbey' ); ?></option>
					</select>
				</label>
			</p>
			<p class="field-custom description description-thin description-wide" style="display: <?php echo esc_attr( $depth > 0 ? 'block' : 'none' ); ?>">
				<label for="edit-menu-item-columns-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Columns', 'facewp-abbey' ); ?><br />
					<select class="widefat" id="edit-menu-item-columns<?php echo esc_attr($item_id); ?>" data-item-option name="menu-item-columns[<?php echo esc_attr( $item_id ); ?>]">
						<option value="" <?php if ( $item->columns == "" ) { echo 'selected="selected"'; } ?>></option>
						<option value="2" <?php if ( $item->columns == "2" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '2 Columns', 'facewp-abbey' ); ?></option>
						<option value="3" <?php if ( $item->columns == "3" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '3 Columns', 'facewp-abbey' ); ?></option>
						<option value="4" <?php if ( $item->columns == "4" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '4 Columns', 'facewp-abbey' ); ?></option>
						<option value="5" <?php if ( $item->columns == "5" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '5 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->columns == "6" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '6 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->columns == "7" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '7 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->columns == "8" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '8 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->columns == "9" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '9 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->columns == "10" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '10 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->columns == "11" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '11 Columns', 'facewp-abbey' ); ?></option>
						<option value="6" <?php if ( $item->columns == "12" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( '12 Columns', 'facewp-abbey' ); ?></option>
					</select>
				</label>
			</p>
			<p class="field-custom description description-thin description-wide">
				<label for="edit-menu-item-sub_menu-position-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Sub-Menu Position', 'facewp-abbey' ); ?><br />
					<select class="widefat" id="edit-menu-item-sub_menu-position<?php echo esc_attr($item_id); ?>" data-item-option name="menu-item-sub_menu_position[<?php echo esc_attr( $item_id ); ?>]">
						<option value="" <?php if ( $item->sub_menu_position == "" ){ echo 'selected="selected"'; } ?>></option>
						<option value="left" <?php if ( $item->sub_menu_position == "left" ){ echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Left', 'facewp-abbey' ); ?></option>
						<option value="right" <?php if ( $item->sub_menu_position == "right" ){ echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Right', 'facewp-abbey' ); ?></option>
					</select>
				</label>
			</p>
			<p class="field-custom description description-thin description-wide">
				<label for="edit-menu-item-background-image-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Background Image', 'facewp-abbey' ); ?><br />
					<input type="text" id="edit-menu-item-background-image-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-background-image" name="menu-item-background_image[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->background_image ); ?>" style="margin-bottom: 5px;" />
					<input class="facewp-abbey-button-upload-image button" data-input="edit-menu-item-background-image-<?php echo esc_attr( $item_id ); ?>" type="button" value="<?php echo esc_html__( 'Upload Image', 'facewp-abbey' ); ?>" />&nbsp;
					<input class="facewp-abbey-button-remove-image button" data-input="edit-menu-item-background-image-<?php echo esc_attr( $item_id ); ?>" type="button" value="<?php echo esc_html__( 'Remove Image', 'facewp-abbey' ); ?>" />
				</label>
			</p>
			<p class="field-custom description description-thin description-thin-custom">
				<label for="edit-menu-item-background-position-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Background Position', 'facewp-abbey' ); ?><br />
					<select class="widefat" id="edit-menu-item-background-position-<?php echo esc_attr($item_id); ?>" data-item-option name="menu-item-background_position[<?php echo esc_attr( $item_id ); ?>]">
						<option value="" <?php if ( $item->background_position == "" ) { echo 'selected="selected"'; } ?>></option>
						<option value="left top" <?php if ( $item->background_position == "left top" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Left Top', 'facewp-abbey' ); ?></option>
						<option value="left center" <?php if ( $item->background_position == "left center" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Left Center', 'facewp-abbey' ); ?></option>
						<option value="left center" <?php if ( $item->background_position == "left center" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Left Center', 'facewp-abbey' ); ?></option>
						<option value="left bottom" <?php if ( $item->background_position == "left bottom" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Left Bottom', 'facewp-abbey' ); ?></option>
						<option value="center top" <?php if ( $item->background_position == "center top" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Center Top', 'facewp-abbey' ); ?></option>
						<option value="center center" <?php if ( $item->background_position == "center center" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Center Center', 'facewp-abbey' ); ?></option>
						<option value="center bottom" <?php if ( $item->background_position == "center bottom" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Center Bottom', 'facewp-abbey' ); ?></option>
						<option value="right top" <?php if ( $item->background_position == "right top" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Right Top', 'facewp-abbey' ); ?></option>
						<option value="right center" <?php if ( $item->background_position == "right center" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Right Center', 'facewp-abbey' ); ?></option>
						<option value="right bottom" <?php if ( $item->background_position == "right bottom" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Right Bottom', 'facewp-abbey' ); ?></option>
					</select>
				</label>
			</p>
			<p class="field-custom description description-thin description-thin-custom">
				<label for="edit-menu-item-background-repeat-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Background Repeat', 'facewp-abbey' ); ?><br />
					<select class="widefat" id="edit-menu-item-background-repeat-<?php echo esc_attr($item_id); ?>" data-item-option name="menu-item-background_repeat[<?php echo esc_attr( $item_id ); ?>]">
						<option value="" <?php if ( $item->background_repeat == "" ) { echo 'selected="selected"'; } ?>></option>
						<option value="no-repeat" <?php if ( $item->background_repeat == "no-repeat" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'No Repeat', 'facewp-abbey' ); ?></option>
						<option value="repeat" <?php if ( $item->background_repeat == "repeat" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Repeat All', 'facewp-abbey' ); ?></option>
						<option value="repeat-x" <?php if ( $item->background_repeat == "repeat-x" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Repeat Horizontally', 'facewp-abbey' ); ?></option>
						<option value="repeat-y" <?php if ( $item->background_repeat == "repeat-y" ) { echo 'selected="selected"'; } ?>><?php echo esc_html__( 'Repeat Vertically', 'facewp-abbey' ); ?></option>
					</select>
				</label>
			</p>
			<p class="field-custom description description-thin description-wide">
				<label for="edit-menu-item-icon-class-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Icon Class', 'facewp-abbey' ); ?><br />
					<input type="text" id="edit-menu-item-icon-class-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-icon-class" placeholder="For example: fa fa-wordpress" name="menu-item-icon_class[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->icon_class ); ?>" />
				</label>
			</p>
			<p class="field-custom description description-thin description-wide">
				<label for="edit-menu-item-badge-label-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Badge Label', 'facewp-abbey' ); ?><br />
					<input type="text" id="edit-menu-item-badge-label-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-badge-label" name="menu-item-badge_label[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->badge_label ); ?>" />
				</label>
			</p>
			<p class="field-custom description description-thin description-thin-custom">
				<label for="edit-menu-item-badge-text-color-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Badge Text Color', 'facewp-abbey' ); ?><br />
					<input type="text" id="edit-menu-item-badge-text-color-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-badge-text-color" name="menu-item-badge_text_color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->badge_text_color ); ?>" />
				</label>
			</p>
			<p class="field-custom description description-thin description-thin-custom">
				<label for="edit-menu-item-badge-background-color-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Badge Text Color', 'facewp-abbey' ); ?><br />
					<input type="text" id="edit-menu-item-badge-background-color-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-badge-background-color" name="menu-item-badge_background_color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->badge_background_color ); ?>" />
				</label>
			</p>
			<p class="field-custom description description-thin description-wide" style="display: <?php echo esc_attr( $depth > 0 ? 'block' : 'none' ); ?>">
				<label for="edit-menu-item-widget-area-<?php echo esc_attr($item_id); ?>">
					<?php _e( 'Custom Widget Position', 'facewp-abbey' ); ?><br />
					<select class="widefat" id="edit-menu-item-widget-area-<?php echo esc_attr($item_id); ?>" data-item-option name="menu-item-widget_area[<?php echo esc_attr( $item_id ); ?>]">
						<option value="" <?php if ( $item->widget_area == "" ){ echo 'selected="selected"'; } ?>></option>
						<?php foreach ( facewp_abbey_get_custom_sidebars() as $sidebar => $sidebar_name ) : ?>
							<option value="<?php echo esc_attr( $sidebar ); ?>" <?php if( $item->widget_area == $sidebar ) { echo 'selected="selected"'; } ?>><?php echo esc_html( $sidebar_name ); ?></option>
						<?php endforeach; ?>
					</select>
				</label>
			</p>
			<p class="field-xfn description description-thin">
				<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
					<?php _e( 'Link Relationship (XFN)', 'facewp-abbey' ); ?><br />
					<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
				</label>
			</p>
			<p class="field-description description description-wide">
				<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
					<?php _e( 'Description', 'facewp-abbey' ); ?><br />
					<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
					<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'facewp-abbey'); ?></span>
				</label>
			</p>

			<p class="field-move hide-if-no-js description description-wide">
				<label>
					<span><?php _e( 'Move', 'facewp-abbey' ); ?></span>
					<a href="#" class="menus-move menus-move-up" data-dir="up"><?php _e( 'Up one', 'facewp-abbey' ); ?></a>
					<a href="#" class="menus-move menus-move-down" data-dir="down"><?php _e( 'Down one', 'facewp-abbey' ); ?></a>
					<a href="#" class="menus-move menus-move-left" data-dir="left"></a>
					<a href="#" class="menus-move menus-move-right" data-dir="right"></a>
					<a href="#" class="menus-move menus-move-top" data-dir="top"><?php _e( 'To the top', 'facewp-abbey' ); ?></a>
				</label>
			</p>

			<div class="menu-item-actions description-wide submitbox">
				<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
					<p class="link-to-original">
						<?php printf( __('Original: %s', 'facewp-abbey'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
					</p>
				<?php endif; ?>
				<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
				echo wp_nonce_url(
					add_query_arg(
						array(
							'action' => 'delete-menu-item',
							'menu-item' => $item_id,
						),
						admin_url( 'nav-menus.php' )
					),
					'delete-menu_item_' . $item_id
				); ?>"><?php _e( 'Remove', 'facewp-abbey' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
				?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php _e('Cancel', 'facewp-abbey'); ?></a>
			</div>

			<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
			<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
			<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
			<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
			<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
			<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
		</div><!-- .menu-item-settings-->
		<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}