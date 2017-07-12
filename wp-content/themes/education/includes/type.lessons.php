<?php
/**
 * ThemeREX Framework: Lesson post type settings
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Theme init
if (!function_exists('themerex_lesson_theme_setup')) {
	add_action( 'themerex_action_before_init_theme', 'themerex_lesson_theme_setup' );
	function themerex_lesson_theme_setup() {

		// Add post specific actions and filters
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['post_meta_box']) && $THEMEREX_GLOBALS['post_meta_box']['page']=='lesson') {
			add_filter('themerex_filter_post_save_custom_options',		'themerex_lesson_save_custom_options', 10, 3);
		}

		// Add categories (taxonomies) filter for custom posts types
		add_action( 'restrict_manage_posts','themerex_lesson_show_courses_combo' );
		add_filter( 'pre_get_posts', 		'themerex_lesson_add_parent_course_in_query' );

		// Extra column for lessons lists with overriden Theme Options
		if (themerex_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-lesson_columns',		'themerex_post_add_options_column', 9);
			add_filter('manage_lesson_posts_custom_column',	'themerex_post_fill_options_column', 9, 2);
		}
		// Extra column for lessons lists with parent course name
		add_filter('manage_edit-lesson_columns',		'themerex_lesson_add_options_column', 9);
		add_filter('manage_lesson_posts_custom_column',	'themerex_lesson_fill_options_column', 9, 2);

		// Add shortcode [trx_lessons]
		add_action( 'themerex_action_shortcodes_list',		'themerex_lesson_add_shortcodes' );
		add_action( 'themerex_action_shortcodes_list_vc',	'themerex_lesson_add_shortcodes_vc' );

		
		// Prepare type "lesson"
		themerex_require_data( 'post_type', 'lesson', array(
			'label'               => __( 'Lesson', 'themerex' ),
			'description'         => __( 'Lesson Description', 'themerex' ),
			'labels'              => array(
				'name'                => _x( 'Lessons', 'Post Type General Name', 'themerex' ),
				'singular_name'       => _x( 'Lesson', 'Post Type Singular Name', 'themerex' ),
				'menu_name'           => __( 'Lessons', 'themerex' ),
				'parent_item_colon'   => __( 'Parent Item:', 'themerex' ),
				'all_items'           => __( 'All lessons', 'themerex' ),
				'view_item'           => __( 'View Item', 'themerex' ),
				'add_new_item'        => __( 'Add New lesson', 'themerex' ),
				'add_new'             => __( 'Add New', 'themerex' ),
				'edit_item'           => __( 'Edit Item', 'themerex' ),
				'update_item'         => __( 'Update Item', 'themerex' ),
				'search_items'        => __( 'Search Item', 'themerex' ),
				'not_found'           => __( 'Not found', 'themerex' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'themerex' ),
			),
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'			  => 'dashicons-format-chat',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 25,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post'
			)
		);
	}
}


/* Extra column for lessons list
-------------------------------------------------------------------------------------------- */

// Create additional column
if (!function_exists('themerex_lesson_add_options_column')) {
	//add_filter('manage_edit-lesson_columns',	'themerex_lesson_add_options_column', 9);
	function themerex_lesson_add_options_column( $columns ) {
		themerex_array_insert_after( $columns, 'title', array('course_title' => __('Course', 'themerex')) );
		return $columns;
	}
}

// Fill column with data
if (!function_exists('themerex_lesson_fill_options_column')) {
	//add_filter('manage_lesson_custom_column',	'themerex_lesson_fill_options_column', 9, 2);
	function themerex_lesson_fill_options_column($column_name='', $post_id=0) {
		if ($column_name != 'course_title') return;
		if ($parent_id = get_post_meta($post_id, 'parent_course', true)) {
			if ($parent_id > 0) {
				$parent_title = get_the_title($parent_id);
				echo '<a href="#" onclick="jQuery(\'select#parent_course\').val('.intval($parent_id).').siblings(\'input[type=\\\'submit\\\']\').trigger(\'click\'); return false;" title="'.esc_attr(__('Leave only lessons of this course', 'themerex')).'">' . strip_tags($parent_title) . '</a>';
			}
		}
	}
}


