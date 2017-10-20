<?php
/**
 * Template Name: Logs
 */ 
?>

<div itemscope itemtype="http://schema.org/Person" id="simon">
	<meta itemprop="givenName" content="Simon">
	<meta itemprop="familyName" content="Arnold">

	<?php 
		while (have_posts()) : the_post(); ?>
		  <?php get_template_part('templates/page', 'header'); ?>
			<div class="subtitle">
				Ma vie en historique - Jetez un oeil à <a href="./now">ce que je fais en ce moment</a>.
			</div>
		  <?php get_template_part('templates/content', 'page');
		endwhile; 
	?>
</div>