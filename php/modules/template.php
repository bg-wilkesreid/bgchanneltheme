<?php

class BGChannel_ExampleModule implements BGChannelModule
{

  public function __construct($shortcode_attribute = null) {

  }

  public static function shortcode() {
    return 'example_shortcode';
  }
  public function display() {
    echo 'shortcode output';
  }
}
