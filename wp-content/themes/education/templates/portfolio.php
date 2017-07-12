<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_portfolio_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_portfolio_theme_setup', 1 );
	function themerex_template_portfolio_theme_setup() {
		themerex_add_template(array(
			'layout' => 'portfolio_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Portfolio tile (with hovers, different height) /2 columns/', 'themerex'),
			'thumb_title'  => __('Large image', 'themerex'),
			'w'		 => 750,
			'h_crop' => 422,
			'h'		 => null
		));
		themerex_add_template(array(
			'layout' => 'portfolio_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Portfolio tile /3 columns/', 'themerex'),
			'thumb_title'  => __('Medium image', 'themerex'),
			'w'		 => 400,
			'h_crop' => 225,
			'h'		 => null
		));
		themerex_add_template(array(
			'layout' => 'portfolio_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Portfolio tile /4 columns/', 'themerex'),
			'thumb_title'  => __('Small image', 'themerex'),
			'w'		 => 250,
			'h_crop' => 141,
			'h'		 => null
		));
		themerex_add_template(array(
			'layout' => 'grid_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Grid tile (with hovers, equal height) /2 columns/', 'themerex'),
			'thumb_title'  => __('Large image (crop)', 'themerex'),
			'w'		 => 750,
			'h' 	 => 422
		));
		themerex_add_template(array(
			'layout' => 'grid_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Grid tile /3 columns/', 'themerex'),
			'thumb_title'  => __('Medium image (crop)', 'themerex'),
			'w'		 => 400,
			'h'		 => 225
		));
		themerex_add_template(array(
			'layout' => 'grid_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Grid tile /4 columns/', 'themerex'),
			'thumb_title'  => __('Small image (crop)', 'themerex'),
			'w'		 => 250,
			'h'		 => 141
		));
		themerex_add_template(array(
			'layout' => 'square_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Square tile (with hovers, width=height) /2 columns/', 'themerex'),
			'thumb_title'  => __('Large square image (crop)', 'themerex'),
			'w'		 => 750,
			'h' 	 => 750
		));
		themerex_add_template(array(
			'layout' => 'square_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Square tile /3 columns/', 'themerex'),
			'thumb_title'  => __('Medium square image (crop)', 'themerex'),
			'w'		 => 400,
			'h'		 => 400
		));
		themerex_add_template(array(
			'layout' => 'square_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Square tile /4 columns/', 'themerex'),
			'thumb_title'  => __('Small square image (crop)', 'themerex'),
			'w'		 => 250,
			'h'		 => 250
		));
		themerex_add_template(array(
			'layout' => 'courses',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'title'  => __('Course excerpt', 'themerex'),
			'thumb_title'  => __('Small square image (crop)', 'themerex'),
			'w'		 => 250,
			'h'		 => 250
		));
		themerex_add_template(array(
			'layout' => 'courses_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'title'  => __('Course tile (with hovers, width=height) /2 columns/', 'themerex'),
			'thumb_title'  => __('Large square image (crop)', 'themerex'),
			'w'		 => 750,
			'h' 	 => 750
		));
		themerex_add_template(array(
			'layout' => 'courses_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'title'  => __('Course tile /3 columns/', 'themerex'),
			'thumb_title'  => __('Medium square image (crop)', 'themerex'),
			'w'		 => 400,
			'h'		 => 400
		));
		themerex_add_template(array(
			'layout' => 'courses_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'need_terms' => true,
			'title'  => __('Course tile /4 columns/', 'themerex'),
			'thumb_title'  => __('Small square image (crop)', 'themerex'),
			'w'		 => 250,
			'h'		 => 250
		));
		// Add template specific scripts
		add_action('themerex_action_blog_scripts', 'themerex_template_portfolio_add_scripts');
	}
}

// Add template specific scripts
if (!function_exists('themerex_template_portfolio_add_scripts')) {
	//add_action('themerex_action_blog_scripts', 'themerex_template_portfolio_add_scripts');
	function themerex_template_portfolio_add_scripts($style) {
		if ($style == 'courses') 
			themerex_enqueue_script( 'isotope', themerex_get_file_url('js/jquery.isotope.min.js'), array(), null, true );
		else if (themerex_substr($style, 0, 10) == 'portfolio_' || themerex_substr($style, 0, 5) == 'grid_' || themerex_substr($style, 0, 7) == 'square_' || themerex_substr($style, 0, 8) == 'courses_') {
			themerex_enqueue_script( 'isotope', themerex_get_file_url('js/jquery.isotope.min.js'), array(), null, true );
			themerex_enqueue_script( 'hoverdir', themerex_get_file_url('js/hover/jquery.hoverdir.js'), array(), null, true );
			themerex_enqueue_style( 'themerex-portfolio-style', themerex_get_file_url('css/core.portfolio.css'), array(), null );
		}
	}
}

