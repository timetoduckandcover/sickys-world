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
        <main class="content site-main">
          <div class="wrapper">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', 'page' ); ?>
            <?php endwhile; // end of the loop. ?>
          </div>
        </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
