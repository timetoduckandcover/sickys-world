<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-masonry-item' ); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php echo get_permalink() ?>" class="post-img">
            <picture>
                <?php the_post_thumbnail( 'facewp-abbey-grid-thumb' ); ?>
            </picture>
        </a>
    <?php } ?>
    <div class="masonry-content">
        <div class="post-date">
            <?php facewp_abbey_posted_on(); ?>
        </div>

        <h2 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>

        <div class="entry-content">
            <p><?php echo facewp_abbey_string_limit_words( get_the_excerpt(), 21 ); ?>&hellip;<a href="<?php echo get_permalink() ?>" class="more-link"><?php esc_html_e( 'Read More', 'facewp-abbey' ); ?></a></p>
        </div>
    </div>
</article>