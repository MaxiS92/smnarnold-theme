<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  global $current_user;
  $user_role = array_shift($current_user->roles);
  
  $classes[] = 'role-'. $user_role;

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

function hide_admin_bar_from_front_end(){
  if (is_blog_admin()) {
    return true;
  }
  return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );

function has_children() {
  global $post;
  $args = array(
      'child_of'  => $post->ID,
      'post_type' => 'product'
  );
  $pages = get_pages($args);
  return count($pages);
}

function is_top_level() {
  global $post, $wpdb;
  $current_page = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID = " . $post->ID);
  return $current_page;
}

function override_mce_options($initArray) {
  $opts = '*[*]';
  $initArray['valid_elements'] = $opts;
  $initArray['extended_valid_elements'] = $opts;
  return $initArray;
 }
 add_filter('tiny_mce_before_init', 'override_mce_options');

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

add_action('wp_head', 'wpse_wp_head');

function wpse_wp_head() {
  // first make sure this is a single post/page
  if( !is_page() || !is_single() )
      return;

  // then get the post data
  $post = get_post();

  echo '<meta name="post_id" value="'. $post->ID .'" />';
}


function foobar_func( $atts ){
  return "foo and bar";
}
add_shortcode( 'foobar', __NAMESPACE__ . '\\foobar_func' );


function person_shortcode($atts, $content) {
  $name = explode(".", $content);
  $given_name = '<span itemprop="givenName">'. ucwords($name[0]) .'</span>';
  $last_name = ' <span itemprop="familyName">'. ucwords($name[1]) .'</span>';
  $tag_start = '<span itemscope itemtype="http://schema.org/Person">';
  $tag_end = '</span>';

  if(!empty( $atts['href'] )) {
    $tag_start = '<a href="'. $atts['href'] .'" itemscope itemtype="http://schema.org/Person"><meta itemprop="url" content="'. $atts['href'] .'">';
    $tag_end = '</a>';
  }

  if(!empty( $atts['friendly'] )) {
    $last_name = '<meta itemprop="familyName" content="'. ucwords($name[1]) .'">';
  }
  
  $html = $tag_start . $given_name . $last_name . $tag_end;

  return $html;
}
add_shortcode('person', __NAMESPACE__ . '\\person_shortcode');