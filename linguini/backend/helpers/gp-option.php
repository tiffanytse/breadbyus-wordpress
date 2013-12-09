<?php

/*

@name			Option Helper
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Get Theme Options
====================================================================================================
*/

if (!function_exists('gp_option')) {

	function gp_option($name) {
		
		$gp_option = get_option('gp_theme_options');
		
		if (is_array($gp_option) && array_key_exists((string)$name, $gp_option)) {
			return $gp_option[$name];
		}
		
		return false;
		
	}

}

?>