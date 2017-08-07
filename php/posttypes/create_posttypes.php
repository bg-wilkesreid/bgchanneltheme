<?php

add_action( 'init', 'bgchanneltheme_createposttypes');

function bgchanneltheme_createposttypes() {
  bgchanneltheme_createposttype_video();
}

// Videos
require get_template_directory() . "/php/posttypes/videos/create_posttype_video.php";
