<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_single_team_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_single_team_theme_setup', 1 );
	function themerex_template_single_team_theme_setup() {
		themerex_add_template(array(
			'layout' => 'single-team',
			'mode'   => 'single',
			'need_content' => true,
			'need_terms' => true,
			'title'  => __('Single Team member', 'themerex'),
			'thumb_title'  => __('Large image (crop)', 'themerex'),
			'w'		 => 750,
			'h'		 => 422
		));
	}
}

// Template output
if ( !function_exists( 'themerex_template_single_team_output' ) ) {
	function themerex_template_single_team_output($post_options, $post_data) {
		$post_data['post_views']++;
		$show_title = themerex_get_custom_option('show_post_title')=='yes';
		$title_tag = themerex_get_custom_option('show_page_top')=='yes' && themerex_get_custom_option('show_page_title')=='yes' ? 'h3' : 'h1';

		themerex_open_wrapper('<article class="' 
				. join(' ', get_post_class('itemscope'
					. ' post_item post_item_single_team'
					. ' post_featured_' . esc_attr($post_options['post_class'])
					. ' post_format_' . esc_attr($post_data['post_format'])))
				. '"'
				. ' itemscope itemtype="http://schema.org/Article'
				. '">');

		if ($show_title && $post_options['location'] == 'center' && (themerex_get_custom_option('show_page_top')=='no' || themerex_get_custom_option('show_page_title')=='no')) {
			?>
			<<?php echo esc_html($title_tag); ?> itemprop="name" class="post_title entry-title"><span class="post_icon <?php echo esc_attr($post_data['post_icon']); ?>"></span><?php echo ($post_data['post_title']); ?></<?php echo esc_html($title_tag); ?>>
			<?php 
		}

		if (!$post_data['post_protected'] && (
			!empty($post_options['dedicated']) ||
			(themerex_get_custom_option('show_featured_image')=='yes' && $post_data['post_thumb'])	// && $post_data['post_format']!='gallery' && $post_data['post_format']!='image')
		)) {
			?>
			<section class="post_featured">
			<?php
			if (!empty($post_options['dedicated'])) {
				echo ($post_options['dedicated']);
			} else {
				themerex_enqueue_popup();
				?>
				<div class="post_thumb" data-image="<?php echo esc_url($post_data['post_attachment']); ?>" data-title="<?php echo esc_attr($post_data['post_title']); ?>">
					<a class="hover_icon hover_icon_view" href="<?php echo esc_url($post_data['post_attachment']); ?>" title="<?php echo esc_attr($post_data['post_title']); ?>"><?php echo ($post_data['post_thumb']); ?></a>
				</div>
				<?php 
			}
			?>
			</section>
			<?php
		}
			
		
		if ($show_title && $post_options['location'] != 'center' && (themerex_get_custom_option('show_page_top')=='no' || themerex_get_custom_option('show_page_title')=='no')) {
			?>
			<<?php echo esc_html($title_tag); ?> itemprop="name" class="post_title entry-title"><span class="post_icon <?php echo esc_attr($post_data['post_icon']); ?>"></span><?php echo ($post_data['post_title']); ?></<?php echo esc_html($title_tag); ?>>
			<?php 
		}

		themerex_open_wrapper('<section class="post_content" itemprop="articleBody">');
			
		// Post content
		if ($post_data['post_protected']) { 
			echo ($post_data['post_excerpt']);
			echo get_the_password_form(); 
		} else {
			echo trim(themerex_sc_gap_wrapper(themerex_sc_reviews_wrapper($post_data['post_content'])));
			require(themerex_get_file_dir('templates/parts/single-pagination.php'));
			if ( themerex_get_custom_option('show_post_tags') == 'yes' && !empty($post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_links)) {
				?>
				<div class="post_info post_info_bottom">
					<span class="post_info_item post_info_tags"><?php _e('Tags:', 'themerex'); ?> <?php echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_links); ?></span>
				</div>
				<?php 
			}
		} 
			
		themerex_close_wrapper();	// .post_content
			
		if (!$post_data['post_protected']) {
			if ($post_data['post_edit_enable']) {
				require(themerex_get_file_dir('templates/parts/editor-area.php'));
			}
			require(themerex_get_file_dir('templates/parts/share.php'));
		}

		themerex_close_wrapper();	// .post_item

		if (!$post_data['post_protected']) {
			require(themerex_get_file_dir('templates/parts/related-posts.php'));
			require(themerex_get_file_dir('templates/parts/comments.php'));
		}

		require(themerex_get_file_dir('templates/parts/views-counter.php'));
	}
}
?>