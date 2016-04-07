<?php
if ( ! class_exists( 'FaceWP_Abbey_Instagram_Widget' ) ) {

    add_action( 'widgets_init', 'load_facewp_instagram_widget' );

    function load_facewp_instagram_widget() {
        register_widget( 'FaceWP_Abbey_Instagram_Widget' );
    }

    /**
     * Instagram Widget
     */
    class FaceWP_Abbey_Instagram_Widget extends WP_Widget {

        private $item_width_list = array();

        /**
         * Register widget with WordPress.
         */
        function __construct() {
            parent::__construct(
                'facewp_instagram',
                esc_html__( 'FaceWP - Instagram', 'facewp-abbey' ),
                array( 'description' => esc_html__( 'Displays latest Instagram photos', 'facewp-abbey' ) )
            );
        }

        function widget( $args, $instance ) {
            extract( $args );

            $title               = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
            $username            = isset( $instance[ 'username' ] ) ? $instance[ 'username' ] : '';
            $number_items        = isset( $instance[ 'number_items' ] ) ? $instance[ 'number_items' ] : '6';
            $show_likes_comments = isset( $instance[ 'show_likes_comments' ] ) ? $instance[ 'show_likes_comments' ] : '';
            $link_new_page       = isset( $instance[ 'link_new_page' ] ) ? $instance[ 'link_new_page' ] : '';
            $show_follow_text    = isset( $instance[ 'show_follow_text' ] ) ? $instance[ 'show_follow_text' ] : '';
            $follow_text         = isset( $instance[ 'follow_text' ] ) ? $instance[ 'follow_text' ] : esc_html__( 'Follow us on Instagram', 'facewp-abbey' );

            echo '' . $args[ 'before_widget' ];

            $output = '<h3 class="widget-title">' . $title . '</h3>';

            $class = 'col-xs-4';

            // if hidden on device, find [class*=col] and replace to '', use only hidden
            $class_container = preg_replace( '/col\-(lg|md|sm|xs)[^\s]*/', '', $class );
            $output .= '<div class="fwp-instag ' . trim( $class_container ) . '">';
            if ( ! empty( $username ) ) {
                $media_array = $this->scrape_instagram( $username, $number_items );

                if ( is_wp_error( $media_array ) ) {
                    $output .= '<div class="fwp-instag-error"><p>' . $media_array->get_error_message() . '</p></div>';
                } else {
                    $output .= '<ul class="fwp-instag-img row">';
                    foreach ( $media_array as $item ) {
                        $output .= '<li class="item ' . $class . '">';

                        if ( 'on' == $show_likes_comments ) {
                            $output .= '<ul class="instag-info">';
                            $output .= '<li class="likes"><span>' . $item[ 'likes' ] . '</span></li>';
                            $output .= '<li class="comments"><span>' . $item[ 'comments' ] . '</span></li>';
                            $output .= '</ul>';
                        }

                        $output .= '<a href="' . esc_url( $item[ 'link' ] ) . '" target="' . ( $link_new_page == 'on' ? '_blank' : '_self' ) . '" class="item-link' . ( $show_likes_comments == 'on' ? ' show-info' : '' ) . '">';
                        $output .= '<img src="' . esc_url( $item[ 'thumbnail' ] ) . '" alt="' . $item[ 'description' ] . '" title="' . $item[ 'description' ] . '" class="item-image"/>';
                        $output .= '</a>';
                        $output .= '</li>';
                    }
                    $output .= '</ul>';
                    if ( 'on' == $show_follow_text ) {
                        $output .= '<p class="fwp-instag-follow">' .$follow_text . '<span class="fwp-instag-follow-text">' . ' @' . $username . '</span>' . '</p>';
                    }
                }
            }

            $output .= '</div>';

            echo '' . $output;

            echo '' . $args[ 'after_widget' ];
        }

        function form( $instance ) {
            $title               = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
            $username            = isset( $instance[ 'username' ] ) ? $instance[ 'username' ] : '';
            $number_items        = isset( $instance[ 'number_items' ] ) ? $instance[ 'number_items' ] : '6';
            $show_likes_comments = isset( $instance[ 'show_likes_comments' ] ) ? $instance[ 'show_likes_comments' ] : '';
            $show_follow_text    = isset( $instance[ 'show_follow_text' ] ) ? $instance[ 'show_follow_text' ] : '';
            $follow_text         = isset( $instance[ 'follow_text' ] ) ? $instance[ 'follow_text' ] : esc_html__( 'Follow Us', 'facewp-abbey' );
            $link_new_page       = isset( $instance[ 'link_new_page' ] ) ? $instance[ 'link_new_page' ] : '';

            ?>

            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'facewp-abbey' ) ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                       value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'User Name', 'facewp-abbey' ) ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>"
                       value="<?php echo esc_attr( $username ); ?>" />
            </p>
            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'number_items' ) ); ?>"><?php esc_html_e( 'Number of items', 'facewp-abbey' ) ?></label>
                <input type="text" class="widefat"
                       id="<?php echo esc_attr( $this->get_field_id( 'usenumber_itemsrname' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'number_items' ) ); ?>"
                       value="<?php echo esc_attr( $number_items ); ?>" />
            </p>
            <p>
                <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_likes_comments' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'show_likes_comments' ) ); ?>" <?php checked( $show_likes_comments, 'on' ); ?> />
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'show_likes_comments' ) ); ?>"><?php esc_html_e( 'Show likes and comments', 'facewp-abbey' ) ?></label>
            </p>
            <p>
                <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_follow_text' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'show_follow_text' ) ); ?>" <?php checked( $show_follow_text, 'on' ); ?> />
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'show_follow_text' ) ); ?>"><?php esc_html_e( 'Show follow text', 'facewp-abbey' ) ?></label>
            </p>
            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'follow_text' ) ); ?>"><?php esc_html_e( 'Text', 'facewp-abbey' ) ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'follow_text' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'follow_text' ) ); ?>"
                       value="<?php echo esc_attr( $follow_text ); ?>" />
            </p>
            <p>
                <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'link_new_page' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'link_new_page' ) ); ?>" <?php checked( $link_new_page == 'on' ); ?> />
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'link_new_page' ) ); ?>"><?php esc_html_e( 'Open links in new page:', 'facewp-abbey' ) ?></label>
            </p>
            <strong><?php esc_html_e( 'Responsiveness', 'facewp-abbey' ); ?></strong>
            <?php
        }

        /**
         * Quick-and-dirty Instagram web scrape
         * based on https://gist.github.com/cosmocatalano/4544576
         *
         * @param $username
         * @param int $slice
         *
         * @return array|WP_Error
         */
        public function scrape_instagram( $username, $slice ) {

            $username = strtolower( $username );

            if ( false === ( $instagram = get_transient( 'instagram-media-new-' . sanitize_title_with_dashes( $username ) ) ) ) {

                $remote = wp_remote_get( 'http://instagram.com/' . trim( $username ) );

                if ( is_wp_error( $remote ) ) {
                    return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'facewp-abbey' ) );
                }

                if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
                    return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'facewp-abbey' ) );
                }

                $shards      = explode( 'window._sharedData = ', $remote[ 'body' ] );
                $insta_json  = explode( ';</script>', $shards[ 1 ] );
                $insta_array = json_decode( $insta_json[ 0 ], true );

                if ( ! $insta_array ) {
                    return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'facewp-abbey' ) );
                }

                // old style
                if ( isset( $insta_array[ 'entry_data' ][ 'UserProfile' ][ 0 ][ 'userMedia' ] ) ) {
                    $media_arr = $insta_array[ 'entry_data' ][ 'UserProfile' ][ 0 ][ 'userMedia' ];
                    $type      = 'old';
                    // new style
                } else if ( isset( $insta_array[ 'entry_data' ][ 'ProfilePage' ][ 0 ][ 'user' ][ 'media' ][ 'nodes' ] ) ) {
                    $media_arr = $insta_array[ 'entry_data' ][ 'ProfilePage' ][ 0 ][ 'user' ][ 'media' ][ 'nodes' ];
                    $type      = 'new';
                } else {
                    return new WP_Error( 'bad_josn_2', esc_html__( 'Instagram has returned invalid data.', 'facewp-abbey' ) );
                }

                if ( ! is_array( $media_arr ) ) {
                    return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'facewp-abbey' ) );
                }

                $instagram = array();

                switch ( $type ) {
                    case 'old':
                        foreach ( $media_arr as $media ) {

                            if ( $media[ 'user' ][ 'username' ] == $username ) {

                                $media[ 'link' ]                            = preg_replace( "/^http:/i", "", $media[ 'link' ] );
                                $media[ 'images' ][ 'thumbnail' ]           = preg_replace( "/^http:/i", "", $media[ 'images' ][ 'thumbnail' ] );
                                $media[ 'images' ][ 'standard_resolution' ] = preg_replace( "/^http:/i", "", $media[ 'images' ][ 'standard_resolution' ] );
                                $media[ 'images' ][ 'low_resolution' ]      = preg_replace( "/^http:/i", "", $media[ 'images' ][ 'low_resolution' ] );

                                $instagram[] = array(
                                    'description' => $media[ 'caption' ][ 'text' ],
                                    'link'        => $media[ 'link' ],
                                    'time'        => $media[ 'created_time' ],
                                    'comments'    => $media[ 'comments' ][ 'count' ],
                                    'likes'       => $media[ 'likes' ][ 'count' ],
                                    'thumbnail'   => $media[ 'images' ][ 'thumbnail' ],
                                    'large'       => $media[ 'images' ][ 'standard_resolution' ],
                                    'small'       => $media[ 'images' ][ 'low_resolution' ],
                                    'type'        => $media[ 'type' ]
                                );
                            }
                        }
                        break;
                    default:
                        foreach ( $media_arr as $media ) {

                            $media[ 'thumbnail_src' ] = preg_replace( "/^http:/i", "", $media[ 'thumbnail_src' ] );

                            if ( $media[ 'is_video' ] == true ) {
                                $type = 'video';
                            } else {
                                $type = 'image';
                            }

                            $instagram[] = array(
                                'description' => esc_html__( 'Instagram Image', 'facewp-abbey' ),
                                'link'        => '//instagram.com/p/' . $media[ 'code' ],
                                'time'        => $media[ 'date' ],
                                'comments'    => $media[ 'comments' ][ 'count' ],
                                'likes'       => $media[ 'likes' ][ 'count' ],
                                'thumbnail'   => $media[ 'thumbnail_src' ],
                                'type'        => $type
                            );
                        }
                        break;
                }

                // do not set an empty transient - should help catch private or empty accounts
                if ( ! empty( $instagram ) ) {
                    $instagram = facewp_bb_en( serialize( $instagram ) );
                    set_transient( 'instagram-media-new-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
                }
            }

            if ( ! empty( $instagram ) ) {

                $instagram = unserialize( facewp_bb_de( $instagram ) );

                return array_slice( $instagram, 0, $slice );;

            } else {

                return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'facewp-abbey' ) );

            }
        }
    } // end class
} // end if