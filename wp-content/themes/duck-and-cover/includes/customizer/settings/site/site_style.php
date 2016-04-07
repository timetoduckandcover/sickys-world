<?php
$section  = 'site_style';
$priority = 1;

Kirki::add_field( 'facewp', array(
    'type'     => 'color',
    'setting'  => 'site_primary_color',
    'label'    => esc_html__( 'Primary Color', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => PRIMARY_COLOR,
    'output'   => array(
        array(
            'element'  => 'body, .primary-button,.primary-button:hover,.product-title a, .facewp-product-tabs .nav-tabs .active a, .facewp-product-tabs .nav-tabs li:hover a,.mini_cart_item .quantity .amount,.page-title-row .product-category a:hover .overlay-inner p,.star-rating span:before,.wc-tabs .active a,#reviews .commentlist .comment_container .star-rating span:before,.quote p,.pagination .next span,.pagination .prev span,.loop-pagination .next:before,.loop-pagination .prev:before',
            'property' => 'color',
        ),
        array(
            'element'  => '.reverse,.page-not-found .search-submit,.facewp-product-categories .categories-overlay:hover,.coupon,.widget_price_filter .price_slider .ui-slider-range,.wc-tabs .active a:before,#commentform .submit',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.primary-button,.page-not-found input[type="search"],.page-not-found .search-submit,.facewp-product-categories .overlay-inner,.widget_price_filter .ui-slider .ui-slider-handle,.variations .value select,.scrollup',
            'property' => 'border-color',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'color',
    'setting'  => 'site_secondary_color',
    'label'    => esc_html__( 'Secondary Color', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => SECONDARY_COLOR,
    'output'   => array(
        array(
            'element'  => '.secondary,.product-category-name a,.product-category-name a:visited,.product .star-rating:before,.facewp-product-tabs .nav-tabs a,.mini_cart_item .quantity,.facewp-product-categories .categories-overlay .count,.page-title-row .overlay-inner p,.pagination a,.pagination a:visited,.wc-tabs a,.product-socials-wrapper span,#reviews .comment-text time[itemprop="datePublished"],.share-buttons-text,.author-info-position,.comments-area .post-date',
            'property' => 'color',
        ),
        array(
            'element'  => 'blockquote',
            'property' => 'border-color',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'color',
    'setting'   => 'heading_color',
    'label'     => esc_html__( 'Heading Color', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => PRIMARY_COLOR,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => 'h1,h2,h3,h4,h5,h6',
            'property' => 'color',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => 'h1,h2,h3,h4,h5,h6',
            'function' => 'css',
            'property' => 'color',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'color',
    'setting'   => 'link_color',
    'label'     => esc_html__( 'Link Color', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => PRIMARY_COLOR,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => 'a, a:visited',
            'property' => 'color',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => 'a, a:visited',
            'function' => 'css',
            'property' => 'color',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'color',
    'setting'   => 'link_color_hover',
    'label'     => esc_html__( 'Link Hover Color', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => LINK_HOVER_COLOR,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => 'a:hover, .site-footer .facewp-social-widget a:hover',
            'property' => 'color',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => 'a:hover, .site-footer .facewp-social-widget a:hover',
            'function' => 'css',
            'property' => 'color',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'color',
    'setting'   => 'button_color',
    'label'     => esc_html__( 'Button Color', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => PRIMARY_COLOR,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.secondary-button',
            'property' => 'background-color',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => '.secondary-button',
            'function' => 'css',
            'property' => 'background-color',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'      => 'color',
    'setting'   => 'button_color_hover',
    'label'     => esc_html__( 'Button Hover Color', 'facewp-abbey' ),
    'section'   => $section,
    'priority'  => $priority++,
    'default'   => LINK_HOVER_COLOR,
    'transport' => 'postMessage',
    'output'    => array(
        array(
            'element'  => '.secondary-button:hover',
            'property' => 'background-color',
        ),
    ),
    'js_vars'   => array(
        array(
            'element'  => '.secondary-button:hover',
            'function' => 'css',
            'property' => 'background-color',
        ),
    ),
) );

