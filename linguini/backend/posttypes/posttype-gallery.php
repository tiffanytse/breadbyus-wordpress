<?php

/*

@name 			Gallery Post Type
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

if (!function_exists('gp_register_gallery')) {

	function gp_register_gallery() {
		
		register_post_type('gallery',
			array (
				'labels' => array(
					'name'					=> __('Galleries', 'gp'),
					'menu_name'				=> __('Galleries', 'gp'),
					'singular_name'			=> __('Gallery', 'gp'),
					'all_items'				=> __('All Galleries', 'gp'),
					'add_new'				=> __('Add New Gallery', 'gp'),
					'add_new_item'			=> __('Add New Gallery', 'gp'),
					'edit_item'				=> __('Edit Gallery', 'gp'),
					'new_item'				=> __('New Gallery', 'gp'),
					'view_item'				=> __('View Gallery', 'gp'),
					'search_items'			=> __('Search Galleries', 'gp'),
					'not_found'				=> __('No Galleries', 'gp'),
					'not_found_in_trash'	=> __('No Galleries Found in Trash', 'gp')
				),
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_nav_menus' 	=> true,
				'capability_type'		=> 'post',
				'hierarchical'			=> true,
				'exclude_from_search'	=> false,
				'publicly_queryable'	=> true,
				'query_var'				=> true,
				'rewrite'				=> array(
					'slug'					=> 'gallery',
					'with_front'			=> false
				),
				'menu_position'			=> 49,
				'menu_icon'				=> trailingslashit(get_template_directory_uri()) . 'backend/images/icons/icon-gallery.png',
				'supports'				=> array(
					'title',
					'editor',
					'thumbnail',
					'comments',
					'revisions'
				)
			)
		);

	}
	
	add_action('init', 'gp_register_gallery');

}

/*
====================================================================================================
Post Type Icon
====================================================================================================
*/

if (!function_exists('gp_gallery_icon')) {

	function gp_gallery_icon() {
	?>
	
		<style type="text/css" media="screen">
			#icon-edit.icon32-posts-gallery {
			    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-gallery32.png") no-repeat;
            }
			@media
            only screen and (-webkit-min-device-pixel-ratio: 2),
            only screen and (-o-min-device-pixel-ratio: 2/1),
            only screen and (min--moz-device-pixel-ratio: 2),
            only screen and (min-device-pixel-ratio: 2),
            only screen and (min-resolution: 192dpi),
            only screen and (min-resolution: 2dppx) {
                #menu-posts-gallery .wp-menu-image {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-gallery@2x.png") no-repeat;
                    -webkit-background-size: 16px 16px;
                    -moz-background-size: 16px 16px;
                    -o-background-size: 16px 16px;
                    background-size: 16px 16px;
                    background-position: center center;
                }
                #menu-posts-gallery .wp-menu-image img {
                    display: none;
                }
                #icon-edit.icon32-posts-gallery {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-gallery32@2x.png") no-repeat;
                    -webkit-background-size: 32px 32px;
                    -moz-background-size: 32px 32px;
                    -o-background-size: 32px 32px;
                    background-size: 32px 32px;
                }
            }
		</style>
	
	<?php 
	}
	
	add_action('admin_head', 'gp_gallery_icon');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_gallery')) {

	function gp_register_metabox_gallery() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Gallery Images
		--------------------------------------------------
		*/
	
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-gallery',
			'title'				=> __('Gallery Images', 'gp'),
			'pages'				=> array('gallery'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Upload Images', 'gp'),
					'desc'				=> __('Drop images into the uploader or click to Select Files button.', 'gp'),
					'id'				=> GP_SHORTNAME . '_gallery_images',
					'type'				=> 'upload_plupload'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_gallery');

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

if (!function_exists('gp_columns_edit_gallery')) {

	function gp_columns_edit_gallery($columns) {
		
		$columns = array(
			'cb'				=> "<input type=\"checkbox\" />",
			'title'				=> __('Gallery Title', 'gp'),
			'author'			=> __('Author', 'gp'),
			'date'				=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-gallery_columns', 'gp_columns_edit_gallery');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_columns_edit_sorting_gallery')) {

	function gp_columns_edit_sorting_gallery($column) {
		
		return array(
			'title'				=> 'title',
			'author'			=> 'author',
			'date'				=> 'date'
		);
		
	}
	
	add_filter('manage_edit-gallery_sortable_columns', 'gp_columns_edit_sorting_gallery');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_gallery')) {

	function gp_messages_gallery($messages) {
		global $post, $post_ID;
		
		$messages['gallery'] = array(
			0		=> '',
			1		=> sprintf(__('Gallery updated. <a href="%s">View gallery &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Gallery updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Gallery restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Gallery published. <a href="%s">View gallery &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Gallery saved.', 'gp'),
			8		=> sprintf(__('Gallery submitted. <a target="_blank" href="%s">Preview gallery &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Gallery scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview gallery &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Gallery draft updated. <a target="_blank" href="%s">Preview gallery &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_gallery');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_gallery')) {

	function gp_title_placeholder_gallery($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'gallery') {
			$title = __('Enter gallery title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_gallery');

}