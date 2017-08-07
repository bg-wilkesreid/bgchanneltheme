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
if ( ! function_exists( 'myfirsttheme_setup' ) ) :
function bgchanneltheme_setup() {
  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');

  register_nav_menus([
    'main' => __('Main Menu', 'bgchanneltheme')
  ]);
}
endif;
add_action( 'after_setup_theme', 'bgchanneltheme_setup' );

// Enqueue scripts & styles
function bgchanneltheme_enqueue() {

  // dev only
  wp_enqueue_script( 'livereload', 'http://localhost:35729/livereload.js', [] );

  wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );

  wp_enqueue_script( 'uikit-js', get_template_directory_uri() . '/assets/js/uikit/uikit.min.js', ['jquery'] );
  wp_enqueue_script( 'uikit-icons-js', get_template_directory_uri() . '/assets/js/uikit/uikit-icons.min.js', ['uikit-js'] );

  wp_enqueue_style( 'uikit', get_template_directory_uri() . '/assets/css/uikit/uikit.min.css', ['font-awesome'] );
  wp_enqueue_style( 'style', get_stylesheet_uri(), ['uikit'], '0.0.1' );

  wp_enqueue_style( 'mobile-style', get_stylesheet_directory_uri() . '/assets/css/responsive/mobile.css', ['style'], '0.0.1', 'screen and (max-width: 767px)');
  wp_enqueue_style( 'gt-mobile-style', get_stylesheet_directory_uri() . '/assets/css/responsive/gt-mobile.css', ['style'], '0.0.1', 'screen and (min-width: 768px)');
  wp_enqueue_style( 'custom-responsive-style', get_stylesheet_directory_uri() . '/assets/css/responsive/custom.css', ['style'], '0.0.1' );
}
add_action( 'wp_enqueue_scripts', 'bgchanneltheme_enqueue' );

// Custom post type(s)
require $bgchanneltheme_dir . "/php/posttypes/create_posttypes.php";
// Custom post type(s) meta boxes
require $bgchanneltheme_dir . "/php/posttypes/add_postmetaboxes.php";

// Theme settings menu
require $bgchanneltheme_dir . "/php/menus/settings.php";

// Custom menu nav walker
require $bgchanneltheme_dir . '/php/nav/uikitwalker.php';
require $bgchanneltheme_dir . '/php/nav/uikitwalker-mobile.php';

// Modules
require $bgchanneltheme_dir . '/php/modules/main.php';
