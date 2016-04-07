<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

class FaceWP_Abbey_Admin_Export {
  public function __construct() {
    if ( ! WP_DEBUG ) {
      return;
    }

    add_filter( 'facewp_admin_menus', function ( $menus ) {
      $menus[] = array(
        'func'        => array( $this, 'page_export' ),
        'page_title'  => sprintf( __( '%s Export', 'facewp-abbey' ), FaceWP_Abbey_THEME ),
        'menu_title'  => sprintf( __( '%s Export', 'facewp-abbey' ), FaceWP_Abbey_THEME ),
        'menu_slug'   => FacewWP_THEME_PREFIX . 'export',
        'capability'  => 'manage_options',
      );

      return $menus;
    } );

    add_action( 'init', array( $this, 'init' ) );
  }

  public function init() {
    if ( isset( $_REQUEST['export_option'] ) ) {
      $export_option = $_REQUEST['export_option'];

      if ( $export_option == 'widgets' ) {
        $this->export_widgets_sidebars();
      } elseif ( $export_option == 'menus' ) {
        $this->export_menus();
      } elseif ( $export_option == 'page_options' ){
        $this->export_page_options();
      } else if ( $export_option == 'woocommerce_settings' ) {
	      $this->export_woocommerce_settings();
      }
    }
  }

  public function page_export() {
    include( 'view/html-admin-page-export.php' );
  }

  public function export_widgets_sidebars(){
    $this->data             = array();
    $this->data['sidebars'] = $this->export_sidebars();
    $this->data['custom_sidebars']  = $this->export_custom_sidebars();
    $this->data['widgets']  = $this->export_widgets();

    $output = base64_encode( serialize( $this->data ) );
    $this->save_as_txt_file( "widgets.txt", $output );
  }
  public function export_widgets(){

    global $wp_registered_widgets;
    $all_facewp_widgets = array();

    foreach ( $wp_registered_widgets as $facewp_widget_id => $widget_params ) {
      $all_facewp_widgets[] = $widget_params['callback'][0]->id_base;
    }

    $widget_datas = array();

    foreach ( $all_facewp_widgets as $facewp_widget_id ) {
      $facewp_widget_data = get_option( 'widget_' . $facewp_widget_id );
      if ( ! empty( $facewp_widget_data ) ) {
        $widget_datas[ $facewp_widget_id ] = $facewp_widget_data;
      }
    }
    unset( $all_facewp_widgets );

    return $widget_datas;

  }
  public function export_sidebars(){
    $facewp_sidebars = get_option( "sidebars_widgets" );
    $facewp_sidebars = $this->exclude_sidebar_keys( $facewp_sidebars );

    return $facewp_sidebars;
  }
  public function export_custom_sidebars() {
    $custom_sidebars = get_option( FacewWP_THEME_PREFIX . 'custom_sidebars' );

    return is_array( $custom_sidebars ) ? $custom_sidebars : array();
  }
  private function exclude_sidebar_keys( $keys = array() ){
    if ( ! is_array( $keys ) ) {
      return $keys;
    }

    unset( $keys['wp_inactive_widgets'] );
    unset( $keys['array_version'] );

    return $keys;
  }
  public function export_menus(){
    global $wpdb;

    $this->data = array();
    $locations  = get_nav_menu_locations();

    $terms_table = $wpdb->prefix . "terms";
    foreach ( (array) $locations as $location => $menu_id ) {
      $menu_slug = $wpdb->get_results( "SELECT * FROM $terms_table where term_id={$menu_id}", ARRAY_A );
      if ( ! empty( $menu_slug ) ) {
        $this->data[ $location ] = $menu_slug[0]['slug'];
      }
    }

    $output = serialize( $this->data );
    $this->save_as_txt_file( "menus.txt", $output );
  }
  public function export_page_options(){
    $facewp_show_on_front  = get_option( "show_on_front" );

    $facewp_settings_pages = array(
        'show_on_front'  => $facewp_show_on_front,
    );

    if ( $static_page_id = get_option( "page_on_front" ) ) {
      $facewp_static_page                     = get_post( $static_page_id );
      $facewp_settings_pages['page_on_front'] = $facewp_static_page->post_title;
    }

    if ( $post_page_id = get_option( 'page_for_posts' ) ) {
      $facewp_post_page                        = get_post( $post_page_id );
      $facewp_settings_pages['page_for_posts'] = $facewp_post_page->post_title;
    }

    $output                   = serialize( $facewp_settings_pages );

    $this->save_as_txt_file( "page_options.txt", $output );
  }
	public function export_woocommerce_settings(){
		$data = array(
			'image_sizes' => array(
				'catalog' => wc_get_image_size( 'shop_catalog' ),
				'thumbnail' => wc_get_image_size( 'shop_thumbnail' ),
				'single' => wc_get_image_size( 'shop_single' )
			)
		);

		$output = serialize( $data );

		$this->save_as_txt_file( "woocommerce_settings.txt", $output );
	}

  protected function save_as_txt_file( $file_name, $output ){
    header( "Content-type: application/text", true, 200 );
    header( "Content-Disposition: attachment; filename=$file_name" );
    header( "Pragma: no-cache" );
    header( "Expires: 0" );

    echo $output;

    exit;
  }

  protected function encode( $content ) {
    return json_encode( $content );
  }
}

return new FaceWP_Abbey_Admin_Export();