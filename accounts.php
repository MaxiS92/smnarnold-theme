<?php
/**
 * Template Name: Accounts
 */

	get_template_part('templates/page-header', get_post_type());
	while (have_posts()) : the_post(); ?>
		<span class="subtitle">
			<?php get_template_part('templates/content', 'page'); ?>
		</span>
	<?php endwhile; 
	get_template_part('templates/accounts-list', get_post_type());
?>