/* Display filter for lessons by courses
-------------------------------------------------------------------------------------------- */

// Display filter combobox
if (!function_exists('themerex_lesson_show_courses_combo')) {
	//add_action( 'restrict_manage_posts', 'themerex_lesson_show_courses_combo' );
	function themerex_lesson_show_courses_combo() {
		$page = get_query_var('post_type');
		if ($page != 'lesson') return;
		$courses = themerex_get_list_posts(false, array(
					'post_type' => 'courses',
					'orderby' => 'title',
					'order' => 'asc'
					)
		);
		$list = '';
		if (count($courses) > 0) {
			$slug = 'parent_course';
			$list .= '<label class="screen-reader-text filter_label" for="'.esc_attr($slug).'">' . __('Parent Course:', 'themerex') . "</label> <select name='".esc_attr($slug)."' id='".esc_attr($slug)."' class='postform'>";
			foreach ($courses as $id=>$name) {
				$list .= '<option value='. esc_attr($id) . (isset($_GET[$slug]) && $_GET[$slug] == $id ? ' selected="selected"' : '') . '>' . esc_html($name) . '</option>';
			}
			$list .=  "</select>";
		}
		echo trim($list);
	}
}

// Add filter in main query
if (!function_exists('themerex_lesson_add_parent_course_in_query')) {
	//add_filter( 'pre_get_posts', 'themerex_lesson_add_parent_course_in_query' );
	function themerex_lesson_add_parent_course_in_query($query) {
		if ( is_admin() && themerex_strpos($_SERVER['REQUEST_URI'], 'edit.php')!==false && $query->is_main_query() && $query->get( 'post_type' )=='lesson' ) {
			$parent_course = isset( $_GET['parent_course'] ) ? intval($_GET['parent_course']) : 0;
			if ($parent_course > 0 ) {
				$meta_query = $query->get( 'meta_query' );
				if (!is_array($meta_query)) $meta_query = array();
				$meta_query['relation'] = 'AND';
				$meta_query[] = array(
					'meta_filter' => 'lesson',
					'key' => 'parent_course',
					'value' => $parent_course,
					'compare' => '=',
					'type' => 'NUMERIC'
				);
				$query->set( 'meta_query', $meta_query );
			}
		}
		return $query;
	}
}


/* Display metabox for lessons
-------------------------------------------------------------------------------------------- */

if (!function_exists('themerex_lesson_after_theme_setup')) {
	add_action( 'themerex_action_after_init_theme', 'themerex_lesson_after_theme_setup' );
	function themerex_lesson_after_theme_setup() {
		// Update fields in the meta box
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['post_meta_box']) && $THEMEREX_GLOBALS['post_meta_box']['page']=='lesson') {
			// Meta box fields
			$THEMEREX_GLOBALS['post_meta_box']['title'] = __('Lesson Options', 'themerex');
			$THEMEREX_GLOBALS['post_meta_box']['fields'] = array(
				"mb_partition_lessons" => array(
					"title" => __('Lesson', 'themerex'),
					"override" => "page,post",
					"divider" => false,
					"icon" => "iconadmin-users-1",
					"type" => "partition"),
				"mb_info_lessons_1" => array(
					"title" => __('Lesson details', 'themerex'),
					"override" => "page,post",
					"divider" => false,
					"desc" => __('In this section you can put details for this lesson', 'themerex'),
					"class" => "course_meta",
					"type" => "info"),
				"parent_course" => array(
					"title" => __('Parent Course',  'themerex'),
					"desc" => __("Select parent course for this lesson", 'themerex'),
					"override" => "page,post",
					"class" => "lesson_parent_course",
					"std" => '',
					"options" => themerex_get_list_posts(false, array(
						'post_type' => 'courses',
						'orderby' => 'title',
						'order' => 'asc'
						)
					),
					"type" => "select"),
				"teacher" => array(
					"title" => __('Teacher',  'themerex'),
					"desc" => __("Main Teacher for this lesson", 'themerex'),
					"override" => "page,post",
					"class" => "lesson_teacher",
					"std" => '',
					"options" => themerex_get_list_posts(false, array(
						'post_type' => 'team',
						'orderby' => 'title',
						'order' => 'asc')
					),
					"type" => "select"),
				"date_start" => array(
					"title" => __('Start date',  'themerex'),
					"desc" => __("Lesson start date", 'themerex'),
					"override" => "page,post",
					"class" => "lesson_date",
					"std" => date('Y-m-d'),
					"format" => 'yy-mm-dd',
					"type" => "date"),
				"date_end" => array(
					"title" => __('End date',  'themerex'),
					"desc" => __("Lesson finish date", 'themerex'),
					"override" => "page,post",
					"class" => "lesson_date",
					"std" => date('Y-m-d'),
					"format" => 'yy-mm-dd',
					"type" => "date"),
				"shedule" => array(
					"title" => __('Schedule time',  'themerex'),
					"desc" => __("Lesson start days and time. For example: Mon, Wed, Fri 19:00-21:00", 'themerex'),
					"override" => "page,post",
					"class" => "lesson_time",
					"std" => '',
					"divider" => false,
					"type" => "text")
			);
		}
	}
}

