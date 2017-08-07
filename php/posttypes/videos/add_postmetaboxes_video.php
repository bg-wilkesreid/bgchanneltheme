<?php

function bgchanneltheme_add_postmetaboxes_video() {
  add_meta_box( 'bgchanneltheme-video-url', __('Video URL', 'bgchanneltheme'), 'bgchanneltheme_postmetaboxes_video_videourl', 'channel-video', 'normal', 'high' );
  add_meta_box( 'bgchanneltheme-video-featured', __('Featured', 'bgchanneltheme'), 'bgchanneltheme_postmetaboxes_video_featured', 'channel-video', 'normal', 'high' );
}

function bgchanneltheme_postmetaboxes_video_featured( $object, $box ) {
  wp_nonce_field( basename( __FILE__ ), 'bgchanneltheme_video_featured_nonce' );

  $featured_videos_str = get_option('bgchanneltheme_featured_videos');

  if ($featured_videos_str == null) {
    $is_featured = false;
  } else {
    $is_featured = in_array($object->ID, json_decode($featured_videos_str));
  }

  $text = $is_featured ? "checked='checked'" : "";

  echo '<input name="bgchanneltheme_video_featured" type="checkbox" '.$text.'>';
}

function bgchanneltheme_postmetaboxes_video_videourl( $object, $box ) {
  wp_nonce_field( basename( __FILE__ ), 'bgchanneltheme_video_url_nonce' );

  $existing = get_post_meta($object->ID, 'bgchanneltheme_video_url', true);
  $existing_width = get_post_meta($object->ID, 'bgchanneltheme_video_width', true);
  $existing_height = get_post_meta($object->ID, 'bgchanneltheme_video_height', true);

  // Output
  echo '<input style="width:100%" type="text" name="bgchanneltheme_video_url" id="bgchanneltheme_video_url" value="'.$existing.'">';
  echo '<input placeholder="width" style="width: 100px" type="number" name="bgchanneltheme_video_width" id="bgchanneltheme_video_width" value="'.$existing_width.'">';
  echo '<input placeholder="height" style="width: 100px" type="number" name="bgchanneltheme_video_height" id="bgchanneltheme_video_height" value="'.$existing_height.'">';
}

function bgchanneltheme_savemeta_video( $post_id, $post ) {
  $post_type = get_post_type_object( $post->post_type );

  if ($post_type->name != "channel-video" || !current_user_can( $post_type->cap->edit_post, $post_id )) {
    return $post_id;
  }

  delete_post_meta($post_id, 'bgchanneltheme_video_url');
  delete_post_meta($post_id, 'bgchanneltheme_video_width');
  delete_post_meta($post_id, 'bgchanneltheme_video_height');

  // Video URL
  if ( isset($_POST['bgchanneltheme_video_url']) && wp_verify_nonce( $_POST['bgchanneltheme_video_url_nonce'], basename( __FILE__ ) ) ) {
    add_post_meta($post_id, 'bgchanneltheme_video_url', $_POST['bgchanneltheme_video_url'], true);
  }
  if ( isset($_POST['bgchanneltheme_video_width']) && wp_verify_nonce( $_POST['bgchanneltheme_video_url_nonce'], basename( __FILE__ ) ) ) {
    add_post_meta($post_id, 'bgchanneltheme_video_width', $_POST['bgchanneltheme_video_width'], true);
  }
  if ( isset($_POST['bgchanneltheme_video_height']) && wp_verify_nonce( $_POST['bgchanneltheme_video_url_nonce'], basename( __FILE__ ) ) ) {
    add_post_meta($post_id, 'bgchanneltheme_video_height', $_POST['bgchanneltheme_video_height'], true);
  }

  // If the checkbox "featured" is checked, add it to list of featured videos.
  // If not, remove it from list of featured videos.
  if ( wp_verify_nonce( $_POST['bgchanneltheme_video_featured_nonce'], basename( __FILE__ ) ) ) {

    $featured_videos_str = get_option('bgchanneltheme_featured_videos');
    $max_featured_videos = get_option('bgchanneltheme_max_featured_videos');

    // If featured checkbox is checked
    if (isset($_POST['bgchanneltheme_video_featured'])) {

      if ($featured_videos_str == null) {
        $featured_videos = [];
      } else {
        $featured_videos = json_decode($featured_videos_str);
      }
      if (in_array($post_id, $featured_videos)) {
        return;
      }
      array_unshift($featured_videos, $post_id);
      if (count($featured_videos) > $max_featured_videos) {
        array_pop($featured_videos);
      }
      $featured_videos_str = json_encode($featured_videos);
      delete_option('bgchanneltheme_featured_videos');
      add_option('bgchanneltheme_featured_videos', $featured_videos_str);
    } else {

      if ($featured_videos_str == null) {
        return;
      } else {
        $featured_videos = json_decode($featured_videos_str);
      }
      if (!in_array($post_id, $featured_videos)) {
        return;
      }
      array_splice($featured_videos, array_search($featured_videos, $post_id), 1);
      $featured_videos_str = json_encode($featured_videos);
      delete_option('bgchanneltheme_featured_videos');
      add_option('bgchanneltheme_featured_videos', $featured_videos_str);
    }

  }
}
