<?php
/*
Template Name: Crew
*/
?>
<?php get_header(); ?>
    <div class="content-wrapper">
      <main class="content site-main">

        <?php $args = array( 'post_type' => 'crew' );
  			      $the_query = new WP_Query( $args )
        ;?>

  			<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

          <?php
  					$image_id = get_field('image');
  					$image_size = 'single-size';
  					$image_array = wp_get_attachment_image_src($image_id, $image_size);
  					$image_url = $image_array[0];
					?>

          <?php the_field('name');?>
          <img src="<?php echo $image_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full"/>
          <?php the_field('job_title');?>
          <?php the_content();?>
          
  			<?php endwhile; endif; ?>

      </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
