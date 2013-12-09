<?php

/*

@name 			Event Post Type
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

if (!function_exists('gp_register_event')) {

	function gp_register_event() {
		
		register_post_type('event',
			array (
				'labels' => array(
					'name'					=> __('Events', 'gp'),
					'menu_name'				=> __('Events', 'gp'),
					'singular_name'			=> __('Event', 'gp'),
					'all_items'				=> __('All Events', 'gp'),
					'add_new'				=> __('Add New Event', 'gp'),
					'add_new_item'			=> __('Add New Event', 'gp'),
					'edit_item'				=> __('Edit Event', 'gp'),
					'new_item'				=> __('New Event', 'gp'),
					'view_item'				=> __('View Event', 'gp'),
					'search_items'			=> __('Search Events', 'gp'),
					'not_found'				=> __('No Events', 'gp'),
					'not_found_in_trash'	=> __('No Events Found in Trash', 'gp')
				),
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_nav_menus' 	=> false,
				'show_in_admin_bar' 	=> true,
				'capability_type'		=> 'post',
				'hierarchical'			=> true,
				'exclude_from_search'	=> false,
				'publicly_queryable'	=> true,
				'query_var'				=> true,
				'rewrite'				=> array(
					'slug'					=> 'event',
					'with_front'			=> true
				),
				'menu_position'			=> 46,
				'menu_icon'				=> trailingslashit(get_template_directory_uri()) . 'backend/images/icons/icon-event.png',
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
	
	add_action('init', 'gp_register_event');

}

/*
====================================================================================================
Post Type Icon
====================================================================================================
*/

