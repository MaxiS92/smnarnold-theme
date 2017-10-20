<?php
/**
 * Template Name: Now
 */
	get_template_part('templates/page', 'header');

	while (have_posts()) : the_post(); ?>

		<div class="subtitle">
			Dernière mise à jours: 
			<time class="updated" datetime="<?= get_the_modified_date('c', true); ?>"><?= get_the_modified_date(); ?></time>
	 	</div>

		<?php get_template_part('templates/content', 'page');
	endwhile; 
?>

<p class="subtitle">
	<em>Inspiré par <a href="https://www.johanbrook.com/now/" itemscope itemtype="http://schema.org/Person"><meta itemprop="url" content="https://www.johanbrook.com/"><span itemprop="givenName">Johan</span> <span itemprop="familyName">Brook</span></a></em><br>
	<a href="http://nownownow.com/about">Pourquoi&thinsp;?</a>
</p>
