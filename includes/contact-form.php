<?php 

 // add shortcode
add_shortcode('contact', 'show_contact_form');

// add_action
add_action('rest_api_init', 'create_rest_endpoint');

function show_contact_form() {
    include MY_PLUGIN_PATH . 'includes/templates/contact-form.php';
}

function create_rest_endpoint() {
    register_rest_route('v1/contact-form', 'submit', array(
        'methods' => 'POST',
        'callback' => 'handle_enquiry'
    ));
}

function handle_enquiry($data) {
    // Handle the form data that is posted

      // Get all parameters from form
      $params = $data->get_params();

      // Set fields from the form
      $field_name = sanitize_text_field($params['name']);
      $field_email = sanitize_email($params['email']);
      $field_phone = sanitize_text_field($params['phone']);
      $field_message = sanitize_textarea_field($params['message']);


      // Check if nonce is valid, if not, respond back with error
      if (!wp_verify_nonce($params['_wpnonce'], 'wp_rest')) {

            return new WP_Rest_Response('Message not sent', 422);
      }

      // Remove unneeded data from paramaters
      unset($params['_wpnonce']);
      unset($params['_wp_http_referer']);

      // Send the email message
      $headers = [];

      $admin_email = get_bloginfo('admin_email');
      $admin_name = get_bloginfo('name');

      // Set recipient email
      $recipient_email = get_plugin_options('contact_plugin_recipients');

      if (!$recipient_email) {
            // Make all lower case and trim out white space
            $recipient_email = strtolower(trim($recipient_email));
      } else {

            // Set admin email as recipient email if no option has been set
            $recipient_email = $admin_email;
      }


      $headers[] = "From: {$admin_name} <{$admin_email}>";
      $headers[] = "Reply-to: {$field_name} <{$field_email}>";
      $headers[] = "Content-Type: text/html";

      $subject = "New enquiry from {$field_name}";

      $message = '';
      $message = "<h1>Message has been sent from {$field_name}</h1>";


      $postarr = [

            'post_title' => $params['name'],
            'post_type' => 'submission',
            'post_status' => 'publish'

      ];

      $post_id = wp_insert_post($postarr);

      // Loop through each field posted and sanitize it
      foreach ($params as $label => $value) {

            switch ($label) {

                  case 'message':

                        $value = sanitize_textarea_field($value);
                        break;

                  case 'email':

                        $value = sanitize_email($value);
                        break;

                  default:

                        $value = sanitize_text_field($value);
            }

            add_post_meta($post_id, sanitize_text_field($label), $value);

            $message .= '<strong>' . sanitize_text_field(ucfirst($label)) . ':</strong> ' . $value . '<br />';
      }


      wp_mail($recipient_email, $subject, $message, $headers);

      $confirmation_message = "The message was sent successfully!!";

      if (get_plugin_options('contact_plugin_message')) {

            $confirmation_message = get_plugin_options('contact_plugin_message');

            $confirmation_message = str_replace('{name}', $field_name, $confirmation_message);
      }

      return new WP_Rest_Response($confirmation_message, 200);
}
    