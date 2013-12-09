<?php

/*

@name 			Breakfast Post Type
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

if (!function_exists('gp_register_breakfast')) {

	function gp_register_breakfast() {
		
		register_post_type('menu-breakfast',
			array (
				'labels' => array(
					'name'					=> __('Breakfasts', 'gp'),
					'menu_name'				=> __('Breakfasts', 'gp'),
					'singular_name'			=> __('Breakfasts', 'gp'),
					'all_items'				=> __('All Breakfasts', 'gp'),
					'add_new'				=> __('Add New Breakfast', 'gp'),
					'add_new_item'			=> __('Add New Breakfast', 'gp'),
					'edit_item'				=> __('Edit Breakfast', 'gp'),
					'new_item'				=> __('New Breakfast', 'gp'),
					'view_item'				=> __('View Breakfast', 'gp'),
					'search_items'			=> __('Search Breakfasts', 'gp'),
					'not_found'				=> __('No Breakfasts', 'gp'),
					'not_found_in_trash'	=> __('No Breakfasts Found in Trash', 'gp')
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
					'slug'					=> 'breakfast',
					'with_front'			=> true
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
	
	add_action('init', 'gp_register_breakfast');

}

/*
====================================================================================================
Post Type Icon
====================================================================================================
*/

if (!function_exists('gp_breakfast_icon')) {

	function gp_breakfast_icon() {
	?>
	
		<style type="text/css" media="screen">
			#icon-edit.icon32-posts-menu-breakfast {
			    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-menu32.png") no-repeat;
            }
			@media
            only screen and (-webkit-min-device-pixel-ratio: 2),
            only screen and (-o-min-device-pixel-ratio: 2/1),
            only screen and (min--moz-device-pixel-ratio: 2),
            only screen and (min-device-pixel-ratio: 2),
            only screen and (min-resolution: 192dpi),
            only screen and (min-resolution: 2dppx) {
                #menu-posts-menu-breakfast .wp-menu-image {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-menu@2x.png") no-repeat;
                    -webkit-background-size: 16px 16px;
                    -moz-background-size: 16px 16px;
                    -o-background-size: 16px 16px;
                    background-size: 16px 16px;
                    background-position: center center;
                }
                #menu-posts-menu-breakfast .wp-menu-image img {
                    display: none;
                }
                #icon-edit.icon32-posts-menu-breakfast {
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
	
	add_action('admin_head', 'gp_breakfast_icon');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_breakfast')) {

	function gp_register_metabox_breakfast() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Breakfast Options
		--------------------------------------------------
		*/
		
		$current_date = date('Y/m/d');
	
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-breakfast-options',
			'title'				=> __('Breakfast Options', 'gp'),
			'pages'				=> array('menu-breakfast'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Prices', 'gp'),
					'desc'				=> __('Fill the prices of the breakfast. Fill price with currency symbol. Example format: Bottle 0,5l ... $25', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_breakfast_price',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Description', 'gp'),
					'desc'				=> __('Fill the description of the breakfast.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_breakfast_description',
					'type'				=> 'textarea'
				),
				array(
					'name'				=> __('Ingredients', 'gp'),
					'desc'				=> __('Fill the number of the breakfast.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_breakfast_ingredients',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Use Single Page', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_breakfast_single',
					'type'				=> 'checkbox',
					'std'				=> '1'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_breakfast');

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

if (!function_exists('gp_edit_columns_breakfast')) {

	function gp_edit_columns_breakfast($columns) {
		
		$columns = array(
			'cb'					=> "<input type=\"checkbox\" />",
			'title'					=> __('Title', 'gp'),
			'breakfast_price'	    => __('Price', 'gp'),
			'author'				=> __('Author', 'gp'),
			'date'					=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-menu-breakfast_columns', 'gp_edit_columns_breakfast');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_content_breakfast')) {

	function gp_edit_columns_content_breakfast($column, $post_ID) {
	
		switch($column) {
			
			// Price
			case 'breakfast_price':
	
				$breakfast_price = gp_meta('gp_menu_breakfast_price');
				if (empty($breakfast_price)) {
					echo __('/', 'gp');
				} else {
					foreach ($breakfast_price as $price) {
                        echo $price;
                        echo '<br />';
                    }
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_menu-breakfast_posts_custom_column', 'gp_edit_columns_content_breakfast', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Orderby
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_orderby_breakfast')) {

	function gp_edit_columns_orderby_breakfast($query) {
		  
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('breakfast_price' == $orderby) {
			$query->set('meta_key', 'gp_menu_breakfast_price');
			$query->set('orderby', 'meta_value');
		}
		
	}
	
	add_action('pre_get_posts', 'gp_edit_columns_orderby_breakfast');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_sorting_breakfast')) {

	function gp_edit_columns_sorting_breakfast($column) {
		
		return array(
			'title'						 => 'title',
			'breakfast_price'		     => 'breakfast_price',
			'author'                     => 'author',
            'date'                       => 'date'
		);
		
	}
	
	add_filter('manage_edit-menu-breakfast_sortable_columns', 'gp_edit_columns_sorting_breakfast');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_breakfast')) {

	function gp_messages_breakfast($messages) {
		global $post, $post_ID;
		
		$messages['breakfast'] = array(
			0		=> '',
			1		=> sprintf(__('Breakfast updated. <a href="%s">View breakfast &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Breakfast updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf(__('Breakfast restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Breakfast published. <a href="%s">View breakfast &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Breakfast saved.', 'gp'),
			8		=> sprintf(__('Breakfast submitted. <a target="_blank" href="%s">Preview breakfast &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Breakfast scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview breakfast &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Breakfast draft updated. <a target="_blank" href="%s">Preview breakfast &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_breakfast');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_breakfast')) {

	function gp_title_placeholder_breakfast($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'menu-breakfast') {
			$title = __('Enter breakfast title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_breakfast');

}