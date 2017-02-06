<?php
/**
 * @package FaceWPs
 */
?>
        </div> <!-- / .row -->
    </div> <!-- / .main-content -->
</div><!-- #page -->
<footer class="site-footer <?php echo esc_attr( Kirki::get_option( 'facewp', 'footer_type' ));?>">
  <div class="wrapper">
    <div class="footer-inner">
      <div class="row">
        <div class="col-xs-12">
          <ul class="footer-social">
            <li>
              <a href="https://www.instagram.com/sicky/" target="_blank">
                <i class="fa fa-instagram"></i>
              </a>
            </li>
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
              <a href="https://vimeo.com/sickysworld" target="_blank">
                <i class="fa fa-vimeo"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-3">
          <h4 class="uppercase gibson-semibold">Legal</h4>
          <?php $args = array( 'menu' => 'footer-menu-1');
          wp_nav_menu( $args ); ?>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h4 class="uppercase gibson-semibold">Account</h4>
          <?php $args = array( 'menu' => 'footer-menu-2');
          wp_nav_menu( $args ); ?>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h4 class="uppercase gibson-semibold">More Sicky</h4>
          <?php $args = array( 'menu' => 'footer-menu-3');
          wp_nav_menu( $args ); ?>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h4 class="uppercase gibson-semibold">Join The Movement</h4>
          <!-- Begin MailChimp Signup Form -->
          <aside class="widget">
            <div id="mc_embed_signup">
            <form action="//sickysworld.us6.list-manage.com/subscribe/post?u=c7c2970520d9777ddd5f5f245&amp;id=1f12d1e387" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">
            	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Your email address">
            	<div id="mce-responses" class="clear">
            		<div class="response" id="mce-error-response" style="display:none"></div>
            		<div class="response" id="mce-success-response" style="display:none"></div>
            	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_c7c2970520d9777ddd5f5f245_1f12d1e387" tabindex="-1" value=""></div>
                <div class="clear"><input type="submit" value="Sign Up" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
            </div>
            <script type='text/javascript' async src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script async type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='MMERGE3';ftypes[3]='imageurl';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
          </aside>
          <!--End mc_embed_signup-->
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
