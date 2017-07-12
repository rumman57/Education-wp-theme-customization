<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_single_portfolio_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_single_portfolio_theme_setup', 1 );
	function themerex_template_single_portfolio_theme_setup() {
		themerex_add_template(array(
			'layout' => 'single-portfolio',
			'mode'   => 'single',
			'need_content' => true,
			'need_terms' => true,
			'title'  => __('Portfolio item', 'themerex'),
			'thumb_title'  => __('Fullsize image', 'themerex'),
			'w'		 => 1150,
			'h'		 => null,
			'h_crop' => 455
		));
	}
}

// Template output
if ( !function_exists( 'themerex_template_single_portfolio_output' ) ) {
	function themerex_template_single_portfolio_output($post_options, $post_data) {
		$post_data['post_views']++;
		$avg_author = 0;
		$avg_users  = 0;
		if (!$post_data['post_protected'] && $post_options['reviews'] && themerex_get_custom_option('show_reviews')=='yes') {
			$avg_author = $post_data['post_reviews_author'];
			$avg_users  = $post_data['post_reviews_users'];
		}
		$show_title = themerex_get_custom_option('show_post_title')=='yes' && (themerex_get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));

		themerex_open_wrapper('<article class="' 
				. join(' ', get_post_class('itemscope'
					. ' post_item'
					. ' post_featured_' . esc_attr($post_options['post_class'])
					. ' post_format_' . esc_attr($post_data['post_format'])))
				. '"'
				. ' itemscope itemtype="http://schema.org/'.($avg_author > 0 || $avg_users > 0 ? 'Review' : 'Article')
				. '">');

		require(themerex_get_file_dir('templates/parts/prev-next-block.php'));

		if ($show_title) {
			?>
			<h1 itemprop="<?php echo ($avg_author > 0 || $avg_users > 0 ? 'itemReviewed' : 'name'); ?>" class="post_title entry-title"><?php echo ($post_data['post_title']); ?></h1>
			<?php
		}

		if (!$post_data['post_protected'] && themerex_get_custom_option('show_post_info')=='yes') {
			require(themerex_get_file_dir('templates/parts/post-info.php')); 
		}

		require(themerex_get_file_dir('templates/parts/reviews-block.php'));

		themerex_open_wrapper('<section class="post_content" itemprop="'.($avg_author > 0 || $avg_users > 0 ? 'reviewBody' : 'articleBody').'">');
			
		// Post content
		if ($post_data['post_protected']) { 
			echo ($post_data['post_excerpt']);
			echo get_the_password_form(); 
		} else {
			if (themerex_strpos($post_data['post_content'], themerex_sc_reviews_placeholder())===false) $post_data['post_content'] = do_shortcode('[trx_reviews]') . ($post_data['post_content']);
			echo trim(themerex_sc_gap_wrapper(themerex_sc_reviews_wrapper($post_data['post_content'])));
			require(themerex_get_file_dir('templates/parts/single-pagination.php'));
			if ( themerex_get_custom_option('show_post_tags') == 'yes' && !empty($post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_links)) {
				?>
				<div class="post_info">
					<span class="post_info_item post_info_tags"><?php _e('in', 'themerex'); ?> <?php echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_links); ?></span>
				</div>
				<?php
			} 
		}

		themerex_close_wrapper();	// .post_content

		if (!$post_data['post_protected']) {
			if ($post_data['post_edit_enable']) {
				require(themerex_get_file_dir('templates/parts/editor-area.php'));
			}
			require(themerex_get_file_dir('templates/parts/author-info.php'));
			require(themerex_get_file_dir('templates/parts/share.php'));
			require(themerex_get_file_dir('templates/parts/related-posts.php'));
			require(themerex_get_file_dir('templates/parts/comments.php'));
		}
	
		themerex_close_wrapper();	// .post_item

		require(themerex_get_file_dir('templates/parts/views-counter.php'));
	}
}
?>