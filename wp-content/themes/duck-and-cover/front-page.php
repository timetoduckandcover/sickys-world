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

    <!-- START Home Flexslider -->
    <?php
      $args = array(
        'post_type' => 'home_flexslider'
      );
      $the_query = new WP_Query( $args )
    ;?>
    <div class="home-flexslider">
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
              <div style="background-image:url(<?php echo $image_url; ?>)" class="home-flexslider-mobile-image"></div>
              <div class="home-flexslider-mobile">
                <div class="home-flexslider-caption">
                  <?php if( get_field('sub_title') ): ?>
                    <h3 class="home-flexslider-title uppercase"><?php the_field('sub_title');?></h3>
                  <?php endif; ?>
                  <h2 class="home-flexslider-title uppercase"><?php the_field('main_title');?></h2>
                  <?php if( get_field('copy') ): ?>
                    <div class="copy">
                      <?php the_field('copy');?>
                    </div>
                  <?php endif; ?>
                  <a href="<?php the_field('button_link');?>" class="button">
                    <?php the_field('button_text');?>
                  </a>
                </div>
              </div>
              <div class="container home-flexslider-desktop">
                <div class="home-flexslider-caption">
                  <?php if( get_field('sub_title') ): ?>
                    <h3 class="home-flexslider-title uppercase" style="color:<?php the_field('sub_title_color');?>"><?php the_field('sub_title');?></h3>
                  <?php endif; ?>
                  <h2 class="home-flexslider-title uppercase" style="color:<?php the_field('main_title_color');?>"><?php the_field('main_title');?></h2>
                  <?php if( get_field('copy') ): ?>
                    <div class="copy" style="color:<?php the_field('copy_color');?>">
                      <?php the_field('copy');?>
                    </div>
                  <?php endif; ?>
                  <a href="<?php the_field('button_link');?>" class="button">
                    <?php the_field('button_text');?>
                  </a>
                </div>
              </div>
            </li>
          <?php endwhile; endif; ?>
        </ul>
      </div>
    </div>
    <?php wp_reset_query();?>
    <!-- END Home Flexslider -->

    <div class="content-wrapper">
        <main class="content site-main" id="duck-front-page">
          <?php while ( have_posts() ) : the_post(); ?>

            <div class="container">

              <!-- Men's/Women's Categories -->
              <?php include('front-page/top-categories.php');?>

            </div>

            <!-- Single Featured Product Section -->
            <?php include('front-page/single-featured-product.php');?>

            <!-- Sunglasses -->
            <?php include('front-page/sunglasses.php');?>

            <div class="container">

              <!-- Featured products 2 -->
              <div class="duck-best-sellers">
                <?php the_field('featured_products_2_shortcode');?>
              </div>

              <!-- Other content -->
              <?php get_template_part( 'template-parts/content', 'page' ); ?>

              <!-- Instagram Feed -->
              <div class="front-page-instagram">
                <h2>Instagram</h2>
                <script async src="//foursixty.com/media/scripts/fs.embed.v2.js" data-feed-id="sickysworld" data-open-links-in-same-page="false" data-theme="showcase_v2" data-page-size="10"></script><style>div.fs-has-links { text-indent: -9999px; position: static; font-weight: 500; } .fs-has-links::after {  padding:  5px 7.5px; border: 1px solid #fff; color:#fff; content: "SHOP IT"; text-indent: 0; display: block; font-size: 10pt; margin: 10px; }.fs-entry-container { width: 20% !important; padding-top: 20% !important; }.fs-desktop .fs-timeline-entry div.fs-text-container { display: flex; flex-direction: column;align-items: center; justify-content: center; display: -webkit-flex;  -webkit-flex-direction: column;  -webkit-align-items: center;  -webkit-justify-content: center;  display: -ms-flexbox;  -ms-flex-direction: column;  -ms-flex-align: center;  -ms-flex-pack: center; transition: opacity .25s; } .fs-desktop .fs-timeline-entry .fs-text-container:hover { opacity: 1; } .fs-wrapper div.fs-text-container .fs-entry-title, div.fs-detail-title{font-family:Helvetica Neue, Helvetica, Arial, sans-serif;font-style:italic;font-weight:normal;}div.fs-text-container .fs-entry-date, div.fs-detail-container .fs-post-info, div.fs-wrapper div.fs-has-links::after, .fs-text-product, .fs-overlink-text{font-family:Helvetica Neue, Helvetica, Arial, sans-serif;font-style:normal;font-weight:bold;}.fs-wrapper div.fs-text-container * {color:#fff}.fs-wrapper div.fs-text-container {background-color:rgba(0,0,0,0.8); margin: 0px}div.fs-entry-date{display:none}div.fs-entry-title{display:none}.fs-wrapper div.fs-timeline-entry{ margin: 5px }</style>              </div>
            </div>

            <!-- Pre Footer Image -->
            <?php
              $image_id = get_field('pre_footer_image');
              $image_size = 'full-size';
              $image_array = wp_get_attachment_image_src($image_id, $image_size);
              $image_url = $image_array[0];
            ?>
            <div class="pre-footer-image" style="background-image:url(<?php echo $image_url; ?>)">
              <div class="container">
                <div class="caption <?php the_field('pre_footer_caption_position');?>">
                  <h2 class="uppercase" style="color:<?php the_field('pre_footer_main_header_color');?>"><?php the_field('pre_footer_main_header');?></h2>
                  <p style="color:<?php the_field('pre_footer_second_header_color');?>"><em><?php the_field('pre_footer_second_header');?></em></p>
                  <a href="<?php the_field('pre_footer_link');?>" class="button"><?php the_field('pre_footer_button_copy');?></a>
                </div>
              </div>
            </div>
          <?php endwhile; // end of the loop. ?>
        </main>
    </div><!--.content-wrapper-->
<?php get_footer(); ?>
