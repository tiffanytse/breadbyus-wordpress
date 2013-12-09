<?php

/*

@name 			Callout Post Type
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Post Type Register
====================================================================================================
*/

if (!function_exists('gp_register_callout')) {

	function gp_register_callout() {
		
		register_post_type('callout',
			array (
				'labels' => array(
					'name'					=> __('Callouts', 'gp'),
					'menu_name'				=> __('Callouts', 'gp'),
					'singular_name'			=> __('Callout', 'gp'),
					'all_items'				=> __('All Callouts', 'gp'),
					'add_new'				=> __('Add New Callout', 'gp'),
					'add_new_item'			=> __('Add New Callout', 'gp'),
					'edit_item'				=> __('Edit Callout', 'gp'),
					'new_item'				=> __('New Callout', 'gp'),
					'view_item'				=> __('View Callout', 'gp'),
					'search_items'			=> __('Search Callouts', 'gp'),
					'not_found'				=> __('No Callouts', 'gp'),
					'not_found_in_trash'	=> __('No Callouts Found in Trash', 'gp')
				),
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_nav_menus' 	=> false,
				'capability_type'		=> 'post',
				'hierarchical'			=> true,
				'exclude_from_search'	=> true,
				'publicly_queryable'	=> false,
				'query_var'				=> true,
				'rewrite'				=> array(
					'slug'					=> 'callout',
					'with_front'			=> false
				),
				'menu_position'			=> 45,
				'menu_icon'				=> trailingslashit(get_template_directory_uri()) . 'backend/images/icons/icon-callout.png',
				'supports'				=> array(
					'title',
					'thumbnail',
					'excerpt'
				)
			)
		);

	}
	
	add_action('init', 'gp_register_callout');

}

/*
====================================================================================================
Post Type Icon
====================================================================================================
*/

if (!function_exists('gp_icon_callout')) {

	function gp_icon_callout() {
	?>
	
		<style type="text/css" media="screen">
			#icon-edit.icon32-posts-callout {
			    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-callout32.png") no-repeat;
            }
			@media
            only screen and (-webkit-min-device-pixel-ratio: 2),
            only screen and (-o-min-device-pixel-ratio: 2/1),
            only screen and (min--moz-device-pixel-ratio: 2),
            only screen and (min-device-pixel-ratio: 2),
            only screen and (min-resolution: 192dpi),
            only screen and (min-resolution: 2dppx) {
                #menu-posts-callout .wp-menu-image {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-callout@2x.png") no-repeat;
                    -webkit-background-size: 16px 16px;
                    -moz-background-size: 16px 16px;
                    -o-background-size: 16px 16px;
                    background-size: 16px 16px;
                    background-position: center center;
                }
                #menu-posts-callout .wp-menu-image img {
                    display: none;
                }
                #icon-edit.icon32-posts-callout {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-callout32@2x.png") no-repeat;
                    -webkit-background-size: 32px 32px;
                    -moz-background-size: 32px 32px;
                    -o-background-size: 32px 32px;
                    background-size: 32px 32px;
                }
            }
		</style>
	
	<?php 
	}
	
	add_action('admin_head', 'gp_icon_callout');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_callout')) {

	function gp_register_metabox_callout() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Callout Options
		--------------------------------------------------
		*/
	
		if (get_theme_mod('gp_color_secondary')) {
			$color_secondary = get_theme_mod('gp_color_secondary');
		} else {
			$color_secondary = '#cd503c';
		}
	
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-callout',
			'title'				=> __('Callout Options', 'gp'),
			'pages'				=> array('callout'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Show Title', 'gp'),
					'id'				=> GP_SHORTNAME . '_callout_title',
					'type'				=> 'checkbox',
					'std'				=> '1'
				),
				array(
					'name'				=> __('The URL', 'gp'),
					'desc'				=> __('Insert the URL you wish to link to.', 'gp'),
					'id'				=> GP_SHORTNAME . '_callout_url',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Description', 'gp'),
					'desc'				=> __('Fill the description of the callout. Shotcodes and HTML allowed.', 'gp'),
					'id'				=> GP_SHORTNAME . '_callout_description',
					'type'				=> 'textarea'
				),
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_callout');

}

/*
====================================================================================================
Post Type Custom Columns
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Edit
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_columns_edit_callout')) {

	function gp_columns_edit_callout($columns) {
		
		$columns = array(
			'cb'				=> "<input type=\"checkbox\" />",
			'title'				=> __('Callout Block Title', 'gp'),
			'callout_url'		=> __('Callout URL', 'gp'),
			'author'			=> __('Author', 'gp'),
			'date'				=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-callout_columns', 'gp_columns_edit_callout');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_columns_edit_content_callout')) {

	function gp_columns_edit_content_callout($column, $post_ID) {
	
		switch($column) {
			
			// Callout URL
			case 'callout_url':
	
				$callout_url = gp_meta('gp_callout_url');
				if (empty($callout_url)) {
					echo __('/', 'gp');
				} else {
					printf('%s', $callout_url);
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_callout_posts_custom_column', 'gp_columns_edit_content_callout', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_columns_edit_sorting_callout')) {

	function gp_columns_edit_sorting_callout($column) {
		
		return array(
			'title'				=> 'title',
			'callout_url'		=> 'callout_url',
			'author'			=> 'author',
			'date'				=> 'date'
		);
		
	}
	
	add_filter('manage_edit-callout_sortable_columns', 'gp_columns_edit_sorting_callout');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_callout')) {

	function gp_messages_callout($messages) {
		global $post, $post_ID;
		
		$messages['callout'] = array(
			0		=> '',
			1		=> __('Callout block updated.', 'gp'),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Callout block updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Callout block restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> __('Callout block published.', 'gp'),
			7		=> __('Callout block saved.', 'gp'),
			8		=> __('Callout block submitted.', 'gp'),
			9		=> sprintf(__('Callout block scheduled for: <strong>%1$s</strong>.', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date))),
			10		=> __('Callout block draft updated.', 'gp'),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_callout');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_callout')) {

	function gp_title_placeholder_callout($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'callout') {
			$title = __('Enter callout block title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_callout');

}