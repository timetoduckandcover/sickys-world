<div class="footer-widget-container">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div>
            <div class="col-xs-12">
                <?php dynamic_sidebar( 'footer-2' ); ?>
            </div>
            <div class="col-xs-12">
                <?php if ( Kirki::get_option( 'infinity', 'footer_copyright_enable' ) == 1 ) : ?>
                    <div class="copyright">
                        <?php echo wp_kses_post( wp_specialchars_decode( Kirki::get_option( 'infinity', 'footer_copyright_content' ) ) ); ?>
                    </div><!-- .copyright -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>