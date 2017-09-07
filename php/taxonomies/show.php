<?php

register_taxonomy('channel-show', [
  'channel-video'
], [
  'rewrite' => array( 'slug' => 'show' ),
  'hierarchical' => true,
  'labels' => [
    'name' => __('Shows'),
    'singular_name' => __('Show'),
    'add_new_item' => __('Add New Show'),
    'edit_item' => __('Edit Show'),
    'update_item' => __('Update Show'),

    'not_found' => __('No Shows Found')
  ]
]);
