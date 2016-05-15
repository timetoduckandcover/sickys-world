<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package FaceWP
 */

if ( ! function_exists( 'facewp_abbey_get_body_wrapper' ) ) {
    function facewp_abbey_get_body_wrapper() {
        $body_wrapper = Kirki::get_option( 'facewp', 'site_body_wrapper' );

        if ( is_singular() ) {
            switch ( get_post_type() ) {
                case 'page':
                    if ( $meta_body_wrapper = get_post_meta( get_the_ID(), 'facewp_abbey_body_wrapper', true ) ) {
                        $body_wrapper = $meta_body_wrapper;
                    }
            }

        }

        return $body_wrapper;
    }
}

if ( ! function_exists( 'facewp_abbey_get_page_layout' ) ) {
    function facewp_abbey_get_page_layout() {
        $page_layout = Kirki::get_option( 'facewp', 'site_page_layout' );

        if ( is_home() ) {
            $page_layout = Kirki::get_option( 'facewp', 'post_archives_page_layout' );
        } if ( is_archive() ) {

            if ( is_category() ) {
                $page_layout = Kirki::get_option( 'facewp', 'post_archives_page_layout' );
            } else if ( function_exists('is_shop') && is_shop() ) {
                $page_layout = Kirki::get_option( 'facewp', 'woocommerce_archives_page_layout' );
            } else {
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                if ( $term ) {
                    switch ( $term->taxonomy ) {
                        case in_array( $term->taxonomy, facewp_abbey_get_taxonomies( 'product' ) ) :
                            $page_layout = Kirki::get_option( 'facewp', 'woocommerce_archives_page_layout' );
                            break;
                        case in_array( $term->taxonomy, facewp_abbey_get_taxonomies( 'post' ) ) :
                            $page_layout = Kirki::get_option( 'facewp', 'post_archives_page_layout' );
                            break;
                    }
                } else if ( is_tag() ) {
                    $page_layout = Kirki::get_option( 'facewp', 'post_archives_page_layout' );
                }
            }

        } else if ( is_singular() ) {

            switch ( get_post_type() ) {
                case 'post':
                    $page_layout = Kirki::get_option( 'facewp', 'post_single_page_layout' );
                    break;
                case 'product':
                    $page_layout = Kirki::get_option( 'facewp', 'woocommerce_single_page_layout' );
                    break;
                case 'page':
                    if ( $meta_page_layout = get_post_meta( get_the_ID(), 'facewp_abbey_page_layout', true ) ) {
                        $page_layout = $meta_page_layout;
                    }
                    break;
                default:
                    break;
            }

        }

        return $page_layout;
    }
}

if ( ! function_exists( 'facewp_abbey_get_sidebar_position' ) ) {
    function facewp_abbey_get_sidebar_position() {
        $sidebar_position = Kirki::get_option( 'facewp', 'site_sidebar_position' );

        if ( is_home() ) {
            $sidebar_position = Kirki::get_option( 'facewp', 'post_archives_sidebar_position' );
        } else if ( is_archive() ) {

            if ( is_category() ) {
                $sidebar_position = Kirki::get_option( 'facewp', 'post_archives_sidebar_position' );
            } else if ( function_exists('is_shop') && is_shop() ) {
                $sidebar_position = Kirki::get_option( 'facewp', 'woocommerce_archives_sidebar_position' );
            } else {
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                if ( $term ) {
                    switch ( $term->taxonomy ) {
                        case in_array( $term->taxonomy, facewp_abbey_get_taxonomies( 'product' ) ) :
                            $sidebar_position = Kirki::get_option( 'facewp', 'woocommerce_archives_sidebar_position' );
                            break;
                        case in_array( $term->taxonomy, facewp_abbey_get_taxonomies( 'post' ) ) :
                            $sidebar_position = Kirki::get_option( 'facewp', 'post_archives_sidebar_position' );
                            break;
                    }
                } else if ( is_tag() ) {
                    $sidebar_position = Kirki::get_option( 'facewp', 'post_archives_sidebar_position' );
                }
            }

        } else if ( is_singular() ) {

            switch ( get_post_type() ) {
                case 'post':
                    $sidebar_position = Kirki::get_option( 'facewp', 'post_single_sidebar_position' );
                    break;
                case 'product':
                    $sidebar_position = Kirki::get_option( 'facewp', 'woocommerce_single_sidebar_position' );
                    break;
                case 'page':
                    if ( $meta_sidebar_position = get_post_meta( get_the_ID(), 'facewp_abbey_sidebar_position', true ) ) {
                        $sidebar_position = $meta_sidebar_position;
                    }
                    break;
                default:
                    break;
            }

        }

        return $sidebar_position;
    }
}

