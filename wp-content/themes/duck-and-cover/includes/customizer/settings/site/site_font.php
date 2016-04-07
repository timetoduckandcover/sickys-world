<?php
/**
 * Site General
 * ================
 */
$section  = 'site_font';
$priority = 1;

//Font
Kirki::add_field( 'facewp', array(
    'type'     => 'typography',
    'setting'  => 'site_body_font',
    'label'    => esc_html__( 'Body', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => array(
        'font-family'    => BODY_FONT_FAMILY,
        'font-size'      => '16px',
        'font-weight'    => '300',
        'line-height'    => '1.8',
        'letter-spacing' => '0.03em',
    ),
    'choices'  => array(
        'font-style'     => false,
        'font-family'    => true,
        'font-size'      => true,
        'font-weight'    => true,
        'line-height'    => true,
        'letter-spacing' => true,
    ),
    'output'   => array(
        array(
            'element' => 'body, .product-title, .footer-widget-container .menu > .menu-item >a,.page-title,.entry-title,.no-comment .comment-reply-title,.mini_cart_item a,.widget_shopping_cart .empty,.vertical-menu .menu > .menu-item >a,.menu .sub-menu,.menu .children,#customer_login label.inline,.meta-text,.purchase-this-theme .icon-box-title',
        ),
        array(
            'element' => '.vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title .vc_tta-title-text',
        ),
        array(
            'element' => '.vc_toggle .vc_toggle_title h4',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'     => 'typography',
    'settings' => 'heading_font',
    'label'    => esc_html__( 'Heading Font', 'facewp-abbey' ),
    'section'  => $section,
    'priority' => $priority++,
    'default'  => array(
        'font-family'    => HEADING_FONT_FAMILY,
        'font-weight'    => '700',
        'font-style'     => array( 'bold', 'italic' ),
        'line-height'    => '1.8',
        'letter-spacing' => '0.1em',
    ),
    'choices'  => array(
        'font-style'     => true,
        'font-family'    => true,
        'font-size'      => false,
        'font-weight'    => true,
        'line-height'    => true,
        'letter-spacing' => true,
    ),
    'output'   => array(
        array(
            'element' => 'h1,h2,h3,h4,h5,h6,.heading-font,.menu > .menu-item >a,#header,.product-thumb .labels,.badge-out-of-stock,.price,.button,.post-author a,.posted-on time,.cat-links,.post-tags,.testimonial-container span[itemprop="name"],.testimonials-text:before,.facewp-product-tabs .nav-tabs a,.page-title-row .overlay-inner p,.navigation-product,.breadcrumbs .current,.woocommerce-ordering .orderby,.form-row label,.lost_password a,.pagination,.categories-overlay .count,.page-not-found .search-submit,.fwp-instag-follow,.amount,.images .labels,.out-of-stock,.yith-wcwl-add-to-wishlist a,.quantity,.variations .label,.product-socials-wrapper span,.wc-tabs a,#commentform label,#commentform .submit,#reviews .comment-text time[itemprop="datePublished"],.mc4wp-form input[type="submit"],.mega-menu > li > a,.vertical-menu .menu .vertical-more-link >a,.share-buttons-text,.post-simple-item .more-link,.author-info-position,.comments-area .post-date,.comments-area .comment-reply-link,.icon-box-read-more,.facewp-product-categories.style3 .product-category a',
        ),
        array(
            'element' => '.abbey-blog-posts.style4 .entry-content .more-link'
        ),
        // VC Tab Headings
        array(
            'element' => '.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab > a'
        )
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'slider',
    'setting'     => 'h1_font_size',
    'label'       => esc_html__( 'Font size', 'facewp-abbey' ),
    'description' => esc_html__( 'H1', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '28',
    'choices'     => array(
        'min'  => 10,
        'max'  => 90,
        'step' => 1,
    ),
    'transport'   => 'postMessage',
    'output'      => array(
        array(
            'element'  => 'h1',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
    'js_vars'     => array(
        array(
            'element'  => 'h1',
            'function' => 'css',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'slider',
    'setting'     => 'h2_font_size',
    'description' => esc_html__( 'H2', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '24',
    'choices'     => array(
        'min'  => 10,
        'max'  => 90,
        'step' => 1,
    ),
    'transport'   => 'postMessage',
    'output'      => array(
        array(
            'element'  => 'h2',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
    'js_vars'     => array(
        array(
            'element'  => 'h2',
            'function' => 'css',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'slider',
    'setting'     => 'h3_font_size',
    'description' => esc_html__( 'H3', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '20',
    'choices'     => array(
        'min'  => 10,
        'max'  => 90,
        'step' => 1,
    ),
    'transport'   => 'postMessage',
    'output'      => array(
        array(
            'element'  => 'h3',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
    'js_vars'     => array(
        array(
            'element'  => 'h3',
            'function' => 'css',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'slider',
    'setting'     => 'h4_font_size',
    'description' => esc_html__( 'H4', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '16',
    'choices'     => array(
        'min'  => 10,
        'max'  => 90,
        'step' => 1,
    ),
    'transport'   => 'postMessage',
    'output'      => array(
        array(
            'element'  => 'h4',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
    'js_vars'     => array(
        array(
            'element'  => 'h4',
            'function' => 'css',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'slider',
    'setting'     => 'h5_font_size',
    'description' => esc_html__( 'H5', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => '14',
    'choices'     => array(
        'min'  => 10,
        'max'  => 90,
        'step' => 1,
    ),
    'transport'   => 'postMessage',
    'output'      => array(
        array(
            'element'  => 'h5',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
    'js_vars'     => array(
        array(
            'element'  => 'h5',
            'function' => 'css',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
) );

Kirki::add_field( 'facewp', array(
    'type'        => 'slider',
    'setting'     => 'h6_font_size',
    'description' => esc_html__( 'H6', 'facewp-abbey' ),
    'section'     => $section,
    'priority'    => $priority++,
    'default'     => 12,
    'choices'     => array(
        'min'  => 10,
        'max'  => 90,
        'step' => 1,
    ),
    'transport'   => 'postMessage',
    'output'      => array(
        array(
            'element'  => 'h6',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
    'js_vars'     => array(
        array(
            'element'  => 'h6',
            'function' => 'css',
            'property' => 'font-size',
            'units'    => 'px',
        ),
    ),
) );