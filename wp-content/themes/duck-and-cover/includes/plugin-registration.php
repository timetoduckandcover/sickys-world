<?php
if ( ! function_exists( 'facewp_abbey_register_theme_plugins' ) ) :
	function facewp_abbey_register_theme_plugins() {

		$plugins = array(
			array(
				'name'     => 'FaceWP Toolkit',
				'slug'     => 'facewp-toolkit',
				'source'   => get_stylesheet_directory() . '/plugins/facewp-toolkit.zip',
				'version'  => '1.2',
				'required' => true,
			),
			array(
				'name'     => 'Visual Composer',
				'slug'     => 'js_composer',
				'source'   => get_stylesheet_directory() . '/plugins/js_composer.zip',
				'version'  => '4.11',
				'required' => true,
			),
			array(
				'name'     => 'Revolution Slider',
				'slug'     => 'revslider',
				'source'   => get_stylesheet_directory() . '/plugins/revslider.zip',
				'version'  => '5.2.2',
				'required' => true,
			),
			array(
				'name'     => 'CMB2',
				'slug'     => 'cmb2',
				'required' => true,
			),
			array(
				'name'     => 'Envato Toolkit',
				'slug'     => 'envato-wordpress-toolkit',
				'source'   => get_stylesheet_directory() . '/plugins/envato-wordpress-toolkit.zip',
				'version'  => '1.7.3',
				'required' => false,
			),
			array(
				'name'     => 'WooCommerce - excelling eCommerce',
				'slug'     => 'woocommerce',
				'required' => true,
			),
			array(
				'name'     => 'Contact Form 7',
				'slug'     => 'contact-form-7',
				'required' => true,
			),
			array(
				'name'     => 'WP Instagram Widget',
				'slug'     => 'wp-instagram-widget',
				'required' => true,
			),
			array(
				'name'     => 'YITH WooCommerce Wishlist',
				'slug'     => 'yith-woocommerce-wishlist',
				'required' => false
			),
			array(
				'name'     => 'YITH WooCommerce Ajax Search',
				'slug'     => 'yith-woocommerce-ajax-search',
				'required' => false
			),
			array(
				'name'     => 'YITH WooCommerce Ajax Product Filter',
				'slug'     => 'yith-woocommerce-ajax-navigation',
				'required' => false
			),
			array(
				'name'     => 'Testimonials by WooThemes',
				'slug'     => 'testimonials-by-woothemes',
				'required' => true
			),
			array(
				'name'     => 'MailChimp for WordPress',
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			),
			array(
				'name'     => 'Widget Logic',
				'slug'     => 'widget-logic',
				'required' => true,
			),
		);


		$config = array(
			'id'           => 'tgmpa',
			// Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',
			// Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins',
			// Menu slug.
			'parent_slug'  => 'facewp',
			// Parent menu slug.
			'capability'   => 'edit_theme_options',
			// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,
			// Show admin notices or not.
			'dismissable'  => true,
			// If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',
			// If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => true,
			// Automatically activate plugins after installation or not.
			'message'      => '',
			// Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'facewp-abbey' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'facewp-abbey' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'facewp-abbey' ),
				// %s = plugin name.
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'facewp-abbey' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %1$s plugin.', 'Sorry, but you do not have the correct permissions to install the %1$s plugins.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'notice_ask_to_update_maybe'      => _n_noop( 'There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %1$s plugin.', 'Sorry, but you do not have the correct permissions to update the %1$s plugins.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %1$s plugin.', 'Sorry, but you do not have the correct permissions to activate the %1$s plugins.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'facewp-abbey' ),
				'update_link'                     => _n_noop( 'Begin updating plugin', 'Begin updating plugins', 'facewp-abbey' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'facewp-abbey' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'facewp-abbey' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'facewp-abbey' ),
				'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'facewp-abbey' ),
				'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'facewp-abbey' ),
				// %1$s = plugin name(s).
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'facewp-abbey' ),
				// %s = dashboard link.
				'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'facewp-abbey' ),
				'nag_type'                        => 'updated',
				// Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);

		tgmpa( $plugins, $config );

	}

	add_action( 'tgmpa_register', 'facewp_abbey_register_theme_plugins' );
endif;