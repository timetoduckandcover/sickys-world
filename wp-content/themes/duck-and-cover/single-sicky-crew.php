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
      <?php
				$image_single_id = get_field('single_crew_member_header_image');
				$image_single_size = 'single-size';
				$image_single_array = wp_get_attachment_image_src($image_single_id, $image_single_size);
				$image_single_url = $image_single_array[0];
			?>
      <?php
				$signature_id = get_field('signature');
				$signature_size = 'single-size';
				$signature_array = wp_get_attachment_image_src($signature_id, $signature_size);
				$signature_url = $signature_array[0];
			?>

      <?php if( get_field('single_crew_member_header_image') ): ?>
        <div class="sicky-single_hero">
          <img src="<?php echo $image_single_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full" />
        </div>
      <?php else : ?>
        <div class="push-empty-space"></div>
      <?php endif; ?>

      <div class="wrapper">
        <div class="row mb">
          <div class="col-xs-12 col-sm-4">
            <?php include('includes/share-buttons.php');?>
            <h1 class="gibson-light"><?php the_field('name');?></h1>
          </div>
          <div class="col-xs-12 col-sm-8">
            <?php the_field('custom_header_text');?>
          </div>
        </div>
        <h3 class="header-2"><?php the_field('job_title');?></h3>
        <p><?php the_content();?></p>
        <div class="text-center">
          <img src="<?php echo $signature_url; ?>" alt="" class="sicky-crew_signature" />
        </div>
        <br/><br/>
        <?php the_field('custom_content');?>
        <?php if( get_field('video') ): ?>
          <div class="video-wrapper">
            <iframe width="560" height="315" src="<?php the_field('video');?>" frameborder="0"></iframe>
          </div>
        <?php endif; ?>
        <?php dynamic_sidebar(get_field('instagram_feed'));?>
      </div>

    <?php endwhile; // End of the loop. ?>
  </div>
</main><!-- #main -->
<?php get_footer(); ?>
