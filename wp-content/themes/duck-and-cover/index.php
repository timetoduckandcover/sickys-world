<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package FaceWP
 */
$facewp_abbey_post_layout = Kirki::get_option( 'facewp', 'blog_layout' );
$facewp_abbey_post_archives_sidebar_position = Kirki::get_option( 'facewp', 'post_archives_sidebar_position' );
$facewp_abbey_big_title_color = Kirki::get_option( 'facewp', 'post_archives_big_title_color' );
$facewp_abbey_big_title_img = Kirki::get_option( 'facewp', 'post_archives_big_title_image' );
get_header( 'blog' ); ?>

<!-- START Blog Flexslider -->
<?php
  $args = array(
    'post_type' => 'blog_flexslider'
  );
  $the_query = new WP_Query( $args )
;?>
<div class="blog-flexslider">
  <div class="flexslider">
    <ul class="slides">
      <?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <?php
					$image_id = get_field('image');
					$image_size = 'full-size';
					$image_array = wp_get_attachment_image_src($image_id, $image_size);
					$image_url = $image_array[0];
				?>
        <li style="background-image:url(<?php echo $image_url; ?>)">
          <a href="<?php the_field('slide_link');?>">
            <h1 class="blog-flexslider-title" style="color:<?php the_field('title_color');?>">
              <?php the_field('title');?>
            </h1>
          </a>
        </li>
      <?php endwhile; endif; ?>
    </ul>
  </div>
</div>
<?php wp_reset_query();?>
<!-- END Blog Flexslider -->

<div class="container">
    <div class="row">
        <main id="main" class="site-main col-xs-12 <?php echo esc_attr( ( 'no-sidebar' != FaceWPC()->get( 'facewp_abbey_sidebar_position' ) && is_active_sidebar( FaceWPC()->get( 'facewp_abbey_sidebar' ) ) ) ? 'col-md-9' : '' ); ?>">

            <?php if ( have_posts() ) : ?>

            <?php if ( $facewp_abbey_post_layout == 'masonry' ) :
            if( 'no-sidebar' == FaceWPC()->get( 'facewp_abbey_sidebar_position' ) ) : $facewp_abbey_number_of_columns_masonry = '3'; else : $facewp_abbey_number_of_columns_masonry = '2'; endif;
            if( 'no-sidebar' == FaceWPC()->get( 'facewp_abbey_sidebar_position' ) ) : $facewp_abbey_number_of_padding_masonry = '21px'; else : $facewp_abbey_number_of_padding_masonry = '15px'; endif;
            ?>

            <style>
                @media (min-width: 640px) and (max-width: 1023px) {
                    .grid-sizer, .post-masonry-item {
                        width: <?php echo 'calc('. '50%' .' - ' . $facewp_abbey_number_of_padding_masonry . ')'; ?>;
                    }
                }
                @media only screen and (min-width: 1024px) {
                    .grid-sizer, .post-masonry-item {
                        width: <?php echo 'calc('. (100/$facewp_abbey_number_of_columns_masonry) . '% ' .'- ' . $facewp_abbey_number_of_padding_masonry . ')'; ?>;
                    }
                }
            </style>
            <div class="post-masonry-layout">
                <div class="grid-sizer"></div>
                <?php endif; ?>

                <?php /* Start the Loop */ ?>

                <div class="row duck-blog">

                  <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'template-parts/content', 'duck' ); ?>

                  <?php endwhile; ?>

                </div>

                <?php facewp_abbey_paging_nav(); ?>

                <?php endif; ?>
        </main>
        <!-- #main -->
        <?php get_sidebar( 'blog' ); ?>
    </div>
</div>
<?php if ( $facewp_abbey_post_layout == 'masonry' ) { ?>
    <script>
        jQuery(document).ready(function ($) {
            var $grid =  $('.post-masonry-layout').masonry({
                itemSelector: '.post-masonry-item',
                columnWidth: '.grid-sizer',
                percentPosition: true,
                gutter: 30,
            });

            $grid.imagesLoaded().progress(function() {
                $grid.masonry('layout');
            })
        });
    </script>

<?php } ?>
<?php get_footer(); ?>
