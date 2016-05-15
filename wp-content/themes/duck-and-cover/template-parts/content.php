<?php
/**
 * The default template for displaying content
 *
 * @package FaceWP
 */

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
<article id="post-<?php the_ID(); ?>" <?php post_class( 'full-layout' ); ?>>

    <?php if ( has_post_format( 'gallery' ) ) { ?>
        <?php $gallery_images = get_post_meta( get_the_ID(), '_format_gallery_images', true ); ?>
        <?php if ( $gallery_images ) { ?>
            <div class="post-img post-gallery">
                <?php foreach ( $gallery_images as $image ) { ?>
                    <?php $img = wp_get_attachment_image_src( $image, 'facewp-abbey-full-thumb' ); ?>
                    <?php $caption = get_post_field( 'post_excerpt', $image ); ?>
                    <div><img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php echo ''; ?>"></div>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } elseif ( has_post_format( 'video' ) ) { ?>
            <div class="post-video">
                <?php $video = get_post_meta( get_the_ID(), '_format_video_embed', true ); ?>
                <?php if ( wp_oembed_get( $video ) ) { ?>
                    <?php echo wp_oembed_get( $video ); ?>
                <?php } else { ?>
                    <?php echo '' . $video; ?>
                <?php } ?>
            </div>
    <?php } elseif ( has_post_format( 'audio' ) ) { ?>
        <div class="post-audio">
            <?php $audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
            <?php if ( wp_oembed_get( $audio ) ) { ?>
                <?php echo wp_oembed_get( $audio ); ?>
            <?php } else { ?>
                <?php echo '' . $audio; ?>
            <?php } ?>
        </div>
    <?php } elseif ( has_post_format( 'quote' ) ) { ?>
        <?php $source_name = get_post_meta( $post->ID, '_format_quote_source_name', true ); ?>
        <?php $url = get_post_meta( $post->ID, '_format_quote_source_url', true ); ?>
        <?php $quote = get_post_meta( $post->ID, '_format_quote_text', true ); ?>
        <?php if ( $quote ) { ?>
            <div class="post-quote">
                <h2><?php echo esc_attr( $quote ); ?></h2>
                <div class="source-name">
                    <?php if ( $source_name ) { ?>
                        <?php if ( $url ) { ?>
                            <a href="<?php echo esc_url( $url ); ?>" target="_blank"><?php echo esc_attr( $source_name ); ?></a>
                        <?php } else { ?>
                            <span><?php echo esc_attr( $source_name ); ?></span>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <?php if ( has_post_thumbnail() && ! $facewp_abbey_hide_featured_image ) { ?>
            <?php if ( ! is_single() ) : ?>
                <a href="<?php echo get_permalink(); ?>" class="post-img">
            <?php endif; ?>
            <picture class="<?php if ( is_single() ) echo 'post-img'; ?>">
                <?php if ( is_single() ) : ?>
                    <?php the_post_thumbnail( 'facewp-abbey-full-thumb' ); ?>
                <?php else : ?>
                    <?php the_post_thumbnail( 'full-thumb' ); ?>
                <?php endif; ?>
            </picture>
            <?php if ( ! is_single() ) : ?>
                </a>
            <?php endif; ?>
        <?php } ?>
    <?php } ?>

    <header class="entry-header">

        <?php if ( is_single() ) : ?>
            <h1 class="blog-title"><?php the_title(); ?></h1>
        <?php else : ?>
            <h2 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php endif; ?>

        <?php if ( ! $facewp_abbey_hide_date || ! $facewp_abbey_hide_author || ! $facewp_abbey_hide_comment_link ) { ?>
            <div class="entry-meta">

                <?php if ( ! $facewp_abbey_hide_date ) { ?>
                    <span class="post-date">
                        <?php facewp_abbey_posted_on(); ?>
                    </span><!--post-date-->
                <?php } ?>

            </div>
        <?php } ?>

    </header><!-- .entry-header -->

    <div class="entry-content">

        <?php if ( is_single() ) : ?>

            <?php the_content( esc_html__( '<span class="more-button">Continue Reading</span>', 'facewp-abbey' ) ); ?>

        <?php else : ?>

            <?php if ( Kirki::get_option( 'facewp', 'post_summary' ) == 'excerpt' ) : ?>

                <p><?php echo facewp_abbey_string_limit_words( get_the_excerpt(), 80 ); ?>&hellip;</p>

            <?php elseif ( Kirki::get_option( 'facewp', 'post_summary' ) == 'read-more' ) : ?>

                <?php the_content(''); ?>

            <?php else: ?>

                <?php the_content(); ?>

            <?php endif; ?>

        <?php endif; ?>

    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php if ( ! $facewp_abbey_hide_tags || ! $facewp_abbey_hide_comment_link || !$facewp_abbey_hide_category ) { ?>
            <div class="footer-post-meta row">
                <div class="col-md-8 center-xs start-sm">
                    <?php if(!$facewp_abbey_hide_category) { ?>
                        <div class="cat-links">
                            <span class="meta-text"><?php esc_html_e( 'posted in', 'facewp-abbey' ) ?></span>
                            <?php facewp_abbey_entry_categories(); ?>
                        </div><!--post-categories-->
                    <?php } ?>

                    <?php if( is_single() ) { ?>
                        <?php if ( ! $facewp_abbey_hide_tags ) { ?>
                            <div class="post-tags">
                                <span class="meta-text"><?php esc_html_e( 'tagged', 'facewp-abbey' ) ?></span>
                                <?php facewp_abbey_entry_tags(); ?>
                            </div><!--post-tags-->
                        <?php } ?>
                    <?php } ?>

                </div>
                <div class="col-md-4 center-xs end-sm">
                    <?php echo getPostLikeLink( get_the_ID() ); ?>
                    <?php if ( ! $facewp_abbey_hide_comment_link ) { ?>
                        <?php facewp_abbey_entry_comments(); ?>
                    <?php } ?>
                    <?php if ( Kirki::get_option( 'facewp', 'post_summary' ) == 'read-more' || Kirki::get_option( 'facewp', 'post_summary' ) == 'excerpt' && ! is_single() ) : ?>
                        <a href="<?php echo get_permalink() ?>" class="more-link button primary-button"><?php esc_html_e( 'Read More', 'facewp-abbey' ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php } ?>
        <?php if ( is_single() ) { ?>
            <?php if ( ! $facewp_abbey_hide_share_buttons ) { ?>
                <div class="post-share-buttons">
                    <p class="share-buttons-text">
                        <?php esc_html_e( 'Share', 'facewp-abbey' ) ?>
                    </p>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                       onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php the_title(); ?>%20-%20<?php the_permalink(); ?>"
                       onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>
                    <a data-pin-do="skipLink" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url( $pin_image ); ?>&description=<?php the_title(); ?>"
                       onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
                        <i class="fa fa-pinterest"></i>
                    </a>
                    <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
                       onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=455,width=600'); return false;">
                        <i class="fa fa-google-plus"></i>
                    </a>
                    <a href="mailto:<?php echo get_option( 'admin_email' ); ?>"><i class="fa fa-envelope-o"></i></a>
                </div>
            <?php } ?>
        <?php } ?>
    </footer><!-- .entry-footer -->

</article><!-- #post-## -->
