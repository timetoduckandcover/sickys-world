<?php get_header(); ?>
<main id="main" class="site-main">
  <div class="lookbooks-single">
    <?php while ( have_posts() ) : the_post(); ?>

      <?php
				$image_id = get_field('hero_image');
				$image_size = 'full-size';
				$image_array = wp_get_attachment_image_src($image_id, $image_size);
				$image_url = $image_array[0];
			?>

      <div class="lookbooks-single_hero">
        <img src="<?php echo $image_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full" />
      </div>
      <div class="wrapper">
        <p><?php the_content();?></p>
      </div>

    <?php endwhile; // End of the loop. ?>
  </div>
</main><!-- #main -->
<?php get_footer(); ?>
