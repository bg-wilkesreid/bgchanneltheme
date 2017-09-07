<?php

function bgchanneltheme_createposttype_video() {
  register_post_type( 'channel-video', [
        'labels' => [
            'name' => __( 'Videos', 'bgchanneltheme' ),
            'singular_name' => __( 'Video', 'bgchanneltheme' )
        ],
        'menu_icon' => 'dashicons-video-alt3',
        'public' => true,
        'has_archive' => true,
        'rewrite' => [
            'slug' => 'videos'
        ],
        'supports' => [
            'title',
            'editor',
            'revisions',
            'thumbnail'
        ]
    ] );
}

function bgchanneltheme_get_featured_video($index) {
  $featured_videos = json_decode(get_option('bgchanneltheme_featured_videos', '[]'));
  if (isset($featured_videos[$index])) {
    return $featured_videos[$index];
  } else {
    return null;
  }
}
function bgchanneltheme_get_featured_videos() {
  return json_decode(get_option(bgchanneltheme_featured_videos, '[]'));
}
