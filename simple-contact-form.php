<?php
/** 
 * Plugin name: Contact plugin
 * Description: Simple contact form series
 * Author: Seun Familusi
 * Author URI: https://cowebplus.com
 * Version: 1.0.0
 * Text Domain: contact-plugin
 * 
 */

if( !defined('ABSPATH')) {
    echo "What are you trying to do?";
    exit;
}


if(!class_exists('ContactPlugin')){
    class ContactPlugin {
        public function __construct() {

            define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));

            // require carbon
            require_once( MY_PLUGIN_PATH . '/vendor/autoload.php' );

            // // create custom post type
            // add_action('init', array($this, 'create_custom_post_type'));
    
    
            // // add assets (js, css, etc)
            // add_action('wp_enqueue_scripts', array($this, 'load_assets'));
    
            // // add shortcode
            // add_shortcode('contact-form', array($this, 'load_shortcode'));
    
            // // add code to footer for custom scripting
            // add_action('wp_footer', array($this, 'load_scripts'));
    
            // // create a new endpoint(register rest api)
            // add_action('rest_api_init', array($this, 'register_rest_api'));
        }

        public function initialize() {
            include_once( MY_PLUGIN_PATH . '/includes/utilities.php' );
            include_once( MY_PLUGIN_PATH . '/includes/options-page.php' );
            include_once( MY_PLUGIN_PATH . '/includes/contact-form.php' );
            
        }

    }
        $contactPlugin = new ContactPlugin();

        $contactPlugin->initialize();

}