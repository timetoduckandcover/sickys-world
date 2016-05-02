<?php
/**
 * Duck and cover layout
 *
 * @package FaceWP
 */
?>
<article class="col-xs-12 col-sm-6 col-md-4" id="post-<?php the_ID(); ?>" <?php post_class( 'post-simple-item' ); ?>>
  <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
  <a href="<?php echo get_permalink() ?>" class="blog-list-image-square">
    <?php the_post_thumbnail();?>
  </a>
  <div class="post-meta">
    <?php
      $fname = get_the_author_meta('first_name');
      $lname = get_the_author_meta('last_name');
      $full_name = '';
      if( empty($fname)){
        $full_name = $lname;
      } elseif( empty( $lname )){
        $full_name = $fname;
      } else {
        //both first name and last name are present
        $full_name = "{$fname} {$lname}";
      }
    ?>
    <h6 class="uppercase post-meta-date"><?php the_date(); ?></h6>
  </div>
  <h4 class="uppercase"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
  <p><?php echo substr(wp_strip_all_tags( get_the_content() ),0,100); ?>...</p>
  <div class="blog-meta-footer">
    <a href="<?php echo get_permalink() ?>" class="read-more button-transparent"><?php esc_html_e( 'Read More', 'facewp-abbey' ); ?></a>
  </div>
</article>
