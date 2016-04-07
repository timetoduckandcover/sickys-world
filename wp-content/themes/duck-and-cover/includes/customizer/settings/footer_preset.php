<?php
$section  = 'footer_preset';
$priority = 1;

Kirki::add_field( 'infinity', array(
    'type'        => 'preset',
    'settings'    => 'footer_preset',
    'label'       => __( 'Footer Preset', 'facewp-abbey' ),
    'section'   => $section,
    'priority'    => $priority ++,
    'description' => esc_html__( 'Choose footer style from our predefined presets', 'facewp-abbey' ),
    'default'     => '1',
    'choices'     => array(
        '1' => array(
            'label'    => __( 'Preset 1', 'facewp-abbey' ),
            'settings' => array(
                'footer_type' => 'footer-01',
                'footer_background_color' => '#FFF',
                'footer_color' => '#000',
            ),
        ),
        '2' => array(
            'label'    => __( 'Preset 2', 'facewp-abbey' ),
            'settings' => array(
                'footer_type' => 'footer-02',
                'footer_background_color' => '#FFF',
                'footer_color' => '#000',
                'footer_extra_info_content' => '
                    <div class="row row-xs-center">
                        <div class="col-md-4">
                            <img src="http://abbey.facewp.com/wp-content/uploads/2016/01/logo_bigger_horizon.png" alt="Abbey">
                        </div>
                        <div class="col-md-8">
                            <ul class="custom-footer-contact">
                                <li>
                                    <span class="pe-7s-map-marker"></span><span class="custom-contact-text">21 Love Lane, New York, United States 01920</span>
                                </li>
                                <li>
                                    <span class="pe-7s-call"></span><span class="custom-contact-text">(800) 0123 456 789</span>
                                </li>
                                <li>
                                    <span class="pe-7s-mail"></span><span class="custom-contact-text">info@abbey.com - website: www.abbey.com</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                ',
                'footer_copyright_content' => '
                    <p>2016 - FaceWP. All Rights Reserved.</p>
                    <img src="http://abbey.facewp.com/wp-content/uploads/2016/01/payment.jpg" alt="payment" />
                ',
            ),
        ),
        '3' => array(
            'label'    => __( 'Preset 3', 'facewp-abbey' ),
            'settings' => array(
                'footer_type' => 'footer-01',
                'footer_background_color' => '#FFF',
                'footer_color' => '#000',
            ),
        ),
        '4' => array(
            'label'    => __( 'Preset 4', 'facewp-abbey' ),
            'settings' => array(
                'footer_type' => 'footer-01',
                'footer_background_color' => '#000',
                'footer_color' => '#FFF',
            ),
        ),
        '5' => array(
            'label'    => __( 'Preset 5', 'facewp-abbey' ),
            'settings' => array(
                'footer_type' => 'footer-03',
                'footer_background_color' => '#F7F7F7',
                'footer_color' => '#000',
                'footer_copyright_enable' => esc_html__( '2016 - FaceWP. All Rights Reserved.', 'facewp-abbey' )
            ),
        ),
    ),
) );