if ( ! function_exists( 'facewp_abbey_get_sidebar' ) ) {
    function facewp_abbey_get_sidebar() {
        $sidebar = '';

        if ( is_home() ) {
            $sidebar = 'sidebar-1';
        } else if ( is_archive() ) {

            if ( is_category() ) {
                $sidebar = 'sidebar-1';
            } else if ( function_exists('is_shop') && is_shop() ) {
                $sidebar = 'sidebar-shop';
            } else {
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                if ( $term ) {
                    switch ( $term->taxonomy ) {
                        case in_array( $term->taxonomy, facewp_abbey_get_taxonomies( 'product' ) ) :
                            $sidebar = 'sidebar-shop';
                            break;
                        case in_array( $term->taxonomy, facewp_abbey_get_taxonomies( 'post' ) ) :
                            $sidebar = 'sidebar-1';
                            break;
                    }
                } else if ( is_tag() ) {
                    $sidebar = 'sidebar-1';
                }
            }

        } else if ( is_singular() ) {

            switch ( get_post_type() ) {
                case 'post':
                    $sidebar = 'sidebar-1';
                    break;
                case 'product':
                    $sidebar = 'sidebar-product';
                    break;
                case 'page':
                    if ( $meta_sidebar = get_post_meta( get_the_ID(), 'facewp_abbey_sidebar', true ) ) {
                        $sidebar = $meta_sidebar;
                    }
                    break;
                default:
                    break;
            }

        }

        return facewp_abbey_get_custom_sidebar_id( $sidebar );
    }
}

if ( ! function_exists( 'facewp_abbey_get_overlay_header' ) ) {
    function facewp_abbey_get_overlay_header() {
        if ( is_page() ) {
            if ( get_post_meta( get_the_ID(), 'facewp_abbey_overlay_header', true ) == 'on' ) {
                return true;
            }
        }

        return false;
    }
}

if ( ! function_exists( 'facewp_abbey_get_sticky_header' ) ) {
    function facewp_abbey_get_sticky_header() {
        if ( is_page() ) {
            if ( get_post_meta( get_the_ID(), 'facewp_abbey_sticky_header', true ) == 'on' ) {
                return true;
            }
        }

        return false;
    }
}


if ( ! function_exists( 'facewp_abbey_get_content_layout' ) ) {
    function facewp_abbey_get_content_layout() {
        $result = '';

        if ( is_singular( 'product' ) ) {
            $result = Kirki::get_option( 'facewp', 'woocommerce_single_content_layout' );
        }

        return $result;
    }
}

if ( ! function_exists( 'facewp_abbey_search_form' ) ) {
    function facewp_abbey_get_search_form() {
        if ( ! Kirki::get_option( 'facewp', 'header_search_show' ) ) {
            return '';
        }

        wp_enqueue_script( 'yith_wcas_jquery-autocomplete' );
        $show_categories = Kirki::get_option( 'facewp', 'header_search_categories_show' );
        ob_start();
        ?>
        <form action="<?php echo esc_url( home_url( '/'  ) ) ?>" role="search" method="get" id="yith-ajaxsearchform" class="yith-ajaxsearchform-container searchform <?php if ( $show_categories ) echo 'searchform-categories'; ?>">
            <input type="hidden" name="post_type" value="product" />
            <fieldset>
                <?php
                if ( $show_categories && class_exists( 'WooCommerce' ) ) {
                    $args = array(
                        'show_option_all' => esc_html__( 'Select Category', 'facewp-abbey' ),
                        'hierarchical'    => 1,
                        'class'           => 'cat',
                        'echo'            => 1,
                        'value_field'     => 'slug',
                        'selected'        => 1,
                    );
                    $args['taxonomy'] = 'product_cat';
                    $args['name'] = 'product_cat';
                    wp_dropdown_categories($args);
                }
                ?>
                <input name="s" id="yith-s" type="text" value="<?php echo get_search_query() ?>" data-minchars="<?php echo esc_attr( get_option( 'yith_wcas_min_chars' ) * 1 ); ?>" placeholder="<?php echo __('Search &hellip;', 'facewp-abbey'); ?>" />
                <button class="btn" id="yith-searchsubmit" title="<?php echo __('Search', 'facewp-abbey'); ?>" type="submit"><span class="pe-7s-search"></span></button>
            </fieldset>
        </form>
        <?php
        return ob_get_clean();
    }
}


