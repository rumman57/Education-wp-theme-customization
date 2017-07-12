<?php
/**
 * ThemeREX Framework: global variables storage
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get global variable
if (!function_exists('themerex_get_global')) {
	function themerex_get_global($var_name) {
		global $THEMEREX_GLOBALS;
		return isset($THEMEREX_GLOBALS[$var_name]) ? $THEMEREX_GLOBALS[$var_name] : '';
	}
}

// Set global variable
if (!function_exists('themerex_set_global')) {
	function themerex_set_global($var_name, $value) {
		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS[$var_name] = $value;
	}
}

// Inc/Dec global variable with specified value
if (!function_exists('themerex_inc_global')) {
	function themerex_inc_global($var_name, $value=1) {
		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS[$var_name] += $value;
	}
}

// Concatenate global variable with specified value
if (!function_exists('themerex_concat_global')) {
	function themerex_concat_global($var_name, $value) {
		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS[$var_name] .= $value;
	}
}

// Get global array element
if (!function_exists('themerex_get_global_array')) {
	function themerex_get_global_array($var_name, $key) {
		global $THEMEREX_GLOBALS;
		return isset($THEMEREX_GLOBALS[$var_name][$key]) ? $THEMEREX_GLOBALS[$var_name][$key] : '';
	}
}

// Set global array element
if (!function_exists('themerex_set_global_array')) {
	function themerex_set_global_array($var_name, $key, $value) {
		global $THEMEREX_GLOBALS;
		if (!isset($THEMEREX_GLOBALS[$var_name])) $THEMEREX_GLOBALS[$var_name] = array();
		$THEMEREX_GLOBALS[$var_name][$key] = $value;
	}
}

// Inc/Dec global array element with specified value
if (!function_exists('themerex_inc_global_array')) {
	function themerex_inc_global_array($var_name, $key, $value=1) {
		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS[$var_name][$key] += $value;
	}
}

// Concatenate global array element with specified value
if (!function_exists('themerex_concat_global_array')) {
	function themerex_concat_global_array($var_name, $key, $value) {
		global $THEMEREX_GLOBALS;
		$THEMEREX_GLOBALS[$var_name][$key] .= $value;
	}
}
?>