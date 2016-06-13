<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php $args = array(
  'post_type' => 'email_new_acc',
  'posts_per_page' => 1
  );
  $the_query = new WP_Query( $args )
;?>
<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <?php if( get_field('custom_css') ): ?>
    <style>
      <?php the_field('custom_css');?>
    </style>
  <?php endif; ?>
  <?php if( get_field('banner_image') ): ?>
  <?php
    $image_id = get_field('banner_image');
    $image_size = 'full-size';
    $image_array = wp_get_attachment_image_src($image_id, $image_size);
    $image_url = $image_array[0];
  ?>
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="100%" style="width:100%;">
        <img src="<?php echo $image_url; ?>" alt="<?php echo $image['alt']; ?>" style="width:100%;display:block;height:auto;" />
      </td>
    </tr>
  </table>
  <?php endif; ?>
<?php endwhile; endif; ?>
<?php wp_reset_query(); ?>

<p><?php printf( __( "Thanks for creating an account on %s. Your username is <strong>%s</strong>.", 'woocommerce' ), esc_html( $blogname ), esc_html( $user_login ) ); ?></p>

<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>

	<p><?php printf( __( "Your password has been automatically generated: <strong>%s</strong>", 'woocommerce' ), esc_html( $user_pass ) ); ?></p>

<?php endif; ?>

<p><?php printf( __( 'You can access your account area to view your orders and change your password here: %s.', 'woocommerce' ), wc_get_page_permalink( 'myaccount' ) ); ?></p>

<?php do_action( 'woocommerce_email_footer', $email ); ?>