if ( ! function_exists( 'facewp_abbey_paging_nav' ) ) :
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function facewp_abbey_paging_nav() {
        global $wp_query, $wp_rewrite;

        // Don't print empty markup if there's only one page.
        if ( $wp_query->max_num_pages < 2 ) {
            return;
        }

        $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }

        $pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

        // Set up paginated links.
        $links = paginate_links( array(
                                     'base'      => $pagenum_link,
                                     'format'    => $format,
                                     'total'     => $wp_query->max_num_pages,
                                     'current'   => $paged,
                                     'mid_size'  => 1,
                                     'add_args'  => array_map( 'urlencode', $query_args ),
                                     'prev_text' => __( 'Newer Posts', 'facewp-abbey' ),
                                     'next_text' => __( 'Older Posts', 'facewp-abbey' ),
                                 ) );

        if ( $links ) :

            ?>
            <div class="pagination loop-pagination">
                <?php echo '' . $links; ?>
            </div><!-- .pagination -->
            <?php
        endif;
    }
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
    /**
     * Display navigation to next/previous post when applicable.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function the_post_navigation() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous ) {
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'facewp-abbey' ); ?></h2>

            <div class="nav-links">
                <?php
                previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
                next_post_link( '<div class="nav-next">%link</div>', '%title' );
                ?>
            </div>
            <!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
    }
endif;

if ( ! function_exists( 'facewp_abbey_related_posts' ) ) :
    /**
     * Display related posts
     */
    function facewp_abbey_related_posts() {
        global $post;

        // Get all tags
        $tags = wp_get_post_tags( $post->ID );

        if ( $tags ) :
            $first_tag = $tags[0]->term_id;
            $args = array(
                'tag__in'             => array( $first_tag ),
                'post__not_in'        => array( $post->ID ),
                'posts_per_page'      => 3,
                'ignore_sticky_posts' => 1,
            );

            $query     = new WP_Query( $args );

            if ( $query->have_posts() ) : ?>
                <div class="post-related">
                    <h3 class="heading style3"><span><?php esc_html_e( 'Related Posts', 'facewp-abbey' ); ?></span></h3>

                    <div class="row">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <div class="col-sm-4">
                                <?php get_template_part( 'template-parts/content', 'simple' ); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif;
            wp_reset_query();
            ?>
        <?php endif; ?>
    <?php }
endif;

if ( ! function_exists( 'facewp_abbey_post_pagination' ) ) :
    /**
     * Display post pagination
     */
    function facewp_abbey_post_pagination() {
    ?>
        <div class="post-pagination">

            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            ?>

            <?php if (!empty( $prev_post )) : ?>
                <div class="prev-post">
                    <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                        <?php echo get_the_title( $prev_post->ID ); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty( $next_post )) : ?>
                <div class="next-post">
                    <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                        <?php echo get_the_title( $next_post->ID ); ?>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    <?php }
endif;

if ( ! function_exists( 'facewp_abbey_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function facewp_abbey_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );

        $posted_on = sprintf( esc_html_x( '%s', 'post date', 'facewp-abbey' ), $time_string );
        $posted_on_text = '<span class="meta-text">' . esc_html__( 'on', 'facewp-abbey' ) . '</span>';

        echo '<span class="posted-on">' . $posted_on . '</span>';

    }
endif;

if ( ! function_exists( 'facewp_abbey_entry_category' ) ) :
    /**
     * Prints HTML with meta information for the categories
     */
    function facewp_abbey_entry_categories() {
        if ( 'post' == get_post_type() ) {
            $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'facewp-abbey' ) );
            if ( $categories_list && facewp_abbey_categorized_blog() ) {
                printf( esc_html__( '%1$s', 'facewp-abbey' ), $categories_list ); // WPCS: XSS OK.
            }
        }
    }
endif;

if ( ! function_exists( 'facewp_abbey_entry_tags' ) ) :
    /**
     * Prints HTML with meta information for the tags
     */
    function facewp_abbey_entry_tags() {
        if ( 'post' == get_post_type() ) {
            $tags_list = get_the_tag_list( '',  esc_html( ', ', 'facewp-abbey' ) );
            if ( $tags_list ) {
                printf( esc_html__( '%1$s', 'facewp-abbey' ), $tags_list ); // WPCS: XSS OK.
            }
        }
    }
endif;

if ( ! function_exists( 'facewp_abbey_entry_comments' ) ) :
    /**
     * Prints HTML with meta information for the comments
     */
    function facewp_abbey_entry_comments() {
        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
                comments_popup_link( 0, 1, get_comments_number( get_the_ID() ) );
            echo '</span>';
        }

    }
endif;

