<?php
/**
 * Template Name: Lab
 */
	get_template_part('templates/page', 'header');

	while (have_posts()) : the_post();
		do_shortcode( get_template_part('templates/content', 'page') );

		$args = array(
			'order' => 'ASC',
			'post_parent' => $post->ID,
			'post_status' => 'publish',
			'orderby' => 'menu_order'
		);

		$pages = get_children( $args );

		if ( $pages ) {
			echo '<div class="href-grid-list"><ul>';
			foreach ( $pages as $page ) {
				echo '<li><a href="'. get_permalink($page->ID) .'">'. $page->post_title .'</a></li>';
			}
			echo '</ul></div>';
		}
	endwhile; 
?>