// Before save custom options - calc and save average rating
if (!function_exists('themerex_lesson_save_custom_options')) {
	//add_filter('themerex_filter_post_save_custom_options',	'themerex_lesson_save_custom_options', 10, 3);
	function themerex_lesson_save_custom_options($custom_options, $post_type, $post_id) {
		if (isset($custom_options['parent_course'])) {
			update_post_meta($post_id, 'parent_course', $custom_options['parent_course']);
		}
		if (isset($custom_options['date_start'])) {
			update_post_meta($post_id, 'date_start', $custom_options['date_start']);
		}
		return $custom_options;
	}
}


// Return lessons list by parent course post ID
if ( !function_exists( 'themerex_get_lessons_list' ) ) {
	function themerex_get_lessons_list($parent_id, $count=-1) {
		$list = array();
		$args = array(
			'post_type' => 'lesson',
			'post_status' => 'publish',
			'meta_key' => 'date_start',
			'orderby' => 'meta_value',		//'date'
			'order' => 'asc',
			'ignore_sticky_posts' => true,
			'posts_per_page' => $count,
			'meta_query' => array(
				array(
					'key'     => 'parent_course',
					'value'   => $parent_id,
					'compare' => '=',
					'type'    => 'NUMERIC'
				)
			)
		);
		global $post;
		$query = new WP_Query( $args );
		while ( $query->have_posts() ) { $query->the_post();
			$list[] = $post;
		}
		wp_reset_postdata();
		return $list;
	}
}

