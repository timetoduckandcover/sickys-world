<?php
get_header( 'blog' );
$facewp_abbey_post_layout = Kirki::get_option( 'facewp', 'blog_archive_layout' );
$facewp_abbey_post_archives_sidebar_position = Kirki::get_option( 'facewp', 'post_archives_sidebar_position' );
$facewp_abbey_big_title_color = Kirki::get_option( 'facewp', 'post_archives_big_title_color' );
$facewp_abbey_big_title_img = Kirki::get_option( 'facewp', 'post_archives_big_title_image' );
?>
<div class="archive-box" style="background-image: url('<?php echo esc_url( $facewp_abbey_big_title_img ); ?>')">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-title"><?php esc_html_e( 'Browsing Tag:', 'facewp-abbey' ); ?><?php printf( __( '%s', 'facewp-abbey' ), single_tag_title( '', false ) ); ?></h1>
            </div>
        </div>
    </div>
</div>
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

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php if ( $facewp_abbey_post_layout == 'full' ) : ?>

                        <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

                    <?php elseif ( $facewp_abbey_post_layout == 'list' ) : ?>

                        <?php get_template_part( 'template-parts/content', 'list' ); ?>

                    <?php elseif ( $facewp_abbey_post_layout == 'masonry' ) : ?>

                        <?php get_template_part( 'template-parts/content', 'masonry' ); ?>

                    <?php endif; ?>
                <?php endwhile; ?>

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



