<?php

/**
 * Amp ready
 */
function amp_ready() {
  global $post;

  add_filter('show_admin_bar', '__return_false');

  if ( !is_singular()) //if it is not a post or a page
    return;
}

function remove_all_theme_styles() {
    global $wp_styles;
    $wp_styles->queue = array();
}

function remove_all_theme_scripts() {
    global $wp_scripts;
    $wp_scripts->queue = array();
}

function amp_tag_replace($html = '') {
  preg_match_all('/<img[^>]+>/i',$html, $result);

  $img = array();
  foreach( $result as $img_tag) {
      preg_match_all('/(alt|title|src|width|height)=("[^\"\']*")/i',$img_tag, $img2[$img_tag]);
  }

  $amp_img = array();
  foreach( $img as $amp_tag) {
    $amp_img[] = '<amp-img src="'. $amp_tag[0]['src'] .'"></amp-img>';
  }

  $html = str_ireplace(
    $img,
    $amp_img,
    $html
  );

  //list($width, $height, $type, $attr) = getimagesize("img/flag.jpg");

  $html = str_ireplace(
      ['<video','/video>','<audio','/audio>'],
      ['<amp-video','/amp-video>','<amp-audio','/amp-audio>'],
      $html
  );
  # Add closing tags to amp-img custom element
  

  # Whitelist of HTML tags allowed by AMP
  $html = strip_tags($html,'<h1><h2><h3><h4><h5><h6><a><p><ul><ol><li><blockquote><q><cite><ins><del><strong><em><code><pre><svg><table><thead><tbody><tfoot><th><tr><td><dl><dt><dd><article><section><header><footer><aside><figure><time><abbr><div><span><hr><small><br><amp-img><amp-audio><amp-video><amp-ad><amp-anim><amp-carousel><amp-fit-rext><amp-image-lightbox><amp-instagram><amp-lightbox><amp-twitter><amp-youtube>');
  return $html;
}

function amp_edit_post( $content ) {
  global $post;
  if( isset($post) && get_post_type( $post->ID ) == 'post' ){
    $content['post_content'] = amp_tag_replace( $content['post_content'] );
  }
  return $content;
}

function init_amp() {
  echo '<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>';
}

add_action('wp_head', __NAMESPACE__ . '\\init_amp', 1);
add_filter('wp_insert_post_data', 'amp_edit_post');
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\amp_ready', 100);
add_action('wp_print_styles', __NAMESPACE__ . '\\remove_all_theme_styles', 100);
add_action('wp_print_styles', __NAMESPACE__ . '\\remove_all_theme_scripts', 100);
