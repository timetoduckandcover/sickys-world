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
                <script src="//foursixty.com/media/scripts/fs.embed.v2.js" data-feed-id="sickysworld" data-open-links-in-same-page="false" data-theme="showcase_v2" data-page-size="10"></script><style>div.fs-has-links { text-indent: -9999px; position: static; font-weight: 500; } .fs-has-links::after {  padding:  5px 7.5px; border: 1px solid #fff; color:#fff; content: "SHOP IT"; text-indent: 0; display: block; font-size: 10pt; margin: 10px; }.fs-entry-container { width: 20% !important; padding-top: 20% !important; }.fs-desktop .fs-timeline-entry div.fs-text-container { display: flex; flex-direction: column;align-items: center; justify-content: center; display: -webkit-flex;  -webkit-flex-direction: column;  -webkit-align-items: center;  -webkit-justify-content: center;  display: -ms-flexbox;  -ms-flex-direction: column;  -ms-flex-align: center;  -ms-flex-pack: center; transition: opacity .25s; } .fs-desktop .fs-timeline-entry .fs-text-container:hover { opacity: 1; } .fs-wrapper div.fs-text-container .fs-entry-title, div.fs-detail-title{font-family:Helvetica Neue, Helvetica, Arial, sans-serif;font-style:italic;font-weight:normal;}div.fs-text-container .fs-entry-date, div.fs-detail-container .fs-post-info, div.fs-wrapper div.fs-has-links::after, .fs-text-product, .fs-overlink-text{font-family:Helvetica Neue, Helvetica, Arial, sans-serif;font-style:normal;font-weight:bold;}.fs-wrapper div.fs-text-container * {color:#fff}.fs-wrapper div.fs-text-container {background-color:rgba(0,0,0,0.8); margin: 0px}div.fs-entry-date{display:none}div.fs-entry-title{display:none}.fs-wrapper div.fs-timeline-entry{ margin: 5px }</style>              </div>
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
