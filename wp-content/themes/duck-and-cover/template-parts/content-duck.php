<?php
/**
 * Duck and cover layout
 *
 * @package FaceWP
 */
?>
<article class="col-xs-12 col-sm-6 col-md-4" id="post-<?php the_ID(); ?>" <?php post_class( 'post-simple-item' ); ?>>
  <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
  <img src="<?php echo $url; ?>" class="img-full" alt="Text_2" />
  <h3 class="uppercase"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
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
    <!-- <span class="post-meta-by">by</span>
    <span class="uppercase post-meta-name"><?php echo $full_name;?></span> -->
    <span class="uppercase post-meta-date"><?php the_date(); ?></span>
  </div>
  <p><?php echo substr(wp_strip_all_tags( get_the_content() ),0,100); ?>...</p>
  <div class="blog-meta-footer">
    <a href="<?php echo get_permalink() ?>" class="read-more button"><?php esc_html_e( 'Read More', 'facewp-abbey' ); ?></a>
  </div>
</article>
