// blog read more button
<div class="blog-meta-footer">
  <a href="<?php echo get_permalink() ?>" class="read-more button-transparent"><?php esc_html_e( 'Read More', 'facewp-abbey' ); ?></a>
</div>

// celebwears pagination
<!-- <?php include('template-parts/duck-pagination.php');?> -->


// Header wishlist link
<?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
      <a class="header-item" style="padding-top:10px;display:inline-block;" href="<?php echo esc_url( YITH_WCWL::get_instance()->get_wishlist_url() ); ?>"><span class="icon-header pe-7s-like"></span></a>
<?php endif; ?>

// comments
'website'  => '<p class="col-md-4 comment-form-website"><label for="website">' . esc_html__( 'Website', 'facewp-abbey' ) . '</label> ' .
            '<input id="website" name="website" type="text" value="' . esc_attr(  $facewp_abbey_commenter['comment_author_url'] ) . '" size="30"/></p>',

// Blog listing page
<p><?php echo substr(wp_strip_all_tags( get_the_content() ),0,100); ?>...</p>


// Single blog page
<!-- <?php if ( ! is_single() ) : ?>
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
<?php endif; ?> -->


<?php facewp_abbey_post_pagination(); ?>


<?php if ( ! $facewp_abbey_hide_author ) { ?>
    <span class="post-author">
        <span class="meta-text"><?php esc_html_e( 'by', 'facewp-abbey' ) ?></span>
        <?php the_author_posts_link(); ?>
    </span>
<?php } ?>

<?php facewp_abbey_entry_author(); ?>

<div class="archive-box" style="background-image: url('<?php echo esc_url( $facewp_abbey_big_title_img ); ?>')">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-title"><?php echo '' . Kirki::get_option( 'facewp', 'post_single_title' ); ?></h1>
                <h1 class="page-title"><?php the_title();?></h1>
            </div>
        </div>
    </div>
</div>

// Instagram feed home
      <?php dynamic_sidebar('Home Page Instagram Feed');?>

// Header box content
<div class="container main-content <?php echo esc_attr( facewp_abbey_get_page_layout() ); ?>">

// Blog header
// style="background-image: url('<?php echo esc_url( $facewp_abbey_big_title_img ); ?>')"
<!-- <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-title"><?php echo '' . Kirki::get_option( 'facewp', 'post_single_title' ); ?></h1>
        </div>
    </div>
</div> -->

// Footer pull in widgets
<?php require_once( get_template_directory() . '/footer/' . Kirki::get_option( 'facewp', 'footer_type' ) . '.php' ); ?>

// blog posts
<?php if ( $facewp_abbey_post_layout == 'full' ) : ?>

    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

<?php elseif ( $facewp_abbey_post_layout == 'list' ) : ?>

    <?php get_template_part( 'template-parts/content', 'list' ); ?>

<?php elseif ( $facewp_abbey_post_layout == 'masonry' ) : ?>

    <?php get_template_part( 'template-parts/content', 'masonry' ); ?>

<?php endif; ?>

// Api (consumer) key
// ck_85c8499befb9b1829aefe08de12eec4bacb09452

// Api (consumer) secret
// cs_b8b925cb657a19d9eb8669cb4c3da0f94bee3aa6
