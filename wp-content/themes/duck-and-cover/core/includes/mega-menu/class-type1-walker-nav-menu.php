<?php
class FaceWP_Abbey_Type1_Walker_Nav_Menu extends Walker_Nav_Menu {
	protected $menu_type;
	protected $background_image;
	protected $background_position;
	protected $background_repeat;

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$inline_styles = array();
		if ( $this->background_image ) {
			$inline_styles[] = 'background-image: url("'. $this->background_image .'")';

			if ( $this->background_position ) {
				$inline_styles[] = 'background-position:' . $this->background_position;
			}
			$inline_styles[] =  'background-repeat: ' . ( $this->background_repeat ? $this->background_repeat : 'no-repeat' );
		}

		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu ". esc_attr( 'wide' == $this->menu_type || 'full-width' == $this->menu_type ? 'mega-menu' : '' ) ."\" style=\"". esc_attr( implode( ';', $inline_styles ) ) ."\">\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$this->menu_type           = ! empty( $item->menu_type ) ? $item->menu_type : 'narrow';
		$this->background_image    = ! empty( $item->background_image ) ? $item->background_image : '';
		$this->background_position = ! empty( $item->background_position ) ? $item->background_position : '';
		$this->background_repeat   = ! empty( $item->background_repeat ) ? $item->background_repeat : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$classes[] = ! empty( $item->sub_menu_position ) ? $item->sub_menu_position : '';

		if ( $depth == 0 ) {
			$classes[] = ! empty( $item->menu_type ) ? $item->menu_type : '';
			if ( ! empty( $item->menu_type ) && ( 'full-width' == $item->menu_type || 'wide' == $item->menu_type ) ) {
				$classes[] = 'menu-item-mega-menu';
			}

			$classes[] = ! empty( $item->sub_menu_columns ) ? 'col-' . $item->sub_menu_columns : '';
		}

		if ( $depth > 0 ) {
			$classes[] = ! empty( $item->columns ) ? 'col-span-' . $item->columns : '';
		}

		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts['class']   = '';

		if ( ! empty( $item->nolink ) ) {
			$atts['class'] .= ' no-link';
		}

		if ( ! empty( $item->icon_class ) ) {
			$atts['class'] .= ' has-icon';
		}
		if ( ! empty( $item->badge_label ) ) {
			$atts['class'] .= ' has-badge';
		}

		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;

		if ( empty( $item->hide ) ) {
			$item_output .= '<a'. $attributes .'>';

			if ( ! empty( $item->icon_class ) ) {
				$item_output .= '<i class="menu-item-icon '. esc_attr( $item->icon_class ) .'"></i>';
			}

			$item_output .= '<span class="menu-item-text">';

			/** This filter is documented in wp-includes/post-template.php */
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

			if ( ! empty( $item->badge_label ) ) {
				$badge_inline_styles = array();
				if ( ! empty( $item->badge_text_color ) ) {
					$badge_inline_styles[] = 'color: ' . $item->badge_text_color;
				}
				if ( ! empty( $item->badge_background_color ) ) {
					$badge_inline_styles[] = 'background-color: ' . $item->badge_background_color;
				}

				$item_output .= '<span class="menu-item-badge" style="'. esc_attr( implode( ';', $badge_inline_styles ) ) .'">'. esc_html( $item->badge_label ) .'</span>';
			}

			$item_output .= '</span>';

			$item_output .= '</a>';

		}

		if ($depth > 0 && ! empty( $item->widget_area ) ) {
			ob_start();
			dynamic_sidebar( $item->widget_area );
			$item_output .= ob_get_clean();
		}

		$item_output .= $args->after;


		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}