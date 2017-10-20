<?php the_posts_navigation(); ?>


	while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
	<!-- Useless citation pour avoir l'air cool -->
	Je fais des trucs que ta grand mère ne comprendrait probablement pas.

	<span class="logo"></span>



