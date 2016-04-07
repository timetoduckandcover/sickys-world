<?php
add_action( 'vc_before_init', 'facewp_abbey_remove_updater_notice' );
function facewp_abbey_remove_updater_notice() {
	vc_manager()->disableUpdater();
}

add_action( 'vc_after_init', 'facewp_abbey_load_shortcodes' );
function facewp_abbey_load_shortcodes() {
	$section_group = __( 'Abbey Options', 'facewp-abbey' );

	$animation_group    = __( 'Animation', 'facewp-abbey' );
	$animation_type     = array(
		"type"        => "facewp_abbey_animation_type",
		"heading"     => __( "Animation Type", 'facewp-abbey' ),
		"param_name"  => "animation_type",
		"admin_label" => true,
		'group'       => $animation_group
	);
	$animation_duration = array(
		"type"        => "textfield",
		"heading"     => __( "Animation Duration", 'facewp-abbey' ),
		"param_name"  => "animation_duration",
		"description" => __( "numerical value (unit: seconds)", 'facewp-abbey' ),
		"value"       => '1s',
		'group'       => $animation_group
	);
	$animation_delay    = array(
		"type"        => "textfield",
		"heading"     => __( "Animation Delay", 'facewp-abbey' ),
		"param_name"  => "animation_delay",
		"description" => __( "numerical value (unit: seconds)", 'facewp-abbey' ),
		"value"       => '0s',
		'group'       => $animation_group
	);

	vc_add_param( 'vc_row', array(
		'type'        => 'checkbox',
		'heading'     => __( 'Wrap as Container', 'facewp-abbey' ),
		'param_name'  => 'wrap_container',
		'value'       => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		'group'       => $section_group,
		'admin_label' => true,
	) );

	vc_add_param( 'vc_row', array(
		'type'        => 'colorpicker',
		'heading'     => __( 'Background Overlay', 'facewp-abbey' ),
		'group'       => $section_group,
		'param_name'  => 'row_bg_overlay',
		'description' => __( 'Choose an overlay color for background of row. Leave blank for none.', 'facewp-abbey' ),
	) );

	vc_add_param( 'vc_row', $animation_type );
	vc_add_param( 'vc_row', $animation_duration );
	vc_add_param( 'vc_row', $animation_delay );

	vc_add_param( 'vc_row_inner', $animation_type );
	vc_add_param( 'vc_row_inner', $animation_duration );
	vc_add_param( 'vc_row_inner', $animation_delay );

	vc_add_param( 'vc_column', $animation_type );
	vc_add_param( 'vc_column', $animation_duration );
	vc_add_param( 'vc_column', $animation_delay );

	vc_add_param( 'vc_column_inner', $animation_type );
	vc_add_param( 'vc_column_inner', $animation_duration );
	vc_add_param( 'vc_column_inner', $animation_delay );

	vc_add_param( 'vc_custom_heading', array(
		'type'        => 'dropdown',
		'heading'     => __( 'Font Weight', 'facewp-abbey' ),
		'param_name'  => 'font_weight',
		'value'       => array(
			__( 'Extra-Light', 'facewp-abbey' ) => 200,
			__( 'Light', 'facewp-abbey' )       => 300,
			__( 'Normal', 'facewp-abbey' )      => 400,
			__( 'Semi-Bold', 'facewp-abbey' )   => 600,
			__( 'Bold', 'facewp-abbey' )        => 700,
			__( 'Extra-Bold', 'facewp-abbey' )  => 800,
		),
		'std'         => 400,
		'group'       => $section_group,
		'admin_label' => false,
	) );
	vc_add_param( 'vc_custom_heading', array(
		'type'        => 'dropdown',
		'heading'     => __( 'Font Style', 'facewp-abbey' ),
		'param_name'  => 'font_style',
		'value'       => array(
			__( 'Normal', 'facewp-abbey' ) => 'normal',
			__( 'Italic', 'facewp-abbey' ) => 'italic',
		),
		'std'         => 'normal',
		'group'       => $section_group,
		'admin_label' => false,
	) );
	vc_add_param( 'vc_custom_heading', array(
		'type'        => 'dropdown',
		'heading'     => __( 'Text Transform', 'facewp-abbey' ),
		'param_name'  => 'text_transform',
		'value'       => array(
			__( 'None', 'facewp-abbey' )       => 'none',
			__( 'Capitalize', 'facewp-abbey' ) => 'capitalize',
			__( 'Uppercase', 'facewp-abbey' )  => 'uppercase',
			__( 'Lowercase', 'facewp-abbey' )  => 'lowercase',
		),
		'std'         => 'normal',
		'group'       => $section_group,
		'admin_label' => false,
	) );
	vc_add_param( 'vc_custom_heading', array(
		'type'        => 'textfield',
		'heading'     => __( 'Letter Spacing', 'facewp-abbey' ),
		'param_name'  => 'letter_spacing',
		'value'       => '',
		'group'       => $section_group,
		'admin_label' => false,
		"description" => __( "For example: 0.5px", 'facewp-abbey' ),
	) );
	vc_add_param( 'vc_custom_heading', array(
		'type'        => 'dropdown',
		'heading'     => __( 'Heading Style', 'facewp-abbey' ),
		'param_name'  => 'heading_style',
		'value'       => array(
			__( 'Default', 'facewp-abbey' )              => 'default',
			__( 'Style 1 (Left Line)', 'facewp-abbey' )  => 'style1',
			__( 'Style 2 (Right Line)', 'facewp-abbey' ) => 'style2',
			__( 'Style 3 (Both Line)', 'facewp-abbey' )  => 'style3',
		),
		'std'         => 'default',
		'group'       => $section_group,
		'admin_label' => false,
	) );

	// WooCommerce
	$order_by_values = array(
		'',
		__( 'Date', 'js_composer' )          => 'date',
		__( 'ID', 'js_composer' )            => 'ID',
		__( 'Author', 'js_composer' )        => 'author',
		__( 'Title', 'js_composer' )         => 'title',
		__( 'Modified', 'js_composer' )      => 'modified',
		__( 'Random', 'js_composer' )        => 'rand',
		__( 'Comment count', 'js_composer' ) => 'comment_count',
		__( 'Menu order', 'js_composer' )    => 'menu_order',
	);

	$order_way_values = array(
		'',
		__( 'Descending', 'js_composer' ) => 'DESC',
		__( 'Ascending', 'js_composer' )  => 'ASC',
	);

	$args       = array(
		'type'         => 'post',
		'child_of'     => 0,
		'parent'       => '',
		'orderby'      => 'id',
		'order'        => 'ASC',
		'hide_empty'   => false,
		'hierarchical' => 1,
		'exclude'      => '',
		'include'      => '',
		'number'       => '',
		'taxonomy'     => 'product_cat',
		'pad_counts'   => false,

	);
	$categories = get_categories( $args );

	$product_categories_dropdown = array();

	if ( class_exists( 'Vc_Vendor_Woocommerce' ) ) {
		$vc_vendor_wc = new Vc_Vendor_Woocommerce();
		$vc_vendor_wc->getCategoryChilds( 0, 0, $categories, 0, $product_categories_dropdown );
	}

	// WooCommerce Shortcode - Recent Products
	class WPBakeryShortCode_FaceWP_Abbey_Recent_Products extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'        => __( 'Abbey Recent products', 'facewp-abbey' ),
		'base'        => 'facewp_abbey_recent_products',
		'icon'        => 'icon-wpb-woocommerce',
		'category'    => __( 'Abbey', 'facewp-abbey' ),
		'description' => __( 'Lists recent products', 'js_composer' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Per page', 'js_composer' ),
				'value'       => 12,
				'save_always' => true,
				'param_name'  => 'per_page',
				'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Columns', 'js_composer' ),
				'value'       => 4,
				'param_name'  => 'columns',
				'save_always' => true,
				'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'js_composer' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'js_composer' ),
				'param_name'  => 'orderby',
				'value'       => $order_by_values,
				'save_always' => true,
				'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Sort order', 'js_composer' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'save_always' => true,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'View type', 'facewp-abbey' ),
				'param_name'  => 'view_type',
				'value'       => array(
					__( 'Grid', 'facewp-abbey' )     => 'grid',
					__( 'Carousel', 'facewp-abbey' ) => 'carousel',
				),
				'std'         => 'carousel',
				'admin_label' => true
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show navigation', 'facewp-abbey' ),
				'param_name' => 'show_navigation',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'yes',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show pagination', 'facewp-abbey' ),
				'param_name' => 'show_pagination',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'no',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination position', 'facewp-abbey' ),
				'param_name' => 'pagination_position',
				'value'      => array(
					__( 'Horizontal', 'facewp-abbey' ) => 'horizontal',
					__( 'Vertical', 'facewp-abbey' )   => 'vertical',
				),
				'std'        => 'horizontal',
				'dependency' => array(
					'element' => 'show_pagination',
					'value'   => array( 'yes' )
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// WooCommerce Shortcode Featured Products
	class WPBakeryShortCode_FaceWP_Abbey_Featured_Products extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'        => __( 'Abbey Featured products', 'js_composer' ),
		'base'        => 'facewp_abbey_featured_products',
		'icon'        => 'icon-wpb-woocommerce',
		'category'    => __( 'Abbey', 'facewp-abbey' ),
		'description' => __( 'Display products set as "featured"', 'js_composer' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Per page', 'js_composer' ),
				'value'       => 12,
				'param_name'  => 'per_page',
				'save_always' => true,
				'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Columns', 'js_composer' ),
				'value'       => 4,
				'param_name'  => 'columns',
				'save_always' => true,
				'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'js_composer' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'js_composer' ),
				'param_name'  => 'orderby',
				'value'       => $order_by_values,
				'save_always' => true,
				'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Sort order', 'js_composer' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'save_always' => true,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'View type', 'facewp-abbey' ),
				'param_name'  => 'view_type',
				'value'       => array(
					__( 'Grid', 'facewp-abbey' )     => 'grid',
					__( 'Carousel', 'facewp-abbey' ) => 'carousel',
				),
				'std'         => 'carousel',
				'admin_label' => true
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show navigation', 'facewp-abbey' ),
				'param_name' => 'show_navigation',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'yes',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show pagination', 'facewp-abbey' ),
				'param_name' => 'show_pagination',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'no',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination position', 'facewp-abbey' ),
				'param_name' => 'pagination_position',
				'value'      => array(
					__( 'Horizontal', 'facewp-abbey' ) => 'horizontal',
					__( 'Vertical', 'facewp-abbey' )   => 'vertical',
				),
				'std'        => 'horizontal',
				'dependency' => array(
					'element' => 'show_pagination',
					'value'   => array( 'yes' )
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// WooCommerce Shortcode Product Category
	class WPBakeryShortCode_FaceWP_Abbey_Product_Category extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'        => __( 'Abbey Product category', 'js_composer' ),
		'base'        => 'facewp_abbey_product_category',
		'icon'        => 'icon-wpb-woocommerce',
		'category'    => __( 'Abbey', 'facewp-abbey' ),
		'description' => __( 'Show multiple products in a category', 'js_composer' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Per page', 'js_composer' ),
				'value'       => 12,
				'save_always' => true,
				'param_name'  => 'per_page',
				'description' => __( 'How much items per page to show', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Columns', 'js_composer' ),
				'value'       => 4,
				'save_always' => true,
				'param_name'  => 'columns',
				'description' => __( 'How much columns grid', 'js_composer' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'js_composer' ),
				'param_name'  => 'orderby',
				'value'       => $order_by_values,
				'save_always' => true,
				'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Sort order', 'js_composer' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'save_always' => true,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Category', 'js_composer' ),
				'value'       => $product_categories_dropdown,
				'param_name'  => 'category',
				'save_always' => true,
				'description' => __( 'Product category list', 'js_composer' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'View type', 'facewp-abbey' ),
				'param_name'  => 'view_type',
				'value'       => array(
					__( 'Grid', 'facewp-abbey' )     => 'grid',
					__( 'Carousel', 'facewp-abbey' ) => 'carousel',
				),
				'std'         => 'carousel',
				'admin_label' => true
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show navigation', 'facewp-abbey' ),
				'param_name' => 'show_navigation',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'yes',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show pagination', 'facewp-abbey' ),
				'param_name' => 'show_pagination',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'no',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination position', 'facewp-abbey' ),
				'param_name' => 'pagination_position',
				'value'      => array(
					__( 'Horizontal', 'facewp-abbey' ) => 'horizontal',
					__( 'Vertical', 'facewp-abbey' )   => 'vertical',
				),
				'std'        => 'horizontal',
				'dependency' => array(
					'element' => 'show_pagination',
					'value'   => array( 'yes' )
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// WooCommerce Shortcode Sale Products
	class WPBakeryShortCode_FaceWP_Abbey_Sale_Products extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'        => __( 'Abbey Sale products', 'js_composer' ),
		'base'        => 'facewp_abbey_sale_products',
		'icon'        => 'icon-wpb-woocommerce',
		'category'    => __( 'Abbey', 'facewp-abbey' ),
		'description' => __( 'List all products on sale', 'js_composer' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Per page', 'js_composer' ),
				'value'       => 12,
				'save_always' => true,
				'param_name'  => 'per_page',
				'description' => __( 'How much items per page to show', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Columns', 'js_composer' ),
				'value'       => 4,
				'save_always' => true,
				'param_name'  => 'columns',
				'description' => __( 'How much columns grid', 'js_composer' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'js_composer' ),
				'param_name'  => 'orderby',
				'value'       => $order_by_values,
				'save_always' => true,
				'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Sort order', 'js_composer' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'save_always' => true,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'View type', 'facewp-abbey' ),
				'param_name'  => 'view_type',
				'value'       => array(
					__( 'Grid', 'facewp-abbey' )     => 'grid',
					__( 'Carousel', 'facewp-abbey' ) => 'carousel',
				),
				'std'         => 'carousel',
				'admin_label' => true
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show navigation', 'facewp-abbey' ),
				'param_name' => 'show_navigation',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'yes',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show pagination', 'facewp-abbey' ),
				'param_name' => 'show_pagination',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'no',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination position', 'facewp-abbey' ),
				'param_name' => 'pagination_position',
				'value'      => array(
					__( 'Horizontal', 'facewp-abbey' ) => 'horizontal',
					__( 'Vertical', 'facewp-abbey' )   => 'vertical',
				),
				'std'        => 'horizontal',
				'dependency' => array(
					'element' => 'show_pagination',
					'value'   => array( 'yes' )
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// WooCommerce Shortcode Best Selling Products
	class WPBakeryShortCode_FaceWP_Abbey_Best_Selling_Products extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'        => __( 'Abbey Best Selling Products', 'js_composer' ),
		'base'        => 'facewp_abbey_best_selling_products',
		'icon'        => 'icon-wpb-woocommerce',
		'category'    => __( 'Abbey', 'facewp-abbey' ),
		'description' => __( 'List best selling products on sale', 'js_composer' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Per page', 'js_composer' ),
				'value'       => 12,
				'param_name'  => 'per_page',
				'save_always' => true,
				'description' => __( 'How much items per page to show', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Columns', 'js_composer' ),
				'value'       => 4,
				'param_name'  => 'columns',
				'save_always' => true,
				'description' => __( 'How much columns grid', 'js_composer' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'View type', 'facewp-abbey' ),
				'param_name'  => 'view_type',
				'value'       => array(
					__( 'Grid', 'facewp-abbey' )     => 'grid',
					__( 'Carousel', 'facewp-abbey' ) => 'carousel',
				),
				'std'         => 'carousel',
				'admin_label' => true
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show navigation', 'facewp-abbey' ),
				'param_name' => 'show_navigation',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'yes',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show pagination', 'facewp-abbey' ),
				'param_name' => 'show_pagination',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'no',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination position', 'facewp-abbey' ),
				'param_name' => 'pagination_position',
				'value'      => array(
					__( 'Horizontal', 'facewp-abbey' ) => 'horizontal',
					__( 'Vertical', 'facewp-abbey' )   => 'vertical',
				),
				'std'        => 'horizontal',
				'dependency' => array(
					'element' => 'show_pagination',
					'value'   => array( 'yes' )
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// WooCommerce ShortCode Products

	if ( class_exists( 'Vc_Vendor_Woocommerce' ) ) {
		add_filter( 'vc_autocomplete_facewp_abbey_products_ids_callback', array(
			&$vc_vendor_wc,
			'productIdAutocompleteSuggester'
		), 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_facewp_abbey_products_ids_render', array(
			&$vc_vendor_wc,
			'productIdAutocompleteRender'
		), 10, 1 ); // Render exact product. Must return an array (label,value)
		//For param: ID default value filter
		add_filter( 'vc_form_fields_render_field_facewp_abbey_products_ids_param_value', array(
			&$vc_vendor_wc,
			'productsIdsDefaultValue'
		), 10, 4 ); // Defines default value for param if not provided. Takes from other param value.
	}

	class WPBakeryShortCode_FaceWP_Abbey_Products extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'        => __( 'Abbey Products', 'js_composer' ),
		'base'        => 'facewp_abbey_products',
		'icon'        => 'icon-wpb-woocommerce',
		'category'    => __( 'Abbey', 'facewp-abbey' ),
		'description' => __( 'Show multiple products by ID or SKU.', 'js_composer' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Columns', 'js_composer' ),
				'value'       => 4,
				'param_name'  => 'columns',
				'save_always' => true,
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'js_composer' ),
				'param_name'  => 'orderby',
				'value'       => $order_by_values,
				'std'         => 'title',
				'save_always' => true,
				'description' => sprintf( __( 'Select how to sort retrieved products. More at %s. Default by Title', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Sort order', 'js_composer' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'save_always' => true,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s. Default by ASC', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Products', 'js_composer' ),
				'param_name'  => 'ids',
				'settings'    => array(
					'multiple'      => true,
					'sortable'      => true,
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend
				),
				'save_always' => true,
				'description' => __( 'Enter List of Products', 'js_composer' ),
			),
			array(
				'type'       => 'hidden',
				'param_name' => 'skus',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'View type', 'facewp-abbey' ),
				'param_name'  => 'view_type',
				'value'       => array(
					__( 'Grid', 'facewp-abbey' )     => 'grid',
					__( 'Carousel', 'facewp-abbey' ) => 'carousel',
				),
				'std'         => 'carousel',
				'admin_label' => true
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show navigation', 'facewp-abbey' ),
				'param_name' => 'show_navigation',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'yes',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show pagination', 'facewp-abbey' ),
				'param_name' => 'show_pagination',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'no',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination position', 'facewp-abbey' ),
				'param_name' => 'pagination_position',
				'value'      => array(
					__( 'Horizontal', 'facewp-abbey' ) => 'horizontal',
					__( 'Vertical', 'facewp-abbey' )   => 'vertical',
				),
				'std'        => 'horizontal',
				'dependency' => array(
					'element' => 'show_pagination',
					'value'   => array( 'yes' )
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// WooCommerce Shortcode Hot Deals
	class WPBakeryShortCode_FaceWP_Abbey_Hot_Deals extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'        => __( 'Abbey Hot Deals', 'facewp-abbey' ),
		'base'        => 'facewp_abbey_hot_deals',
		'icon'        => 'icon-wpb-woocommerce',
		'category'    => __( 'Abbey', 'facewp-abbey' ),
		'description' => __( 'List all products on sale with time', 'js_composer' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Product Tag', 'js_composer' ),
				'value'       => 'deals',
				'param_name'  => 'tag',
				'description' => __( 'Enter tag in which products have "Sale end date". Leave empty to show all sale products.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Per page', 'js_composer' ),
				'value'       => 12,
				'save_always' => true,
				'param_name'  => 'per_page',
				'description' => __( 'How much items per page to show', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Columns', 'js_composer' ),
				'value'       => 4,
				'save_always' => true,
				'param_name'  => 'columns',
				'description' => __( 'How much columns grid', 'js_composer' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'js_composer' ),
				'param_name'  => 'orderby',
				'value'       => $order_by_values,
				'save_always' => true,
				'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Sort order', 'js_composer' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'save_always' => true,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'View type', 'facewp-abbey' ),
				'param_name'  => 'view_type',
				'value'       => array(
					__( 'Grid', 'facewp-abbey' )     => 'grid',
					__( 'Carousel', 'facewp-abbey' ) => 'carousel',
				),
				'std'         => 'carousel',
				'admin_label' => true
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show navigation', 'facewp-abbey' ),
				'param_name' => 'show_navigation',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'yes',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show pagination', 'facewp-abbey' ),
				'param_name' => 'show_pagination',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'no',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination position', 'facewp-abbey' ),
				'param_name' => 'pagination_position',
				'value'      => array(
					__( 'Horizontal', 'facewp-abbey' ) => 'horizontal',
					__( 'Vertical', 'facewp-abbey' )   => 'vertical',
				),
				'std'        => 'horizontal',
				'dependency' => array(
					'element' => 'show_pagination',
					'value'   => array( 'yes' )
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// WooCommerce Shortcode Widget Products
	class WPBakeryShortCode_FaceWP_Abbey_Widget_Products extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'     => __( 'Abbey Widget Products', 'facewp-abbey' ),
		'base'     => 'facewp_abbey_widget_products',
		'icon'     => 'icon-wpb-woocommerce',
		'category' => __( 'Abbey', 'facewp-abbey' ),
		'params'   => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of products to show', 'woocommerce' ),
				'param_name' => 'number',
				'value'      => 5
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Show', 'woocommerce' ),
				'param_name'  => 'show',
				'value'       => array(
					__( 'All Products', 'woocommerce' )      => '',
					__( 'Featured Products', 'woocommerce' ) => 'featured',
					__( 'On-sale Products', 'woocommerce' )  => 'onsale',
				),
				'admin_label' => true
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'woocommerce' ),
				'param_name'  => 'orderby',
				'value'       => array(
					__( 'Date', 'woocommerce' )   => 'date',
					__( 'Price', 'woocommerce' )  => 'price',
					__( 'Random', 'woocommerce' ) => 'rand',
					__( 'Sales', 'woocommerce' )  => 'sales',
				),
				'admin_label' => true
			),
			array(
				'type'       => 'dropdown',
				'heading'    => _x( 'Order', 'Sorting order', 'woocommerce' ),
				'param_name' => 'order',
				'value'      => array(
					__( 'DESC', 'woocommerce' ) => 'desc',
					__( 'ASC', 'woocommerce' )  => 'asc',
				)
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Hide free products', 'woocommerce' ),
				'param_name' => 'hide_free',
				'value'      => array( __( 'Yes', 'js_composer' ) => 'yes' )
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show hidden products', 'woocommerce' ),
				'param_name' => 'show_hidden',
				'value'      => array( __( 'Yes', 'js_composer' ) => 'yes' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// WooCommerce Shortcode Widget Top Rated Products
	class WPBakeryShortCode_FaceWP_Abbey_Widget_Top_Rated_Products extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'     => __( 'Abbey Widget Top Rated Products', 'facewp-abbey' ),
		'base'     => 'facewp_abbey_widget_top_rated_products',
		'icon'     => 'icon-wpb-woocommerce',
		'category' => __( 'Abbey', 'facewp-abbey' ),
		'params'   => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of products to show', 'woocommerce' ),
				'param_name' => 'number',
				'value'      => 5
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// WooCommerce Shortcode Product Categories
	class WPBakeryShortCode_FaceWP_Abbey_Product_Categories extends WPBakeryShortCode {
	}

	//Filters For autocomplete param:
	//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
	if ( class_exists( 'Vc_Vendor_Woocommerce' ) ) {
		add_filter( 'vc_autocomplete_facewp_abbey_product_categories_ids_callback', array(
			&$vc_vendor_wc,
			'productCategoryCategoryAutocompleteSuggester'
		), 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_facewp_abbey_product_categories_ids_render', array(
			&$vc_vendor_wc,
			'productCategoryCategoryRenderByIdExact'
		), 10, 1 ); // Render exact category by id. Must return an array (label,value)
	}

	vc_map( array(
		'name'     => __( 'Abbey Product Categories', 'facewp-abbey' ),
		'base'     => 'facewp_abbey_product_categories',
		'icon'     => 'icon-wpb-woocommerce',
		'category' => __( 'Abbey', 'facewp-abbey' ),
		'params'   => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Number', 'js_composer' ),
				'param_name'  => 'number',
				'description' => __( 'The `number` field is used to display the number of products.', 'js_composer' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'js_composer' ),
				'param_name'  => 'orderby',
				'value'       => $order_by_values,
				'save_always' => true,
				'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Sort order', 'js_composer' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'save_always' => true,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Columns', 'js_composer' ),
				'value'       => 4,
				'param_name'  => 'columns',
				'save_always' => true,
				'description' => __( 'How much columns grid', 'js_composer' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Hide empty', 'js_composer' ),
				'param_name'  => 'hide_empty',
				'description' => __( 'Hide empty', 'js_composer' ),
				'value'       => array( __( 'Yes', 'js_composer' ) => 'yes' ),
				'std'         => 'yes',
			),
			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Categories', 'js_composer' ),
				'param_name'  => 'ids',
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
				),
				'save_always' => true,
				'description' => __( 'List of product categories', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Image size', 'facewp-abbey' ),
				'param_name'  => 'image_size',
				'value'       => 'full',
				'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size. If used slides per view, this will be used to define carousel wrapper size.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Style', 'facewp-abbey' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1', 'facewp-abbey' ) => 'style1',
					__( 'Style 2', 'facewp-abbey' ) => 'style2',
					__( 'Style 3', 'facewp-abbey' ) => 'style3',
				),
				'std'         => 'style1',
				'admin_label' => true,
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'View type', 'facewp-abbey' ),
				'param_name'  => 'view_type',
				'value'       => array(
					__( 'Grid', 'facewp-abbey' )     => 'grid',
					__( 'Carousel', 'facewp-abbey' ) => 'carousel',
				),
				'std'         => 'carousel',
				'admin_label' => true,
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'style1' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show navigation', 'facewp-abbey' ),
				'param_name' => 'show_navigation',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'yes',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show pagination', 'facewp-abbey' ),
				'param_name' => 'show_pagination',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'no',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Pagination position', 'facewp-abbey' ),
				'param_name' => 'pagination_position',
				'value'      => array(
					__( 'Horizontal', 'facewp-abbey' ) => 'horizontal',
					__( 'Vertical', 'facewp-abbey' )   => 'vertical',
				),
				'std'        => 'horizontal',
				'dependency' => array(
					'element' => 'show_pagination',
					'value'   => array( 'yes' )
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// WooCommerce Shortcode Product Tabs
	class WPBakeryShortCode_FaceWP_Abbey_Product_Tabs extends WPBakeryShortCode {
		protected static $index = 1;

		public static function getIndex() {
			return self::$index ++ . '-' . time();
		}
	}

	//Filters For autocomplete param:
	//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
	if ( class_exists( 'Vc_Vendor_Woocommerce' ) ) {
		add_filter( 'vc_autocomplete_facewp_abbey_product_tabs_categories_callback', array(
			&$vc_vendor_wc,
			'productCategoryCategoryAutocompleteSuggesterBySlug'
		), 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_facewp_abbey_product_tabs_categories_render', array(
			&$vc_vendor_wc,
			'productCategoryCategoryRenderBySlugExact'
		), 10, 1 ); // Render exact category by Slug. Must return an array (label,value)
	}

	vc_map( array(
		'name'        => __( 'Abbey Product Tabs', 'facewp-abbey' ),
		'base'        => 'facewp_abbey_product_tabs',
		'icon'        => 'icon-wpb-woocommerce',
		'category'    => __( 'Abbey', 'facewp-abbey' ),
		'description' => __( 'Display Recent Products, Featured Products, Sale Products by tabs', 'facewp-abbey' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Recent Products Tab Label', 'js_composer' ),
				'value'       => __( 'New Arrivals', 'facewp-abbey' ),
				'param_name'  => 'recent_products_tab_label',
				'description' => __( 'Overwrite the label of tab Recent Products', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Featured Products Tab Label', 'js_composer' ),
				'value'       => __( 'Featured', 'facewp-abbey' ),
				'param_name'  => 'featured_products_tab_label',
				'description' => __( 'Overwrite the label of tab Featured Products', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Sale Products Tab Label', 'js_composer' ),
				'value'       => __( 'On Sale', 'facewp-abbey' ),
				'param_name'  => 'sale_products_tab_label',
				'description' => __( 'Overwrite the label of tab Sale Products', 'js_composer' ),
			),
			array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Categories', 'js_composer' ),
				'param_name'  => 'categories',
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
				),
				'save_always' => true,
				'description' => __( 'Show products in these selected categories only. Leave empty If you want to show all products.', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Per page', 'js_composer' ),
				'value'       => 12,
				'save_always' => true,
				'param_name'  => 'per_page',
				'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Columns', 'js_composer' ),
				'value'       => 4,
				'param_name'  => 'columns',
				'save_always' => true,
				'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'js_composer' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'js_composer' ),
				'param_name'  => 'orderby',
				'value'       => $order_by_values,
				'save_always' => true,
				'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Sort order', 'js_composer' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'save_always' => true,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'View type', 'facewp-abbey' ),
				'param_name'  => 'view_type',
				'value'       => array(
					__( 'Grid', 'facewp-abbey' )     => 'grid',
					__( 'Carousel', 'facewp-abbey' ) => 'carousel',
				),
				'std'         => 'carousel',
				'admin_label' => true
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show pagination', 'facewp-abbey' ),
				'param_name' => 'show_pagination',
				'value'      => array(
					__( 'Yes', 'js_composer' ) => 'yes'
				),
				'std'        => 'yes',
				'dependency' => array(
					'element' => 'view_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'js_composer' )
			),
			$animation_type,
			$animation_duration,
			$animation_delay,
		)
	) );

	// Icon
	class WPBakeryShortCode_FaceWP_Abbey_Icon extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'        => esc_html__( 'Abbey Icon', 'facewp-abbey' ),
		'base'        => 'facewp_abbey_icon',
		'category'    => __( 'Abbey', 'facewp-abbey' ),
		'icon'        => 'icon-wpb-vc_icon',
		'description' => esc_html__( 'Eye catching icons from libraries', 'facewp-abbey' ),
		'params'      => array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon library', 'facewp-abbey' ),
				'value'       => array(
					esc_html__( 'Font Awesome', 'facewp-abbey' ) => 'fontawesome',
					esc_html__( 'Open Iconic', 'facewp-abbey' )  => 'openiconic',
					esc_html__( 'Typicons', 'facewp-abbey' )     => 'typicons',
					esc_html__( 'Entypo', 'facewp-abbey' )       => 'entypo',
					esc_html__( 'Linecons', 'facewp-abbey' )     => 'linecons',
					esc_html__( 'P7 Stroke', 'facewp-abbey' )    => 'pe7stroke',
				),
				'admin_label' => true,
				'param_name'  => 'type',
				'description' => esc_html__( 'Select icon library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name'  => 'icon_fontawesome',
				'value'       => 'fa fa-adjust', // default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false,
					// default true, display an "EMPTY" icon?
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
				),
				'dependency'  => array(
					'element' => 'type',
					'value'   => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name'  => 'icon_openiconic',
				'value'       => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'openiconic',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => 'type',
					'value'   => 'openiconic',
				),
				'description' => esc_html__( 'Select icon from library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name'  => 'icon_typicons',
				'value'       => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'typicons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => 'type',
					'value'   => 'typicons',
				),
				'description' => esc_html__( 'Select icon from library.', 'facewp-abbey' ),
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name' => 'icon_entypo',
				'value'      => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
				'settings'   => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'entypo',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value'   => 'entypo',
				),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name'  => 'icon_linecons',
				'value'       => 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'linecons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => 'type',
					'value'   => 'linecons',
				),
				'description' => esc_html__( 'Select icon from library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name'  => 'icon_pe7stroke',
				'value'       => 'pe-7s-album',
				'settings'    => array(
					'emptyIcon'    => false,
					'type'         => 'pe7stroke',
					'iconsPerPage' => 400,
				),
				'dependency'  => array(
					'element' => 'type',
					'value'   => 'pe7stroke',
				),
				'description' => esc_html__( 'Select icon from library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => "Size",
				'admin_label' => true,
				'param_name'  => 'size',
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Custom color', 'facewp-abbey' ),
				'param_name'  => 'custom_color',
				'description' => esc_html__( 'Select custom icon color.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Background shape', 'facewp-abbey' ),
				'param_name'  => 'background_style',
				'value'       => array(
					esc_html__( 'None', 'js_composer' )            => '',
					esc_html__( 'Circle', 'js_composer' )          => 'rounded',
					esc_html__( 'Square', 'js_composer' )          => 'boxed',
					esc_html__( 'Rounded', 'js_composer' )         => 'rounded-less',
					esc_html__( 'Outline Circle', 'js_composer' )  => 'rounded-outline',
					esc_html__( 'Outline Square', 'js_composer' )  => 'boxed-outline',
					esc_html__( 'Outline Rounded', 'js_composer' ) => 'rounded-less-outline',
				),
				'description' => esc_html__( 'Select background shape and style for icon.', 'facewp-abbey' )
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Custom background color', 'facewp-abbey' ),
				'param_name'  => 'custom_background_color',
				'description' => esc_html__( 'Select custom icon background color.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon alignment', 'facewp-abbey' ),
				'param_name'  => 'align',
				'value'       => array(
					esc_html__( 'Left', 'js_composer' )   => 'left',
					esc_html__( 'Right', 'js_composer' )  => 'right',
					esc_html__( 'Center', 'js_composer' ) => 'center',
				),
				'description' => esc_html__( 'Select icon alignment.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'URL (Link)', 'facewp-abbey' ),
				'param_name'  => 'link',
				'description' => esc_html__( 'Add link to icon.', 'facewp-abbey' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'facewp-abbey' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'facewp-abbey' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS', 'facewp-abbey' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'facewp-abbey' ),
			),
		),
	) );

	// Shortcode Brand Carousel
	class WPBakeryShortCode_FaceWP_Abbey_Image_Carousel extends WPBakeryShortCode {
		protected static $carousel_index = 1;

		public static function getCarouselIndex() {
			return self::$carousel_index ++ . '-' . time();
		}
	}

	vc_map( array(
		'name'     => __( 'Abbey Image Carousel', 'facewp-abbey' ),
		'base'     => 'facewp_abbey_image_carousel',
		'category' => __( 'Abbey', 'facewp-abbey' ),
		'params'   => array(
			array(
				'type'        => 'attach_images',
				'heading'     => __( 'Images', 'facewp-abbey' ),
				'param_name'  => 'images',
				'value'       => '',
				'description' => __( 'Select images from media library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Image size', 'facewp-abbey' ),
				'param_name'  => 'image_size',
				'value'       => 'full',
				'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size. If used slides per view, this will be used to define carousel wrapper size.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'On click action', 'facewp-abbey' ),
				'param_name'  => 'onclick',
				'value'       => array(
					__( 'Open prettyPhoto', 'facewp-abbey' )  => 'link_image',
					__( 'None', 'facewp-abbey' )              => 'link_no',
					__( 'Open custom links', 'facewp-abbey' ) => 'custom_link',
				),
				'std'         => 'link_no',
				'description' => __( 'Select action for click event.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'exploded_textarea',
				'heading'     => __( 'Custom links', 'facewp-abbey' ),
				'param_name'  => 'custom_links',
				'description' => __( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'facewp-abbey' ),
				'dependency'  => array(
					'element' => 'onclick',
					'value'   => array( 'custom_link' ),
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Custom link target', 'facewp-abbey' ),
				'param_name'  => 'custom_links_target',
				'description' => __( 'Select how to open custom links.', 'facewp-abbey' ),
				'dependency'  => array(
					'element' => 'onclick',
					'value'   => array( 'custom_link' ),
				),
				'value'       => array(
					__( 'Same window', 'facewp-abbey' ) => '_self',
					__( 'New window', 'facewp-abbey' )  => '_blank',
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Items to show on desktop', 'facewp-abbey' ),
				'param_name' => 'items_on_desktop',
				'value'      => '5',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Items to show on tabs', 'facewp-abbey' ),
				'param_name' => 'items_on_tabs',
				'value'      => '3',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Items to show on mobile', 'facewp-abbey' ),
				'param_name' => 'items_on_mobile',
				'value'      => '2',
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Slider autoplay', 'facewp-abbey' ),
				'param_name'  => 'autoplay',
				'description' => __( 'Enable autoplay mode.', 'facewp-abbey' ),
				'value'       => array( __( 'Yes', 'facewp-abbey' ) => 'yes' ),
				'std'         => 'no',
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Slider speed', 'facewp-abbey' ),
				'param_name'  => 'speed',
				'value'       => '5000',
				'description' => __( 'Duration of animation between slides (in ms).', 'facewp-abbey' ),
				'dependency'  => array(
					'element' => 'autoplay',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Hide prev/next buttons', 'facewp-abbey' ),
				'param_name'  => 'hide_prev_next_buttons',
				'description' => __( 'If checked, prev/next buttons will be hidden.', 'facewp-abbey' ),
				'value'       => array( __( 'Yes', 'facewp-abbey' ) => 'yes' ),
				'std'         => 'no',
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Hide dots navigation', 'facewp-abbey' ),
				'param_name'  => 'hide_dots_navigation',
				'description' => __( 'If checked, dots navigation will be hidden.', 'facewp-abbey' ),
				'value'       => array( __( 'Yes', 'facewp-abbey' ) => 'yes' ),
				'std'         => 'yes',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Space between two items in px', 'facewp-abbey' ),
				'param_name' => 'item_space',
				'value'      => '50',
				'suffix'     => 'px',
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Extra class name', 'facewp-abbey' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'facewp-abbey' ),
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'facewp-abbey' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'facewp-abbey' ),
			),
		),
	) );

	// Shortcode Counter
	class WPBakeryShortCode_FaceWP_Abbey_Counter extends WPBakeryShortCode {
		protected static $index = 1;

		public static function getIndex() {
			return self::$index ++ . '-' . time();
		}
	}

	vc_map(
		array(
			"name"        => __( "Abbey Counter", 'facewp-abbey' ),
			"base"        => "facewp_abbey_counter",
			'category'    => __( 'Abbey', 'facewp-abbey' ),
			"description" => __( "Your milestones, achievements, etc.", 'facewp-abbey' ),
			"params"      => array(
				array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => __( "Counter Title ", 'facewp-abbey' ),
					"param_name"  => "counter_title",
					"admin_label" => true,
					"value"       => "",
					"description" => __( "Enter title for counter block", 'facewp-abbey' )
				),
				array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => __( "Counter Value", 'facewp-abbey' ),
					"param_name"  => "counter_value",
					"value"       => "2380",
					"description" => __( "Enter number for counter without any special character. You may enter a decimal number. Eg 23.8", 'facewp-abbey' )
				),
				array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => __( "Thousands Separator", 'facewp-abbey' ),
					"param_name"  => "counter_sep",
					"value"       => ",",
					"description" => __( "Enter character for thousanda separator. e.g. ',' will separate 238000 into 238,000", 'facewp-abbey' )
				),
				array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => __( "Replace Decimal Point With", 'facewp-abbey' ),
					"param_name"  => "counter_decimal",
					"value"       => ".",
					"description" => __( "Did you enter a decimal number (Eg - 23.8) The decimal point '.' will be replaced with value that you will enter above.", 'facewp-abbey' ),
				),
				array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => __( "Counter Value Prefix", 'facewp-abbey' ),
					"param_name"  => "counter_prefix",
					"value"       => "",
					"description" => __( "Enter prefix for counter value", 'facewp-abbey' )
				),
				array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => __( "Counter Value Suffix", 'facewp-abbey' ),
					"param_name"  => "counter_suffix",
					"value"       => "",
					"description" => __( "Enter suffix for counter value", 'facewp-abbey' )
				),
				array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => __( "Counter rolling time", 'facewp-abbey' ),
					"param_name"  => "speed",
					"value"       => 2,
					"min"         => 1,
					"max"         => 10,
					"suffix"      => "seconds",
					"description" => __( "How many seconds the counter should roll?", 'facewp-abbey' )
				),
				array(
					"type"        => "textfield",
					"class"       => "",
					"heading"     => __( "Extra Class", 'facewp-abbey' ),
					"param_name"  => "el_class",
					"value"       => "",
					"description" => __( "Add extra class name that will be applied to the icon process, and you can use this class for your customizations.", 'facewp-abbey' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS box', 'facewp-abbey' ),
					'param_name' => 'css',
					'group'      => __( 'Design Options', 'facewp-abbey' ),
				),
			),
		)
	);

	// Shortcode Testimonial
	class WPBakeryShortCode_FaceWP_Abbey_Testimonial extends WPBakeryShortCode {
		protected static $index = 1;

		public static function getIndex() {
			return self::$index ++ . '-' . time();
		}
	}

	vc_map(
		array(
			'name'        => __( 'Abbey Testimonial', 'facewp-abbey' ),
			'base'        => 'facewp_abbey_testimonial',
			'category'    => __( 'Abbey', 'facewp-abbey' ),
			'description' => __( 'Customer\'s Testimonial', 'facewp-abbey' ),
			'params'      => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Maximum number of items', 'facewp-abbey' ),
					'param_name'  => 'limit',
					'value'       => '4',
					'description' => esc_html__( 'The maximum number of items to display', 'facewp-abbey' ),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Order by', 'facewp-abbey' ),
					'param_name'  => 'orderby',
					'value'       => array(
						__( 'Title', 'facewp-abbey' )      => 'title',
						__( 'Date', 'facewp-abbey' )       => 'date',
						__( 'Menu Order', 'facewp-abbey' ) => 'menu_order',
					),
					'description' => esc_html__( 'How to order the items - accepts all default WordPress ordering options', 'facewp-abbey' ),
					'std'         => 'date',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Order', 'facewp-abbey' ),
					'param_name'  => 'order',
					'value'       => array(
						__( 'DESC', 'facewp-abbey' ) => 'DESC',
						__( 'ASC', 'facewp-abbey' )  => 'ASC',
					),
					'description' => esc_html__( 'the order direction', 'facewp-abbey' ),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Display Author', 'facewp-abbey' ),
					'param_name'  => 'display_author',
					'value'       => array( __( 'Yes', 'facewp-abbey' ) => 'yes' ),
					'description' => esc_html__( 'Whether or not to display the author information', 'facewp-abbey' ),
					'std'         => 'yes',
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Display Avatar', 'facewp-abbey' ),
					'param_name'  => 'display_avatar',
					'value'       => array( __( 'Yes', 'facewp-abbey' ) => 'yes' ),
					'description' => esc_html__( 'Whether or not to display the author avatar', 'facewp-abbey' ),
					'std'         => 'yes',
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Display URL', 'facewp-abbey' ),
					'param_name'  => 'display_url',
					'value'       => array( __( 'Yes', 'facewp-abbey' ) => 'yes' ),
					'description' => esc_html__( 'Whether or not to display the URL information', 'facewp-abbey' ),
					'std'         => 'no',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Avatar size', 'facewp-abbey' ),
					'param_name'  => 'size',
					'value'       => '60',
					'description' => esc_html__( 'Dimension of the image in pixel, for example \'60\'', 'facewp-abbey' ),
					'dependency'  => array(
						'element' => 'display_avatar',
						'value'   => array( 'yes' ),
					),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Style', 'facewp-abbey' ),
					'param_name'  => 'style',
					'value'       => array(
						__( 'Style 1', 'facewp-abbey' ) => 'style1',
						__( 'Style 2', 'facewp-abbey' ) => 'style2',
					),
					'description' => esc_html__( 'Style of testimonial', 'facewp-abbey' ),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => __( 'Carousel autoplay', 'facewp-abbey' ),
					'param_name'  => 'autoplay',
					'description' => __( 'Enable carousel autoplay.', 'facewp-abbey' ),
					'value'       => array( __( 'Yes', 'facewp-abbey' ) => 'yes' ),
					'std'         => 'no',
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Display arrow navigation', 'facewp-abbey' ),
					'param_name' => 'display_nav',
					'value'      => array( __( 'Yes', 'facewp-abbey' ) => 'yes' ),
					'std'        => 'yes',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Arrow navigation style', 'facewp-abbey' ),
					'param_name'  => 'nav_style',
					'value'       => array(
						__( 'Style 1', 'facewp-abbey' ) => 'nav-style1',
						__( 'Style 2', 'facewp-abbey' ) => 'nav-style2',
					),
					'description' => esc_html__( 'Style of arrow navigation', 'facewp-abbey' ),
					'dependency'  => array(
						'element' => 'display_nav',
						'value'   => array( 'yes' ),
					),
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Display dots navigation', 'facewp-abbey' ),
					'param_name' => 'display_dots',
					'value'      => array( __( 'Yes', 'facewp-abbey' ) => 'yes' ),
					'std'        => 'yes',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Items to show', 'facewp-abbey' ),
					'param_name'  => 'items_per_slide',
					'value'       => '1',
					'description' => esc_html__( 'Number of shown items on each slide', 'facewp-abbey' ),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'facewp-abbey' ),
					'param_name' => 'el_class',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS box', 'facewp-abbey' ),
					'param_name' => 'css',
					'group'      => __( 'Design Options', 'facewp-abbey' ),
				),
			),
		)
	);

	class WPBakeryShortCode_FaceWP_Abbey_Google_Map extends WPBakeryShortCode {
		protected static $index = 1;

		public static function getIndex() {
			return self::$index ++ . '-' . time();
		}
	}

	vc_map( array(
		'name'        => esc_html__( 'Abbey Google Map', 'facewp-abbey' ),
		'base'        => 'facewp_abbey_google_map',
		'category'    => 'Abbey',
		'description' => esc_html__( 'Display Google Maps to indicate your location.', 'facewp-abbey' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Latitude', 'facewp-abbey' ),
				'param_name'  => 'latitude',
				'value'       => '',
				'description' => '<a href="http://mondeca.com/index.php/en/?option=com_content&view=article&id=206&Itemid=752" target="_blank">' . __( 'Here is a tool', 'facewp-abbey' ) . '</a> ' . __( 'where you can find Latitude & Longitude of your location', 'facewp-abbey' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Longitude', 'facewp-abbey' ),
				'param_name'  => 'longitude',
				'value'       => '',
				'description' => '<a href="http://mondeca.com/index.php/en/?option=com_content&view=article&id=206&Itemid=752" target=\"_blank\">' . __( 'Here is a tool', 'facewp-abbey' ) . '</a> ' . __( 'where you can find Latitude & Longitude of your location', 'facewp-abbey' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Width (in %)', 'facewp-abbey' ),
				'param_name' => 'width',
				'value'      => '100%',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Height (in px)', 'facewp-abbey' ),
				'param_name' => 'height',
				'value'      => '400px',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Map type', 'facewp-abbey' ),
				'admin_label' => true,
				'param_name'  => 'map_type',
				'value'       => array(
					__( 'Roadmap', 'facewp-abbey' )   => 'roadmap',
					__( 'Satellite', 'facewp-abbey' ) => 'satellite',
					__( 'Hybrid', 'facewp-abbey' )    => 'hybrid',
					__( 'Terrain', 'facewp-abbey' )   => 'terrain',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Map style', 'facewp-abbey' ),
				'admin_label' => true,
				'param_name'  => 'map_style',
				'description' => esc_html__( 'Choose a map style. This approach changes the style of the Roadmap types (base imagery in terrain and satellite views is not affected, but roads, labels, etc. respect styling rules', 'facewp-abbey' ),
				'value'       => array(
					__( 'Default', 'facewp-abbey' )                 => 'default',
					__( 'Shades of Grey', 'facewp-abbey' )          => 'shades_of_grey',
					__( 'Ultra Light with Labels', 'facewp-abbey' ) => 'ultra_light',
					__( 'Apple Maps-esque', 'facewp-abbey' )        => 'apple_map',
					__( 'Subtle Grayscale', 'facewp-abbey' )        => 'subtle_grayscale',
					__( 'Custom', 'facewp-abbey' )                  => 'custom',
				),
			),
			array(
				'type'        => 'textarea_raw_html',
				'heading'     => esc_html__( 'Map style custom', 'facewp-abbey' ),
				'param_name'  => 'map_style_custom',
				'description' => '<a href="http://www.mapstylr.com/map-style-editor/" target="_blank">' . __( 'Here is a tool', 'facewp-abbey' ) . '</a> ' . __( 'where you can customize style of Google Map.', 'facewp-abbey' ),
				'dependency'  => array(
					'element' => 'map_style',
					'value'   => 'custom',
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Map Zoom', 'facewp-abbey' ),
				'param_name' => 'zoom',
				'value'      => array(
					1,
					2,
					3,
					4,
					5,
					6,
					7,
					8,
					9,
					10,
					11,
					12,
					13,
					14,
					15,
					16,
					17,
					18,
					19,
					20
				),
				'std'        => 16
			),
			array(
				'type'       => 'checkbox',
				'heading'    => '',
				'param_name' => 'scrollwheel',
				'value'      => array(
					__( 'Disable map zoom on mouse wheel scroll', 'facewp-abbey' ) => 'disable',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'facewp-abbey' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'facewp-abbey' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Marker Icon', 'facewp-abbey' ),
				'param_name'  => 'marker_icon',
				'value'       => array(
					__( 'Default', 'facewp-abbey' ) => 'default',
					__( 'Custom', 'facewp-abbey' )  => 'custom',
				),
				'std'         => 'default',
				'group'       => __( 'Marker', 'facewp-abbey' ),
			),
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Custom marker icon', 'facewp-abbey' ),
				'param_name' => 'custom_marker_icon',
				'group'      => __( 'Marker', 'facewp-abbey' ),
				'dependency' => array(
					'element' => 'maker_icon',
					'value'   => 'custom',
				)
			),
			array(
				'type'        => 'textarea_html',
				'heading'     => esc_html__( 'Info Window', 'facewp-abbey' ),
				'param_name'  => 'info',
				'value'       => '',
				'description' => esc_html__( 'Content for info window', 'facewp-abbey' ),
				'group'       => __( 'Marker', 'facewp-abbey' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Street view control', 'facewp-abbey' ),
				'param_name' => 'street_view_control',
				'value'      => array(
					__( 'Enable', 'facewp-abbey' )  => 'enable',
					__( 'Disable', 'facewp-abbey' ) => 'disable',
				),
				'std'        => 'disable',
				'group'      => __( 'Advanced', 'facewp-abbey' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Map type control', 'facewp-abbey' ),
				'param_name' => 'map_type_control',
				'value'      => array(
					__( 'Enable', 'facewp-abbey' )  => 'enable',
					__( 'Disable', 'facewp-abbey' ) => 'disable',
				),
				'std'        => 'disable',
				'group'      => __( 'Advanced', 'facewp-abbey' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Map pan control', 'facewp-abbey' ),
				'param_name' => 'map_pan_control',
				'value'      => array(
					__( 'Enable', 'facewp-abbey' )  => 'enable',
					__( 'Disable', 'facewp-abbey' ) => 'disable',
				),
				'std'        => 'disable',
				'group'      => __( 'Advanced', 'facewp-abbey' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Zoom control', 'facewp-abbey' ),
				'param_name' => 'zoom_control',
				'value'      => array(
					__( 'Enable', 'facewp-abbey' )  => 'enable',
					__( 'Disable', 'facewp-abbey' ) => 'disable',
				),
				'std'        => 'disable',
				'group'      => __( 'Advanced', 'facewp-abbey' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS', 'facewp-abbey' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'facewp-abbey' ),
			),
		),
	) );

	class WPBakeryShortCode_FaceWP_Abbey_Icon_box extends WPBakeryShortCode {
	}

	vc_map( array(
		'name'     => esc_html__( 'Abbey Icon Box', 'facewp-abbey' ),
		'base'     => 'facewp_abbey_icon_box',
		'category' => 'Abbey',
		'params'   => array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Box Style', 'facewp-abbey' ),
				'param_name' => 'box_style',
				'value'      => array(
					__( 'Style 1', 'facewp-abbey' ) => 'style1',
					__( 'Style 2', 'facewp-abbey' ) => 'style2',
					__( 'Style 3', 'facewp-abbey' ) => 'style3',
					__( 'Style 4', 'facewp-abbey' ) => 'style4',
					__( 'Style 5', 'facewp-abbey' ) => 'style5',
					__( 'Style 6', 'facewp-abbey' ) => 'style6',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon library', 'facewp-abbey' ),
				'value'       => array(
					esc_html__( 'Font Awesome', 'facewp-abbey' )      => 'fontawesome',
					esc_html__( 'Open Iconic', 'facewp-abbey' )       => 'openiconic',
					esc_html__( 'Typicons', 'facewp-abbey' )          => 'typicons',
					esc_html__( 'Entypo', 'facewp-abbey' )            => 'entypo',
					esc_html__( 'Linecons', 'facewp-abbey' )          => 'linecons',
					esc_html__( 'P7 Stroke', 'facewp-abbey' )         => 'pe7stroke',
					esc_html__( 'Custom Image Icon', 'facewp-abbey' ) => 'custom',
				),
				'admin_label' => true,
				'param_name'  => 'icon_type',
				'description' => esc_html__( 'Select icon library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name'  => 'icon_fontawesome',
				'value'       => 'fa fa-adjust', // default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false,
					// default true, display an "EMPTY" icon?
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
				),
				'dependency'  => array(
					'element' => 'icon_type',
					'value'   => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name'  => 'icon_openiconic',
				'value'       => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'openiconic',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => 'icon_type',
					'value'   => 'openiconic',
				),
				'description' => esc_html__( 'Select icon from library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name'  => 'icon_typicons',
				'value'       => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'typicons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => 'icon_type',
					'value'   => 'typicons',
				),
				'description' => esc_html__( 'Select icon from library.', 'facewp-abbey' ),
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name' => 'icon_entypo',
				'value'      => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
				'settings'   => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'entypo',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value'   => 'entypo',
				),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name'  => 'icon_linecons',
				'value'       => 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings'    => array(
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'type'         => 'linecons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency'  => array(
					'element' => 'icon_type',
					'value'   => 'linecons',
				),
				'description' => esc_html__( 'Select icon from library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'facewp-abbey' ),
				'param_name'  => 'icon_pe7stroke',
				'value'       => 'pe-7s-album',
				'settings'    => array(
					'emptyIcon'    => false,
					'type'         => 'pe7stroke',
					'iconsPerPage' => 400,
				),
				'dependency'  => array(
					'element' => 'icon_type',
					'value'   => 'pe7stroke',
				),
				'description' => esc_html__( 'Select icon from library.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'attach_image',
				'heading'     => __( 'Image Icon', 'js_composer' ),
				'param_name'  => 'icon_image',
				'value'       => '',
				'description' => __( 'Select image from media library.', 'js_composer' ),
				'dependency'  => array(
					'element' => 'icon_type',
					'value'   => 'custom',
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => 'Image Width',
				'param_name' => 'icon_image_width',
				'value'      => '48px',
				'dependency' => array(
					'element' => 'icon_type',
					'value'   => 'custom',
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => 'Size of Icon',
				'param_name' => 'icon_size',
				'value'      => '32px',
				'dependency' => array(
					'element' => 'icon_type',
					'value'   => array( 'fontawesome', 'openiconic', 'typicons', 'entypo', 'linecons', 'pe7stroke' ),
				),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Color', 'facewp-abbey' ),
				'param_name'  => 'custom_color',
				'description' => esc_html__( 'Select icon color.', 'facewp-abbey' ),
				'dependency'  => array(
					'element' => 'icon_type',
					'value'   => array( 'fontawesome', 'openiconic', 'typicons', 'entypo', 'linecons', 'pe7stroke' ),
				),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Background color', 'facewp-abbey' ),
				'param_name'  => 'icon_background_color',
				'description' => esc_html__( 'Select custom icon background color.', 'facewp-abbey' ),
				'dependency'  => array(
					'element' => 'box_style',
					'value'   => array( 'style3' )
				),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => __( 'Border Color', 'facewp-abbey' ),
				'param_name'  => 'icon_color_border',
				'value'       => '#333333',
				'description' => __( 'Select border color for icon.', 'facewp-abbey' ),
				'dependency'  => array(
					'element' => 'box_style',
					'value'   => array( 'style3' )
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'facewp-abbey' ),
				'param_name'  => 'title',
				'description' => esc_html__( 'Enter the title of this icon box.', 'facewp-abbey' )
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Title Color', 'facewp-abbey' ),
				'param_name'  => 'title_color',
				'description' => esc_html__( 'Select title color.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'textarea_html',
				'heading'     => __( 'Description', 'facewp-abbey' ),
				'param_name'  => 'content',
				'value'       => '',
				'description' => __( 'Enter the description for this icon box.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Content Color', 'facewp-abbey' ),
				'param_name'  => 'content_color',
				'description' => esc_html__( 'Select content color.', 'facewp-abbey' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Apply link to:', 'facewp-abbey' ),
				'param_name'  => 'read_more',
				'value'       => array(
					__( 'No Link', 'facewp-abbey' )           => 'none',
					__( 'Complete Box', 'facewp-abbey' )      => 'box',
					__( 'Box Title', 'facewp-abbey' )         => 'title',
					__( 'Display Read More', 'facewp-abbey' ) => 'more',
				),
				'description' => __( 'Select whether to use color for icon or not.', 'facewp-abbey' )
			),
			array(
				'type'        => 'vc_link',
				'heading'     => __( 'Add Link', 'facewp-abbey' ),
				'param_name'  => 'link',
				'value'       => '',
				'description' => __( 'Add a custom link or select existing page. You can remove existing link as well.', 'facewp-abbey' ),
				'dependency'  => array( 'element' => 'read_more', 'value' => array( 'box', 'title', 'more' ) ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Read More Text', 'facewp-abbey' ),
				'param_name'  => 'read_text',
				'value'       => 'Read More',
				'description' => __( 'Customize the read more text.', 'facewp-abbey' ),
				'dependency'  => Array( 'element' => 'read_more', 'value' => array( 'more' ) ),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => __( 'Box Background Color', 'facewp-abbey' ),
				'param_name'  => 'box_bg_color',
				'value'       => '',
				'description' => __( 'Select Box background color.', 'facewp-abbey' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'facewp-abbey' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'facewp-abbey' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS', 'facewp-abbey' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'facewp-abbey' ),
			),
		),
	) );


	class WPBakeryShortCode_FaceWP_Abbey_Post_Grid extends WPBakeryShortCode {
		protected function build_loop_query( array $atts ) {
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => $atts['max_items'],
				'orderby'        => $atts['orderby'],
				'order'          => $atts['order'],
			);

			if ( ! empty( $atts['taxonomies'] ) ) {
				$terms = get_terms( array( 'post_tag', 'category' ), array( 'slug' => explode( ',', $atts['taxonomies'] ) ) );

				foreach ( $terms as $t ) {

					$args['tax_query'][] = array(
						'field'    => 'slug',
						'taxonomy' => $t->taxonomy,
						'terms'    => $t->slug,
					);

				}

			}

			return new WP_Query( $args );
		}
	}

	add_filter( 'vc_autocomplete_facewp_abbey_post_grid_taxonomies_callback', 'facewp_abbey_vc_autocomplete_taxonomies_field_search', 10, 1 );
	add_filter( 'vc_autocomplete_facewp_abbey_post_grid_taxonomies_render', 'facewp_abbey_vc_autocomplete_taxonomies_field_render', 10, 1 );

	vc_map( array(
		'name'        => esc_html__( 'Abbey Post Grid', 'facewp-abbey' ),
		'base'        => 'facewp_abbey_post_grid',
		'category'    => 'Abbey',
		'description' => esc_html__( 'Display Google Maps to indicate your location.', 'facewp-abbey' ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Title', 'facewp-abbey' ),
				'param_name'  => 'title',
				'value'       => __( 'News Update', 'facewp-abbey' ),
				'description' => 'Only display with style 3', 'facewp-abbey',
				'admin_label' => true,
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Style', 'facewp-abbey' ),
				'admin_label' => true,
				'param_name'  => 'style',
				'value'       => array(
					__( 'Style 1', 'facewp-abbey' ) => 'style1',
					__( 'Style 2', 'facewp-abbey' ) => 'style2',
					__( 'Style 3', 'facewp-abbey' ) => 'style3',
					__( 'Style 4', 'facewp-abbey' ) => 'style4',
				),
			),
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Narrow data source', 'js_composer' ),
				'param_name' => 'taxonomies',
				'settings' => array(
					'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true,
					// auto focus input, default true
				),
				'description' => __( 'Enter categories, tags or custom taxonomies.', 'facewp-abbey' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Total items', 'js_composer' ),
				'param_name' => 'max_items',
				'value' => 10,
				'description' => __( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'js_composer' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Order by', 'js_composer' ),
				'param_name' => 'orderby',
				'value' => array(
					__( 'Date', 'js_composer' ) => 'date',
					__( 'Order by post ID', 'js_composer' ) => 'ID',
					__( 'Author', 'js_composer' ) => 'author',
					__( 'Title', 'js_composer' ) => 'title',
					__( 'Last modified date', 'js_composer' ) => 'modified',
					__( 'Post/page parent ID', 'js_composer' ) => 'parent',
					__( 'Number of comments', 'js_composer' ) => 'comment_count',
					__( 'Menu order/Page Order', 'js_composer' ) => 'menu_order',
					__( 'Meta value', 'js_composer' ) => 'meta_value',
					__( 'Meta value number', 'js_composer' ) => 'meta_value_num',
					__( 'Random order', 'js_composer' ) => 'rand',
				),
				'description' => __( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'js_composer' ),
				'group' => __( 'Data Settings', 'js_composer' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Sort order', 'js_composer' ),
				'param_name' => 'order',
				'group' => __( 'Data Settings', 'js_composer' ),
				'value' => array(
					__( 'Descending', 'js_composer' ) => 'DESC',
					__( 'Ascending', 'js_composer' ) => 'ASC',
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'description' => __( 'Select sorting order.', 'js_composer' ),
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Display Type', 'facewp-abbey' ),
				'param_name' => 'display_type',
				'group'      => __( 'Display', 'facewp-abbey' ),
				'value'      => array(
					__( 'Grid', 'facewp-abbey' )     => 'grid',
					__( 'Carousel', 'facewp-abbey' ) => 'carousel',
				),
				'std'        => 'carousel',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Items per row', 'facewp-abbey' ),
				'param_name' => 'items_per_row',
				'value'      => array(
					1,
					2,
					3,
					4,
				),
				'std'        => 1,
				'group'      => __( 'Display', 'facewp-abbey' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show arrow navigation', 'facewp-abbey' ),
				'param_name' => 'show_arrow',
				'group'      => __( 'Display', 'facewp-abbey' ),
				'value'      => array( __( 'Yes', 'js_composer' ) => 'yes' ),
				'std'        => 'no',
				'dependency' => array(
					'element' => 'display_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show dots pagination', 'facewp-abbey' ),
				'group'      => __( 'Display', 'facewp-abbey' ),
				'param_name' => 'show_dots',
				'value'      => array( __( 'Yes', 'js_composer' ) => 'yes' ),
				'std'        => 'yes',
				'dependency' => array(
					'element' => 'display_type',
					'value'   => array( 'carousel' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pagination Position', 'facewp-abbey' ),
				'group'      => __( 'Display', 'facewp-abbey' ),
				'param_name' => 'pagination_position',
				'value'      => array(
					__( 'Horizontal', 'facewp-abbey' ) => 'horizontal',
					__( 'Vertical', 'facewp-abbey' )   => 'vertical',
				),
				'std'        => 'carousel',
				'dependency' => array(
					'element' => 'show_dots',
					'value'   => array( 'yes' )
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show content', 'facewp-abbey' ),
				'param_name' => 'show_content',
				'group'      => __( 'Display', 'facewp-abbey' ),
				'value'      => array( __( 'Yes', 'js_composer' ) => 'yes' ),
				'std'        => 'no',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show read more', 'facewp-abbey' ),
				'group'      => __( 'Display', 'facewp-abbey' ),
				'param_name' => 'show_read_more',
				'value'      => array( __( 'Yes', 'js_composer' ) => 'yes' ),
				'std'        => 'yes',
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS', 'facewp-abbey' ),
				'param_name' => 'css',
				'group'      => __( 'Design Options', 'facewp-abbey' ),
			),
		)
	) );
}

// Autocomplete
function facewp_abbey_vc_autocomplete_taxonomies_field_search( $search_string ) {
	$data = array();
	$vc_filter_by = vc_post_param( 'vc_filter_by', '' );
	$vc_taxonomies_types = strlen( $vc_filter_by ) > 0 ? array( $vc_filter_by ) : array_keys( vc_taxonomies_types() );
	$vc_taxonomies = get_terms( $vc_taxonomies_types, array(
		'hide_empty' => false,
		'search' => $search_string,
	) );
	if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
		foreach ( $vc_taxonomies as $t ) {
			if ( is_object( $t ) ) {
				$data_item = vc_get_term_object( $t );
				$data_item['value'] = $t->slug;
				$data[] = $data_item;
			}
		}
	}

	return $data;
}

function facewp_abbey_vc_autocomplete_taxonomies_field_render( $term ) {
	$vc_taxonomies_types = vc_taxonomies_types();
	$terms = get_terms( array_keys( $vc_taxonomies_types ), array(
		'include' => array( $term['value'] ),
		'hide_empty' => false,
	) );
	$data = false;
	if ( is_array( $terms ) && 1 === count( $terms ) ) {
		$term = $terms[0];
		$data = vc_get_term_object( $term );
		$data['value'] = $term->slug;
	}

	return $data;
}

// Pe-icon-7-stroke
add_action( 'admin_enqueue_scripts', 'facewp_abbey_enqueue_admin_pe7stroke' );
function facewp_abbey_enqueue_admin_pe7stroke() {
	wp_enqueue_style( 'facewp-pe-icon-7-stroke', FaceWP_Abbey_THEME_URL . '/assets/lib/pe-icon-7-stroke/css/pe-icon-7-stroke.css' );
}

add_filter( 'vc_iconpicker-type-pe7stroke', 'vc_iconpicker_type_pe7stroke' );
function vc_iconpicker_type_pe7stroke( $icons ) {
	$pe7stroke_icons = array(
		array( "pe-7s-album" => esc_html__( "Album", 'facewp-abbey' ) ),
		array( "pe-7s-arc" => esc_html__( "arc", 'facewp-abbey' ) ),
		array( "pe-7s-back-2" => esc_html__( "back-2", 'facewp-abbey' ) ),
		array( "pe-7s-bandaid" => esc_html__( "bandaid", 'facewp-abbey' ) ),
		array( "pe-7s-car" => esc_html__( "car", 'facewp-abbey' ) ),
		array( "pe-7s-diamond" => esc_html__( "diamond", 'facewp-abbey' ) ),
		array( "pe-7s-door-lock" => esc_html__( "door-lock", 'facewp-abbey' ) ),
		array( "pe-7s-eyedropper" => esc_html__( "eyedropper", 'facewp-abbey' ) ),
		array( "pe-7s-female" => esc_html__( "female", 'facewp-abbey' ) ),
		array( "pe-7s-gym" => esc_html__( "gym", 'facewp-abbey' ) ),
		array( "pe-7s-hammer" => esc_html__( "hammer", 'facewp-abbey' ) ),
		array( "pe-7s-headphones" => esc_html__( "headphones", 'facewp-abbey' ) ),
		array( "pe-7s-helm" => esc_html__( "helm", 'facewp-abbey' ) ),
		array( "pe-7s-hourglass" => esc_html__( "hourglass", 'facewp-abbey' ) ),
		array( "pe-7s-leaf" => esc_html__( "leaf", 'facewp-abbey' ) ),
		array( "pe-7s-magic-wand" => esc_html__( "magic wand", 'facewp-abbey' ) ),
		array( "pe-7s-male" => esc_html__( "male", 'facewp-abbey' ) ),
		array( "pe-7s-map-2" => esc_html__( "map 2", 'facewp-abbey' ) ),
		array( "pe-7s-next-2" => esc_html__( "next 2", 'facewp-abbey' ) ),
		array( "pe-7s-paint-bucket" => esc_html__( "paint bucket", 'facewp-abbey' ) ),
		array( "pe-7s-pendrive" => esc_html__( "pendrive", 'facewp-abbey' ) ),
		array( "pe-7s-photo" => esc_html__( "photo", 'facewp-abbey' ) ),
		array( "pe-7s-piggy" => esc_html__( "piggy", 'facewp-abbey' ) ),
		array( "pe-7s-plugin" => esc_html__( "plugin", 'facewp-abbey' ) ),
		array( "pe-7s-refresh-2" => esc_html__( "refresh 2", 'facewp-abbey' ) ),
		array( "pe-7s-rocket" => esc_html__( "rocket", 'facewp-abbey' ) ),
		array( "pe-7s-settings" => esc_html__( "settings", 'facewp-abbey' ) ),
		array( "pe-7s-shield" => esc_html__( "shield", 'facewp-abbey' ) ),
		array( "pe-7s-smile" => esc_html__( "smile", 'facewp-abbey' ) ),
		array( "pe-7s-usb" => esc_html__( "usb", 'facewp-abbey' ) ),
		array( "pe-7s-vector" => esc_html__( "vector", 'facewp-abbey' ) ),
		array( "pe-7s-wine" => esc_html__( "wine", 'facewp-abbey' ) ),
		array( "pe-7s-cloud-upload" => esc_html__( "cloud upload", 'facewp-abbey' ) ),
		array( "pe-7s-cash" => esc_html__( "cash", 'facewp-abbey' ) ),
		array( "pe-7s-close" => esc_html__( "close", 'facewp-abbey' ) ),
		array( "pe-7s-bluetooth" => esc_html__( "bluetooth", 'facewp-abbey' ) ),
		array( "pe-7s-cloud-download" => esc_html__( "cloud download", 'facewp-abbey' ) ),
		array( "pe-7s-way" => esc_html__( "way", 'facewp-abbey' ) ),
		array( "pe-7s-close-circle" => esc_html__( "close circle", 'facewp-abbey' ) ),
		array( "pe-7s-id" => esc_html__( "id", 'facewp-abbey' ) ),
		array( "pe-7s-angle-up" => esc_html__( "angle up", 'facewp-abbey' ) ),
		array( "pe-7s-wristwatch" => esc_html__( "wristwatch", 'facewp-abbey' ) ),
		array( "pe-7s-angle-up-circle" => esc_html__( "angle-up-circle", 'facewp-abbey' ) ),
		array( "pe-7s-world" => esc_html__( "world", 'facewp-abbey' ) ),
		array( "pe-7s-angle-right" => esc_html__( "Angle Right", 'facewp-abbey' ) ),
		array( "pe-7s-volume" => esc_html__( "volume", 'facewp-abbey' ) ),
		array( "pe-7s-angle-right-circle" => esc_html__( "angle right circle right", 'facewp-abbey' ) ),
		array( "pe-7s-users" => esc_html__( "Users", 'facewp-abbey' ) ),
		array( "pe-7s-angle-left" => esc_html__( "angle left", 'facewp-abbey' ) ),
		array( "pe-7s-user-female" => esc_html__( "user female", 'facewp-abbey' ) ),
		array( "pe-7s-angle-left-circle" => esc_html__( "angle left circle", 'facewp-abbey' ) ),
		array( "pe-7s-up-arrow" => esc_html__( "Sound", 'facewp-abbey' ) ),
		array( "pe-7s-angle-down" => esc_html__( "up arrow", 'facewp-abbey' ) ),
		array( "pe-7s-switch" => esc_html__( "switch", 'facewp-abbey' ) ),
		array( "pe-7s-angle-down-circle" => esc_html__( "down circle", 'facewp-abbey' ) ),
		array( "pe-7s-scissors" => esc_html__( "scissors", 'facewp-abbey' ) ),
		array( "pe-7s-wallet" => esc_html__( "wallet", 'facewp-abbey' ) ),
		array( "pe-7s-safe" => esc_html__( "safe", 'facewp-abbey' ) ),
		array( "pe-7s-volume2" => esc_html__( "volume2", 'facewp-abbey' ) ),
		array( "pe-7s-volume1" => esc_html__( "volume1", 'facewp-abbey' ) ),
		array( "pe-7s-voicemail" => esc_html__( "voice mail", 'facewp-abbey' ) ),
		array( "pe-7s-video" => esc_html__( "video", 'facewp-abbey' ) ),
		array( "pe-7s-user" => esc_html__( "user", 'facewp-abbey' ) ),
		array( "pe-7s-upload" => esc_html__( "upload", 'facewp-abbey' ) ),
		array( "pe-7s-unlock" => esc_html__( "unlock", 'facewp-abbey' ) ),
		array( "pe-7s-umbrella" => esc_html__( "umbrella", 'facewp-abbey' ) ),
		array( "pe-7s-trash" => esc_html__( "trash", 'facewp-abbey' ) ),
		array( "pe-7s-tools" => esc_html__( "tools", 'facewp-abbey' ) ),
		array( "pe-7s-timer" => esc_html__( "timer", 'facewp-abbey' ) ),
		array( "pe-7s-ticket" => esc_html__( "ticket", 'facewp-abbey' ) ),
		array( "pe-7s-target" => esc_html__( "target", 'facewp-abbey' ) ),
		array( "pe-7s-sun" => esc_html__( "sun", 'facewp-abbey' ) ),
		array( "pe-7s-study" => esc_html__( "study", 'facewp-abbey' ) ),
		array( "pe-7s-stopwatch" => esc_html__( "stopwatch", 'facewp-abbey' ) ),
		array( "pe-7s-star" => esc_html__( "star", 'facewp-abbey' ) ),
		array( "pe-7s-speaker" => esc_html__( "speaker", 'facewp-abbey' ) ),
		array( "pe-7s-signal" => esc_html__( "signal", 'facewp-abbey' ) ),
		array( "pe-7s-shuffle" => esc_html__( "shuffle", 'facewp-abbey' ) ),
		array( "pe-7s-shopbag" => esc_html__( "shopbag", 'facewp-abbey' ) ),
		array( "pe-7s-share" => esc_html__( "share", 'facewp-abbey' ) ),
		array( "pe-7s-server" => esc_html__( "server", 'facewp-abbey' ) ),
		array( "pe-7s-search" => esc_html__( "search", 'facewp-abbey' ) ),
		array( "pe-7s-film" => esc_html__( "film", 'facewp-abbey' ) ),
		array( "pe-7s-science" => esc_html__( "science", 'facewp-abbey' ) ),
		array( "pe-7s-disk" => esc_html__( "disk", 'facewp-abbey' ) ),
		array( "pe-7s-ribbon" => esc_html__( "ribbon", 'facewp-abbey' ) ),
		array( "pe-7s-repeat" => esc_html__( "repeat", 'facewp-abbey' ) ),
		array( "pe-7s-refresh" => esc_html__( "refresh", 'facewp-abbey' ) ),
		array( "pe-7s-add-user" => esc_html__( "add user", 'facewp-abbey' ) ),
		array( "pe-7s-refresh-cloud" => esc_html__( "refresh cloud", 'facewp-abbey' ) ),
		array( "pe-7s-paperclip" => esc_html__( "paperclip", 'facewp-abbey' ) ),
		array( "pe-7s-radio" => esc_html__( "radio", 'facewp-abbey' ) ),
		array( "pe-7s-note2" => esc_html__( "note2", 'facewp-abbey' ) ),
		array( "pe-7s-print" => esc_html__( "print", 'facewp-abbey' ) ),
		array( "pe-7s-network" => esc_html__( "network", 'facewp-abbey' ) ),
		array( "pe-7s-prev" => esc_html__( "prev", 'facewp-abbey' ) ),
		array( "pe-7s-mute" => esc_html__( "mute", 'facewp-abbey' ) ),
		array( "pe-7s-power" => esc_html__( "power", 'facewp-abbey' ) ),
		array( "pe-7s-medal" => esc_html__( "medal", 'facewp-abbey' ) ),
		array( "pe-7s-portfolio" => esc_html__( "portfolio", 'facewp-abbey' ) ),
		array( "pe-7s-like2" => esc_html__( "like2", 'facewp-abbey' ) ),
		array( "pe-7s-plus" => esc_html__( "plus", 'facewp-abbey' ) ),
		array( "pe-7s-left-arrow" => esc_html__( "left arrow", 'facewp-abbey' ) ),
		array( "pe-7s-play" => esc_html__( "play", 'facewp-abbey' ) ),
		array( "pe-7s-key" => esc_html__( "key", 'facewp-abbey' ) ),
		array( "pe-7s-plane" => esc_html__( "plane", 'facewp-abbey' ) ),
		array( "pe-7s-joy" => esc_html__( "joy", 'facewp-abbey' ) ),
		array( "pe-7s-photo-gallery" => esc_html__( "photo gallery", 'facewp-abbey' ) ),
		array( "pe-7s-pin" => esc_html__( "pin", 'facewp-abbey' ) ),
		array( "pe-7s-phone" => esc_html__( "phone", 'facewp-abbey' ) ),
		array( "pe-7s-plug" => esc_html__( "plug", 'facewp-abbey' ) ),
		array( "pe-7s-pen" => esc_html__( "pen", 'facewp-abbey' ) ),
		array( "pe-7s-right-arrow" => esc_html__( "right arrow", 'facewp-abbey' ) ),
		array( "pe-7s-paper-plane" => esc_html__( "paper plane", 'facewp-abbey' ) ),
		array( "pe-7s-delete-user" => esc_html__( "delete user", 'facewp-abbey' ) ),
		array( "pe-7s-paint" => esc_html__( "paint", 'facewp-abbey' ) ),
		array( "pe-7s-bottom-arrow" => esc_html__( "bottom arrow", 'facewp-abbey' ) ),
		array( "pe-7s-notebook" => esc_html__( "notebook", 'facewp-abbey' ) ),
		array( "pe-7s-note" => esc_html__( "note", 'facewp-abbey' ) ),
		array( "pe-7s-next" => esc_html__( "next", 'facewp-abbey' ) ),
		array( "pe-7s-news-paper" => esc_html__( "news paper", 'facewp-abbey' ) ),
		array( "pe-7s-musiclist" => esc_html__( "musiclist", 'facewp-abbey' ) ),
		array( "pe-7s-music" => esc_html__( "music", 'facewp-abbey' ) ),
		array( "pe-7s-mouse" => esc_html__( "mouse", 'facewp-abbey' ) ),
		array( "pe-7s-more" => esc_html__( "more", 'facewp-abbey' ) ),
		array( "pe-7s-moon" => esc_html__( "moon", 'facewp-abbey' ) ),
		array( "pe-7s-monitor" => esc_html__( "monitor", 'facewp-abbey' ) ),
		array( "pe-7s-micro" => esc_html__( "micro", 'facewp-abbey' ) ),
		array( "pe-7s-menu" => esc_html__( "menu", 'facewp-abbey' ) ),
		array( "pe-7s-map" => esc_html__( "map", 'facewp-abbey' ) ),
		array( "pe-7s-map-marker" => esc_html__( "map marker", 'facewp-abbey' ) ),
		array( "pe-7s-mail" => esc_html__( "mail", 'facewp-abbey' ) ),
		array( "pe-7s-mail-open" => esc_html__( "mail open", 'facewp-abbey' ) ),
		array( "pe-7s-mail-open-file" => esc_html__( "mail open file", 'facewp-abbey' ) ),
		array( "pe-7s-magnet" => esc_html__( "magnet", 'facewp-abbey' ) ),
		array( "pe-7s-loop" => esc_html__( "loop", 'facewp-abbey' ) ),
		array( "pe-7s-look" => esc_html__( "look", 'facewp-abbey' ) ),
		array( "pe-7s-lock" => esc_html__( "lock", 'facewp-abbey' ) ),
		array( "pe-7s-lintern" => esc_html__( "lintern", 'facewp-abbey' ) ),
		array( "pe-7s-link" => esc_html__( "link", 'facewp-abbey' ) ),
		array( "pe-7s-like" => esc_html__( "like", 'facewp-abbey' ) ),
		array( "pe-7s-light" => esc_html__( "light", 'facewp-abbey' ) ),
		array( "pe-7s-less" => esc_html__( "less", 'facewp-abbey' ) ),
		array( "pe-7s-keypad" => esc_html__( "keypad", 'facewp-abbey' ) ),
		array( "pe-7s-junk" => esc_html__( "junk", 'facewp-abbey' ) ),
		array( "pe-7s-info" => esc_html__( "info", 'facewp-abbey' ) ),
		array( "pe-7s-home" => esc_html__( "home", 'facewp-abbey' ) ),
		array( "pe-7s-help2" => esc_html__( "help2", 'facewp-abbey' ) ),
		array( "pe-7s-help1" => esc_html__( "help1", 'facewp-abbey' ) ),
		array( "pe-7s-graph3" => esc_html__( "graph3", 'facewp-abbey' ) ),
		array( "pe-7s-graph2" => esc_html__( "graph2", 'facewp-abbey' ) ),
		array( "pe-7s-graph1" => esc_html__( "graph1", 'facewp-abbey' ) ),
		array( "pe-7s-graph" => esc_html__( "graph3", 'facewp-abbey' ) ),
		array( "pe-7s-global" => esc_html__( "global", 'facewp-abbey' ) ),
		array( "pe-7s-gleam" => esc_html__( "gleam", 'facewp-abbey' ) ),
		array( "pe-7s-glasses" => esc_html__( "glasses", 'facewp-abbey' ) ),
		array( "pe-7s-gift" => esc_html__( "gift", 'facewp-abbey' ) ),
		array( "pe-7s-folder" => esc_html__( "folder", 'facewp-abbey' ) ),
		array( "pe-7s-flag" => esc_html__( "flag", 'facewp-abbey' ) ),
		array( "pe-7s-filter" => esc_html__( "filter", 'facewp-abbey' ) ),
		array( "pe-7s-file" => esc_html__( "file", 'facewp-abbey' ) ),
		array( "pe-7s-expand1" => esc_html__( "expand1", 'facewp-abbey' ) ),
		array( "pe-7s-exapnd2" => esc_html__( "expand2", 'facewp-abbey' ) ),
		array( "pe-7s-edit" => esc_html__( "edit", 'facewp-abbey' ) ),
		array( "pe-7s-drop" => esc_html__( "drop", 'facewp-abbey' ) ),
		array( "pe-7s-drawer" => esc_html__( "drawer", 'facewp-abbey' ) ),
		array( "pe-7s-download" => esc_html__( "download", 'facewp-abbey' ) ),
		array( "pe-7s-display2" => esc_html__( "display2", 'facewp-abbey' ) ),
		array( "pe-7s-display1" => esc_html__( "display1", 'facewp-abbey' ) ),
		array( "pe-7s-diskette" => esc_html__( "diskette", 'facewp-abbey' ) ),
		array( "pe-7s-date" => esc_html__( "date", 'facewp-abbey' ) ),
		array( "pe-7s-cup" => esc_html__( "cup", 'facewp-abbey' ) ),
		array( "pe-7s-culture" => esc_html__( "culture", 'facewp-abbey' ) ),
		array( "pe-7s-crop" => esc_html__( "crop", 'facewp-abbey' ) ),
		array( "pe-7s-credit" => esc_html__( "credit", 'facewp-abbey' ) ),
		array( "pe-7s-copy-file" => esc_html__( "copy file", 'facewp-abbey' ) ),
		array( "pe-7s-config" => esc_html__( "config", 'facewp-abbey' ) ),
		array( "pe-7s-compass" => esc_html__( "compass", 'facewp-abbey' ) ),
		array( "pe-7s-comment" => esc_html__( "comment", 'facewp-abbey' ) ),
		array( "pe-7s-coffee" => esc_html__( "coffee", 'facewp-abbey' ) ),
		array( "pe-7s-cloud" => esc_html__( "cloud", 'facewp-abbey' ) ),
		array( "pe-7s-clock" => esc_html__( "clock", 'facewp-abbey' ) ),
		array( "pe-7s-check" => esc_html__( "check", 'facewp-abbey' ) ),
		array( "pe-7s-chat" => esc_html__( "chat", 'facewp-abbey' ) ),
		array( "pe-7s-cart" => esc_html__( "cart", 'facewp-abbey' ) ),
		array( "pe-7s-camera" => esc_html__( "Camera", 'facewp-abbey' ) ),
		array( "pe-7s-call" => esc_html__( "call", 'facewp-abbey' ) ),
		array( "pe-7s-calculator" => esc_html__( "calculator", 'facewp-abbey' ) ),
		array( "pe-7s-browser" => esc_html__( "browser", 'facewp-abbey' ) ),
		array( "pe-7s-box2" => esc_html__( "box2", 'facewp-abbey' ) ),
		array( "pe-7s-box1" => esc_html__( "box1", 'facewp-abbey' ) ),
		array( "pe-7s-bookmarks" => esc_html__( "bookmarks", 'facewp-abbey' ) ),
		array( "pe-7s-bicycle" => esc_html__( "bicycle", 'facewp-abbey' ) ),
		array( "pe-7s-bell" => esc_html__( "bell", 'facewp-abbey' ) ),
		array( "pe-7s-battery" => esc_html__( "battery", 'facewp-abbey' ) ),
		array( "pe-7s-ball" => esc_html__( "ball", 'facewp-abbey' ) ),
		array( "pe-7s-back" => esc_html__( "back", 'facewp-abbey' ) ),
		array( "pe-7s-attention" => esc_html__( "attention", 'facewp-abbey' ) ),
		array( "pe-7s-anchor" => esc_html__( "anchor", 'facewp-abbey' ) ),
		array( "pe-7s-albums" => esc_html__( "albums", 'facewp-abbey' ) ),
		array( "pe-7s-alarm" => esc_html__( "alarm", 'facewp-abbey' ) ),
		array( "pe-7s-airplay" => esc_html__( "airplay", 'facewp-abbey' ) ),
	);

	return array_merge( $icons, $pe7stroke_icons );
}

if ( function_exists( 'vc_add_' . 'shortcode_param' ) ) {
	call_user_func_array( 'vc_add_' . 'shortcode_param', array( 'facewp_abbey_animation_type', 'facewp_abbey_vc_animation_type_field' ) );
}

function facewp_abbey_vc_animation_type_field( $settings, $value ) {
	$animation_groups = array(
		__( 'Attention Seekers', 'facewp-abbey' )  => array(
			'bounce',
			'flash',
			'pulse',
			'rubberBand',
			'shake',
			'swing',
			'tada',
			'wobble'
		),
		__( 'Bouncing Entrances', 'facewp-abbey' ) => array(
			'bounceIn',
			'bounceInDown',
			'bounceInLeft',
			'bounceInRight',
			'bounceInUp'
		),
		__( 'Fading Entrances', 'facewp-abbey' )   => array(
			'fadeIn',
			'fadeInDown',
			'fadeInDownBig',
			'fadeInLeft',
			'fadeInLeftBig',
			'fadeInRight',
			'fadeInRightBig',
			'fadeInUp',
			'fadeInUpBig'
		),
		__( 'Flippers', 'facewp-abbey' )           => array( 'flip', 'flipInX', 'flipInY' ),
		__( 'Lightspeed', 'facewp-abbey' )         => array( 'lightSpeedIn' ),
		__( 'Rotating Entrances', 'facewp-abbey' ) => array(
			'rotateIn',
			'rotateInDownLeft',
			'rotateInDownRight',
			'rotateInUpLeft',
			'rotateInUpRight'
		),
		__( 'Sliders', 'facewp-abbey' )            => array( 'slideInDown', 'slideInLeft', 'slideInRight' ),
		__( 'Specials', 'facewp-abbey' )           => array( 'hinge', 'rollIn' ),
	);

	$html = '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';

	$html .= '<option value="">' . esc_html( 'none', 'facewp-abbey' ) . '</option>';

	foreach ( $animation_groups as $animation_group => $animations ) {
		$html .= '<optgroup label="' . esc_attr( $animation_group ) . '">';
		foreach ( $animations as $animation ) {
			$selected = '';
			if ( $animation == $value ) {
				$selected = ' selected="selected"';
			}
			$html .= '<option value="' . esc_attr( $animation ) . '"' . esc_attr( $selected ) . '>' . $animation . '</option>';
		}
		$html .= '</optgroup>';
	}

	$html .= '</select>';

	return $html;
}