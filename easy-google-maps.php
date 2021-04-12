<?php
/*
Plugin Name: Easy Google Maps
Plugin URI: 
Description:
Version: 0.1.0
Author: Luca Garbin
Author URI: https://www.lucagarbin.it

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
        wp_register_script( 'easy-google-maps-js', $this->pluginPath . 'assets/scripts.js', [], $this->version, true);

        wp_enqueue_script('easy-google-maps-js');
        wp_enqueue_script('google-maps-api');

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
