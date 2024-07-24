<?php
/** 
 * Plugin name: Simple Contact Form
 * Description: Simple contact form series
 * Author: Seun Familusi
 * Author URI: https://cowebplus.com
 * Version: 1.0.0
 * Text Domain: simple-contact-form
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
        }
    
//         public function create_custom_post_type() {
            
//             $args = array(
//                 'public' => true,
//                 'has_archive' => true,
//                 'supports' => array('title'),
//                 'exclude_from_search' => true,
//                 'publicly_queryable' => false,
//                 'capability' => 'manage_options',
//                 'labels' => array(
//                     'name' => 'Contact Form',
//                     'singular_name' => 'Contact Form Entry'
//                 ),
//                 'menu_icon' => 'dashicons-media-text',
    
//             );
    
//             register_post_type('simple_contact_form', $args);
//         }
    
//     //     public function load_assets() {
//     //         wp_enqueue_style(
//     //             'simple-contact-form',
//     //             plugin_dir_url( __FILE__) . 'css/simple-contact-form.css',
//     //             array(),
//     //             1,
//     //             'all'
//     //         );
    
//     //         wp_enqueue_script(
//     //             'simple-contact-form-react',
//     //             plugin_dir_url( __FILE__) . 'js/simple-contact-form-react.js',
//     //             array('wp-element'),
//     //             1,
//     //             true
//     //         );
//     // // what does this do?
//     //         wp_localize_script('simple-contact-form-react', 'simpleContactFormSettings', array(
//     //             'restURL' => get_rest_url(null, 'simple-contact-form/v1/send-email'),
//     //             'nonce' => wp_create_nonce('wp_rest')
//     //         ));
//     //     }
    
//     public function load_assets() {
//         wp_enqueue_style(
//             'simple-contact-form',
//             plugin_dir_url(__FILE__) . 'css/simple-contact-form.css',
//             array(),
//             1,
//             'all'
//         );
    
//         // Enqueue React and ReactDOM from CDN
//         wp_enqueue_script('react', 'https://unpkg.com/react@18/umd/react.development.js', array(), null, true);
//         wp_enqueue_script('react-dom', 'https://unpkg.com/react-dom@18/umd/react-dom.development.js', array('react'), null, true);
    
//         wp_enqueue_script(
//             'simple-contact-form-react',
//             plugin_dir_url(__FILE__) . 'js/simple-contact-form-react.js',
//             array('react', 'react-dom'),
//             1,
//             true
//         );
    
//         wp_localize_script('simple-contact-form-react', 'simpleContactFormSettings', array(
//             'restURL' => get_rest_url(null, 'simple-contact-form/v1/send-email'),
//             'nonce' => wp_create_nonce('wp_rest')
//         ));
//     }
    
    
//         // public function load_shortcode() {
    
//          //     <div class="simple-contact-form">
//         //             <h1>Send us an email</h1>
//         //             <p>Please fill the below form</p>
    
//         //             <form action="" id="simple-contact-form__form">
//         //                 <div class="form-group mb-2">
//         //                     <input type="text" name="name" class="form-control" placeholder="Name" >
//         //                 </div>
//         //                 <div class="form-group mb-2">
//         //                     <input type="email" name="email"  class="form-control" placeholder="Email" >
//         //                 </div>
//         //                 <div class="form-group mb-2">
//         //                     <input type="tel" name="phone"  class="form-control" placeholder="Phone" >
//         //                 </div>
//         //                 <div class="form-group mb-2"> 
//         //                     <textarea name="message" class="form-control" id="" placeholder="Type your message"></textarea> 
//         //                 </div>
//         //                 <div class="form-group mb-2">
//         //                     <button type="submit" class="btn btn-success btn-block w-100">Send Message</button>
//         //                 </div>
//         //             </form>
//         //     </div>
//         // <?php -->
        
//         // }  
    
//         public function load_shortcode() {
//             echo '<div id="simple-contact-form-root"></div>';
//         }
    
//         public function load_scripts() 
//             <script>
//                 var nonce = '<?php echo wp_create_nonce('wp_rest') ';
    
//                 (function($){
//                     $('#simple-contact-form__form').submit( function(event) {
//                     event.preventDefault();
//                     // alert('submitted');
//                     // serializes the form name inputs
//                     var form = $(this).serialize();
//                     console.log(form);
                    
//                     $.ajax({
//                         method: 'post',
//                         url: '<?php echo get_rest_url(null, 'simple-contact-form/v1/send-email'); ',
//                         headers: {'X-WP-Nonce': nonce},
//                         data: form
    
//                     })
//                 });
//                 })(jQuery)
//             </script>
            
//         <?php
// }

    
//     }  

//     public function register_rest_api() {
//         register_rest_route('simple-contact-form/v1', 'send-email', array(
//             'methods' => 'POST',
//             'callback' => array($this, 'handle_contact_form')
//         ));
//     }

//     public function handle_contact_form($data) {
//         $headers = $data->get_headers();
//         $params = $data->get_params();
//         // test if the nonce is on console tools
//         // echo json_encode($headers);
//         $nonce = $headers['x_wp_nonce'][0];
//         // $nonce = 55656666;

//         if(!wp_verify_nonce($nonce, 'wp_rest')) {
//             // echo 'This nonce is correct';
//             return new WP_REST_Response('Unauthorized request', 401);
//         }

//         $post_id = wp_insert_post([
//             'post_type' => 'simple_contact_form',
//             'post_title' => 'Contact enquiry',
//             'post_status' => 'publish',
//         ]);

//         if($post_id) {
//             return new WP_REST_Response('Thank you for your email', 200);
//         }

//         return new WP_REST_Response('Message not sent', 500);

//     }
            }
        $contactPlugin = new ContactPlugin();

        $contactPlugin->initialize();

}