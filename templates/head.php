<head>
	<meta charset="utf-8">
	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
	<script async src="https://cdn.ampproject.org/v0.js"></script>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Rubik:900|Roboto+Mono:400,400i">
	
	<link rel="apple-touch-icon" href="touch-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/<?php echo get_template_directory_uri(); ?>dist/images/favicons/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="167x167" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicons/touch-icon-ipad-retina.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicons/touch-icon-ipad-retina.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicons/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicons/manifest.json">
	<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicons/safari-pinned-tab.svg" color="#4ce0b3">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicons/favicon.ico">
	<meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/dist/images/favicons/browserconfig.xml">
	
	<?php 
		wp_head(); 
		global $colors;
	?>

	<meta name="theme-color" content="<?php echo '#' . $colors[0] ?>">
</head>