<?php
/**
 * The Sidebar containing the main widget areas.
 */

$sidebar_show  = themerex_get_custom_option('show_sidebar_main');
$sidebar_parts = explode(' ', $sidebar_show);
$sidebar_tint  = !empty($sidebar_parts[0]) ? $sidebar_parts[0] : 'light';
$sidebar_style = !empty($sidebar_parts[1]) ? $sidebar_parts[1] : $sidebar_tint;

if (!themerex_sc_param_is_off($sidebar_show)) {
	?>
	<div class="sidebar widget_area bg_tint_<?php echo esc_attr($sidebar_tint); ?> sidebar_style_<?php echo esc_attr($sidebar_style); ?>" role="complementary">

		<?php
		do_action( 'before_sidebar' );
		global $THEMEREX_GLOBALS;
		if (!empty($THEMEREX_GLOBALS['reviews_markup'])) 
			echo '<aside class="column-1_1 widget widget_reviews">' . ($THEMEREX_GLOBALS['reviews_markup']) . '</aside>';
		$THEMEREX_GLOBALS['current_sidebar'] = 'main';
		if ( ! dynamic_sidebar( themerex_get_custom_option('sidebar_main') ) ) {
			// Put here html if user no set widgets in sidebar
		}
		do_action( 'after_sidebar' );
		?>
	</div> <!-- /.sidebar -->
	<?php


}
?>