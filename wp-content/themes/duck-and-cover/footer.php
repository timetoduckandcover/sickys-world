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
    <div class="footer-inner">
      <div class="row">
        <div class="col-xs-12">
          <ul class="footer-social">
            <li>
              <a href="https://www.facebook.com/sickysworld/" target="_blank">
                <i class="fa fa-facebook"></i>
              </a>
            </li>
            <li>
              <a href="https://twitter.com/SickysWorld" target="_blank">
                <i class="fa fa-twitter"></i>
              </a>
            </li>
            <li>
              <a href="https://uk.pinterest.com/sickysworld/" target="_blank">
                <i class="fa fa-pinterest"></i>
              </a>
            </li>
            <li>
              <a href="https://www.instagram.com/sickysworld/" target="_blank">
                <i class="fa fa-instagram"></i>
              </a>
            </li>
            <li>
              <a href="https://vimeo.com/sickysworld" target="_blank">
                <i class="fa fa-vimeo"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-4">
          <h4 class="uppercase gibson-semibold">Legal</h4>
          <?php $args = array( 'menu' => 'footer-menu-1',);
          wp_nav_menu( $args ); ?>
        </div>
        <div class="col-xs-12 col-sm-4">
          <h4 class="uppercase gibson-semibold">Account</h4>
          <?php $args = array( 'menu' => 'footer-menu-2',);
          wp_nav_menu( $args ); ?>
        </div>
        <div class="col-xs-12 col-sm-4">
          <h4 class="uppercase gibson-semibold">Newsletter</h4>
          <?php dynamic_sidebar('Mailchimp Signup');?>
        </div>
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
