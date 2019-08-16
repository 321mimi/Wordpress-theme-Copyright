<?php 
/**
 * functions.php
 *      Menu:
 *          Copyright function
 *          Customizer
 *              Add panel
 *              Add section to panel
 *              Add setting
 *              Add control to section
 */

// Copyright function
function copyright() {
    // Years
    $startYear = get_theme_mod('footer-copyright-year');
    $defaultStartYear = mysql2date('Y', get_user_option('user_registered', 1));
    $currYear = date("Y");
    if (!empty($startYear)) {
        if ($startYear == $currYear) {
            $years = $startYear;
        } else {
            $years = $startYear." - " . $currYear;
        }
    } else {
        if ($defaultStartYear == $currYear) {
            $years = $defaultStartYear;
        } else {
            $years = $defaultStartYear." - " . $currYear;
        }
    }
    return '&copy; ' . get_bloginfo('name') . ' ' . $years . '. All rights reserved.';
}

// Customizer
function register_theme_customizer($wp_customize) {
    // Add panel
    $wp_customize->add_panel('text', array(
        'priority'       => 500,
        'title'          => __('Text'),
        'description'    => __('Set text for certain content areas.'),
    ));

    // Add section to panel
    $wp_customize->add_section('footer-copyright' , array(
        'title'    => __('Footer Copyright'),
        'panel'    => 'text',
        'priority' => 1
    ));

    // Add setting
    $wp_customize->add_setting('footer-copyright-year');

    // Add control to section
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize, 'footer-copyright-control', array(
            'label'    => __('Start Year'),
            'section'  => 'footer-copyright',
            'settings' => 'footer-copyright-year',
            'type'     => 'number'
    )));
}
add_action('customize_register', 'register_theme_customizer');
