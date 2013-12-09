<?php

/*

@name 			Global Metabox [SEO]
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/


/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_global')) {

	function gp_register_metabox_global() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		$post_types = get_post_types();
		
		/*
		--------------------------------------------------
		SEO Settings
		--------------------------------------------------
		*/
	
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-global',
			'title'				=> __('SEO Settings', 'gp'),
			'pages'				=> $post_types,
			'fields'			=> array(
				array(
					'name'				=> __('Keywords', 'gp'),
					'desc'				=> __('Fill the meta keywords for this page/post. Separated by comma.', 'gp'),
					'id'				=> GP_SHORTNAME . '_page_keywords',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Description', 'gp'),
					'desc'				=> __('Fill the meta description for this page/post. Maximum of 160 characters.', 'gp'),
					'id'				=> GP_SHORTNAME . '_page_description',
					'type'				=> 'textarea'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_global');

}