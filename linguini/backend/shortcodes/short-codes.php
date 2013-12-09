<?php

/*

@name 			Shortcodes
@package		GPanel WordPress Framework
@since			3.0.2
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Shortcode Button
====================================================================================================
*/

function gp_shortcode_button($atts, $content = null) {
	
	if (get_theme_mod('gp_color_secondary')) {
		$color_secondary = get_theme_mod('gp_color_secondary');
	} else {
		$color_secondary = '#d2462d';
	}
	
	extract(shortcode_atts(array(
		'link'			=> '#',
		'target'		=> '_self',
		'size'			=> 'medium',
		'background'	=> $color_secondary
	), $atts));
	
	return '<div class="button button-shortcode ' . $size . '"><a href="' . $link . '" style="background-color: ' . $background . '" target="' . $target . '">' . do_shortcode($content) . '</a></div>';
   
}

/*
====================================================================================================
Shortcode Google Map
====================================================================================================
*/

function gp_shortcode_google_map($atts, $content = null) {
   
   extract(shortcode_atts(array(
      'width'			=> '100%',
      'height'			=> '480',
      'src'				=> ''
   ), $atts));
   
   return '<iframe width="' . $width . '" height="' . $height . '" src="' . $src . '&amp;output=embed" ></iframe>';
   
}

/*
====================================================================================================
Shortcode Image
====================================================================================================
*/

function gp_shortcode_image($atts) {
	
	extract(shortcode_atts(array(
		'src'			=> '',
		'alt'			=> '',
		'title'			=> '',
	), $atts));
	
	return '<img class="image" src="' . $src . '" alt="' . $alt . '" title="' . $title . '" />';
	
}

/*
====================================================================================================
Shortcode Lightbox
====================================================================================================
*/

function gp_shortcode_lightbox($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'link'			=> '',
		'src'			=> '',
		'alt'			=> '',
		'title'			=> ''
	), $atts ));
	
	if ($src == '') {
		return '<span class="lightbox"><a href="' . $link . '" title="' . $title . '">' . do_shortcode($content) . '</a></span>';
	} else {
		return '<span class="lightbox"><a href="' . $link . '" title="' . $title . '"><img class="image" src="' . $src . '" alt="' . $alt . '" /></a></span>';
	}
	
}

/*
====================================================================================================
Shortcode Alert
====================================================================================================
*/

function gp_shortcode_alert($atts, $content = null) {
	
	if (get_theme_mod('gp_color_secondary')) {
		$color_secondary = get_theme_mod('gp_color_secondary');
	} else {
		$color_secondary = '#cd503c';
	}
	
	extract(shortcode_atts(array(
		'close'			=> 'true',
		'background'	=> $color_secondary,
		'color'			=> '#ffffff'
	), $atts));
	
	if ($close == 'true') {
		return '<div class="alert" style="background-color: ' . $background . '; color:' . $color . '">' . do_shortcode($content) . '<span class="close">&times;</span></div>';
	} else {
		return '<div class="alert" style="background-color: ' . $background . '; color:' . $color . '">' . do_shortcode($content) . '</div>';
	}
	
}

/*
====================================================================================================
Shortcode Blockquote
====================================================================================================
*/

function gp_shortcode_blockquote($atts, $content = null) {

	return '<blockquote>' . do_shortcode($content) . '</blockquote>';

}

/*
====================================================================================================
Shortcode Code
====================================================================================================
*/

function gp_shortcode_code($atts, $content = null) {

	return '<code>' . do_shortcode($content) . '</code>';

}

/*
====================================================================================================
Shortcode Divider
====================================================================================================
*/

function gp_shortcode_divider($atts) {
	
	return '<div class="divider clearfix"></div>';
	
}

/*
====================================================================================================
Tabs
====================================================================================================
*/

function gp_tab_group($atts, $content) {
	$GLOBALS['tab_count'] = 0;

	do_shortcode($content);

	if (is_array($GLOBALS['tabs'])) {
		$int = '1';

		foreach($GLOBALS['tabs'] as $tab) {
			
			
			$tabs[] = '
				<li><a href="#tab-' . $int . '">' . $tab['title'] . '</a></li>
			';
			
			$panes[] = '
				<div id="tab-' . $int . '">
					<h3>' . $tab['title'] . '</h3>
					' . $tab['content'] . '
				</div>
			';
			
		$int++;
		}

		$return = '
			<div class="tabs gp-tabs ui-tabs ui-widget ui-widget-content ui-corner-all">
				<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">' . implode($tabs) . '</ul>' . implode($panes) . '
			</div>
		';
		
	}
	
	return $return;

}

function gp_tab($atts, $content) {
	
	extract(shortcode_atts(
		array(
			'title'		=> 'Tab %d'
		),
		$atts
	));

	$x = $GLOBALS['tab_count'];
	
	$GLOBALS['tabs'][$x] = array(
		'title'		=> sprintf($title, $GLOBALS['tab_count']),
		'content'	=> do_shortcode($content)
	);
	
	$GLOBALS['tab_count']++;
	
}

