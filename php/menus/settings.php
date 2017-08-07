<?php
add_action('admin_menu', 'bgchanneltheme_add_settingsmenu');
add_action( 'admin_init', 'bgchanneltheme_register_settings' );

function bgchanneltheme_register_settings() {
  register_setting('bgchanneltheme-settings-group', 'bgchanneltheme_max_featured_videos', 'intval');
}

function bgchanneltheme_add_settingsmenu() {
  add_theme_page('Theme Settings', 'Theme Settings', 'manage_options', 'bgchanneltheme-settings', 'bgchanneltheme_settings_menu');
}

function bgchanneltheme_settings_menu() {

  $max_num_featured_videos = get_option('bgchanneltheme_max_featured_videos');

  ?><div class="wrap">
    <h1>Bureau Gravity Channel – Theme Settings</h1>
    <form method="post" action="options.php">
      <?php settings_fields( 'bgchanneltheme-settings-group' ); ?>
      <table class="form-table">
        <tr class="user-rich-editing-wrap">
      		<th scope="row">Featured Videos</th>
      		<td><label for="max_featured_videos"><input name="bgchanneltheme_max_featured_videos" type="number" id="bgchanneltheme_max_featured_videos" value="<?php echo esc_attr($max_num_featured_videos); ?>"> Maximum number of featured videos. This will not change the number of currently featured videos.</label></td>
      	</tr>
      </table>
      <?php do_settings_sections( 'bgchanneltheme-settings-group' ); ?>
      <?php submit_button(); ?>
      </form>
  </div><?php
}
