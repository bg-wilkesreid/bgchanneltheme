<?php

add_action( 'init', 'bgchanneltheme_registertaxonomies' );

function bgchanneltheme_registertaxonomies() {
  require(dirname(__FILE__) . "/show.php");
  require(dirname(__FILE__) . "/topic.php");
}
