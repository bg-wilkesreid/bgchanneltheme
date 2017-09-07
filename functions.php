<?php

define('BGCHANNELTHEME_VERSION', '0.0.1');

$bgchanneltheme_dir = get_template_directory();

require $bgchanneltheme_dir . "/vendor/autoload.php";

$bgchanneltheme_enabled_modules = [
  [
    'file' => 'video/single',
    'class' => 'BGChannel_SingleVideoModule'
  ],
  [
    'file' => 'video/hero',
    'class' => 'BGChannel_HeroVideoModule'
  ]
];

// Theme Setup
function bgchanneltheme_setup() {
  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');

  register_nav_menus([
    'main' => __('Main Menu', 'bgchanneltheme')
  ]);
}
add_action( 'after_setup_theme', 'bgchanneltheme_setup' );

function bgchanneltheme_register_sidebars() {
  register_sidebar([
    'name' => __( 'Single Video Sidebar', 'bgchanneltheme' ),
    'id' => 'single-video-sidebar',
    'description' => __( 'These widgets will be shown on single video pages.')
  ]);
}
add_action( 'widgets_init', 'bgchanneltheme_register_sidebars' );

// Enqueue scripts & styles
function bgchanneltheme_enqueue() {

  // dev only
  // wp_enqueue_script( 'livereload', 'http://localhost:35729/livereload.js', [] );

  wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );

  wp_enqueue_script( 'uikit-js', get_template_directory_uri() . '/assets/js/lib/uikit/uikit.min.js', ['jquery'] );
  wp_enqueue_script( 'uikit-icons-js', get_template_directory_uri() . '/assets/js/lib/uikit/uikit-icons.min.js', ['uikit-js'] );

  wp_enqueue_style( 'uikit', get_template_directory_uri() . '/assets/css/lib/uikit/uikit.min.css', ['font-awesome'] );
  wp_enqueue_style( 'style', get_stylesheet_uri(), ['uikit'], '0.0.1' );

  wp_enqueue_style( 'mobile-style', get_stylesheet_directory_uri() . '/assets/css/responsive/mobile.css', ['style'], '0.0.1', 'screen and (max-width: 767px)');
  wp_enqueue_style( 'gt-mobile-style', get_stylesheet_directory_uri() . '/assets/css/responsive/gt-mobile.css', ['style'], '0.0.1', 'screen and (min-width: 768px)');
  wp_enqueue_style( 'custom-responsive-style', get_stylesheet_directory_uri() . '/assets/css/responsive/custom.css', ['style'], '0.0.1' );
}
add_action( 'wp_enqueue_scripts', 'bgchanneltheme_enqueue' );

// API
/*spl_autoload_register(function ($class_name) use ($bgchanneltheme_dir) {
    include $bgchanneltheme_dir . "/php/api/" . str_replace('\\', '/', $class_name) . '.php';
});*/

// Helper functions
function bgct_array_swap($key1, $key2, $array) {
  $newArray = array ();
  foreach ($array as $key => $value) {
      if ($key == $key1) {
          $newArray[$key2] = $array[$key2];
      } elseif ($key == $key2) {
          $newArray[$key1] = $array[$key1];
      } else {
          $newArray[$key] = $value;
      }
  }
  return $newArray;
}

// Custom post type(s)
require $bgchanneltheme_dir . "/php/posttypes/create_posttypes.php";
// Custom taxonomies
require $bgchanneltheme_dir . "/php/taxonomies/create_taxonomies.php";
// Custom post type(s) meta boxes
require $bgchanneltheme_dir . "/php/posttypes/add_postmetaboxes.php";
// Custom post type(s) admin filtering
require $bgchanneltheme_dir . "/php/posttypes/filter_admin.php";
// Custom post type(s) admin columns
require $bgchanneltheme_dir . "/php/posttypes/admin_columns.php";

// Theme settings menu
require $bgchanneltheme_dir . "/php/menus/settings.php";

// Non-module shortcodes
require $bgchanneltheme_dir . "/php/shortcodes/register_shortcodes.php";

// Custom menu nav walker
require $bgchanneltheme_dir . '/php/nav/uikitwalker.php';
require $bgchanneltheme_dir . '/php/nav/uikitwalker-mobile.php';

// Modules
require $bgchanneltheme_dir . '/php/modules/main.php';
