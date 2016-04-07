<div class="footer-widget-container">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-2">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <?php dynamic_sidebar( 'footer-2' ); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <?php dynamic_sidebar( 'footer-3' ); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-2">
                <?php dynamic_sidebar( 'footer-4' ); ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <?php dynamic_sidebar( 'footer-5' ); ?>
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <?php if ( Kirki::get_option( 'facewp', 'footer_copyright_enable' ) == 1 ) : ?>
                    <div class="copyright">
                        <?php echo wp_kses_post( wp_specialchars_decode( Kirki::get_option( 'facewp', 'footer_extra_info_content' ) ) ); ?>
                    </div><!-- .copyright -->
                <?php endif; ?>
            </div>
            <div class="col-md-4 col-xs-12 end-md">
                <?php if ( Kirki::get_option( 'facewp', 'footer_extra_info_enable' ) == 1 ) : ?>
                    <div class="copyright">
                        <?php echo wp_kses_post( wp_specialchars_decode( Kirki::get_option( 'facewp', 'footer_copyright_content' ) ) ); ?>
                    </div><!-- .copyright -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>