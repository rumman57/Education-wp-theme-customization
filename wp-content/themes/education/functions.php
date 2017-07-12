<?php
/**
 * Theme sprecific functions and definitions
 */


/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */

// Add theme specific actions and filters
// Attention! Function were add theme specific actions and filters handlers must have priority 1
if ( !function_exists( 'themerex_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_theme_setup', 1 );
	function themerex_theme_setup() {

		// Register theme menus
		add_filter( 'themerex_filter_add_theme_menus',		'themerex_add_theme_menus' );

		// Register theme sidebars
		add_filter( 'themerex_filter_add_theme_sidebars',	'themerex_add_theme_sidebars' );

		// Set theme name and folder (for the update notifier)
		add_filter('themerex_filter_update_notifier', 		'themerex_set_theme_names_for_updater');
	}
}


// Add/Remove theme nav menus
if ( !function_exists( 'themerex_add_theme_menus' ) ) {
	//add_filter( 'themerex_action_add_theme_menus', 'themerex_add_theme_menus' );
	function themerex_add_theme_menus($menus) {
		
		//For example:
		//$menus['menu_footer'] = __('Footer Menu', 'themerex');
		//if (isset($menus['menu_panel'])) unset($menus['menu_panel']);
		
		if (isset($menus['menu_side'])) unset($menus['menu_side']);
		return $menus;
	}
}


// Add theme specific widgetized areas
if ( !function_exists( 'themerex_add_theme_sidebars' ) ) {
	//add_filter( 'themerex_filter_add_theme_sidebars',	'themerex_add_theme_sidebars' );
	function themerex_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> __( 'Main Sidebar', 'themerex' ),
				'sidebar_footer'	=> __( 'Footer Sidebar', 'themerex' )
			);
			if (themerex_exists_woocommerce()) {
				$theme_sidebars['sidebar_cart']  = __( 'WooCommerce Cart Sidebar', 'themerex' );
			}
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}

// Set theme name and folder (for the update notifier)
if ( !function_exists( 'themerex_set_theme_names_for_updater' ) ) {
	//add_filter('themerex_filter_update_notifier', 'themerex_set_theme_names_for_updater');
	function themerex_set_theme_names_for_updater($opt) {
		$opt['theme_name']   = 'Education';
		$opt['theme_folder'] = 'education';
		return $opt;
	}
}



/* Include framework core files
------------------------------------------------------------------- */

require_once( get_template_directory().'/fw/loader.php' );
?>