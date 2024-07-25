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

            define('MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

            define('MY_PLUGIN_URL', plugin_dir_url( __FILE__ ));

            // require carbon
            require_once( MY_PLUGIN_PATH . '/vendor/autoload.php' );
        }

        public function initialize() {
            include_once( MY_PLUGIN_PATH . '/includes/utilities.php' );
            include_once( MY_PLUGIN_PATH . '/includes/options-page.php' );
            include_once( MY_PLUGIN_PATH . '/includes/contact-form.php' );

                        // Hook into the PHPMailer initialization action
            add_action('phpmailer_init', 'configure_phpmailer');

            function configure_phpmailer($phpmailer) {
                $phpmailer->isSMTP();
                $phpmailer->Host       = 'mailhog';
                $phpmailer->Port       = 1025;
                $phpmailer->SMTPAuth   = false;
                $phpmailer->SMTPSecure = false;
            }
            
        }

    }
        $contactPlugin = new ContactPlugin();

        $contactPlugin->initialize();


    }