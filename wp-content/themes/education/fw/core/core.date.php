<?php
/**
 * ThemeREX Framework: date and time manipulations
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Convert date from MySQL format (YYYY-mm-dd) to Date (dd.mm.YYYY)
if (!function_exists('themerex_sql_to_date')) {
	function themerex_sql_to_date($str) {
		return (trim($str)=='' || trim($str)=='0000-00-00' ? '' : trim(themerex_substr($str,8,2).'.'.themerex_substr($str,5,2).'.'.themerex_substr($str,0,4).' '.themerex_substr($str,11)));
	}
}

// Convert date from Date format (dd.mm.YYYY) to MySQL format (YYYY-mm-dd)
if (!function_exists('themerex_date_to_sql')) {
	function themerex_date_to_sql($str) {
		if (trim($str)=='') return '';
		$str = strtr(trim($str),'/\-,','....');
		if (trim($str)=='00.00.0000' || trim($str)=='00.00.00') return '';
		$pos = themerex_strpos($str,'.');
		$d=trim(themerex_substr($str,0,$pos));
		$str=themerex_substr($str,$pos+1);
		$pos = themerex_strpos($str,'.');
		$m=trim(themerex_substr($str,0,$pos));
		$y=trim(themerex_substr($str,$pos+1));
		$y=($y<50?$y+2000:($y<1900?$y+1900:$y));
		return ''.($y).'-'.(themerex_strlen($m)<2?'0':'').($m).'-'.(themerex_strlen($d)<2?'0':'').($d);
	}
}

// Return difference or date
if (!function_exists('themerex_get_date_or_difference')) {
	function themerex_get_date_or_difference($dt1, $dt2=null, $max_days=-1) {
		static $gmt_offset = 999;
		if ($gmt_offset==999) $gmt_offset = (int) get_option('gmt_offset');
		if ($max_days < 0) $max_days = themerex_get_theme_option('show_date_after', 30);
		if ($dt2 == null) $dt2 = date('Y-m-d H:i:s');
		$dt2n = strtotime($dt2)+$gmt_offset*3600;
		$dt1n = strtotime($dt1);
		$diff = $dt2n - $dt1n;
		$days = floor($diff / (24*3600));
		if (abs($days) < $max_days)
			return sprintf($days >= 0 ? __('%s ago', 'themerex') : __('after %s', 'themerex'), themerex_get_date_difference($days >= 0 ? $dt1 : $dt2, $days >= 0 ? $dt2 : $dt1));
		else
			return themerex_get_date_translations(date(get_option('date_format'), $dt1n));
	}
}

// Difference between two dates
if (!function_exists('themerex_get_date_difference')) {
	function themerex_get_date_difference($dt1, $dt2=null, $short=1, $sec = false) {
		static $gmt_offset = 999;
		if ($gmt_offset==999) $gmt_offset = (int) get_option('gmt_offset');
		if ($dt2 == null) $dt2 = time()+$gmt_offset*3600;
		else $dt2 = strtotime($dt2);
		$dt1 = strtotime($dt1);
		$diff = $dt2 - $dt1;
		$days = floor($diff / (24*3600));
		$months = floor($days / 30);
		$diff -= $days * 24 * 3600;
		$hours = floor($diff / 3600);
		$diff -= $hours * 3600;
		$min = floor($diff / 60);
		$diff -= $min * 60;
		$rez = '';
		if ($months > 0 && $short == 2)
			$rez .= ($rez!='' ? ' ' : '') . sprintf($months > 1 ? __('%s months', 'themerex') : __('%s month', 'themerex'), $months);
		if ($days > 0 && ($short < 2 || $rez==''))
			$rez .= ($rez!='' ? ' ' : '') . sprintf($days > 1 ? __('%s days', 'themerex') : __('%s day', 'themerex'), $days);
		if ((!$short || $rez=='') && $hours > 0)
			$rez .= ($rez!='' ? ' ' : '') . sprintf($hours > 1 ? __('%s hours', 'themerex') : __('%s hour', 'themerex'), $hours);
		if ((!$short || $rez=='') && $min > 0)
			$rez .= ($rez!='' ? ' ' : '') . sprintf($min > 1 ? __('%s minutes', 'themerex') : __('%s minute', 'themerex'), $min);
		if ($sec || $rez=='')
			$rez .=  $rez!='' || $sec ? (' ' . sprintf($diff > 1 ? __('%s seconds', 'themerex') : __('%s second', 'themerex'), $diff)) : __('less then minute', 'themerex');
		return $rez;
	}
}

// Prepare month names in date for translation
if (!function_exists('themerex_get_date_translations')) {
	function themerex_get_date_translations($dt) {
		return str_replace(
			array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
				  'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
			array(
				__('January', 'themerex'),
				__('February', 'themerex'),
				__('March', 'themerex'),
				__('April', 'themerex'),
				__('May', 'themerex'),
				__('June', 'themerex'),
				__('July', 'themerex'),
				__('August', 'themerex'),
				__('September', 'themerex'),
				__('October', 'themerex'),
				__('November', 'themerex'),
				__('December', 'themerex'),
				__('Jan', 'themerex'),
				__('Feb', 'themerex'),
				__('Mar', 'themerex'),
				__('Apr', 'themerex'),
				__('May', 'themerex'),
				__('Jun', 'themerex'),
				__('Jul', 'themerex'),
				__('Aug', 'themerex'),
				__('Sep', 'themerex'),
				__('Oct', 'themerex'),
				__('Nov', 'themerex'),
				__('Dec', 'themerex'),
			),
			$dt);
	}
}
?>