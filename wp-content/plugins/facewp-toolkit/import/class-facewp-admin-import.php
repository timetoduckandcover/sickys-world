<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

define( 'FaceWP_IMPORT_URL', untrailingslashit( plugins_url( '/', __FILE__ ) )  );
define( 'FaceWP_IMPORT_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

class FaceWP_Abbey_Admin_Import {
  protected $theme;
  protected $demos;
  protected $types;

  protected $dummy_data_path;

  public function __construct() {
    $this->dummy_data_path = get_template_directory() . '/includes/dummy-data';

    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    add_action( 'init', array( $this, 'init' ) );

    add_filter( 'facewp_admin_menus', array( $this, 'menu_import' ));
    add_action( 'wp_ajax_facewp_import', array( $this, 'import' ) );

  }

  public function init() {
    $this->theme = apply_filters( 'facewp_import_theme', 'FaceWP' );
    $this->demos = apply_filters( FacewWP_THEME_PREFIX . 'import_demos', array() );
    $this->types = apply_filters( FacewWP_THEME_PREFIX . 'import_types', array() );
  }

  public function enqueue_scripts() {
    global $wp_scripts;

    $jquery_version = isset( $wp_scripts->registered['jquery-ui-core']->ver ) ? $wp_scripts->registered['jquery-ui-core']->ver : '1.9.2';
    wp_enqueue_style( 'jquery-ui-style', '//code.jquery.com/ui/' . $jquery_version . '/themes/smoothness/jquery-ui.css', array(), $jquery_version );
    wp_enqueue_style( 'facewp_import_admin', FaceWP_IMPORT_URL . '/assets/css/admin.css', array(), '1.0' );

    wp_enqueue_script( 'facewp_import_admin', FaceWP_IMPORT_URL . '/assets/js/admin.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-progressbar', 'underscore' ), '1.0', true );
    wp_localize_script( 'facewp_import_admin', 'facewp_import_data', array(
        'types' => $this->types
    ) );
  }

  public function menu_import( $menus ) {
    $menus[] = array(
        'func'        => array( $this, 'page_import' ),
        'page_title'  => sprintf( __( '%s Import', 'facewp-abbey' ), FaceWP_Abbey_THEME ),
        'menu_title'  => sprintf( __( '%s Import', 'facewp-abbey' ), FaceWP_Abbey_THEME ),
        'menu_slug'   => FacewWP_THEME_PREFIX . 'import',
        'capability'  => 'manage_options',
    );

    return $menus;
  }

  public function page_import() {
    $theme = wp_get_theme();

    extract( array(
        'demos' => $this->demos,
        'types' => $this->types,
    ) );

    include( 'templates/page.php' );
  }

  public function import() {
    $demo    = $_POST['demo'];
    $type    = $_POST['type'];
    $step    = $_POST['step'];
    $content = $_POST['data'];

    $data = array();

    $method  = 'import_' . $content;
    if ( method_exists( $this, $method ) ) {
      $result = call_user_func_array( array( $this, $method ), array( $demo, $step ) );

      $data = array(
          'demo'   => $demo,
          'type'   => $type,
          'data'   => $content,
          'step'   => $result[0],
          'length' => $result[1],
      );

      if ( $result[0] >= $result[1] ) {

        $import_types = $this->types;
        $import_find  = false;

        foreach ( $import_types as $import_type => $import_label ) {

          // Get next import
          if ( true == $import_find ) {

            $data['next_data'] = $import_type;
            break;

          }

          if ( $import_type == $content ) {

            $import_find = true;

          }

        }

        // Import done
        if ( empty( $data['next_data'] ) ) {
          $data['next_data'] = 'none';
        }

      }
    }

    echo json_encode($data);

    die();
  }

  protected function import_all( $demo, $step ) {

    return array( 0, 0 );

  }

  protected function import_content( $demo, $step ) {
    if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
      define( 'WP_LOAD_IMPORTERS', true );
    }

    require_once ABSPATH . 'wp-admin/includes/import.php';
    if ( ! class_exists( 'WP_Importer' ) ) {
      $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
      require_once( $class_wp_importer );
    }

    if ( ! class_exists( 'TM_WP_Importer' ) ) {
      $class_wp_import = FaceWP_IMPORT_PATH . '/includes/wordpress-importer/wordpress-importer.php';
      require_once( $class_wp_import );
    }

    if ( class_exists( 'TM_WP_Importer' ) ) {
      include_once( FaceWP_IMPORT_PATH . '/includes/wordpress-importer/importer.php' );
    }

    $path = $this->dummy_data_path . '/' . $demo . '/content.xml';

    ob_start();

    $import = new TM_Importer();
    $import->fetch_attachments = true;
    set_time_limit( 0 );
    $result = $import->import_stepped( $path, $step );

    //Ensure the $wp_rewrite global is loaded
    global $wp_rewrite;
    //Call flush_rules() as a method of the $wp_rewrite object
    $wp_rewrite->flush_rules();

    ob_end_clean();

    return $result;
  }

  protected function import_widgets( $demo, $step ) {

    $options = $this->get_encoded_data( $demo, 'widgets' );

    // Widgets
    foreach ( (array) $options['widgets'] as $facewp_widget_id => $facewp_widget_data ) {
      update_option( 'widget_' . $facewp_widget_id, $facewp_widget_data );
    }

    // Custom Sidebars
	if ( ! empty( $options['custom_sidebars'] ) ) {
		update_option( FacewWP_THEME_PREFIX . 'custom_sidebars', $options['custom_sidebars'] );
	}

	// Sidebars
    $facewp_sidebars = get_option( "sidebars_widgets" );
    unset( $facewp_sidebars['array_version'] );
    $data = $options;
    if ( is_array( $data['sidebars'] ) ) {
      $facewp_sidebars = array_merge( (array) $facewp_sidebars, (array) $data['sidebars'] );
      unset( $facewp_sidebars['wp_inactive_widgets'] );
      $facewp_sidebars                  = array_merge( array( 'wp_inactive_widgets' => array() ), $facewp_sidebars );
      $facewp_sidebars['array_version'] = 2;
      wp_set_sidebars_widgets( $facewp_sidebars );
    }

    // Widget Logic
    $widget_logic_file = $this->dummy_data_path . '/' . $demo . '/widget_logic_options.txt';

    if ( file_exists( $widget_logic_file ) ) {
      global $wl_options;

      require_once( ABSPATH . 'wp-admin/includes/file.php' );
      WP_Filesystem();
      global $wp_filesystem;

      $import = explode( "\n", $wp_filesystem->get_contents( $widget_logic_file ) );

      if ( trim( array_shift( $import ) ) == "[START=WIDGET LOGIC OPTIONS]" && trim( array_pop( $import ) ) == "[STOP=WIDGET LOGIC OPTIONS]" ) {
        foreach ( $import as $import_option ) {

          list( $key, $value ) = explode( "\t", $import_option );
          $wl_options[ $key ] = json_decode( $value );

        }
      }

      update_option( 'widget_logic', $wl_options );
    }

    return array( 1, 1 );
  }

  protected function import_page_options( $demo, $step ) {
    $pages = $this->get_data( $demo, 'page_options' );

    if ( ! empty( $pages['show_on_front'] ) ) {
      update_option( 'show_on_front', $pages['show_on_front'] );
    }

    if ( ! empty( $pages['page_on_front'] ) ) {
      $page = get_page_by_title( $pages['page_on_front'] );

      update_option( 'page_on_front', $page->ID );
    }

    if ( ! empty( $pages['page_for_posts'] ) ) {
      $page = get_page_by_title( $pages['page_for_posts'] );

      update_option( 'page_for_posts', $page->ID );
    }

    return array( 1, 1 );
  }

  protected function import_menus( $demo, $step ) {
    global $wpdb;
    $facewp_terms_table = $wpdb->prefix . "terms";
    $menu_data             = $this->get_data( $demo, 'menus' );
    $menu_array            = array();

    foreach ( $menu_data as $registered_menu => $menu_slug ) {

      $term_rows = $wpdb->get_results( "SELECT * FROM $facewp_terms_table where slug='{$menu_slug}'", ARRAY_A );

      if ( isset( $term_rows[0]['term_id'] ) ) {
        $term_id_by_slug = $term_rows[0]['term_id'];
      } else {
        $term_id_by_slug = null;
      }

      $menu_array[ $registered_menu ] = $term_id_by_slug;
    }
    set_theme_mod( 'nav_menu_locations', array_map( 'absint', $menu_array ) );

    return array( 1, 1 );
  }

	protected function import_woocommerce_settings( $demo, $step ) {
		$settings = $this->get_data( $demo, 'woocommerce_settings' );

		if ( is_array( $settings ) && ! empty( $settings['image_sizes'] ) ) {
			update_option( 'shop_catalog_image_size', $settings['image_sizes']['catalog'] ); 		// Product category thumbs
			update_option( 'shop_single_image_size', $settings['image_sizes']['single'] ); 		// Single product image
			update_option( 'shop_thumbnail_image_size', $settings['image_sizes']['thumbnail'] ); 	// Image gallery thumbs
		}

		$wc_pages = array(
			'woocommerce_shop_page_id'      => 'Shop',
			'woocommerce_cart_page_id'      => 'Cart',
			'woocommerce_checkout_page_id'  => 'Checkout',
			'woocommerce_myaccount_page_id' => 'My Account'
		);
		foreach ( $wc_pages as $wc_page_name => $wc_page_title ) {
			$wc_page = get_page_by_title( $wc_page_title );
			if ( isset( $wc_page ) && $wc_page->ID ) {
				update_option( $wc_page_name, $wc_page->ID );
			}
		}

		$notices = array_diff( get_option( 'woocommerce_admin_notices', array() ), array( 'install', 'update' ) );
		update_option( 'woocommerce_admin_notices', $notices );
		delete_option( '_wc_needs_pages' );
		delete_transient( '_wc_activation_redirect' );

		return array( 1, 1 );
	}

  protected function import_essential_grid( $demo, $step ) {
    require_once(ABSPATH .'wp-content/plugins/essential-grid/essential-grid.php');

    $file = $this->dummy_data_path . '/' . $demo . '/essential_grid.txt';

    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    WP_Filesystem();
    global $wp_filesystem;

    $es_data = json_decode( $wp_filesystem->get_contents( $file ), true );

    try{
      $im = new Essential_Grid_Import();

      $overwriteData = array(
          'global-styles-overwrite' => 'overwrite'
      );

      // Create Overwrite & Ids data
      $skins = @$es_data['skins'];
      $export_skins = array();
      if(!empty($skins) && is_array($skins)){
        foreach ($skins as $skin) {
          $export_skins[] = $skin['id'];
          $overwriteData['skin-overwrite-' . $skin['id']] = 'overwrite';
        }
      }

      $export_navigation_skins = array();
      $navigation_skins = @$es_data['navigation-skins'];

      foreach ((array)$navigation_skins as $nav_skin) {
        $export_navigation_skins[] = $nav_skin['id'];
        $overwriteData['nav-skin-overwrite-' . $nav_skin['id']] = 'overwrite';
      }

      $export_grids = array();
      $grids = @$es_data['grids'];
      if(!empty($grids) && is_array($grids)){
        foreach ($grids as $grid) {
          $export_grids[] = $grid['id'];
          $overwriteData['grid-overwrite-' . $grid['id']] = 'overwrite';
        }
      }

      $export_elements = array();
      $elements = @$es_data['elements'];
      if (!empty($elements) && is_array($elements))
      {foreach ($elements as $element) {
        $export_elements[] = $element['id'];
        $overwriteData['elements-overwrite-' . $element['id']] = 'overwrite';
      }}

      $export_custom_meta = array();
      $custom_metas = @$es_data['custom-meta'];
      if(!empty($custom_metas) && is_array($custom_metas)){
        foreach ($custom_metas as $custom_meta) {
          $export_custom_meta[] = $custom_meta['handle'];
          $overwriteData['custom-meta-overwrite-' .  $custom_meta['handle']] = 'overwrite';
        }
      }

      $export_punch_fonts = array();
      $custom_fonts = @$es_data['punch-fonts'];
      if(!empty($custom_fonts) && is_array($custom_fonts)){
        foreach ($custom_fonts as $custom_font) {
          $export_punch_fonts[] = $custom_font['handle'];
          $overwriteData['punch-fonts-overwrite-' . $custom_font['handle']] = 'overwrite';
        }
      }

      $im->set_overwrite_data($overwriteData); //set overwrite data global to class

      // Import data
      $skins = @$es_data['skins'];
      if(!empty($skins) && is_array($skins)){
        if(!empty($skins)){
          $skins_imported = $im->import_skins($skins, $export_skins);
        }
      }

      $navigation_skins = @$es_data['navigation-skins'];
      if(!empty($navigation_skins) && is_array($navigation_skins)){
        if(!empty($navigation_skins)){
          $navigation_skins_imported = $im->import_navigation_skins(@$navigation_skins, $export_navigation_skins);
        }
      }

      $grids = @$es_data['grids'];
      if(!empty($grids) && is_array($grids)){
        if(!empty($grids)){
          $grids_imported = $im->import_grids($grids, $export_grids);
        }
      }

      $elements = @$es_data['elements'];
      if(!empty($elements) && is_array($elements)){
        if(!empty($elements)){
          $elements_imported = $im->import_elements(@$elements, $export_elements);
        }
      }

      $custom_metas = @$es_data['custom-meta'];
      if(!empty($custom_metas) && is_array($custom_metas)){
        if(!empty($custom_metas)){
          $custom_metas_imported = $im->import_custom_meta($custom_metas, $export_custom_meta);
        }
      }

      $custom_fonts = @$es_data['punch-fonts'];
      if(!empty($custom_fonts) && is_array($custom_fonts)){
        if(!empty($custom_fonts)){
          $custom_fonts_imported = $im->import_punch_fonts($custom_fonts, $export_punch_fonts);
        }
      }

      if(true){
        $global_css = @$es_data['global-css'];

        $tglobal_css = stripslashes($global_css);
        if(empty($tglobal_css)) {$tglobal_css = $global_css;}

        $global_styles_imported = $im->import_global_styles($tglobal_css);
      }
    } catch(Exception $d){
    }

    return array( 1, 1 );
  }

  protected function import_rev_slider( $demo, $step ) {
    if ( ! class_exists( 'RevSliderAdmin' ) ) {
      require( RS_PLUGIN_PATH . '/admin/revslider-admin.class.php' );
    }

    $rev_files = glob( $this->dummy_data_path . '/' . $demo . '/rev_sliders/*.zip' );

    if ( ! empty( $rev_files ) ) {
      $rev_file = $rev_files[ $step ];

      $_FILES['import_file']['error']    = UPLOAD_ERR_OK;
      $_FILES['import_file']['tmp_name'] = $rev_file;

      ob_start();

      $slider = new RevSlider();
      $slider->importSliderFromPost( true, 'none' );

      ob_end_clean();
    }

    return array( $step + 1, count( $rev_files ) );
  }

  protected function get_encoded_data( $demo, $type ) {
    $file = $this->dummy_data_path . '/' . $demo . '/' . $type . '.txt';

    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    WP_Filesystem();
    global $wp_filesystem;

    $file_content = $wp_filesystem->get_contents( $file );

    return @unserialize( base64_decode( $file_content ) );
  }

  protected function get_data( $demo, $type ) {
    $file = $this->dummy_data_path . '/' . $demo . '/' . $type . '.txt';

    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    WP_Filesystem();
    global $wp_filesystem;

    $file_content = $wp_filesystem->get_contents( $file );

    return @unserialize( $file_content );
  }
}

return new FaceWP_Abbey_Admin_Import();