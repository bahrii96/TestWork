<?php

/* Custom Theme Settings funcitons.php */

// Adding code before closing head tag

add_action('wp_head', function () {
	if (get_theme_mod('header-scripts-settings')) :
		echo get_theme_mod('header-scripts-settings');
	endif;
});

// Adding code before closing body tag

add_action('wp_footer', function () {
	if (get_theme_mod('footer-scripts-settings')) :
		echo get_theme_mod('footer-scripts-settings');
	endif;
});

/* Custom Theme Settings funcitons.php */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

register_nav_menus(array(
	'primary' => __('Primary Menu'),
));

add_theme_support('post-thumbnails');
//add_image_size('large-preview', 550, 365, true);\



// shortcodes connect
// include 'inc/shortcodes.php';

// theme custom settings



include 'inc/assets.php';
include 'inc/woocommerce-field/image-field.php';
include 'inc/woocommerce-field/date-field.php';
include 'inc/woocommerce-field/type-field.php';
include 'inc/woocommerce-field/clear-fields-button.php';
include 'inc/woocommerce-field/update-button.php';
