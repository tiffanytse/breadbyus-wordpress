<?php

/*

@name 			Drink Post Type
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

if (!function_exists('gp_register_drink')) {

	function gp_register_drink() {
		
		register_post_type('menu-drink',
			array (
				'labels' => array(
					'name'					=> __('Drinks', 'gp'),
					'menu_name'				=> __('Drinks', 'gp'),
					'singular_name'			=> __('Drinks', 'gp'),
					'all_items'				=> __('All Drinks', 'gp'),
					'add_new'				=> __('Add New Drink', 'gp'),
					'add_new_item'			=> __('Add New Drink', 'gp'),
					'edit_item'				=> __('Edit Drink', 'gp'),
					'new_item'				=> __('New Drink', 'gp'),
					'view_item'				=> __('View Drink', 'gp'),
					'search_items'			=> __('Search Drinks', 'gp'),
					'not_found'				=> __('No Drinks', 'gp'),
					'not_found_in_trash'	=> __('No Drinks Found in Trash', 'gp')
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
					'slug'					=> 'drink',
					'with_front'			=> false
				),
				'menu_position'			=> 47,
				'menu_icon'				=> trailingslashit(get_template_directory_uri()) . 'backend/images/icons/icon-drink.png',
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
	
	add_action('init', 'gp_register_drink');

}

/*
====================================================================================================
Post Type Icon
====================================================================================================
*/

if (!function_exists('gp_drink_icon')) {

	function gp_drink_icon() {
	?>
	
		<style type="text/css" media="screen">
			#icon-edit.icon32-posts-menu-drink {
			    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-drink32.png") no-repeat;
            }
			@media
            only screen and (-webkit-min-device-pixel-ratio: 2),
            only screen and (-o-min-device-pixel-ratio: 2/1),
            only screen and (min--moz-device-pixel-ratio: 2),
            only screen and (min-device-pixel-ratio: 2),
            only screen and (min-resolution: 192dpi),
            only screen and (min-resolution: 2dppx) {
                #menu-posts-menu-drink .wp-menu-image {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-drink@2x.png") no-repeat;
                    -webkit-background-size: 16px 16px;
                    -moz-background-size: 16px 16px;
                    -o-background-size: 16px 16px;
                    background-size: 16px 16px;
                    background-position: center center;
                }
                #menu-posts-menu-drink .wp-menu-image img {
                    display: none;
                }
                #icon-edit.icon32-posts-menu-drink {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-drink32@2x.png") no-repeat;
                    -webkit-background-size: 32px 32px;
                    -moz-background-size: 32px 32px;
                    -o-background-size: 32px 32px;
                    background-size: 32px 32px;
                }
            }
		</style>
	
	<?php 
	}
	
	add_action('admin_head', 'gp_drink_icon');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_drink')) {

	function gp_register_metabox_drink() {
		
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
			'id'				=> 'gp-metabox-posttype-drink-options',
			'title'				=> __('Drink Options', 'gp'),
			'pages'				=> array('menu-drink'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Prices', 'gp'),
					'desc'				=> __('Fill the prices of the drink. Fill price with currency symbol. Example format: Bottle 0,5l ... $25', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_drink_price',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Description', 'gp'),
					'desc'				=> __('Fill the description of the drink.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_drink_description',
					'type'				=> 'textarea'
				),
				array(
					'name'				=> __('Ingredients', 'gp'),
					'desc'				=> __('Fill the number of the drink.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_drink_ingredients',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Use Single Page', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_drink_single',
					'type'				=> 'checkbox',
					'std'				=> '1'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_drink');

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

if (!function_exists('gp_edit_columns_drink')) {

	function gp_edit_columns_drink($columns) {
		
		$columns = array(
			'cb'					=> "<input type=\"checkbox\" />",
			'title'					=> __('Title', 'gp'),
			'drink_price'	        => __('Price', 'gp'),
			'author'				=> __('Author', 'gp'),
			'date'					=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-menu-drink_columns', 'gp_edit_columns_drink');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_content_drink')) {

	function gp_edit_columns_content_drink($column, $post_ID) {
	
		switch($column) {
			
			// Price
			case 'drink_price':
	
				$drink_price = gp_meta('gp_menu_drink_price');
				if (empty($drink_price)) {
					echo __('/', 'gp');
				} else {
					foreach ($drink_price as $price) {
                        echo $price;
                        echo '<br />';
                    }
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_menu-drink_posts_custom_column', 'gp_edit_columns_content_drink', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Orderby
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_orderby_drink')) {

	function gp_edit_columns_orderby_drink($query) {
		  
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('drink_price' == $orderby) {
			$query->set('meta_key', 'gp_menu_drink_price');
			$query->set('orderby', 'meta_value');
		}
		
	}
	
	add_action('pre_get_posts', 'gp_edit_columns_orderby_drink');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_sorting_drink')) {

	function gp_edit_columns_sorting_drink($column) {
		
		return array(
			'title'						 => 'title',
			'drink_price'		         => 'drink_price',
			'author'                     => 'author',
            'date'                       => 'date'
		);
		
	}
	
	add_filter('manage_edit-menu-drink_sortable_columns', 'gp_edit_columns_sorting_drink');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_drink')) {

	function gp_messages_drink($messages) {
		global $post, $post_ID;
		
		$messages['drink'] = array(
			0		=> '',
			1		=> sprintf(__('Drink updated. <a href="%s">View drink &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Drink updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf(__('Drink restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Drink published. <a href="%s">View drink &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Drink saved.', 'gp'),
			8		=> sprintf(__('Drink submitted. <a target="_blank" href="%s">Preview drink &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Drink scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview drink &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Drink draft updated. <a target="_blank" href="%s">Preview drink &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_drink');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_drink')) {

	function gp_title_placeholder_drink($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'menu-drink') {
			$title = __('Enter drink title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_drink');

}