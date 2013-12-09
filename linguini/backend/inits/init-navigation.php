<?php

/*

@name			GPanel Navigation Init
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Register Navigation
====================================================================================================
*/

if (!function_exists('gp_menus')) {

	function gp_menus() {
		
		register_nav_menus(
			array(
				'primary_navigation' => __('Primary navigation', 'gp')
			)
		);
		
	}
	
	add_action('init', 'gp_menus');

}

?>