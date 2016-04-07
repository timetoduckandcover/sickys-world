<?php
/**
 * Simple layout
 *
 * @package FaceWP
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-simple-item' ); ?>>
    <div class="post-date">
        <?php facewp_abbey_posted_on(); ?>
    </div>
    <h3 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
    <a href="<?php echo get_permalink() ?>" class="more-link"><?php esc_html_e( 'Read More', 'facewp-abbey' ); ?></a
</article>