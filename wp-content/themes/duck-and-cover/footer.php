<?php
/**
 * @package FaceWPs
 */
?>
        </div> <!-- / .row -->
    </div> <!-- / .main-content -->
</div><!-- #page -->
<footer class="site-footer <?php echo esc_attr( Kirki::get_option( 'facewp', 'footer_type' ));?>">
  <div class="container boxed">
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        <?php $args = array( 'menu' => 'footer-menu-1',);
        wp_nav_menu( $args ); ?>
      </div>
      <div class="col-xs-12 col-sm-4">
        <?php $args = array( 'menu' => 'footer-menu-2',);
        wp_nav_menu( $args ); ?>
      </div>
      <div class="col-xs-12 col-sm-4">
        mailchimp here
      </div>
    </div>
  </div>
</footer>
</div>
<?php if ( Kirki::get_option( 'facewp', 'footer_back_to_top_enable' ) == 1 ) : ?>
    <a class="scrollup"><span class="pe-7s-angle-up"></span></a>
<?php endif; ?>
<?php do_action( 'facewp_abbey_after_footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