if (!function_exists('gp_icon_event')) {

	function gp_icon_event() {
	?>
	
		<style type="text/css" media="screen">
			#icon-edit.icon32-posts-event {
			    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-event32.png") no-repeat;
            }
			@media
            only screen and (-webkit-min-device-pixel-ratio: 2),
            only screen and (-o-min-device-pixel-ratio: 2/1),
            only screen and (min--moz-device-pixel-ratio: 2),
            only screen and (min-device-pixel-ratio: 2),
            only screen and (min-resolution: 192dpi),
            only screen and (min-resolution: 2dppx) {
                #menu-posts-event .wp-menu-image {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-event@2x.png") no-repeat;
                    -webkit-background-size: 16px 16px;
                    -moz-background-size: 16px 16px;
                    -o-background-size: 16px 16px;
                    background-size: 16px 16px;
                    background-position: center center;
                }
                #menu-posts-event .wp-menu-image img {
                    display: none;
                }
                #icon-edit.icon32-posts-event {
                    background: url("<?php echo get_template_directory_uri(); ?>/backend/images/icons/icon-event32@2x.png") no-repeat;
                    -webkit-background-size: 32px 32px;
                    -moz-background-size: 32px 32px;
                    -o-background-size: 32px 32px;
                    background-size: 32px 32px;
                }
            }
		</style>
	
	<?php 
	}
	
	add_action('admin_head', 'gp_icon_event');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_event')) {

	function gp_register_metabox_event() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Event Options
		--------------------------------------------------
		*/
		
		$current_date = date('Y/m/d');
		
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-event-options',
			'title'				=> __('Event Options', 'gp'),
			'pages'				=> array('event'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Event Date', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_date',
					'type'				=> 'picker_date',
					'std'				=> $current_date
				),
				array(
					'name'				=> __('Event Time', 'gp'),
					'desc'				=> __('For example: 08:00PM - 11:00PM.', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_time',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Event Venue', 'gp'),
					'desc'				=> __('For example: Club, Stadium etc.', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_venue',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Event Venue URL', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_venue_url',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Event Location', 'gp'),
					'desc'				=> __('For example: London, United Kingdom', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_location',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Event Contact', 'gp'),
					'desc'				=> __('Fill the event contact (e-mail address, phone, etc.).', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_contact',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Event Status', 'gp'),
					'desc'				=> __('Fill the event status (Tickets Available, Sold Out, Cancelled etc.).', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_status',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Ticket Price', 'gp'),
					'desc'				=> __('Fill the event ticket price (with currency symbol).', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_price',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Buy Tickets Button 1 Text', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_buy_text_1',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Buy Tickets Button 1 URL', 'gp'),
					'desc'				=> __('Fill the URL where is possible to buy tickets.', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_buy_url_1',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Buy Tickets Button 2 Text', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_buy_text_2',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Buy Tickets Button 2 URL', 'gp'),
					'desc'				=> __('Fill the URL where is possible to buy tickets.', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_buy_url_2',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Facebook Event Button Text', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_facebook_text',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Facebook Event Button URL', 'gp'),
					'desc'				=> __('Fill the URL of the Facebook event.', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_facebook_url',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Google Map URL', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_googlemap_url',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('YouTube Embed Code', 'gp'),
					'desc'				=> __('Add YouTube Video Embed Code. For Example: http://www.youtube.com/watch?v=<strong>12345abcdef</strong> (insert just code, not full url). Please note that Featured Image is required!', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_youtube_code',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Vimeo Embed Code', 'gp'),
					'desc'				=> __('Add Vimeo Video Embed Code. For example: http://vimeo.com/<strong>123456789</strong> (insert just code, not full url). Please note that Featured Image is required!', 'gp'),
					'id'				=> GP_SHORTNAME . '_event_vimeo_code',
					'type'				=> 'input'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_event');
	
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

if (!function_exists('gp_edit_columns_event')) {

	function gp_edit_columns_event($columns) {
		
		$columns = array(
			'cb'				=> "<input type=\"checkbox\" />",
			'title'				=> __('Event Title', 'gp'),
			'event_date'		=> __('Event Date', 'gp'),
			'event_location'	=> __('Event Location / Event Venue', 'gp'),
			'author'			=> __('Author', 'gp'),
			'date'				=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-event_columns', 'gp_edit_columns_event');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_content_event')) {

	function gp_edit_columns_content_event($column, $post_ID) {
	
		switch($column) {
			
			// Event Date
			case 'event_date':
	
				$event_date = gp_meta('gp_event_date');
				if (empty($event_date)) {
					echo __('/', 'gp');
				} else {
					printf('%s', $event_date);
				}
	
			break;
			
			// Event Location
			case 'event_location':
	
				$event_location = gp_meta('gp_event_location');
				$event_venue = gp_meta('gp_event_venue');
				if (empty($event_location)) {
					echo __('/', 'gp');
				} else {
					printf('%s / %s', $event_location, $event_venue);
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_event_posts_custom_column', 'gp_edit_columns_content_event', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Orderby
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_orderby_event')) {

	function gp_edit_columns_orderby_event($query) {
		  
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('event_date' == $orderby) {
			$query->set('meta_key', 'gp_event_date');
			$query->set('orderby', 'meta_value');
		}
		
	}
	
	add_action('pre_get_posts', 'gp_edit_columns_orderby_event');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_sorting_event')) {

	function gp_edit_columns_sorting_event($column) {
		
		return array(
			'title'				=> 'title',
			'event_date'		=> 'event_date',
			'author'			=> 'author',
			'date'				=> 'date'
		);
		
	}
	
	add_filter('manage_edit-event_sortable_columns', 'gp_edit_columns_sorting_event');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_event')) {

	function gp_messages_event($messages) {
		global $post, $post_ID;
		
		$messages['event'] = array(
			0		=> '',
			1		=> sprintf(__('Event updated. <a href="%s">View event &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Event updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Event published. <a href="%s">View event &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Event saved.', 'gp'),
			8		=> sprintf(__('Event submitted. <a target="_blank" href="%s">Preview event &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Event draft updated. <a target="_blank" href="%s">Preview event &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_event');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_event')) {

	function gp_title_placeholder_event($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'event') {
			$title = __('Enter event title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_event');

}