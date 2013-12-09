<?php

/*

@name 			Lunch Post Type
@package		GPanel WordPress Framework
@since			3.0.3
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Post Type Register
====================================================================================================
*/

if (!function_exists('gp_register_lunch')) {

	function gp_register_lunch() {
		
		register_post_type('menu-lunch',
			array (
				'labels' => array(
					'name'					=> __('Lunches', 'gp'),
					'menu_name'				=> __('Lunches', 'gp'),
					'singular_name'			=> __('Lunches', 'gp'),
					'all_items'				=> __('All Lunches', 'gp'),
					'add_new'				=> __('Add New Lunch', 'gp'),
					'add_new_item'			=> __('Add New Lunch', 'gp'),
					'edit_item'				=> __('Edit Lunch', 'gp'),
					'new_item'				=> __('New Lunch', 'gp'),
					'view_item'				=> __('View Lunch', 'gp'),
					'search_items'			=> __('Search Lunches', 'gp'),
					'not_found'				=> __('No Lunches', 'gp'),
					'not_found_in_trash'	=> __('No Lunches Found in Trash', 'gp')
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
					'slug'					=> 'lunch',
					'with_front'			=> false
				),
				'menu_position'			=> 47,
				'menu_icon'				=> trailingslashit(get_template_directory_uri()) . 'backend/images/icons/icon-menu.png',
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
	
	add_action('init', 'gp_register_lunch');

}

/*
====================================================================================================
Post Type Icon
====================================================================================================
*/

if (!function_exists('gp_lunch_icon')) {

	function gp_lunch_icon() {
	?>
	
		<style type="text/css" media="screen">
			#icon-edit.icon32-posts-menu-lunch {
			    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-menu32.png") no-repeat;
            }
			@media
            only screen and (-webkit-min-device-pixel-ratio: 2),
            only screen and (-o-min-device-pixel-ratio: 2/1),
            only screen and (min--moz-device-pixel-ratio: 2),
            only screen and (min-device-pixel-ratio: 2),
            only screen and (min-resolution: 192dpi),
            only screen and (min-resolution: 2dppx) {
                #menu-posts-menu-lunch .wp-menu-image {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-menu@2x.png") no-repeat;
                    -webkit-background-size: 16px 16px;
                    -moz-background-size: 16px 16px;
                    -o-background-size: 16px 16px;
                    background-size: 16px 16px;
                    background-position: center center;
                }
                #menu-posts-menu-lunch .wp-menu-image img {
                    display: none;
                }
                #icon-edit.icon32-posts-menu-lunch {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-menu32@2x.png") no-repeat;
                    -webkit-background-size: 32px 32px;
                    -moz-background-size: 32px 32px;
                    -o-background-size: 32px 32px;
                    background-size: 32px 32px;
                }
            }
		</style>
	
	<?php 
	}
	
	add_action('admin_head', 'gp_lunch_icon');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_lunch')) {

	function gp_register_metabox_lunch() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Lunch Options
		--------------------------------------------------
		*/
	
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-lunch-options',
			'title'				=> __('Lunch Options', 'gp'),
			'pages'				=> array('menu-lunch'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Prices', 'gp'),
					'desc'				=> __('Fill the prices of the lunch. Fill price with currency symbol. Example format: Bottle 0,5l ... $25', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_lunch_price',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Description', 'gp'),
					'desc'				=> __('Fill the description of the lunch.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_lunch_description',
					'type'				=> 'textarea'
				),
				array(
					'name'				=> __('Ingredients', 'gp'),
					'desc'				=> __('Fill the number of the lunch.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_lunch_ingredients',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Use Single Page', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_lunch_single',
					'type'				=> 'checkbox',
					'std'				=> '1'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_lunch');

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

if (!function_exists('gp_edit_columns_lunch')) {

	function gp_edit_columns_lunch($columns) {
		
		$columns = array(
			'cb'					=> "<input type=\"checkbox\" />",
			'title'					=> __('Title', 'gp'),
			'lunch_price'	        => __('Price', 'gp'),
			'author'				=> __('Author', 'gp'),
			'date'					=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-menu-lunch_columns', 'gp_edit_columns_lunch');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_content_lunch')) {

	function gp_edit_columns_content_lunch($column, $post_ID) {
	
		switch($column) {
			
			// Price
			case 'lunch_price':
	
				$lunch_price = gp_meta('gp_menu_lunch_price');
				if (empty($lunch_price)) {
					echo __('/', 'gp');
				} else {
					foreach ($lunch_price as $price) {
                        echo $price;
                        echo '<br />';
                    }
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_menu-lunch_posts_custom_column', 'gp_edit_columns_content_lunch', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Orderby
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_orderby_lunch')) {

	function gp_edit_columns_orderby_lunch($query) {
		  
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('lunch_price' == $orderby) {
			$query->set('meta_key', 'gp_menu_lunch_price');
			$query->set('orderby', 'meta_value');
		}
		
	}
	
	add_action('pre_get_posts', 'gp_edit_columns_orderby_lunch');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_sorting_lunch')) {

	function gp_edit_columns_sorting_lunch($column) {
		
		return array(
			'title'						 => 'title',
			'lunch_price'		         => 'lunch_price',
			'author'                     => 'author',
            'date'                       => 'date'
		);
		
	}
	
	add_filter('manage_edit-menu-lunch_sortable_columns', 'gp_edit_columns_sorting_lunch');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_lunch')) {

	function gp_messages_lunch($messages) {
		global $post, $post_ID;
		
		$messages['lunch'] = array(
			0		=> '',
			1		=> sprintf(__('Lunch updated. <a href="%s">View lunch &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Lunch updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf(__('Lunch restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Lunch published. <a href="%s">View lunch &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Lunch saved.', 'gp'),
			8		=> sprintf(__('Lunch submitted. <a target="_blank" href="%s">Preview lunch &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Lunch scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview lunch &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Lunch draft updated. <a target="_blank" href="%s">Preview lunch &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_lunch');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_lunch')) {

	function gp_title_placeholder_lunch($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'menu-lunch') {
			$title = __('Enter lunch title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_lunch');

}