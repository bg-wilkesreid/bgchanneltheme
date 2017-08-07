<?php

add_action( 'add_meta_boxes', 'bgchanneltheme_add_postmetaboxes' );
add_action( 'save_post', 'bgchanneltheme_savemeta', 10, 2 );

function bgchanneltheme_add_postmetaboxes() {
  bgchanneltheme_add_postmetaboxes_video();
}

function bgchanneltheme_savemeta( $post_id, $post ) {
  bgchanneltheme_savemeta_video( $post_id, $post );
}

// Videos
require get_template_directory() . "/php/posttypes/videos/add_postmetaboxes_video.php";
