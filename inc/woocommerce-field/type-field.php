<?php
function add_custom_product_type_field()
{
	echo '<div class="product_custom_field">';
	woocommerce_wp_select(array('id' => 'custom_type', 'label' => __('Custom Type', 'woocommerce'), 'options' => array('' => __('', 'woocommerce'), 'rare' => __('Rare', 'woocommerce'), 'frequent' => __('Frequent', 'woocommerce'), 'unusual' => __('Unusual', 'woocommerce'))));
	echo '</div>';
}

add_action('woocommerce_product_options_general_product_data', 'add_custom_product_type_field');

function save_custom_product_type_field($post_id)
{
	$custom_type = $_POST['custom_type'];
	if (!empty($custom_type)) {
		update_post_meta($post_id, 'custom_type', sanitize_text_field($custom_type));
	}
}

add_action('woocommerce_process_product_meta', 'save_custom_product_type_field');
