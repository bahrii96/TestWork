<?php

/**
 * Custom Post Type Search form
 *
 * @package Aquila
 */

?>

<div class="search">
	<form role="search" method="get" id="searchform block" class="search__search-form" action="<?php echo esc_url(home_url('/')); ?>">
		<div class="relative">
			<label class="screen-reader-text" for="s"><?php esc_html_e('Search for:', 'text-domain'); ?></label>
			<input id="search-field" type="search" class="search-field outline-none" placeholder="Search Here..." name="s" />
			<input type="hidden" name="post_type" value="custom-post-type-slug" />
			<button class="search-button" type="submit" id="searchsubmit">
				<span class="sr-only"><?php esc_html_e('Search', 'text-domain'); ?></span>
				<div class="search__icon-search">
					<i class="fas fa-search"></i>
				</div>
			</button>
		</div>
	</form>
</div>