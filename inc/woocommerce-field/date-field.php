<?php


function add_custom_product_date_field()
{
	echo '<div class="product_custom_field">';
	woocommerce_wp_text_input(array('id' => 'custom_date', 'label' => __('Custom Date', 'woocommerce'), 'type' => 'date'));
	echo '</div>';
}


add_action('woocommerce_product_options_general_product_data', 'add_custom_product_date_field');

function save_custom_product_date_field($post_id)
{
	$custom_date = $_POST['custom_date'];
	if (!empty($custom_date)) {
		update_post_meta($post_id, 'custom_date', sanitize_text_field($custom_date));
	}
}

add_action('woocommerce_process_product_meta', 'save_custom_product_date_field');
