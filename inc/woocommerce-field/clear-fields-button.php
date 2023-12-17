<?php
function save_all_custom_product_fields($post_id)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	if (isset($_POST['custom_image'])) {
		$custom_image = esc_url_raw($_POST['custom_image']);
		update_post_meta($post_id, 'custom_image', $custom_image);
	}

	if (isset($_POST['custom_date'])) {
		$custom_date = sanitize_text_field($_POST['custom_date']);
		update_post_meta($post_id, 'custom_date', $custom_date);
	}

	if (isset($_POST['custom_type'])) {
		$custom_type = sanitize_text_field($_POST['custom_type']);
		update_post_meta($post_id, 'custom_type', $custom_type);
	}
}

add_action('save_post', 'save_all_custom_product_fields', 10, 1);

function add_custom_clear_fields_button()
{
	echo '<div class="product_custom_field">';
	echo '<button type="button" class="button clear_custom_fields_button" style="margin:5px;">Clear All Fields</button>';
	echo '</div>';
}

add_action('woocommerce_product_options_general_product_data', 'add_custom_clear_fields_button');

function custom_clear_fields_script()
{
?>
	<script>
		jQuery(document).ready(function($) {
			$('.clear_custom_fields_button').click(function() {
				$('.image-preview').html('');
				$('#_product_image_id').val('');
				$('#custom_date').val('');
				$('#custom_type').val('').trigger('change');

			});
		});
	</script>
<?php
}

add_action('admin_footer', 'custom_clear_fields_script');

function update_custom_type_on_save($post_id)
{
	if (isset($_POST['custom_type'])) {
		$custom_type = sanitize_text_field($_POST['custom_type']);
		update_post_meta($post_id, 'custom_type', $custom_type);
	}
}

add_action('save_post', 'update_custom_type_on_save', 10, 1);
