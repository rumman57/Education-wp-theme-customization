<?php
/**
 * The template for displaying the footer.
 */

global $THEMEREX_GLOBALS;

				themerex_close_wrapper();	// <!-- </.content> -->

				// Show main sidebar
				get_sidebar();

				if (themerex_get_custom_option('body_style')!='fullscreen') themerex_close_wrapper();	// <!-- </.content_wrap> -->
				?>
			
			</div>		<!-- </.page_content_wrap> -->
			
			<?php
			// User custom footer
			if (themerex_get_custom_option('show_user_footer') == 'yes') {
				$user_footer = themerex_strclear(themerex_get_custom_option('user_footer_content'), 'p');
				if (!empty($user_footer)) {
					$user_footer = themerex_substitute_all($user_footer);
					?>
					<footer class="user_footer_wrap"><?php echo ($user_footer); ?></footer>
					<?php
				}
			}

			// Footer sidebar
			$footer_show  = themerex_get_custom_option('show_sidebar_footer');
			$footer_parts = explode(' ', $footer_show);
			$footer_tint  = !empty($footer_parts[0]) ? $footer_parts[0] : 'dark';
			$footer_style = !empty($footer_parts[1]) ? $footer_parts[1] : $footer_tint;
			if (!themerex_sc_param_is_off($footer_show)) { 
				$THEMEREX_GLOBALS['current_sidebar'] = 'footer';
				?>
				<footer class="footer_wrap bg_tint_<?php echo esc_attr($footer_tint); ?> footer_style_<?php echo esc_attr($footer_style); ?> widget_area">
					<div class="content_wrap">
						<div class="columns_wrap">
						<?php
						do_action( 'before_sidebar' );
						if ( ! dynamic_sidebar( themerex_get_custom_option('sidebar_footer') ) ) {
							// Put here html if user no set widgets in sidebar
						}
						do_action( 'after_sidebar' );
						?>
						</div>	<!-- /.columns_wrap -->
					</div>	<!-- /.content_wrap -->
				</footer>	<!-- /.footer_wrap -->
			<?php
			}

			// Footer Testimonials stream
			$show = themerex_get_custom_option('show_testimonials_in_footer');
			if (!themerex_sc_param_is_off($show)) { 
				$count = max(1, themerex_get_custom_option('testimonials_count'));
				$data = do_shortcode('[trx_testimonials count="'.esc_attr($count).'"][/trx_testimonials]');
				if ($data) {
					$bg_image = themerex_get_custom_option('testimonials_bg_image');
					$bg_color = apply_filters('themerex_filter_get_menu_color', themerex_get_custom_option('testimonials_bg_color'));
					$bg_overlay = max(0, min(1, themerex_get_custom_option('testimonials_bg_overlay')));
					if ($bg_overlay > 0) {
						$rgb = themerex_hex2rgb($bg_color);
						$over_color = 'rgba('.(int)$rgb['r'].','.(int)$rgb['g'].','.(int)$rgb['b'].','.(float)$bg_overlay.')';
					}
					?>
					<footer class="testimonials_wrap sc_section bg_tint_<?php echo esc_attr($show); ?>" style="<?php echo ($bg_image ? 'background-image: url('.esc_url($bg_image).');' : '') . ($bg_color ? 'background-color:'.esc_attr($bg_color).';' : ''); ?>">
						<div class="sc_section_overlay" data-bg_color="<?php echo esc_attr($bg_color); ?>" data-overlay="<?php echo esc_attr($bg_overlay); ?>"<?php echo ($bg_overlay > 0 ? ' style="background-color:'. esc_attr($over_color).';"' : ''); ?>>
							<div class="content_wrap"><?php echo ($data); ?></div>
						</div>
					</footer>
					<?php
				}
			}


			// Footer Twitter stream
			$show = themerex_get_custom_option('show_twitter_in_footer');
			if (!themerex_sc_param_is_off($show)) { 
				$count = max(1, themerex_get_custom_option('twitter_count'));
				$data = do_shortcode('[trx_twitter count="'.esc_attr($count).'"]');
				if ($data) {
					$bg_image = themerex_get_custom_option('twitter_bg_image');
					$bg_color = apply_filters('themerex_filter_get_link_color', themerex_get_custom_option('twitter_bg_color'));
					$bg_overlay = max(0, min(1, themerex_get_custom_option('twitter_bg_overlay')));
					if ($bg_overlay > 0) {
						$rgb = themerex_hex2rgb($bg_color);
						$over_color = 'rgba('.(int)$rgb['r'].','.(int)$rgb['g'].','.(int)$rgb['b'].','.(float)$bg_overlay.')';
					}
					?>
					<footer class="twitter_wrap sc_section bg_tint_<?php echo esc_attr($show); ?>" style="<?php echo ($bg_image ? 'background-image: url('.esc_url($bg_image).');' : '') . ($bg_color ? 'background-color:'.esc_url($bg_color).';' : ''); ?>">
						<div class="sc_section_overlay" data-bg_color="<?php echo esc_attr($bg_color); ?>" data-overlay="<?php echo esc_attr($bg_overlay); ?>"<?php echo ($bg_overlay > 0 ? ' style="background-color:'. esc_attr($over_color).';"' : ''); ?>>
							<div class="content_wrap"><?php echo ($data); ?></div>
						</div>
					</footer>
					<?php
				}
			}


			// Google map
			if ( themerex_get_custom_option('show_googlemap')=='yes' ) { 
				$map_address = themerex_get_custom_option('googlemap_address');
				$map_latlng  = themerex_get_custom_option('googlemap_latlng');
				$map_zoom    = themerex_get_custom_option('googlemap_zoom');
				$map_style   = themerex_get_custom_option('googlemap_style');
				$map_height  = themerex_get_custom_option('googlemap_height');
				if (!empty($map_address) || !empty($map_latlng)) {
					echo do_shortcode('[trx_googlemap'
							. (!empty($map_address) ? ' address="'.esc_attr($map_address).'"' : '')
							. (!empty($map_latlng)  ? ' latlng="'.esc_attr($map_latlng).'"' : '')
							. (!empty($map_style)   ? ' style="'.esc_attr($map_style).'"' : '')
							. (!empty($map_zoom)    ? ' zoom="'.esc_attr($map_zoom).'"' : '')
							. (!empty($map_height)  ? ' height="'.esc_attr($map_height).'"' : '')
							. ']');
				}
			}

			// Footer contacts
			if (($contacts_style = themerex_get_custom_option('show_contacts_in_footer')) != 'hide'  ) { 
				$address_1 = themerex_get_theme_option('contact_address_1');
				$address_2 = themerex_get_theme_option('contact_address_2');
				$phone = themerex_get_theme_option('contact_phone');
				$fax = themerex_get_theme_option('contact_fax');
				if (!empty($address_1) || !empty($address_2) || !empty($phone) || !empty($fax)) {
					?>
					<footer class="contacts_wrap bg_tint_<?php echo esc_attr($contacts_style); ?> contacts_style_<?php echo esc_attr($contacts_style); ?>">
						<div class="content_wrap">
							<div class="logo">
								<a href="<?php echo home_url(); ?>"><?php echo ($THEMEREX_GLOBALS['logo_footer'] ? '<img src="'.esc_url($THEMEREX_GLOBALS['logo_footer']).'" alt="">' : ''); ?><?php echo ($THEMEREX_GLOBALS['logo_text'] ? '<span class="logo_text">'.($THEMEREX_GLOBALS['logo_text']).'</span>' : ''); ?></a>
							</div>
							<div class="contacts_address">
								<address class="address_right">
									<?php if (!empty($phone)) echo __('Phone:', 'themerex') . ' ' . ($phone) . '<br>'; ?>
									<?php if (!empty($fax)) echo __('Fax:', 'themerex') . ' ' . ($fax); ?>
								</address>
								<address class="address_left">
									<?php if (!empty($address_2)) echo ($address_2) . '<br>'; ?>
									<?php if (!empty($address_1)) echo ($address_1); ?>
								</address>
							</div>
							<?php echo do_shortcode('[trx_socials size="big"][/trx_socials]'); ?>
						</div>	<!-- /.content_wrap -->
					</footer>	<!-- /.contacts_wrap -->
					<?php
				}
			}

			// Copyright area
			if (themerex_get_custom_option('show_copyright_in_footer')=='yes') {
			?> 
				<div class="copyright_wrap">
					<div class="content_wrap">
						<?php echo force_balance_tags(themerex_get_theme_option('footer_copyright')); ?> 
					</div>
				</div>
			<?php } ?>
			
		</div>	<!-- /.page_wrap -->

	</div>		<!-- /.body_wrap -->

<?php
if (themerex_get_custom_option('show_theme_customizer')=='yes') {
	require_once( themerex_get_file_dir('core/core.customizer/front.customizer.php') );
}
?>

<a href="#" class="scroll_to_top icon-up-2" title="<?php _e('Scroll to top', 'themerex'); ?>"></a>

<div class="custom_html_section">
<?php echo force_balance_tags(themerex_get_custom_option('custom_code')); ?>
</div>

<?php echo force_balance_tags(themerex_get_custom_option('gtm_code2')); ?>



<?php wp_footer(); ?>

</body>
</html>