<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class FaceWP_Abbey_Admin {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ), 99 );
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		$admin_path = FaceWPC()->core_path() . 'includes/admin/';

		include_once( $admin_path . 'class-facewp-admin-menus.php' );
	}

	public function register_scripts() {
		wp_enqueue_script( 'spaceship-admin', FaceWPC()->core_url() . 'assets/js/admin/admin.js', array(
			'common',
			'jquery',
			'media-upload',
			'thickbox'
		), '1.0.0', true );
	}
}

return new FaceWP_Abbey_Admin();
