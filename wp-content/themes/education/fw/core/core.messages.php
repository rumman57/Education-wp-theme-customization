<?php
/**
 * ThemeREX Framework: messages subsystem
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('themerex_messages_theme_setup')) {
	add_action( 'themerex_action_before_init_theme', 'themerex_messages_theme_setup' );
	function themerex_messages_theme_setup() {
		// Core messages strings
		add_action('themerex_action_add_scripts_inline', 'themerex_messages_add_scripts_inline');
	}
}


/* Session messages
------------------------------------------------------------------------------------- */

if (!function_exists('themerex_get_error_msg')) {
	function themerex_get_error_msg() {
		global $THEMEREX_GLOBALS;
		return !empty($THEMEREX_GLOBALS['error_msg']) ? $THEMEREX_GLOBALS['error_msg'] : '';
	}
}

if (!function_exists('themerex_set_error_msg')) {
	function themerex_set_error_msg($msg) {
		global $THEMEREX_GLOBALS;
		$msg2 = themerex_get_error_msg();
		$THEMEREX_GLOBALS['error_msg'] = $msg2 . ($msg2=='' ? '' : '<br />') . ($msg);
	}
}

if (!function_exists('themerex_get_success_msg')) {
	function themerex_get_success_msg() {
		global $THEMEREX_GLOBALS;
		return !empty($THEMEREX_GLOBALS['success_msg']) ? $THEMEREX_GLOBALS['success_msg'] : '';
	}
}

if (!function_exists('themerex_set_success_msg')) {
	function themerex_set_success_msg($msg) {
		global $THEMEREX_GLOBALS;
		$msg2 = themerex_get_success_msg();
		$THEMEREX_GLOBALS['success_msg'] = $msg2 . ($msg2=='' ? '' : '<br />') . ($msg);
	}
}

if (!function_exists('themerex_get_notice_msg')) {
	function themerex_get_notice_msg() {
		global $THEMEREX_GLOBALS;
		return !empty($THEMEREX_GLOBALS['notice_msg']) ? $THEMEREX_GLOBALS['notice_msg'] : '';
	}
}

if (!function_exists('themerex_set_notice_msg')) {
	function themerex_set_notice_msg($msg) {
		global $THEMEREX_GLOBALS;
		$msg2 = themerex_get_notice_msg();
		$THEMEREX_GLOBALS['notice_msg'] = $msg2 . ($msg2=='' ? '' : '<br />') . ($msg);
	}
}


/* System messages (save when page reload)
------------------------------------------------------------------------------------- */
if (!function_exists('themerex_set_system_message')) {
	function themerex_set_system_message($msg, $status='info', $hdr='') {
		update_option('themerex_message', array('message' => $msg, 'status' => $status, 'header' => $hdr));
	}
}

if (!function_exists('themerex_get_system_message')) {
	function themerex_get_system_message($del=false) {
		$msg = get_option('themerex_message', false);
		if (!$msg)
			$msg = array('message' => '', 'status' => '', 'header' => '');
		else if ($del)
			themerex_del_system_message();
		return $msg;
	}
}

if (!function_exists('themerex_del_system_message')) {
	function themerex_del_system_message() {
		delete_option('themerex_message');
	}
}


/* Messages strings
------------------------------------------------------------------------------------- */