// Return lessons TOC by parent course post ID
if ( !function_exists( 'themerex_get_lessons_links' ) ) {
	function themerex_get_lessons_links($parent_id, $current_id=0, $opt = array()) {
		$opt = array_merge( array(
			'show_lessons' => true,
			'show_prev_next' => false,
			'header' => '',
			'description' => ''
			), $opt);
		$output = '';
		if ($parent_id > 0) {
			$courses_list = themerex_get_lessons_list($parent_id);
			$courses_toc = '';
			$prev_course = $next_course = null;
			if (count($courses_list) > 1) {
				$step = 0;
				foreach ($courses_list as $course) {
					if ($course->ID == $current_id)
						$step = 1;
					else if ($step==0)
						$prev_course = $course;
					else if ($step==1) {
						$next_course = $course;
						$step = 2;
						if (!$opt['show_lessons']) break;
					}
					if ($opt['show_lessons']) {
						$teacher_id = themerex_get_custom_option('teacher', '', $course->ID, $course->post_type);				//!!!!! Get option from specified post
						$teacher_post = get_post($teacher_id);
						$teacher_link = get_permalink($teacher_id);
						$teacher_position = '';
						// Uncomment next two rows if you want display Teacher's position
						//$teacher_data = get_post_meta($teacher_id, 'team_data', true);
						//$teacher_position = isset($teacher_data['team_member_position']) ? $teacher_data['team_member_position'] : '';
						$course_start = themerex_get_custom_option('date_start', '', $course->ID, $course->post_type);			//!!!!! Get option from specified post
						$courses_toc .= '<li class="sc_list_item course_lesson_item">'
							. '<span class="sc_list_icon icon-dot"></span>'
							. ($course->ID == $current_id ? '<span class="course_lesson_title">' : '<a href="'.esc_url(get_permalink($course->ID)).'" class="course_lesson_title">') 
								. strip_tags($course->post_title) 
							. ($course->ID == $current_id ? '</span>' : '</a>')
							. ' | <span class="course_lesson_date">' . esc_html(themerex_get_date_or_difference(!empty($course_start) ? $course_start : $course->post_date)) . '</span>'
							. ' <span class="course_lesson_by">' . esc_html(__('by', 'themerex')) . '</span>'
							. ' <a href="'.esc_url($teacher_link).'" class="course_lesson_teacher">' . trim($teacher_position) . ' ' . trim($teacher_post->post_title) . '</a>'
							. (!empty($course->post_excerpt) ? '<div class="course_lesson_excerpt">' . strip_tags($course->post_excerpt) . '</span>' : '')
							. '</li>';
					}
				}
				$output .= ($opt['show_lessons'] 
								? ('<div class="course_toc' . ($opt['show_prev_next'] ? ' course_toc_with_pagination' : '') . '">'
									. ($opt['header'] ? '<h2 class="course_toc_title">' . trim($opt['header']) . '</h2>' : '')
									. ($opt['description'] ? '<div class="course_toc_description">' . trim($opt['description']) . '</div>' : '')
									. '<ul class="sc_list sc_list_style_iconed">' . trim($courses_toc) . '</ul>'
									. '</div>')
								: '')
					. ($opt['show_prev_next']
								? ('<nav class="pagination_single pagination_lessons" role="navigation">'
									. ($prev_course != null 
										? '<a href="' . esc_url(get_permalink($prev_course->ID)) . '" class="pager_prev"><span class="pager_numbers">&laquo;&nbsp;' . strip_tags($prev_course->post_title) . '</span></a>'
										: '')
									. ($next_course != null
										? '<a href="' . esc_url(get_permalink($next_course->ID)) . '" class="pager_next"><span class="pager_numbers">' . strip_tags($next_course->post_title) . '&nbsp;&raquo;</span></a>'
										: '')
									. '</nav>')
								: '');
			}
		}
		return $output;
	}
}






// ---------------------------------- [trx_lessons] ---------------------------------------

add_shortcode('trx_lessons', 'themerex_sc_lessons');

