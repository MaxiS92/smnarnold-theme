<?php

/**
 * Google fonts
 */

function google_fonts() {
	if (!is_admin()) {
		wp_register_style('google', 'https://fonts.googleapis.com/css?family=Rubik:900|Roboto+Mono:400,400i');
		wp_enqueue_style('google');
	}
}
add_action('wp_enqueue_scripts', 'google_fonts');