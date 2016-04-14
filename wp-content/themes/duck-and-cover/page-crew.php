<?php
/*
Template Name: Crew
*/
?>
<?php get_header(); ?>
    <div class="content-wrapper">
      <main class="content">

        <?php $args = array( 'post_type' => 'sicky-crew' );
  			      $the_query = new WP_Query( $args ) ;?>
        <ul class="row sicky-crew-all">
    			<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <?php
    					$image_id = get_field('image');
    					$image_size = 'full-size';
    					$image_array = wp_get_attachment_image_src($image_id, $image_size);
    					$image_url = $image_array[0];
  					?>
            <?php
    					$signature_id = get_field('signature');
    					$signature_size = 'single-size';
    					$signature_array = wp_get_attachment_image_src($signature_id, $signature_size);
    					$signature_url = $signature_array[0];
  					?>

            <li class="col-xs-12" style="background-image:url(<?php echo $image_url; ?>)">
              <div class="wrapper">
                <div class="sicky-crew-member" style="text-align:<?php the_field('alignment');?>">
                  <h4><?php the_field('job_title');?></h4>
                  <img src="<?php echo $signature_url; ?>" alt="" class="sicky-crew_signature" />
                  <h3><?php the_field('name');?></h3>
                  <a href="<?php the_permalink();?>" class="button">Meet the crew</a>
                </div>
              </div>
            </li>

    			<?php endwhile; endif; ?>
        </ul>
      </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
