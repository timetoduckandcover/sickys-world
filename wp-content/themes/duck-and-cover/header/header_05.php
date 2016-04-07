<header id="header" class="header-05 boxed <?php echo esc_attr( facewp_abbey_get_overlay_header() ? 'header-overlay' : '' ); ?>">
    <div class="container hidden-md-up">
        <div class="row row-xs-center">
            <div id="logo" class="col-xs-6 start-xs">
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
            <div class="col-xs-6 hidden-md-up end-xs mobile-right">
                <?php facewp_abbey_cart_link() ?>
                <i id="mobile-menu-toggle" class="fa fa-navicon hidden-lg-up"></i>
            </div>
        </div>
    </div>
    <div class="container header-top hidden-sm-down">
        <div class="row row-xs-center">
            <div class="col-md-7 start-xs">
                <?php
                $facewp_abbey_language_switcher = facewp_abbey_language_switcher('language-switcher-menu');
                $facewp_abbey_currency_switcher = facewp_abbey_currency_switcher('currency-switcher-menu');
                if ( $facewp_abbey_language_switcher || $facewp_abbey_currency_switcher ) {
                    ?>
                    <div class="switchers-wrap">
                        <?php echo '' . $facewp_abbey_currency_switcher; ?>
                        <?php echo '' . $facewp_abbey_language_switcher; ?>
                    </div>
                <?php } ?>
                <?php echo html_entity_decode( Kirki::get_option( 'facewp', 'header05_welcome_text' ) ); ?>
            </div>

            <div class="col-md-5 end-xs">
                <a class="header-item" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><span class="icon-header pe-7s-user"></span></a>
	            <?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
		            <a class="header-item" href="<?php echo esc_url( YITH_WCWL::get_instance()->get_wishlist_url() ); ?>"><span class="icon-header pe-7s-like"></span></a>
	            <?php endif; ?>
	            <?php echo facewp_abbey_social_links(); ?>
            </div>

        </div>
    </div>
    <div class="container header-middle hidden-sm-down">
        <div class="row row-xs-center">
            <div id="logo" class="col-md-3 start-xs">
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
            <div class="col-md-6 end-xs">
                <?php echo html_entity_decode( Kirki::get_option( 'facewp', 'header05_contact_info' ) ); ?>
            </div>
            <div class="col-md-3 end-xs">
                <?php facewp_abbey_cart_link() ?>
            </div>
        </div>
    </div>
    <div class="container hidden-sm-down">
        <div class="row row-xs-center">
            <div class="col-md-3">
                <nav class="menu-side-container toggle-menu open">
                    <h2 class="heading style2 reverse">
                        <span><?php echo esc_html( Kirki::get_option( 'facewp', 'header_vertical_menu_heading_text' ) ); ?></span>
                    </h2>
                    <?php
                    if ( class_exists( 'FaceWP_Abbey_Type1_Walker_Nav_Menu' ) ) {
                        $facewp_primary_menu = array(
                            'menu_class'     => 'menu menu-vertical',
                            'menu_id'        => 'menu-side',
                            'container_class'=> 'toggle-menu-wrap',
                            'walker'          => new FaceWP_Abbey_Type1_Walker_Nav_Menu(),
                        );

                        if ( is_page() && $primary_menu_meta = get_post_meta( get_the_ID(), 'facewp_abbey_primary_menu', true ) ) {
                            $facewp_primary_menu['menu'] = $primary_menu_meta;
                        } else {
                            $facewp_primary_menu['theme_location'] = 'primary';
                        }

                        wp_nav_menu( $facewp_primary_menu );
                    }
                    ?>
                </nav>
            </div>
            <div class="col-md-9 col-no-padding move-left-15">
                <div id="header-search" class="search-type-3">
                    <?php echo facewp_abbey_get_search_form(); ?>
                    <span id="search-overlay" class="icon-header pe-7s-search"></span>
                </div>
            </div>

        </div>
    </div>
</header>