/*
[trx_lessons course_id="id"]
*/
function themerex_sc_lessons($atts, $content=null){	
	if (themerex_sc_in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		// Individual params
		"course_id" => "",
		"align" => "",
		"title" => "",
		"description" => "",
		// Common params
		"id" => "",
		"class" => "",
		"animation" => "",
		"css" => "",
		"width" => "",
		"height" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

	$css .= themerex_get_css_position_from_values($top, $right, $bottom, $left, $width, $height);
	$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
					. ' class="sc_lessons' 
							. (!empty($class) ? ' '.esc_attr($class) : '') 
							. ($align && $align!='none' ? ' align'.esc_attr($align) : '')
							. '"'
						. (!themerex_sc_param_is_off($animation) ? ' data-animation="'.esc_attr(themerex_sc_get_animation_classes($animation)).'"' : '')
						. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
				. '>'
				. themerex_get_lessons_links($course_id, 0, array(
						'header' => $title,
						'description' => $description,
						'show_lessons' => true,
						'show_prev_next' => false
						)
					)
				. '</div>';
	
	return apply_filters('themerex_shortcode_output', $output, 'trx_lessons', $atts, $content);
}
// ---------------------------------- [/trx_lessons] ---------------------------------------


// Add [trx_lessons] in the shortcodes list
if (!function_exists('themerex_lesson_add_shortcodes')) {
	//add_filter('themerex_action_shortcodes_list',	'themerex_lesson_add_shortcodes');
	function themerex_lesson_add_shortcodes() {
		global $THEMEREX_GLOBALS;
		if (isset($THEMEREX_GLOBALS['shortcodes'])) {

			$courses = themerex_get_list_posts(false, array(
						'post_type' => 'courses',
						'orderby' => 'title',
						'order' => 'asc'
						)
			);

			themerex_array_insert_after($THEMEREX_GLOBALS['shortcodes'], 'trx_infobox', array(

				// Lessons
				"trx_lessons" => array(
					"title" => __("Lessons", "themerex"),
					"desc" => __("Insert list of lessons for specified course", "themerex"),
					"decorate" => false,
					"container" => false,
					"params" => array(
						"course_id" => array(
							"title" => __("Course", "themerex"),
							"desc" => __("Select the desired course", "themerex"),
							"value" => "",
							"options" => $courses,
							"type" => "select"
						),
						"title" => array(
							"title" => __("Title", "themerex"),
							"desc" => __("Title for the section with lessons", "themerex"),
							"divider" => true,
							"dependency" => array(
								'course_id' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"description" => array(
							"title" => __("Description", "themerex"),
							"desc" => __("Description for the section with lessons", "themerex"),
							"divider" => true,
							"dependency" => array(
								'course_id' => array('not_empty')
							),
							"value" => "",
							"type" => "text"
						),
						"align" => array(
							"title" => __("Alignment", "themerex"),
							"desc" => __("Align block to the left or right side", "themerex"),
							"divider" => true,
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
						"css" => $THEMEREX_GLOBALS['sc_params']['css']
					)
				)

			));
		}
	}
}


// Add [trx_lessons] in the VC shortcodes list
if (!function_exists('themerex_lesson_add_shortcodes_vc')) {
	//add_filter('themerex_action_shortcodes_list_vc',	'themerex_lesson_add_shortcodes_vc');
	function themerex_lesson_add_shortcodes_vc() {
		global $THEMEREX_GLOBALS;

		$courses = themerex_get_list_posts(false, array(
					'post_type' => 'courses',
					'orderby' => 'title',
					'order' => 'asc'
					)
		);

		// Lessons
		vc_map( array(
			"base" => "trx_lessons",
			"name" => __("Lessons", "themerex"),
			"description" => __("Insert list of lessons for specified course", "themerex"),
			"category" => __('Content', 'js_composer'),
			'icon' => 'icon_trx_lessons',
			"class" => "trx_sc_single trx_sc_lessons",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "course_id",
					"heading" => __("Course", "themerex"),
					"description" => __("Select the desired course", "themerex"),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip($courses),
					"type" => "dropdown"
				),
				array(
					"param_name" => "title",
					"heading" => __("Title", "themerex"),
					"description" => __("Title for the section with lessons", "themerex"),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "description",
					"heading" => __("Description", "themerex"),
					"description" => __("Description for the section with lessons", "themerex"),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "align",
					"heading" => __("Alignment", "themerex"),
					"description" => __("Alignment of the lessons block", "themerex"),
					"class" => "",
					"value" => array_flip($THEMEREX_GLOBALS['sc_params']['align']),
					"type" => "dropdown"
				),
				themerex_vc_width(),
				themerex_vc_height(),
				$THEMEREX_GLOBALS['vc_params']['margin_top'],
				$THEMEREX_GLOBALS['vc_params']['margin_bottom'],
				$THEMEREX_GLOBALS['vc_params']['margin_left'],
				$THEMEREX_GLOBALS['vc_params']['margin_right'],
				$THEMEREX_GLOBALS['vc_params']['id'],
				$THEMEREX_GLOBALS['vc_params']['class'],
				$THEMEREX_GLOBALS['vc_params']['animation'],
				$THEMEREX_GLOBALS['vc_params']['css']
			)
		) );
		
		class WPBakeryShortCode_Trx_Lessons extends THEMEREX_VC_ShortCodeSingle {}
	}
}

?>