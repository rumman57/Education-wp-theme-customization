<?php
/**
 * ThemeREX Framework: return lists
 *
 * @package themerex
 * @since themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Return list of the animations
if ( !function_exists( 'themerex_get_list_animations' ) ) {
	function themerex_get_list_animations($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_animations']))
			$list = $THEMEREX_GLOBALS['list_animations'];
		else {
			$list = array();
			$list['none']			= __('- None -',	'themerex');
			$list['bounced']		= __('Bounced',		'themerex');
			$list['flash']			= __('Flash',		'themerex');
			$list['flip']			= __('Flip',		'themerex');
			$list['pulse']			= __('Pulse',		'themerex');
			$list['rubberBand']		= __('Rubber Band',	'themerex');
			$list['shake']			= __('Shake',		'themerex');
			$list['swing']			= __('Swing',		'themerex');
			$list['tada']			= __('Tada',		'themerex');
			$list['wobble']			= __('Wobble',		'themerex');
			$THEMEREX_GLOBALS['list_animations'] = $list = apply_filters('themerex_filter_list_animations', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}


// Return list of the enter animations
if ( !function_exists( 'themerex_get_list_animations_in' ) ) {
	function themerex_get_list_animations_in($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_animations_in']))
			$list = $THEMEREX_GLOBALS['list_animations_in'];
		else {
			$list = array();
			$list['none']			= __('- None -',	'themerex');
			$list['bounceIn']		= __('Bounce In',			'themerex');
			$list['bounceInUp']		= __('Bounce In Up',		'themerex');
			$list['bounceInDown']	= __('Bounce In Down',		'themerex');
			$list['bounceInLeft']	= __('Bounce In Left',		'themerex');
			$list['bounceInRight']	= __('Bounce In Right',		'themerex');
			$list['fadeIn']			= __('Fade In',				'themerex');
			$list['fadeInUp']		= __('Fade In Up',			'themerex');
			$list['fadeInDown']		= __('Fade In Down',		'themerex');
			$list['fadeInLeft']		= __('Fade In Left',		'themerex');
			$list['fadeInRight']	= __('Fade In Right',		'themerex');
			$list['fadeInUpBig']	= __('Fade In Up Big',		'themerex');
			$list['fadeInDownBig']	= __('Fade In Down Big',	'themerex');
			$list['fadeInLeftBig']	= __('Fade In Left Big',	'themerex');
			$list['fadeInRightBig']	= __('Fade In Right Big',	'themerex');
			$list['flipInX']		= __('Flip In X',			'themerex');
			$list['flipInY']		= __('Flip In Y',			'themerex');
			$list['lightSpeedIn']	= __('Light Speed In',		'themerex');
			$list['rotateIn']		= __('Rotate In',			'themerex');
			$list['rotateInUpLeft']		= __('Rotate In Down Left',	'themerex');
			$list['rotateInUpRight']	= __('Rotate In Up Right',	'themerex');
			$list['rotateInDownLeft']	= __('Rotate In Up Left',	'themerex');
			$list['rotateInDownRight']	= __('Rotate In Down Right','themerex');
			$list['rollIn']				= __('Roll In',			'themerex');
			$list['slideInUp']			= __('Slide In Up',		'themerex');
			$list['slideInDown']		= __('Slide In Down',	'themerex');
			$list['slideInLeft']		= __('Slide In Left',	'themerex');
			$list['slideInRight']		= __('Slide In Right',	'themerex');
			$list['zoomIn']				= __('Zoom In',			'themerex');
			$list['zoomInUp']			= __('Zoom In Up',		'themerex');
			$list['zoomInDown']			= __('Zoom In Down',	'themerex');
			$list['zoomInLeft']			= __('Zoom In Left',	'themerex');
			$list['zoomInRight']		= __('Zoom In Right',	'themerex');
			$THEMEREX_GLOBALS['list_animations_in'] = $list = apply_filters('themerex_filter_list_animations_in', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}


// Return list of the out animations
if ( !function_exists( 'themerex_get_list_animations_out' ) ) {
	function themerex_get_list_animations_out($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_animations_out']))
			$list = $THEMEREX_GLOBALS['list_animations_out'];
		else {
			$list = array();
			$list['none']			= __('- None -',	'themerex');
			$list['bounceOut']		= __('Bounce Out',			'themerex');
			$list['bounceOutUp']	= __('Bounce Out Up',		'themerex');
			$list['bounceOutDown']	= __('Bounce Out Down',		'themerex');
			$list['bounceOutLeft']	= __('Bounce Out Left',		'themerex');
			$list['bounceOutRight']	= __('Bounce Out Right',	'themerex');
			$list['fadeOut']		= __('Fade Out',			'themerex');
			$list['fadeOutUp']		= __('Fade Out Up',			'themerex');
			$list['fadeOutDown']	= __('Fade Out Down',		'themerex');
			$list['fadeOutLeft']	= __('Fade Out Left',		'themerex');
			$list['fadeOutRight']	= __('Fade Out Right',		'themerex');
			$list['fadeOutUpBig']	= __('Fade Out Up Big',		'themerex');
			$list['fadeOutDownBig']	= __('Fade Out Down Big',	'themerex');
			$list['fadeOutLeftBig']	= __('Fade Out Left Big',	'themerex');
			$list['fadeOutRightBig']= __('Fade Out Right Big',	'themerex');
			$list['flipOutX']		= __('Flip Out X',			'themerex');
			$list['flipOutY']		= __('Flip Out Y',			'themerex');
			$list['hinge']			= __('Hinge Out',			'themerex');
			$list['lightSpeedOut']	= __('Light Speed Out',		'themerex');
			$list['rotateOut']		= __('Rotate Out',			'themerex');
			$list['rotateOutUpLeft']	= __('Rotate Out Down Left',	'themerex');
			$list['rotateOutUpRight']	= __('Rotate Out Up Right',		'themerex');
			$list['rotateOutDownLeft']	= __('Rotate Out Up Left',		'themerex');
			$list['rotateOutDownRight']	= __('Rotate Out Down Right',	'themerex');
			$list['rollOut']			= __('Roll Out',		'themerex');
			$list['slideOutUp']			= __('Slide Out Up',		'themerex');
			$list['slideOutDown']		= __('Slide Out Down',	'themerex');
			$list['slideOutLeft']		= __('Slide Out Left',	'themerex');
			$list['slideOutRight']		= __('Slide Out Right',	'themerex');
			$list['zoomOut']			= __('Zoom Out',			'themerex');
			$list['zoomOutUp']			= __('Zoom Out Up',		'themerex');
			$list['zoomOutDown']		= __('Zoom Out Down',	'themerex');
			$list['zoomOutLeft']		= __('Zoom Out Left',	'themerex');
			$list['zoomOutRight']		= __('Zoom Out Right',	'themerex');
			$THEMEREX_GLOBALS['list_animations_out'] = $list = apply_filters('themerex_filter_list_animations_out', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}


// Return list of categories
if ( !function_exists( 'themerex_get_list_categories' ) ) {
	function themerex_get_list_categories($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_categories']))
			$list = $THEMEREX_GLOBALS['list_categories'];
		else {
			$list = array();
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false );
			$taxonomies = get_categories( $args );
			foreach ($taxonomies as $cat) {
				$list[$cat->term_id] = $cat->name;
			}
			$THEMEREX_GLOBALS['list_categories'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'themerex_get_list_terms' ) ) {
	function themerex_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_taxonomies_'.($taxonomy)]))
			$list = $THEMEREX_GLOBALS['list_taxonomies_'.($taxonomy)];
		else {
			$list = array();
			$args = array(
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => $taxonomy,
				'pad_counts'               => false );
			$taxonomies = get_terms( $taxonomy, $args );
			foreach ($taxonomies as $cat) {
				$list[$cat->term_id] = $cat->name;	// . ($taxonomy!='category' ? ' /'.($cat->taxonomy).'/' : '');
			}
			$THEMEREX_GLOBALS['list_taxonomies_'.($taxonomy)] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'themerex_get_list_posts_types' ) ) {
	function themerex_get_list_posts_types($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_posts_types']))
			$list = $THEMEREX_GLOBALS['list_posts_types'];
		else {
			$list = array();
			/* 
			// This way to return all registered post types
			$types = get_post_types();
			if (in_array('post', $types)) $list['post'] = __('Post', 'themerex');
			foreach ($types as $t) {
				if ($t == 'post') continue;
				$list[$t] = themerex_strtoproper($t);
			}
			*/
			// Return only theme inheritance supported post types
			$THEMEREX_GLOBALS['list_posts_types'] = $list = apply_filters('themerex_filter_list_post_types', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'themerex_get_list_posts' ) ) {
	function themerex_get_list_posts($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'taxonomy'			=> 'category',
			'taxonomy_value'	=> '',
			'posts_per_page'	=> -1,
			'orderby'			=> 'post_date',
			'order'				=> 'desc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));

		global $THEMEREX_GLOBALS;
		$hash = 'list_posts_'.($opt['post_type']).'_'.($opt['taxonomy']).'_'.($opt['taxonomy_value']).'_'.($opt['orderby']).'_'.($opt['order']).'_'.($opt['return']).'_'.($opt['posts_per_page']);
		if (isset($THEMEREX_GLOBALS[$hash]))
			$list = $THEMEREX_GLOBALS[$hash];
		else {
			$list = array();
			$list['none'] = __("- Not selected -", 'themerex');
			$args = array(
				'post_type' => $opt['post_type'],
				'post_status' => $opt['post_status'],
				'posts_per_page' => $opt['posts_per_page'],
				'ignore_sticky_posts' => true,
				'orderby'	=> $opt['orderby'],
				'order'		=> $opt['order']
			);
			if (!empty($opt['taxonomy_value'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $opt['taxonomy'],
						'field' => (int) $opt['taxonomy_value'] > 0 ? 'id' : 'slug',
						'terms' => $opt['taxonomy_value']
					)
				);
			}
			$posts = get_posts( $args );
			foreach ($posts as $post) {
				$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
			}
			$THEMEREX_GLOBALS[$hash] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}


// Return list of registered users
if ( !function_exists( 'themerex_get_list_users' ) ) {
	function themerex_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_users']))
			$list = $THEMEREX_GLOBALS['list_users'];
		else {
			$list = array();
			$list['none'] = __("- Not selected -", 'themerex');
			$args = array(
				'orderby'	=> 'display_name',
				'order'		=> 'ASC' );
			$users = get_users( $args );
			foreach ($users as $user) {
				$accept = true;
				if (is_array($user->roles)) {
					if (count($user->roles) > 0) {
						$accept = false;
						foreach ($user->roles as $role) {
							if (in_array($role, $roles)) {
								$accept = true;
								break;
							}
						}
					}
				}
				if ($accept) $list[$user->user_login] = $user->display_name;
			}
			$THEMEREX_GLOBALS['list_users'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}


// Return sliders list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'themerex_get_list_sliders' ) ) {
	function themerex_get_list_sliders($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_sliders']))
			$list = $THEMEREX_GLOBALS['list_sliders'];
		else {
			$list = array();
			$list["swiper"] = __("Posts slider (Swiper)", 'themerex');
			if (themerex_exists_revslider())
				$list["revo"] = __("Layer slider (Revolution)", 'themerex');
			if (themerex_exists_royalslider())
				$list["royal"] = __("Layer slider (Royal)", 'themerex');
			$THEMEREX_GLOBALS['list_sliders'] = $list = apply_filters('themerex_filter_list_sliders', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list with popup engines
if ( !function_exists( 'themerex_get_list_popup_engines' ) ) {
	function themerex_get_list_popup_engines($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_popup_engines']))
			$list = $THEMEREX_GLOBALS['list_popup_engines'];
		else {
			$list = array();
			$list["pretty"] = __("Pretty photo", 'themerex');
			$list["magnific"] = __("Magnific popup", 'themerex');
			$THEMEREX_GLOBALS['list_popup_engines'] = $list = apply_filters('themerex_filter_list_popup_engines', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'themerex_get_list_menus' ) ) {
	function themerex_get_list_menus($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_menus']))
			$list = $THEMEREX_GLOBALS['list_menus'];
		else {
			$list = array();
			$list['default'] = __("Default", 'themerex');
			$menus = wp_get_nav_menus();
			if ($menus) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			$THEMEREX_GLOBALS['list_menus'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'themerex_get_list_sidebars' ) ) {
	function themerex_get_list_sidebars($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_sidebars'])) {
			$list = $THEMEREX_GLOBALS['list_sidebars'];
		} else {
			$list = isset($THEMEREX_GLOBALS['registered_sidebars']) ? $THEMEREX_GLOBALS['registered_sidebars'] : array();
			$THEMEREX_GLOBALS['list_sidebars'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'themerex_get_list_sidebars_positions' ) ) {
	function themerex_get_list_sidebars_positions($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_sidebars_positions']))
			$list = $THEMEREX_GLOBALS['list_sidebars_positions'];
		else {
			$list = array();
			$list['left']  = __('Left',  'themerex');
			$list['right'] = __('Right', 'themerex');
			$THEMEREX_GLOBALS['list_sidebars_positions'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return sidebars class
if ( !function_exists( 'themerex_get_sidebar_class' ) ) {
	function themerex_get_sidebar_class($style, $pos) {
		return themerex_sc_param_is_off($style) ? 'sidebar_hide' : 'sidebar_show sidebar_'.($pos);
	}
}

// Return body styles list, prepended inherit
if ( !function_exists( 'themerex_get_list_body_styles' ) ) {
	function themerex_get_list_body_styles($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_body_styles']))
			$list = $THEMEREX_GLOBALS['list_body_styles'];
		else {
			$list = array();
			$list['boxed']		= __('Boxed',		'themerex');
			$list['wide']		= __('Wide',		'themerex');
			$list['fullwide']	= __('Fullwide',	'themerex');
			$list['fullscreen']	= __('Fullscreen',	'themerex');
			$THEMEREX_GLOBALS['list_body_styles'] = $list = apply_filters('themerex_filter_list_body_styles', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return skins list, prepended inherit
if ( !function_exists( 'themerex_get_list_skins' ) ) {
	function themerex_get_list_skins($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_skins']))
			$list = $THEMEREX_GLOBALS['list_skins'];
		else
			$THEMEREX_GLOBALS['list_skins'] = $list = themerex_get_list_folders("skins");
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return css-themes list
if ( !function_exists( 'themerex_get_list_themes' ) ) {
	function themerex_get_list_themes($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_themes']))
			$list = $THEMEREX_GLOBALS['list_themes'];
		else
			$THEMEREX_GLOBALS['list_themes'] = $list = themerex_get_list_files("css/themes");
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return templates list, prepended inherit
if ( !function_exists( 'themerex_get_list_templates' ) ) {
	function themerex_get_list_templates($mode='') {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_templates_'.($mode)]))
			$list = $THEMEREX_GLOBALS['list_templates_'.($mode)];
		else {
			$list = array();
			foreach ($THEMEREX_GLOBALS['registered_templates'] as $k=>$v) {
				if ($mode=='' || themerex_strpos($v['mode'], $mode)!==false)
					$list[$k] = !empty($v['title']) ? $v['title'] : themerex_strtoproper($v['layout']);
			}
			$THEMEREX_GLOBALS['list_templates_'.($mode)] = $list;
		}
		return $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'themerex_get_list_templates_blog' ) ) {
	function themerex_get_list_templates_blog($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_templates_blog']))
			$list = $THEMEREX_GLOBALS['list_templates_blog'];
		else {
			$list = themerex_get_list_templates('blog');
			$THEMEREX_GLOBALS['list_templates_blog'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return blogger styles list, prepended inherit
if ( !function_exists( 'themerex_get_list_templates_blogger' ) ) {
	function themerex_get_list_templates_blogger($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_templates_blogger']))
			$list = $THEMEREX_GLOBALS['list_templates_blogger'];
		else {
			$list = themerex_array_merge(themerex_get_list_templates('blogger'), themerex_get_list_templates('blog'));
			$THEMEREX_GLOBALS['list_templates_blogger'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return single page styles list, prepended inherit
if ( !function_exists( 'themerex_get_list_templates_single' ) ) {
	function themerex_get_list_templates_single($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_templates_single']))
			$list = $THEMEREX_GLOBALS['list_templates_single'];
		else {
			$list = themerex_get_list_templates('single');
			$THEMEREX_GLOBALS['list_templates_single'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return article styles list, prepended inherit
if ( !function_exists( 'themerex_get_list_article_styles' ) ) {
	function themerex_get_list_article_styles($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_article_styles']))
			$list = $THEMEREX_GLOBALS['list_article_styles'];
		else {
			$list = array();
			$list["boxed"]   = __('Boxed', 'themerex');
			$list["stretch"] = __('Stretch', 'themerex');
			$THEMEREX_GLOBALS['list_article_styles'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return color schemes list, prepended inherit
if ( !function_exists( 'themerex_get_list_color_schemes' ) ) {
	function themerex_get_list_color_schemes($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_color_schemes']))
			$list = $THEMEREX_GLOBALS['list_color_schemes'];
		else {
			$list = array();
			if (!empty($THEMEREX_GLOBALS['color_schemes'])) {
				foreach ($THEMEREX_GLOBALS['color_schemes'] as $k=>$v) {
					$list[$k] = $v['title'];
				}
			}
			$THEMEREX_GLOBALS['list_color_schemes'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return button styles list, prepended inherit
if ( !function_exists( 'themerex_get_list_button_styles' ) ) {
	function themerex_get_list_button_styles($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_button_styles']))
			$list = $THEMEREX_GLOBALS['list_button_styles'];
		else {
			$list = array();
			$list["custom"]	= __('Custom', 'themerex');
			$list["link"] 	= __('As links', 'themerex');
			$list["menu"] 	= __('As main menu', 'themerex');
			$list["user"] 	= __('As user menu', 'themerex');
			$THEMEREX_GLOBALS['list_button_styles'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return post-formats filters list, prepended inherit
if ( !function_exists( 'themerex_get_list_post_formats_filters' ) ) {
	function themerex_get_list_post_formats_filters($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_post_formats_filters']))
			$list = $THEMEREX_GLOBALS['list_post_formats_filters'];
		else {
			$list = array();
			$list["no"]      = __('All posts', 'themerex');
			$list["thumbs"]  = __('With thumbs', 'themerex');
			$list["reviews"] = __('With reviews', 'themerex');
			$list["video"]   = __('With videos', 'themerex');
			$list["audio"]   = __('With audios', 'themerex');
			$list["gallery"] = __('With galleries', 'themerex');
			$THEMEREX_GLOBALS['list_post_formats_filters'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return scheme color
if (!function_exists('themerex_get_scheme_color')) {
	function themerex_get_scheme_color($clr) {
		global $THEMEREX_GLOBALS;
		$scheme = themerex_get_custom_option('color_scheme');
		if (empty($scheme) || empty($THEMEREX_GLOBALS['color_schemes'][$scheme])) $scheme = 'original';
		return isset($THEMEREX_GLOBALS['color_schemes'][$scheme][$clr]) ? $THEMEREX_GLOBALS['color_schemes'][$scheme][$clr] : '';
	}
}

// Return portfolio filters list, prepended inherit
if ( !function_exists( 'themerex_get_list_portfolio_filters' ) ) {
	function themerex_get_list_portfolio_filters($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_portfolio_filters']))
			$list = $THEMEREX_GLOBALS['list_portfolio_filters'];
		else {
			$list = array();
			$list["hide"] = __('Hide', 'themerex');
			$list["tags"] = __('Tags', 'themerex');
			$list["categories"] = __('Categories', 'themerex');
			$THEMEREX_GLOBALS['list_portfolio_filters'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return hover styles list, prepended inherit
if ( !function_exists( 'themerex_get_list_hovers' ) ) {
	function themerex_get_list_hovers($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_hovers']))
			$list = $THEMEREX_GLOBALS['list_hovers'];
		else {
			$list = array();
			$list['circle effect1']  = __('Circle Effect 1',  'themerex');
			$list['circle effect2']  = __('Circle Effect 2',  'themerex');
			$list['circle effect3']  = __('Circle Effect 3',  'themerex');
			$list['circle effect4']  = __('Circle Effect 4',  'themerex');
			$list['circle effect5']  = __('Circle Effect 5',  'themerex');
			$list['circle effect6']  = __('Circle Effect 6',  'themerex');
			$list['circle effect7']  = __('Circle Effect 7',  'themerex');
			$list['circle effect8']  = __('Circle Effect 8',  'themerex');
			$list['circle effect9']  = __('Circle Effect 9',  'themerex');
			$list['circle effect10'] = __('Circle Effect 10',  'themerex');
			$list['circle effect11'] = __('Circle Effect 11',  'themerex');
			$list['circle effect12'] = __('Circle Effect 12',  'themerex');
			$list['circle effect13'] = __('Circle Effect 13',  'themerex');
			$list['circle effect14'] = __('Circle Effect 14',  'themerex');
			$list['circle effect15'] = __('Circle Effect 15',  'themerex');
			$list['circle effect16'] = __('Circle Effect 16',  'themerex');
			$list['circle effect17'] = __('Circle Effect 17',  'themerex');
			$list['circle effect18'] = __('Circle Effect 18',  'themerex');
			$list['circle effect19'] = __('Circle Effect 19',  'themerex');
			$list['circle effect20'] = __('Circle Effect 20',  'themerex');
			$list['square effect1']  = __('Square Effect 1',  'themerex');
			$list['square effect2']  = __('Square Effect 2',  'themerex');
			$list['square effect3']  = __('Square Effect 3',  'themerex');
	//		$list['square effect4']  = __('Square Effect 4',  'themerex');
			$list['square effect5']  = __('Square Effect 5',  'themerex');
			$list['square effect6']  = __('Square Effect 6',  'themerex');
			$list['square effect7']  = __('Square Effect 7',  'themerex');
			$list['square effect8']  = __('Square Effect 8',  'themerex');
			$list['square effect9']  = __('Square Effect 9',  'themerex');
			$list['square effect10'] = __('Square Effect 10',  'themerex');
			$list['square effect11'] = __('Square Effect 11',  'themerex');
			$list['square effect12'] = __('Square Effect 12',  'themerex');
			$list['square effect13'] = __('Square Effect 13',  'themerex');
			$list['square effect14'] = __('Square Effect 14',  'themerex');
			$list['square effect15'] = __('Square Effect 15',  'themerex');
			$list['square effect_dir']   = __('Square Effect Dir',   'themerex');
			$list['square effect_shift'] = __('Square Effect Shift', 'themerex');
			$list['square effect_book']  = __('Square Effect Book',  'themerex');
			$THEMEREX_GLOBALS['list_hovers'] = $list = apply_filters('themerex_filter_portfolio_hovers', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return extended hover directions list, prepended inherit
if ( !function_exists( 'themerex_get_list_hovers_directions' ) ) {
	function themerex_get_list_hovers_directions($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_hovers_directions']))
			$list = $THEMEREX_GLOBALS['list_hovers_directions'];
		else {
			$list = array();
			$list['left_to_right'] = __('Left to Right',  'themerex');
			$list['right_to_left'] = __('Right to Left',  'themerex');
			$list['top_to_bottom'] = __('Top to Bottom',  'themerex');
			$list['bottom_to_top'] = __('Bottom to Top',  'themerex');
			$list['scale_up']      = __('Scale Up',  'themerex');
			$list['scale_down']    = __('Scale Down',  'themerex');
			$list['scale_down_up'] = __('Scale Down-Up',  'themerex');
			$list['from_left_and_right'] = __('From Left and Right',  'themerex');
			$list['from_top_and_bottom'] = __('From Top and Bottom',  'themerex');
			$THEMEREX_GLOBALS['list_hovers_directions'] = $list = apply_filters('themerex_filter_portfolio_hovers_directions', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}


// Return list of the label positions in the custom forms
if ( !function_exists( 'themerex_get_list_label_positions' ) ) {
	function themerex_get_list_label_positions($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_label_positions']))
			$list = $THEMEREX_GLOBALS['list_label_positions'];
		else {
			$list = array();
			$list['top']	= __('Top',		'themerex');
			$list['bottom']	= __('Bottom',		'themerex');
			$list['left']	= __('Left',		'themerex');
			$list['over']	= __('Over',		'themerex');
			$THEMEREX_GLOBALS['list_label_positions'] = $list = apply_filters('themerex_filter_label_positions', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return background tints list, prepended inherit
if ( !function_exists( 'themerex_get_list_bg_tints' ) ) {
	function themerex_get_list_bg_tints($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_bg_tints']))
			$list = $THEMEREX_GLOBALS['list_bg_tints'];
		else {
			$list = array();
			$list['none']  = __('None',  'themerex');
			$list['light'] = __('Light','themerex');
			$list['dark']  = __('Dark',  'themerex');
			$THEMEREX_GLOBALS['list_bg_tints'] = $list = apply_filters('themerex_filter_bg_tints', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return background tints list for sidebars, prepended inherit
if ( !function_exists( 'themerex_get_list_sidebar_styles' ) ) {
	function themerex_get_list_sidebar_styles($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_sidebar_styles']))
			$list = $THEMEREX_GLOBALS['list_sidebar_styles'];
		else {
			$list = array();
			$list['none']  = __('None',  'themerex');
			$list['light white'] = __('White','themerex');
			$list['light'] = __('Light','themerex');
			$list['dark']  = __('Dark',  'themerex');
			$THEMEREX_GLOBALS['list_sidebar_styles'] = $list = apply_filters('themerex_filter_sidebar_styles', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return custom fields types list, prepended inherit
if ( !function_exists( 'themerex_get_list_field_types' ) ) {
	function themerex_get_list_field_types($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_field_types']))
			$list = $THEMEREX_GLOBALS['list_field_types'];
		else {
			$list = array();
			$list['text']     = __('Text',  'themerex');
			$list['textarea'] = __('Text Area','themerex');
			$list['password'] = __('Password',  'themerex');
			$list['radio']    = __('Radio',  'themerex');
			$list['checkbox'] = __('Checkbox',  'themerex');
			$list['button']   = __('Button','themerex');
			$THEMEREX_GLOBALS['list_field_types'] = $list = apply_filters('themerex_filter_field_types', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return Google map styles
if ( !function_exists( 'themerex_get_list_googlemap_styles' ) ) {
	function themerex_get_list_googlemap_styles($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_googlemap_styles']))
			$list = $THEMEREX_GLOBALS['list_googlemap_styles'];
		else {
			$list = array();
			$list['default'] = __('Default', 'themerex');
			$list['simple'] = __('Simple', 'themerex');
			$list['greyscale'] = __('Greyscale', 'themerex');
			$list['greyscale2'] = __('Greyscale 2', 'themerex');
			$list['invert'] = __('Invert', 'themerex');
			$list['dark'] = __('Dark', 'themerex');
			$list['style1'] = __('Custom style 1', 'themerex');
			$list['style2'] = __('Custom style 2', 'themerex');
			$list['style3'] = __('Custom style 3', 'themerex');
			$THEMEREX_GLOBALS['list_googlemap_styles'] = $list = apply_filters('themerex_filter_googlemap_styles', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'themerex_get_list_icons' ) ) {
	function themerex_get_list_icons($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_icons']))
			$list = $THEMEREX_GLOBALS['list_icons'];
		else
			$THEMEREX_GLOBALS['list_icons'] = $list = themerex_parse_icons_classes(themerex_get_file_dir("css/fontello/css/fontello-codes.css"));
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return socials list
if ( !function_exists( 'themerex_get_list_socials' ) ) {
	function themerex_get_list_socials($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_socials']))
			$list = $THEMEREX_GLOBALS['list_socials'];
		else
			$THEMEREX_GLOBALS['list_socials'] = $list = themerex_get_list_files("images/socials", "png");
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return flags list
if ( !function_exists( 'themerex_get_list_flags' ) ) {
	function themerex_get_list_flags($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_flags']))
			$list = $THEMEREX_GLOBALS['list_flags'];
		else
			$THEMEREX_GLOBALS['list_flags'] = $list = themerex_get_list_files("images/flags", "png");
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list with 'Yes' and 'No' items
if ( !function_exists( 'themerex_get_list_yesno' ) ) {
	function themerex_get_list_yesno($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_yesno']))
			$list = $THEMEREX_GLOBALS['list_yesno'];
		else {
			$list = array();
			$list["yes"] = __("Yes", 'themerex');
			$list["no"]  = __("No", 'themerex');
			$THEMEREX_GLOBALS['list_yesno'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'themerex_get_list_onoff' ) ) {
	function themerex_get_list_onoff($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_onoff']))
			$list = $THEMEREX_GLOBALS['list_onoff'];
		else {
			$list = array();
			$list["on"] = __("On", 'themerex');
			$list["off"] = __("Off", 'themerex');
			$THEMEREX_GLOBALS['list_onoff'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'themerex_get_list_showhide' ) ) {
	function themerex_get_list_showhide($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_showhide']))
			$list = $THEMEREX_GLOBALS['list_showhide'];
		else {
			$list = array();
			$list["show"] = __("Show", 'themerex');
			$list["hide"] = __("Hide", 'themerex');
			$THEMEREX_GLOBALS['list_showhide'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list with 'Ascending' and 'Descending' items
if ( !function_exists( 'themerex_get_list_orderings' ) ) {
	function themerex_get_list_orderings($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_orderings']))
			$list = $THEMEREX_GLOBALS['list_orderings'];
		else {
			$list = array();
			$list["asc"] = __("Ascending", 'themerex');
			$list["desc"] = __("Descending", 'themerex');
			$THEMEREX_GLOBALS['list_orderings'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'themerex_get_list_directions' ) ) {
	function themerex_get_list_directions($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_directions']))
			$list = $THEMEREX_GLOBALS['list_directions'];
		else {
			$list = array();
			$list["horizontal"] = __("Horizontal", 'themerex');
			$list["vertical"] = __("Vertical", 'themerex');
			$THEMEREX_GLOBALS['list_directions'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list with float items
if ( !function_exists( 'themerex_get_list_floats' ) ) {
	function themerex_get_list_floats($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_floats']))
			$list = $THEMEREX_GLOBALS['list_floats'];
		else {
			$list = array();
			$list["none"] = __("None", 'themerex');
			$list["left"] = __("Float Left", 'themerex');
			$list["right"] = __("Float Right", 'themerex');
			$THEMEREX_GLOBALS['list_floats'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list with alignment items
if ( !function_exists( 'themerex_get_list_alignments' ) ) {
	function themerex_get_list_alignments($justify=false, $prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_alignments']))
			$list = $THEMEREX_GLOBALS['list_alignments'];
		else {
			$list = array();
			$list["none"] = __("None", 'themerex');
			$list["left"] = __("Left", 'themerex');
			$list["center"] = __("Center", 'themerex');
			$list["right"] = __("Right", 'themerex');
			if ($justify) $list["justify"] = __("Justify", 'themerex');
			$THEMEREX_GLOBALS['list_alignments'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return sorting list items
if ( !function_exists( 'themerex_get_list_sortings' ) ) {
	function themerex_get_list_sortings($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_sortings']))
			$list = $THEMEREX_GLOBALS['list_sortings'];
		else {
			$list = array();
			$list["date"] = __("Date", 'themerex');
			$list["title"] = __("Alphabetically", 'themerex');
			$list["views"] = __("Popular (views count)", 'themerex');
			$list["comments"] = __("Most commented (comments count)", 'themerex');
			$list["author_rating"] = __("Author rating", 'themerex');
			$list["users_rating"] = __("Visitors (users) rating", 'themerex');
			$list["random"] = __("Random", 'themerex');
			$THEMEREX_GLOBALS['list_sortings'] = $list = apply_filters('themerex_filter_list_sortings', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list with columns widths
if ( !function_exists( 'themerex_get_list_columns' ) ) {
	function themerex_get_list_columns($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_columns']))
			$list = $THEMEREX_GLOBALS['list_columns'];
		else {
			$list = array();
			$list["none"] = __("None", 'themerex');
			$list["1_1"] = __("100%", 'themerex');
			$list["1_2"] = __("1/2", 'themerex');
			$list["1_3"] = __("1/3", 'themerex');
			$list["2_3"] = __("2/3", 'themerex');
			$list["1_4"] = __("1/4", 'themerex');
			$list["3_4"] = __("3/4", 'themerex');
			$list["1_5"] = __("1/5", 'themerex');
			$list["2_5"] = __("2/5", 'themerex');
			$list["3_5"] = __("3/5", 'themerex');
			$list["4_5"] = __("4/5", 'themerex');
			$list["1_6"] = __("1/6", 'themerex');
			$list["5_6"] = __("5/6", 'themerex');
			$list["1_7"] = __("1/7", 'themerex');
			$list["2_7"] = __("2/7", 'themerex');
			$list["3_7"] = __("3/7", 'themerex');
			$list["4_7"] = __("4/7", 'themerex');
			$list["5_7"] = __("5/7", 'themerex');
			$list["6_7"] = __("6/7", 'themerex');
			$list["1_8"] = __("1/8", 'themerex');
			$list["3_8"] = __("3/8", 'themerex');
			$list["5_8"] = __("5/8", 'themerex');
			$list["7_8"] = __("7/8", 'themerex');
			$list["1_9"] = __("1/9", 'themerex');
			$list["2_9"] = __("2/9", 'themerex');
			$list["4_9"] = __("4/9", 'themerex');
			$list["5_9"] = __("5/9", 'themerex');
			$list["7_9"] = __("7/9", 'themerex');
			$list["8_9"] = __("8/9", 'themerex');
			$list["1_10"]= __("1/10", 'themerex');
			$list["3_10"]= __("3/10", 'themerex');
			$list["7_10"]= __("7/10", 'themerex');
			$list["9_10"]= __("9/10", 'themerex');
			$list["1_11"]= __("1/11", 'themerex');
			$list["2_11"]= __("2/11", 'themerex');
			$list["3_11"]= __("3/11", 'themerex');
			$list["4_11"]= __("4/11", 'themerex');
			$list["5_11"]= __("5/11", 'themerex');
			$list["6_11"]= __("6/11", 'themerex');
			$list["7_11"]= __("7/11", 'themerex');
			$list["8_11"]= __("8/11", 'themerex');
			$list["9_11"]= __("9/11", 'themerex');
			$list["10_11"]= __("10/11", 'themerex');
			$list["1_12"]= __("1/12", 'themerex');
			$list["5_12"]= __("5/12", 'themerex');
			$list["7_12"]= __("7/12", 'themerex');
			$list["10_12"]= __("10/12", 'themerex');
			$list["11_12"]= __("11/12", 'themerex');
			$THEMEREX_GLOBALS['list_columns'] = $list = apply_filters('themerex_filter_list_columns', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return list of locations for the dedicated content
if ( !function_exists( 'themerex_get_list_dedicated_locations' ) ) {
	function themerex_get_list_dedicated_locations($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_dedicated_locations']))
			$list = $THEMEREX_GLOBALS['list_dedicated_locations'];
		else {
			$list = array();
			$list["default"] = __('As in the post defined', 'themerex');
			$list["center"]  = __('Above the text of the post', 'themerex');
			$list["left"]    = __('To the left the text of the post', 'themerex');
			$list["right"]   = __('To the right the text of the post', 'themerex');
			$list["alter"]   = __('Alternates for each post', 'themerex');
			$THEMEREX_GLOBALS['list_dedicated_locations'] = $list = apply_filters('themerex_filter_list_dedicated_locations', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return post-format name
if ( !function_exists( 'themerex_get_post_format_name' ) ) {
	function themerex_get_post_format_name($format, $single=true) {
		$name = '';
		if ($format=='gallery')		$name = $single ? __('gallery', 'themerex') : __('galleries', 'themerex');
		else if ($format=='video')	$name = $single ? __('video', 'themerex') : __('videos', 'themerex');
		else if ($format=='audio')	$name = $single ? __('audio', 'themerex') : __('audios', 'themerex');
		else if ($format=='image')	$name = $single ? __('image', 'themerex') : __('images', 'themerex');
		else if ($format=='quote')	$name = $single ? __('quote', 'themerex') : __('quotes', 'themerex');
		else if ($format=='link')	$name = $single ? __('link', 'themerex') : __('links', 'themerex');
		else if ($format=='status')	$name = $single ? __('status', 'themerex') : __('statuses', 'themerex');
		else if ($format=='aside')	$name = $single ? __('aside', 'themerex') : __('asides', 'themerex');
		else if ($format=='chat')	$name = $single ? __('chat', 'themerex') : __('chats', 'themerex');
		else						$name = $single ? __('standard', 'themerex') : __('standards', 'themerex');
		return apply_filters('themerex_filter_list_post_format_name', $name, $format);
	}
}

// Return post-format icon name (from Fontello library)
if ( !function_exists( 'themerex_get_post_format_icon' ) ) {
	function themerex_get_post_format_icon($format) {
		$icon = 'icon-';
		if ($format=='gallery')		$icon .= 'picture-2';
		else if ($format=='video')	$icon .= 'video-2';
		else if ($format=='audio')	$icon .= 'musical-2';
		else if ($format=='image')	$icon .= 'picture-boxed-2';
		else if ($format=='quote')	$icon .= 'quote-2';
		else if ($format=='link')	$icon .= 'link-2';
		else if ($format=='status')	$icon .= 'agenda-2';
		else if ($format=='aside')	$icon .= 'chat-2';
		else if ($format=='chat')	$icon .= 'chat-all-2';
		else						$icon .= 'book-2';
		return apply_filters('themerex_filter_list_post_format_icon', $icon, $format);
	}
}

// Return fonts styles list, prepended inherit
if ( !function_exists( 'themerex_get_list_fonts_styles' ) ) {
	function themerex_get_list_fonts_styles($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_fonts_styles']))
			$list = $THEMEREX_GLOBALS['list_fonts_styles'];
		else {
			$list = array();
			$list['i'] = __('I','themerex');
			$list['u'] = __('U', 'themerex');
			$THEMEREX_GLOBALS['list_fonts_styles'] = $list;
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return Google fonts list
if ( !function_exists( 'themerex_get_list_fonts' ) ) {
	function themerex_get_list_fonts($prepend_inherit=false) {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['list_fonts']))
			$list = $THEMEREX_GLOBALS['list_fonts'];
		else {
			$list = array();
			$list = themerex_array_merge($list, themerex_get_list_fonts_custom());
			// Google and custom fonts list:
			//$list['Advent Pro'] = array(
			//		'family'=>'sans-serif',																						// (required) font family
			//		'link'=>'Advent+Pro:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic',	// (optional) if you use Google font repository
			//		'css'=>themerex_get_file_url('/css/font-face/Advent-Pro/stylesheet.css')									// (optional) if you use custom font-face
			//		);
			$list['Advent Pro'] = array('family'=>'sans-serif');
			$list['Alegreya Sans'] = array('family'=>'sans-serif');
			$list['Arimo'] = array('family'=>'sans-serif');
			$list['Asap'] = array('family'=>'sans-serif');
			$list['Averia Sans Libre'] = array('family'=>'cursive');
			$list['Averia Serif Libre'] = array('family'=>'cursive');
			$list['Bree Serif'] = array('family'=>'serif',);
			$list['Cabin'] = array('family'=>'sans-serif');
			$list['Cabin Condensed'] = array('family'=>'sans-serif');
			$list['Caudex'] = array('family'=>'serif');
			$list['Comfortaa'] = array('family'=>'cursive');
			$list['Cousine'] = array('family'=>'sans-serif');
			$list['Crimson Text'] = array('family'=>'serif');
			$list['Cuprum'] = array('family'=>'sans-serif');
			$list['Dosis'] = array('family'=>'sans-serif');
			$list['Economica'] = array('family'=>'sans-serif');
			$list['Exo'] = array('family'=>'sans-serif');
			$list['Expletus Sans'] = array('family'=>'cursive');
			$list['Karla'] = array('family'=>'sans-serif');
			$list['Lato'] = array('family'=>'sans-serif');
			$list['Lekton'] = array('family'=>'sans-serif');
			$list['Lobster Two'] = array('family'=>'cursive');
			$list['Maven Pro'] = array('family'=>'sans-serif');
			$list['Merriweather'] = array('family'=>'serif');
			$list['Montserrat'] = array('family'=>'sans-serif');
			$list['Neuton'] = array('family'=>'serif');
			$list['Noticia Text'] = array('family'=>'serif');
			$list['Old Standard TT'] = array('family'=>'serif');
			$list['Open Sans'] = array('family'=>'sans-serif');
			$list['Orbitron'] = array('family'=>'sans-serif');
			$list['Oswald'] = array('family'=>'sans-serif');
			$list['Overlock'] = array('family'=>'cursive');
			$list['Oxygen'] = array('family'=>'sans-serif');
			$list['PT Serif'] = array('family'=>'serif');
			$list['Puritan'] = array('family'=>'sans-serif');
			$list['Raleway'] = array('family'=>'sans-serif');
			$list['Roboto'] = array('family'=>'sans-serif');
			$list['Roboto Slab'] = array('family'=>'sans-serif');
			$list['Roboto Condensed'] = array('family'=>'sans-serif');
			$list['Rosario'] = array('family'=>'sans-serif');
			$list['Share'] = array('family'=>'cursive');
			$list['Signika'] = array('family'=>'sans-serif');
			$list['Signika Negative'] = array('family'=>'sans-serif');
			$list['Source Sans Pro'] = array('family'=>'sans-serif');
			$list['Tinos'] = array('family'=>'serif');
			$list['Ubuntu'] = array('family'=>'sans-serif');
			$list['Vollkorn'] = array('family'=>'serif');
			$THEMEREX_GLOBALS['list_fonts'] = $list = apply_filters('themerex_filter_list_fonts', $list);
		}
		return $prepend_inherit ? themerex_array_merge(array('inherit' => __("Inherit", 'themerex')), $list) : $list;
	}
}

// Return Custom font-face list
if ( !function_exists( 'themerex_get_list_fonts_custom' ) ) {
	function themerex_get_list_fonts_custom($prepend_inherit=false) {
		static $list = false;
		if (is_array($list)) return $list;
		$list = array();
		$dir = themerex_get_folder_dir("css/font-face");
		if ( is_dir($dir) ) {
			$hdir = @ opendir( $dir );
			if ( $hdir ) {
				while (($file = readdir( $hdir ) ) !== false ) {
					$pi = pathinfo( ($dir) . '/' . ($file) );
					if ( substr($file, 0, 1) == '.' || ! is_dir( ($dir) . '/' . ($file) ) )
						continue;
					$css = file_exists( ($dir) . '/' . ($file) . '/' . ($file) . '.css' ) 
						? themerex_get_folder_url("css/font-face/".($file).'/'.($file).'.css')
						: (file_exists( ($dir) . '/' . ($file) . '/stylesheet.css' ) 
							? themerex_get_folder_url("css/font-face/".($file).'/stylesheet.css')
							: '');
					if ($css != '')
						$list[$file.' ('.__('uploaded font', 'themerex').')'] = array('css' => $css);
				}
				@closedir( $hdir );
			}
		}
		return $list;
	}
}
?>