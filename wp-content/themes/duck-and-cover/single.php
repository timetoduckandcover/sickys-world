<?php
/**
 * The template for displaying all single posts.
 *
 *  @package FaceWP
 */
get_header( 'blog' );
$facewp_abbey_big_title_color = Kirki::get_option( 'facewp', 'post_archives_big_title_color' );
$facewp_abbey_big_title_img = Kirki::get_option( 'facewp', 'post_archives_big_title_image' );
?>

<div class="archive-box" style="background-image: url('<?php echo esc_url( $facewp_abbey_big_title_img ); ?>')">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-title"><?php echo '' . Kirki::get_option( 'facewp', 'post_single_title' ); ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <main id="main" class="site-main col-xs-12 <?php echo esc_attr( ( 'no-sidebar' != FaceWPC()->get( 'facewp_abbey_sidebar_position' ) && is_active_sidebar( FaceWPC()->get( 'facewp_abbey_sidebar' ) ) ) ? 'col-md-9' : '' ); ?>">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-parts/content' ); ?>

                <?php facewp_abbey_entry_author(); ?>

                <?php facewp_abbey_post_pagination(); ?>

                <?php facewp_abbey_related_posts(); ?>

                <?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>

            <?php endwhile; // End of the loop. ?>

        </main><!-- #main -->
        <?php get_sidebar( 'blog' ); ?>
</div>
<?php get_footer( 'blog' ); ?>
