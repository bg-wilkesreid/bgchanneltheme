<?php

add_action( 'restrict_manage_posts', 'bgchanneltheme_video_filter_admin' );
add_filter( 'parse_query', 'bgchanneltheme_video_filter_admin_query' );

function bgchanneltheme_video_filter_admin() {
  $screen = get_current_screen();
  $taxonomy = "channel-show";
  global $wp_query;
  if ( $screen->post_type == 'channel-video' ) {
      wp_dropdown_categories( array(
          'show_option_all' => 'Show All Shows',
          'taxonomy' => $taxonomy,
          'name' => $taxonomy,
          'orderby' => 'name',
          'selected' => ( isset( $wp_query->query[$taxonomy] ) ? $wp_query->query[$taxonomy] : '' ),
          'hierarchical' => false,
          'depth' => 3,
          'show_count' => false,
          'hide_empty' => true,
      ) );
  }
}

function bgchanneltheme_video_filter_admin_query( $query ) {
  $taxonomy = "channel-show";
  $qv = &$query->query_vars;
  if ( ( $qv[$taxonomy] ) && is_numeric( $qv[$taxonomy] ) ) {
    $term = get_term_by( 'id', $qv[$taxonomy], $taxonomy );
    $qv[$taxonomy] = $term->slug;
  }
}
