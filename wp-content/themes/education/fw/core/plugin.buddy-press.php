<?php
/* BuddyPress support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('themerex_buddypress_theme_setup')) {
	add_action( 'themerex_action_before_init_theme', 'themerex_buddypress_theme_setup' );
	function themerex_buddypress_theme_setup() {
		if (themerex_is_buddypress_page()) {
			add_action( 'themerex_action_add_styles', 'themerex_buddypress_frontend_scripts' );
			// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
			add_filter('themerex_filter_detect_inheritance_key',	'themerex_buddypress_detect_inheritance_key', 9, 1);
		}
	}
}
if ( !function_exists( 'themerex_buddypress_settings_theme_setup2' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_buddypress_settings_theme_setup2', 3 );
	function themerex_buddypress_settings_theme_setup2() {
		if (themerex_exists_buddypress()) {
			themerex_add_theme_inheritance( array('buddypress' => array(
				'stream_template' => 'buddypress',
				'single_template' => '',
				'taxonomy' => array(),
				'taxonomy_tags' => array(),
				'post_type' => array(),
				'override' => 'page'
				) )
			);
		}
	}
}

// Check if BuddyPress installed and activated
if ( !function_exists( 'themerex_exists_buddypress' ) ) {
	function themerex_exists_buddypress() {
		return class_exists( 'BuddyPress' );
	}
}

// Check if current page is BuddyPress page
if ( !function_exists( 'themerex_is_buddypress_page' ) ) {
	function themerex_is_buddypress_page() {
		return  themerex_is_bbpress_page() || (function_exists('is_buddypress') && is_buddypress());
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'themerex_buddypress_detect_inheritance_key' ) ) {
	//add_filter('themerex_filter_detect_inheritance_key',	'themerex_buddypress_detect_inheritance_key', 9, 1);
	function themerex_buddypress_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return themerex_is_buddypress_page() ? 'buddypress' : '';
	}
}

// Enqueue BuddyPress custom styles
if ( !function_exists( 'themerex_buddypress_frontend_scripts' ) ) {
	//add_action( 'themerex_action_add_styles', 'themerex_buddypress_frontend_scripts' );
	function themerex_buddypress_frontend_scripts() {
		themerex_enqueue_style( 'buddypress-style',  themerex_get_file_url('css/buddypress-style.css'), array(), null );
	}
}

?>