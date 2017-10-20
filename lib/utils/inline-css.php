<?php
// calculates the luminosity of an given RGB color
// the color code must be in the format of RRGGBB
// the luminosity equations are from the WCAG 2 requirements
// http://www.w3.org/TR/WCAG20/#relativeluminancedef
function calculateLuminosity($color) {

    $r = hexdec(substr($color, 0, 2)) / 255; // red value
    $g = hexdec(substr($color, 2, 2)) / 255; // green value
    $b = hexdec(substr($color, 4, 2)) / 255; // blue value
    if ($r <= 0.03928) {
        $r = $r / 12.92;
    } else {
        $r = pow((($r + 0.055) / 1.055), 2.4);
    }

    if ($g <= 0.03928) {
        $g = $g / 12.92;
    } else {
        $g = pow((($g + 0.055) / 1.055), 2.4);
    }

    if ($b <= 0.03928) {
        $b = $b / 12.92;
    } else {
        $b = pow((($b + 0.055) / 1.055), 2.4);
    }

    $luminosity = 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
    return $luminosity;
}

// calculates the luminosity ratio of two colors
// the luminosity ratio equations are from the WCAG 2 requirements
// http://www.w3.org/TR/WCAG20/#contrast-ratiodef
function calculateLuminosityRatio($color1, $color2) {
    $l1 = calculateLuminosity($color1);
    $l2 = calculateLuminosity($color2);

    if ($l1 > $l2) {
        $ratio = (($l1 + 0.05) / ($l2 + 0.05));
    } else {
        $ratio = (($l2 + 0.05) / ($l1 + 0.05));
    }
    return $ratio;
}

function get_api_colors() {
  $colorsArr = [];
  $keepRequesting = true;

  while($keepRequesting){
    $colorsApiUrl = "https://www.colourlovers.com/api/palettes/random?format=json";
    $colorsJson = file_get_contents($colorsApiUrl);
    $colorsArr = json_decode($colorsJson)[0]->colors;
    $colors = [$colorsArr[0], $colorsArr[1]];
    array_shift($colorsArr);
    $currentContrast = 3;

    foreach($colorsArr as $color) {
      $contrast = calculateLuminosityRatio($colors[0], $color);
      if($contrast > $currentContrast) {
        $currentContrast = $contrast;
        $keepRequesting = false;
        $colors[1] = $color;
      }
    }
  }
  
  return $colorsArr;
}

function orderby_darkness($colors) {
  usort($colors, function($c1, $c2) {
      list($r1, $g1, $b1) = sscanf('#' . $c1, "#%02x%02x%02x");
      list($r2, $g2, $b2) = sscanf('#' . $c2, "#%02x%02x%02x");

      return ($r1 + $g1 + $b1) > ($r2 + $g2 + $b2);
  });

  return $colors;
}

function set_inline_css() {
	global $post;
  global $colors;

  $current_user = wp_get_current_user();
  if (user_can( $current_user, 'administrator' )) {
    $colors = orderby_darkness( get_api_colors() );
  } else {
    $jsonPath = get_template_directory() . '/dist/colors.json';
    $json = json_decode(file_get_contents($jsonPath),true);
    $pos = rand( 0, count($json)-1 );
    $colors = $json[$pos];
  }

  $template = preg_replace('/\\.[^.\\s]{3,4}$/', '', get_page_template_slug());

	$css = file_get_contents(get_template_directory() . '/dist/styles/main.css');

  $templateName = preg_replace('/\\.[^.\\s]{3,4}$/', '', get_page_template_slug());
  $templateCssPath = get_template_directory() . '/dist/styles/'. $templateName .'.css';

  if (file_exists($templateCssPath)) {
    $css .= file_get_contents($templateCssPath);
  }

	echo '<style amp-custom>';
	echo ':root {';
		  echo '--c1: #'. $colors[0] . ';';
		  echo '--c2: #'. $colors[1] .';';
	echo '}';
	echo $css;
	echo '</style>';	
}

add_action( 'wp_head', __NAMESPACE__ . '\\set_inline_css', 5 );