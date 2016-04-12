<?php
get_header();
?>

<div class="container">
  <div class="row">
      <main id="main" class="site-main col-xs-12 <?php echo esc_attr( ( 'no-sidebar' != FaceWPC()->get( 'facewp_abbey_sidebar_position' ) && is_active_sidebar( FaceWPC()->get( 'facewp_abbey_sidebar' ) ) ) ? 'col-md-9' : '' ); ?>">

          <?php while ( have_posts() ) : the_post(); ?>
            <?php
    					$image_id = get_field('image');
    					$image_size = 'thumb-size';
    					$image_array = wp_get_attachment_image_src($image_id, $image_size);
    					$image_url = $image_array[0];
  					?>
            <img src="<?php echo $image_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full"/>
            <h1><?php the_field('name');?></h1>
            <h3><?php the_field('job_title');?></h3>
            <p>
              <?php the_content();?>
            </p>

          <?php endwhile; // End of the loop. ?>

      </main><!-- #main -->
    </div>
</div>
<?php get_footer(); ?>
