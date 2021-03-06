<?php

class BGChannel_HeroVideoModule implements BGChannelModule
{
  public $id;
  public $title;
  public $subtitle;
  public function __construct($id = null, $title = null, $subtitle = "", $featured = false) {
    $this->id = $id;
    $this->title = $title;
    $this->subtitle = $subtitle;

    if ($featured && $id === null) {
      $this->id = bgchanneltheme_get_featured_video((int) $featured - 1);
    }
  }

  /**
   * The value this function returns is this module's shortcode
   * @return string The desired shortcode.
   */
  public static function shortcode() {
    return 'hero_video';
  }
  public function display() {
    $id = $this->id;
    $title = $this->title;
    $subtitle = $this->subtitle;

    if ($id === null) {
      return;
    }

    if ($title === null){
      $title = get_the_title($id);
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
