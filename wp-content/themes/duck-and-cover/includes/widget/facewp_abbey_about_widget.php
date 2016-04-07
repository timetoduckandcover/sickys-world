<?php
/**
 * Plugin Name: About Widget
 */

if ( ! class_exists( 'FaceWP_Abbey_About_Widget' ) ) {

    add_action( 'widgets_init', 'load_facewp_abbey_about_widget' );

    function load_facewp_abbey_about_widget() {
        register_widget( 'FaceWP_Abbey_About_Widget' );
    }

    class FaceWP_Abbey_About_Widget extends WP_Widget {

        /**
         * Widget setup.
         */
        function __construct() {
            /* Widget settings. */
            $widget_ops = array( 'classname'   => 'facewp_abbey_about_widget',
                                 'description' => esc_html__( 'A widget that displays an About widget', 'facewp-abbey' )
            );

            /* Widget control settings. */
            $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'facewp_abbey_about_widget' );

            /* Create the widget. */
            parent::__construct( 'facewp_abbey_about_widget', esc_html__( 'FaceWP - About Me', 'facewp-abbey' ), $widget_ops, $control_ops );
        }

        function facewp_abbey_about_widget() {
            $this->__construct();
        }

        /**
         * How to display the widget on the screen.
         */
        function widget( $args, $instance ) {
            extract( $args );

            /* Our variables from the widget settings. */
            $title       = apply_filters( 'widget_title', $instance[ 'title' ] );
            $image       = $instance[ 'image' ];
            $name        = $instance[ 'name' ];
            $information = $instance[ 'information' ];
            $description = $instance[ 'description' ];

            /* Before widget (defined by themes). */
            echo '' . $before_widget;

            /* Display the widget title if one was input (before and after defined by themes). */
            if ( $title ) {
                echo '' . $before_title . $title . $after_title;
            }

            ?>

            <div class="facewp-about-widget">

                <?php if ( $image ) : ?>
                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_html( $title ); ?>" />
                <?php endif; ?>

                <?php if ( $name ) : ?>
                    <p class="facewp-about-widget-name"><?php echo wp_kses_post( $name ); ?></p>
                <?php endif; ?>

                <?php if ( $information ) : ?>
                    <p class="facewp-about-widget-information"><?php echo wp_kses_post( $information ); ?></p>
                <?php endif; ?>

                <?php if ( $description ) : ?>
                    <p class="facewp-about-widget-description"><?php echo wp_kses_post( $description ); ?></p>
                <?php endif; ?>

            </div>

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
            $instance[ 'title' ]       = strip_tags( $new_instance[ 'title' ] );
            $instance[ 'image' ]       = strip_tags( $new_instance[ 'image' ] );
            $instance[ 'name' ]        = strip_tags( $new_instance[ 'name' ] );
            $instance[ 'information' ] = strip_tags( $new_instance[ 'information' ] );
            $instance[ 'description' ] = $new_instance[ 'description' ];

            return $instance;
        }

        function form( $instance ) {

            /* Set up some default widget settings. */
            $defaults = array( 'title'       => 'About Me',
                               'image'       => '',
                               'name'        => '',
                               'information' => '',
                               'description' => ''
            );
            $instance = wp_parse_args( (array) $instance, $defaults ); ?>

            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'facewp-abbey' ) ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                       value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" style="width:96%;" />
            </p>

            <!-- image url -->
            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image URL:', 'facewp-abbey' ) ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>"
                       value="<?php echo esc_attr( $instance[ 'image' ] ); ?>" style="width:96%;" /><br />
            </p>

            <!-- name -->
            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Name:', 'facewp-abbey' ) ?></label>
                <textarea id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"
                          name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>"
                          style="width:95%;"><?php echo '' . $instance[ 'name' ]; ?></textarea>
            </p>

            <!-- information -->
            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'information' ) ); ?>"><?php esc_html_e( 'Information:', 'facewp-abbey' ) ?></label>
                <textarea id="<?php echo esc_attr( $this->get_field_id( 'information' ) ); ?>"
                          name="<?php echo esc_attr( $this->get_field_name( 'information' ) ); ?>"
                          style="width:95%;"><?php echo '' . $instance[ 'information' ]; ?></textarea>
            </p>

            <!-- description -->
            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description:', 'facewp-abbey' ) ?></label>
                <textarea id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
                          name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" style="width:95%;"
                          rows="6"><?php echo '' . $instance[ 'description' ]; ?></textarea>
            </p>

            <?php
        }
    } // end class
} // end if
?>