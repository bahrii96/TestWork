<?php

function detect_assets()
{

	wp_deregister_script('jquery');

	if (!is_admin()) {

		/*--------------------------------------------------
		-------------- Connect main style ----------- 
		---------------------------------------------------*/

		wp_enqueue_style('main-styles', get_stylesheet_directory_uri()
			. '/assets/css/main.css', array(), null);



		/*--------------------------------------------------
		-------------- Other Styles Scripts ----------- 
		---------------------------------------------------*/


		if (is_page_template('views/create-product.php')) {
			wp_enqueue_style('create-product', get_stylesheet_directory_uri()
				. '/assets/css/templates/create-product.css', array(), null);
		}

		if (is_page_template('views/home-template.php')) {
			wp_enqueue_style('home-template', get_stylesheet_directory_uri()
				. '/assets/css/templates/home-template.css', array(), null);
		}


		wp_enqueue_script('jquery', get_stylesheet_directory_uri()
			. '/assets/libs/jquery/jquery.min.js', '', '', true);

		wp_enqueue_script('main-scripts', get_stylesheet_directory_uri()
			. '/assets/js/main.js', '', '', true);
	}
}

add_action('wp_enqueue_scripts', 'detect_assets');
