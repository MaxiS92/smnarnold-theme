<?php
$results = '';

$accounts = new WP_Query(array(
	'post_type' => 'organization', 
	'order' => 'ASC',
	'orderby' => 'name',
	'post_parent' => 0,
    'post_per_page' => -1,
    'nopaging' => true,
));

if ( $accounts->have_posts() ) {
	$results = '<ul class="accounts-list">';

	while ( $accounts->have_posts() ) : $accounts->the_post();
	    $account = (object) array(
	    	'id' => get_the_ID(),
	    	'name' => get_the_title(),
	    	'abbr' => get_field('alternateName'),
	    	'svg' => get_field('svg'),
	    	'brands' => '',
	    );

	    if(!empty($account->abbr)) {
			$account->abbr = '(<abbr title="'. $account->name .'">'. $account->abbr .'</abbr>)';
		}

	    $brands = new WP_Query(array(
	        'post_type' => 'organization',
		    'order' => 'ASC',
		    'orderby' => 'name',
		    'post_parent' => $account->id,
		    'posts_per_page' => -1,
	    ));

	    if ( $brands->have_posts() ) {
	    	$account->brands = '<ul>';

	        while ( $brands->have_posts() ) : $brands->the_post();
	        	$brand = (object) array(
			    	'name' => get_the_title(),
			    	'abbr' => get_field('alternateName'),
			    	'svg' => get_field('svg'),
			    );

			    if(!empty($brand->abbr)) {
					$brand->abbr = '(<abbr title="'. $brand->name .'">'. $brand->abbr .'</abbr>)';
				}

	            $account->brands .= '<li itemscope itemtype="http://schema.org/Organization"><span class="name"><span itemprop="name">' . $brand->name . '</span>' . $brand->abbr . '</span>' . $brand->svg . '</li>';

	        endwhile; $accounts->reset_postdata();

	        $account->brands .= '</ul>';
	    }

	    $results .= '<li itemscope itemtype="http://schema.org/Organization"><span class="name"><span itemprop="name">' . $account->name . '</span>' . $account->abbr . '</span>' . $account->svg . $account->brands . '</li>';

	endwhile;

	$results .= '</ul>';
}

echo $results;