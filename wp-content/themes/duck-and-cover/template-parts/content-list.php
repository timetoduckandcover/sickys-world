<?php
$facewp_abbey_hide_category       = Kirki::get_option( 'facewp', 'post_hide_category' );
$facewp_abbey_hide_date           = Kirki::get_option( 'facewp', 'post_hide_date' );
$facewp_abbey_hide_author         = Kirki::get_option( 'facewp', 'post_hide_author' );
$facewp_abbey_hide_share_buttons  = Kirki::get_option( 'facewp', 'post_hide_share_buttons' );
$facewp_abbey_hide_read_more      = Kirki::get_option( 'facewp', 'post_hide_read_more' );
$facewp_abbey_hide_comment_link   = Kirki::get_option( 'facewp', 'post_hide_comment_link' );
$facewp_abbey_hide_featured_image = Kirki::get_option( 'facewp', 'post_hide_featured_image' );
$facewp_abbey_hide_tags           = Kirki::get_option( 'facewp', 'post_hide_tags' );
$facewp_abbey_hide_author_area    = Kirki::get_option( 'facewp', 'post_hide_author_area' );
$facewp_abbey_hide_related_posts  = Kirki::get_option( 'facewp', 'post_hide_related_posts' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'list-layout' ); ?>>

    <?php if ( has_post_thumbnail() && ! $facewp_abbey_hide_featured_image ) { ?>
        <a href="<?php echo get_permalink(); ?>" class="post-img">
            <picture>
                <?php the_post_thumbnail( 'facewp-abbey-list-thumb' ); ?>
            </picture>
        </a>
    <?php } ?>

    <div class="list-content">

        <header class="entry-header">

            <?php if ( ! $facewp_abbey_hide_date || ! $facewp_abbey_hide_author || ! $facewp_abbey_hide_comment_link ) { ?>
                <div class="entry-meta">

                    <?php if ( ! $facewp_abbey_hide_author ) { ?>
                        <span class="post-author">
                        <span class="meta-text"><?php esc_html_e( 'by', 'facewp-abbey' ) ?></span>
                            <?php the_author_posts_link(); ?>
                    </span>
                    <?php } ?>

                    <?php if ( ! $facewp_abbey_hide_date ) { ?>
                        <span class="post-date">
                        <?php facewp_abbey_posted_on(); ?>
                    </span><!--post-date-->
                    <?php } ?>

                </div>
            <?php } ?>
            <?php if ( is_single() ) : ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php else : ?>
                <h2 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php endif; ?>

        </header><!-- .entry-header -->

        <div class="entry-content">
            <p><?php echo facewp_abbey_string_limit_words( get_the_excerpt(), 23 ); ?>&hellip;<a href="<?php echo get_permalink() ?>" class="more-link"><?php esc_html_e( 'Read More', 'facewp-abbey' ); ?></a></p>
        </div>
        <!-- .entry-content -->

        <footer class="entry-footer">
            <?php if ( ! $facewp_abbey_hide_tags || ! $facewp_abbey_hide_comment_link || !$facewp_abbey_hide_category ) { ?>
                <div class="footer-post-meta row">
                    <div class="col-sm-8">

                        <?php if(!$facewp_abbey_hide_category) { ?>
                            <div class="cat-links">
                                <span class="meta-text"><?php esc_html_e( 'posted in', 'facewp-abbey' ) ?></span>
                                <?php facewp_abbey_entry_categories(); ?>
                            </div><!--post-categories-->
                        <?php } ?>

                    </div>
                    <div class="col-sm-4">
                        <?php echo getPostLikeLink( get_the_ID() ); ?>
                        <?php if ( ! $facewp_abbey_hide_comment_link ) { ?>
                            <?php facewp_abbey_entry_comments(); ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </footer><!-- .entry-footer -->
    </div>

</article><!-- #post-## -->