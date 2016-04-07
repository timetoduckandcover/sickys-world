<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$query = $this->build_loop_query( $atts );

$css_class = 'post-grid ' . $style . ' ';
$attributes = array();

if ( 'carousel' == $display_type ) {
	$css_class .= 'post-grid-carousel ';
	$css_class .= $pagination_position . ' ';

	$attributes[] = 'data-items="' . esc_attr( $items_per_row ) . '"';
	if ( 'yes' == $show_arrow ) {
		$attributes[] = 'data-show-arrow="true"';
	}
	if ( 'yes' == $show_dots ) {
		$attributes[] = 'data-show-dots="true"';
	}
}

$class_to_filter = $css_class;
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
?>
<div class="<?php if ( 'style4' != $style ) echo 'row'; ?> abbey-blog-posts <?php echo esc_attr( trim( $css_class ) ); ?>" <?php echo implode( ' ', $attributes ); ?>>
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php if ( 'style1' == $style ) : ?>
            <div class="col-sm-6">
                <?php get_template_part( 'template-parts/content', 'grid-style1' ); ?>
            </div>
        <?php endif; ?>
        <?php if ( 'style2' == $style ) : ?>
            <div class="col-sm-6 col-md-4">
                <?php get_template_part( 'template-parts/content', 'masonry' ); ?>
            </div>
        <?php endif; ?>
        <?php if ( 'style3' == $style ) : ?>
            <?php require( get_template_directory() . '/template-parts/content-grid-style2.php' ); ?>
        <?php endif; ?>
		<?php if ( 'style4' == $style ) : ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php echo get_permalink() ?>" class="post-img">
						<picture>
							<?php the_post_thumbnail( 'facewp-abbey-grid-thumb' ); ?>
						</picture>
					</a>
				<?php } ?>
				<div class="post-content">
					<div class="post-date">
						<?php facewp_abbey_posted_on(); ?>
					</div>

					<h2 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>

					<div class="entry-content">
						<a href="<?php echo get_permalink() ?>" class="more-link"><?php esc_html_e( 'Read More', 'facewp-abbey' ); ?></a>
					</div>
				</div>
			</article>
		<?php endif; ?>
	<?php endwhile; ?>
</div>