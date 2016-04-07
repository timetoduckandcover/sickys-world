<?php
add_filter( 'body_class', 'facewp_abbey_body_class' );
function facewp_abbey_body_class( $classes ) {
    $classes[] = facewp_abbey_get_body_wrapper();

    if ( is_page() && get_post_meta( get_the_ID(), 'facewp_abbey_background_image', true ) ) {
        $classes[] = 'custom-background';
    }

    return $classes;
}

function facewp_abbey_get_taxonomies( $content_type ) {
    $taxonomies = get_taxonomies( array( 'object_type' => array( $content_type ) ), 'names', 'and');
    return $taxonomies;
}

/**
 * Social links
 * @param bool|false $mobile
 */
function facewp_abbey_social_links() {
    $social_links = Kirki::get_option( 'facewp', 'social_links' );

    if ( ! empty( $social_links ) ) {
        ?>
        <ul class="social-links">
            <?php foreach ( $social_links as $row ) { ?>
                <li <?php echo ( empty( $row['link_url'] ) ? 'class="text"' : ''); ?>>
                    <?php if ( isset( $row['link_url'] ) && ! empty( $row['link_url'] ) ) { ?>
                    <a href="<?php echo esc_url_raw( $row['link_url'] ); ?>"><?php } ?>
                        <?php echo esc_html( $row['social_name'] ); ?>
                        <?php if ( isset( $row['link_url'] ) && ! empty( $row['link_url'] ) ) { ?></a><?php } ?>
                </li>
            <?php } ?>
        </ul>
        <?php
    }
}

/**
 * Language switcher
 */
function facewp_abbey_language_switcher($menu_id) {
    ob_start();

    $language_switcher_enable = Kirki::get_option( 'facewp-abbey', 'language_switcher_enable' );

    if ( has_nav_menu( 'language_switcher' ) ) {
        wp_nav_menu( array(
                         'theme_location'  => 'language_switcher',
                         'menu_id'         => $menu_id,
                         'container_class' => 'switcher-menu language-switcher-menu',
                         'depth'           => 2,
                         'fallback_cb'     => false,
                     ) );
    }

    // Polylang
    if ( $language_switcher_enable && class_exists( 'PolyLang' ) ) {
        echo facewp_abbey_polylang_switcher();
    }

    // WPML
    if ( $language_switcher_enable && class_exists( 'SitePress' ) && function_exists( 'wpml_get_active_languages_filter' ) ) {
        echo facewp_abbey_wpml_switcher();
    }

    return ob_get_clean();
}

/**
 * Polylang Language Switcher
 *
 * @return string
 */
function facewp_abbey_polylang_switcher() {
    ob_start();

    $langs = pll_languages_list();

    if ( ! empty( $langs ) ) {

        $args = array(
            'dropdown' => 1,
            'raw'      => 1,
        );

        $langs = pll_the_languages( $args );
        $html  = '';

        if ( ! empty ( $langs ) ) {
            foreach ( $langs as $l ) {

                if ( $l['current_lang'] ) {
                    $html .= '<option selected="selected"';
                } else {
                    $html .= '<option';
                }

                // show flag
                $html .= ' data-imagesrc="' . esc_url( $l['flag'] ) . '"';

                // add link
                $html .= ' value="' . esc_url( $l['url'] ) . '"';

                // language name
                $html .= '>' . $l['name'];

                $html .= '</option>';
            }
        }
        ?>
        <div class="switcher language-switcher polylang-switcher">
            <select name="polylang-switcher" id="polylang-switcher">
                <?php echo '' . $html; ?>
            </select>
        </div>
        <?php
    }

    return ob_get_clean();
}

/**
 * WMPL Language Switcher
 *
 * @return string
 */
function facewp_abbey_wpml_switcher() {

    ob_start();

    global $sitepress;

    $settings = $sitepress->get_settings();

    $flag_enable = isset( $settings['icl_lso_flags'] ) ? $settings['icl_lso_flags'] : 0;
    $select_type = isset( $settings['icl_lang_sel_type'] ) ? $settings['icl_lang_sel_type'] : 'dropdown';

    // get all avaiable languages
    $langs = wpml_get_active_languages_filter( 'skip_missing=0&orderby=code' );

    if ( ! empty( $langs ) ) {
        $html = '';

        foreach ( $langs as $l ) {

            if ( 'dropdown' == $select_type ) {
                if ( $l['active'] ) {
                    $html .= '<option selected="selected"';
                } else {
                    $html .= '<option';
                }

                // show flag
                if ( $flag_enable && $l['country_flag_url'] ) {
                    if ( $l['active'] ) {
                        $html .= ' data-imagesrc="' . esc_url( $l['country_flag_url'] ) . '"';
                    } else {
                        $html .= ' data-imagesrc="' . esc_url( $l['country_flag_url'] ) . '"';
                    }
                }

                // add link
                $html .= ' value="' . esc_url( $l['url'] ) . '">';

                // language name
                if ( function_exists( 'wpml_display_language_names_filter' ) ) {
                    $html .= wpml_display_language_names_filter( $l['native_name'], $l['translated_name'] );
                }

                $html .= '</option>';
            }

            if ( 'list' == $select_type ) {
                $html .= '<li><a href="' . esc_url( $l['url'] ) . '">';

                // show flag
                if ( $flag_enable && $l['country_flag_url'] ) {
                    $html .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '"/></span>';
                }

                // language name
                if ( function_exists( 'wpml_display_language_names_filter' ) ) {
                    $html .= wpml_display_language_names_filter( $l['native_name'], $l['translated_name'] );
                }

                $html .= '</a></li>';
            }
        }
    }
    ?>
    <div class="switcher language-switcher wpml-switcher<?php echo esc_attr( $flag_enable ? ' show-flag' : '' ); ?>">
        <?php
        // Drop down style
        if ( 'dropdown' == $select_type ) { ?>
            <select name="wpml-switcher" id="wpml-switcher">
                <?php echo '' . $html; ?>
            </select>
            <?php
        }

        // List style
        if ( 'list' == $select_type ) { ?>
            <ul id="language-switcher-menu" class="menu">
                <?php echo '' . $html; ?>
            </ul>
            <?php
        }
        ?>
    </div>
    <?php

    return ob_get_clean();
}

