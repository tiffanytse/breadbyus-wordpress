<?php

/*

@name			GPanel Shortcodes Init
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Register Shortcodes
====================================================================================================
*/

if (!function_exists('gp_register_shortcodes')) {

	function gp_register_shortcodes(){
		
		// Shortcode Button
		add_shortcode('button', 'gp_shortcode_button');
		// Shortcode Google Map
		add_shortcode('google_map', 'gp_shortcode_google_map');
		// Shortcode Image
		add_shortcode('image', 'gp_shortcode_image');
		// Shortcode Lightbox
		add_shortcode('lightbox', 'gp_shortcode_lightbox');
		// Shortcode Alert
		add_shortcode('alert', 'gp_shortcode_alert');
		// Shortcode Blockquote
		add_shortcode('blockquote', 'gp_shortcode_blockquote');
		// Shortcode Code
		add_shortcode('code', 'gp_shortcode_code');
		// Shortcode Divider
		add_shortcode('divider', 'gp_shortcode_divider');
		// Shortcode Tabs
		add_shortcode('tab_group', 'gp_tab_group');
		add_shortcode('tab', 'gp_tab');
		// Shortcode Columns
		add_shortcode('one_half', 'gp_shortcode_one_half');
		add_shortcode('one_half_last', 'gp_shortcode_one_half_last');
		
		add_shortcode('one_third', 'gp_shortcode_one_third');
		add_shortcode('one_third_last', 'gp_shortcode_one_third_last');
		add_shortcode('two_third', 'gp_shortcode_two_third');
		add_shortcode('two_third_last', 'gp_shortcode_two_third_last');
		
		add_shortcode('one_fourth', 'gp_shortcode_one_fourth');
		add_shortcode('one_fourth_last', 'gp_shortcode_one_fourth_last');
		add_shortcode('two_fourth', 'gp_shortcode_two_fourth');
		add_shortcode('two_fourth_last', 'gp_shortcode_two_fourth_last');
		add_shortcode('three_fourth', 'gp_shortcode_three_fourth');
		add_shortcode('three_fourth_last', 'gp_shortcode_three_fourth_last');
		
		add_shortcode('one_fifth', 'gp_shortcode_one_fifth');
		add_shortcode('one_fifth_last', 'gp_shortcode_one_fifth_last');
		add_shortcode('two_fifth', 'gp_shortcode_two_fifth');
		add_shortcode('two_fifth_last', 'gp_shortcode_two_fifth_last');
		add_shortcode('three_fifth', 'gp_shortcode_three_fifth');
		add_shortcode('three_fifth_last', 'gp_shortcode_three_fifth_last');
		add_shortcode('four_fifth', 'gp_shortcode_four_fifth');
		add_shortcode('four_fifth_last', 'gp_shortcode_four_fifth_last');
	
	}
	
	add_action('init', 'gp_register_shortcodes');

}

/*
====================================================================================================
Shortcodes Anywhere
====================================================================================================
*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');
add_filter('comment_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');

?>