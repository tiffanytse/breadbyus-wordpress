<?php

/*

@name			GPanel Widgets Init
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Register Widgets
====================================================================================================
*/

if (!function_exists('register_widgets')) {

	function register_widgets() {
		
		register_widget('gp_Widget_About');
		register_widget('gp_Widget_Categories_Event');
		register_widget('gp_Widget_Categories_Gallery');
		register_widget('gp_Widget_Categories_Video');
		register_widget('gp_Widget_Opening_Hours');
		register_widget('gp_Widget_Recent_Events');
		register_widget('gp_Widget_Recent_Posts');
		register_widget('gp_Widget_Recent_Tweet');
		register_widget('gp_Widget_Recent_Videos');
		register_widget('gp_Widget_Subpages');
		register_widget('gp_Widget_Tweets');
		
	}
	
	add_action('widgets_init', 'register_widgets');

}

/*
====================================================================================================
Unregister Default WP Widgets
====================================================================================================
*/

if (!function_exists('unregister_wp_widgets')) {

	function unregister_wp_widgets(){
		
		unregister_widget('WP_Widget_Calendar');
	  
	}
	
	add_action('widgets_init', 'unregister_wp_widgets', 1);

}

/*
====================================================================================================
Register Widget Areas
====================================================================================================
*/

if (function_exists('register_sidebar')) {
	
	// Sidebar > Page
	register_sidebar(
		array(
			'name' 				=> __('Page Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-page',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Blog
	register_sidebar(
		array(
			'name' 				=> __('Blog Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on blog pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-blog',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	if (gp_option('gp_menus_type') == 'old') {
	
        // Sidebar > Food
        register_sidebar(
            array(
                'name' 				=> __('Foods Sidebar', 'gp'),
                'description' 		=> __('Sidebar that appears on food pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
                'id' 				=> 'widget-area-menu-food',
                'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
                'after_widget'  	=> '</div>',
                'before_title'  	=> '<h3 class="widget-title">',
                'after_title'		=> '</h3>'
            )
        );
        
        // Sidebar > Breakfast
        register_sidebar(
            array(
                'name' 				=> __('Breakfasts Sidebar', 'gp'),
                'description' 		=> __('Sidebar that appears on breakfast pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
                'id' 				=> 'widget-area-menu-breakfast',
                'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
                'after_widget'  	=> '</div>',
                'before_title'  	=> '<h3 class="widget-title">',
                'after_title'		=> '</h3>'
            )
        );
        
        // Sidebar > Lunch
        register_sidebar(
            array(
                'name' 				=> __('Lunches Sidebar', 'gp'),
                'description' 		=> __('Sidebar that appears on lunch pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
                'id' 				=> 'widget-area-menu-lunch',
                'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
                'after_widget'  	=> '</div>',
                'before_title'  	=> '<h3 class="widget-title">',
                'after_title'		=> '</h3>'
            )
        );
        
        // Sidebar > Dinner
        register_sidebar(
            array(
                'name' 				=> __('Dinners Sidebar', 'gp'),
                'description' 		=> __('Sidebar that appears on dinner pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
                'id' 				=> 'widget-area-menu-dinner',
                'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
                'after_widget'  	=> '</div>',
                'before_title'  	=> '<h3 class="widget-title">',
                'after_title'		=> '</h3>'
            )
        );
        
        // Sidebar > Drink
        register_sidebar(
            array(
                'name' 				=> __('Drinks Sidebar', 'gp'),
                'description' 		=> __('Sidebar that appears on drink pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
                'id' 				=> 'widget-area-menu-drink',
                'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
                'after_widget'  	=> '</div>',
                'before_title'  	=> '<h3 class="widget-title">',
                'after_title'		=> '</h3>'
            )
        );
        
        // Sidebar > Wine
        register_sidebar(
            array(
                'name' 				=> __('Wines Sidebar', 'gp'),
                'description' 		=> __('Sidebar that appears on wine pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
                'id' 				=> 'widget-area-menu-wine',
                'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
                'after_widget'  	=> '</div>',
                'before_title'  	=> '<h3 class="widget-title">',
                'after_title'		=> '</h3>'
            )
        );
	
    } else {
    
        // Sidebar > Menu
        register_sidebar(
            array(
                'name' 				=> __('Menus Sidebar', 'gp'),
                'description' 		=> __('Sidebar that appears on menu pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
                'id' 				=> 'widget-area-menu-menu',
                'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
                'after_widget'  	=> '</div>',
                'before_title'  	=> '<h3 class="widget-title">',
                'after_title'		=> '</h3>'
            )
        );
    
    }
	
	// Sidebar > Event
	register_sidebar(
		array(
			'name' 				=> __('Events Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on event pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-event',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Video
	register_sidebar(
		array(
			'name' 				=> __('Videos Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on video pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-video',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Gallery
	register_sidebar(
		array(
			'name' 				=> __('Galleries Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on gallery pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-gallery',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Reservation
	register_sidebar(
		array(
			'name' 				=> __('Reservation Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on reservation page. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-reservation',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Contact
	register_sidebar(
		array(
			'name' 				=> __('Contact Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on contact page. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-contact',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) { // Check if WooCommerce is Active
        
        // Sidebar > Shop
        register_sidebar(
            array(
                'name' 				=> __('Shop Sidebar', 'gp'),
                'description' 		=> __('Sidebar that appears on shop pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
                'id' 				=> 'widget-area-shop',
                'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
                'after_widget'  	=> '</div>',
                'before_title'  	=> '<h3 class="widget-title">',
                'after_title'		=> '</h3>'
            )
        );
        
    }

	// Footer Sidebar > Full
	register_sidebar(
		array(
			'name' 				=> __('Footer [Full]', 'gp'),
			'description' 		=> __('Full width footer widget area appears on all pages. Area won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-footer-full',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > First
	register_sidebar(
		array(
			'name' 				=> __('Footer [1st]', 'gp'),
			'description' 		=> __('1st footer widget area.', 'gp'),
			'id' 				=> 'widget-area-footer-first',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > Second
	register_sidebar(
		array(
			'name' 				=> __('Footer [2nd]', 'gp'),
			'description' 		=> __('2nd footer widget area.', 'gp'),
			'id' 				=> 'widget-area-footer-second',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > Third
	register_sidebar(
		array(
			'name' 				=> __('Footer [3rd]', 'gp'),
			'description' 		=> __('3rd footer widget area.', 'gp'),
			'id' 				=> 'widget-area-footer-third',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);

}

?>