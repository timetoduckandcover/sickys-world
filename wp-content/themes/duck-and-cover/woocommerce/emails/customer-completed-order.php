<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php $args = array(
  'post_type' => 'email_order_com',
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

<p><?php printf( __( "Hi there. Your recent order on %s has been completed. Your order details are shown below for your reference:", 'woocommerce' ), get_option( 'blogname' ) ); ?></p>

<?php

/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
