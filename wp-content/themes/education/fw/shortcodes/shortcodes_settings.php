<?php

// Check if shortcodes settings are now used
if ( !function_exists( 'themerex_shortcodes_is_used' ) ) {
	function themerex_shortcodes_is_used() {
		return themerex_options_is_used() 															// All modes when Theme Options are used
			|| (is_admin() && isset($_POST['action']) 
					&& in_array($_POST['action'], array('vc_edit_form', 'wpb_show_edit_form')))		// AJAX query when save post/page
			|| themerex_vc_is_frontend();															// VC Frontend editor mode
	}
}

// Width and height params
if ( !function_exists( 'themerex_shortcodes_width' ) ) {
	function themerex_shortcodes_width($w="") {
		return array(
			"title" => __("Width", "themerex"),
			"divider" => true,
			"value" => $w,
			"type" => "text"
		);
	}
}
if ( !function_exists( 'themerex_shortcodes_height' ) ) {
	function themerex_shortcodes_height($h='') {
		return array(
			"title" => __("Height", "themerex"),
			"desc" => __("Width (in pixels or percent) and height (only in pixels) of element", "themerex"),
			"value" => $h,
			"type" => "text"
		);
	}
}

/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_shortcodes_settings_theme_setup' ) ) {
//	if ( themerex_vc_is_frontend() )
	if ( (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true') || (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline') )
		add_action( 'themerex_action_before_init_theme', 'themerex_shortcodes_settings_theme_setup', 20 );
	else
		add_action( 'themerex_action_after_init_theme', 'themerex_shortcodes_settings_theme_setup' );
	function themerex_shortcodes_settings_theme_setup() {
		if (themerex_shortcodes_is_used()) {
			global $THEMEREX_GLOBALS;

			// Prepare arrays 
			$THEMEREX_GLOBALS['sc_params'] = array(
			
				// Current element id
				'id' => array(
					"title" => __("Element ID", "themerex"),
					"desc" => __("ID for current element", "themerex"),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
			
				// Current element class
				'class' => array(
					"title" => __("Element CSS class", "themerex"),
					"desc" => __("CSS class for current element (optional)", "themerex"),
					"value" => "",
					"type" => "text"
				),
			
				// Current element style
				'css' => array(
					"title" => __("CSS styles", "themerex"),
					"desc" => __("Any additional CSS rules (if need)", "themerex"),
					"value" => "",
					"type" => "text"
				),
			
				// Margins params
				'top' => array(
					"title" => __("Top margin", "themerex"),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
			
				'bottom' => array(
					"title" => __("Bottom margin", "themerex"),
					"value" => "",
					"type" => "text"
				),
			
				'left' => array(
					"title" => __("Left margin", "themerex"),
					"value" => "",
					"type" => "text"
				),
			
				'right' => array(
					"title" => __("Right margin", "themerex"),
					"desc" => __("Margins around list (in pixels).", "themerex"),
					"value" => "",
					"type" => "text"
				),
			
				// Switcher choises
				'list_styles' => array(
					'ul'	=> __('Unordered', 'themerex'),
					'ol'	=> __('Ordered', 'themerex'),
					'iconed'=> __('Iconed', 'themerex')
				),
				'yes_no'	=> themerex_get_list_yesno(),
				'on_off'	=> themerex_get_list_onoff(),
				'dir' 		=> themerex_get_list_directions(),
				'align'		=> themerex_get_list_alignments(),
				'float'		=> themerex_get_list_floats(),
				'show_hide'	=> themerex_get_list_showhide(),
				'sorting' 	=> themerex_get_list_sortings(),
				'ordering' 	=> themerex_get_list_orderings(),
				'sliders'	=> themerex_get_list_sliders(),
				'users'		=> themerex_get_list_users(),
				'members'	=> themerex_get_list_posts(false, array('post_type'=>'team', 'orderby'=>'title', 'order'=>'asc', 'return'=>'title')),
				'categories'=> themerex_get_list_categories(),
				'testimonials_groups'=> themerex_get_list_terms(false, 'testimonial_group'),
				'team_groups'=> themerex_get_list_terms(false, 'team_group'),
				'columns'	=> themerex_get_list_columns(),
				'images'	=> array_merge(array('none'=>"none"), themerex_get_list_files("images/icons", "png")),
				'icons'		=> array_merge(array("inherit", "none"), themerex_get_list_icons()),
				'locations'	=> themerex_get_list_dedicated_locations(),
				'filters'	=> themerex_get_list_portfolio_filters(),
				'formats'	=> themerex_get_list_post_formats_filters(),
				'hovers'	=> themerex_get_list_hovers(),
				'hovers_dir'=> themerex_get_list_hovers_directions(),
				'tint'		=> themerex_get_list_bg_tints(),
				'animations'=> themerex_get_list_animations_in(),
				'blogger_styles'	=> themerex_get_list_templates_blogger(),
				'posts_types'		=> themerex_get_list_posts_types(),
				'button_styles'		=> themerex_get_list_button_styles(),
				'googlemap_styles'	=> themerex_get_list_googlemap_styles(),
				'field_types'		=> themerex_get_list_field_types(),
				'label_positions'	=> themerex_get_list_label_positions()
			);

			$THEMEREX_GLOBALS['sc_params']['animation'] = array(
				"title" => __("Animation",  'themerex'),
				"desc" => __('Select animation while object enter in the visible area of page',  'themerex'),
				"value" => "none",
				"type" => "select",
				"options" => $THEMEREX_GLOBALS['sc_params']['animations']
			);
	
			// Shortcodes list
			//------------------------------------------------------------------
			$THEMEREX_GLOBALS['shortcodes'] = array(
			
				// Accordion
				"trx_accordion" => array(
					"title" => __("Accordion", "themerex"),
					"desc" => __("Accordion items", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Accordion style", "themerex"),
							"desc" => __("Select style for display accordion", "themerex"),
							"value" => 1,
							"options" => array(
								1 => __('Style 1', 'themerex'),
								2 => __('Style 2', 'themerex')
							),
							"type" => "radio"
						),
						"counter" => array(
							"title" => __("Counter", "themerex"),
							"desc" => __("Display counter before each accordion title", "themerex"),
							"value" => "off",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['on_off']
						),
						"initial" => array(
							"title" => __("Initially opened item", "themerex"),
							"desc" => __("Number of initially opened item", "themerex"),
							"value" => 1,
							"min" => 0,
							"type" => "spinner"
						),
						"icon_closed" => array(
							"title" => __("Icon while closed",  'themerex'),
							"desc" => __('Select icon for the closed accordion item from Fontello icons set',  'themerex'),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"icon_opened" => array(
							"title" => __("Icon while opened",  'themerex'),
							"desc" => __('Select icon for the opened accordion item from Fontello icons set',  'themerex'),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_accordion_item",
						"title" => __("Item", "themerex"),
						"desc" => __("Accordion item", "themerex"),
						"container" => true,
						"params" => array(
							"title" => array(
								"title" => __("Accordion item title", "themerex"),
								"desc" => __("Title for current accordion item", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"icon_closed" => array(
								"title" => __("Icon while closed",  'themerex'),
								"desc" => __('Select icon for the closed accordion item from Fontello icons set',  'themerex'),
								"value" => "",
								"type" => "icons",
								"options" => $THEMEREX_GLOBALS['sc_params']['icons']
							),
							"icon_opened" => array(
								"title" => __("Icon while opened",  'themerex'),
								"desc" => __('Select icon for the opened accordion item from Fontello icons set',  'themerex'),
								"value" => "",
								"type" => "icons",
								"options" => $THEMEREX_GLOBALS['sc_params']['icons']
							),
							"_content_" => array(
								"title" => __("Accordion item content", "themerex"),
								"desc" => __("Current accordion item content", "themerex"),
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Anchor
				"trx_anchor" => array(
					"title" => __("Anchor", "themerex"),
					"desc" => __("Insert anchor for the TOC (table of content)", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"icon" => array(
							"title" => __("Anchor's icon",  'themerex'),
							"desc" => __('Select icon for the anchor from Fontello icons set',  'themerex'),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"title" => array(
							"title" => __("Short title", "themerex"),
							"desc" => __("Short title of the anchor (for the table of content)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"description" => array(
							"title" => __("Long description", "themerex"),
							"desc" => __("Description for the popup (then hover on the icon). You can use '{' and '}' - make the text italic, '|' - insert line break", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"url" => array(
							"title" => __("External URL", "themerex"),
							"desc" => __("External URL for this TOC item", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"separator" => array(
							"title" => __("Add separator", "themerex"),
							"desc" => __("Add separator under item in the TOC", "themerex"),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"id" => $THEMEREX_GLOBALS['sc_params']['id']
					)
				),
			
			
				// Audio
				"trx_audio" => array(
					"title" => __("Audio", "themerex"),
					"desc" => __("Insert audio player", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"url" => array(
							"title" => __("URL for audio file", "themerex"),
							"desc" => __("URL for audio file", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media",
							"before" => array(
								'title' => __('Choose audio', 'themerex'),
								'action' => 'media_upload',
								'type' => 'audio',
								'multiple' => false,
								'linked_field' => '',
								'captions' => array( 	
									'choose' => __('Choose audio file', 'themerex'),
									'update' => __('Select audio file', 'themerex')
								)
							),
							"after" => array(
								'icon' => 'icon-cancel',
								'action' => 'media_reset'
							)
						),
						"image" => array(
							"title" => __("Cover image", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for audio cover", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"title" => array(
							"title" => __("Title", "themerex"),
							"desc" => __("Title of the audio file", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"author" => array(
							"title" => __("Author", "themerex"),
							"desc" => __("Author of the audio file", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"controls" => array(
							"title" => __("Show controls", "themerex"),
							"desc" => __("Show controls in audio player", "themerex"),
							"divider" => true,
							"size" => "medium",
							"value" => "show",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['show_hide']
						),
						"autoplay" => array(
							"title" => __("Autoplay audio", "themerex"),
							"desc" => __("Autoplay audio on page load", "themerex"),
							"value" => "off",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['on_off']
						),
						"align" => array(
							"title" => __("Align", "themerex"),
							"desc" => __("Select block alignment", "themerex"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Block
				"trx_block" => array(
					"title" => __("Block container", "themerex"),
					"desc" => __("Container for any block ([section] analog - to enable nesting)", "themerex"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"dedicated" => array(
							"title" => __("Dedicated", "themerex"),
							"desc" => __("Use this block as dedicated content - show it before post title on single page", "themerex"),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"align" => array(
							"title" => __("Align", "themerex"),
							"desc" => __("Select block alignment", "themerex"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						),
						"columns" => array(
							"title" => __("Columns emulation", "themerex"),
							"desc" => __("Select width for columns emulation", "themerex"),
							"value" => "none",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['columns']
						), 
						"pan" => array(
							"title" => __("Use pan effect", "themerex"),
							"desc" => __("Use pan effect to show section content", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"scroll" => array(
							"title" => __("Use scroller", "themerex"),
							"desc" => __("Use scroller to show section content", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"scroll_dir" => array(
							"title" => __("Scroll direction", "themerex"),
							"desc" => __("Scroll direction (if Use scroller = yes)", "themerex"),
							"dependency" => array(
								'scroll' => array('yes')
							),
							"value" => "horizontal",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['dir']
						),
						"scroll_controls" => array(
							"title" => __("Scroll controls", "themerex"),
							"desc" => __("Show scroll controls (if Use scroller = yes)", "themerex"),
							"dependency" => array(
								'scroll' => array('yes')
							),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"color" => array(
							"title" => __("Fore color", "themerex"),
							"desc" => __("Any color for objects in this section", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "color"
						),
						"bg_tint" => array(
							"title" => __("Background tint", "themerex"),
							"desc" => __("Main background tint: dark or light", "themerex"),
							"value" => "",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['tint']
						),
						"bg_color" => array(
							"title" => __("Background color", "themerex"),
							"desc" => __("Any background color for this section", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image URL", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for the background", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "themerex"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "themerex"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "themerex"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "themerex"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
						),
						"font_size" => array(
							"title" => __("Font size", "themerex"),
							"desc" => __("Font size of the text (default - in pixels, allows any CSS units of measure)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"font_weight" => array(
							"title" => __("Font weight", "themerex"),
							"desc" => __("Font weight of the text", "themerex"),
							"value" => "",
							"type" => "select",
							"size" => "medium",
							"options" => array(
								'100' => __('Thin (100)', 'themerex'),
								'300' => __('Light (300)', 'themerex'),
								'400' => __('Normal (400)', 'themerex'),
								'700' => __('Bold (700)', 'themerex')
							)
						),
						"_content_" => array(
							"title" => __("Container content", "themerex"),
							"desc" => __("Content for section container", "themerex"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Blogger
				"trx_blogger" => array(
					"title" => __("Blogger", "themerex"),
					"desc" => __("Insert posts (pages) in many styles from desired categories or directly from ids", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Posts output style", "themerex"),
							"desc" => __("Select desired style for posts output", "themerex"),
							"value" => "regular",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['blogger_styles']
						),
						"filters" => array(
							"title" => __("Show filters", "themerex"),
							"desc" => __("Use post's tags or categories as filter buttons", "themerex"),
							"value" => "no",
							"dir" => "horizontal",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['filters']
						),
						"hover" => array(
							"title" => __("Hover effect", "themerex"),
							"desc" => __("Select hover effect (only if style=Portfolio)", "themerex"),
							"dependency" => array(
								'style' => array('portfolio','grid','square','courses')
							),
							"value" => "",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['hovers']
						),
						"hover_dir" => array(
							"title" => __("Hover direction", "themerex"),
							"desc" => __("Select hover direction (only if style=Portfolio and hover=Circle|Square)", "themerex"),
							"dependency" => array(
								'style' => array('portfolio','grid','square','courses'),
								'hover' => array('square','circle')
							),
							"value" => "left_to_right",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['hovers_dir']
						),
						"dir" => array(
							"title" => __("Posts direction", "themerex"),
							"desc" => __("Display posts in horizontal or vertical direction", "themerex"),
							"value" => "horizontal",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['dir']
						),
						"post_type" => array(
							"title" => __("Post type", "themerex"),
							"desc" => __("Select post type to show", "themerex"),
							"value" => "post",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['posts_types']
						),
						"ids" => array(
							"title" => __("Post IDs list", "themerex"),
							"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"cat" => array(
							"title" => __("Categories list", "themerex"),
							"desc" => __("Select the desired categories. If not selected - show posts from any category or from IDs list", "themerex"),
							"dependency" => array(
								'ids' => array('is_empty'),
								'post_type' => array('refresh')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => $THEMEREX_GLOBALS['sc_params']['categories']
						),
						"count" => array(
							"title" => __("Total posts to show", "themerex"),
							"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
							"dependency" => array(
								'ids' => array('is_empty')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns number", "themerex"),
							"desc" => __("How many columns used to show posts? If empty or 0 - equal to posts number", "themerex"),
							"dependency" => array(
								'dir' => array('horizontal')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => __("Offset before select posts", "themerex"),
							"desc" => __("Skip posts before select next part.", "themerex"),
							"dependency" => array(
								'ids' => array('is_empty')
							),
							"value" => 0,
							"min" => 0,
							"max" => 100,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Post order by", "themerex"),
							"desc" => __("Select desired posts sorting method", "themerex"),
							"value" => "date",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['sorting']
						),
						"order" => array(
							"title" => __("Post order", "themerex"),
							"desc" => __("Select desired posts order", "themerex"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						),
						"only" => array(
							"title" => __("Select posts only", "themerex"),
							"desc" => __("Select posts only with reviews, videos, audios, thumbs or galleries", "themerex"),
							"value" => "no",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['formats']
						),
						"scroll" => array(
							"title" => __("Use scroller", "themerex"),
							"desc" => __("Use scroller to show all posts", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"controls" => array(
							"title" => __("Show slider controls", "themerex"),
							"desc" => __("Show arrows to control scroll slider", "themerex"),
							"dependency" => array(
								'scroll' => array('yes')
							),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"location" => array(
							"title" => __("Dedicated content location", "themerex"),
							"desc" => __("Select position for dedicated content (only for style=excerpt)", "themerex"),
							"divider" => true,
							"dependency" => array(
								'style' => array('excerpt')
							),
							"value" => "default",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['locations']
						),
						"rating" => array(
							"title" => __("Show rating stars", "themerex"),
							"desc" => __("Show rating stars under post's header", "themerex"),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"info" => array(
							"title" => __("Show post info block", "themerex"),
							"desc" => __("Show post info block (author, date, tags, etc.)", "themerex"),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"links" => array(
							"title" => __("Allow links on the post", "themerex"),
							"desc" => __("Allow links on the post from each blogger item", "themerex"),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"descr" => array(
							"title" => __("Description length", "themerex"),
							"desc" => __("How many characters are displayed from post excerpt? If 0 - don't show description", "themerex"),
							"value" => 0,
							"min" => 0,
							"step" => 10,
							"type" => "spinner"
						),
						"readmore" => array(
							"title" => __("More link text", "themerex"),
							"desc" => __("Read more link text. If empty - show 'More', else - used as link text", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Br
				"trx_br" => array(
					"title" => __("Break", "themerex"),
					"desc" => __("Line break with clear floating (if need)", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"clear" => 	array(
							"title" => __("Clear floating", "themerex"),
							"desc" => __("Clear floating (if need)", "themerex"),
							"value" => "",
							"type" => "checklist",
							"options" => array(
								'none' => __('None', 'themerex'),
								'left' => __('Left', 'themerex'),
								'right' => __('Right', 'themerex'),
								'both' => __('Both', 'themerex')
							)
						)
					)
				),
			
			
			
			
				// Button
				"trx_button" => array(
					"title" => __("Button", "themerex"),
					"desc" => __("Button with link", "themerex"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"_content_" => array(
							"title" => __("Caption", "themerex"),
							"desc" => __("Button caption", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"type" => array(
							"title" => __("Button's shape", "themerex"),
							"desc" => __("Select button's shape", "themerex"),
							"value" => "square",
							"size" => "medium",
							"options" => array(
								'square' => __('Square', 'themerex'),
								'round' => __('Round', 'themerex')
							),
							"type" => "switch"
						), 
						"style" => array(
							"title" => __("Button's style", "themerex"),
							"desc" => __("Select button's style", "themerex"),
							"value" => "default",
							"dir" => "horizontal",
							"options" => array(
								'filled' => __('Filled', 'themerex'),
								'border' => __('Border', 'themerex')
							),
							"type" => "checklist"
						), 
						"size" => array(
							"title" => __("Button's size", "themerex"),
							"desc" => __("Select button's size", "themerex"),
							"value" => "small",
							"dir" => "horizontal",
							"options" => array(
								'small' => __('Small', 'themerex'),
								'medium' => __('Medium', 'themerex'),
								'large' => __('Large', 'themerex')
							),
							"type" => "checklist"
						), 
						"icon" => array(
							"title" => __("Button's icon",  'themerex'),
							"desc" => __('Select icon for the title from Fontello icons set',  'themerex'),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"bg_style" => array(
							"title" => __("Button's color scheme", "themerex"),
							"desc" => __("Select button's color scheme", "themerex"),
							"value" => "custom",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['button_styles']
						), 
						"color" => array(
							"title" => __("Button's text color", "themerex"),
							"desc" => __("Any color for button's caption", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"bg_color" => array(
							"title" => __("Button's backcolor", "themerex"),
							"desc" => __("Any color for button's background", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"align" => array(
							"title" => __("Button's alignment", "themerex"),
							"desc" => __("Align button to left, center or right", "themerex"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						), 
						"link" => array(
							"title" => __("Link URL", "themerex"),
							"desc" => __("URL for link on button click", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"target" => array(
							"title" => __("Link target", "themerex"),
							"desc" => __("Target for link on button click", "themerex"),
							"dependency" => array(
								'link' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"popup" => array(
							"title" => __("Open link in popup", "themerex"),
							"desc" => __("Open link target in popup window", "themerex"),
							"dependency" => array(
								'link' => array('not_empty')
							),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						), 
						"rel" => array(
							"title" => __("Rel attribute", "themerex"),
							"desc" => __("Rel attribute for button's link (if need)", "themerex"),
							"dependency" => array(
								'link' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
				// Chat
				"trx_chat" => array(
					"title" => __("Chat", "themerex"),
					"desc" => __("Chat message", "themerex"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"title" => array(
							"title" => __("Item title", "themerex"),
							"desc" => __("Chat item title", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"photo" => array(
							"title" => __("Item photo", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for the item photo (avatar)", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"link" => array(
							"title" => __("Item link", "themerex"),
							"desc" => __("Chat item link", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"_content_" => array(
							"title" => __("Chat item content", "themerex"),
							"desc" => __("Current chat item content", "themerex"),
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
				// Columns
				"trx_columns" => array(
					"title" => __("Columns", "themerex"),
					"desc" => __("Insert up to 5 columns in your page (post)", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"fluid" => array(
							"title" => __("Fluid columns", "themerex"),
							"desc" => __("To squeeze the columns when reducing the size of the window (fluid=yes) or to rebuild them (fluid=no)", "themerex"),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						), 
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_column_item",
						"title" => __("Column", "themerex"),
						"desc" => __("Column item", "themerex"),
						"container" => true,
						"params" => array(
							"span" => array(
								"title" => __("Merge columns", "themerex"),
								"desc" => __("Count merged columns from current", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"align" => array(
								"title" => __("Alignment", "themerex"),
								"desc" => __("Alignment text in the column", "themerex"),
								"value" => "",
								"type" => "checklist",
								"dir" => "horizontal",
								"options" => $THEMEREX_GLOBALS['sc_params']['align']
							),
							"color" => array(
								"title" => __("Fore color", "themerex"),
								"desc" => __("Any color for objects in this column", "themerex"),
								"value" => "",
								"type" => "color"
							),
							"bg_color" => array(
								"title" => __("Background color", "themerex"),
								"desc" => __("Any background color for this column", "themerex"),
								"value" => "",
								"type" => "color"
							),
							"bg_image" => array(
								"title" => __("URL for background image file", "themerex"),
								"desc" => __("Select or upload image or write URL from other site for the background", "themerex"),
								"readonly" => false,
								"value" => "",
								"type" => "media"
							),
							"_content_" => array(
								"title" => __("Column item content", "themerex"),
								"desc" => __("Current column item content", "themerex"),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Contact form
				"trx_contact_form" => array(
					"title" => __("Contact form", "themerex"),
					"desc" => __("Insert contact form", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"custom" => array(
							"title" => __("Custom", "themerex"),
							"desc" => __("Use custom fields or create standard contact form (ignore info from 'Field' tabs)", "themerex"),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						), 
						"action" => array(
							"title" => __("Action", "themerex"),
							"desc" => __("Contact form action (URL to handle form data). If empty - use internal action", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Align", "themerex"),
							"desc" => __("Select form alignment", "themerex"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						),
						"title" => array(
							"title" => __("Title", "themerex"),
							"desc" => __("Contact form title", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"description" => array(
							"title" => __("Description", "themerex"),
							"desc" => __("Short description for contact form", "themerex"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => themerex_shortcodes_width(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_form_item",
						"title" => __("Field", "themerex"),
						"desc" => __("Custom field", "themerex"),
						"container" => false,
						"params" => array(
							"type" => array(
								"title" => __("Type", "themerex"),
								"desc" => __("Type of the custom field", "themerex"),
								"value" => "text",
								"type" => "checklist",
								"dir" => "horizontal",
								"options" => $THEMEREX_GLOBALS['sc_params']['field_types']
							), 
							"name" => array(
								"title" => __("Name", "themerex"),
								"desc" => __("Name of the custom field", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"value" => array(
								"title" => __("Default value", "themerex"),
								"desc" => __("Default value of the custom field", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"label" => array(
								"title" => __("Label", "themerex"),
								"desc" => __("Label for the custom field", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"label_position" => array(
								"title" => __("Label position", "themerex"),
								"desc" => __("Label position relative to the field", "themerex"),
								"value" => "top",
								"type" => "checklist",
								"dir" => "horizontal",
								"options" => $THEMEREX_GLOBALS['sc_params']['label_positions']
							), 
							"top" => $THEMEREX_GLOBALS['sc_params']['top'],
							"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
							"left" => $THEMEREX_GLOBALS['sc_params']['left'],
							"right" => $THEMEREX_GLOBALS['sc_params']['right'],
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Content block on fullscreen page
				"trx_content" => array(
					"title" => __("Content block", "themerex"),
					"desc" => __("Container for main content block with desired class and style (use it only on fullscreen pages)", "themerex"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"_content_" => array(
							"title" => __("Container content", "themerex"),
							"desc" => __("Content for section container", "themerex"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Countdown
				"trx_countdown" => array(
					"title" => __("Countdown", "themerex"),
					"desc" => __("Insert countdown object", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"date" => array(
							"title" => __("Date", "themerex"),
							"desc" => __("Upcoming date (format: yyyy-mm-dd)", "themerex"),
							"value" => "",
							"format" => "yy-mm-dd",
							"type" => "date"
						),
						"time" => array(
							"title" => __("Time", "themerex"),
							"desc" => __("Upcoming time (format: HH:mm:ss)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"style" => array(
							"title" => __("Style", "themerex"),
							"desc" => __("Countdown style", "themerex"),
							"value" => "1",
							"type" => "checklist",
							"options" => array(
								1 => __('Style 1', 'themerex'),
								2 => __('Style 2', 'themerex')
							)
						),
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Align counter to left, center or right", "themerex"),
							"divider" => true,
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						), 
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Dropcaps
				"trx_dropcaps" => array(
					"title" => __("Dropcaps", "themerex"),
					"desc" => __("Make first letter as dropcaps", "themerex"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"style" => array(
							"title" => __("Style", "themerex"),
							"desc" => __("Dropcaps style", "themerex"),
							"value" => "1",
							"type" => "checklist",
							"options" => array(
								1 => __('Style 1', 'themerex'),
								2 => __('Style 2', 'themerex'),
								3 => __('Style 3', 'themerex'),
								4 => __('Style 4', 'themerex')
							)
						),
						"_content_" => array(
							"title" => __("Paragraph content", "themerex"),
							"desc" => __("Paragraph with dropcaps content", "themerex"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Emailer
				"trx_emailer" => array(
					"title" => __("E-mail collector", "themerex"),
					"desc" => __("Collect the e-mail address into specified group", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"group" => array(
							"title" => __("Group", "themerex"),
							"desc" => __("The name of group to collect e-mail address", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"open" => array(
							"title" => __("Open", "themerex"),
							"desc" => __("Initially open the input field on show object", "themerex"),
							"divider" => true,
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Align object to left, center or right", "themerex"),
							"divider" => true,
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						), 
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Gap
				"trx_gap" => array(
					"title" => __("Gap", "themerex"),
					"desc" => __("Insert gap (fullwidth area) in the post content. Attention! Use the gap only in the posts (pages) without left or right sidebar", "themerex"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"_content_" => array(
							"title" => __("Gap content", "themerex"),
							"desc" => __("Gap inner content", "themerex"),
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						)
					)
				),
			
			
			
			
			
				// Google map
				"trx_googlemap" => array(
					"title" => __("Google map", "themerex"),
					"desc" => __("Insert Google map with desired address or coordinates", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"address" => array(
							"title" => __("Address", "themerex"),
							"desc" => __("Address to show in map center", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"latlng" => array(
							"title" => __("Latitude and Longtitude", "themerex"),
							"desc" => __("Comma separated map center coorditanes (instead Address)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"zoom" => array(
							"title" => __("Zoom", "themerex"),
							"desc" => __("Map zoom factor", "themerex"),
							"divider" => true,
							"value" => 16,
							"min" => 1,
							"max" => 20,
							"type" => "spinner"
						),
						"style" => array(
							"title" => __("Map style", "themerex"),
							"desc" => __("Select map style", "themerex"),
							"value" => "default",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['googlemap_styles']
						),
						"width" => themerex_shortcodes_width('100%'),
						"height" => themerex_shortcodes_height(240),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
				// Hide or show any block
				"trx_hide" => array(
					"title" => __("Hide/Show any block", "themerex"),
					"desc" => __("Hide or Show any block with desired CSS-selector", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"selector" => array(
							"title" => __("Selector", "themerex"),
							"desc" => __("Any block's CSS-selector", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"hide" => array(
							"title" => __("Hide or Show", "themerex"),
							"desc" => __("New state for the block: hide or show", "themerex"),
							"value" => "yes",
							"size" => "small",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no'],
							"type" => "switch"
						)
					)
				),
			
			
			
				// Highlght text
				"trx_highlight" => array(
					"title" => __("Highlight text", "themerex"),
					"desc" => __("Highlight text with selected color, background color and other styles", "themerex"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"type" => array(
							"title" => __("Type", "themerex"),
							"desc" => __("Highlight type", "themerex"),
							"value" => "1",
							"type" => "checklist",
							"options" => array(
								0 => __('Custom', 'themerex'),
								1 => __('Type 1', 'themerex'),
								2 => __('Type 2', 'themerex'),
								3 => __('Type 3', 'themerex')
							)
						),
						"color" => array(
							"title" => __("Color", "themerex"),
							"desc" => __("Color for the highlighted text", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "color"
						),
						"bg_color" => array(
							"title" => __("Background color", "themerex"),
							"desc" => __("Background color for the highlighted text", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"font_size" => array(
							"title" => __("Font size", "themerex"),
							"desc" => __("Font size of the highlighted text (default - in pixels, allows any CSS units of measure)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"_content_" => array(
							"title" => __("Highlighting content", "themerex"),
							"desc" => __("Content for highlight", "themerex"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Icon
				"trx_icon" => array(
					"title" => __("Icon", "themerex"),
					"desc" => __("Insert icon", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"icon" => array(
							"title" => __('Icon',  'themerex'),
							"desc" => __('Select font icon from the Fontello icons set',  'themerex'),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"color" => array(
							"title" => __("Icon's color", "themerex"),
							"desc" => __("Icon's color", "themerex"),
							"dependency" => array(
								'icon' => array('not_empty')
							),
							"value" => "",
							"type" => "color"
						),
						"bg_shape" => array(
							"title" => __("Background shape", "themerex"),
							"desc" => __("Shape of the icon background", "themerex"),
							"dependency" => array(
								'icon' => array('not_empty')
							),
							"value" => "none",
							"type" => "radio",
							"options" => array(
								'none' => __('None', 'themerex'),
								'round' => __('Round', 'themerex'),
								'square' => __('Square', 'themerex')
							)
						),
						"bg_style" => array(
							"title" => __("Background style", "themerex"),
							"desc" => __("Select icon's color scheme", "themerex"),
							"value" => "custom",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['button_styles']
						), 
						"bg_color" => array(
							"title" => __("Icon's background color", "themerex"),
							"desc" => __("Icon's background color", "themerex"),
							"dependency" => array(
								'icon' => array('not_empty'),
								'background' => array('round','square')
							),
							"value" => "",
							"type" => "color"
						),
						"font_size" => array(
							"title" => __("Font size", "themerex"),
							"desc" => __("Icon's font size", "themerex"),
							"dependency" => array(
								'icon' => array('not_empty')
							),
							"value" => "",
							"type" => "spinner",
							"min" => 8,
							"max" => 240
						),
						"font_weight" => array(
							"title" => __("Font weight", "themerex"),
							"desc" => __("Icon font weight", "themerex"),
							"dependency" => array(
								'icon' => array('not_empty')
							),
							"value" => "",
							"type" => "select",
							"size" => "medium",
							"options" => array(
								'100' => __('Thin (100)', 'themerex'),
								'300' => __('Light (300)', 'themerex'),
								'400' => __('Normal (400)', 'themerex'),
								'700' => __('Bold (700)', 'themerex')
							)
						),
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Icon text alignment", "themerex"),
							"dependency" => array(
								'icon' => array('not_empty')
							),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						), 
						"link" => array(
							"title" => __("Link URL", "themerex"),
							"desc" => __("Link URL from this icon (if not empty)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Image
				"trx_image" => array(
					"title" => __("Image", "themerex"),
					"desc" => __("Insert image into your post (page)", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"url" => array(
							"title" => __("URL for image file", "themerex"),
							"desc" => __("Select or upload image or write URL from other site", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"title" => array(
							"title" => __("Title", "themerex"),
							"desc" => __("Image title (if need)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"icon" => array(
							"title" => __("Icon before title",  'themerex'),
							"desc" => __('Select icon for the title from Fontello icons set',  'themerex'),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"align" => array(
							"title" => __("Float image", "themerex"),
							"desc" => __("Float image to left or right side", "themerex"),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['float']
						), 
						"shape" => array(
							"title" => __("Image Shape", "themerex"),
							"desc" => __("Shape of the image: square (rectangle) or round", "themerex"),
							"value" => "square",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								"square" => __('Square', 'themerex'),
								"round" => __('Round', 'themerex')
							)
						), 
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
				// Infobox
				"trx_infobox" => array(
					"title" => __("Infobox", "themerex"),
					"desc" => __("Insert infobox into your post (page)", "themerex"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"style" => array(
							"title" => __("Style", "themerex"),
							"desc" => __("Infobox style", "themerex"),
							"value" => "regular",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								'regular' => __('Regular', 'themerex'),
								'info' => __('Info', 'themerex'),
								'success' => __('Success', 'themerex'),
								'error' => __('Error', 'themerex')
							)
						),
						"closeable" => array(
							"title" => __("Closeable box", "themerex"),
							"desc" => __("Create closeable box (with close button)", "themerex"),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"icon" => array(
							"title" => __("Custom icon",  'themerex'),
							"desc" => __('Select icon for the infobox from Fontello icons set. If empty - use default icon',  'themerex'),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"color" => array(
							"title" => __("Text color", "themerex"),
							"desc" => __("Any color for text and headers", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"bg_color" => array(
							"title" => __("Background color", "themerex"),
							"desc" => __("Any background color for this infobox", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"_content_" => array(
							"title" => __("Infobox content", "themerex"),
							"desc" => __("Content for infobox", "themerex"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
				// Line
				"trx_line" => array(
					"title" => __("Line", "themerex"),
					"desc" => __("Insert Line into your post (page)", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Style", "themerex"),
							"desc" => __("Line style", "themerex"),
							"value" => "solid",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								'solid' => __('Solid', 'themerex'),
								'dashed' => __('Dashed', 'themerex'),
								'dotted' => __('Dotted', 'themerex'),
								'double' => __('Double', 'themerex')
							)
						),
						"color" => array(
							"title" => __("Color", "themerex"),
							"desc" => __("Line color", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// List
				"trx_list" => array(
					"title" => __("List", "themerex"),
					"desc" => __("List items with specific bullets", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Bullet's style", "themerex"),
							"desc" => __("Bullet's style for each list item", "themerex"),
							"value" => "ul",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['list_styles']
						), 
						"color" => array(
							"title" => __("Color", "themerex"),
							"desc" => __("List items color", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"icon" => array(
							"title" => __('List icon',  'themerex'),
							"desc" => __("Select list icon from Fontello icons set (only for style=Iconed)",  'themerex'),
							"dependency" => array(
								'style' => array('iconed')
							),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"icon_color" => array(
							"title" => __("Icon color", "themerex"),
							"desc" => __("List icons color", "themerex"),
							"value" => "",
							"dependency" => array(
								'style' => array('iconed')
							),
							"type" => "color"
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_list_item",
						"title" => __("Item", "themerex"),
						"desc" => __("List item with specific bullet", "themerex"),
						"decorate" => false,
						"container" => true,
						"params" => array(
							"_content_" => array(
								"title" => __("List item content", "themerex"),
								"desc" => __("Current list item content", "themerex"),
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"title" => array(
								"title" => __("List item title", "themerex"),
								"desc" => __("Current list item title (show it as tooltip)", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"color" => array(
								"title" => __("Color", "themerex"),
								"desc" => __("Text color for this item", "themerex"),
								"value" => "",
								"type" => "color"
							),
							"icon" => array(
								"title" => __('List icon',  'themerex'),
								"desc" => __("Select list item icon from Fontello icons set (only for style=Iconed)",  'themerex'),
								"value" => "",
								"type" => "icons",
								"options" => $THEMEREX_GLOBALS['sc_params']['icons']
							),
							"icon_color" => array(
								"title" => __("Icon color", "themerex"),
								"desc" => __("Icon color for this item", "themerex"),
								"value" => "",
								"type" => "color"
							),
							"link" => array(
								"title" => __("Link URL", "themerex"),
								"desc" => __("Link URL for the current list item", "themerex"),
								"divider" => true,
								"value" => "",
								"type" => "text"
							),
							"target" => array(
								"title" => __("Link target", "themerex"),
								"desc" => __("Link target for the current list item", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
				// Number
				"trx_number" => array(
					"title" => __("Number", "themerex"),
					"desc" => __("Insert number or any word as set separate characters", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"value" => array(
							"title" => __("Value", "themerex"),
							"desc" => __("Number or any word", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Align", "themerex"),
							"desc" => __("Select block alignment", "themerex"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Parallax
				"trx_parallax" => array(
					"title" => __("Parallax", "themerex"),
					"desc" => __("Create the parallax container (with asinc background image)", "themerex"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"gap" => array(
							"title" => __("Create gap", "themerex"),
							"desc" => __("Create gap around parallax container", "themerex"),
							"value" => "no",
							"size" => "small",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no'],
							"type" => "switch"
						), 
						"dir" => array(
							"title" => __("Dir", "themerex"),
							"desc" => __("Scroll direction for the parallax background", "themerex"),
							"value" => "up",
							"size" => "medium",
							"options" => array(
								'up' => __('Up', 'themerex'),
								'down' => __('Down', 'themerex')
							),
							"type" => "switch"
						), 
						"speed" => array(
							"title" => __("Speed", "themerex"),
							"desc" => __("Image motion speed (from 0.0 to 1.0)", "themerex"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0.3",
							"type" => "spinner"
						),
						"color" => array(
							"title" => __("Text color", "themerex"),
							"desc" => __("Select color for text object inside parallax block", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "color"
						),
						"bg_tint" => array(
							"title" => __("Bg tint", "themerex"),
							"desc" => __("Select tint of the parallax background (for correct font color choise)", "themerex"),
							"value" => "light",
							"size" => "medium",
							"options" => array(
								'light' => __('Light', 'themerex'),
								'dark' => __('Dark', 'themerex')
							),
							"type" => "switch"
						), 
						"bg_color" => array(
							"title" => __("Background color", "themerex"),
							"desc" => __("Select color for parallax background", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for the parallax background", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_image_x" => array(
							"title" => __("Image X position", "themerex"),
							"desc" => __("Image horizontal position (as background of the parallax block) - in percent", "themerex"),
							"min" => "0",
							"max" => "100",
							"value" => "50",
							"type" => "spinner"
						),
						"bg_video" => array(
							"title" => __("Video background", "themerex"),
							"desc" => __("Select video from media library or paste URL for video file from other site to show it as parallax background", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media",
							"before" => array(
								'title' => __('Choose video', 'themerex'),
								'action' => 'media_upload',
								'type' => 'video',
								'multiple' => false,
								'linked_field' => '',
								'captions' => array( 	
									'choose' => __('Choose video file', 'themerex'),
									'update' => __('Select video file', 'themerex')
								)
							),
							"after" => array(
								'icon' => 'icon-cancel',
								'action' => 'media_reset'
							)
						),
						"bg_video_ratio" => array(
							"title" => __("Video ratio", "themerex"),
							"desc" => __("Specify ratio of the video background. For example: 16:9 (default), 4:3, etc.", "themerex"),
							"value" => "16:9",
							"type" => "text"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "themerex"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "themerex"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "themerex"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "themerex"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
						),
						"_content_" => array(
							"title" => __("Content", "themerex"),
							"desc" => __("Content for the parallax container", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Popup
				"trx_popup" => array(
					"title" => __("Popup window", "themerex"),
					"desc" => __("Container for any html-block with desired class and style for popup window", "themerex"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"_content_" => array(
							"title" => __("Container content", "themerex"),
							"desc" => __("Content for section container", "themerex"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Price
				"trx_price" => array(
					"title" => __("Price", "themerex"),
					"desc" => __("Insert price with decoration", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"money" => array(
							"title" => __("Money", "themerex"),
							"desc" => __("Money value (dot or comma separated)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"currency" => array(
							"title" => __("Currency", "themerex"),
							"desc" => __("Currency character", "themerex"),
							"value" => "$",
							"type" => "text"
						),
						"period" => array(
							"title" => __("Period", "themerex"),
							"desc" => __("Period text (if need). For example: monthly, daily, etc.", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Align price to left or right side", "themerex"),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['float']
						), 
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
				// Price block
				"trx_price_block" => array(
					"title" => __("Price block", "themerex"),
					"desc" => __("Insert price block with title, price and description", "themerex"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"title" => array(
							"title" => __("Title", "themerex"),
							"desc" => __("Block title", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"link" => array(
							"title" => __("Link URL", "themerex"),
							"desc" => __("URL for link from button (at bottom of the block)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"link_text" => array(
							"title" => __("Link text", "themerex"),
							"desc" => __("Text (caption) for the link button (at bottom of the block). If empty - button not showed", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"icon" => array(
							"title" => __("Icon",  'themerex'),
							"desc" => __('Select icon from Fontello icons set (placed before/instead price)',  'themerex'),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"money" => array(
							"title" => __("Money", "themerex"),
							"desc" => __("Money value (dot or comma separated)", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"currency" => array(
							"title" => __("Currency", "themerex"),
							"desc" => __("Currency character", "themerex"),
							"value" => "$",
							"type" => "text"
						),
						"period" => array(
							"title" => __("Period", "themerex"),
							"desc" => __("Period text (if need). For example: monthly, daily, etc.", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Align price to left or right side", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['float']
						), 
						"_content_" => array(
							"title" => __("Description", "themerex"),
							"desc" => __("Description for this price block", "themerex"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Quote
				"trx_quote" => array(
					"title" => __("Quote", "themerex"),
					"desc" => __("Quote text", "themerex"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"cite" => array(
							"title" => __("Quote cite", "themerex"),
							"desc" => __("URL for quote cite", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"title" => array(
							"title" => __("Title (author)", "themerex"),
							"desc" => __("Quote title (author name)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"_content_" => array(
							"title" => __("Quote content", "themerex"),
							"desc" => __("Quote content", "themerex"),
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => themerex_shortcodes_width(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Reviews
				"trx_reviews" => array(
					"title" => __("Reviews", "themerex"),
					"desc" => __("Insert reviews block in the single post", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Align counter to left, center or right", "themerex"),
							"divider" => true,
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						), 
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Search
				"trx_search" => array(
					"title" => __("Search", "themerex"),
					"desc" => __("Show search form", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"ajax" => array(
							"title" => __("Style", "themerex"),
							"desc" => __("Select style to display search field", "themerex"),
							"value" => "regular",
							"options" => array(
								"regular" => __('Regular', 'themerex'),
								"flat" => __('Flat', 'themerex')
							),
							"type" => "checklist"
						),
						"title" => array(
							"title" => __("Title", "themerex"),
							"desc" => __("Title (placeholder) for the search field", "themerex"),
							"value" => __("Search &hellip;", 'themerex'),
							"type" => "text"
						),
						"ajax" => array(
							"title" => __("AJAX", "themerex"),
							"desc" => __("Search via AJAX or reload page", "themerex"),
							"value" => "yes",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no'],
							"type" => "switch"
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Section
				"trx_section" => array(
					"title" => __("Section container", "themerex"),
					"desc" => __("Container for any block with desired class and style", "themerex"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"dedicated" => array(
							"title" => __("Dedicated", "themerex"),
							"desc" => __("Use this block as dedicated content - show it before post title on single page", "themerex"),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"align" => array(
							"title" => __("Align", "themerex"),
							"desc" => __("Select block alignment", "themerex"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						),
						"columns" => array(
							"title" => __("Columns emulation", "themerex"),
							"desc" => __("Select width for columns emulation", "themerex"),
							"value" => "none",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['columns']
						), 
						"pan" => array(
							"title" => __("Use pan effect", "themerex"),
							"desc" => __("Use pan effect to show section content", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"scroll" => array(
							"title" => __("Use scroller", "themerex"),
							"desc" => __("Use scroller to show section content", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"scroll_dir" => array(
							"title" => __("Scroll and Pan direction", "themerex"),
							"desc" => __("Scroll and Pan direction (if Use scroller = yes or Pan = yes)", "themerex"),
							"dependency" => array(
								'pan' => array('yes'),
								'scroll' => array('yes')
							),
							"value" => "horizontal",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['dir']
						),
						"scroll_controls" => array(
							"title" => __("Scroll controls", "themerex"),
							"desc" => __("Show scroll controls (if Use scroller = yes)", "themerex"),
							"dependency" => array(
								'scroll' => array('yes')
							),
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"color" => array(
							"title" => __("Fore color", "themerex"),
							"desc" => __("Any color for objects in this section", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "color"
						),
						"bg_tint" => array(
							"title" => __("Background tint", "themerex"),
							"desc" => __("Main background tint: dark or light", "themerex"),
							"value" => "",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['tint']
						),
						"bg_color" => array(
							"title" => __("Background color", "themerex"),
							"desc" => __("Any background color for this section", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image URL", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for the background", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "themerex"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "themerex"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "themerex"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "themerex"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
						),
						"font_size" => array(
							"title" => __("Font size", "themerex"),
							"desc" => __("Font size of the text (default - in pixels, allows any CSS units of measure)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"font_weight" => array(
							"title" => __("Font weight", "themerex"),
							"desc" => __("Font weight of the text", "themerex"),
							"value" => "",
							"type" => "select",
							"size" => "medium",
							"options" => array(
								'100' => __('Thin (100)', 'themerex'),
								'300' => __('Light (300)', 'themerex'),
								'400' => __('Normal (400)', 'themerex'),
								'700' => __('Bold (700)', 'themerex')
							)
						),
						"_content_" => array(
							"title" => __("Container content", "themerex"),
							"desc" => __("Content for section container", "themerex"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
				// Skills
				"trx_skills" => array(
					"title" => __("Skills", "themerex"),
					"desc" => __("Insert skills diagramm in your page (post)", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"max_value" => array(
							"title" => __("Max value", "themerex"),
							"desc" => __("Max value for skills items", "themerex"),
							"value" => 100,
							"min" => 1,
							"type" => "spinner"
						),
						"type" => array(
							"title" => __("Skills type", "themerex"),
							"desc" => __("Select type of skills block", "themerex"),
							"value" => "bar",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								'bar' => __('Bar', 'themerex'),
								'pie' => __('Pie chart', 'themerex'),
								'counter' => __('Counter', 'themerex'),
								'arc' => __('Arc', 'themerex')
							)
						), 
						"layout" => array(
							"title" => __("Skills layout", "themerex"),
							"desc" => __("Select layout of skills block", "themerex"),
							"dependency" => array(
								'type' => array('counter','pie','bar')
							),
							"value" => "rows",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								'rows' => __('Rows', 'themerex'),
								'columns' => __('Columns', 'themerex')
							)
						),
						"dir" => array(
							"title" => __("Direction", "themerex"),
							"desc" => __("Select direction of skills block", "themerex"),
							"dependency" => array(
								'type' => array('counter','pie','bar')
							),
							"value" => "horizontal",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['dir']
						), 
						"style" => array(
							"title" => __("Counters style", "themerex"),
							"desc" => __("Select style of skills items (only for type=counter)", "themerex"),
							"dependency" => array(
								'type' => array('counter')
							),
							"value" => 1,
							"min" => 1,
							"max" => 4,
							"type" => "spinner"
						), 
						// "columns" - autodetect, not set manual
						"color" => array(
							"title" => __("Skills items color", "themerex"),
							"desc" => __("Color for all skills items", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "color"
						),
						"bg_color" => array(
							"title" => __("Background color", "themerex"),
							"desc" => __("Background color for all skills items (only for type=pie)", "themerex"),
							"dependency" => array(
								'type' => array('pie')
							),
							"value" => "",
							"type" => "color"
						),
						"border_color" => array(
							"title" => __("Border color", "themerex"),
							"desc" => __("Border color for all skills items (only for type=pie)", "themerex"),
							"dependency" => array(
								'type' => array('pie')
							),
							"value" => "",
							"type" => "color"
						),
						"title" => array(
							"title" => __("Skills title", "themerex"),
							"desc" => __("Skills block title", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"subtitle" => array(
							"title" => __("Skills subtitle", "themerex"),
							"desc" => __("Skills block subtitle - text in the center (only for type=arc)", "themerex"),
							"dependency" => array(
								'type' => array('arc')
							),
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Align skills block", "themerex"),
							"desc" => __("Align skills block to left or right side", "themerex"),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['float']
						), 
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_skills_item",
						"title" => __("Skill", "themerex"),
						"desc" => __("Skills item", "themerex"),
						"container" => false,
						"params" => array(
							"title" => array(
								"title" => __("Title", "themerex"),
								"desc" => __("Current skills item title", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"value" => array(
								"title" => __("Value", "themerex"),
								"desc" => __("Current skills level", "themerex"),
								"value" => 50,
								"min" => 0,
								"step" => 1,
								"type" => "spinner"
							),
							"color" => array(
								"title" => __("Color", "themerex"),
								"desc" => __("Current skills item color", "themerex"),
								"value" => "",
								"type" => "color"
							),
							"bg_color" => array(
								"title" => __("Background color", "themerex"),
								"desc" => __("Current skills item background color (only for type=pie)", "themerex"),
								"value" => "",
								"type" => "color"
							),
							"border_color" => array(
								"title" => __("Border color", "themerex"),
								"desc" => __("Current skills item border color (only for type=pie)", "themerex"),
								"value" => "",
								"type" => "color"
							),
							"style" => array(
								"title" => __("Counter tyle", "themerex"),
								"desc" => __("Select style for the current skills item (only for type=counter)", "themerex"),
								"value" => 1,
								"min" => 1,
								"max" => 4,
								"type" => "spinner"
							), 
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Slider
				"trx_slider" => array(
					"title" => __("Slider", "themerex"),
					"desc" => __("Insert slider into your post (page)", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array_merge(array(
						"engine" => array(
							"title" => __("Slider engine", "themerex"),
							"desc" => __("Select engine for slider. Attention! Swiper is built-in engine, all other engines appears only if corresponding plugings are installed", "themerex"),
							"value" => "swiper",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['sliders']
						),
						"align" => array(
							"title" => __("Float slider", "themerex"),
							"desc" => __("Float slider to left or right side", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['float']
						),
						"custom" => array(
							"title" => __("Custom slides", "themerex"),
							"desc" => __("Make custom slides from inner shortcodes (prepare it on tabs) or prepare slides from posts thumbnails", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						)
						),
						themerex_exists_revslider() || themerex_exists_royalslider() ? array(
						"alias" => array(
							"title" => __("Revolution slider alias or Royal Slider ID", "themerex"),
							"desc" => __("Alias for Revolution slider or Royal slider ID", "themerex"),
							"dependency" => array(
								'engine' => array('revo','royal')
							),
							"divider" => true,
							"value" => "",
							"type" => "text"
						)) : array(), array(
						"cat" => array(
							"title" => __("Swiper: Category list", "themerex"),
							"desc" => __("Comma separated list of category slugs. If empty - select posts from any category or from IDs list", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => $THEMEREX_GLOBALS['sc_params']['categories']
						),
						"count" => array(
							"title" => __("Swiper: Number of posts", "themerex"),
							"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => __("Swiper: Offset before select posts", "themerex"),
							"desc" => __("Skip posts before select next part.", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => 0,
							"min" => 0,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Swiper: Post order by", "themerex"),
							"desc" => __("Select desired posts sorting method", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "date",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['sorting']
						),
						"order" => array(
							"title" => __("Swiper: Post order", "themerex"),
							"desc" => __("Select desired posts order", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						),
						"ids" => array(
							"title" => __("Swiper: Post IDs list", "themerex"),
							"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "",
							"type" => "text"
						),
						"controls" => array(
							"title" => __("Swiper: Show slider controls", "themerex"),
							"desc" => __("Show arrows inside slider", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"divider" => true,
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"pagination" => array(
							"title" => __("Swiper: Show slider pagination", "themerex"),
							"desc" => __("Show bullets for switch slides", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "yes",
							"type" => "checklist",
							"options" => array(
								'yes'  => __('Dots', 'themerex'), 
								'full' => __('Side Titles', 'themerex'),
								'over' => __('Over Titles', 'themerex'),
								'no'   => __('None', 'themerex')
							)
						),
						"titles" => array(
							"title" => __("Swiper: Show titles section", "themerex"),
							"desc" => __("Show section with post's title and short post's description", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"divider" => true,
							"value" => "no",
							"type" => "checklist",
							"options" => array(
								"no"    => __('Not show', 'themerex'),
								"slide" => __('Show/Hide info', 'themerex'),
								"fixed" => __('Fixed info', 'themerex')
							)
						),
						"descriptions" => array(
							"title" => __("Swiper: Post descriptions", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"desc" => __("Show post's excerpt max length (characters)", "themerex"),
							"value" => 0,
							"min" => 0,
							"max" => 1000,
							"step" => 10,
							"type" => "spinner"
						),
						"links" => array(
							"title" => __("Swiper: Post's title as link", "themerex"),
							"desc" => __("Make links from post's titles", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"crop" => array(
							"title" => __("Swiper: Crop images", "themerex"),
							"desc" => __("Crop images in each slide or live it unchanged", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"autoheight" => array(
							"title" => __("Swiper: Autoheight", "themerex"),
							"desc" => __("Change whole slider's height (make it equal current slide's height)", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"interval" => array(
							"title" => __("Swiper: Slides change interval", "themerex"),
							"desc" => __("Slides change interval (in milliseconds: 1000ms = 1s)", "themerex"),
							"dependency" => array(
								'engine' => array('swiper')
							),
							"value" => 5000,
							"step" => 500,
							"min" => 0,
							"type" => "spinner"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)),
					"children" => array(
						"name" => "trx_slider_item",
						"title" => __("Slide", "themerex"),
						"desc" => __("Slider item", "themerex"),
						"container" => false,
						"params" => array(
							"src" => array(
								"title" => __("URL (source) for image file", "themerex"),
								"desc" => __("Select or upload image or write URL from other site for the current slide", "themerex"),
								"readonly" => false,
								"value" => "",
								"type" => "media"
							),
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Socials
				"trx_socials" => array(
					"title" => __("Social icons", "themerex"),
					"desc" => __("List of social icons (with hovers)", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"size" => array(
							"title" => __("Icon's size", "themerex"),
							"desc" => __("Size of the icons", "themerex"),
							"value" => "small",
							"type" => "checklist",
							"options" => array(
								"tiny" => __('Tiny', 'themerex'),
								"small" => __('Small', 'themerex'),
								"large" => __('Large', 'themerex')
							)
						), 
						"socials" => array(
							"title" => __("Manual socials list", "themerex"),
							"desc" => __("Custom list of social networks. For example: twitter=http://twitter.com/my_profile|facebook=http://facebooc.com/my_profile. If empty - use socials from Theme options.", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "text"
						),
						"custom" => array(
							"title" => __("Custom socials", "themerex"),
							"desc" => __("Make custom icons from inner shortcodes (prepare it on tabs)", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_social_item",
						"title" => __("Custom social item", "themerex"),
						"desc" => __("Custom social item: name, profile url and icon url", "themerex"),
						"decorate" => false,
						"container" => false,
						"params" => array(
							"name" => array(
								"title" => __("Social name", "themerex"),
								"desc" => __("Name (slug) of the social network (twitter, facebook, linkedin, etc.)", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"url" => array(
								"title" => __("Your profile URL", "themerex"),
								"desc" => __("URL of your profile in specified social network", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"icon" => array(
								"title" => __("URL (source) for icon file", "themerex"),
								"desc" => __("Select or upload image or write URL from other site for the current social icon", "themerex"),
								"readonly" => false,
								"value" => "",
								"type" => "media"
							)
						)
					)
				),
			
			
			
			
				// Table
				"trx_table" => array(
					"title" => __("Table", "themerex"),
					"desc" => __("Insert a table into post (page). ", "themerex"),
					"decorate" => true,
					"container" => true,
					"params" => array(
						"align" => array(
							"title" => __("Content alignment", "themerex"),
							"desc" => __("Select alignment for each table cell", "themerex"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						),
						"_content_" => array(
							"title" => __("Table content", "themerex"),
							"desc" => __("Content, created with any table-generator", "themerex"),
							"divider" => true,
							"rows" => 8,
							"value" => "Paste here table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/ or http://html-tables.com/",
							"type" => "textarea"
						),
						"width" => themerex_shortcodes_width(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Tabs
				"trx_tabs" => array(
					"title" => __("Tabs", "themerex"),
					"desc" => __("Insert tabs in your page (post)", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Tabs style", "themerex"),
							"desc" => __("Select style for tabs items", "themerex"),
							"value" => 1,
							"options" => array(
								1 => __('Style 1', 'themerex'),
								2 => __('Style 2', 'themerex')
							),
							"type" => "radio"
						),
						"initial" => array(
							"title" => __("Initially opened tab", "themerex"),
							"desc" => __("Number of initially opened tab", "themerex"),
							"divider" => true,
							"value" => 1,
							"min" => 0,
							"type" => "spinner"
						),
						"scroll" => array(
							"title" => __("Use scroller", "themerex"),
							"desc" => __("Use scroller to show tab content (height parameter required)", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_tab",
						"title" => __("Tab", "themerex"),
						"desc" => __("Tab item", "themerex"),
						"container" => true,
						"params" => array(
							"title" => array(
								"title" => __("Tab title", "themerex"),
								"desc" => __("Current tab title", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"_content_" => array(
								"title" => __("Tab content", "themerex"),
								"desc" => __("Current tab content", "themerex"),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
			
				// Team
				"trx_team" => array(
					"title" => __("Team", "themerex"),
					"desc" => __("Insert team in your page (post)", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Team style", "themerex"),
							"desc" => __("Select style to display team members", "themerex"),
							"value" => "1",
							"type" => "select",
							"options" => array(
								1 => __('Style 1', 'themerex'),
								2 => __('Style 2', 'themerex')
							)
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns use to show team members", "themerex"),
							"value" => 3,
							"min" => 2,
							"max" => 5,
							"step" => 1,
							"type" => "spinner"
						),
						"custom" => array(
							"title" => __("Custom", "themerex"),
							"desc" => __("Allow get team members from inner shortcodes (custom) or get it from specified group (cat)", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"cat" => array(
							"title" => __("Categories", "themerex"),
							"desc" => __("Select categories (groups) to show team members. If empty - select team members from any category (group) or from IDs list", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => $THEMEREX_GLOBALS['sc_params']['team_groups']
						),
						"count" => array(
							"title" => __("Number of posts", "themerex"),
							"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => __("Offset before select posts", "themerex"),
							"desc" => __("Skip posts before select next part.", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 0,
							"min" => 0,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Post order by", "themerex"),
							"desc" => __("Select desired posts sorting method", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "title",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['sorting']
						),
						"order" => array(
							"title" => __("Post order", "themerex"),
							"desc" => __("Select desired posts order", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "asc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						),
						"ids" => array(
							"title" => __("Post IDs list", "themerex"),
							"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "",
							"type" => "text"
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_team_item",
						"title" => __("Member", "themerex"),
						"desc" => __("Team member", "themerex"),
						"container" => true,
						"params" => array(
							"user" => array(
								"title" => __("Registerd user", "themerex"),
								"desc" => __("Select one of registered users (if present) or put name, position, etc. in fields below", "themerex"),
								"value" => "",
								"type" => "select",
								"options" => $THEMEREX_GLOBALS['sc_params']['users']
							),
							"member" => array(
								"title" => __("Team member", "themerex"),
								"desc" => __("Select one of team members (if present) or put name, position, etc. in fields below", "themerex"),
								"value" => "",
								"type" => "select",
								"options" => $THEMEREX_GLOBALS['sc_params']['members']
							),
							"link" => array(
								"title" => __("Link", "themerex"),
								"desc" => __("Link on team member's personal page", "themerex"),
								"divider" => true,
								"value" => "",
								"type" => "text"
							),
							"name" => array(
								"title" => __("Name", "themerex"),
								"desc" => __("Team member's name", "themerex"),
								"divider" => true,
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"position" => array(
								"title" => __("Position", "themerex"),
								"desc" => __("Team member's position", "themerex"),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"email" => array(
								"title" => __("E-mail", "themerex"),
								"desc" => __("Team member's e-mail", "themerex"),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"photo" => array(
								"title" => __("Photo", "themerex"),
								"desc" => __("Team member's photo (avatar)", "themerex"),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"readonly" => false,
								"type" => "media"
							),
							"socials" => array(
								"title" => __("Socials", "themerex"),
								"desc" => __("Team member's socials icons: name=url|name=url... For example: facebook=http://facebook.com/myaccount|twitter=http://twitter.com/myaccount", "themerex"),
								"dependency" => array(
									'user' => array('is_empty', 'none'),
									'member' => array('is_empty', 'none')
								),
								"value" => "",
								"type" => "text"
							),
							"_content_" => array(
								"title" => __("Description", "themerex"),
								"desc" => __("Team member's short description", "themerex"),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Testimonials
				"trx_testimonials" => array(
					"title" => __("Testimonials", "themerex"),
					"desc" => __("Insert testimonials into post (page)", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"controls" => array(
							"title" => __("Show arrows", "themerex"),
							"desc" => __("Show control buttons", "themerex"),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"interval" => array(
							"title" => __("Testimonials change interval", "themerex"),
							"desc" => __("Testimonials change interval (in milliseconds: 1000ms = 1s)", "themerex"),
							"value" => 7000,
							"step" => 500,
							"min" => 0,
							"type" => "spinner"
						),
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Alignment of the testimonials block", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						),
						"autoheight" => array(
							"title" => __("Autoheight", "themerex"),
							"desc" => __("Change whole slider's height (make it equal current slide's height)", "themerex"),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"custom" => array(
							"title" => __("Custom", "themerex"),
							"desc" => __("Allow get testimonials from inner shortcodes (custom) or get it from specified group (cat)", "themerex"),
							"divider" => true,
							"value" => "no",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"cat" => array(
							"title" => __("Categories", "themerex"),
							"desc" => __("Select categories (groups) to show testimonials. If empty - select testimonials from any category (group) or from IDs list", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"divider" => true,
							"value" => "",
							"type" => "select",
							"style" => "list",
							"multiple" => true,
							"options" => $THEMEREX_GLOBALS['sc_params']['testimonials_groups']
						),
						"count" => array(
							"title" => __("Number of posts", "themerex"),
							"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 3,
							"min" => 1,
							"max" => 100,
							"type" => "spinner"
						),
						"offset" => array(
							"title" => __("Offset before select posts", "themerex"),
							"desc" => __("Skip posts before select next part.", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => 0,
							"min" => 0,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Post order by", "themerex"),
							"desc" => __("Select desired posts sorting method", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "date",
							"type" => "select",
							"options" => $THEMEREX_GLOBALS['sc_params']['sorting']
						),
						"order" => array(
							"title" => __("Post order", "themerex"),
							"desc" => __("Select desired posts order", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						),
						"ids" => array(
							"title" => __("Post IDs list", "themerex"),
							"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
							"dependency" => array(
								'custom' => array('no')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_tint" => array(
							"title" => __("Background tint", "themerex"),
							"desc" => __("Main background tint: dark or light", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['tint']
						),
						"bg_color" => array(
							"title" => __("Background color", "themerex"),
							"desc" => __("Any background color for this section", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image URL", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for the background", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "themerex"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "themerex"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "themerex"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "themerex"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_testimonials_item",
						"title" => __("Item", "themerex"),
						"desc" => __("Testimonials item", "themerex"),
						"container" => true,
						"params" => array(
							"author" => array(
								"title" => __("Author", "themerex"),
								"desc" => __("Name of the testimonmials author", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"link" => array(
								"title" => __("Link", "themerex"),
								"desc" => __("Link URL to the testimonmials author page", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"email" => array(
								"title" => __("E-mail", "themerex"),
								"desc" => __("E-mail of the testimonmials author (to get gravatar)", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"photo" => array(
								"title" => __("Photo", "themerex"),
								"desc" => __("Select or upload photo of testimonmials author or write URL of photo from other site", "themerex"),
								"value" => "",
								"type" => "media"
							),
							"_content_" => array(
								"title" => __("Testimonials text", "themerex"),
								"desc" => __("Current testimonials text", "themerex"),
								"divider" => true,
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
				// Title
				"trx_title" => array(
					"title" => __("Title", "themerex"),
					"desc" => __("Create header tag (1-6 level) with many styles", "themerex"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"_content_" => array(
							"title" => __("Title content", "themerex"),
							"desc" => __("Title content", "themerex"),
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"type" => array(
							"title" => __("Title type", "themerex"),
							"desc" => __("Title type (header level)", "themerex"),
							"divider" => true,
							"value" => "1",
							"type" => "select",
							"options" => array(
								'1' => __('Header 1', 'themerex'),
								'2' => __('Header 2', 'themerex'),
								'3' => __('Header 3', 'themerex'),
								'4' => __('Header 4', 'themerex'),
								'5' => __('Header 5', 'themerex'),
								'6' => __('Header 6', 'themerex'),
							)
						),
						"style" => array(
							"title" => __("Title style", "themerex"),
							"desc" => __("Title style", "themerex"),
							"value" => "regular",
							"type" => "select",
							"options" => array(
								'regular' => __('Regular', 'themerex'),
								'underline' => __('Underline', 'themerex'),
								'divider' => __('Divider', 'themerex'),
								'iconed' => __('With icon (image)', 'themerex')
							)
						),
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Title text alignment", "themerex"),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						), 
						"font_size" => array(
							"title" => __("Font_size", "themerex"),
							"desc" => __("Custom font size. If empty - use theme default", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"font_weight" => array(
							"title" => __("Font weight", "themerex"),
							"desc" => __("Custom font weight. If empty or inherit - use theme default", "themerex"),
							"value" => "",
							"type" => "select",
							"size" => "medium",
							"options" => array(
								'inherit' => __('Default', 'themerex'),
								'100' => __('Thin (100)', 'themerex'),
								'300' => __('Light (300)', 'themerex'),
								'400' => __('Normal (400)', 'themerex'),
								'600' => __('Semibold (600)', 'themerex'),
								'700' => __('Bold (700)', 'themerex'),
								'900' => __('Black (900)', 'themerex')
							)
						),
						"color" => array(
							"title" => __("Title color", "themerex"),
							"desc" => __("Select color for the title", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"icon" => array(
							"title" => __('Title font icon',  'themerex'),
							"desc" => __("Select font icon for the title from Fontello icons set (if style=iconed)",  'themerex'),
							"dependency" => array(
								'style' => array('iconed')
							),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"image" => array(
							"title" => __('or image icon',  'themerex'),
							"desc" => __("Select image icon for the title instead icon above (if style=iconed)",  'themerex'),
							"dependency" => array(
								'style' => array('iconed')
							),
							"value" => "",
							"type" => "images",
							"size" => "small",
							"options" => $THEMEREX_GLOBALS['sc_params']['images']
						),
						"picture" => array(
							"title" => __('or URL for image file', "themerex"),
							"desc" => __("Select or upload image or write URL from other site (if style=iconed)", "themerex"),
							"dependency" => array(
								'style' => array('iconed')
							),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"image_size" => array(
							"title" => __('Image (picture) size', "themerex"),
							"desc" => __("Select image (picture) size (if style='iconed')", "themerex"),
							"dependency" => array(
								'style' => array('iconed')
							),
							"value" => "small",
							"type" => "checklist",
							"options" => array(
								'small' => __('Small', 'themerex'),
								'medium' => __('Medium', 'themerex'),
								'large' => __('Large', 'themerex')
							)
						),
						"position" => array(
							"title" => __('Icon (image) position', "themerex"),
							"desc" => __("Select icon (image) position (if style=iconed)", "themerex"),
							"dependency" => array(
								'style' => array('iconed')
							),
							"value" => "left",
							"type" => "checklist",
							"options" => array(
								'top' => __('Top', 'themerex'),
								'left' => __('Left', 'themerex')
							)
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
			
				// Toggles
				"trx_toggles" => array(
					"title" => __("Toggles", "themerex"),
					"desc" => __("Toggles items", "themerex"),
					"decorate" => true,
					"container" => false,
					"params" => array(
						"style" => array(
							"title" => __("Toggles style", "themerex"),
							"desc" => __("Select style for display toggles", "themerex"),
							"value" => 1,
							"options" => array(
								1 => __('Style 1', 'themerex'),
								2 => __('Style 2', 'themerex')
							),
							"type" => "radio"
						),
						"counter" => array(
							"title" => __("Counter", "themerex"),
							"desc" => __("Display counter before each toggles title", "themerex"),
							"value" => "off",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['on_off']
						),
						"icon_closed" => array(
							"title" => __("Icon while closed",  'themerex'),
							"desc" => __('Select icon for the closed toggles item from Fontello icons set',  'themerex'),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"icon_opened" => array(
							"title" => __("Icon while opened",  'themerex'),
							"desc" => __('Select icon for the opened toggles item from Fontello icons set',  'themerex'),
							"value" => "",
							"type" => "icons",
							"options" => $THEMEREX_GLOBALS['sc_params']['icons']
						),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					),
					"children" => array(
						"name" => "trx_toggles_item",
						"title" => __("Toggles item", "themerex"),
						"desc" => __("Toggles item", "themerex"),
						"container" => true,
						"params" => array(
							"title" => array(
								"title" => __("Toggles item title", "themerex"),
								"desc" => __("Title for current toggles item", "themerex"),
								"value" => "",
								"type" => "text"
							),
							"open" => array(
								"title" => __("Open on show", "themerex"),
								"desc" => __("Open current toggles item on show", "themerex"),
								"value" => "no",
								"type" => "switch",
								"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
							),
							"icon_closed" => array(
								"title" => __("Icon while closed",  'themerex'),
								"desc" => __('Select icon for the closed toggles item from Fontello icons set',  'themerex'),
								"value" => "",
								"type" => "icons",
								"options" => $THEMEREX_GLOBALS['sc_params']['icons']
							),
							"icon_opened" => array(
								"title" => __("Icon while opened",  'themerex'),
								"desc" => __('Select icon for the opened toggles item from Fontello icons set',  'themerex'),
								"value" => "",
								"type" => "icons",
								"options" => $THEMEREX_GLOBALS['sc_params']['icons']
							),
							"_content_" => array(
								"title" => __("Toggles item content", "themerex"),
								"desc" => __("Current toggles item content", "themerex"),
								"rows" => 4,
								"value" => "",
								"type" => "textarea"
							),
							"id" => $THEMEREX_GLOBALS['sc_params']['id'],
							"class" => $THEMEREX_GLOBALS['sc_params']['class'],
							"css" => $THEMEREX_GLOBALS['sc_params']['css']
						)
					)
				),
			
			
			
			
			
				// Tooltip
				"trx_tooltip" => array(
					"title" => __("Tooltip", "themerex"),
					"desc" => __("Create tooltip for selected text", "themerex"),
					"decorate" => false,
					"container" => true,
					"params" => array(
						"title" => array(
							"title" => __("Title", "themerex"),
							"desc" => __("Tooltip title (required)", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"_content_" => array(
							"title" => __("Tipped content", "themerex"),
							"desc" => __("Highlighted content with tooltip", "themerex"),
							"divider" => true,
							"rows" => 4,
							"value" => "",
							"type" => "textarea"
						),
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Twitter
				"trx_twitter" => array(
					"title" => __("Twitter", "themerex"),
					"desc" => __("Insert twitter feed into post (page)", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"user" => array(
							"title" => __("Twitter Username", "themerex"),
							"desc" => __("Your username in the twitter account. If empty - get it from Theme Options.", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"consumer_key" => array(
							"title" => __("Consumer Key", "themerex"),
							"desc" => __("Consumer Key from the twitter account", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"consumer_secret" => array(
							"title" => __("Consumer Secret", "themerex"),
							"desc" => __("Consumer Secret from the twitter account", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"token_key" => array(
							"title" => __("Token Key", "themerex"),
							"desc" => __("Token Key from the twitter account", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"token_secret" => array(
							"title" => __("Token Secret", "themerex"),
							"desc" => __("Token Secret from the twitter account", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"count" => array(
							"title" => __("Tweets number", "themerex"),
							"desc" => __("Tweets number to show", "themerex"),
							"divider" => true,
							"value" => 3,
							"max" => 20,
							"min" => 1,
							"type" => "spinner"
						),
						"controls" => array(
							"title" => __("Show arrows", "themerex"),
							"desc" => __("Show control buttons", "themerex"),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"interval" => array(
							"title" => __("Tweets change interval", "themerex"),
							"desc" => __("Tweets change interval (in milliseconds: 1000ms = 1s)", "themerex"),
							"value" => 7000,
							"step" => 500,
							"min" => 0,
							"type" => "spinner"
						),
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Alignment of the tweets block", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						),
						"autoheight" => array(
							"title" => __("Autoheight", "themerex"),
							"desc" => __("Change whole slider's height (make it equal current slide's height)", "themerex"),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						),
						"bg_tint" => array(
							"title" => __("Background tint", "themerex"),
							"desc" => __("Main background tint: dark or light", "themerex"),
							"divider" => true,
							"value" => "",
							"type" => "checklist",
							"options" => $THEMEREX_GLOBALS['sc_params']['tint']
						),
						"bg_color" => array(
							"title" => __("Background color", "themerex"),
							"desc" => __("Any background color for this section", "themerex"),
							"value" => "",
							"type" => "color"
						),
						"bg_image" => array(
							"title" => __("Background image URL", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for the background", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_overlay" => array(
							"title" => __("Overlay", "themerex"),
							"desc" => __("Overlay color opacity (from 0.0 to 1.0)", "themerex"),
							"min" => "0",
							"max" => "1",
							"step" => "0.1",
							"value" => "0",
							"type" => "spinner"
						),
						"bg_texture" => array(
							"title" => __("Texture", "themerex"),
							"desc" => __("Predefined texture style from 1 to 11. 0 - without texture.", "themerex"),
							"min" => "0",
							"max" => "11",
							"step" => "1",
							"value" => "0",
							"type" => "spinner"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
				// Video
				"trx_video" => array(
					"title" => __("Video", "themerex"),
					"desc" => __("Insert video player", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"url" => array(
							"title" => __("URL for video file", "themerex"),
							"desc" => __("Select video from media library or paste URL for video file from other site", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media",
							"before" => array(
								'title' => __('Choose video', 'themerex'),
								'action' => 'media_upload',
								'type' => 'video',
								'multiple' => false,
								'linked_field' => '',
								'captions' => array( 	
									'choose' => __('Choose video file', 'themerex'),
									'update' => __('Select video file', 'themerex')
								)
							),
							"after" => array(
								'icon' => 'icon-cancel',
								'action' => 'media_reset'
							)
						),
						"ratio" => array(
							"title" => __("Ratio", "themerex"),
							"desc" => __("Ratio of the video", "themerex"),
							"value" => "16:9",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => array(
								"16:9" => __("16:9", 'themerex'),
								"4:3" => __("4:3", 'themerex')
							)
						),
						"autoplay" => array(
							"title" => __("Autoplay video", "themerex"),
							"desc" => __("Autoplay video on page load", "themerex"),
							"value" => "off",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['on_off']
						),
						"align" => array(
							"title" => __("Align", "themerex"),
							"desc" => __("Select block alignment", "themerex"),
							"value" => "none",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['align']
						),
						"image" => array(
							"title" => __("Cover image", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for video preview", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_image" => array(
							"title" => __("Background image", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for video background. Attention! If you use background image - specify paddings below from background margins to video block in percents!", "themerex"),
							"divider" => true,
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_top" => array(
							"title" => __("Top offset", "themerex"),
							"desc" => __("Top offset (padding) inside background image to video block (in percent). For example: 3%", "themerex"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_bottom" => array(
							"title" => __("Bottom offset", "themerex"),
							"desc" => __("Bottom offset (padding) inside background image to video block (in percent). For example: 3%", "themerex"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_left" => array(
							"title" => __("Left offset", "themerex"),
							"desc" => __("Left offset (padding) inside background image to video block (in percent). For example: 20%", "themerex"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_right" => array(
							"title" => __("Right offset", "themerex"),
							"desc" => __("Right offset (padding) inside background image to video block (in percent). For example: 12%", "themerex"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				),
			
			
			
			
				// Zoom
				"trx_zoom" => array(
					"title" => __("Zoom", "themerex"),
					"desc" => __("Insert the image with zoom/lens effect", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"effect" => array(
							"title" => __("Effect", "themerex"),
							"desc" => __("Select effect to display overlapping image", "themerex"),
							"value" => "lens",
							"size" => "medium",
							"type" => "switch",
							"options" => array(
								"lens" => __('Lens', 'themerex'),
								"zoom" => __('Zoom', 'themerex')
							)
						),
						"url" => array(
							"title" => __("Main image", "themerex"),
							"desc" => __("Select or upload main image", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"over" => array(
							"title" => __("Overlaping image", "themerex"),
							"desc" => __("Select or upload overlaping image", "themerex"),
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"align" => array(
							"title" => __("Float zoom", "themerex"),
							"desc" => __("Float zoom to left or right side", "themerex"),
							"value" => "",
							"type" => "checklist",
							"dir" => "horizontal",
							"options" => $THEMEREX_GLOBALS['sc_params']['float']
						), 
						"bg_image" => array(
							"title" => __("Background image", "themerex"),
							"desc" => __("Select or upload image or write URL from other site for zoom block background. Attention! If you use background image - specify paddings below from background margins to zoom block in percents!", "themerex"),
							"divider" => true,
							"readonly" => false,
							"value" => "",
							"type" => "media"
						),
						"bg_top" => array(
							"title" => __("Top offset", "themerex"),
							"desc" => __("Top offset (padding) inside background image to zoom block (in percent). For example: 3%", "themerex"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_bottom" => array(
							"title" => __("Bottom offset", "themerex"),
							"desc" => __("Bottom offset (padding) inside background image to zoom block (in percent). For example: 3%", "themerex"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_left" => array(
							"title" => __("Left offset", "themerex"),
							"desc" => __("Left offset (padding) inside background image to zoom block (in percent). For example: 20%", "themerex"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"bg_right" => array(
							"title" => __("Right offset", "themerex"),
							"desc" => __("Right offset (padding) inside background image to zoom block (in percent). For example: 12%", "themerex"),
							"dependency" => array(
								'bg_image' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"width" => themerex_shortcodes_width(),
						"height" => themerex_shortcodes_height(),
						"top" => $THEMEREX_GLOBALS['sc_params']['top'],
						"bottom" => $THEMEREX_GLOBALS['sc_params']['bottom'],
						"left" => $THEMEREX_GLOBALS['sc_params']['left'],
						"right" => $THEMEREX_GLOBALS['sc_params']['right'],
						"id" => $THEMEREX_GLOBALS['sc_params']['id'],
						"class" => $THEMEREX_GLOBALS['sc_params']['class'],
						"animation" => $THEMEREX_GLOBALS['sc_params']['animation'],
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				)
			);
	
			// Woocommerce Shortcodes list
			//------------------------------------------------------------------
			if (themerex_exists_woocommerce()) {
				
				// WooCommerce - Cart
				$THEMEREX_GLOBALS['shortcodes']["woocommerce_cart"] = array(
					"title" => __("Woocommerce: Cart", "themerex"),
					"desc" => __("WooCommerce shortcode: show Cart page", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array()
				);
				
				// WooCommerce - Checkout
				$THEMEREX_GLOBALS['shortcodes']["woocommerce_checkout"] = array(
					"title" => __("Woocommerce: Checkout", "themerex"),
					"desc" => __("WooCommerce shortcode: show Checkout page", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array()
				);
				
				// WooCommerce - My Account
				$THEMEREX_GLOBALS['shortcodes']["woocommerce_my_account"] = array(
					"title" => __("Woocommerce: My Account", "themerex"),
					"desc" => __("WooCommerce shortcode: show My Account page", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array()
				);
				
				// WooCommerce - Order Tracking
				$THEMEREX_GLOBALS['shortcodes']["woocommerce_order_tracking"] = array(
					"title" => __("Woocommerce: Order Tracking", "themerex"),
					"desc" => __("WooCommerce shortcode: show Order Tracking page", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array()
				);
				
				// WooCommerce - Shop Messages
				$THEMEREX_GLOBALS['shortcodes']["shop_messages"] = array(
					"title" => __("Woocommerce: Shop Messages", "themerex"),
					"desc" => __("WooCommerce shortcode: show shop messages", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array()
				);
				
				// WooCommerce - Product Page
				$THEMEREX_GLOBALS['shortcodes']["product_page"] = array(
					"title" => __("Woocommerce: Product Page", "themerex"),
					"desc" => __("WooCommerce shortcode: display single product page", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"sku" => array(
							"title" => __("SKU", "themerex"),
							"desc" => __("SKU code of displayed product", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"id" => array(
							"title" => __("ID", "themerex"),
							"desc" => __("ID of displayed product", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"posts_per_page" => array(
							"title" => __("Number", "themerex"),
							"desc" => __("How many products showed", "themerex"),
							"value" => "1",
							"min" => 1,
							"type" => "spinner"
						),
						"post_type" => array(
							"title" => __("Post type", "themerex"),
							"desc" => __("Post type for the WP query (leave 'product')", "themerex"),
							"value" => "product",
							"type" => "text"
						),
						"post_status" => array(
							"title" => __("Post status", "themerex"),
							"desc" => __("Display posts only with this status", "themerex"),
							"value" => "publish",
							"type" => "select",
							"options" => array(
								"publish" => __('Publish', 'themerex'),
								"protected" => __('Protected', 'themerex'),
								"private" => __('Private', 'themerex'),
								"pending" => __('Pending', 'themerex'),
								"draft" => __('Draft', 'themerex')
							)
						)
					)
				);
				
				// WooCommerce - Product
				$THEMEREX_GLOBALS['shortcodes']["product"] = array(
					"title" => __("Woocommerce: Product", "themerex"),
					"desc" => __("WooCommerce shortcode: display one product", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"sku" => array(
							"title" => __("SKU", "themerex"),
							"desc" => __("SKU code of displayed product", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"id" => array(
							"title" => __("ID", "themerex"),
							"desc" => __("ID of displayed product", "themerex"),
							"value" => "",
							"type" => "text"
						)
					)
				);
				
				// WooCommerce - Best Selling Products
				$THEMEREX_GLOBALS['shortcodes']["best_selling_products"] = array(
					"title" => __("Woocommerce: Best Selling Products", "themerex"),
					"desc" => __("WooCommerce shortcode: show best selling products", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "themerex"),
							"desc" => __("How many products showed", "themerex"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns per row use for products output", "themerex"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						)
					)
				);
				
				// WooCommerce - Recent Products
				$THEMEREX_GLOBALS['shortcodes']["recent_products"] = array(
					"title" => __("Woocommerce: Recent Products", "themerex"),
					"desc" => __("WooCommerce shortcode: show recent products", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "themerex"),
							"desc" => __("How many products showed", "themerex"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns per row use for products output", "themerex"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'themerex'),
								"title" => __('Title', 'themerex')
							)
						),
						"order" => array(
							"title" => __("Order", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						)
					)
				);
				
				// WooCommerce - Related Products
				$THEMEREX_GLOBALS['shortcodes']["related_products"] = array(
					"title" => __("Woocommerce: Related Products", "themerex"),
					"desc" => __("WooCommerce shortcode: show related products", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"posts_per_page" => array(
							"title" => __("Number", "themerex"),
							"desc" => __("How many products showed", "themerex"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns per row use for products output", "themerex"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'themerex'),
								"title" => __('Title', 'themerex')
							)
						)
					)
				);
				
				// WooCommerce - Featured Products
				$THEMEREX_GLOBALS['shortcodes']["featured_products"] = array(
					"title" => __("Woocommerce: Featured Products", "themerex"),
					"desc" => __("WooCommerce shortcode: show featured products", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "themerex"),
							"desc" => __("How many products showed", "themerex"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns per row use for products output", "themerex"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'themerex'),
								"title" => __('Title', 'themerex')
							)
						),
						"order" => array(
							"title" => __("Order", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						)
					)
				);
				
				// WooCommerce - Top Rated Products
				$THEMEREX_GLOBALS['shortcodes']["featured_products"] = array(
					"title" => __("Woocommerce: Top Rated Products", "themerex"),
					"desc" => __("WooCommerce shortcode: show top rated products", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "themerex"),
							"desc" => __("How many products showed", "themerex"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns per row use for products output", "themerex"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'themerex'),
								"title" => __('Title', 'themerex')
							)
						),
						"order" => array(
							"title" => __("Order", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						)
					)
				);
				
				// WooCommerce - Sale Products
				$THEMEREX_GLOBALS['shortcodes']["featured_products"] = array(
					"title" => __("Woocommerce: Sale Products", "themerex"),
					"desc" => __("WooCommerce shortcode: list products on sale", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "themerex"),
							"desc" => __("How many products showed", "themerex"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns per row use for products output", "themerex"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'themerex'),
								"title" => __('Title', 'themerex')
							)
						),
						"order" => array(
							"title" => __("Order", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						)
					)
				);
				
				// WooCommerce - Product Category
				$THEMEREX_GLOBALS['shortcodes']["product_category"] = array(
					"title" => __("Woocommerce: Products from category", "themerex"),
					"desc" => __("WooCommerce shortcode: list products in specified category(-ies)", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "themerex"),
							"desc" => __("How many products showed", "themerex"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns per row use for products output", "themerex"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'themerex'),
								"title" => __('Title', 'themerex')
							)
						),
						"order" => array(
							"title" => __("Order", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						),
						"category" => array(
							"title" => __("Categories", "themerex"),
							"desc" => __("Comma separated category slugs", "themerex"),
							"value" => '',
							"type" => "text"
						),
						"operator" => array(
							"title" => __("Operator", "themerex"),
							"desc" => __("Categories operator", "themerex"),
							"value" => "IN",
							"type" => "checklist",
							"size" => "medium",
							"options" => array(
								"IN" => __('IN', 'themerex'),
								"NOT IN" => __('NOT IN', 'themerex'),
								"AND" => __('AND', 'themerex')
							)
						)
					)
				);
				
				// WooCommerce - Products
				$THEMEREX_GLOBALS['shortcodes']["products"] = array(
					"title" => __("Woocommerce: Products", "themerex"),
					"desc" => __("WooCommerce shortcode: list all products", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"skus" => array(
							"title" => __("SKUs", "themerex"),
							"desc" => __("Comma separated SKU codes of products", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"ids" => array(
							"title" => __("IDs", "themerex"),
							"desc" => __("Comma separated ID of products", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns per row use for products output", "themerex"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'themerex'),
								"title" => __('Title', 'themerex')
							)
						),
						"order" => array(
							"title" => __("Order", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						)
					)
				);
				
				// WooCommerce - Product attribute
				$THEMEREX_GLOBALS['shortcodes']["product_attribute"] = array(
					"title" => __("Woocommerce: Products by Attribute", "themerex"),
					"desc" => __("WooCommerce shortcode: show products with specified attribute", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"per_page" => array(
							"title" => __("Number", "themerex"),
							"desc" => __("How many products showed", "themerex"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns per row use for products output", "themerex"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'themerex'),
								"title" => __('Title', 'themerex')
							)
						),
						"order" => array(
							"title" => __("Order", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						),
						"attribute" => array(
							"title" => __("Attribute", "themerex"),
							"desc" => __("Attribute name", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"filter" => array(
							"title" => __("Filter", "themerex"),
							"desc" => __("Attribute value", "themerex"),
							"value" => "",
							"type" => "text"
						)
					)
				);
				
				// WooCommerce - Products Categories
				$THEMEREX_GLOBALS['shortcodes']["product_categories"] = array(
					"title" => __("Woocommerce: Product Categories", "themerex"),
					"desc" => __("WooCommerce shortcode: show categories with products", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"number" => array(
							"title" => __("Number", "themerex"),
							"desc" => __("How many categories showed", "themerex"),
							"value" => 4,
							"min" => 1,
							"type" => "spinner"
						),
						"columns" => array(
							"title" => __("Columns", "themerex"),
							"desc" => __("How many columns per row use for categories output", "themerex"),
							"value" => 4,
							"min" => 2,
							"max" => 4,
							"type" => "spinner"
						),
						"orderby" => array(
							"title" => __("Order by", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "date",
							"type" => "select",
							"options" => array(
								"date" => __('Date', 'themerex'),
								"title" => __('Title', 'themerex')
							)
						),
						"order" => array(
							"title" => __("Order", "themerex"),
							"desc" => __("Sorting order for products output", "themerex"),
							"value" => "desc",
							"type" => "switch",
							"size" => "big",
							"options" => $THEMEREX_GLOBALS['sc_params']['ordering']
						),
						"parent" => array(
							"title" => __("Parent", "themerex"),
							"desc" => __("Parent category slug", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"ids" => array(
							"title" => __("IDs", "themerex"),
							"desc" => __("Comma separated ID of products", "themerex"),
							"value" => "",
							"type" => "text"
						),
						"hide_empty" => array(
							"title" => __("Hide empty", "themerex"),
							"desc" => __("Hide empty categories", "themerex"),
							"value" => "yes",
							"type" => "switch",
							"options" => $THEMEREX_GLOBALS['sc_params']['yes_no']
						)
					)
				);

			}
			
			do_action('themerex_action_shortcodes_list');

		}
	}
}
?>