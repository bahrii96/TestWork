<?php

function add_product_image_field()
{
	global $post;

	echo '<div class="product_image_custom_field">';

	$product_image_id = get_post_meta($post->ID, '_product_image_id', true);
	$product_image_url = wp_get_attachment_url($product_image_id);

	echo '<div class="image-preview">';
	if ($product_image_url) {
		echo '<img src="' . esc_url($product_image_url) . '" alt="Product Image" style="max-width:350px;height:auto;" />';
	}
	echo '</div>';

	echo '<input type="hidden" name="_product_image_id" id="_product_image_id" value="' . esc_attr($product_image_id) . '" />';
	echo '<button type="button" class="button button-secondary" id="upload_image_button" style="margin:5px;">' . __('Upload Image', 'your_text_domain') . '</button>';
	echo '<button type="button" class="button button-secondary" id="remove_image_button" style="margin:5px;">' . __('Remove Image', 'your_text_domain') . '</button>';
	echo '</div>';

?>
	<script>
		jQuery(document).ready(function($) {
			let frame;
			$('#upload_image_button').on('click', function(e) {
				e.preventDefault();

				if (frame) {
					frame.open();
					return;
				}

				frame = wp.media({
					title: 'Select or Upload Image',
					button: {
						text: 'Use this image'
					},
					multiple: false
				});

				frame.on('select', function() {
					let attachment = frame.state().get('selection').first().toJSON();
					$('#_product_image_id').val(attachment.id);
					$('.image-preview').html('<img src="' + attachment.url + '" alt="Product Image" style="max-width:350px;height:auto;" />');
				});

				frame.open();
			});

			$('#remove_image_button').on('click', function() {
				$('#_product_image_id').val('');
				$('.image-preview').html('');
			});
		});
	</script>
<?php
}
add_action('woocommerce_product_options_general_product_data', 'add_product_image_field');

function save_product_image_field($post_id)
{
	$product_image_id = sanitize_text_field($_POST['_product_image_id']);
	update_post_meta($post_id, '_product_image_id', $product_image_id);

	if ($product_image_id) {
		set_post_thumbnail($post_id, $product_image_id);
	}
}
add_action('woocommerce_process_product_meta', 'save_product_image_field');
