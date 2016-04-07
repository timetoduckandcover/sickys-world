<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

class FaceWP_Abbey_Admin_Menus {
  protected $sub_menus = array();

  public function __construct() {
    $this->sub_menus = apply_filters( 'facewp_admin_menus', $this->sub_menus );

    add_action( 'admin_menu', array( $this, 'menus' ) );
  }

  public function menus() {
    foreach ( $this->sub_menus as $sub_menu ) {
      add_theme_page( $sub_menu['page_title'], $sub_menu['page_title'], $sub_menu['capability'], $sub_menu['menu_slug'], $sub_menu['func'] );
    }
  }
}

return new FaceWP_Abbey_Admin_Menus();