<?php
/*
Template Name: Create Product
*/

// session_start();


if (
	$_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_product'])
) {
	$product_data = array(
		'post_title' => sanitize_text_field($_POST['product_title']),
		'post_content' => '',
		'post_status' => 'publish',
		'post_type' => 'product',
	);

	$product_id = wp_insert_post($product_data);

	if ($product_id) {
		update_post_meta($product_id, '_regular_price', sanitize_text_field($_POST['product_price']));
		update_post_meta($product_id, '_price', sanitize_text_field($_POST['product_price']));

		if (isset($_FILES['custom_image']) && !empty($_FILES['custom_image']['tmp_name'])) {
			$attachment_id = upload_product_image($_FILES['custom_image']);
			if ($attachment_id) {
				update_post_meta($product_id, '_product_image_id', $attachment_id);
				set_post_thumbnail($product_id, $attachment_id);
			}
		}


		if (isset($_POST['custom_date'])) {
			update_post_meta($product_id, 'custom_date', sanitize_text_field($_POST['custom_date']));
		}

		if (isset($_POST['custom_type'])) {
			update_post_meta($product_id, 'custom_type', sanitize_text_field($_POST['custom_type']));
		}
	}

	if ($product_id) {
		$success_message = 'Product successfully added!';
		$_SESSION['success_message'] = $success_message;
		wp_safe_redirect(add_query_arg(array('success' => '1')));
		exit;
	}
}

function upload_product_image($file)
{
	$upload_dir = wp_upload_dir();
	$upload_path = $upload_dir['path'];

	$file_name = basename($file['name']);
	$upload_file = $upload_path . '/' . $file_name;
	move_uploaded_file($file['tmp_name'], $upload_file);

	$attachment = array(
		'post_mime_type' => $file['type'],
		'post_title'     => sanitize_file_name($file_name),
		'post_content'   => '',
		'post_status'    => 'inherit',
	);

	$attachment_id = wp_insert_attachment($attachment, $upload_file);

	require_once(ABSPATH . 'wp-admin/includes/image.php');
	$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file);
	wp_update_attachment_metadata($attachment_id, $attachment_data);

	return $attachment_id;
}

if (isset($_SESSION['success_message'])) {
	$success_message = $_SESSION['success_message'];
	unset($_SESSION['success_message']);
}

get_header(); ?>

<main id="main" class="site-main" role="main">

	<section class="hero-services">
		<div class="hero-services__overlay"></div>
		<div class="container">
			<div class="hero-services__content">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</div>
		</div>
	</section>

	<section class="form-block">
		<div class="container"> <?php if (!empty($success_message)) : ?>
				<p class="success-message"><?php echo esc_html($success_message); ?></p>
			<?php endif; ?>
			<form method="post" action="" enctype="multipart/form-data">
				<div class="form-block__box">
					<p><label for="product_title">Product Title:</label>
						<input type="text" name="product_title" id="product_title" required>
					</p>
					<p><label for="product_price">Product Price:</label>
						<input type="text" name="product_price" id="product_price" required>
					</p>
				</div>
				<div class="form-block__box">
					<p><label for="custom_image">Custom Image:</label>
						<input type="file" name="custom_image" id="custom_image">
					</p>
					<p><button type="button" id="clear_image_field_button" class="btn">Clear Image Field</button></p>
				</div>
				<div class="form-block__box">
					<p> <label for="custom_date">Custom Date:</label>
						<input type="date" name="custom_date" id="custom_date">
					</p>
					<p><label for="custom_type">Custom Type:</label>
						<select name="custom_type" id="custom_type">
							<option value="">Select Type</option>
							<option value="rare">Rare</option>
							<option value="frequent">Frequent</option>
							<option value="unusual">Unusual</option>
						</select>
					</p>
				</div>
				<button type="button" id="clear_fields_button" class="btn btn-full">Clear Fields</button>
				<input type="submit" name="submit_product" value="Submit Product" class="btn btn-full">
			</form>
		</div>
	</section>
</main>

<?php get_footer(); ?>