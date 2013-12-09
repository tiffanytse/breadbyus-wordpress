<?php

/*

@name 			Wine Post Type
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

if (!function_exists('gp_register_wine')) {

	function gp_register_wine() {
		
		register_post_type('menu-wine',
			array (
				'labels' => array(
					'name'					=> __('Wines', 'gp'),
					'menu_name'				=> __('Wines', 'gp'),
					'singular_name'			=> __('Wines', 'gp'),
					'all_items'				=> __('All Wines', 'gp'),
					'add_new'				=> __('Add New Wine', 'gp'),
					'add_new_item'			=> __('Add New Wine', 'gp'),
					'edit_item'				=> __('Edit Wine', 'gp'),
					'new_item'				=> __('New Wine', 'gp'),
					'view_item'				=> __('View Wine', 'gp'),
					'search_items'			=> __('Search Wines', 'gp'),
					'not_found'				=> __('No Wines', 'gp'),
					'not_found_in_trash'	=> __('No Wines Found in Trash', 'gp')
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
					'slug'					=> 'wine',
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
	
	add_action('init', 'gp_register_wine');

}

/*
====================================================================================================
Post Type Icon
====================================================================================================
*/

if (!function_exists('gp_wine_icon')) {

	function gp_wine_icon() {
	?>
	
		<style type="text/css" media="screen">
			#icon-edit.icon32-posts-menu-wine {
			    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-drink32.png") no-repeat;
            }
			@media
            only screen and (-webkit-min-device-pixel-ratio: 2),
            only screen and (-o-min-device-pixel-ratio: 2/1),
            only screen and (min--moz-device-pixel-ratio: 2),
            only screen and (min-device-pixel-ratio: 2),
            only screen and (min-resolution: 192dpi),
            only screen and (min-resolution: 2dppx) {
                #menu-posts-menu-wine .wp-menu-image {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-drink@2x.png") no-repeat;
                    -webkit-background-size: 16px 16px;
                    -moz-background-size: 16px 16px;
                    -o-background-size: 16px 16px;
                    background-size: 16px 16px;
                    background-position: center center;
                }
                #menu-posts-menu-wine .wp-menu-image img {
                    display: none;
                }
                #icon-edit.icon32-posts-menu-wine {
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
	
	add_action('admin_head', 'gp_wine_icon');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_wine')) {

	function gp_register_metabox_wine() {
		
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
			'id'				=> 'gp-metabox-posttype-wine-options',
			'title'				=> __('Wine Options', 'gp'),
			'pages'				=> array('menu-wine'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Prices', 'gp'),
					'desc'				=> __('Fill the prices of the wine. Fill price with currency symbol. Example format: Bottle 0,5l ... $25', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_wine_price',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Description', 'gp'),
					'desc'				=> __('Fill the description of the wine.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_wine_description',
					'type'				=> 'textarea'
				),
				array(
					'name'				=> __('Ingredients', 'gp'),
					'desc'				=> __('Fill the number of the wine.', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_wine_ingredients',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('Use Single Page', 'gp'),
					'id'				=> GP_SHORTNAME . '_menu_wine_single',
					'type'				=> 'checkbox',
					'std'				=> '1'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_wine');

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

if (!function_exists('gp_edit_columns_wine')) {

	function gp_edit_columns_wine($columns) {
		
		$columns = array(
			'cb'					=> "<input type=\"checkbox\" />",
			'title'					=> __('Title', 'gp'),
			'wine_price'	        => __('Price', 'gp'),
			'author'				=> __('Author', 'gp'),
			'date'					=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-menu-wine_columns', 'gp_edit_columns_wine');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_content_wine')) {

	function gp_edit_columns_content_wine($column, $post_ID) {
	
		switch($column) {
			
			// Price
			case 'wine_price':
	
				$wine_price = gp_meta('gp_menu_wine_price');
				if (empty($wine_price)) {
					echo __('/', 'gp');
				} else {
					foreach ($wine_price as $price) {
                        echo $price;
                        echo '<br />';
                    }
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_menu-wine_posts_custom_column', 'gp_edit_columns_content_wine', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Orderby
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_orderby_wine')) {

	function gp_edit_columns_orderby_wine($query) {
		  
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('wine_price' == $orderby) {
			$query->set('meta_key', 'gp_menu_wine_price');
			$query->set('orderby', 'meta_value');
		}
		
	}
	
	add_action('pre_get_posts', 'gp_edit_columns_orderby_wine');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_sorting_wine')) {

	function gp_edit_columns_sorting_wine($column) {
		
		return array(
			'title'						 => 'title',
			'wine_price'		         => 'wine_price',
			'author'                     => 'author',
            'date'                       => 'date'
		);
		
	}
	
	add_filter('manage_edit-menu-wine_sortable_columns', 'gp_edit_columns_sorting_wine');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_wine')) {

	function gp_messages_wine($messages) {
		global $post, $post_ID;
		
		$messages['wine'] = array(
			0		=> '',
			1		=> sprintf(__('Wine updated. <a href="%s">View wine &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Wine updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf(__('Wine restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Wine published. <a href="%s">View wine &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Wine saved.', 'gp'),
			8		=> sprintf(__('Wine submitted. <a target="_blank" href="%s">Preview wine &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Wine scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview wine &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Wine draft updated. <a target="_blank" href="%s">Preview wine &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_wine');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_wine')) {

	function gp_title_placeholder_wine($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'menu-wine') {
			$title = __('Enter wine title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_wine');

}