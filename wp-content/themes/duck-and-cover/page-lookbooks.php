<?php
/*
Template Name: Lookbooks
*/
?>
<?php get_header(); ?>
    <div class="content-wrapper">
      <main class="content">

        <?php $args = array( 'post_type' => 'lookbooks' );
  			      $the_query = new WP_Query( $args ) ;?>
        <ul class="row lookbooks-all">
    			<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <?php
    					$image_id = get_field('listing_image');
    					$image_size = 'full-size';
    					$image_array = wp_get_attachment_image_src($image_id, $image_size);
    					$image_url = $image_array[0];
  					?>

            <li class="col-xs-12" style="background-image:url(<?php echo $image_url; ?>)">
              <div class="wrapper">
                <div class="lookbooks-all_single">
                  <?php if( get_field('listing_title') ): ?>
                    <h1 class="lookbooks-all-title" style="color:<?php the_field('listing_title_color');?>"><?php the_field('listing_title');?></h1>
                  <?php endif; ?>
                  <a href="<?php the_permalink();?>" class="button">View Lookbook</a>
                </div>
              </div>
            </li>

    			<?php endwhile; endif; ?>
        </ul>
      </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
