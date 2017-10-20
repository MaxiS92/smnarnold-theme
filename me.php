<?php
/**
 * Template Name: Me
 */

	the_posts_navigation();

	/* Content */
	while (have_posts()) : the_post();
	  get_template_part('templates/content', 'page');
	endwhile; 

	/* Quote */
	$options = array('post_type' => 'quote', 
					 'orderby' => 'rand',
	                 'posts_per_page' => 1);
	$quotes_query = new WP_Query( $options );

	if ( $quotes_query->have_posts() ) {
		while ( $quotes_query->have_posts() ) : $quotes_query->the_post();
			echo get_the_content();
		endwhile;
	}
?>

<!-- Logo -->
<span class="logo"></span>