<?php 

// 1. Hide WP Version
function vrtks_disable_wp_version_info() {
    remove_action('wp_head', 'wp_generator');
    add_filter('the_generator', '__return_false');
}
add_action('init', 'vrtks_disable_wp_version_info');

// Block access to wp-admin for non-logged-in users
function vrtks_block_wp_admin_for_guests() {
    if ( is_admin() && ! defined('DOING_AJAX') && ! is_user_logged_in() ) {
        wp_redirect( home_url() );
        exit;
    }
}
add_action( 'admin_init', 'vrtks_block_wp_admin_for_guests' );

// 2. Block Non-Company Email Addresses
function vrtks_block_non_company_email( $email ) {
    $allowed_domains = ['vorteksdigital.co.za']; // Add your company's domain here.
    $email_domain = substr(strrchr($email, "@"), 1);

    if (!in_array($email_domain, $allowed_domains)) {
        wp_die('Please use your company email address to submit the form.');
    }

    return $email;
}
add_filter('pre_process_email', 'vrtks_block_non_company_email');

// 3. Spam Protection - Honeypot Field
function vrtks_add_honeypot_field_to_form($content) {
    if (is_singular()) {
        $honeypot_field = '<div style="display:none;">
            <label for="honeypot">Leave this field empty</label>
            <input type="text" name="honeypot" id="honeypot" value="" />
        </div>';
        $content .= $honeypot_field;
    }
    return $content;
}
add_filter('the_content', 'vrtks_add_honeypot_field_to_form'); 

function vrtks_validate_honeypot_field($is_valid, $form_data) {
    if (isset($_POST['honeypot']) && !empty($_POST['honeypot'])) {
        return false; // If the honeypot is filled, it's a bot.
    }
    return $is_valid;
}
add_filter('form_validation', 'vrtks_validate_honeypot_field', 10, 2);

// 4. Google reCAPTCHA v3 Integration (Improved Strength)
function vrtks_load_recaptcha_scripts() {
    ?>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcRlmcrAAAAAECJ5oVYYESepdMr-6fDyjZtaHR6"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcRlmcrAAAAAECJ5oVYYESepdMr-6fDyjZtaHR6', {action: 'submit'}).then(function(token) {
                var recaptchaResponse = document.createElement('input');
                recaptchaResponse.setAttribute('type', 'hidden');
                recaptchaResponse.setAttribute('name', 'g-recaptcha-response');
                recaptchaResponse.setAttribute('value', token);
                document.forms[0].appendChild(recaptchaResponse);
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'vrtks_load_recaptcha_scripts');

function vrtks_verify_recaptcha_response($response) {
    $recaptcha_secret = '6LcRlmcrAAAAAP1Qsr9y8iF2b53XyYMNduiXucPK'; // ADD SECRET KEY HERE
    $verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    $response = wp_remote_post($verify_url, [
        'body' => [
            'secret' => $recaptcha_secret,
            'response' => $response
        ]
    ]);
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if ($data->success === false) {
        return new WP_Error('recaptcha_failed', 'reCAPTCHA verification failed. Please try again.');
    }

    return true;
}

// 5. Performance Enhancements
// Disable WordPress emoji script for improved performance
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Dequeue unnecessary scripts and styles from WordPress to improve page speed
function vrtks_dequeue_unnecessary_scripts() {
    wp_dequeue_script('wp-embed');
    wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'vrtks_dequeue_unnecessary_scripts');

// Enable Object Caching (if available)
if (function_exists('wp_cache_add_group')) {
    define('WP_CACHE', true); // Enable caching for better performance
}