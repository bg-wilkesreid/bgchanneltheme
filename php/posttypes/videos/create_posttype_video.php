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
