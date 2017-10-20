<?php

function edit_post_before_save( $content ) {
  global $post;
  if( isset($post) && get_post_type( $post->ID ) == 'post' ){
    $content['post_content'] = setYoutubeUrl( $content['post_content'] );
  }
  return $content;
}

/* Clean Youtube Url */
function setYoutubeUrl($str) {
  $regex = "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#";

  if( preg_match($regex, $str, $matches, PREG_OFFSET_CAPTURE) ) {
    $keyword = $matches[0][0];

    $strPieces = explode(" ", $str);


    foreach($strPieces as $key => $arrayItem) {
        if( stristr( $arrayItem, $keyword ) ) {
            $newUrl = "http://youtu.be/" . $keyword;
            return str_replace($strPieces[$key], $newUrl, $str);
        }
    }
  }

  return $str;
}

add_filter( 'wp_insert_post_data', 'edit_post_before_save' );