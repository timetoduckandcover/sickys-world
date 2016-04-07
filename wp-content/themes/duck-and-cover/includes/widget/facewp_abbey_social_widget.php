<?php
/**
 * Plugin Name: Social Widget
 */
if ( ! class_exists( 'FaceWP_Abbey_Social_Widget' ) ) {
    add_action('widgets_init', 'load_facewp_abbey_social_widget');

    function load_facewp_abbey_social_widget()
    {
        register_widget('FaceWP_Abbey_Social_Widget');
    }

    class FaceWP_Abbey_Social_Widget extends WP_Widget
    {

        /**
         * Widget setup.
         */
        function __construct()
        {
            /* Widget settings. */
            $widget_ops = array('classname' => 'facewp_abbey_social_widget',
                'description' => esc_html__('A widget that displays your social icons', 'facewp-abbey')
            );

            /* Widget control settings. */
            $control_ops = array('width' => 250, 'height' => 350, 'id_base' => 'facewp_abbey_social_widget');

            /* Create the widget. */
            parent::__construct('facewp_abbey_social_widget', esc_html__('FaceWP - Social Icons', 'facewp-abbey'), $widget_ops, $control_ops);
        }

        function zooka_social_widget()
        {
            $this->__construct();
        }

        /**
         * How to display the widget on the screen.
         */
        function widget($args, $instance)
        {
            extract($args);

            /* Our variables from the widget settings. */
            $title = apply_filters('widget_title', $instance['title']);
            $facebook = $instance['facebook'];
            $twitter = $instance['twitter'];
            $googleplus = $instance['googleplus'];
            $instagram = $instance['instagram'];
            $vk = $instance['vk'];
            $youtube = $instance['youtube'];
            $tumblr = $instance['tumblr'];
            $pinterest = $instance['pinterest'];
            $dribbble = $instance['dribbble'];
            $soundcloud = $instance['soundcloud'];
            $vimeo = $instance['vimeo'];
            $rss = $instance['rss'];

            /* Before widget (defined by themes). */
            echo '' . $before_widget;

            /* Display the widget title if one was input (before and after defined by themes). */
            if ($title) {
                echo '' . $before_title . $title . $after_title;
            }

            ?>

            <div class = "facewp-social-widget">
                <?php if ($facebook) : ?><a href = "<?php echo esc_url($facebook); ?>" target = "_blank"><i
                        class = "fa fa-facebook"></i></a><?php endif; ?>
                <?php if ($twitter) : ?><a href = "<?php echo esc_url($twitter); ?>" target = "_blank"><i
                        class = "fa fa-twitter"></i></a><?php endif; ?>
                <?php if ($instagram) : ?><a href = "<?php echo esc_url($instagram); ?>" target = "_blank"><i
                        class = "fa fa-instagram"></i></a><?php endif; ?>
                <?php if ($pinterest) : ?><a href = "<?php echo esc_url($pinterest); ?>" target = "_blank"><i
                        class = "fa fa-pinterest"></i></a><?php endif; ?>
                <?php if ($vk) : ?><a href = "<?php echo esc_url($vk); ?>" target = "_blank"><i class = "fa fa-vk"></i>
                    </a><?php endif; ?>
                <?php if ($googleplus) : ?><a href = "<?php echo esc_url($googleplus); ?>" target = "_blank"><i
                        class = "fa fa-google-plus"></i></a><?php endif; ?>
                <?php if ($tumblr) : ?><a href = "<?php echo esc_url($tumblr); ?>" target = "_blank"><i
                        class = "fa fa-tumblr"></i></a><?php endif; ?>
                <?php if ($youtube) : ?><a href = "<?php echo esc_url($youtube); ?>" target = "_blank"><i
                        class = "fa fa-youtube-play"></i></a><?php endif; ?>
                <?php if ($dribbble) : ?><a href = "<?php echo esc_url($dribbble); ?>" target = "_blank"><i
                        class = "fa fa-dribbble"></i></a><?php endif; ?>
                <?php if ($soundcloud) : ?><a href = "<?php echo esc_url($soundcloud); ?>" target = "_blank"><i
                        class = "fa fa-soundcloud"></i></a><?php endif; ?>
                <?php if ($vimeo) : ?><a href = "<?php echo esc_url($vimeo); ?>" target = "_blank"><i
                        class = "fa fa-vimeo-square"></i></a><?php endif; ?>
                <?php if ($rss) : ?><a href = "<?php echo esc_url($rss); ?>" target = "_blank"><i
                        class = "fa fa-rss"></i>
                    </a><?php endif; ?>
            </div>

            <?php

            /* After widget (defined by themes). */
            echo '' . $after_widget;
        }

        /**
         * Update the widget settings.
         */
        function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            /* Strip tags for title and name to remove HTML (important for text inputs). */
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['facebook'] = strip_tags($new_instance['facebook']);
            $instance['twitter'] = strip_tags($new_instance['twitter']);
            $instance['googleplus'] = strip_tags($new_instance['googleplus']);
            $instance['instagram'] = strip_tags($new_instance['instagram']);
            $instance['vk'] = strip_tags($new_instance['vk']);
            $instance['youtube'] = strip_tags($new_instance['youtube']);
            $instance['tumblr'] = strip_tags($new_instance['tumblr']);
            $instance['pinterest'] = strip_tags($new_instance['pinterest']);
            $instance['dribbble'] = strip_tags($new_instance['dribbble']);
            $instance['soundcloud'] = strip_tags($new_instance['soundcloud']);
            $instance['vimeo'] = strip_tags($new_instance['vimeo']);
            $instance['rss'] = strip_tags($new_instance['rss']);

            return $instance;
        }

        function form($instance)
        {

            /* Set up some default widget settings. */
            $defaults = array('title' => 'Follow Us',
                'facebook' => '',
                'twitter' => '',
                'instagram' => '',
                'pinterest' => '',
                'vk' => '',
                'googleplus' => '',
                'tumblr' => '',
                'youtube' => '',
                'dribbble' => '',
                'soundcloud' => '',
                'vimeo' => '',
                'rss' => ''
            );
            $instance = wp_parse_args((array)$instance, $defaults); ?>

            <!-- Widget Title: Text Input -->
            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('title')); ?>"
                       value = "<?php echo esc_attr($instance['title']); ?>" style = "width:90%;" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Enter link to Facebook:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('facebook')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('facebook')); ?>"
                       value = "<?php echo esc_attr($instance['facebook']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Enter link to Twitter:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('twitter')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('twitter')); ?>"
                       value = "<?php echo esc_attr($instance['twitter']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php esc_html_e('Enter link to Instagram:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('instagram')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('instagram')); ?>"
                       value = "<?php echo esc_attr($instance['instagram']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php esc_html_e('Enter link to Pinterest:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('pinterest')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('pinterest')); ?>"
                       value = "<?php echo esc_attr($instance['pinterest']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('vk')); ?>"><?php esc_html_e('Enter link to VK:&nbsp;&nbsp;&nbsp;&nbsp;', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('vk')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('vk')); ?>"
                       value = "<?php echo esc_attr($instance['vk']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('googleplus')); ?>"><?php esc_html_e('Enter link to Google Plus:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('googleplus')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('googleplus')); ?>"
                       value = "<?php echo esc_attr($instance['googleplus']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('tumblr')); ?>"><?php esc_html_e('Enter link to Tumblr:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('tumblr')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('tumblr')); ?>"
                       value = "<?php echo esc_attr($instance['tumblr']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php esc_html_e('Enter link to Youtube:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('youtube')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('youtube')); ?>"
                       value = "<?php echo esc_attr($instance['youtube']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('dribbble')); ?>"><?php esc_html_e('Enter link to Dribbble:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('dribbble')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('dribbble')); ?>"
                       value = "<?php echo esc_attr($instance['dribbble']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('soundcloud')); ?>"><?php esc_html_e('Enter link to Soundcloud:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('soundcloud')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('soundcloud')); ?>"
                       value = "<?php echo esc_attr($instance['soundcloud']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('vimeo')); ?>"><?php esc_html_e('Enter link to Vimeo:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('vimeo')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('vimeo')); ?>"
                       value = "<?php echo esc_attr($instance['vimeo']); ?>" />
            </p>

            <p>
                <label
                    for = "<?php echo esc_attr($this->get_field_id('rss')); ?>"><?php esc_html_e('Enter link to RSS:', 'facewp-abbey') ?></label>
                <input id = "<?php echo esc_attr($this->get_field_id('rss')); ?>"
                       name = "<?php echo esc_attr($this->get_field_name('rss')); ?>"
                       value = "<?php echo esc_attr($instance['rss']); ?>" />
            </p>

            <?php
        }
    } //end class
} //end if
?>