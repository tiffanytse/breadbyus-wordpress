<?php

/*

@name 			Menus Post Type
@package		GPanel WordPress Framework
@since			3.0.4
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Post Type Register
====================================================================================================
*/

if (!function_exists('gp_register_menu')) {

	function gp_register_menu() {
		
		register_post_type('menu',
			array (
				'labels' => array(
					'name'					=> __('Menus', 'gp'),
					'menu_name'				=> __('Menus', 'gp'),
					'singular_name'			=> __('Menu', 'gp'),
					'all_items'				=> __('All Menu Items', 'gp'),
					'add_new'				=> __('Add New Menu Item', 'gp'),
					'add_new_item'			=> __('Add New Menu Item', 'gp'),
					'edit_item'				=> __('Edit Menu Item', 'gp'),
					'new_item'				=> __('New Menu Item', 'gp'),
					'view_item'				=> __('View Menu Item', 'gp'),
					'search_items'			=> __('Search Menu Items', 'gp'),
					'not_found'				=> __('No Menu Items', 'gp'),
					'not_found_in_trash'	=> __('No Menu Items Found in Trash', 'gp')
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
					'slug'					=> 'menu-item',
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
	
	add_action('init', 'gp_register_menu');

}

/*
====================================================================================================
Post Type Icon
====================================================================================================
*/

if (!function_exists('gp_menu_icon')) {

	function gp_menu_icon() {
	?>
	
		<style type="text/css" media="screen">
			#icon-edit.icon32-posts-menu {
			    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-menu32.png") no-repeat;
            }
			@media
            only screen and (-webkit-min-device-pixel-ratio: 2),
            only screen and (-o-min-device-pixel-ratio: 2/1),
            only screen and (min--moz-device-pixel-ratio: 2),
            only screen and (min-device-pixel-ratio: 2),
            only screen and (min-resolution: 192dpi),
            only screen and (min-resolution: 2dppx) {
                #menu-posts-menu .wp-menu-image {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-menu@2x.png") no-repeat;
                    -webkit-background-size: 16px 16px;
                    -moz-background-size: 16px 16px;
                    -o-background-size: 16px 16px;
                    background-size: 16px 16px;
                    background-position: center center;
                }
                #menu-posts-menu .wp-menu-image img {
                    display: none;
                }
                #icon-edit.icon32-posts-menu {
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
	
	add_action('admin_head', 'gp_menu_icon');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_menu')) {

	function gp_register_metabox_menu() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Menu Options
		--------------------------------------------------
		*/
		
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-menu-options',
			'title'				=> __('Menu Item Options', 'gp'),
			'pages'				=> array('menu'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Prices', 'gp'),
					'desc'				=> __('Fill the prices of the menu item. Fill price with currency symbol. Example format: Bottle 0,5l ... $25', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_menu_price',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Description', 'gp'),
					'desc'				=> __('Fill the description of the menu item.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_menu_description',
					'type'				=> 'textarea'
				),
				array(
					'name'				=> __('Ingredients', 'gp'),
					'desc'				=> __('Fill the ingredients of the menu item.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_menu_ingredients',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Use Single Page', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_menu_single',
					'type'				=> 'checkbox',
					'std'				=> '1'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_menu');

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

if (!function_exists('gp_edit_columns_menu')) {

	function gp_edit_columns_menu($columns) {
		
		$columns = array(
			'cb'					=> "<input type=\"checkbox\" />",
			'title'					=> __('Title', 'gp'),
			'menu_price'	        => __('Price', 'gp'),
			'author'				=> __('Author', 'gp'),
			'date'					=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
        add_filter('manage_edit-menu_columns', 'gp_edit_columns_menu');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_content_menu')) {

	function gp_edit_columns_content_menu($column, $post_ID) {
	
		switch($column) {
			
			// Price
			case 'menu_price':
	
				$menu_price = gp_meta('gp_menu_menu_price');
				if (empty($menu_price)) {
					echo __('/', 'gp');
				} else {
					foreach ($menu_price as $price) {
                        echo $price;
                        echo '<br />';
                    }
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_menu_posts_custom_column', 'gp_edit_columns_content_menu', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Orderby
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_orderby_menu')) {

	function gp_edit_columns_orderby_menu($query) {
		  
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('menu_price' == $orderby) {
			$query->set('meta_key', 'gp_menu_menu_price');
			$query->set('orderby', 'meta_value');
		}
		
	}
	
	add_action('pre_get_posts', 'gp_edit_columns_orderby_menu');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_sorting_menu')) {

	function gp_edit_columns_sorting_menu($column) {
		
		return array(
			'title'						 => 'title',
			'menu_price'		         => 'menu_price',
			'author'                     => 'author',
            'date'                       => 'date'
		);
		
	}
	
	add_filter('manage_edit-menu_sortable_columns', 'gp_edit_columns_sorting_menu');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_menu')) {

	function gp_messages_menu($messages) {
		global $post, $post_ID;
		
		$messages['menu'] = array(
			0		=> '',
			1		=> sprintf(__('Menu item updated. <a href="%s">View menu item &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Menu item updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf(__('Menu item restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Menu item published. <a href="%s">View menu item &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Menu item saved.', 'gp'),
			8		=> sprintf(__('Menu item submitted. <a target="_blank" href="%s">Preview menu item &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Menu item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview menu item &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Menu item draft updated. <a target="_blank" href="%s">Preview menu item &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_menu');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_menu')) {

	function gp_title_placeholder_menu($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'menu') {
			$title = __('Enter menu item title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_menu');

}