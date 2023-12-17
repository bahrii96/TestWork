<?php
/*
Template Name: Home Page
*/

get_header(); ?>

<section class="hero-services">
	<div class="hero-services__overlay"></div>
	<div class="container">
		<div class="hero-services__content">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</div>
</section>

<section class="product-block">
	<div class="container">
		<div class="product-block__list">
			<?php
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1, // Вивести всі продукти
			);
			$products_query = new WP_Query($args);
			if ($products_query->have_posts()) :
				while ($products_query->have_posts()) : $products_query->the_post();
					global $product;

					$product_id = $product->get_id();
					$product_title = get_the_title();
					$product_price = $product->get_price_html();
					$product_excerpt = get_post_field('post_excerpt', $product_id);

					$custom_date = get_post_meta($product_id, 'custom_date', true);
					$custom_type = get_post_meta($product_id, 'custom_type', true);

					$product_image_id = $product->get_image_id();
					$product_image_url = ($product_image_id) ? wp_get_attachment_image_url($product_image_id, 'full') : 'http:/wp-content/uploads/woocommerce-placeholder.png';

					$product_link = get_permalink($product_id);
			?>
					<a href="<?php echo esc_url($product_link); ?>" class="product-block__item">
						<div class="product-block__item-img">
							<div class="product-block__item-img-line">
								<div class="product-block__item-img-box">
									<?php if ($product_image_url) : ?>
										<img src="<?php echo esc_url($product_image_url); ?>" alt="<?php echo esc_attr($product_title); ?>">
									<?php endif; ?>
								</div>
								<div class="product-block__item-img-inf">
									<?php if ($product_excerpt) : ?>
										<div class="product-block__item-img-caption"> <?php echo $product_excerpt ?></div>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<h3 class="product-block__item-short-title"><?php echo esc_html($product_title); ?></h3>
						<div class="product-block__item-meta"> <?php if ($product_price) : ?>
								<p><?php echo $product_price; ?></p>
							<?php endif; ?>
							<?php if ($custom_date) : ?>
								<p>Custom Date: <?php echo esc_html($custom_date); ?></p>
							<?php endif; ?>
							<?php if ($custom_type) : ?>
								<p>Custom Type: <?php echo esc_html($custom_type); ?></p>
							<?php endif; ?>
						</div>
					</a>
			<?php
				endwhile;
				wp_reset_postdata();
			else :
				echo 'No products to display...';
			endif;
			?>

		</div>
	</div>
</section>

<?php
get_footer();
?>