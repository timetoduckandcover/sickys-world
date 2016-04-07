<?php
/**
 * The template for displaying 404 pages (not found).
 *
 *  @package FaceWP
 */

get_header(); ?>
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <main id="main" class="site-main">
                    <section class="page-not-found">
                        <div class="icon-page">
                            <span class="pe-7s-file"></span>
                            <span class="pe-7s-close"></span>
                        </div>
                        <p class="page-title"><?php esc_html_e( '404! That page can&rsquo;t be found.', 'facewp-abbey' ); ?></p>
                        <p class="not-found-description"><?php esc_html_e( 'The page you are looking for does not exist. Return to the ', 'facewp-abbey' ) ?><strong><?php esc_html_e( 'home page.', 'facewp-abbey' ) ?></strong></p>
                        <?php get_search_form() ?>
                    </section>
                </main><!-- #main -->
            </div>
        </div>
    </div>
</div><!--.content-wrapper-->
<?php get_footer(); ?>
