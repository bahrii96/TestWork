<?php

function add_custom_update_button()
{
	echo '<div class="product_custom_field">';
	echo '<button type="button" class="button update_product_button">Update Product</button>';
	echo '</div>';
}

add_action('woocommerce_product_options_general_product_data', 'add_custom_update_button');

function custom_update_product_script()
{
?>
	<script>
		jQuery(document).ready(function($) {
			$('.update_product_button').click(function() {
				$('#post').submit();
			});
		});
	</script>
<?php
}

add_action('admin_footer', 'custom_update_product_script');
