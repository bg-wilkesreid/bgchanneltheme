<?php

add_shortcode('section', 'bgchanneltheme_section_shortcode');
function bgchanneltheme_section_shortcode( $atts, $content = "" ) {

  $muted = is_array($atts) && in_array("muted", $atts) ? true : false;
  $dark = is_array($atts) && in_array("dark", $atts) ? true : false;

  ob_start();

  echo '<div class="uk-section';
  if ($muted) {
    echo ' uk-section-muted';
  }
  if ($dark) {
    echo ' uk-background-secondary uk-light';
  }
  echo '">';
  echo do_shortcode($content);
  echo '</div>';

  return ob_get_clean();
}

add_shortcode('container', 'bgchanneltheme_container_shortcode');
function bgchanneltheme_container_shortcode( $atts, $content = "" ) {
  ob_start();
  echo '<div class="uk-container">';
  echo do_shortcode($content);
  echo '</div>';
  return ob_get_clean();
}
