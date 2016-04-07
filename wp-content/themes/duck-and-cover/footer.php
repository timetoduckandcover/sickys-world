<?php
/**
 * @package FaceWPs
 */
?>
        </div> <!-- / .row -->
    </div> <!-- / .main-content -->
</div><!-- #page -->
<footer class="site-footer <?php echo esc_attr( Kirki::get_option( 'facewp', 'footer_type' ));?>">
    <?php require_once( get_template_directory() . '/footer/' . Kirki::get_option( 'facewp', 'footer_type' ) . '.php' ); ?>
</footer>
</div>
<?php if ( Kirki::get_option( 'facewp', 'footer_back_to_top_enable' ) == 1 ) : ?>
    <a class="scrollup"><span class="pe-7s-angle-up"></span></a>
<?php endif; ?>
<?php do_action( 'facewp_abbey_after_footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
