<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-masonry-item' ); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php echo get_permalink() ?>" class="post-img">
            <picture>
                <?php the_post_thumbnail( 'facewp-abbey-grid-style2' ); ?>
            </picture>
        </a>
    <?php } ?>
    <div class="masonry-content">
        <div class="masonry-content-inner">
            <h2 class="heading style2">
                <span><?php echo '' . $title; ?></span>
            </h2>
            <h2 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="entry-content">
                <p><?php echo facewp_abbey_string_limit_words( get_the_excerpt(), 30 ); ?>&hellip;<a href="<?php echo get_permalink() ?>" class="more-link heading-font"><span><?php esc_html_e( 'Read More', 'facewp-abbey' ); ?></span></a></p>
            </div>
        </div>
    </div>
</article>