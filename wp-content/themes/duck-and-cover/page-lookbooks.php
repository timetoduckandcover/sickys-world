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
        <ul class="row sicky-crew-all">
    			<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <?php
    					$image_id = get_field('image');
    					$image_size = 'thumb-size';
    					$image_array = wp_get_attachment_image_src($image_id, $image_size);
    					$image_url = $image_array[0];
  					?>

            <li class="col-xs-12" style="background-image:url(<?php echo $image_url; ?>)">
              <div class="wrapper">
                <p>
                  LOOKBOOK TEST
                </p>
              </div>
            </li>

    			<?php endwhile; endif; ?>
        </ul>
      </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
