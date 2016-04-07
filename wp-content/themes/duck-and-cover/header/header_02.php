<header id="header" class="header-02 boxed <?php echo esc_attr( facewp_abbey_get_overlay_header() ? 'header-overlay' : '' ); ?>">
    <div class="container hidden-md-up">
        <div class="row row-xs-center">
            <div id="logo" class="col-xs-6 start-xs">
                <?php
                $facewp_abbey_logo        = Kirki::get_option( 'facewp', 'site_logo' );
                $facewp_abbey_logo_retina = Kirki::get_option( 'facewp', 'site_logo_retina' );
                if ( $facewp_abbey_logo ) {
                    ?>
                    <?php if( is_front_page() ) : ?>
                        <h1>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
                                <img src="<?php echo esc_url( $facewp_abbey_logo ); ?>" <?php if ( $facewp_abbey_logo_retina ) { ?> srcset="<?php echo esc_url( $facewp_abbey_logo_retina ); ?> 2x" <?php } ?> alt="<?php bloginfo( 'name' ); ?>" />
                            </a>
                        </h1>
                    <?php else : ?>
                        <h2>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
                                <img src="<?php echo esc_url( $facewp_abbey_logo ); ?>" <?php if ( $facewp_abbey_logo_retina ) { ?> srcset="<?php echo esc_url( $facewp_abbey_logo_retina ); ?> 2x" <?php } ?> alt="<?php bloginfo( 'name' ); ?>" />
                            </a>
                        </h2>
                    <?php endif; ?>
                <?php } ?>
            </div>
            <div class="col-xs-6 hidden-md-up end-xs mobile-right">
                <?php facewp_abbey_cart_link() ?>
                <i id="mobile-menu-toggle" class="fa fa-navicon hidden-lg-up"></i>
            </div>
        </div>
    </div>
    <div class="container header-top hidden-sm-down">
        <div class="row row-xs-center">
            <div class="col-md-7 start-xs">
                <?php echo html_entity_decode( Kirki::get_option( 'facewp', 'header_contact_info' ) ); ?>
            </div>

            <div class="col-md-5 end-xs">
                <?php facewp_abbey_cart_link() ?>
                <div id="header-search" class="search-type-1 header-item">
                    <span id="js-search-overlay" class="icon-header pe-7s-search"></span>
                </div>
	            <?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
	                <a class="header-item" href="<?php echo esc_url( YITH_WCWL::get_instance()->get_wishlist_url() ); ?>"><span class="icon-header pe-7s-like"></span></a>
	            <?php endif; ?>
	            <a class="header-item" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><span class="icon-header pe-7s-user"></span></a>
                <?php
                $facewp_abbey_language_switcher = facewp_abbey_language_switcher('language-switcher-menu');
                if ( $facewp_abbey_language_switcher ) {
                    ?>
                    <div class="switchers-wrap">
                        <?php echo '' . $facewp_abbey_language_switcher; ?>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
    <div class="container header-middle hidden-sm-down">
        <div class="row row-xs-center">
            <div id="logo" class="col-xs-12 center-xs">
                <?php
                $facewp_abbey_logo        = Kirki::get_option( 'facewp', 'site_logo' );
                $facewp_abbey_logo_retina = Kirki::get_option( 'facewp', 'site_logo_retina' );
                if ( $facewp_abbey_logo ) {
                    ?>
                    <?php if( is_front_page() ) : ?>
                        <h1><img src="<?php echo esc_url( $facewp_abbey_logo ); ?>" <?php if ( $facewp_abbey_logo_retina ) { ?> srcset="<?php echo esc_url( $facewp_abbey_logo_retina ); ?> 2x" <?php } ?> alt="<?php bloginfo( 'name' ); ?>" /></h1>
                    <?php else : ?>
                        <h2><img src="<?php echo esc_url( $facewp_abbey_logo ); ?>" <?php if ( $facewp_abbey_logo_retina ) { ?> srcset="<?php echo esc_url( $facewp_abbey_logo_retina ); ?> 2x" <?php } ?> alt="<?php bloginfo( 'name' ); ?>" /></h2>
                    <?php endif; ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container header-nav hidden-sm-down">
        <div class="row row-xs-center">
            <div class="col-md-12 center-xs">
                <nav class="nav-main">
                    <?php
                    if ( class_exists( 'FaceWP_Abbey_Type1_Walker_Nav_Menu' ) && has_nav_menu( 'primary' ) ) {
                        $facewp_primary_menu = array(
                            'menu_class'     => 'menu menu-horizontal',
                            'menu_id'        => 'primary-menu',
                            'walker'          => new FaceWP_Abbey_Type1_Walker_Nav_Menu(),
                        );

                        if ( is_page() && $primary_menu_meta = get_post_meta( get_the_ID(), 'facewp_abbey_primary_menu', true ) ) {
                            $facewp_primary_menu['menu'] = $primary_menu_meta;
                        } else {
                            $facewp_primary_menu['theme_location'] = 'primary';
                        }

                        wp_nav_menu( $facewp_primary_menu );
                    } else {
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'menu menu-horizontal',
                            'menu_id'        => 'primary-menu',
                        ) );
                    }
                    ?>
                </nav>
            </div>
        </div>
    </div>
</header>

<div class="full-screen-search-container">
    <a class="full-screen-search-close"><i class="fa fa-times"></i></a>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-xs-center center-xs">
                <form name="search-form" role="search" method="get" class="search-form animated" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="row">
                        <div class="col-sm-3 start-xs end-md">
                            <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'facewp-abbey' ); ?></span>
                            <span class="search-label"><?php echo _x( 'Search:', 'label', 'facewp-abbey' ); ?></span>
                        </div>
                        <div class="col-md-6">
                            <input type="search" class="search-field" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'facewp-abbey' ); ?>" />
                        </div>
                        <div class="col-md-3 start-xs">
                            <span class="search-button">
                                <i class="fa fa-search"></i>
                                <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'facewp-abbey' ); ?>" />
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>