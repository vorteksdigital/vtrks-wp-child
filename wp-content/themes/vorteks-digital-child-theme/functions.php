<?php
/**
 * Theme functions and definitions.
 *
 * Handles conditional loading for Hello Elementor, Beaver Builder, or Vorteks Digital themes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Always load custom helper functions
require_once 'helpers/index.php';

// Detect active theme
$theme = wp_get_theme();
$theme_name = $theme->get('Name');
$template = $theme->get_template(); // More reliable for child themes

// === If Hello Elementor is the parent theme ===
if ( $template === 'hello-elementor' ) {

	define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

	function hello_elementor_child_scripts_styles() {
		wp_enqueue_style(
			'hello-elementor-child-style',
			get_stylesheet_directory_uri() . '/style.css',
			[ 'hello-elementor-theme-style' ],
			HELLO_ELEMENTOR_CHILD_VERSION
		);
	}
	add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );

// === If Beaver Builder Theme or Vorteks Digital Theme is active ===
} elseif ( in_array( $template, [ 'bb-theme', 'vrtks-digital' ] ) ) {

	define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
	define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

	require_once 'classes/class-fl-child-theme.php';

	add_action( 'fl_head', 'FLChildTheme::stylesheet' );
}