/**
 * Currency switcher
 * ==================
 */
function facewp_abbey_currency_switcher($menu_id) {
    ob_start();

    if ( ! class_exists( 'WooCommerce' ) ) {
        return '';
    }

    $currency_switcher_enable = Kirki::get_option( 'facewp-abbey', 'currency_switcher_enable' );

    if ( has_nav_menu( 'currency_switcher' ) ) {
        wp_nav_menu( array(
                         'theme_location'  => 'currency_switcher',
                         'menu_id'         => $menu_id,
                         'container_class' => 'switcher-menu currency-switcher-menu',
                         'depth'           => 2,
                         'fallback_cb'     => false,
                     ) );
    }

    // if install both WOOCS and woocommerce_wpml
    if ( class_exists( 'WOOCS' ) && class_exists( 'woocommerce_wpml' ) ) {
        $currency_switcher_enable = 0;
    }

    // WOOCS
    if ( $currency_switcher_enable && class_exists( 'WOOCS' ) ) {
        ?>
        <div class="switcher currency-switcher woocs-switcher">
            <?php echo do_shortcode( '[woocs show_flags=1 flag_position="left"]' ); ?>
        </div>
        <?php
    }

    if ( $currency_switcher_enable && class_exists( 'WCML_Multi_Currency_Support' ) ) {
        echo facewp_abbey_woo_wpml_switcher();
    }

    return ob_get_clean();
}

/**
 * Woocommerce WMPL Currency Switcher
 *
 * @return string
 */
function facewp_abbey_woo_wpml_switcher() {
    ob_start();

    global $sitepress, $woocommerce_wpml;

    // do not show in myaccount page
    if ( true || ! is_page( get_option( 'woocommerce_myaccount_page_id' ) ) ) {
        $wcml_settings = $woocommerce_wpml->get_settings();

        $switcher_style = isset( $wcml_settings['currency_switcher_style'] ) ? $wcml_settings['currency_switcher_style'] : 'dropdown';

        $format        = $wcml_settings['wcml_curr_template'] ? $wcml_settings['wcml_curr_template'] : '%symbol% %code%';
        $wc_currencies = get_woocommerce_currencies(); // default Woo currencies

        if ( ! isset( $wcml_settings['currencies_order'] ) ) {
            $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
        } else {
            $currencies = $wcml_settings['currencies_order'];
        }

        $html = '';

        foreach ( $currencies as $c ) {

            if ( $woocommerce_wpml->settings['currency_options'][ $c ]['languages'][ $sitepress->get_current_language() ] == 1 ) {
                $currency_format = preg_replace( array(
                                                     '#%name%#',
                                                     '#%symbol%#',
                                                     '#%code%#',
                                                 ), array(
                                                     $wc_currencies[ $c ],
                                                     get_woocommerce_currency_symbol( $c ),
                                                     $c,
                                                 ), $format );

                // Dropdown style
                if ( 'dropdown' == $switcher_style ) {

                    if ( $c == $woocommerce_wpml->multi_currency_support->get_client_currency() ) {
                        $html .= '<option selected="selected"';
                    } else {
                        $html .= '<option';
                    }

                    // add value
                    $html .= ' value="' . esc_attr( $c ) . '"';

                    // show text
                    $html .= '>' . $currency_format;


                    $html .= '</option>';
                }

                // List style
                if ( 'list' == $switcher_style ) {
                    $html .= '<li><a href="javascript:void(0)" data-currency="' . esc_attr( $c ) . '">';
                    // show text
                    $html .= $currency_format;
                    $html .= '</a></li>';
                }
            }
        }
        ?>
        <div class="switcher currency-switcher wcml-switcher">
            <?php

            // Dropdown style
            if ( 'dropdown' == $switcher_style ) {
                ?>
                <select name="wcml-switcher" id="wcml-switcher">
                    <?php echo '' . $html; ?>
                </select>

                <?php
            }

            // List style
            if ( 'list' == $switcher_style ) { ?>
                <ul id="currency-switcher-menu" class="menu">
                    <?php echo '' . $html; ?>
                </ul>
                <?php
            }
            ?>
        </div>
        <?php
    }

    return ob_get_clean();
}
//Remove CSS font-size from Widget Tag Cloud.
add_filter('wp_generate_tag_cloud', 'facewp_tag_cloud',10,3);

function facewp_tag_cloud($tag_string){
    return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}

/**
 * Position Author
 */
if ( ! function_exists( 'facewp_abbey_contactmethods' ) ) :

    function facewp_abbey_contactmethods( $contactmethods ) {

        $contactmethods['position']   = 'Position';

        return $contactmethods;
    }
endif;
add_filter('user_contactmethods','facewp_abbey_contactmethods',10,1);