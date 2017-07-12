<?php
/*
Template Name: Team member
*/

get_header(); 

$single_style = 'single-team';	//themerex_get_custom_option('single_style');

while ( have_posts() ) { the_post();

	// Move themerex_set_post_views to the javascript - counter will work under cache system
	if (themerex_get_custom_option('use_ajax_views_counter')=='no') {
		themerex_set_post_views(get_the_ID());
	}

	//themerex_sc_clear_dedicated_content();
	themerex_show_post_layout(
		array(
			'layout' => $single_style,
			'sidebar' => !themerex_sc_param_is_off(themerex_get_custom_option('show_sidebar_main')),
			'content' => themerex_get_template_property($single_style, 'need_content'),
			'terms_list' => themerex_get_template_property($single_style, 'need_terms')
		)
	);

}

get_footer();
?>