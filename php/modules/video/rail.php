<?php

class BGChannel_VideoRailModule implements BGChannelModule
{
  public $ids;
  public $category;
  public function __construct($category = null, $ids = null, $featured = false) {
    $this->ids = explode(",", $ids);
    $this->category = $category;

    if ($featured && $id === null) {
      $this->ids = bgchanneltheme_get_featured_videos();
    }
  }

  /**
   * The value this function returns is this module's shortcode
   * @return string The desired shortcode.
   */
  public static function shortcode() {
    return 'video_rail';
  }
  public function display() {
    $ids = $this->ids;
    $category = $this->category;

    if ($category === null && count($ids) == 0) {
      return;
    }
    
    //$video = get_post($id);
    $thumbnail_url = get_the_post_thumbnail_url($id);
    $permalink = get_permalink($id);

    echo BGChannelModuleController::view('hero_video', [
      'title' => $title,
      'subtitle' => $subtitle,
      'thumbnail_url' => $thumbnail_url,
      'permalink' => $permalink
    ]);
  }
}
