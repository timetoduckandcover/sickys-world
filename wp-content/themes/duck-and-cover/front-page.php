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
          <div class="wrapper">
            <?php while ( have_posts() ) : the_post(); ?>

              <!-- Main Slider -->
              <?php the_field('main_slider_shortcode');?>

              <!-- Featured products -->
              <?php the_field('featured_products_shortcode');?>

              <!-- Other content -->
              <?php get_template_part( 'template-parts/content', 'page' ); ?>

              <!-- Instagram Feed -->
              <?php dynamic_sidebar('Home Page Instagram Feed');?>

            <?php endwhile; // end of the loop. ?>
          </div>
        </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
