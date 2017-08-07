<?php

class BGChannel_HeroVideoModule implements BGChannelModule
{
  public $id;
  public $title;
  public $subtitle;
  public function __construct($id = null, $title = null, $subtitle = "") {
    $this->id = $id;
    $this->title = $title;
    $this->subtitle = $subtitle;
  }

  public static function shortcode() {
    return 'hero_video';
  }
  public function display() {
    $id = $this->id;
    $title = $this->title;

    if ($id === null) {
      return;
    }

    if ($title === null){
      $title = get_the_title($id);
    }
    //$video = get_post($id);
    $thumbnail_url = get_the_post_thumbnail_url($id);

    echo '<div class="hero-video uk-cover-container">';
      echo '<img class="hero-video-background" uk-cover src="'.$thumbnail_url.'">';
      echo '<h1 class="uk-heading-primary hero-video-title">'.$title.'</h1>';
      echo '<h2>'.$this->subtitle.'</h2>';
      echo '<a class="hero-video-play-button"><i class="fa fa-play hero-video-play-button-icon"></i></a>';
    echo '</div>';
  }
}
