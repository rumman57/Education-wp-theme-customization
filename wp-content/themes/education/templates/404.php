<?php
/*
 * The template for displaying "Page 404"
*/

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_404_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_404_theme_setup', 1 );
	function themerex_template_404_theme_setup() {
		themerex_add_template(array(
			'layout' => '404',
			'mode'   => 'internal',
			'title'  => 'Page 404',
			'theme_options' => array(
				'article_style' => 'stretch'
			),
			'w'		 => null,
			'h'		 => null
			));
	}
}

// Template output
if ( !function_exists( 'themerex_template_404_output' ) ) {
	function themerex_template_404_output() {
		?>
		<article class="post_item post_item_404">
			<div class="post_content">
				<h1 class="page_title"><?php _e( '404', 'themerex' ); ?></h1>
				<h2 class="page_subtitle"><?php _e('The requested page cannot be found', 'themerex'); ?></h2>
				<p class="page_description"><?php echo sprintf( __('Can\'t find what you need? Take a moment and do a search below or start from <a href="%s">our homepage</a>.', 'themerex'), home_url() ); ?></p>
				<div class="page_search"><?php echo do_shortcode('[trx_search style="flat" open="fixed" title="'.__('To search type and hit enter', 'themerex').'"]'); ?></div>
			</div>
		</article>
		<?php
	}
}
?>