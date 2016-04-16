<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-masonry-item' ); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php echo get_permalink() ?>" class="post-img">
            <picture>
                <?php the_post_thumbnail( 'facewp-abbey-grid-style1' ); ?>
            </picture>
        </a>
    <?php } ?>
    <div class="masonry-content">
        <div class="masonry-content-inner">
            <div class="post-date">
                <?php facewp_abbey_posted_on(); ?>
            </div>
            <h2 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
        </div>
    </div>
</article>