/*
====================================================================================================
Shortcode Columns
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
|----------|:::::::::| One Half
----------------------------------------------------------------------------------------------------
*/

function gp_shortcode_one_half($atts, $content = null) {
	
	return '<div class="shortcode one-half">' . do_shortcode($content) . '</div>';
	
}

function gp_shortcode_one_half_last($atts, $content = null) {
	
	return '<div class="shortcode one-half last">' . do_shortcode($content) . '</div>';
	
}

/*
----------------------------------------------------------------------------------------------------
|------|::::::|::::::| One Third
----------------------------------------------------------------------------------------------------
*/

function gp_shortcode_one_third($atts, $content = null) {
	
	return '<div class="shortcode one-third">' . do_shortcode($content) . '</div>';
	
}

function gp_shortcode_one_third_last($atts, $content = null) {
	
	return '<div class="shortcode one-third last">' . do_shortcode($content) . '</div>';
	
}

/*
----------------------------------------------------------------------------------------------------
|------|------|::::::| Two Third
----------------------------------------------------------------------------------------------------
*/

function gp_shortcode_two_third($atts, $content = null) {
	
	return '<div class="shortcode two-third">' . do_shortcode($content) . '</div>';
	
}

function gp_shortcode_two_third_last($atts, $content = null) {
	
	return '<div class="shortcode two-third last">' . do_shortcode($content) . '</div>';
	
}

/*
----------------------------------------------------------------------------------------------------
|-----|::::|::::|::::| One Fourth
----------------------------------------------------------------------------------------------------
*/

function gp_shortcode_one_fourth($atts, $content = null) {
	
	return '<div class="shortcode one-fourth">' . do_shortcode($content) . '</div>';
	
}

function gp_shortcode_one_fourth_last($atts, $content = null) {
	
	return '<div class="shortcode one-fourth last">' . do_shortcode($content) . '</div>';
	
}

/*
----------------------------------------------------------------------------------------------------
|-----|----|::::|::::| Two Fourth
----------------------------------------------------------------------------------------------------
*/

function gp_shortcode_two_fourth($atts, $content = null) {
	
	return '<div class="shortcode two-fourth">' . do_shortcode($content) . '</div>';
	
}

function gp_shortcode_two_fourth_last($atts, $content = null) {
	
	return '<div class="shortcode two-fourth last">' . do_shortcode($content) . '</div>';
	
}

/*
----------------------------------------------------------------------------------------------------
|-----|----|----|::::| Three Fourth
----------------------------------------------------------------------------------------------------
*/

function gp_shortcode_three_fourth($atts, $content = null) {
	
	return '<div class="shortcode three-fourth">' . do_shortcode($content) . '</div>';
	
}

function gp_shortcode_three_fourth_last($atts, $content = null) {
	
	return '<div class="shortcode three-fourth last">' . do_shortcode($content) . '</div>';
	
}

/*
----------------------------------------------------------------------------------------------------
|----|:::|:::|:::|:::| One Fifth
----------------------------------------------------------------------------------------------------
*/

function gp_shortcode_one_fifth($atts, $content = null) {
	
	return '<div class="shortcode one-fifth">' . do_shortcode($content) . '</div>';
	
}

function gp_shortcode_one_fifth_last($atts, $content = null) {
	
	return '<div class="shortcode one-fifth last">' . do_shortcode($content) . '</div>';
	
}

/*
----------------------------------------------------------------------------------------------------
|----|---|:::|:::|:::| Two Fifth
----------------------------------------------------------------------------------------------------
*/

function gp_shortcode_two_fifth($atts, $content = null) {
	
	return '<div class="shortcode two-fifth">' . do_shortcode($content) . '</div>';
	
}

function gp_shortcode_two_fifth_last($atts, $content = null) {
	
	return '<div class="shortcode two-fifth last">' . do_shortcode($content) . '</div>';
	
}

/*
----------------------------------------------------------------------------------------------------
|----|---|---|:::|:::| Three Fifth
----------------------------------------------------------------------------------------------------
*/

function gp_shortcode_three_fifth($atts, $content = null) {
	
	return '<div class="shortcode three-fifth">' . do_shortcode($content) . '</div>';
	
}

function gp_shortcode_three_fifth_last($atts, $content = null) {
	
	return '<div class="shortcode three-fifth last">' . do_shortcode($content) . '</div>';
	
}

/*
----------------------------------------------------------------------------------------------------
|----|---|---|---|:::| Four Fifth
----------------------------------------------------------------------------------------------------
*/

function gp_shortcode_four_fifth($atts, $content = null) {
	
	return '<div class="shortcode four-fifth">' . do_shortcode($content) . '</div>';
	
}

function gp_shortcode_four_fifth_last($atts, $content = null) {
	
	return '<div class="shortcode four-fifth last">' . do_shortcode($content) . '</div>';
	
}

?>