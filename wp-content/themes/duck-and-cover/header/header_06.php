<header id="header" class="header-06 <?php echo esc_attr( facewp_abbey_get_overlay_header() ? 'header-overlay' : '' ); ?>">
    <div class="container">
        <div class="row center-xs">
            <?php
            $facewp_abbey_language_switcher = facewp_abbey_language_switcher('language-switcher-menu');
            $facewp_abbey_currency_switcher = facewp_abbey_currency_switcher('currency-switcher-menu');
            if ( $facewp_abbey_language_switcher || $facewp_abbey_currency_switcher ) {
                ?>
            <div class="col-xs-12">
                <div class="switchers-wrap">
                    <?php echo '' . $facewp_abbey_currency_switcher; ?>
                    <?php echo '' . $facewp_abbey_language_switcher; ?>
                </div>
            </div>
            <?php } ?>

            <div id="logo" class="col-xs-12">
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

            <div class="col-md-12 header-left-cart">
                <?php facewp_abbey_cart_link() ?>
            </div>

            <div class="col-md-12 start-xs">
                <nav class="primary-menu-container">
                    <?php
                    if ( class_exists( 'FaceWP_Abbey_Type1_Walker_Nav_Menu' ) && has_nav_menu( 'primary' ) ) {
                        $facewp_primary_menu = array(
                            'menu_class'     => 'menu menu-vertical',
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
                            'theme_location' => 'primary menu-vertical',
                            'menu_class'     => 'menu',
                            'menu_id'        => 'primary-menu',
                        ) );
                    }
                    ?>
                </nav>
            </div>

            <div id="header-search" class="search-type-2 col-md-12">
                <?php echo facewp_abbey_get_search_form(); ?>
            </div>

            <div class="col-md-12">
                <a class="header-item" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><span class="icon-header pe-7s-user"></span></a>
	            <?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
                    <a class="header-item" href="<?php echo esc_url( YITH_WCWL::get_instance()->get_wishlist_url() ); ?>"><span class="icon-header pe-7s-like"></span></a>
	            <?php endif; ?>
                <a href="#">About Us</a>
            </div>

        </div>
    </div>
    <div class="header-left-bottom container">
        <div class="row">
            <div class="col-md-12 start-xs">
                <?php echo html_entity_decode( Kirki::get_option( 'facewp', 'header06_contact_info' ) ); ?>
            </div>

            <div class="col-md-12">
                <?php echo facewp_abbey_social_links(); ?>
            </div>

            <div class="col-md-12">
                <?php echo html_entity_decode( Kirki::get_option( 'facewp', 'header06_footer_text' ) ); ?>
            </div>
        </div>
    </div>
</header>