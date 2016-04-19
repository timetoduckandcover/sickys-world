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
            <div class="hero">
              <img src="<?php echo $url; ?>" class="img-full" alt="Celeb Wears Hero Image" />
              <div class="caption">
                <div class="container">
                  <h1><?php the_title();?></h1>
                </div>
              </div>
            </div>
        <div class="container">
            <?php the_content();?>
          <?php endwhile; // end of the loop. ?>

          <?php $args = array( 'post_type' => 'celeb-wears' );
    			      $the_query = new WP_Query( $args ) ;?>
          <ul class="row">
      			<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
              <?php
      					$image_id = get_field('image_thumbnail');
      					$image_size = 'full-size';
      					$image_array = wp_get_attachment_image_src($image_id, $image_size);
      					$image_url = $image_array[0];
    					?>
              <li class="col-xs-12 col-sm-6 col-md-3">
                <a href="<?php the_permalink();?>">
                  <img src="<?php echo $image_url; ?>" alt="" class="img-full" />
                  <div class="caption">
                    <div class="caption-inner">
                      <h3><?php the_field('name') ;?></h3>
                      <h4><?php the_field('frame_name');?></h4>
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
