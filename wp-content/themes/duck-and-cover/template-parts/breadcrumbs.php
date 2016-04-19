<div class="container breadcrumb-row">
    <div class="row">
        <div class="col-md-7 start-xs">
            <?php if ( Kirki::get_option( 'facewp', 'site_breadcrumb_enable' ) == 1 ) : ?>
                <?php woocommerce_breadcrumb(); ?>
            <?php endif; ?>
        </div>

        <?php if ( have_posts() ) : ?>
            <div class="col-md-5 end-xs">
                <?php
                /**
                 * woocommerce_before_shop_loop hook
                 *
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
