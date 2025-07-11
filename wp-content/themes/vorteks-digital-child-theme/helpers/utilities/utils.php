<?php 

// Include tracking code file
require_once get_stylesheet_directory() . '/tracking-codes.php';

// Enhance Performance 
function vrtks_cleanup_beaver_assets() {
    if (wp_style_is('fl-theme', 'enqueued')) {
        wp_dequeue_style('fl-theme');
        wp_deregister_style('fl-theme');
        error_log('Removed fl-theme');
    }

    if (wp_style_is('font-awesome', 'enqueued')) {
        wp_dequeue_style('font-awesome');
        wp_deregister_style('font-awesome');
        error_log('Removed font-awesome');
    }

    if (!is_user_logged_in() && wp_style_is('dashicons', 'enqueued')) {
        wp_dequeue_style('dashicons');
        error_log('Removed dashicons');
    }

    if (wp_style_is('wp-block-library', 'enqueued')) {
        wp_dequeue_style('wp-block-library');
        error_log('Removed wp-block-library');
    }
}
add_action('wp_enqueue_scripts', 'vrtks_cleanup_beaver_assets', 100);

// Cleaning up head
function vrtks_cleanup_wp_head() {
    // Remove WordPress version
    remove_action('wp_head', 'wp_generator');
    
    // Remove RSD (Really Simple Discovery) link
    remove_action('wp_head', 'rsd_link');
    
    // Remove wlwmanifest link (Windows Live Writer)
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');

    // Remove REST API link tag
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    
    // Remove oEmbed discovery links
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    
    // Remove Emoji scripts and styles
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');


    // Remove Feed Links
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    
}
add_action('init', 'vrtks_cleanup_wp_head');

// Style Sheets
function vrtks_enqueue_assets() {
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/dist/css/main.css',
        [],
        filemtime(get_stylesheet_directory() . '/dist/css/main.css')
    );

    wp_enqueue_script(
        'child-script',
        get_stylesheet_directory_uri() . '/dist/js/script.js',
        [],
        filemtime(get_stylesheet_directory() . '/dist/js/script.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'vrtks_enqueue_assets');

// Add SVG Support
function vrtks_allow_svg_uploads($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'vrtks_allow_svg_uploads');