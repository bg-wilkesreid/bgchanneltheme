<?php

register_taxonomy('channel-topic', [
  'post',
  'channel-video',
], [
  'rewrite' => array( 'slug' => 'topic' ),
  'hierarchical' => true,
  'labels' => [
    'name' => __('Topics'),
    'singular_name' => __('Topic'),
    'add_new_item' => __('Add New Topic'),
    'edit_item' => __('Edit Topic'),
    'update_item' => __('Update Topic'),

    'not_found' => __('No Topics Found')
  ]
]);
