<?php get_header(); ?>
<main id="main" class="site-main">
  <div class="container">
    <div class="celebwears-single">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php
  				$image_id = get_field('hero_image');
  				$image_size = 'full-size';
  				$image_array = wp_get_attachment_image_src($image_id, $image_size);
  				$image_url = $image_array[0];
  			?>
        <div class="celebwears-single_hero">
          <div class="celebwears-single_hero-inner">
            <img src="<?php echo $image_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full" />
          </div>
          <h1><?php the_field('name');?></h1>
          <h3><?php the_field('frame_name');?></h3>
          <div class="celebwears-single_share">
            <span>Share</span>
            <span><?php include('includes/share-buttons.php');?></span>
          </div>
        </div>
        <p><?php the_content();?></p>
      <?php endwhile; // End of the loop. ?>
    </div>
  </div>
</main><!-- #main -->
<?php get_footer(); ?>
