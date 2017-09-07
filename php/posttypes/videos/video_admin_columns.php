<?php

add_filter( 'manage_edit-channel-video_columns', 'bgchanneltheme_video_changecolumns' );
add_action( 'manage_posts_channel-video_column', 'bgchanneltheme_video_populatecolumns' );

function bgchanneltheme_video_changecolumns( $columns ) {
  $columns['Show'] = 'Show';
  $columns = bgct_array_swap('date', 'Show', $columns);
  return $columns;
}

function bgchanneltheme_video_populatecolumns( $column ) {
  if ($column == 'Show') {
    echo 'Test';
  }
}
