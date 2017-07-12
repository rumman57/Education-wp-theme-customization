			<div class="post_info">
				<?php
				$info_parts = array_merge(array(
					'snippets' => false,	// For singular post/page/course/team etc.
					'date' => true,
					'author' => true,
					'terms' => true,
					'counters' => true,
					'shedule' => false,		// For single course
					'length' => false		// For single course
					), isset($info_parts) && is_array($info_parts) ? $info_parts : array());
									
				if (in_array($post_data['post_type'], array('courses', 'lesson'))) {
					$course_start = is_single() ? themerex_get_custom_option('date_start') : themerex_get_custom_option('date_start', '', $post_data['post_id'], $post_data['post_type']);	//!!!!!
					if (empty($course_start) || themerex_is_inherit_option($course_start)) $course_start = '';	//$post_data['post_date'];
					$course_end  = is_single() ? themerex_get_custom_option('date_end') : themerex_get_custom_option('date_end', '', $post_data['post_id'], $post_data['post_type']);	//!!!!!
					if (empty($course_end) || themerex_is_inherit_option($course_end)) $course_end = '';
					$course_shed = is_single() ? themerex_get_custom_option('shedule') : themerex_get_custom_option('shedule', '', $post_data['post_id'], $post_data['post_type']);	//!!!!!
					$showed_time = false;
					if ($info_parts['date'] && !empty($course_start)) {
						?>
						<span class="post_info_item post_info_posted"><?php
							echo ( empty($course_end) || $course_end >= date('Y-m-d') 
								? ( $course_start >= date('Y-m-d') 
									? __('Starts on', 'themerex') 
									: __('Started on', 'themerex') )
								: __('Finished on', 'themerex')); ?> <a href="<?php echo esc_url($post_data['post_link']); ?>" class="post_info_date<?php echo esc_attr($info_parts['snippets'] ? ' date updated' : ''); ?>"<?php echo ($info_parts['snippets'] ? ' itemprop="datePublished" content="'.esc_attr($course_start).'"' : ''); ?>><?php echo trim(themerex_get_date_translations(date(get_option('date_format'), strtotime(empty($course_end) || themerex_is_inherit_option($course_end) || $course_end >= date('Y-m-d') ? $course_start : $course_end)))); ?></a></span>
						<?php
						$showed_time = true;
					}
					if ($info_parts['shedule'] && !empty($course_shed)) {
						?>
						<span class="post_info_item post_info_time<?php echo (!$showed_time ? ' post_info_posted' : ''); ?>"><?php echo ($course_shed); ?></span>
						<?php
						$showed_time = true;
					}
					if ($info_parts['length'] && !empty($course_start) && !empty($course_end)) {
						?>
						<span class="post_info_item post_info_length<?php echo (!$showed_time ? ' post_info_posted' : ''); ?>"><?php _e('Length', 'themerex'); ?> <span class="post_info_months"><?php echo trim(themerex_get_date_difference($course_start, $course_end, 2)); ?></span></span>
						<?php
					}
					if ($info_parts['terms'] && !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_links)) {
						?>
						<span class="post_info_item post_info_tags"><?php _e('Category', 'themerex'); ?> <?php echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_links); ?></span>
						<?php
					}
					if ($info_parts['author'] && $post_data['post_type']=='lesson') {
						$teacher_id = is_single() ? themerex_get_custom_option('teacher') : themerex_get_custom_option('teacher', '', $post_data['post_id'], $post_data['post_type']);	//!!!!!
						$teacher_post = get_post($teacher_id);
						$teacher_link = get_permalink($teacher_id);
						?>
						<span class="post_info_item post_info_posted_by<?php echo ($info_parts['snippets'] ? ' vcard' : ''); ?>"<?php echo ($info_parts['snippets'] ? ' itemprop="author"' : ''); ?>><?php _e('Teacher', 'themerex'); ?> <a href="<?php echo esc_url($teacher_link); ?>" class="post_info_author"><?php echo esc_html($teacher_post->post_title); ?></a></span>
					<?php 
					}
				} else {
					if ($info_parts['date']) {
						?>
						<span class="post_info_item post_info_posted"><?php _e('Posted', 'themerex'); ?> <a href="<?php echo esc_url($post_data['post_link']); ?>" class="post_info_date<?php echo esc_attr($info_parts['snippets'] ? ' date updated' : ''); ?>"<?php echo ($info_parts['snippets'] ? ' itemprop="datePublished" content="'.get_the_date('Y-m-d').'"' : ''); ?>><?php echo esc_html($post_data['post_date']); ?></a></span>
						<?php
					}
					if ($info_parts['author']) {
						?>
						<span class="post_info_item post_info_posted_by<?php echo ($info_parts['snippets'] ? ' vcard' : ''); ?>"<?php echo ($info_parts['snippets'] ? ' itemprop="author"' : ''); ?>><?php _e('by', 'themerex'); ?> <a href="<?php echo esc_url($post_data['post_author_url']); ?>" class="post_info_author"><?php echo ($post_data['post_author']); ?></a></span>
					<?php 
					}
					if ($info_parts['terms'] && !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_links)) {
						?>
						<span class="post_info_item post_info_tags"><?php _e('in', 'themerex'); ?> <?php echo join(', ', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_links); ?></span>
						<?php
					}
				}
				if ($info_parts['counters']) {
					?>
					<span class="post_info_item post_info_counters"><?php require(themerex_get_file_dir('templates/parts/counters.php')); ?></span>
					<?php
				}
				?>
			</div>
