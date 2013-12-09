<?php

/*

@name 			Dinner Post Type
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

if (!function_exists('gp_register_dinner')) {

	function gp_register_dinner() {
		
		register_post_type('menu-dinner',
			array (
				'labels' => array(
					'name'					=> __('Dinners', 'gp'),
					'menu_name'				=> __('Dinners', 'gp'),
					'singular_name'			=> __('Dinners', 'gp'),
					'all_items'				=> __('All Dinners', 'gp'),
					'add_new'				=> __('Add New Dinner', 'gp'),
					'add_new_item'			=> __('Add New Dinner', 'gp'),
					'edit_item'				=> __('Edit Dinner', 'gp'),
					'new_item'				=> __('New Dinner', 'gp'),
					'view_item'				=> __('View Dinner', 'gp'),
					'search_items'			=> __('Search Dinners', 'gp'),
					'not_found'				=> __('No Dinners', 'gp'),
					'not_found_in_trash'	=> __('No Dinners Found in Trash', 'gp')
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
					'slug'					=> 'dinner',
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
	
	add_action('init', 'gp_register_dinner');

}

/*
====================================================================================================
Post Type Icon
====================================================================================================
*/

if (!function_exists('gp_dinner_icon')) {

	function gp_dinner_icon() {
	?>
	
		<style type="text/css" media="screen">
			#icon-edit.icon32-posts-menu-dinner {
			    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-menu32.png") no-repeat;
            }
			@media
            only screen and (-webkit-min-device-pixel-ratio: 2),
            only screen and (-o-min-device-pixel-ratio: 2/1),
            only screen and (min--moz-device-pixel-ratio: 2),
            only screen and (min-device-pixel-ratio: 2),
            only screen and (min-resolution: 192dpi),
            only screen and (min-resolution: 2dppx) {
                #menu-posts-menu-dinner .wp-menu-image {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-menu@2x.png") no-repeat;
                    -webkit-background-size: 16px 16px;
                    -moz-background-size: 16px 16px;
                    -o-background-size: 16px 16px;
                    background-size: 16px 16px;
                    background-position: center center;
                }
                #menu-posts-menu-dinner .wp-menu-image img {
                    display: none;
                }
                #icon-edit.icon32-posts-menu-dinner {
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
	
	add_action('admin_head', 'gp_dinner_icon');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_dinner')) {

	function gp_register_metabox_dinner() {
		
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
			'id'				=> 'gp-metabox-posttype-dinner-options',
			'title'				=> __('Dinner Options', 'gp'),
			'pages'				=> array('menu-dinner'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Prices', 'gp'),
					'desc'				=> __('Fill the prices of the dinner. Fill price with currency symbol. Example format: Bottle 0,5l ... $25', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_dinner_price',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Description', 'gp'),
					'desc'				=> __('Fill the description of the dinner.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_dinner_description',
					'type'				=> 'textarea'
				),
				array(
					'name'				=> __('Ingredients', 'gp'),
					'desc'				=> __('Fill the number of the dinner.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_dinner_ingredients',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Use Single Page', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_dinner_single',
					'type'				=> 'checkbox',
					'std'				=> '1'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_dinner');

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

if (!function_exists('gp_edit_columns_dinner')) {

	function gp_edit_columns_dinner($columns) {
		
		$columns = array(
			'cb'					=> "<input type=\"checkbox\" />",
			'title'					=> __('Title', 'gp'),
			'dinner_price'	        => __('Price', 'gp'),
			'author'				=> __('Author', 'gp'),
			'date'					=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-menu-dinner_columns', 'gp_edit_columns_dinner');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_content_dinner')) {

	function gp_edit_columns_content_dinner($column, $post_ID) {
	
		switch($column) {
			
			// Price
			case 'dinner_price':
	
				$dinner_price = gp_meta('gp_menu_dinner_price');
				if (empty($dinner_price)) {
					echo __('/', 'gp');
				} else {
					foreach ($dinner_price as $price) {
                        echo $price;
                        echo '<br />';
                    }
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_menu-dinner_posts_custom_column', 'gp_edit_columns_content_dinner', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Orderby
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_orderby_dinner')) {

	function gp_edit_columns_orderby_dinner($query) {
		  
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('dinner_price' == $orderby) {
			$query->set('meta_key', 'gp_menu_dinner_price');
			$query->set('orderby', 'meta_value');
		}
		
	}
	
	add_action('pre_get_posts', 'gp_edit_columns_orderby_dinner');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_sorting_dinner')) {

	function gp_edit_columns_sorting_dinner($column) {
		
		return array(
			'title'						 => 'title',
			'dinner_price'		         => 'dinner_price',
			'author'                     => 'author',
            'date'                       => 'date'
		);
		
	}
	
	add_filter('manage_edit-menu-dinner_sortable_columns', 'gp_edit_columns_sorting_dinner');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_dinner')) {

	function gp_messages_dinner($messages) {
		global $post, $post_ID;
		
		$messages['dinner'] = array(
			0		=> '',
			1		=> sprintf(__('Dinner updated. <a href="%s">View dinner &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Dinner updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf(__('Dinner restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Dinner published. <a href="%s">View dinner &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Dinner saved.', 'gp'),
			8		=> sprintf(__('Dinner submitted. <a target="_blank" href="%s">Preview dinner &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Dinner scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview dinner &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Dinner draft updated. <a target="_blank" href="%s">Preview dinner &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_dinner');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_dinner')) {

	function gp_title_placeholder_dinner($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'menu-dinner') {
			$title = __('Enter dinner title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_dinner');

}