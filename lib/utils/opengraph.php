<?php

/**
 * Opengraph
 */
function set_opengraph() {
  global $post;

  if ( !is_singular()) //if it is not a post or a page
  	return;

  $description = get_field("description");
  $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

  if(empty($thumbnail_src)) {
    $ancestorsArr = get_ancestors( $post->ID, 'page', 'post_type' );
    $ancestor = end( $ancestorsArr );
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $ancestor ), 'full' );
  }
  echo '<meta property="fb:app_id" content="90061081536476" />';
  echo '<meta property="og:locale" content="fr_CA" />';
  echo '<meta name="twitter:card" content="summary" />';
  echo '<meta property="og:type" content="website"/>';
  echo '<meta property="og:title" name="twitter:title" content="' . get_the_title() . ' | ' . get_bloginfo( 'name' ) . '"/>';
  if( $description ) {
  	echo '<meta property="og:description" name="twitter:description" content="' . $description . '"/>';
  }
  echo '<meta property="og:url" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
  echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '"/>';
  echo '<meta property="og:image" name="twitter:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
  echo '<meta property="og:image:width" content="' . esc_attr( $thumbnail_src[1] ) . '"/>';
  echo '<meta property="og:image:height" content="' . esc_attr( $thumbnail_src[2] ) . '"/>';
  echo '<meta name="twitter:site" content="@smnarnold" />';
}

add_action( 'wp_head', __NAMESPACE__ . '\\set_opengraph', 5 );