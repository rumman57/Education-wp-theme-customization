<?php
/**
 * ThemeREX Framework: Testimonial post type settings
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Theme init
if (!function_exists('themerex_testimonial_theme_setup')) {
	add_action( 'themerex_action_before_init_theme', 'themerex_testimonial_theme_setup' );
	function themerex_testimonial_theme_setup() {
	
		// Add item in the admin menu
		add_action('admin_menu',			'themerex_testimonial_add_meta_box');

		// Save data from meta box
		add_action('save_post',				'themerex_testimonial_save_data');

		// Meta box fields
		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS['testimonial_meta_box'] = array(
			'id' => 'testimonial-meta-box',
			'title' => __('Testimonial Details', 'themerex'),
			'page' => 'testimonial',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				"testimonial_author" => array(
					"title" => __('Testimonial author',  'themerex'),
					"desc" => __("Name of the testimonial's author", 'themerex'),
					"class" => "testimonial_author",
					"std" => "",
					"type" => "text"),
				"testimonial_email" => array(
					"title" => __("Author's e-mail",  'themerex'),
					"desc" => __("E-mail of the testimonial's author - need to take Gravatar (if registered)", 'themerex'),
					"class" => "testimonial_email",
					"std" => "",
					"type" => "text"),
				"testimonial_link" => array(
					"title" => __('Testimonial link',  'themerex'),
					"desc" => __("URL of the testimonial source or author profile page", 'themerex'),
					"class" => "testimonial_link",
					"std" => "",
					"type" => "text")
			)
		);
		
		// Prepare type "Testimonial"
		themerex_require_data( 'post_type', 'testimonial', array(
			'label'               => __( 'Testimonial', 'themerex' ),
			'description'         => __( 'Testimonial Description', 'themerex' ),
			'labels'              => array(
				'name'                => _x( 'Testimonials', 'Post Type General Name', 'themerex' ),
				'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'themerex' ),
				'menu_name'           => __( 'Testimonials', 'themerex' ),
				'parent_item_colon'   => __( 'Parent Item:', 'themerex' ),
				'all_items'           => __( 'All Testimonials', 'themerex' ),
				'view_item'           => __( 'View Item', 'themerex' ),
				'add_new_item'        => __( 'Add New Testimonial', 'themerex' ),
				'add_new'             => __( 'Add New', 'themerex' ),
				'edit_item'           => __( 'Edit Item', 'themerex' ),
				'update_item'         => __( 'Update Item', 'themerex' ),
				'search_items'        => __( 'Search Item', 'themerex' ),
				'not_found'           => __( 'Not found', 'themerex' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'themerex' ),
			),
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail'),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'menu_icon'			  => 'dashicons-cloud',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 25,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'page',
			)
		);
		
		// Prepare taxonomy for testimonial
		themerex_require_data( 'taxonomy', 'testimonial_group', array(
			'post_type'			=> array( 'testimonial' ),
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => _x( 'Testimonials Group', 'taxonomy general name', 'themerex' ),
				'singular_name'     => _x( 'Group', 'taxonomy singular name', 'themerex' ),
				'search_items'      => __( 'Search Groups', 'themerex' ),
				'all_items'         => __( 'All Groups', 'themerex' ),
				'parent_item'       => __( 'Parent Group', 'themerex' ),
				'parent_item_colon' => __( 'Parent Group:', 'themerex' ),
				'edit_item'         => __( 'Edit Group', 'themerex' ),
				'update_item'       => __( 'Update Group', 'themerex' ),
				'add_new_item'      => __( 'Add New Group', 'themerex' ),
				'new_item_name'     => __( 'New Group Name', 'themerex' ),
				'menu_name'         => __( 'Testimonial Group', 'themerex' ),
			),
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'testimonial_group' ),
			)
		);
	}
}


// Add meta box
if (!function_exists('themerex_testimonial_add_meta_box')) {
	//add_action('admin_menu', 'themerex_testimonial_add_meta_box');
	function themerex_testimonial_add_meta_box() {
		global $THEMEREX_GLOBALS;
		$mb = $THEMEREX_GLOBALS['testimonial_meta_box'];
		add_meta_box($mb['id'], $mb['title'], 'themerex_testimonial_show_meta_box', $mb['page'], $mb['context'], $mb['priority']);
	}
}

// Callback function to show fields in meta box
if (!function_exists('themerex_testimonial_show_meta_box')) {
	function themerex_testimonial_show_meta_box() {
		global $post, $THEMEREX_GLOBALS;

		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_testimonial_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		
		$data = get_post_meta($post->ID, 'testimonial_data', true);
	
		$fields = $THEMEREX_GLOBALS['testimonial_meta_box']['fields'];
		?>
		<table class="testimonial_area">
		<?php
		foreach ($fields as $id=>$field) { 
			$meta = isset($data[$id]) ? $data[$id] : '';
			?>
			<tr class="testimonial_field <?php echo esc_attr($field['class']); ?>" valign="top">
				<td><label for="<?php echo esc_attr($id); ?>"><?php echo esc_attr($field['title']); ?></label></td>
				<td><input type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($meta); ?>" size="30" />
					<br><small><?php echo esc_attr($field['desc']); ?></small></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}
}


// Save data from meta box
if (!function_exists('themerex_testimonial_save_data')) {
	//add_action('save_post', 'themerex_testimonial_save_data');
	function themerex_testimonial_save_data($post_id) {
		// verify nonce
		if (!isset($_POST['meta_box_testimonial_nonce']) || !wp_verify_nonce($_POST['meta_box_testimonial_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ($_POST['post_type']!='testimonial' || !current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		global $THEMEREX_GLOBALS;

		$data = array();

		$fields = $THEMEREX_GLOBALS['testimonial_meta_box']['fields'];

		// Post type specific data handling
		foreach ($fields as $id=>$field) { 
			if (isset($_POST[$id])) 
				$data[$id] = stripslashes($_POST[$id]);
		}

		update_post_meta($post_id, 'testimonial_data', $data);
	}
}
?>