// Template output
if ( !function_exists( 'themerex_template_portfolio_output' ) ) {
	function themerex_template_portfolio_output($post_options, $post_data) {
		$show_title = !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote'));
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
		$columns = max(1, min(4, empty($parts[1]) ? 1 : (int) $parts[1]));
		$tag = themerex_sc_in_shortcode_blogger(true) ? 'div' : 'article';
		if ($post_options['hover']=='square effect4') $post_options['hover']='square effect5';
		$post_color = $style == 'courses' ? themerex_get_custom_option('post_color', '', $post_data['post_id'], $post_data['post_type']) : '';
		$link_start = !isset($post_options['links']) || $post_options['links'] ? '<a href="'.esc_url($post_data['post_link']).'">' : '';
		$link_end = !isset($post_options['links']) || $post_options['links'] ? '</a>' : '';

		if ($style == 'courses' && $columns==1) {				// Courses excerpt style (1 column)
			if (!empty($post_color))
				$link_start = str_replace('<a ', '<a style="color:'.esc_attr($post_color).'" ', $link_start);
			?>
			<div class="isotope_item isotope_item_courses isotope_item_courses_1 isotope_column_1
						<?php
						if ($post_options['filters'] != '') {
							if ($post_options['filters']=='categories' && !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids))
								echo ' flt_' . join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids);
							else if ($post_options['filters']=='tags' && !empty($post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids))
								echo ' flt_' . join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids);
						}
						?>">
				<<?php echo ($tag); ?> class="post_item post_item_courses post_item_courses_1
					<?php echo 'post_format_'.esc_attr($post_data['post_format']) 
						. ($post_options['number']%2==0 ? ' even' : ' odd') 
						. ($post_options['number']==0 ? ' first' : '') 
						. ($post_options['number']==$post_options['posts_on_page'] ? ' last' : '');
					?>">
	
					<div class="post_content isotope_item_content">
						<div class="post_featured img"<?php echo (empty($post_color) ? '' : ' style="border-color:'.esc_attr($post_color).'"'); ?>>
							<?php 
							/*
							if ($post_data['post_video'] || $post_data['post_audio'] || $post_data['post_thumb'] ||  $post_data['post_gallery']) {
								require(themerex_get_file_dir('templates/parts/post-featured.php')); 
							}
							*/
							echo ($link_start) . ($post_data['post_thumb']) . ($link_end);
							
							require(themerex_get_file_dir('templates/parts/reviews-summary.php'));
							$new = themerex_get_custom_option('mark_as_new', '', $post_data['post_id'], $post_data['post_type']);						// !!!!!! Get option from specified post
							if ($new && $new > date('Y-m-d')) {
								?><div class="post_mark_new"<?php echo (empty($post_color) ? '' : ' style="background-color:'.esc_attr($post_color).'"'); ?>><?php _e('NEW', 'themerex'); ?></div><?php
							}
							?>
						</div>
		
						<div class="post_content clearfix">
							<h4 class="post_title"><?php echo ($link_start) . ($post_data['post_title']) . ($link_end); ?></h4>
							<div class="post_category">
								<?php
								if (!empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_links)) {
									$tmp = join(', ', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_links);
									if (!empty($post_color))
										$tmp = str_replace('<a ', '<a style="color:'.esc_attr($post_color).'" ', $tmp);
									echo trim($tmp);
								}
								?>
							</div>
							<?php
							if (!empty($post_color))
								$reviews_summary = str_replace(
									array('<span class="reviews_star"', '<div class="reviews_value"'),
									array('<span class="reviews_star" style="color:'.esc_attr($post_color).'"', '<div class="reviews_value" style="color:'.esc_attr($post_color).'"'),
									$reviews_summary
									);
							echo trim($reviews_summary);
							?>
							<div class="post_descr">
								<?php
								if ($post_data['post_protected']) {
									echo ($link_start) . ($post_data['post_excerpt']) . ($link_end); 
								} else {
									$price = $price_period = $product_link = $category = '';
									if ($post_data['post_type']=='courses') {
										$price = themerex_get_custom_option('price', '', $post_data['post_id'], $post_data['post_type']);					// !!!!!! Get option from specified post
										if ( empty($price) || themerex_is_inherit_option($price) ) $price = __('Free!', 'themerex');
										$price_period = themerex_get_custom_option('price_period', '', $post_data['post_id'], $post_data['post_type']);		// !!!!!! Get option from specified post
										$product = themerex_get_custom_option('product', '', $post_data['post_id'], $post_data['post_type']);				// !!!!!! Get option from specified post
										$product_link = $product ? get_permalink($product) : '';
									}
									if (!empty($price)) {
										?>
										<div class="post_price"><span class="post_price_value"><?php echo ($price) . ($price_period ? '</span><span class="post_price_period">'.($price_period) : ''); ?></span></div>
										<?php
									}
									if ($style=='courses') {
										if ($post_data['post_link'] != '' || $product_link != '')
											echo '<div class="post_buttons">';
										if ($post_data['post_link'] != '') {
											?>
											<div class="post_button"><?php echo do_shortcode('[trx_button size="small" link="'.esc_url($post_data['post_link']).'"]'.__('LEARN MORE', 'themerex').'[/trx_button]'); ?></div>
											<?php
										}
										if ($product_link != '') {
											?>
											<div class="post_button"><?php echo do_shortcode('[trx_button size="small" link="'.esc_url($product_link).'"]'.__('BUY NOW', 'themerex').'[/trx_button]'); ?></div>
											<?php
										}
										if ($post_data['post_link'] != '' || $product_link != '')
											echo '</div>';
									}
								}
								?>
							</div>
						</div>
					</div>				<!-- /.post_content -->
				</<?php echo ($tag); ?>>	<!-- /.post_item -->
			</div>						<!-- /.isotope_item -->
			<?php

		} else {										// All rest portfolio styles (portfolio, grid, square, courses) with 2 and more columns

			?>
			<div class="isotope_item isotope_item_<?php echo esc_attr($style); ?> isotope_item_<?php echo esc_attr($post_options['layout']); ?> isotope_column_<?php echo esc_attr($columns); ?>
						<?php
						if ($post_options['filters'] != '') {
							if ($post_options['filters']=='categories' && !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids))
								echo ' flt_' . join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids);
							else if ($post_options['filters']=='tags' && !empty($post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids))
								echo ' flt_' . join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids);
						}
						?>">
				<<?php echo ($tag); ?> class="post_item post_item_<?php echo esc_attr($style); ?> post_item_<?php echo esc_attr($post_options['layout']); ?>
					<?php echo 'post_format_'.esc_attr($post_data['post_format']) 
						. ($post_options['number']%2==0 ? ' even' : ' odd') 
						. ($post_options['number']==0 ? ' first' : '') 
						. ($post_options['number']==$post_options['posts_on_page'] ? ' last' : '');
					?>">
	
					<div class="post_content isotope_item_content ih-item colored<?php
									echo ($post_options['hover'] ? ' '.esc_attr($post_options['hover']) : '')
										.($post_options['hover_dir'] ? ' '.esc_attr($post_options['hover_dir']) : ''); ?>">
						<?php
						if ($post_options['hover'] == 'circle effect1') {
							?><div class="spinner"></div><?php
						}
						if ($post_options['hover'] == 'square effect4') {
							?><div class="mask1"></div><div class="mask2"></div><?php
						}
						if ($post_options['hover'] == 'circle effect8') {
							?><div class="img-container"><?php
						}
						?>
						<div class="post_featured img">
							<?php 
							/*
							if ($post_data['post_video'] || $post_data['post_audio'] || $post_data['post_thumb'] ||  $post_data['post_gallery']) {
								require(themerex_get_file_dir('templates/parts/post-featured.php')); 
							}
							*/
							echo ($link_start) . ($post_data['post_thumb']) . ($link_end);
							
							if ($style=='courses') {
								require(themerex_get_file_dir('templates/parts/reviews-summary.php'));
								$new = themerex_get_custom_option('mark_as_new', '', $post_data['post_id'], $post_data['post_type']);						// !!!!!! Get option from specified post
								if ($new && $new > date('Y-m-d')) {
									?><div class="post_mark_new"<?php echo (empty($post_color) ? '' : ' style="background-color:'.esc_attr($post_color).'"'); ?>><?php _e('NEW', 'themerex'); ?></div><?php
								}
								?>
								<h4 class="post_title"<?php echo (empty($post_color) ? '' : ' style="background-color:'.esc_attr($post_color).'"'); ?>><?php echo ($link_start) . ($post_data['post_title']) . ($link_end); ?></h4>
								<div class="post_descr">
									<?php
									$price = $price_period = $product_link = $category = '';
									if ($post_data['post_type']=='courses') {
										$price = themerex_get_custom_option('price', '', $post_data['post_id'], $post_data['post_type']);					// !!!!!! Get option from specified post
										if ( empty($price) || themerex_is_inherit_option($price) ) $price = __('Free!', 'themerex');
										$price_period = themerex_get_custom_option('price_period', '', $post_data['post_id'], $post_data['post_type']);		// !!!!!! Get option from specified post
										$product = themerex_get_custom_option('product', '', $post_data['post_id'], $post_data['post_type']);				// !!!!!! Get option from specified post
										$product_link = $product ? get_permalink($product) : '';
									}
									$category = !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms) 
												? ($post_data['post_terms'][$post_data['post_taxonomy']]->terms[0]->link ? '<a href="'.esc_url($post_data['post_terms'][$post_data['post_taxonomy']]->terms[0]->link).'">' : '')
													. ($post_data['post_terms'][$post_data['post_taxonomy']]->terms[0]->name)
													. ($post_data['post_terms'][$post_data['post_taxonomy']]->terms[0]->link ? '</a>' : '')
												: '';
									if (!empty($price)) {
										?>
										<div class="post_price"><span class="post_price_value"><?php echo ($price) . ($price_period ? '</span><span class="post_price_period">'.($price_period) : ''); ?></span></div>
										<?php
									}
									?>
									<div class="post_category"><?php
										if (!empty($post_color))
											$category = str_replace('<a ', '<a style="color:'.esc_attr($post_color).'" ', $category);
										echo trim($category); 
									?></div>
									<?php 
									if (!empty($post_color))
										$reviews_summary = str_replace(
											array('<span class="reviews_star"', '<div class="reviews_value"'),
											array('<span class="reviews_star" style="color:'.esc_attr($post_color).'"', '<div class="reviews_value" style="color:'.esc_attr($post_color).'"'),
											$reviews_summary
											);
									echo trim($reviews_summary); 
									?>
								</div>
								<?php
							}
							?>
						</div>
						<?php
						if ($post_options['hover'] == 'circle effect8') {
							?>
							</div>	<!-- .img-container -->
							<div class="info-container">
							<?php
						}
						?>
	
						<div class="post_info_wrap info"<?php echo (empty($post_color) ? '' : ' style="background-color:'.esc_attr($post_color).'"'); ?>><div class="info-back">
	
							<?php
							if ($show_title) {
								?><h4 class="post_title"><?php echo ($link_start) . ($post_data['post_title']) . ($link_end); ?></h4><?php
							}
							
							/*
							if (!$post_data['post_protected'] && $post_options['info']) {
								$info_parts = array('counters'=>false, 'terms'=>false);
								require(themerex_get_file_dir('templates/parts/post-info.php')); 
							}
							*/
							?>
	
							<div class="post_descr">
							<?php
								if ($post_data['post_protected']) {
									echo ($link_start) . ($post_data['post_excerpt']) . ($link_end);
								} else {
									if ($post_data['post_excerpt']) {
										echo in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status')) 
											? ( ($link_start) . ($post_data['post_excerpt']) . ($link_end) )
											: '<p>' . ($link_start) . trim(themerex_strshort($post_data['post_excerpt'], isset($post_options['descr']) ? $post_options['descr'] : themerex_get_custom_option('post_excerpt_maxlength_masonry'))) . ($link_end) . '</p>';
									}
									if ($style=='courses') {
										if ($post_data['post_link'] != '' || $product_link != '')
											echo '<div class="post_buttons">';
										if ($post_data['post_link'] != '') {
											?>
											<div class="post_button"><?php echo do_shortcode('[trx_button size="small" link="'.esc_url($post_data['post_link']).'"]'.__('LEARN MORE', 'themerex').'[/trx_button]'); ?></div>
											<?php
										}
										if ($product_link != '') {
											?>
											<div class="post_button"><?php echo do_shortcode('[trx_button size="small" link="'.esc_url($product_link).'"]'.__('BUY NOW', 'themerex').'[/trx_button]'); ?></div>
											<?php
										}
										if ($post_data['post_link'] != '' || $product_link != '')
											echo '</div>';
									} else {
										echo ($link_start);
										?>
										<span class="hover_icon icon-plus-2"></span>
										<?php
										echo ($link_end);
									}
								}
							?>
							</div>
						</div></div>	<!-- /.info-back /.info -->
						<?php if ($post_options['hover'] == 'circle effect8') { ?>
						</div>			<!-- /.info-container -->
						<?php } ?>
					</div>				<!-- /.post_content -->
				</<?php echo ($tag); ?>>	<!-- /.post_item -->
			</div>						<!-- /.isotope_item -->
			<?php
		}										// if ($style == 'courses' && $columns == 1)
	}
}
?>