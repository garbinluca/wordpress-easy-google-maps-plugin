<?php
/*
Plugin Name: Easy Google Maps
Plugin URI: 
Description:
Version: 0.1.0
Author: Luca Garbin
Author URI: https://www.lucagarbin.it
Text Domain: lg-google-maps

<div class="lg-google-maps" data-zoom="7" data-pin='{"src": "<?php echo get_template_directory_uri() ?>/assets/lg-google-maps-pin.png", "width": 40, "height": 40}' data-latitude="46.159730" data-longitude="11.118710" data-styles='[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#5f3b34"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"administrative.neighborhood","elementType":"geometry.stroke","stylers":[{"visibility":"on"}]},{"featureType":"administrative.neighborhood","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#471E16"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#392718"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#5f3b34"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#5f3b34"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#331610"}]}]'></div>


*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('EasyGoogleMaps') ) :

class EasyGoogleMaps {

    public $version = '0.1.0';
    private $pluginPath;

    public function __construct() {

        $this->pluginPath = plugin_dir_url(__FILE__);

    }

    public function initialize() {

        if(!$this->isRegisteredKey()) {
            add_action('admin_notices', array($this, 'showKeyAlert'));
        } else {
            add_action( 'init', array( $this, 'registerAssets' ) );
        }

    }

    public function registerAssets() {

        wp_register_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?key=' . $this->getKey() .'&callback=easyGoogleMapsInitCallback', null, $this->version, true);
        wp_register_script( 'easy-google-maps-js', $this->pluginPath . 'assets/front/scripts.js', [], $this->version, true);

        wp_register_style( 'easy-google-maps-css', $this->pluginPath . 'assets/front/style.css', null, $this->version);

        wp_enqueue_script('easy-google-maps-js');
        wp_enqueue_script('google-maps-api');

        wp_enqueue_style('easy-google-maps-css');

    }

    private function isRegisteredKey() {
        return !(!defined('EASY_GOOGLE_MAPS_KEY') || !EASY_GOOGLE_MAPS_KEY || trim(EASY_GOOGLE_MAPS_KEY) == '');
    }

    private function getKey() {
        return EASY_GOOGLE_MAPS_KEY;
    }

    public function showKeyAlert() {

        echo '
            <div class="notice notice-warning is-dismissible">
                <p><strong>Google Maps Block</strong>: <i>EASY_GOOGLE_MAPS_KEY</i> non impostata in wp-config.php.</p>
            </div>
        ';

    }

}


function easyGoogleMapsInstanceInit() {
    global $easeGoogleMapsInstance;

    // Instantiate only once.
    if( !isset($easeGoogleMapsInstance) ) {
        $easeGoogleMapsInstance = new EasyGoogleMaps();
        $easeGoogleMapsInstance->initialize();
    }
    return $easeGoogleMapsInstance;
}

easyGoogleMapsInstanceInit();

endif;
