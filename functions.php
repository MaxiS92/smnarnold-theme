<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/utils/inline-css.php',
  'lib/utils/edit-post-before-save.php',    // Performe spomes taks before saving post
  'lib/utils/clean-up.php',                 // Remove wp unacessary components
  'lib/utils/disable-trackbacks.php',       // Remove wp trackbacks and ping
  'lib/utils/amp.php',                // Set up basic amp settings
  'lib/utils/opengraph.php',                // Set basic Opengraph metas 
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
