<?php
/*
Template Name: Celeb Wears
*/
?>
<?php get_header(); ?>
    <div class="content-wrapper">
      <main class="content celebwears-all">

          <?php while ( have_posts() ) : the_post(); ?>
            <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
            <div class="hero" style="background-image:url(<?php echo $url; ?>)">
              <div class="caption">
                <div class="caption-inner">
                  <h1><?php the_title();?></h1>
                </div>
              </div>
            </div>
        <div class="container">
            <?php the_content();?>
          <?php endwhile; // end of the loop. ?>

          <?php
            //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
              'post_type' => 'celeb-wears',
              'posts_per_page' => -1
              //'paged' => $paged
            );
      			$the_query = new WP_Query( $args )
          ;?>
          <ul class="row">
      			<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
              <?php
      					$image_id = get_field('image_thumbnail');
      					$image_size = 'custom-crop';
      					$image_array = wp_get_attachment_image_src($image_id, $image_size);
      					$image_url = $image_array[0];
    					?>
              <li class="col-xs-12 col-sm-6 col-md-3">
                <a href="<?php the_permalink();?>">
                  <img src="<?php echo $image_url; ?>" alt="" class="img-full" />
                  <?php the_post_thumbnail();?>
                  <div class="caption">
                    <div class="caption-inner">
                      <h4 class="uppercase" style="color:#fff !important"><?php the_field('name') ;?></h4>
                      <h5 class="uppercase" style="color:#fff !important"><?php the_field('frame_name');?></h5>
                    </div>
                  </div>
                </a>
              </li>
      			<?php endwhile; endif; ?>
          </ul>
        </div>
      </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
