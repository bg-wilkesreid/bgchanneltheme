<?php

// Shows a single video.
class BGChannel_SingleVideoModule implements BGChannelModule
{
  // id refers to id of video post this module refers to
  public $id;

  public function __construct($id = null) {
    $this->id = $id;
  }

  public static function shortcode() {
    return 'single_video';
  }
  public function display() {
    $id = $this->id;

    if ($id === null) {
      //echo 'no video specified';
      return;
    }

    $video = get_post($id);
    $video_url = get_post_meta($id, 'bgchanneltheme_video_url', true);
    $width = get_post_meta($id, 'bgchanneltheme_video_width', true);
    $height = get_post_meta($id, 'bgchanneltheme_video_height', true);

    $embed_url = self::get_embed_code($video_url);

    echo '<iframe width="960" height="540" src="'.$embed_url.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen uk-responsive uk-video></iframe>';
  }

  public static function get_embed_code($video_url) {
    if (strpos($video_url, 'vimeo')) {
      return preg_replace('/https:\/\/vimeo\.com\/(\d+)/', 'https://player.vimeo.com/video/$1', $video_url);
    } elseif (strpos($video_url, 'youtube')) {
      return preg_replace('/https:\/\/www\.youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)(&.*)?/', 'https://www.youtube.com/embed/$1', $video_url);
    }
  }
}
