<?php
//===================================== Post author info =====================================
if (themerex_get_custom_option("show_post_author") == 'yes') {
	$post_author_name = $post_author_socials = '';
	$show_post_author_socials = false;
	if ($post_data['post_type']=='post') {
		$post_author_title = __('About', 'themerex');
		$post_author_name = $post_data['post_author'];
		$post_author_url = $post_data['post_author_url'];
		$post_author_email = get_the_author_meta('user_email', $post_data['post_author_id']);
		$post_author_avatar = get_avatar($post_author_email, 75*min(2, max(1, themerex_get_theme_option("retina_ready"))));
		$post_author_descr = do_shortcode(nl2br(get_the_author_meta('description', $post_data['post_author_id'])));
		if ($show_post_author_socials) $post_author_socials = themerex_show_user_socials(array('author_id'=>$post_data['post_author_id'], 'style'=>'bg', 'size'=>'tiny', 'echo' => false));
	} else if ($post_data['post_type']=='courses') {
		$post_author_id = themerex_get_custom_option('teacher');
		if ($post_author_id) {
			global $post;
			$post = get_post($post_author_id);
			setup_postdata($post);
			$post_author_title = __('About Teacher', 'themerex');
			$post_author_name = apply_filters('the_title', get_the_title());
			$post_author_descr = apply_filters('the_excerpt', get_the_excerpt());
			$post_meta = get_post_meta($post_author_id, 'team_data', true);
			$post_author_position = $post_meta['team_member_position'];
			$post_author_url = !empty($post_meta['team_member_link']) ? $post_meta['team_member_link'] : get_permalink($post_author_id);
			$post_author_email = $post_meta['team_member_email'];
			$post_author_avatar = wp_get_attachment_url(get_post_thumbnail_id($post_author_id));
			if (empty($post_author_avatar)) {
				if (!empty($post_author_email))
					$post_author_avatar = get_avatar($post_author_email, 75*min(2, max(1, themerex_get_theme_option("retina_ready"))));
			} else {
				$post_author_avatar = themerex_get_resized_image_tag($post_author_avatar, 75, 75);
			}
			if ($show_post_author_socials) {
				$soc_list = $post_meta['team_member_socials'];
				if (is_array($soc_list) && count($soc_list)>0) {
					$soc_str = '';
					foreach ($soc_list as $sn=>$sl) {
						if (!empty($sl))
							$soc_str .= (!empty($soc_str) ? '|' : '') . ($sn) . '=' . ($sl);
					}
					if (!empty($soc_str))
						$post_author_socials = do_shortcode('[trx_socials socials="'.esc_attr($soc_str).'"][/trx_socials]');
				}
			}
			wp_reset_postdata();
		}
	}
	if (!empty($post_author_name)) {
		?>
		<section class="post_author author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">
			<div class="post_author_avatar"><a href="<?php echo esc_url($post_data['post_author_url']); ?>" itemprop="image"><?php echo ($post_author_avatar); ?></a></div>
			<h6 class="post_author_title"><?php echo esc_html($post_author_title); ?> <span itemprop="name"><a href="<?php echo esc_url($post_author_url); ?>" class="fn"><?php echo ($post_author_name); ?></a></span></h6>
			<div class="post_author_info" itemprop="description"><?php echo ($post_author_descr); ?></div>
			<?php if ($post_author_socials!='') echo ($post_author_socials); ?>
		</section>
		<?php
	}
}
?>