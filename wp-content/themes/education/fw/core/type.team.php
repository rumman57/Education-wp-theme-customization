<?php
/**
 * ThemeREX Framework: Team post type settings
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Theme init
if (!function_exists('themerex_team_theme_setup')) {
	add_action( 'themerex_action_before_init_theme', 'themerex_team_theme_setup' );
	function themerex_team_theme_setup() {

		// Add item in the admin menu
		add_action('admin_menu',							'themerex_team_add_meta_box');

		// Save data from meta box
		add_action('save_post',								'themerex_team_save_data');
		
		// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
		add_filter('themerex_filter_get_blog_type',			'themerex_team_get_blog_type', 9, 2);
		add_filter('themerex_filter_get_blog_title',		'themerex_team_get_blog_title', 9, 2);
		add_filter('themerex_filter_get_current_taxonomy',	'themerex_team_get_current_taxonomy', 9, 2);
		add_filter('themerex_filter_is_taxonomy',			'themerex_team_is_taxonomy', 9, 2);
		add_filter('themerex_filter_get_stream_page_title',	'themerex_team_get_stream_page_title', 9, 2);
		add_filter('themerex_filter_get_stream_page_link',	'themerex_team_get_stream_page_link', 9, 2);
		add_filter('themerex_filter_get_stream_page_id',	'themerex_team_get_stream_page_id', 9, 2);
		add_filter('themerex_filter_query_add_filters',		'themerex_team_query_add_filters', 9, 2);
		add_filter('themerex_filter_detect_inheritance_key','themerex_team_detect_inheritance_key', 9, 1);

		// Extra column for team members lists
		if (themerex_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-team_columns',			'themerex_post_add_options_column', 9);
			add_filter('manage_team_posts_custom_column',	'themerex_post_fill_options_column', 9, 2);
		}

		// Meta box fields
		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS['team_meta_box'] = array(
			'id' => 'team-meta-box',
			'title' => __('Team Member Details', 'themerex'),
			'page' => 'team',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				"team_member_position" => array(
					"title" => __('Position',  'themerex'),
					"desc" => __("Position of the team member", 'themerex'),
					"class" => "team_member_position",
					"std" => "",
					"type" => "text"),
				"team_member_email" => array(
					"title" => __("E-mail",  'themerex'),
					"desc" => __("E-mail of the team member - need to take Gravatar (if registered)", 'themerex'),
					"class" => "team_member_email",
					"std" => "",
					"type" => "text"),
				"team_member_link" => array(
					"title" => __('Link to profile',  'themerex'),
					"desc" => __("URL of the team member profile page (if not this page)", 'themerex'),
					"class" => "team_member_link",
					"std" => "",
					"type" => "text"),
				"team_member_socials" => array(
					"title" => __("Social links",  'themerex'),
					"desc" => __("Links to the social profiles of the team member", 'themerex'),
					"class" => "team_member_email",
					"std" => "",
					"type" => "social")
			)
		);
		
		// Prepare type "Team"
		themerex_require_data( 'post_type', 'team', array(
			'label'               => __( 'Team member', 'themerex' ),
			'description'         => __( 'Team Description', 'themerex' ),
			'labels'              => array(
				'name'                => _x( 'Team', 'Post Type General Name', 'themerex' ),
				'singular_name'       => _x( 'Team member', 'Post Type Singular Name', 'themerex' ),
				'menu_name'           => __( 'Team', 'themerex' ),
				'parent_item_colon'   => __( 'Parent Item:', 'themerex' ),
				'all_items'           => __( 'All Team', 'themerex' ),
				'view_item'           => __( 'View Item', 'themerex' ),
				'add_new_item'        => __( 'Add New Team member', 'themerex' ),
				'add_new'             => __( 'Add New', 'themerex' ),
				'edit_item'           => __( 'Edit Item', 'themerex' ),
				'update_item'         => __( 'Update Item', 'themerex' ),
				'search_items'        => __( 'Search Item', 'themerex' ),
				'not_found'           => __( 'Not found', 'themerex' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'themerex' ),
			),
			'supports'            => array( 'title', 'excerpt', 'editor', 'author', 'thumbnail', 'comments'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'			  => 'dashicons-admin-users',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 25,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'query_var'           => true,
			'capability_type'     => 'page',
			'rewrite'             => true
			)
		);
		
		// Prepare taxonomy for team
		themerex_require_data( 'taxonomy', 'team_group', array(
			'post_type'			=> array( 'team' ),
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => _x( 'Team Group', 'taxonomy general name', 'themerex' ),
				'singular_name'     => _x( 'Group', 'taxonomy singular name', 'themerex' ),
				'search_items'      => __( 'Search Groups', 'themerex' ),
				'all_items'         => __( 'All Groups', 'themerex' ),
				'parent_item'       => __( 'Parent Group', 'themerex' ),
				'parent_item_colon' => __( 'Parent Group:', 'themerex' ),
				'edit_item'         => __( 'Edit Group', 'themerex' ),
				'update_item'       => __( 'Update Group', 'themerex' ),
				'add_new_item'      => __( 'Add New Group', 'themerex' ),
				'new_item_name'     => __( 'New Group Name', 'themerex' ),
				'menu_name'         => __( 'Team Group', 'themerex' ),
			),
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'team_group' ),
			)
		);
	}
}

if ( !function_exists( 'themerex_team_settings_theme_setup2' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_team_settings_theme_setup2', 3 );
	function themerex_team_settings_theme_setup2() {
		// Add post type 'team' and taxonomy 'team_group' into theme inheritance list
		themerex_add_theme_inheritance( array('team' => array(
			'stream_template' => 'team',
			'single_template' => 'single-team',
			'taxonomy' => array('team_group'),
			'taxonomy_tags' => array(),
			'post_type' => array('team'),
			'override' => 'post'
			) )
		);
	}
}


// Add meta box
if (!function_exists('themerex_team_add_meta_box')) {
	//add_action('admin_menu', 'themerex_team_add_meta_box');
	function themerex_team_add_meta_box() {
		global $THEMEREX_GLOBALS;
		$mb = $THEMEREX_GLOBALS['team_meta_box'];
		add_meta_box($mb['id'], $mb['title'], 'themerex_team_show_meta_box', $mb['page'], $mb['context'], $mb['priority']);
	}
}

// Callback function to show fields in meta box
if (!function_exists('themerex_team_show_meta_box')) {
	function themerex_team_show_meta_box() {
		global $post, $THEMEREX_GLOBALS;

		// Use nonce for verification
		$data = get_post_meta($post->ID, 'team_data', true);
		$fields = $THEMEREX_GLOBALS['team_meta_box']['fields'];
		?>
		<input type="hidden" name="meta_box_team_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
		<table class="team_area">
		<?php
		foreach ($fields as $id=>$field) { 
			$meta = isset($data[$id]) ? $data[$id] : '';
			?>
			<tr class="team_field <?php echo esc_attr($field['class']); ?>" valign="top">
				<td><label for="<?php echo esc_attr($id); ?>"><?php echo esc_attr($field['title']); ?></label></td>
				<td>
					<?php
					if ($id == 'team_member_socials') {
						$upload_info = wp_upload_dir();
						$upload_url = $upload_info['baseurl'];
						$social_list = themerex_get_theme_option('social_icons');
						foreach ($social_list as $soc) {
							$sn = basename($soc['icon']);
							$sn = themerex_substr($sn, 0, themerex_strrpos($sn, '.'));
							if (($pos=themerex_strrpos($sn, '_'))!==false)
								$sn = themerex_substr($sn, 0, $pos);
							$link = isset($meta[$sn]) ? $meta[$sn] : '';
							?>
							<label for="<?php echo esc_attr(($id).'_'.($sn)); ?>"><?php echo esc_attr(themerex_strtoproper($sn)); ?></label><br>
							<input type="text" name="<?php echo esc_attr($id); ?>[<?php echo esc_attr($sn); ?>]" id="<?php echo esc_attr(($id).'_'.($sn)); ?>" value="<?php echo esc_attr($link); ?>" size="30" /><br>
							<?php
						}
					} else {
						?>
						<input type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($meta); ?>" size="30" />
						<?php
					}
					?>
					<br><small><?php echo esc_attr($field['desc']); ?></small>
				</td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}
}


// Save data from meta box
if (!function_exists('themerex_team_save_data')) {
	//add_action('save_post', 'themerex_team_save_data');
	function themerex_team_save_data($post_id) {
		// verify nonce
		if (!isset($_POST['meta_box_team_nonce']) || !wp_verify_nonce($_POST['meta_box_team_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ($_POST['post_type']!='team' || !current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		global $THEMEREX_GLOBALS;

		$data = array();

		$fields = $THEMEREX_GLOBALS['team_meta_box']['fields'];

		// Post type specific data handling
		foreach ($fields as $id=>$field) {
			if (isset($_POST[$id])) {
				if (is_array($_POST[$id])) {
					foreach ($_POST[$id] as $sn=>$link) {
						$_POST[$id][$sn] = stripslashes($link);
					}
					$data[$id] = $_POST[$id];
				} else {
					$data[$id] = stripslashes($_POST[$id]);
				}
			}
		}

		update_post_meta($post_id, 'team_data', $data);
	}
}



// Return true, if current page is team member page
if ( !function_exists( 'themerex_is_team_page' ) ) {
	function themerex_is_team_page() {
		return get_query_var('post_type')=='team' || is_tax('team_group');
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'themerex_team_detect_inheritance_key' ) ) {
	//add_filter('themerex_filter_detect_inheritance_key',	'themerex_team_detect_inheritance_key', 9, 1);
	function themerex_team_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return themerex_is_team_page() ? 'team' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'themerex_team_get_blog_type' ) ) {
	//add_filter('themerex_filter_get_blog_type',	'themerex_team_get_blog_type', 9, 2);
	function themerex_team_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->is_tax('team_group') || is_tax('team_group'))
			$page = 'team_category';
		else if ($query && $query->get('post_type')=='team' || get_query_var('post_type')=='team')
			$page = $query && $query->is_single() || is_single() ? 'team_item' : 'team';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'themerex_team_get_blog_title' ) ) {
	//add_filter('themerex_filter_get_blog_title',	'themerex_team_get_blog_title', 9, 2);
	function themerex_team_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( themerex_strpos($page, 'team')!==false ) {
			if ( $page == 'team_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'team_group' ), 'team_group', OBJECT);
				$title = $term->name;
			} else if ( $page == 'team_item' ) {
				$title = themerex_get_post_title();
			} else {
				$title = __('All team', 'themerex');
			}
		}

		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'themerex_team_get_stream_page_title' ) ) {
	//add_filter('themerex_filter_get_stream_page_title',	'themerex_team_get_stream_page_title', 9, 2);
	function themerex_team_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (themerex_strpos($page, 'team')!==false) {
			if (($page_id = themerex_team_get_stream_page_id(0, $page)) > 0)
				$title = themerex_get_post_title($page_id);
			else
				$title = __('All team', 'themerex');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'themerex_team_get_stream_page_id' ) ) {
	//add_filter('themerex_filter_get_stream_page_id',	'themerex_team_get_stream_page_id', 9, 2);
	function themerex_team_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (themerex_strpos($page, 'team')!==false) $id = themerex_get_template_page_id('team');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'themerex_team_get_stream_page_link' ) ) {
	//add_filter('themerex_filter_get_stream_page_link',	'themerex_team_get_stream_page_link', 9, 2);
	function themerex_team_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (themerex_strpos($page, 'team')!==false) {
			$id = themerex_get_template_page_id('team');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'themerex_team_get_current_taxonomy' ) ) {
	//add_filter('themerex_filter_get_current_taxonomy',	'themerex_team_get_current_taxonomy', 9, 2);
	function themerex_team_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( themerex_strpos($page, 'team')!==false ) {
			$tax = 'team_group';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'themerex_team_is_taxonomy' ) ) {
	//add_filter('themerex_filter_is_taxonomy',	'themerex_team_is_taxonomy', 9, 2);
	function themerex_team_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query && $query->get('team_group')!='' || is_tax('team_group') ? 'team_group' : '';
	}
}

// Add custom post type and/or taxonomies arguments to the query
if ( !function_exists( 'themerex_team_query_add_filters' ) ) {
	//add_filter('themerex_filter_query_add_filters',	'themerex_team_query_add_filters', 9, 2);
	function themerex_team_query_add_filters($args, $filter) {
		if ($filter == 'team') {
			$args['post_type'] = 'team';
		}
		return $args;
	}
}
?>