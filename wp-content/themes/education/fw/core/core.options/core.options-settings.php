<?php

/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_options_settings_theme_setup2' ) ) {
	add_action( 'themerex_action_after_init_theme', 'themerex_options_settings_theme_setup2', 1 );
	function themerex_options_settings_theme_setup2() {
		if (themerex_options_is_used()) {
			global $THEMEREX_GLOBALS;
			// Replace arrays with actual parameters
			$lists = array();
			foreach ($THEMEREX_GLOBALS['options'] as $k=>$v) {
				if (isset($v['options']) && is_array($v['options'])) {
					foreach ($v['options'] as $k1=>$v1) {
						if (themerex_substr($k1, 0, 10) == '$themerex_' || themerex_substr($v1, 0, 10) == '$themerex_') {
							$list_func = themerex_substr(themerex_substr($k1, 0, 10) == '$themerex_' ? $k1 : $v1, 1);
							unset($THEMEREX_GLOBALS['options'][$k]['options'][$k1]);
							if (isset($lists[$list_func]))
								$THEMEREX_GLOBALS['options'][$k]['options'] = themerex_array_merge($THEMEREX_GLOBALS['options'][$k]['options'], $lists[$list_func]);
							else {
								if (function_exists($list_func)) {
									$THEMEREX_GLOBALS['options'][$k]['options'] = $lists[$list_func] = themerex_array_merge($THEMEREX_GLOBALS['options'][$k]['options'], $list_func == 'themerex_get_list_menus' ? $list_func(true) : $list_func());
							   	} else
							   		echo sprintf(__('Wrong function name %s in the theme options array', 'themerex'), $list_func);
							}
						}
					}
				}
			}
		}
	}
}

// Reset old Theme Options on theme first run
if ( !function_exists( 'themerex_options_reset' ) ) {
	function themerex_options_reset($clear=true) {
		$theme_data = wp_get_theme();
		$slug = str_replace(' ', '_', trim(themerex_strtolower((string) $theme_data->get('Name'))));
		$option_name = 'themerex_'.strip_tags($slug).'_options_reset';
		if ( get_option($option_name, false) === false ) {	// && (string) $theme_data->get('Version') == '1.0'
			if ($clear) {
				global $wpdb;
				$wpdb->query('delete from '.esc_sql($wpdb->options).' where option_name like "themerex_options%"');
			}
			add_option($option_name, 1, '', 'yes');
		}
	}
}

