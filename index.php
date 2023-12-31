<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php bloginfo('name'); ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>
		<h1><?php bloginfo('name'); ?></h1>
		<p><?php bloginfo('description'); ?></p>
	</header>

	<nav>
		<?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
	</nav>

	<main>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article <?php post_class(); ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_content(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php _e('Sorry, no posts matched your criteria.', 'textdomain'); ?></p>
		<?php endif; ?>
	</main>

	<footer>
		<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
	</footer>

	<?php wp_footer(); ?>
</body>

</html>