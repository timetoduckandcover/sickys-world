<?php
/*
Template Name: Landing Page
*/
?>
<?php get_header(); ?>
    <div class="content-wrapper">
        <main class="content site-main">
          <div class="landing-page">
            <?php if ( !is_cart() || !is_woocommerce()) { ?>
              <!-- <h1><?php the_title();?></h1> -->
            <?php } ;?>
            <?php while ( have_posts() ) : the_post(); ?>
              <?php
      					$image_id = get_field('hero_image');
      					$image_size = 'full-size';
      					$image_array = wp_get_attachment_image_src($image_id, $image_size);
      					$image_url = $image_array[0];
    					?>
              <div class="landing-page-hero">
                <img src="<?php echo $image_url; ?>" alt="" class="img-full" />
                <h1 class="duck-collection-header-title"><?php the_field('hero_title');?></h1>
              </div>

              <div class="wrapper wrapper-padded">
                <?php the_content();?>
              </div>
              <?php endwhile; // end of the loop. ?>
            </div>
        </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
