<?php get_header(); ?>
<main id="main" class="site-main">
  <div class="sicky-single">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php
				$image_id = get_field('image');
				$image_size = 'single-size';
				$image_array = wp_get_attachment_image_src($image_id, $image_size);
				$image_url = $image_array[0];
			?>
      <div class="sicky-single_hero">
        <img src="<?php echo $image_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full" />
      </div>
      <div class="container">
        <h1><?php the_field('name');?></h1>
        <h3><?php the_field('job_title');?></h3>
        <p><?php the_content();?></p>
      </div>
    <?php endwhile; // End of the loop. ?>
  </div>
</main><!-- #main -->
<?php get_footer(); ?>
