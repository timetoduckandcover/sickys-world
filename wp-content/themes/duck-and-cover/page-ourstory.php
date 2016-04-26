<?php
/*
Template Name: Our Story
*/
?>
<?php get_header(); ?>
    <div class="content-wrapper">
      <main class="content">
        <div id="our-story">
    			<?php while ( have_posts() ) : the_post(); ?>
            <?php
              $image_id = get_field('header_image');
              $image_size = 'full-size';
              $image_array = wp_get_attachment_image_src($image_id, $image_size);
              $image_url = $image_array[0];
            ?>
            <div class="our-story-header-image">
              <img src="<?php echo $image_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full" />
            </div>
            <div class="our-story-first-section text-center">
              <div class="wrapper wrapper-padded">
                <?php the_field('first_section');?>
              </div>
            </div>
            <div class="our-story-second-section text-center">
              <div class="wrapper wrapper-padded">
                <?php the_field('second_section');?>
              </div>
            </div>
            <div class="our-story-third-section text-center">
              <div class="wrapper wrapper-padded">
                <?php the_field('third_section');?>
              </div>
            </div>
    			<?php endwhile; // end of the loop. ?>
        </div>
      </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>