<?php
// Establishing Classes, Interfaces, and Singletons
interface BGChannelModule
{
  public static function shortcode();
  public function display();
}

/*
 This class is never instantiated.
 It contains only static methods and properties.
*/
class BGChannelModuleController
{
  public static $twigLoader;
  public static $twig;
  /*
   Loop through every entry in the global $bgchanneltheme_enabled_modules array
   (which is defined near the top of functions.php) and "register" each module.
  */
  public static function register_modules() {
    global $bgchanneltheme_dir;
    global $bgchanneltheme_enabled_modules;

    foreach ($bgchanneltheme_enabled_modules as $module) {
      include $bgchanneltheme_dir . '/php/modules/'.$module['file'].'.php';

      self::register_shortcode( $module['class'] );
    }
  }

  /**
   * Registers the given shortcode
   * @param  string $module_classname The shortcode class name
   * @return void                   [description]
   */
  public static function register_shortcode($module_classname) {
    // $module_class_name is the string name of the module's class

    // Get the ReflectionClass object for the string class name
    $module_class = new ReflectionClass($module_classname);

    // Force the module class to implement the BGChannelModule interface
    if (!$module_class->implementsInterface('BGChannelModule')) {
      error_log("The module ".$module_classname." must implement the BGChannelModule interface to be registered.");
      return;
    }

    // get the method for displaying the module
    $display = $module_class->getMethod('display');
    // get the method that returns the string for the shortcode
    $shortcode = $module_class->getMethod('shortcode');
    // get the module's constructor
    $constructor = $module_class->getConstructor();

    /*
     Add the shortcode to wordpress using the value returned by the shortcode() method
     of the module as the shortcode string itself, and use the arguments defined
     in the constructor and their defaults as the shortcode attributes. Also wrap the
     method in ob_start() and ob_get_clean() so the module method can just echo
     its output and have it work.
    */
    add_shortcode($shortcode->invoke(null), function( $atts ) use ($module_class, $display, $constructor) {
      /*
       Call our static method get_params_from_atts that converts the module's defined
       arguments into an array and passes it to WordPress's shortcode_atts() method
      */
      $params = self::get_params_from_atts( $constructor, $atts );

      // create instance of the module
      $module = $module_class->newInstanceArgs($params);

      // Start output buffer
      ob_start();

      // Echo shortcode display from module class's display() method
      $display->invoke($module);

      // Return results of output buffer
      return ob_get_clean();
    });
  }

  public static function prepareViews() {
    global $bgchanneltheme_dir;

    $rootdir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));

    self::$twigLoader = new Twig_Loader_Filesystem($bgchanneltheme_dir . "/php/views");
    self::$twig = new Twig_Environment(self::$twigLoader, array(
      'cache' => $rootdir . '/uploads/bgchanneltheme/viewcache',
    ));
  }

  public static function view($name, $data) {
    return self::$twig->load($name.".html")->render($data);
  }

 /**
  * Takes the method, retrieves its arguments and argument defaults, and passes
  * them to the shortcode_atts function. This way, each individual module class is
  * much easier to write.
  * @param  ReflectionMethod $method The method to get params from
  * @param  Array $atts   The array of attributes provided by the shortcode
  * @return Array         An array of params and their default values
  */
  public static function get_params_from_atts( $method, $atts ) {
    $params = $method->getParameters();
    $result = [];
    foreach ($params as $param) {
      $name = $param->name;
      $default = $param->getDefaultValue();
      $result[$name] = $default;
    }
    for ($i=0;isset($atts[$i]);$i++) {
      $atts[$atts[$i]] = true;
      unset($atts[$i]);
    }
    $atts = shortcode_atts($result, $atts);
    return $atts;
  }
}


// Video modules
//require $bgchanneltheme_dir . '/php/modules/video/single.php';

/*
 Loop through array of enabled modules, require the file for each
 one, and "register" its class.

 This array of enabled modules is at the top of functions.php.
*/
if (!isset($bgchanneltheme_enabled_modules)) {
  $bgchanneltheme_enabled_modules = [];
}
BGChannelModuleController::register_modules();
BGChannelModuleController::prepareViews();
