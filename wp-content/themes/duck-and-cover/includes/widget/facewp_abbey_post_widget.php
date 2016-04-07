<?php
/**
 * Plugin Name: Latest Posts Widget
 */

if ( ! class_exists( 'FaceWP_Abbey_Latest_Posts_Widget' ) ) {
    add_action( 'widgets_init', 'load_facewp_abbey_latest_posts_widget' );

    function load_facewp_abbey_latest_posts_widget() {
        register_widget( 'FaceWP_Abbey_Latest_Posts_Widget' );
    }

    class FaceWP_Abbey_Latest_Posts_Widget extends WP_Widget {

        /**
         * Widget setup.
         */
        function __construct() {
            /* Widget settings. */
            $widget_ops = array(
                'classname'   => 'facewp_abbey_latest_posts_widget',
                'description' => esc_html__( 'A widget that displays your latest posts from all categories or a certain', 'facewp-abbey' ),
            );

            /* Widget control settings. */
            $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'facewp_abbey_latest_posts_widget' );

            /* Create the widget. */
            parent::__construct( 'facewp_abbey_latest_posts_widget', esc_html__( 'FaceWP - Latest Posts', 'facewp-abbey' ), $widget_ops, $control_ops );
        }

        function facewp_abbey_latest_posts_widget() {
            $this->__construct();
        }

        /**
         * How to display the widget on the screen.
         */
        function widget( $args, $instance ) {
            extract( $args );

            /* Our variables from the widget settings. */
            $title      = apply_filters( 'widget_title', $instance['title'] );
            $categories = $instance['categories'];
            $number     = $instance['number'];


            $query = array(
                'showposts'           => $number,
                'nopaging'            => 0,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'cat'                 => $categories,
            );

            $loop = new WP_Query( $query );
            if ( $loop->have_posts() ) :

                /* Before widget (defined by themes). */
                echo '' . $before_widget;

                /* Display the widget title if one was input (before and after defined by themes). */
                if ( $title ) {
                    echo '' . $before_title . $title . $after_title;
                }

                ?>
                <ul class="facewp-recent-entries">

                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <li>
                    <?php get_template_part( 'template-parts/content', 'simple' ); ?>
                </li>

            <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>

            </ul>

            <?php

            /* After widget (defined by themes). */
            echo '' . $after_widget;
        }

        /**
         * Update the widget settings.
         */
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            /* Strip tags for title and name to remove HTML (important for text inputs). */
            $instance['title']      = strip_tags( $new_instance['title'] );
            $instance['categories'] = $new_instance['categories'];
            $instance['number']     = strip_tags( $new_instance['number'] );

            return $instance;
        }

        function form( $instance ) {

            /* Set up some default widget settings. */
            $defaults = array(
                'title'      => esc_html__( 'Recent Posts', 'facewp-abbey' ),
                'number'     => 5,
                'categories' => '',
            );
            $instance = wp_parse_args( (array) $instance, $defaults ); ?>

            <!-- Widget Title: Text Input -->
            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'facewp-abbey' ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                       value="<?php echo esc_attr( $instance['title'] ); ?>" />
            </p>

            <!-- Category -->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>">Filter by Category:</label>
                <select id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"
                        name="<?php echo esc_attr( $this->get_field_name( 'categories' ) ); ?>" class="widefat categories"
                        style="width:100%;">
                    <option value='all' <?php if ( 'all' == $instance['categories'] ) {
                        echo 'selected="selected"';
                    } ?>><?php esc_html_e( 'All Categories', 'facewp-abbey' ); ?></option>
                    <?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
                    <?php foreach ( $categories as $category ) { ?>
                        <option
                            value='<?php echo esc_attr( $category->term_id ); ?>' <?php if ( $category->term_id == $instance['categories'] ) {
                            echo 'selected="selected"';
                        } ?>><?php echo '' . $category->cat_name; ?></option>
                    <?php } ?>
                </select>
            </p>

            <!-- Number of posts -->
            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'facewp-abbey' ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>"
                       value="<?php echo esc_attr( $instance['number'] ); ?>" size="3" />
            </p>

            <?php
        }
    } //end class
}
?>