// Prepare default Theme Options
if ( !function_exists( 'themerex_options_settings_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_options_settings_theme_setup', 2 );	// Priority 1 for add themerex_filter handlers
	function themerex_options_settings_theme_setup() {
		global $THEMEREX_GLOBALS;
		
		// Remove 'false' to clear all saved Theme Options on next run.
		// Attention! Use this way only on new theme installation, not in updates!
		themerex_options_reset(false);
		
		// Prepare arrays 
		$THEMEREX_GLOBALS['options_params'] = array(
			'list_fonts'		=> array('$themerex_get_list_fonts' => ''),
			'list_fonts_styles'	=> array('$themerex_get_list_fonts_styles' => ''),
			'list_socials' 		=> array('$themerex_get_list_socials' => ''),
			'list_icons' 		=> array('$themerex_get_list_icons' => ''),
			'list_posts_types' 	=> array('$themerex_get_list_posts_types' => ''),
			'list_categories' 	=> array('$themerex_get_list_categories' => ''),
			'list_menus'		=> array('$themerex_get_list_menus' => ''),
			'list_sidebars'		=> array('$themerex_get_list_sidebars' => ''),
			'list_positions' 	=> array('$themerex_get_list_sidebars_positions' => ''),
			'list_tints'	 	=> array('$themerex_get_list_bg_tints' => ''),
			'list_sidebar_styles' => array('$themerex_get_list_sidebar_styles' => ''),
			'list_skins'		=> array('$themerex_get_list_skins' => ''),
			'list_color_schemes'=> array('$themerex_get_list_color_schemes' => ''),
			'list_body_styles'	=> array('$themerex_get_list_body_styles' => ''),
			'list_blog_styles'	=> array('$themerex_get_list_templates_blog' => ''),
			'list_single_styles'=> array('$themerex_get_list_templates_single' => ''),
			'list_article_styles'=> array('$themerex_get_list_article_styles' => ''),
			'list_animations_in' => array('$themerex_get_list_animations_in' => ''),
			'list_animations_out'=> array('$themerex_get_list_animations_out' => ''),
			'list_filters'		=> array('$themerex_get_list_portfolio_filters' => ''),
			'list_hovers'		=> array('$themerex_get_list_hovers' => ''),
			'list_hovers_dir'	=> array('$themerex_get_list_hovers_directions' => ''),
			'list_sliders' 		=> array('$themerex_get_list_sliders' => ''),
			'list_popups' 		=> array('$themerex_get_list_popup_engines' => ''),
			'list_gmap_styles' 	=> array('$themerex_get_list_googlemap_styles' => ''),
			'list_yes_no' 		=> array('$themerex_get_list_yesno' => ''),
			'list_on_off' 		=> array('$themerex_get_list_onoff' => ''),
			'list_show_hide' 	=> array('$themerex_get_list_showhide' => ''),
			'list_sorting' 		=> array('$themerex_get_list_sortings' => ''),
			'list_ordering' 	=> array('$themerex_get_list_orderings' => ''),
			'list_locations' 	=> array('$themerex_get_list_dedicated_locations' => '')
			);


		// Theme options array
		$THEMEREX_GLOBALS['options'] = array(

		
		//###############################
		//#### Customization         #### 
		//###############################
		'partition_customization' => array(
					"title" => __('Customization', 'themerex'),
					"start" => "partitions",
					"override" => "category,courses_group,page,post",
					"icon" => "iconadmin-cog-alt",
					"type" => "partition"
					),
		
		
		// Customization -> General
		//-------------------------------------------------
		
		'customization_general' => array(
					"title" => __('General', 'themerex'),
					"override" => "category,courses_group,page,post",
					"icon" => 'iconadmin-cog',
					"start" => "customization_tabs",
					"type" => "tab"
					),
		
		'info_custom_1' => array(
					"title" => __('Theme customization general parameters', 'themerex'),
					"desc" => __('Select main theme skin, customize colors and enable responsive layouts for the small screens', 'themerex'),
					"override" => "category,courses_group,page,post",
					"type" => "info"
					),
		
		'theme_skin' => array(
					"title" => __('Select theme skin', 'themerex'),
					"desc" => __('Select skin for the theme decoration', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "education",
					"options" => $THEMEREX_GLOBALS['options_params']['list_skins'],
					"type" => "select"
					),
		
		"icon" => array(
					"title" => __('Select icon', 'themerex'),
					"desc" => __('Select icon for output before post/category name in some layouts', 'themerex'),
					"override" => "category,courses_group,post",
					"std" => "",
					"options" => $THEMEREX_GLOBALS['options_params']['list_icons'],
					"style" => "select",
					"type" => "icons"
					),

		"post_color" => array(
					"title" => __('Posts color', 'themerex'),
					"desc" => __('Posts color - used as accent color to display posts in some layouts. If empty - used link, menu and usermenu colors - see below', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"color_scheme" => array(
					"title" => __('Color scheme', 'themerex'),
					"desc" => __('Select predefined color scheme. Or set separate colors in fields below', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "original",
					"dir" => "horizontal",
					"options" => $THEMEREX_GLOBALS['options_params']['list_color_schemes'],
					"type" => "checklist"),

		"link_color" => array(
					"title" => __('Links color', 'themerex'),
					"desc" => __('Links color. Also used as background color for the page header area and some other elements', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"link_dark" => array(
					"title" => __('Links dark color', 'themerex'),
					"desc" => __('Used as background color for the buttons, hover states and some other elements', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"menu_color" => array(
					"title" => __('Main menu color', 'themerex'),
					"desc" => __('Used as background color for the active menu item, calendar item, tabs and some other elements', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"menu_dark" => array(
					"title" => __('Main menu dark color', 'themerex'),
					"desc" => __('Used as text color for the menu items (in the Light style), as background color for the selected menu item, etc.', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"user_color" => array(
					"title" => __('User menu color', 'themerex'),
					"desc" => __('Used as background color for the user menu items and some other elements', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"user_dark" => array(
					"title" => __('User menu dark color', 'themerex'),
					"desc" => __('Used as background color for the selected user menu item, etc.', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),


		'show_theme_customizer' => array(
					"title" => __('Show Theme customizer', 'themerex'),
					"desc" => __('Do you want to show theme customizer in the right panel? Your website visitors will be able to customise it yourself.', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

		"customizer_demo" => array(
					"title" => __('Theme customizer panel demo time', 'themerex'),
					"desc" => __('Timer for demo mode for the customizer panel (in milliseconds: 1000ms = 1s). If 0 - no demo.', 'themerex'),
					"divider" => false,
					"std" => "0",
					"min" => 0,
					"max" => 10000,
					"step" => 500,
					"type" => "spinner"),
		
		'css_animation' => array(
					"title" => __('Extended CSS animations', 'themerex'),
					"desc" => __('Do you want use extended animations effects on your site?', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

		'remember_visitors_settings' => array(
					"title" => __('Remember visitor\'s settings', 'themerex'),
					"desc" => __('To remember the settings that were made by the visitor, when navigating to other pages or to limit their effect only within the current page', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
					
		'responsive_layouts' => array(
					"title" => __('Responsive Layouts', 'themerex'),
					"desc" => __('Do you want use responsive layouts on small screen or still use main layout?', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
		
		'info_custom_2' => array(
					"title" => __('Additional CSS and HTML/JS code', 'themerex'),
					"desc" => __('Put here your custom CSS and JS code', 'themerex'),
					"override" => "category,courses_group,page,post",
					"type" => "info"
					),
		
		'custom_css' => array(
					"title" => __('Your CSS code',  'themerex'),
					"desc" => __('Put here your css code to correct main theme styles',  'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"
					),
		
		'custom_code' => array(
					"title" => __('Your HTML/JS code',  'themerex'),
					"desc" => __('Put here your invisible html/js code: Google analitics, counters, etc',  'themerex'),
					"override" => "category,courses_group,post,page",
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"
					),
		
		
		// Customization -> Body Style
		//-------------------------------------------------
		
		'customization_body' => array(
					"title" => __('Body style', 'themerex'),
					"override" => "category,courses_group,post,page",
					"icon" => 'iconadmin-picture-1',
					"type" => "tab"
					),
		
		'info_custom_3' => array(
					"title" => __('Body parameters', 'themerex'),
					"desc" => __('Background color, pattern and image used only for fixed body style.', 'themerex'),
					"override" => "category,courses_group,post,page",
					"type" => "info"
					),
					
		'body_style' => array(
					"title" => __('Body style', 'themerex'),
					"desc" => __('Select body style:<br><b>boxed</b> - if you want use background color and/or image,<br><b>wide</b> - page fill whole window with centered content,<br><b>fullwide</b> - page content stretched on the full width of the window (with few left and right paddings),<br><b>fullscreen</b> - page content fill whole window without any paddings', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "wide",
					"options" => $THEMEREX_GLOBALS['options_params']['list_body_styles'],
					"dir" => "horizontal",
					"type" => "radio"
					),
		
		'body_filled' => array(
					"title" => __('Fill body', 'themerex'),
					"desc" => __('Fill the body background with the solid color (white or grey) or leave it transparend to show background image (or video)', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
		
		'load_bg_image' => array(
					"title" => __('Load background image', 'themerex'),
					"desc" => __('Always load background images or only for boxed body style', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "boxed",
					"size" => "medium",
					"options" => array(
						'boxed' => __('Boxed', 'themerex'),
						'always' => __('Always', 'themerex')
					),
					"type" => "switch"
					),
		
		'bg_color' => array(
					"title" => __('Background color',  'themerex'),
					"desc" => __('Body background color',  'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "#bfbfbf",
					"type" => "color"
					),
		
		'bg_pattern' => array(
					"title" => __('Background predefined pattern',  'themerex'),
					"desc" => __('Select theme background pattern (first case - without pattern)',  'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"options" => array(
						0 => themerex_get_file_url('/images/spacer.png'),
						1 => themerex_get_file_url('/images/bg/pattern_1.png'),
						2 => themerex_get_file_url('/images/bg/pattern_2.png'),
						3 => themerex_get_file_url('/images/bg/pattern_3.png'),
						4 => themerex_get_file_url('/images/bg/pattern_4.png'),
						5 => themerex_get_file_url('/images/bg/pattern_5.png'),
						6 => themerex_get_file_url('/images/bg/pattern_6.png'),
						7 => themerex_get_file_url('/images/bg/pattern_7.png'),
						8 => themerex_get_file_url('/images/bg/pattern_8.png'),
						9 => themerex_get_file_url('/images/bg/pattern_9.png')
					),
					"style" => "list",
					"type" => "images"
					),
		
		'bg_custom_pattern' => array(
					"title" => __('Background custom pattern',  'themerex'),
					"desc" => __('Select or upload background custom pattern. If selected - use it instead the theme predefined pattern (selected in the field above)',  'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "media"
					),
		
		'bg_image' => array(
					"title" => __('Background predefined image',  'themerex'),
					"desc" => __('Select theme background image (first case - without image)',  'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"options" => array(
						0 => themerex_get_file_url('/images/spacer.png'),
						1 => themerex_get_file_url('/images/bg/image_1_thumb.jpg'),
						2 => themerex_get_file_url('/images/bg/image_2_thumb.jpg'),
						3 => themerex_get_file_url('/images/bg/image_3_thumb.jpg'),
						4 => themerex_get_file_url('/images/bg/image_4_thumb.jpg'),
						5 => themerex_get_file_url('/images/bg/image_5_thumb.jpg'),
						6 => themerex_get_file_url('/images/bg/image_6_thumb.jpg')
					),
					"style" => "list",
					"type" => "images"
					),
		
		'bg_custom_image' => array(
					"title" => __('Background custom image',  'themerex'),
					"desc" => __('Select or upload background custom image. If selected - use it instead the theme predefined image (selected in the field above)',  'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "media"
					),
		
		'bg_custom_image_position' => array( 
					"title" => __('Background custom image position',  'themerex'),
					"desc" => __('Select custom image position',  'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "left_top",
					"options" => array(
						'left_top' => "Left Top",
						'center_top' => "Center Top",
						'right_top' => "Right Top",
						'left_center' => "Left Center",
						'center_center' => "Center Center",
						'right_center' => "Right Center",
						'left_bottom' => "Left Bottom",
						'center_bottom' => "Center Bottom",
						'right_bottom' => "Right Bottom",
					),
					"type" => "select"
					),
		
		'show_video_bg' => array(
					"title" => __('Show video background',  'themerex'),
					"desc" => __("Show video on the site background (only for Fullscreen body style)", 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
		
		'video_bg_youtube_code' => array(
					"title" => __('Youtube code for video bg',  'themerex'),
					"desc" => __("Youtube code of video", 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "text"
					),
		
		'video_bg_url' => array(
					"title" => __('Local video for video bg',  'themerex'),
					"desc" => __("URL to video-file (uploaded on your site)", 'themerex'),
					"readonly" =>false,
					"override" => "category,courses_group,post,page",
					"before" => array(	'title' => __('Choose video', 'themerex'),
										'action' => 'media_upload',
										'multiple' => false,
										'linked_field' => '',
										'type' => 'video',
										'captions' => array('choose' => __( 'Choose Video', 'themerex'),
															'update' => __( 'Select Video', 'themerex')
														)
								),
					"std" => "",
					"type" => "media"
					),
		
		'video_bg_overlay' => array(
					"title" => __('Use overlay for video bg', 'themerex'),
					"desc" => __('Use overlay texture for the video background', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),
		
		
		
		// Customization -> Logo
		//-------------------------------------------------
		
		'customization_logo' => array(
					"title" => __('Logo', 'themerex'),
					"override" => "category,courses_group,post,page",
					"icon" => 'iconadmin-heart-1',
					"type" => "tab"
					),
		
		'info_custom_4' => array(
					"title" => __('Main logo', 'themerex'),
					"desc" => __('Select or upload logos for the site\'s header and select it position', 'themerex'),
					"override" => "category,courses_group,post,page",
					"type" => "info"
					),

		'favicon' => array(
					"title" => __('Favicon', 'themerex'),
					"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. (<a href="http://www.favicon.cc/">www.favicon.cc</a>)</em>', 'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "media"
					),

		'logo_dark' => array(
					"title" => __('Logo image (dark header)', 'themerex'),
					"desc" => __('Main logo image for the dark header', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "media"
					),

		'logo_light' => array(
					"title" => __('Logo image (light header)', 'themerex'),
					"desc" => __('Main logo image for the light header', 'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "",
					"type" => "media"
					),

		'logo_fixed' => array(
					"title" => __('Logo image (fixed header)', 'themerex'),
					"desc" => __('Logo image for the header (if menu is fixed after the page is scrolled)', 'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "",
					"type" => "media"
					),
		
		'logo_from_skin' => array(
					"title" => __('Logo from skin',  'themerex'),
					"desc" => __("Use logo images from current skin folder if not filled out fields above", 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"
					),

		'logo_text' => array(
					"title" => __('Logo text', 'themerex'),
					"desc" => __('Logo text - display it after logo image', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => '',
					"type" => "text"
					),

		'logo_slogan' => array(
					"title" => __('Logo slogan', 'themerex'),
					"desc" => __('Logo slogan - display it under logo image (instead the site slogan)', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => '',
					"type" => "text"
					),

		'logo_height' => array(
					"title" => __('Logo height', 'themerex'),
					"desc" => __('Height for the logo in the header area', 'themerex'),
					"override" => "category,courses_group,post,page",
					"step" => 1,
					"std" => '',
					"min" => 10,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"
					),

		'logo_offset' => array(
					"title" => __('Logo top offset', 'themerex'),
					"desc" => __('Top offset for the logo in the header area', 'themerex'),
					"override" => "category,courses_group,post,page",
					"step" => 1,
					"std" => '',
					"min" => 0,
					"max" => 99,
					"mask" => "?99",
					"type" => "spinner"
					),

		'logo_align' => array(
					"title" => __('Logo alignment', 'themerex'),
					"desc" => __('Logo alignment (only if logo above menu)', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "left",
					"options" =>  array("left"=>__("Left", 'themerex'), "center"=>__("Center", 'themerex'), "right"=>__("Right", 'themerex')),
					"dir" => "horizontal",
					"type" => "checklist"
					),

		'iinfo_custom_5' => array(
					"title" => __('Logo for footer', 'themerex'),
					"desc" => __('Select or upload logos for the site\'s footer and set it height', 'themerex'),
					"override" => "category,courses_group,post,page",
					"type" => "info"
					),

		'logo_footer' => array(
					"title" => __('Logo image for footer', 'themerex'),
					"desc" => __('Logo image for the footer', 'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "",
					"type" => "media"
					),
		
		'logo_footer_height' => array(
					"title" => __('Logo height', 'themerex'),
					"desc" => __('Height for the logo in the footer area (in contacts)', 'themerex'),
					"override" => "category,courses_group,post,page",
					"step" => 1,
					"std" => 30,
					"min" => 10,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"
					),
		
		
		
		// Customization -> Menus
		//-------------------------------------------------
		
		"customization_menus" => array(
					"title" => __('Menus', 'themerex'),
					"override" => "category,courses_group,post,page",
					"icon" => 'iconadmin-menu',
					"type" => "tab"),
		
		"info_custom_6" => array(
					"title" => __('Top panel', 'themerex'),
					"desc" => __('Top panel settings. It include user menu area (with contact info, cart button, language selector, login/logout menu and user menu) and main menu area (with logo and main menu).', 'themerex'),
					"override" => "category,courses_group,post,page",
					"type" => "info"),
		
		"top_panel_position" => array( 
					"title" => __('Top panel position', 'themerex'),
					"desc" => __('Select position for the top panel with logo and main menu', 'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "above",
					"options" => array(
						'hide'  => __('Hide', 'themerex'),
						'above' => __('Above slider', 'themerex'),
						'below' => __('Below slider', 'themerex'),
						'over'  => __('Over slider', 'themerex')
					),
					"type" => "checklist"),
		
		"top_panel_style" => array( 
					"title" => __('Top panel style', 'themerex'),
					"desc" => __('Select background style for the top panel with logo and main menu', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "dark",
					"options" => array(
						'dark' => __('Dark', 'themerex'),
						'light' => __('Light', 'themerex')
					),
					"type" => "checklist"),
		
		"top_panel_opacity" => array( 
					"title" => __('Top panel opacity', 'themerex'),
					"desc" => __('Select background opacity for the top panel with logo and main menu', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "solid",
					"options" => array(
						'solid' => __('Solid', 'themerex'),
						'transparent' => __('Transparent', 'themerex')
					),
					"type" => "checklist"),
		
		'top_panel_bg_color' => array(
					"title" => __('Top panel bg color',  'themerex'),
					"desc" => __('Background color for the top panel',  'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"
					),
		
		"top_panel_bg_image" => array( 
					"title" => __('Top panel bg image', 'themerex'),
					"desc" => __('Upload top panel background image', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "media"),
		
		
		"info_custom_7" => array( 
					"title" => __('Main menu style and position', 'themerex'),
					"desc" => __('Select the Main menu style and position', 'themerex'),
					"override" => "category,courses_group,post,page",
					"type" => "info"),
		
		"menu_main" => array( 
					"title" => __('Select main menu',  'themerex'),
					"desc" => __('Select main menu for the current page',  'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "default",
					"options" => $THEMEREX_GLOBALS['options_params']['list_menus'],
					"type" => "select"),
		
		"menu_position" => array( 
					"title" => __('Main menu position', 'themerex'),
					"desc" => __('Attach main menu to top of window then page scroll down', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "fixed",
					"options" => array("fixed"=>__("Fix menu position", 'themerex'), "none"=>__("Don't fix menu position", 'themerex')),
					"dir" => "vertical",
					"type" => "radio"),
		
		"menu_align" => array( 
					"title" => __('Main menu alignment', 'themerex'),
					"desc" => __('Main menu alignment', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "right",
					"options" => array(
						"left"   => __("Left (under logo)", 'themerex'),
						"center" => __("Center (under logo)", 'themerex'),
						"right"	 => __("Right (at same line with logo)", 'themerex')
					),
					"dir" => "vertical",
					"type" => "radio"),

		"menu_slider" => array( 
					"title" => __('Main menu slider', 'themerex'),
					"desc" => __('Use slider background for main menu items', 'themerex'),
					"std" => "yes",
					"type" => "switch",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no']),

		"menu_animation_in" => array( 
					"title" => __('Submenu show animation', 'themerex'),
					"desc" => __('Select animation to show submenu ', 'themerex'),
					"std" => "bounceIn",
					"type" => "select",
					"options" => $THEMEREX_GLOBALS['options_params']['list_animations_in']),

		"menu_animation_out" => array( 
					"title" => __('Submenu hide animation', 'themerex'),
					"desc" => __('Select animation to hide submenu ', 'themerex'),
					"std" => "fadeOutDown",
					"type" => "select",
					"options" => $THEMEREX_GLOBALS['options_params']['list_animations_out']),
		
		"menu_relayout" => array( 
					"title" => __('Main menu relayout', 'themerex'),
					"desc" => __('Allow relayout main menu if window width less then this value', 'themerex'),
					"std" => 960,
					"min" => 320,
					"max" => 1024,
					"type" => "spinner"),
		
		"menu_responsive" => array( 
					"title" => __('Main menu responsive', 'themerex'),
					"desc" => __('Allow responsive version for the main menu if window width less then this value', 'themerex'),
					"std" => 640,
					"min" => 320,
					"max" => 1024,
					"type" => "spinner"),
		
		"menu_width" => array( 
					"title" => __('Submenu width', 'themerex'),
					"desc" => __('Width for dropdown menus in main menu', 'themerex'),
					"override" => "category,courses_group,post,page",
					"step" => 5,
					"std" => "",
					"min" => 180,
					"max" => 300,
					"mask" => "?999",
					"type" => "spinner"),
		
		
		
		"info_custom_8" => array(
					"title" => __("User's menu area components", 'themerex'),
					"desc" => __("Select parts for the user's menu area", 'themerex'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
		
		"show_menu_user" => array(
					"title" => __('Show user menu area', 'themerex'),
					"desc" => __('Show user menu area on top of page', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"menu_user" => array(
					"title" => __('Select user menu',  'themerex'),
					"desc" => __('Select user menu for the current page',  'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "default",
					"options" => $THEMEREX_GLOBALS['options_params']['list_menus'],
					"type" => "select"),
		
		"show_contact_info" => array(
					"title" => __('Show contact info', 'themerex'),
					"desc" => __("Show the contact details for the owner of the site at the top left corner of the page", 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_currency" => array(
					"title" => __('Show currency selector', 'themerex'),
					"desc" => __('Show currency selector in the user menu', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_cart" => array(
					"title" => __('Show cart button', 'themerex'),
					"desc" => __('Show cart button in the user menu', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "shop",
					"options" => array(
						'hide'   => __('Hide', 'themerex'),
						'always' => __('Always', 'themerex'),
						'shop'   => __('Only on shop pages', 'themerex')
					),
					"type" => "checklist"),
		
		"show_languages" => array(
					"title" => __('Show language selector', 'themerex'),
					"desc" => __('Show language selector in the user menu (if WPML plugin installed and current page/post has multilanguage version)', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_login" => array( 
					"title" => __('Show Login/Logout buttons', 'themerex'),
					"desc" => __('Show Login and Logout buttons in the user menu area', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_bookmarks" => array(
					"title" => __('Show bookmarks', 'themerex'),
					"desc" => __('Show bookmarks selector in the user menu', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		

		
		"info_custom_9" => array( 
					"title" => __("Table of Contents (TOC)", 'themerex'),
					"desc" => __("Table of Contents for the current page. Automatically created if the page contains objects with id starting with 'toc_'", 'themerex'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
		
		"menu_toc" => array( 
					"title" => __('TOC position', 'themerex'),
					"desc" => __('Show TOC for the current page', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "float",
					"options" => array(
						'hide'  => __('Hide', 'themerex'),
						'fixed' => __('Fixed', 'themerex'),
						'float' => __('Float', 'themerex')
					),
					"type" => "checklist"),
		
		"menu_toc_home" => array(
					"title" => __('Add "Home" into TOC', 'themerex'),
					"desc" => __('Automatically add "Home" item into table of contents - return to home page of the site', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"menu_toc_top" => array( 
					"title" => __('Add "To Top" into TOC', 'themerex'),
					"desc" => __('Automatically add "To Top" item into table of contents - scroll to top of the page', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		
		
		// Customization -> Sidebars
		//-------------------------------------------------
		
		"customization_sidebars" => array( 
					"title" => __('Sidebars', 'themerex'),
					"icon" => "iconadmin-indent-right",
					"override" => "category,courses_group,post,page",
					"type" => "tab"),
		
		"info_custom_10" => array( 
					"title" => __('Custom sidebars', 'themerex'),
					"desc" => __('In this section you can create unlimited sidebars. You can fill them with widgets in the menu Appearance - Widgets', 'themerex'),
					"type" => "info"),
		
		"custom_sidebars" => array(
					"title" => __('Custom sidebars',  'themerex'),
					"desc" => __('Manage custom sidebars. You can use it with each category (page, post) independently',  'themerex'),
					"divider" => false,
					"std" => "",
					"cloneable" => true,
					"type" => "text"),
		
		"info_custom_11" => array(
					"title" => __('Sidebars settings', 'themerex'),
					"desc" => __('Show / Hide and Select sidebar in each location', 'themerex'),
					"override" => "category,courses_group,post,page",
					"type" => "info"),
		
		'show_sidebar_main' => array( 
					"title" => __('Show main sidebar',  'themerex'),
					"desc" => __('Select style for the main sidebar or hide it',  'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "light",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sidebar_styles'],
					"dir" => "horizontal",
					"type" => "checklist"),
		
		'sidebar_main_position' => array( 
					"title" => __('Main sidebar position',  'themerex'),
					"desc" => __('Select main sidebar position on blog page',  'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "right",
					"options" => $THEMEREX_GLOBALS['options_params']['list_positions'],
					"size" => "medium",
					"type" => "switch"),
		
		"sidebar_main" => array( 
					"title" => __('Select main sidebar',  'themerex'),
					"desc" => __('Select main sidebar for the blog page',  'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "sidebar_main",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sidebars'],
					"type" => "select"),
		
		"show_sidebar_footer" => array(
					"title" => __('Show footer sidebar', 'themerex'),
					"desc" => __('Select style for the footer sidebar or hide it', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "light",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sidebar_styles'],
					"dir" => "horizontal",
					"type" => "checklist"),
		
		"sidebar_footer" => array( 
					"title" => __('Select footer sidebar',  'themerex'),
					"desc" => __('Select footer sidebar for the blog page',  'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "sidebar_footer",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sidebars'],
					"type" => "select"),
		
		"sidebar_footer_columns" => array( 
					"title" => __('Footer sidebar columns',  'themerex'),
					"desc" => __('Select columns number for the footer sidebar',  'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => 3,
					"min" => 1,
					"max" => 6,
					"type" => "spinner"),
		
		
		
		
		
		
		
		// Customization -> Slider
		//-------------------------------------------------
		
		"customization_slider" => array( 
					"title" => __('Slider', 'themerex'),
					"icon" => "iconadmin-picture",
					"override" => "category,courses_group,page",
					"type" => "tab"),
		
		"info_custom_13" => array(
					"title" => __('Main slider parameters', 'themerex'),
					"desc" => __('Select parameters for main slider (you can override it in each category and page)', 'themerex'),
					"override" => "category,courses_group,page",
					"type" => "info"),
					
		"show_slider" => array(
					"title" => __('Show Slider', 'themerex'),
					"desc" => __('Do you want to show slider on each page (post)', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"slider_display" => array(
					"title" => __('Slider display', 'themerex'),
					"desc" => __('How display slider: boxed (fixed width and height), fullwide (fixed height) or fullscreen', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "none",
					"options" => array(
						"boxed"=>__("Boxed", 'themerex'),
						"fullwide"=>__("Fullwide", 'themerex'),
						"fullscreen"=>__("Fullscreen", 'themerex')
					),
					"type" => "checklist"),
		
		"slider_height" => array(
					"title" => __("Height (in pixels)", 'themerex'),
					"desc" => __("Slider height (in pixels) - only if slider display with fixed height.", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => '',
					"min" => 100,
					"step" => 10,
					"type" => "spinner"),
		
		"slider_engine" => array(
					"title" => __('Slider engine', 'themerex'),
					"desc" => __('What engine use to show slider?', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "flex",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sliders'],
					"type" => "radio"),
		
		"slider_alias" => array(
					"title" => __('Layer Slider: Alias (for Revolution) or ID (for Royal)',  'themerex'),
					"desc" => __("Revolution Slider alias or Royal Slider ID (see in slider settings on plugin page)", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "",
					"type" => "text"),
		
		"slider_category" => array(
					"title" => __('Posts Slider: Category to show', 'themerex'),
					"desc" => __('Select category to show in Flexslider (ignored for Revolution and Royal sliders)', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "",
					"options" => themerex_array_merge(array(0 => __('- Select category -', 'themerex')), $THEMEREX_GLOBALS['options_params']['list_categories']),
					"type" => "select",
					"multiple" => true,
					"style" => "list"),
		
		"slider_posts" => array(
					"title" => __('Posts Slider: Number posts or comma separated posts list',  'themerex'),
					"desc" => __("How many recent posts display in slider or comma separated list of posts ID (in this case selected category ignored)", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "5",
					"type" => "text"),
		
		"slider_orderby" => array(
					"title" => __("Posts Slider: Posts order by",  'themerex'),
					"desc" => __("Posts in slider ordered by date (default), comments, views, author rating, users rating, random or alphabetically", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "date",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sorting'],
					"type" => "select"),
		
		"slider_order" => array(
					"title" => __("Posts Slider: Posts order", 'themerex'),
					"desc" => __('Select the desired ordering method for posts', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "desc",
					"options" => $THEMEREX_GLOBALS['options_params']['list_ordering'],
					"size" => "big",
					"type" => "switch"),
					
		"slider_interval" => array(
					"title" => __("Posts Slider: Slide change interval", 'themerex'),
					"desc" => __("Interval (in ms) for slides change in slider", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => 7000,
					"min" => 100,
					"step" => 100,
					"type" => "spinner"),
		
		"slider_pagination" => array(
					"title" => __("Posts Slider: Pagination", 'themerex'),
					"desc" => __("Choose pagination style for the slider", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "no",
					"options" => array(
						'no'   => __('None', 'themerex'),
						'yes'  => __('Dots', 'themerex'), 
						'over' => __('Titles', 'themerex')
					),
					"type" => "checklist"),
		
		"slider_infobox" => array(
					"title" => __("Posts Slider: Show infobox", 'themerex'),
					"desc" => __("Do you want to show post's title, reviews rating and description on slides in slider", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "slide",
					"options" => array(
						'no'    => __('None',  'themerex'),
						'slide' => __('Slide', 'themerex'), 
						'fixed' => __('Fixed', 'themerex')
					),
					"type" => "checklist"),
					
		"slider_info_category" => array(
					"title" => __("Posts Slider: Show post's category", 'themerex'),
					"desc" => __("Do you want to show post's category on slides in slider", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"slider_info_reviews" => array(
					"title" => __("Posts Slider: Show post's reviews rating", 'themerex'),
					"desc" => __("Do you want to show post's reviews rating on slides in slider", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"slider_info_descriptions" => array(
					"title" => __("Posts Slider: Show post's descriptions", 'themerex'),
					"desc" => __("How many characters show in the post's description in slider. 0 - no descriptions", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => 0,
					"min" => 0,
					"step" => 10,
					"type" => "spinner"),
		
		
		
		
		// Customization -> Header & Footer
		//-------------------------------------------------
		
		'customization_header_footer' => array(
					"title" => __("Header &amp; Footer", 'themerex'),
					"override" => "category,courses_group,post,page",
					"icon" => 'iconadmin-window',
					"type" => "tab"),
		
		
		"info_footer_1" => array(
					"title" => __("Header settings", 'themerex'),
					"desc" => __("Select components of the page header, set style and put the content for the user's header area", 'themerex'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
		
		"show_user_header" => array(
					"title" => __("Show user's header", 'themerex'),
					"desc" => __("Show custom user's header", 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,page,post",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"user_header_content" => array(
					"title" => __("User's header content", 'themerex'),
					"desc" => __('Put header html-code and/or shortcodes here. You can use any html-tags and shortcodes', 'themerex'),
					"override" => "category,courses_group,page,post",
					"std" => "",
					"rows" => "10",
					"type" => "editor"),
		
		"show_page_top" => array(
					"title" => __('Show Top of page section', 'themerex'),
					"desc" => __('Show top section with post/page/category title and breadcrumbs', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_page_title" => array(
					"title" => __('Show Page title', 'themerex'),
					"desc" => __('Show post/page/category title', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_breadcrumbs" => array(
					"title" => __('Show Breadcrumbs', 'themerex'),
					"desc" => __('Show path to current category (post, page)', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"breadcrumbs_max_level" => array(
					"title" => __('Breadcrumbs max nesting', 'themerex'),
					"desc" => __("Max number of the nested categories in the breadcrumbs (0 - unlimited)", 'themerex'),
					"std" => "0",
					"min" => 0,
					"max" => 100,
					"step" => 1,
					"type" => "spinner"),
		
		
		
		
		"info_footer_2" => array(
					"title" => __("Footer settings", 'themerex'),
					"desc" => __("Select components of the footer, set style and put the content for the user's footer area", 'themerex'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
		
		"show_user_footer" => array(
					"title" => __("Show user's footer", 'themerex'),
					"desc" => __("Show custom user's footer", 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,page,post",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"user_footer_content" => array(
					"title" => __("User's footer content", 'themerex'),
					"desc" => __('Put footer html-code and/or shortcodes here. You can use any html-tags and shortcodes', 'themerex'),
					"override" => "category,courses_group,page,post",
					"std" => "",
					"rows" => "10",
					"type" => "editor"),
		
		"show_contacts_in_footer" => array(
					"title" => __('Show Contacts in footer', 'themerex'),
					"desc" => __('Show contact information area in footer: site logo, contact info and large social icons', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "dark",
					"options" => array(
						'hide' 	=> __('Hide', 'themerex'),
						'light'	=> __('Light', 'themerex'),
						'dark'	=> __('Dark', 'themerex')
					),
					"dir" => "horizontal",
					"type" => "checklist"),

		"show_copyright_in_footer" => array(
					"title" => __('Show Copyright area in footer', 'themerex'),
					"desc" => __('Show area with copyright information and small social icons in footer', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"footer_copyright" => array(
					"title" => __('Footer copyright text',  'themerex'),
					"desc" => __("Copyright text to show in footer area (bottom of site)", 'themerex'),
					"override" => "category,courses_group,page,post",
					"std" => "ThemeREX &copy; 2014 All Rights Reserved ",
					"rows" => "10",
					"type" => "editor"),
		
		
		"info_footer_3" => array(
					"title" => __('Testimonials in Footer', 'themerex'),
					"desc" => __('Select parameters for Testimonials in the Footer (you can override it in each category and page)', 'themerex'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),

		"show_testimonials_in_footer" => array(
					"title" => __('Show Testimonials in footer', 'themerex'),
					"desc" => __('Show Testimonials slider in footer. For correct operation of the slider (and shortcode testimonials) you must fill out Testimonials posts on the menu "Testimonials"', 'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "none",
					"options" => $THEMEREX_GLOBALS['options_params']['list_tints'],
					"type" => "checklist"),

		"testimonials_count" => array( 
					"title" => __('Testimonials count', 'themerex'),
					"desc" => __('Number testimonials to show', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => 3,
					"step" => 1,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),

		"testimonials_bg_image" => array( 
					"title" => __('Testimonials bg image', 'themerex'),
					"desc" => __('Select image or put image URL from other site to use it as testimonials block background', 'themerex'),
					"override" => "category,courses_group,post,page",
					"readonly" => false,
					"std" => "",
					"type" => "media"),

		"testimonials_bg_color" => array( 
					"title" => __('Testimonials bg color', 'themerex'),
					"desc" => __('Select color to use it as testimonials block background', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"testimonials_bg_overlay" => array( 
					"title" => __('Testimonials bg overlay', 'themerex'),
					"desc" => __('Select background color opacity to create overlay effect on background', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => 0,
					"step" => 0.1,
					"min" => 0,
					"max" => 1,
					"type" => "spinner"),
		
		
		"info_footer_4" => array(
					"title" => __('Twitter in Footer', 'themerex'),
					"desc" => __('Select parameters for Twitter stream in the Footer (you can override it in each category and page)', 'themerex'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),

		"show_twitter_in_footer" => array(
					"title" => __('Show Twitter in footer', 'themerex'),
					"desc" => __('Show Twitter slider in footer. For correct operation of the slider (and shortcode twitter) you must fill out the Twitter API keys on the menu "Appearance - Theme Options - Socials"', 'themerex'),
					"override" => "category,courses_group,post,page",
					"divider" => false,
					"std" => "none",
					"options" => $THEMEREX_GLOBALS['options_params']['list_tints'],
					"type" => "checklist"),

		"twitter_count" => array( 
					"title" => __('Twitter count', 'themerex'),
					"desc" => __('Number twitter to show', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => 3,
					"step" => 1,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),

		"twitter_bg_image" => array( 
					"title" => __('Twitter bg image', 'themerex'),
					"desc" => __('Select image or put image URL from other site to use it as Twitter block background', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "media"),

		"twitter_bg_color" => array( 
					"title" => __('Twitter bg color', 'themerex'),
					"desc" => __('Select color to use it as Twitter block background', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "",
					"type" => "color"),

		"twitter_bg_overlay" => array( 
					"title" => __('Twitter bg overlay', 'themerex'),
					"desc" => __('Select background color opacity to create overlay effect on background', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => 0,
					"step" => 0.1,
					"min" => 0,
					"max" => 1,
					"type" => "spinner"),


		"info_footer_5" => array(
					"title" => __('Google map parameters', 'themerex'),
					"desc" => __('Select parameters for Google map (you can override it in each category and page)', 'themerex'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
					
		"show_googlemap" => array(
					"title" => __('Show Google Map', 'themerex'),
					"desc" => __('Do you want to show Google map on each page (post)', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,page,post",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"googlemap_height" => array(
					"title" => __("Map height", 'themerex'),
					"desc" => __("Map height (default - in pixels, allows any CSS units of measure)", 'themerex'),
					"override" => "category,courses_group,page",
					"std" => 400,
					"min" => 100,
					"step" => 10,
					"type" => "spinner"),
		
		"googlemap_address" => array(
					"title" => __('Address to show on map',  'themerex'),
					"desc" => __("Enter address to show on map center", 'themerex'),
					"override" => "category,courses_group,page,post",
					"std" => "",
					"type" => "text"),
		
		"googlemap_latlng" => array(
					"title" => __('Latitude and Longtitude to show on map',  'themerex'),
					"desc" => __("Enter coordinates (separated by comma) to show on map center (instead of address)", 'themerex'),
					"override" => "category,courses_group,page,post",
					"std" => "",
					"type" => "text"),
		
		"googlemap_zoom" => array(
					"title" => __('Google map initial zoom',  'themerex'),
					"desc" => __("Enter desired initial zoom for Google map", 'themerex'),
					"override" => "category,courses_group,page,post",
					"std" => 16,
					"min" => 1,
					"max" => 20,
					"step" => 1,
					"type" => "spinner"),
		
		"googlemap_style" => array(
					"title" => __('Google map style',  'themerex'),
					"desc" => __("Select style to show Google map", 'themerex'),
					"override" => "category,courses_group,page,post",
					"std" => 'style1',
					"options" => $THEMEREX_GLOBALS['options_params']['list_gmap_styles'],
					"type" => "select"),
		
		"googlemap_marker" => array(
					"title" => __('Google map marker',  'themerex'),
					"desc" => __("Select or upload png-image with Google map marker", 'themerex'),
					"std" => '',
					"type" => "media"),
		
		
		
		
		// Customization -> Media
		//-------------------------------------------------
		
		'customization_media' => array(
					"title" => __('Media', 'themerex'),
					"override" => "category,courses_group,post,page",
					"icon" => 'iconadmin-picture',
					"type" => "tab"),
		
		"info_media_1" => array(
					"title" => __('Retina ready', 'themerex'),
					"desc" => __("Additional parameters for the Retina displays", 'themerex'),
					"type" => "info"),
					
		"retina_ready" => array(
					"title" => __('Image dimensions', 'themerex'),
					"desc" => __('What dimensions use for uploaded image: Original or "Retina ready" (twice enlarged)', 'themerex'),
					"divider" => false,
					"std" => "1",
					"size" => "medium",
					"options" => array("1"=>__("Original", 'themerex'), "2"=>__("Retina", 'themerex')),
					"type" => "switch"),
		
		"info_media_2" => array(
					"title" => __('Media Substitution parameters', 'themerex'),
					"desc" => __("Set up the media substitution parameters and slider's options", 'themerex'),
					"override" => "category,courses_group,page,post",
					"type" => "info"),
		
		"substitute_gallery" => array(
					"title" => __('Substitute standard Wordpress gallery', 'themerex'),
					"desc" => __('Substitute standard Wordpress gallery with our slider on the single pages', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,post,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"substitute_slider_engine" => array(
					"title" => __('Substitution Slider engine', 'themerex'),
					"desc" => __('What engine use to show slider instead standard gallery?', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "swiper",
					"options" => array(
						//"chop" => __("Chop slider", 'themerex'),
						"swiper" => __("Swiper slider", 'themerex')
					),
					"type" => "radio"),
		
		"gallery_instead_image" => array(
					"title" => __('Show gallery instead featured image', 'themerex'),
					"desc" => __('Show slider with gallery instead featured image on blog streampage and in the related posts section for the gallery posts', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"gallery_max_slides" => array(
					"title" => __('Max images number in the slider', 'themerex'),
					"desc" => __('Maximum images number from gallery into slider', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "5",
					"min" => 2,
					"max" => 10,
					"type" => "spinner"),
		
		"popup_engine" => array(
					"title" => __('Gallery popup engine', 'themerex'),
					"desc" => __('Select engine to show popup windows with galleries', 'themerex'),
					"std" => "magnific",
					"options" => $THEMEREX_GLOBALS['options_params']['list_popups'],
					"type" => "select"),
		
		"popup_gallery" => array(
					"title" => __('Enable Gallery mode in the popup', 'themerex'),
					"desc" => __('Enable Gallery mode in the popup or show only single image', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		"substitute_audio" => array(
					"title" => __('Substitute audio tags', 'themerex'),
					"desc" => __('Substitute audio tag with source from soundcloud to embed player', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"substitute_video" => array(
					"title" => __('Substitute video tags', 'themerex'),
					"desc" => __('Substitute video tags with embed players or leave video tags unchanged (if you use third party plugins for the video tags)', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"use_mediaelement" => array(
					"title" => __('Use Media Element script for audio and video tags', 'themerex'),
					"desc" => __('Do you want use the Media Element script for all audio and video tags on your site or leave standard HTML5 behaviour?', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		
		
		// Customization -> Typography
		//-------------------------------------------------
		
		'customization_typography' => array(
					"title" => __("Typography", 'themerex'),
					"icon" => 'iconadmin-font',
					"type" => "tab"),
		
		"info_typo_1" => array(
					"title" => __('Typography settings', 'themerex'),
					"desc" => __('Select fonts, sizes and styles for the headings and paragraphs. You can use Google fonts and custom fonts.<br><br>How to install custom @font-face fonts into the theme?<br>All @font-face fonts are located in "theme_name/css/font-face/" folder in the separate subfolders for the each font. Subfolder name is a font-family name!<br>Place full set of the font files (for each font style and weight) and css-file named stylesheet.css in the each subfolder.<br>Create your @font-face kit by using <a href="http://www.fontsquirrel.com/fontface/generator">Fontsquirrel @font-face Generator</a> and then extract the font kit (with folder in the kit) into the "theme_name/css/font-face" folder to install.', 'themerex'),
					"type" => "info"),
		
		"typography_custom" => array(
					"title" => __('Use custom typography', 'themerex'),
					"desc" => __('Use custom font settings or leave theme-styled fonts', 'themerex'),
					"divider" => false,
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"typography_h1_font" => array(
					"title" => __('Heading 1', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h1_size" => array(
					"title" => __('Size', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "48",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h1_lineheight" => array(
					"title" => __('Line height', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "60",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h1_weight" => array(
					"title" => __('Weight', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h1_style" => array(
					"title" => __('Style', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h1_color" => array(
					"title" => __('Color', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_h2_font" => array(
					"title" => __('Heading 2', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h2_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "36",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h2_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "43",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h2_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h2_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h2_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_h3_font" => array(
					"title" => __('Heading 3', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h3_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "24",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h3_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "28",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h3_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h3_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h3_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_h4_font" => array(
					"title" => __('Heading 4', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h4_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "20",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h4_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "24",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h4_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h4_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h4_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_h5_font" => array(
					"title" => __('Heading 5', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h5_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "18",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h5_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "20",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h5_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h5_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h5_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_h6_font" => array(
					"title" => __('Heading 6', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Signika",
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_h6_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "16",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_h6_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "18",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_h6_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "400",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_h6_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_h6_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		"typography_p_font" => array(
					"title" => __('Paragraph text', 'themerex'),
					"desc" => '',
					"divider" => false,
					"columns" => "3_8 first",
					"std" => "Source Sans Pro",
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts'],
					"type" => "fonts"),
		
		"typography_p_size" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "14",
					"step" => 1,
					"from" => 12,
					"to" => 60,
					"type" => "select"),
		
		"typography_p_lineheight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "21",
					"step" => 1,
					"from" => 12,
					"to" => 100,
					"type" => "select"),
		
		"typography_p_weight" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "300",
					"step" => 100,
					"from" => 100,
					"to" => 900,
					"type" => "select"),
		
		"typography_p_style" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8",
					"std" => "",
					"multiple" => true,
					"options" => $THEMEREX_GLOBALS['options_params']['list_fonts_styles'],
					"type" => "checklist"),
		
		"typography_p_color" => array(
					"title" => '',
					"desc" => '',
					"divider" => false,
					"columns" => "1_8 last",
					"std" => "#222222",
					"style" => "custom",
					"type" => "color"),
		
		
		
		
		
		
		
		
		
		
		
		
		//###############################
		//#### Blog and Single pages #### 
		//###############################
		"partition_blog" => array(
					"title" => __('Blog &amp; Single', 'themerex'),
					"icon" => "iconadmin-docs",
					"override" => "category,courses_group,post,page",
					"type" => "partition"),
		
		
		
		// Blog -> Stream page
		//-------------------------------------------------
		
		'blog_tab_stream' => array(
					"title" => __('Stream page', 'themerex'),
					"start" => 'blog_tabs',
					"icon" => "iconadmin-docs",
					"override" => "category,courses_group,post,page",
					"type" => "tab"),
		
		"info_blog_1" => array(
					"title" => __('Blog streampage parameters', 'themerex'),
					"desc" => __('Select desired blog streampage parameters (you can override it in each category)', 'themerex'),
					"override" => "category,courses_group,post,page",
					"type" => "info"),
		
		"blog_style" => array(
					"title" => __('Blog style', 'themerex'),
					"desc" => __('Select desired blog style', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,page",
					"std" => "excerpt",
					"options" => $THEMEREX_GLOBALS['options_params']['list_blog_styles'],
					"type" => "select"),
		
		"article_style" => array(
					"title" => __('Article style', 'themerex'),
					"desc" => __('Select article display method: boxed or stretch', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "stretch",
					"options" => $THEMEREX_GLOBALS['options_params']['list_article_styles'],
					"size" => "medium",
					"type" => "switch"),
		
		"hover_style" => array(
					"title" => __('Hover style', 'themerex'),
					"desc" => __('Select desired hover style (only for Blog style = Portfolio)', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "square effect_shift",
					"options" => $THEMEREX_GLOBALS['options_params']['list_hovers'],
					"type" => "select"),
		
		"hover_dir" => array(
					"title" => __('Hover dir', 'themerex'),
					"desc" => __('Select hover direction (only for Blog style = Portfolio and Hover style = Circle or Square)', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "left_to_right",
					"options" => $THEMEREX_GLOBALS['options_params']['list_hovers_dir'],
					"type" => "select"),
		
		"dedicated_location" => array(
					"title" => __('Dedicated location', 'themerex'),
					"desc" => __('Select location for the dedicated content or featured image in the "excerpt" blog style', 'themerex'),
					"override" => "category,courses_group,page,post",
					"std" => "default",
					"options" => $THEMEREX_GLOBALS['options_params']['list_locations'],
					"type" => "select"),
		
		"show_filters" => array(
					"title" => __('Show filters', 'themerex'),
					"desc" => __('Show filter buttons (only for Blog style = Portfolio, Masonry, Classic)', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "hide",
					"options" => $THEMEREX_GLOBALS['options_params']['list_filters'],
					"type" => "checklist"),
		
		"blog_sort" => array(
					"title" => __('Blog posts sorted by', 'themerex'),
					"desc" => __('Select the desired sorting method for posts', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "date",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sorting'],
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_order" => array(
					"title" => __('Blog posts order', 'themerex'),
					"desc" => __('Select the desired ordering method for posts', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "desc",
					"options" => $THEMEREX_GLOBALS['options_params']['list_ordering'],
					"size" => "big",
					"type" => "switch"),
		
		"posts_per_page" => array(
					"title" => __('Blog posts per page',  'themerex'),
					"desc" => __('How many posts display on blog pages for selected style. If empty or 0 - inherit system wordpress settings',  'themerex'),
					"override" => "category,courses_group,page",
					"std" => "12",
					"mask" => "?99",
					"type" => "text"),
		
		"post_excerpt_maxlength" => array(
					"title" => __('Excerpt maxlength for streampage',  'themerex'),
					"desc" => __('How many characters from post excerpt are display in blog streampage (only for Blog style = Excerpt). 0 - do not trim excerpt.',  'themerex'),
					"override" => "category,courses_group,page",
					"std" => "250",
					"mask" => "?9999",
					"type" => "text"),
		
		"post_excerpt_maxlength_masonry" => array(
					"title" => __('Excerpt maxlength for classic and masonry',  'themerex'),
					"desc" => __('How many characters from post excerpt are display in blog streampage (only for Blog style = Classic or Masonry). 0 - do not trim excerpt.',  'themerex'),
					"override" => "category,courses_group,page",
					"std" => "150",
					"mask" => "?9999",
					"type" => "text"),
		
		
		
		
		// Blog -> Single page
		//-------------------------------------------------
		
		'blog_tab_single' => array(
					"title" => __('Single page', 'themerex'),
					"icon" => "iconadmin-doc",
					"override" => "category,courses_group,post,page",
					"type" => "tab"),
		
		
		"info_blog_2" => array(
					"title" => __('Single (detail) pages parameters', 'themerex'),
					"desc" => __('Select desired parameters for single (detail) pages (you can override it in each category and single post (page))', 'themerex'),
					"override" => "category,courses_group,post,page",
					"type" => "info"),
		
		"single_style" => array(
					"title" => __('Single page style', 'themerex'),
					"desc" => __('Select desired style for single page', 'themerex'),
					"divider" => false,
					"override" => "category,courses_group,page,post",
					"std" => "single-standard",
					"options" => $THEMEREX_GLOBALS['options_params']['list_single_styles'],
					"dir" => "horizontal",
					"type" => "radio"),
		
		"allow_editor" => array(
					"title" => __('Frontend editor',  'themerex'),
					"desc" => __("Allow authors to edit their posts in frontend area)", 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_featured_image" => array(
					"title" => __('Show featured image before post',  'themerex'),
					"desc" => __("Show featured image (if selected) before post content on single pages", 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_title" => array(
					"title" => __('Show post title', 'themerex'),
					"desc" => __('Show area with post title on single pages', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_title_on_quotes" => array(
					"title" => __('Show post title on links, chat, quote, status', 'themerex'),
					"desc" => __('Show area with post title on single and blog pages in specific post formats: links, chat, quote, status', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_info" => array(
					"title" => __('Show post info', 'themerex'),
					"desc" => __('Show area with post info on single pages', 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_text_before_readmore" => array(
					"title" => __('Show text before "Read more" tag', 'themerex'),
					"desc" => __('Show text before "Read more" tag on single pages', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
					
		"show_post_author" => array(
					"title" => __('Show post author details',  'themerex'),
					"desc" => __("Show post author information block on single post page", 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_tags" => array(
					"title" => __('Show post tags',  'themerex'),
					"desc" => __("Show tags block on single post page", 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"show_post_related" => array(
					"title" => __('Show related posts',  'themerex'),
					"desc" => __("Show related posts block on single post page", 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"post_related_count" => array(
					"title" => __('Related posts number',  'themerex'),
					"desc" => __("How many related posts showed on single post page", 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "2",
					"step" => 1,
					"min" => 2,
					"max" => 8,
					"type" => "spinner"),

		"post_related_columns" => array(
					"title" => __('Related posts columns',  'themerex'),
					"desc" => __("How many columns used to show related posts on single post page. 1 - use scrolling to show all related posts", 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "2",
					"step" => 1,
					"min" => 1,
					"max" => 4,
					"type" => "spinner"),
		
		"post_related_sort" => array(
					"title" => __('Related posts sorted by', 'themerex'),
					"desc" => __('Select the desired sorting method for related posts', 'themerex'),
		//			"override" => "category,courses_group,page",
					"std" => "date",
					"options" => $THEMEREX_GLOBALS['options_params']['list_sorting'],
					"type" => "select"),
		
		"post_related_order" => array(
					"title" => __('Related posts order', 'themerex'),
					"desc" => __('Select the desired ordering method for related posts', 'themerex'),
		//			"override" => "category,courses_group,page",
					"std" => "desc",
					"options" => $THEMEREX_GLOBALS['options_params']['list_ordering'],
					"size" => "big",
					"type" => "switch"),
		
		"show_post_comments" => array(
					"title" => __('Show comments',  'themerex'),
					"desc" => __("Show comments block on single post page", 'themerex'),
					"override" => "category,courses_group,post,page",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		// Blog -> Other parameters
		//-------------------------------------------------
		
		'blog_tab_general' => array(
					"title" => __('Other parameters', 'themerex'),
					"icon" => "iconadmin-newspaper",
					"override" => "category,courses_group,page",
					"type" => "tab"),
		
		"info_blog_3" => array(
					"title" => __('Other Blog parameters', 'themerex'),
					"desc" => __('Select excluded categories, substitute parameters, etc.', 'themerex'),
					"type" => "info"),
		
		"exclude_cats" => array(
					"title" => __('Exclude categories', 'themerex'),
					"desc" => __('Select categories, which posts are exclude from blog page', 'themerex'),
					"divider" => false,
					"std" => "",
					"options" => $THEMEREX_GLOBALS['options_params']['list_categories'],
					"multiple" => true,
					"style" => "list",
					"type" => "select"),
		
		"blog_pagination" => array(
					"title" => __('Blog pagination', 'themerex'),
					"desc" => __('Select type of the pagination on blog streampages', 'themerex'),
					"std" => "pages",
					"override" => "category,courses_group,page",
					"options" => array(
						'pages'    => __('Standard page numbers', 'themerex'),
						'viewmore' => __('"View more" button', 'themerex'),
						'infinite' => __('Infinite scroll', 'themerex')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_pagination_style" => array(
					"title" => __('Blog pagination style', 'themerex'),
					"desc" => __('Select pagination style for standard page numbers', 'themerex'),
					"std" => "pages",
					"override" => "category,courses_group,page",
					"options" => array(
						'pages'  => __('Page numbers list', 'themerex'),
						'slider' => __('Slider with page numbers', 'themerex')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"blog_counters" => array(
					"title" => __('Blog counters', 'themerex'),
					"desc" => __('Select counters, displayed near the post title', 'themerex'),
					"std" => "views",
					"override" => "category,courses_group,page",
					"options" => array(
						'views' => __('Views', 'themerex'),
						'likes' => __('Likes', 'themerex'),
						'rating' => __('Rating', 'themerex'),
						'comments' => __('Comments', 'themerex')
					),
					"dir" => "vertical",
					"multiple" => true,
					"type" => "checklist"),
		
		"close_category" => array(
					"title" => __("Post's category announce", 'themerex'),
					"desc" => __('What category display in announce block (over posts thumb) - original or nearest parental', 'themerex'),
					"std" => "parental",
					"override" => "category,courses_group,page",
					"options" => array(
						'parental' => __('Nearest parental category', 'themerex'),
						'original' => __("Original post's category", 'themerex')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"show_date_after" => array(
					"title" => __('Show post date after', 'themerex'),
					"desc" => __('Show post date after N days (before - show post age)', 'themerex'),
					"override" => "category,courses_group,page",
					"std" => "30",
					"mask" => "?99",
					"type" => "text"),
		
		
		
		
		
		//###############################
		//#### Reviews               #### 
		//###############################
		"partition_reviews" => array(
					"title" => __('Reviews', 'themerex'),
					"icon" => "iconadmin-newspaper",
					"override" => "category,courses_group",
					"type" => "partition"),
		
		"info_reviews_1" => array(
					"title" => __('Reviews criterias', 'themerex'),
					"desc" => __('Set up list of reviews criterias. You can override it in any category.', 'themerex'),
					"override" => "category,courses_group",
					"type" => "info"),
		
		"show_reviews" => array(
					"title" => __('Show reviews block',  'themerex'),
					"desc" => __("Show reviews block on single post page and average reviews rating after post's title in stream pages", 'themerex'),
					"divider" => false,
					"override" => "category,courses_group",
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"reviews_max_level" => array(
					"title" => __('Max reviews level',  'themerex'),
					"desc" => __("Maximum level for reviews marks", 'themerex'),
					"std" => "5",
					"options" => array(
						'5'=>__('5 stars', 'themerex'), 
						'10'=>__('10 stars', 'themerex'), 
						'100'=>__('100%', 'themerex')
					),
					"type" => "radio",
					),
		
		"reviews_style" => array(
					"title" => __('Show rating as',  'themerex'),
					"desc" => __("Show rating marks as text or as stars/progress bars.", 'themerex'),
					"std" => "stars",
					"options" => array(
						'text' => __('As text (for example: 7.5 / 10)', 'themerex'), 
						'stars' => __('As stars or bars', 'themerex')
					),
					"dir" => "vertical",
					"type" => "radio"),
		
		"reviews_criterias_levels" => array(
					"title" => __('Reviews Criterias Levels', 'themerex'),
					"desc" => __('Words to mark criterials levels. Just write the word and press "Enter". Also you can arrange words.', 'themerex'),
					"std" => __("bad,poor,normal,good,great", 'themerex'),
					"type" => "tags"),
		
		"reviews_first" => array(
					"title" => __('Show first reviews',  'themerex'),
					"desc" => __("What reviews will be displayed first: by author or by visitors. Also this type of reviews will display under post's title.", 'themerex'),
					"std" => "author",
					"options" => array(
						'author' => __('By author', 'themerex'),
						'users' => __('By visitors', 'themerex')
						),
					"dir" => "horizontal",
					"type" => "radio"),
		
		"reviews_second" => array(
					"title" => __('Hide second reviews',  'themerex'),
					"desc" => __("Do you want hide second reviews tab in widgets and single posts?", 'themerex'),
					"std" => "show",
					"options" => $THEMEREX_GLOBALS['options_params']['list_show_hide'],
					"size" => "medium",
					"type" => "switch"),
		
		"reviews_can_vote" => array(
					"title" => __('What visitors can vote',  'themerex'),
					"desc" => __("What visitors can vote: all or only registered", 'themerex'),
					"std" => "all",
					"options" => array(
						'all'=>__('All visitors', 'themerex'), 
						'registered'=>__('Only registered', 'themerex')
					),
					"dir" => "horizontal",
					"type" => "radio"),
		
		"reviews_criterias" => array(
					"title" => __('Reviews criterias',  'themerex'),
					"desc" => __('Add default reviews criterias.',  'themerex'),
					"override" => "category,courses_group",
					"std" => "",
					"cloneable" => true,
					"type" => "text"),

		"reviews_marks" => array(
					"std" => "",
					"type" => "hidden"),
		
		
		
		
		
		//###############################
		//#### Contact info          #### 
		//###############################
		"partition_contacts" => array(
					"title" => __('Contact info', 'themerex'),
					"icon" => "iconadmin-mail-1",
					"type" => "partition"),
		
		"info_contact_1" => array(
					"title" => __('Contact information', 'themerex'),
					"desc" => __('Company address, phones and e-mail', 'themerex'),
					"type" => "info"),
		
		"contact_email" => array(
					"title" => __('Contact form email', 'themerex'),
					"desc" => __('E-mail for send contact form and user registration data', 'themerex'),
					"divider" => false,
					"std" => "",
					"before" => array('icon'=>'iconadmin-mail-1'),
					"type" => "text"),
		
		"contact_address_1" => array(
					"title" => __('Company address (part 1)', 'themerex'),
					"desc" => __('Company country, post code and city', 'themerex'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		
		"contact_address_2" => array(
					"title" => __('Company address (part 2)', 'themerex'),
					"desc" => __('Street and house number', 'themerex'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		
		"contact_phone" => array(
					"title" => __('Phone', 'themerex'),
					"desc" => __('Phone number', 'themerex'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"type" => "text"),
		
		"contact_fax" => array(
					"title" => __('Fax', 'themerex'),
					"desc" => __('Fax number', 'themerex'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-phone'),
					"type" => "text"),
		
		"contact_info" => array(
					"title" => __('Contacts in header', 'themerex'),
					"desc" => __('String with contact info in the site header', 'themerex'),
					"std" => "",
					"before" => array('icon'=>'iconadmin-home'),
					"type" => "text"),
		
		"info_contact_2" => array(
					"title" => __('Contact and Comments form', 'themerex'),
					"desc" => __('Maximum length of the messages in the contact form shortcode and in the comments form', 'themerex'),
					"type" => "info"),
		
		"message_maxlength_contacts" => array(
					"title" => __('Contact form message', 'themerex'),
					"desc" => __("Message's maxlength in the contact form shortcode", 'themerex'),
					"std" => "1000",
					"min" => 0,
					"max" => 10000,
					"step" => 100,
					"type" => "spinner"),
		
		"message_maxlength_comments" => array(
					"title" => __('Comments form message', 'themerex'),
					"desc" => __("Message's maxlength in the comments form", 'themerex'),
					"std" => "1000",
					"min" => 0,
					"max" => 10000,
					"step" => 100,
					"type" => "spinner"),
		
		"info_contact_3" => array(
					"title" => __('Default mail function', 'themerex'),
					"desc" => __('What function you want to use for sending mail: the built-in Wordpress wp_mail() or standard PHP mail() function? Attention! Some plugins may not work with one of them and you always have the ability to switch to alternative.', 'themerex'),
					"type" => "info"),
		
		"mail_function" => array(
					"title" => __("Mail function", 'themerex'),
					"desc" => __("What function you want to use for sending mail?", 'themerex'),
					"std" => "wp_mail",
					"size" => "medium",
					"options" => array(
						'wp_mail' => __('WP mail', 'themerex'),
						'mail' => __('PHP mail', 'themerex')
					),
					"type" => "switch"),
		
		
		
		
		//###############################
		//#### Socials               #### 
		//###############################
		"partition_socials" => array(
					"title" => __('Socials', 'themerex'),
					"icon" => "iconadmin-users-1",
					"override" => "category,courses_group,page",
					"type" => "partition"),
		
		"info_socials_1" => array(
					"title" => __('Social networks', 'themerex'),
					"desc" => __("Social networks list for site footer and Social widget", 'themerex'),
					"type" => "info"),
		
		"social_icons" => array(
					"title" => __('Social networks',  'themerex'),
					"desc" => __('Select icon and write URL to your profile in desired social networks.',  'themerex'),
					"divider" => false,
					"std" => array(array('url'=>'', 'icon'=>'')),
					"options" => $THEMEREX_GLOBALS['options_params']['list_socials'],
					"cloneable" => true,
					"size" => "small",
					"style" => 'images',
					"type" => "socials"),
		
		"info_socials_2" => array(
					"title" => __('Share buttons', 'themerex'),
					"override" => "category,courses_group,page",
					"desc" => __("Add button's code for each social share network.<br>
					In share url you can use next macro:<br>
					<b>{url}</b> - share post (page) URL,<br>
					<b>{title}</b> - post title,<br>
					<b>{image}</b> - post image,<br>
					<b>{descr}</b> - post description (if supported)<br>
					For example:<br>
					<b>Facebook</b> share string: <em>http://www.facebook.com/sharer.php?u={link}&amp;t={title}</em><br>
					<b>Delicious</b> share string: <em>http://delicious.com/save?url={link}&amp;title={title}&amp;note={descr}</em>", 'themerex'),
					"type" => "info"),
		
		"show_share" => array(
					"title" => __('Show social share buttons',  'themerex'),
					"override" => "category,courses_group,page",
					"desc" => __("Show social share buttons block", 'themerex'),
					"std" => "horizontal",
					"options" => array(
						'hide'		=> __('Hide', 'themerex'),
						'vertical'	=> __('Vertical', 'themerex'),
						'horizontal'=> __('Horizontal', 'themerex')
					),
					"type" => "checklist"),

		"show_share_counters" => array(
					"title" => __('Show share counters',  'themerex'),
					"override" => "category,courses_group,page",
					"desc" => __("Show share counters after social buttons", 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"share_caption" => array(
					"title" => __('Share block caption',  'themerex'),
					"override" => "category,courses_group,page",
					"desc" => __('Caption for the block with social share buttons',  'themerex'),
					"std" => __('Share:', 'themerex'),
					"type" => "text"),
		
		"share_buttons" => array(
					"title" => __('Share buttons',  'themerex'),
					"desc" => __('Select icon and write share URL for desired social networks.<br><b>Important!</b> If you leave text field empty - internal theme link will be used (if present).',  'themerex'),
					"std" => array(array('url'=>'', 'icon'=>'')),
					"options" => $THEMEREX_GLOBALS['options_params']['list_socials'],
					"cloneable" => true,
					"size" => "small",
					"style" => 'images',
					"type" => "socials"),
		
		
		"info_socials_3" => array(
					"title" => __('Twitter API keys', 'themerex'),
					"desc" => __("Put to this section Twitter API 1.1 keys.<br>
					You can take them after registration your application in <strong>https://apps.twitter.com/</strong>", 'themerex'),
					"type" => "info"),
		
		"twitter_username" => array(
					"title" => __('Twitter username',  'themerex'),
					"desc" => __('Your login (username) in Twitter',  'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_consumer_key" => array(
					"title" => __('Consumer Key',  'themerex'),
					"desc" => __('Twitter API Consumer key',  'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_consumer_secret" => array(
					"title" => __('Consumer Secret',  'themerex'),
					"desc" => __('Twitter API Consumer secret',  'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_token_key" => array(
					"title" => __('Token Key',  'themerex'),
					"desc" => __('Twitter API Token key',  'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		"twitter_token_secret" => array(
					"title" => __('Token Secret',  'themerex'),
					"desc" => __('Twitter API Token secret',  'themerex'),
					"divider" => false,
					"std" => "",
					"type" => "text"),
		
		
		
		
		
		
		
		//###############################
		//#### Search parameters     #### 
		//###############################
		"partition_search" => array(
					"title" => __('Search', 'themerex'),
					"icon" => "iconadmin-search-1",
					"type" => "partition"),
		
		"info_search_1" => array(
					"title" => __('Search parameters', 'themerex'),
					"desc" => __('Enable/disable AJAX search and output settings for it', 'themerex'),
					"type" => "info"),
		
		"show_search" => array(
					"title" => __('Show search field', 'themerex'),
					"desc" => __('Show search field in the top area and side menus', 'themerex'),
					"divider" => false,
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"use_ajax_search" => array(
					"title" => __('Enable AJAX search', 'themerex'),
					"desc" => __('Use incremental AJAX search for the search field in top of page', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_min_length" => array(
					"title" => __('Min search string length',  'themerex'),
					"desc" => __('The minimum length of the search string',  'themerex'),
					"std" => 4,
					"min" => 3,
					"type" => "spinner"),
		
		"ajax_search_delay" => array(
					"title" => __('Delay before search (in ms)',  'themerex'),
					"desc" => __('How much time (in milliseconds, 1000 ms = 1 second) must pass after the last character before the start search',  'themerex'),
					"std" => 500,
					"min" => 300,
					"max" => 1000,
					"step" => 100,
					"type" => "spinner"),
		
		"ajax_search_types" => array(
					"title" => __('Search area', 'themerex'),
					"desc" => __('Select post types, what will be include in search results. If not selected - use all types.', 'themerex'),
					"std" => "",
					"options" => $THEMEREX_GLOBALS['options_params']['list_posts_types'],
					"multiple" => true,
					"style" => "list",
					"type" => "select"),
		
		"ajax_search_posts_count" => array(
					"title" => __('Posts number in output',  'themerex'),
					"desc" => __('Number of the posts to show in search results',  'themerex'),
					"std" => 5,
					"min" => 1,
					"max" => 10,
					"type" => "spinner"),
		
		"ajax_search_posts_image" => array(
					"title" => __("Show post's image", 'themerex'),
					"desc" => __("Show post's thumbnail in the search results", 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_posts_date" => array(
					"title" => __("Show post's date", 'themerex'),
					"desc" => __("Show post's publish date in the search results", 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_posts_author" => array(
					"title" => __("Show post's author", 'themerex'),
					"desc" => __("Show post's author in the search results", 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"ajax_search_posts_counters" => array(
					"title" => __("Show post's counters", 'themerex'),
					"desc" => __("Show post's counters (views, comments, likes) in the search results", 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		
		
		
		
		//###############################
		//#### Service               #### 
		//###############################
		
		"partition_service" => array(
					"title" => __('Service', 'themerex'),
					"icon" => "iconadmin-wrench",
					"type" => "partition"),
		
		"info_service_1" => array(
					"title" => __('Theme functionality', 'themerex'),
					"desc" => __('Basic theme functionality settings', 'themerex'),
					"type" => "info"),
		
		"notify_about_new_registration" => array(
					"title" => __('Notify about new registration', 'themerex'),
					"desc" => __('Send E-mail with new registration data to the contact email or to site admin e-mail (if contact email is empty)', 'themerex'),
					"divider" => false,
					"std" => "no",
					"options" => array(
						'no'    => __('No', 'themerex'),
						'both'  => __('Both', 'themerex'),
						'admin' => __('Admin', 'themerex'),
						'user'  => __('User', 'themerex')
					),
					"dir" => "horizontal",
					"type" => "checklist"),
		
		"use_ajax_views_counter" => array(
					"title" => __('Use AJAX post views counter', 'themerex'),
					"desc" => __('Use javascript for post views count (if site work under the caching plugin) or increment views count in single page template', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"admin_add_filters" => array(
					"title" => __('Additional filters in the admin panel', 'themerex'),
					"desc" => __('Show additional filters (on post formats, tags and categories) in admin panel page "Posts". <br>Attention! If you have more than 2.000-3.000 posts, enabling this option may cause slow load of the "Posts" page! If you encounter such slow down, simply open Appearance - Theme Options - Service and set "No" for this option.', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"show_overriden_taxonomies" => array(
					"title" => __('Show overriden options for taxonomies', 'themerex'),
					"desc" => __('Show extra column in categories list, where changed (overriden) theme options are displayed.', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"show_overriden_posts" => array(
					"title" => __('Show overriden options for posts and pages', 'themerex'),
					"desc" => __('Show extra column in posts and pages list, where changed (overriden) theme options are displayed.', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"admin_dummy_data" => array(
					"title" => __('Enable Dummy Data Installer', 'themerex'),
					"desc" => __('Show "Install Dummy Data" in the menu "Appearance". <b>Attention!</b> When you install dummy data all content of your site will be replaced!', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"admin_dummy_timeout" => array(
					"title" => __('Dummy Data Installer Timeout',  'themerex'),
					"desc" => __('Web-servers set the time limit for the execution of php-scripts. By default, this is 30 sec. Therefore, the import process will be split into parts. Upon completion of each part - the import will resume automatically! The import process will try to increase this limit to the time, specified in this field.',  'themerex'),
					"std" => 1200,
					"min" => 30,
					"max" => 1800,
					"type" => "spinner"),
		
		"admin_update_notifier" => array(
					"title" => __('Enable Update Notifier', 'themerex'),
					"desc" => __('Show update notifier in admin panel. <b>Attention!</b> When this option is enabled, the theme periodically (every few hours) will communicate with our server, to check the current version. When the connection is slow, it may slow down Dashboard.', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"admin_emailer" => array(
					"title" => __('Enable Emailer in the admin panel', 'themerex'),
					"desc" => __('Allow to use ThemeREX Emailer for mass-volume e-mail distribution and management of mailing lists in "Appearance - Emailer"', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"admin_po_composer" => array(
					"title" => __('Enable PO Composer in the admin panel', 'themerex'),
					"desc" => __('Allow to use "PO Composer" for edit language files in this theme (in the "Appearance - PO Composer")', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),

		"clear_shortcodes" => array(
					"title" => __('Remove line breaks around shortcodes', 'themerex'),
					"desc" => __('Do you want remove spaces and line breaks around shortcodes? <b>Be attentive!</b> This option thoroughly tested on our theme, but may affect third party plugins.', 'themerex'),
					"std" => "yes",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"debug_mode" => array(
					"title" => __('Debug mode', 'themerex'),
					"desc" => __('In debug mode we are using unpacked scripts and styles, else - using minified scripts and styles (if present). <b>Attention!</b> If you have modified the source code in the js or css files, regardless of this option will be used latest (modified) version stylesheets and scripts. You can re-create minified versions of files using on-line services (for example <a href="http://yui.2clics.net/" target="_blank">http://yui.2clics.net/</a>) or utility <b>yuicompressor-x.y.z.jar</b>', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"packed_scripts" => array(
					"title" => __('Use packed css and js files', 'themerex'),
					"desc" => __('Do you want to use one packed css and one js file with most theme scripts and styles instead many separate files (for speed up page loading). This reduces the number of HTTP requests when loading pages.', 'themerex'),
					"std" => "no",
					"options" => $THEMEREX_GLOBALS['options_params']['list_yes_no'],
					"type" => "switch"),
		
		"gtm_code" => array(
					"title" => __('Google tags manager or Google analitics code',  'themerex'),
					"desc" => __('Put here Google Tags Manager (GTM) code from your account: Google analitics, remarketing, etc. This code will be placed after open body tag.',  'themerex'),
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"),
		
		"gtm_code2" => array(
					"title" => __('Google remarketing code',  'themerex'),
					"desc" => __('Put here Google Remarketing code from your account. This code will be placed before close body tag.',  'themerex'),
					"divider" => false,
					"cols" => 80,
					"rows" => 20,
					"std" => "",
					"type" => "textarea"),
		
		
		"info_service_2" => array(
					"title" => __('Clear Wordpress cache', 'themerex'),
					"desc" => __('For example, it recommended after activating the WPML plugin - in the cache are incorrect data about the structure of categories and your site may display "white screen". After clearing the cache usually the performance of the site is restored.', 'themerex'),
					"type" => "info"),
		
		"clear_cache" => array(
					"title" => __('Clear cache', 'themerex'),
					"desc" => __('Clear Wordpress cache data', 'themerex'),
					"divider" => false,
					"icon" => "iconadmin-trash-1",
					"action" => "clear_cache",
					"type" => "button")
		);


		
		
		
		//###############################################
		//#### Hidden fields (for internal use only) #### 
		//###############################################
		/*
		$THEMEREX_GLOBALS['options']["custom_stylesheet_file"] = array(
			"title" => __('Custom stylesheet file', 'themerex'),
			"desc" => __('Path to the custom stylesheet (stored in the uploads folder)', 'themerex'),
			"std" => "",
			"type" => "hidden");
		
		$THEMEREX_GLOBALS['options']["custom_stylesheet_url"] = array(
			"title" => __('Custom stylesheet url', 'themerex'),
			"desc" => __('URL to the custom stylesheet (stored in the uploads folder)', 'themerex'),
			"std" => "",
			"type" => "hidden");
		*/

	}
}
?>