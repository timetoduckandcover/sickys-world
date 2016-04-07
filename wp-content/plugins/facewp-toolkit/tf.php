<?php
if ( ! function_exists( 'facewp_bb_en' ) ) {
	function facewp_bb_en( $data ) {
		return base64_encode( $data );
	}
}

if ( ! function_exists( 'facewp_bb_de' ) ) {
	function facewp_bb_de( $data ) {
		return base64_decode( $data );
	}
}


if ( is_admin() && class_exists( 'RevSliderAdmin' ) && isset( $productAdmin ) ) {
	global $revSliderAsTheme;
	$revSliderAsTheme = true;
	remove_action( 'admin_notices', array( $productAdmin, 'addActivateNotification' ) );
}

if ( is_admin() && function_exists( 'vc_manager' ) ) {
	add_action( 'admin_print_scripts-post.php', 'facewp_vc_remove_notice', 15 );
	function facewp_vc_remove_notice() {
		remove_action( 'admin_notices', array( vc_manager()->license(), 'adminNoticeLicenseActivation', ) );
	}
}

if ( is_admin() ) {
	add_filter( 'vc_settings_tabs', 'facewp_remove_vc_setting_tab' );

	function facewp_remove_vc_setting_tab( $tabs ) {
		unset( $tabs['vc-updater'] );

		return $tabs;
	}
}

add_action( 'init', 'facewp_remove_vc_tgm_update_notice' );
function facewp_remove_vc_tgm_update_notice() {
	global $vc_manager;
	if ( ! empty( $vc_manager ) ) {
		$updater = $vc_manager->updater();
		remove_filter( 'upgrader_pre_download', array( $updater, 'preUpgradeFilter' ), 10 );

		remove_filter( 'pre_set_site_transient_update_plugins', array( $updater->updateManager() , 'check_update') );
	}
}