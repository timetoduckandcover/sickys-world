<?php
/**
 * The template for displaying front page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package FaceWP
 */
get_header(); ?>

    <div class="content-wrapper">
        <main class="content site-main" id="duck-front-page">
          <?php while ( have_posts() ) : the_post(); ?>
            <div class="wrapper">
              <!-- Main Slider -->
              <?php the_field('main_slider_shortcode');?>

              <!-- Featured products -->
              <?php the_field('featured_products_shortcode');?>

              <!-- Other content -->
              <?php get_template_part( 'template-parts/content', 'page' ); ?>

              <!-- Instagram Feed -->
              <h3 class="header-2 uppercase">Instagram</h3>
              <br/>
              <?php dynamic_sidebar('Home Page Instagram Feed');?>
            </div>

            <!-- Pre Footer Image -->
            <?php
              $image_id = get_field('pre_footer_image');
              $image_size = 'full-size';
              $image_array = wp_get_attachment_image_src($image_id, $image_size);
              $image_url = $image_array[0];
            ?>
            <div class="pre-footer-image">
              <img src="<?php echo $image_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full" />
              <div class="caption">
                <h3 class="header-2"><?php the_field('pre_footer_second_header');?></h3>
                <h2><?php the_field('pre_footer_header');?></h2>
                <a href="<?php the_field('pre_footer_link');?>" class="button">View More</a>
              </div>
            </div>
          <?php endwhile; // end of the loop. ?>
        </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