if ( ! function_exists( 'facewp_abbey_entry_author' ) ) :
    /**
     * Display author information
     */
    function facewp_abbey_entry_author() {
        $output = '<div class="author-info">';
        $output .= '<picture class="author-info-img">';
        $output .= get_avatar( get_the_author_meta( 'user_email' ), 130 );
        $output .= '</picture>';
        $output .= '<div class="author-info-content">';
        $output .= '<div class="author-info-top">';
        $output .= '<a class="author-info-name" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . get_the_author() . '</a>';
        $output .= '<span class="author-info-position">' . get_the_author_meta('position'). '</span>';
        $output .= '</div>';
        $output .= '<p class="author-info-description">' . get_the_author_meta( 'description' ) . '</p>';
        $output .= '</div>';
        $output .= '</div>';
        echo '' . $output;
    }
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function facewp_abbey_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'facewp_abbey_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
                                                 'fields'     => 'ids',
                                                 'hide_empty' => 1,
                                                 // We only need to know if there is more than one category.
                                                 'number'     => 2,
                                             ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'facewp_abbey_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so facewp_abbey_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so facewp_abbey_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in facewp_abbey_categorized_blog.
 */
function facewp_abbey_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'facewp_abbey_categories' );
}

add_action( 'edit_category', 'facewp_abbey_category_transient_flusher' );
add_action( 'save_post', 'facewp_abbey_category_transient_flusher' );

/**
 * Flush out the transients used in facewp_abbey_categorized_blog.
 */
function custom_excerpt_length( $length ) {
    return 200;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function facewp_abbey_string_limit_words( $string, $word_limit ) {
    $words = explode( ' ', $string, ( $word_limit + 1 ) );

    if ( count( $words ) > $word_limit ) {
        array_pop( $words );
    }

    return implode( ' ', $words );
}

/**
 * Custom comment layout
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function facewp_abbey_comment( $comment, $args, $depth ) {
    $GLOBALS[ 'comment' ] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">
            <?php echo get_avatar( $comment, $size = '100' ); ?>
        </div>
        <div class="comment-content">
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'facewp-abbey' ) ?></em>
                <br />
            <?php endif; ?>
            <div class="metadata">
                <?php printf( wp_kses( __( '<cite class="fn">%s</cite>', 'facewp-abbey' ), array( 'cite' => array() ), 'facewp-abbey' ), get_comment_author_link() ) ?>
                <p
                    class="post-date"><?php printf( esc_html__( '%1$s', 'facewp-abbey' ), get_comment_date(), get_comment_time() ) ?></p>
                <?php edit_comment_link( esc_html__( '(Edit)', 'facewp-abbey' ), '  ', '' ) ?>
            </div>
            <?php comment_text() ?>
            <?php comment_reply_link( array_merge( $args, array( 'depth'     => $depth,
                                                                 'max_depth' => $args[ 'max_depth' ]
            ) ) ) ?>
        </div>
    </div>
    <?php
}

add_action( 'facewp_abbey_after_footer', 'facewp_abbey_promo_popup_html' );
function facewp_abbey_promo_popup_html() {
    if ( ! Kirki::get_option( 'facewp', 'promo_popup_show' ) || ! Kirki::get_option( 'facewp', 'promo_popup_content' ) ) {
        return;
    }

    $inline_styles = array();
    $inline_styles[] = 'width: ' . Kirki::get_option( 'facewp', 'promo_popup_width' ). 'px';
    $inline_styles[] = 'height: ' . Kirki::get_option( 'facewp', 'promo_popup_height' ) . 'px';
    if ( Kirki::get_option( 'facewp', 'promo_popup_background_color' ) ) {
        $inline_styles[] = 'background-color: ' . Kirki::get_option( 'facewp', 'promo_popup_background_color' );
    }
    if ( Kirki::get_option( 'facewp', 'promo_popup_background_image' ) ) {
        $inline_styles[] = 'background-image: url("' . Kirki::get_option( 'facewp', 'promo_popup_background_color' ) . '")';
    }
    if ( Kirki::get_option( 'facewp', 'promo_popup_background_repeat' ) ) {
        $inline_styles[] = 'background-repeat: ' . Kirki::get_option( 'facewp', 'promo_popup_background_repeat' );
    }
    if ( Kirki::get_option( 'facewp', 'promo_popup_background_attachment' ) ) {
        $inline_styles[] = 'background-attachment: ' . Kirki::get_option( 'facewp', 'promo_popup_background_attachment' );
    }
    if ( Kirki::get_option( 'facewp', 'promo_popup_background_position' ) ) {
        $inline_styles[] = 'background-position: ' . Kirki::get_option( 'facewp', 'promo_popup_background_position' );
    }
    ?>
    <div id="promo-popup" style="<?php echo esc_attr( implode( ';', $inline_styles ) ); ?>">
        <?php echo do_shortcode( html_entity_decode( Kirki::get_option( 'facewp', 'promo_popup_content' ), ENT_QUOTES, 'UTF-8' ) ); ?>
        <label id="promo-popup-checkbox-label">
            <input type="checkbox" id="promo-popup-checkbox" />
            <?php echo esc_html( "Don't show this popup again.", 'facewp-abbey' ); ?>
        </label>
    </div>
    <?php
}
