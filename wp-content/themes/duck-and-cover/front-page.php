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

            <div class="container">
              <!-- Main Slider -->
              <div class="hero-slider">
                <?php the_field('main_slider_shortcode');?>
              </div>

              <!-- Men's/Women's Categories -->
              <?php include('front-page/top-categories.php');?>
              
            </div>

            <!-- Single Featured Product Section -->
            <?php include('front-page/single-featured-product.php');?>

            <!-- Sunglasses -->
            <?php include('front-page/sunglasses.php');?>

            <div class="container">

              <!-- Featured products 2 -->
              <?php the_field('featured_products_2_shortcode');?>

              <!-- Other content -->
              <?php get_template_part( 'template-parts/content', 'page' ); ?>

              <!-- Instagram Feed -->
              <div class="front-page-instagram">
                <h2>Instagram</h2>
                <?php dynamic_sidebar('Home Page Instagram Feed');?>
              </div>
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
                <h2><?php the_field('pre_footer_second_header');?></h2>
                <h1><?php the_field('pre_footer_main_header');?></h1>
                <a href="<?php the_field('pre_footer_link');?>" class="button">View More</a>
              </div>
            </div>
          <?php endwhile; // end of the loop. ?>
        </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