if (!function_exists('themerex_messages_add_scripts_inline')) {
	function themerex_messages_add_scripts_inline() {
		global $THEMEREX_GLOBALS;
		echo '<script type="text/javascript">'
			. 'jQuery(document).ready(function() {'
			// Strings for translation
			. 'THEMEREX_GLOBALS["strings"] = {'
				. 'bookmark_add: 		"' . addslashes(__('Add the bookmark', 'themerex')) . '",'
				. 'bookmark_added:		"' . addslashes(__('Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab \'Bookmarks\'', 'themerex')) . '",'
				. 'bookmark_del: 		"' . addslashes(__('Delete this bookmark', 'themerex')) . '",'
				. 'bookmark_title:		"' . addslashes(__('Enter bookmark title', 'themerex')) . '",'
				. 'bookmark_exists:		"' . addslashes(__('Current page already exists in the bookmarks list', 'themerex')) . '",'
				. 'search_error:		"' . addslashes(__('Error occurs in AJAX search! Please, type your query and press search icon for the traditional search way.', 'themerex')) . '",'
				. 'email_confirm:		"' . addslashes(__('On the e-mail address <b>%s</b> we sent a confirmation email.<br>Please, open it and click on the link.', 'themerex')) . '",'
				. 'reviews_vote:		"' . addslashes(__('Thanks for your vote! New average rating is:', 'themerex')) . '",'
				. 'reviews_error:		"' . addslashes(__('Error saving your vote! Please, try again later.', 'themerex')) . '",'
				. 'error_like:			"' . addslashes(__('Error saving your like! Please, try again later.', 'themerex')) . '",'
				. 'error_global:		"' . addslashes(__('Global error text', 'themerex')) . '",'
				. 'name_empty:			"' . addslashes(__('The name can\'t be empty', 'themerex')) . '",'
				. 'name_long:			"' . addslashes(__('Too long name', 'themerex')) . '",'
				. 'email_empty:			"' . addslashes(__('Too short (or empty) email address', 'themerex')) . '",'
				. 'email_long:			"' . addslashes(__('Too long email address', 'themerex')) . '",'
				. 'email_not_valid:		"' . addslashes(__('Invalid email address', 'themerex')) . '",'
				. 'subject_empty:		"' . addslashes(__('The subject can\'t be empty', 'themerex')) . '",'
				. 'subject_long:		"' . addslashes(__('Too long subject', 'themerex')) . '",'
				. 'text_empty:			"' . addslashes(__('The message text can\'t be empty', 'themerex')) . '",'
				. 'text_long:			"' . addslashes(__('Too long message text', 'themerex')) . '",'
				. 'send_complete:		"' . addslashes(__("Send message complete!", 'themerex')) . '",'
				. 'send_error:			"' . addslashes(__('Transmit failed!', 'themerex')) . '",'
				. 'login_empty:			"' . addslashes(__('The Login field can\'t be empty', 'themerex')) . '",'
				. 'login_long:			"' . addslashes(__('Too long login field', 'themerex')) . '",'
				. 'login_success:		"' . addslashes(__('Login success! The page will be reloaded in 3 sec.', 'themerex')) . '",'
				. 'login_failed:		"' . addslashes(__('Login failed!', 'themerex')) . '",'
				. 'password_empty:		"' . addslashes(__('The password can\'t be empty and shorter then 4 characters', 'themerex')) . '",'
				. 'password_long:		"' . addslashes(__('Too long password', 'themerex')) . '",'
				. 'password_not_equal:	"' . addslashes(__('The passwords in both fields are not equal', 'themerex')) . '",'
				. 'registration_success:"' . addslashes(__('Registration success! Please log in!', 'themerex')) . '",'
				. 'registration_failed:	"' . addslashes(__('Registration failed!', 'themerex')) . '",'
				. 'geocode_error:		"' . addslashes(__('Geocode was not successful for the following reason:', 'wspace')) . '",'
				. 'googlemap_not_avail:	"' . addslashes(__('Google map API not available!', 'themerex')) . '",'
				. 'editor_save_success:	"' . addslashes(__("Post content saved!", 'themerex')) . '",'
				. 'editor_save_error:	"' . addslashes(__("Error saving post data!", 'themerex')) . '",'
				. 'editor_delete_post:	"' . addslashes(__("You really want to delete the current post?", 'themerex')) . '",'
				. 'editor_delete_post_header:"' . addslashes(__("Delete post", 'themerex')) . '",'
				. 'editor_delete_success:	"' . addslashes(__("Post deleted!", 'themerex')) . '",'
				. 'editor_delete_error:		"' . addslashes(__("Error deleting post!", 'themerex')) . '",'
				. 'editor_caption_cancel:	"' . addslashes(__('Cancel', 'themerex')) . '",'
				. 'editor_caption_close:	"' . addslashes(__('Close', 'themerex')) . '"'
				. '};'
			. '});'
			. '</script>';
	}
}
?>