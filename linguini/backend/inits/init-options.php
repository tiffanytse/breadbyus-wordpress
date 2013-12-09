<?php

/*

@name			GPanel Options Init
@package		GPanel WordPress Framework
@since			3.0.1
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Theme Options Sections
====================================================================================================
*/

if (!function_exists('gp_theme_options_sections')) {

	function gp_theme_options_sections() {
	
		$sections = array();
	
		$sections['general'] 				= __('General Settings', 'gp');
		$sections['styling'] 				= __('Styling', 'gp');
		$sections['reading'] 				= __('Reading', 'gp');
		$sections['socials'] 				= __('Socials', 'gp');
		$sections['forms'] 					= __('Forms', 'gp');
		$sections['tracking'] 				= __('Tracking', 'gp');
	
		return $sections;
	
	}

}

/*
====================================================================================================
Theme Options
====================================================================================================
*/

if (!function_exists('gp_theme_options_fields')) {

	function gp_theme_options_fields() {
		global $wp_version;
		
		/*
		----------------------------------------------------------------------------------------------------
		General Tab
		----------------------------------------------------------------------------------------------------
		*/
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_logos',
			'title'		=> __('Logos', 'gp'),
			'type'		=> 'heading',
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_logo',
			'title'		=> __('Logo Image', 'gp'),
			'desc'		=> __('Upload a logo image. Upload an image and then click "Select" or "Insert into Post".', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_logo_2x',
			'title'		=> __('@2x Logo Image', 'gp'),
			'desc'		=> __('Upload a @2x logo image for retina displays. Upload an image and then click "Select" or "Insert into Post".', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_login_logo',
			'title'		=> __('WordPress Login Logo Image', 'gp'),
			'desc'		=> __('Upload a WordPress login logo image. Upload an image and then click "Select" or "Insert into Post".<br /> <strong>Required size: 274 x 100 px.</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_icons',
			'title'		=> __('Icons', 'gp'),
			'type'		=> 'heading',
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_favicon',
			'title'		=> __('Browser Favicon 32x32', 'gp'),
			'desc'		=> __('Upload a favicon in *.ico format. Upload an image and then click "Select" or "Insert into Post".<br /> <strong>Required size: 32 x 32 px. Required name: favicon.ico</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_touch_icon',
			'title'		=> __('Apple Touch Icon Precomposed 57x57', 'gp'),
			'desc'		=> __('Upload a precomposed Apple touch icon in *.png format. Upload an image and then click "Select" or "Insert into Post".<br /> <strong>Required size: 57 x 57 px. Required name: apple-touch-icon-precomposed.png</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_touch_icon_72',
			'title'		=> __('Apple Touch Icon Precomposed 72x72', 'gp'),
			'desc'		=> __('Upload a precomposed Apple touch icon in *.png format. Upload an image and then click "Select" or "Insert into Post".<br /> <strong>Required size: 72 x 72 px. Required name: apple-touch-icon-72x72-precomposed.png</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_touch_icon_114',
			'title'		=> __('Apple Touch Icon Precomposed 114x114', 'gp'),
			'desc'		=> __('Upload a precomposed Apple touch icon in *.png format. Upload an image and then click "Select" or "Insert into Post".<br /> <strong>Required size: 114 x 114 px. Required name: apple-touch-icon-114x114-precomposed.png</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_touch_icon_144',
			'title'		=> __('Apple Touch Icon Precomposed 144x144', 'gp'),
			'desc'		=> __('Upload a precomposed Apple touch icon in *.png format. Upload an image and then click "Select" or "Insert into Post".<br /> <strong>Required size: 144 x 144 px. Required name: apple-touch-icon-144x144-precomposed.png</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_background',
			'title'		=> __('Background', 'gp'),
			'type'		=> 'heading',
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_background',
			'title'		=> __('Full Screen Background Image with Backstretch', 'gp'),
			'desc'		=> __('Upload a full screen background image. Upload an image and then click "Select" or "Insert into Post".<br /> Background image of Theme Customizer will be disabled.<br /> <strong>Recommended minimum size: 1600 x 1200 px.</strong>', 'gp'),
			'type'		=> 'input-upload',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_image_background_opacity',
			'title'		=> __('Background Image Opacity', 'gp'),
			'desc'		=> __('Select opacity of background image.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('100%', 'gp') . '|1',
				__('75%', 'gp') . '|.75',
				__('50%', 'gp') . '|.5',
				__('25%', 'gp') . '|.25',
				__('10%', 'gp') . '|.1'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_toolbar',
			'title'		=> __('Toolbar', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_header',
			'title'		=> __('Header Toolbar', 'gp'),
			'desc'		=> __('Enable / disable displaying of the toolbar in the header.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_footer',
			'title'		=> __('Footer Toolbar', 'gp'),
			'desc'		=> __('Enable / disable displaying of the toolbar in the footer.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_search',
			'title'		=> __('Search Button', 'gp'),
			'desc'		=> __('Enable / disable displaying of the search button.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_toolbar_left',
			'title'		=> __('Left Toolbar Content', 'gp'),
			'desc'		=> __('Fill the content of the left toolbar displayed in header and footer. Ideal for the contact information.', 'gp'),
			'type'		=> 'textarea',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_slideshow',
			'title'		=> __('Slideshow', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_autoplay',
			'title'		=> __('Autoplay', 'gp'),
			'desc'		=> __('Enable / disable autoplay of the slideshow.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_loop',
			'title'		=> __('Loop', 'gp'),
			'desc'		=> __('Enable / disable to go from last slide to first.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'false',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
			
        $options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_nav',
			'title'		=> __('Arrow Navigation', 'gp'),
			'desc'		=> __('Enable / disable arrow navigation.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_nav_autohide',
			'title'		=> __('Arrow Navigation Auto Hide', 'gp'),
			'desc'		=> __('Enable / disable auto hide of the arrow navigation.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'false',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_nav_touch',
			'title'		=> __('Arrow Navigation on Touch Devices', 'gp'),
			'desc'		=> __('Show / hide arrow navigation completely on touch devices.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'false',
			'choices'	=> array(
				__('Show', 'gp') . '|false',
				__('Hide', 'gp') . '|true'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_nav_by_click',
			'title'		=> __('Navigate by Click', 'gp'),
			'desc'		=> __('Enable / disable navigation by click.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_drag',
			'title'		=> __('Drag', 'gp'),
			'desc'		=> __('Enable / disable mouse drag navigation over the slideshow.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_touch',
			'title'		=> __('Touch', 'gp'),
			'desc'		=> __('Enable / disable touch navigation of the slideshow.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_transition_type',
			'title'		=> __('Transition Type', 'gp'),
			'desc'		=> __('Select slideshow transition type.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'move',
			'choices'	=> array(
				__('Move', 'gp') . '|move',
				__('Fade', 'gp') . '|fade'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_slides_orientation',
			'title'		=> __('Slides Orientation', 'gp'),
			'desc'		=> __('Select slides orientation. Can be "horizontal" or "vertical".', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'horizontal',
			'choices'	=> array(
				__('Horizontal', 'gp') . '|horizontal',
				__('Vertical', 'gp') . '|vertical'
			)
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_transition_speed',
			'title'		=> __('Transition Speed', 'gp'),
			'desc'		=> __('Fill the transition speed in miliseconds. Default: 1000', 'gp'),
			'type'		=> 'input',
			'std'		=> '1000'
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_slideshow_delay',
			'title'		=> __('Delay', 'gp'),
			'desc'		=> __('Fill the delay between slides in miliseconds. Default: 5000', 'gp'),
			'type'		=> 'input',
			'std'		=> '5000'
		);
		
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_heading_rss',
			'title'		=> __('RSS', 'gp'),
			'desc'		=> __('For this setting you will need to create an account on <a href="http://www.feedburner.com/" target="_blank">Feedburner</a>.', 'gp'),
			'type'		=> 'heading',
		);
	
		$options[] = array(
			'section'	=> 'general',
			'id'		=> GP_SHORTNAME . '_feedburner',
			'title'		=> __('FeedBurner URL', 'gp'),
			'desc'		=> __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress feed. <a href="http://www.wpbeginner.com/beginners-guide/step-by-step-guide-to-setup-feedburner-for-wordpress/" target="_blank">Step by Step Guide to Setup FeedBurner for WordPress</a>', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
	
		if (!gp_seo_third_party()) {
			
			$options[] = array(
				'section'	=> 'general',
				'id'		=> GP_SHORTNAME . '_heading_meta',
				'title'		=> __('Meta', 'gp'),
				'type'		=> 'heading',
			);
			
			$options[] = array(
				'section'	=> 'general',
				'id'		=> GP_SHORTNAME . '_meta_keywords_default',
				'title'		=> __('Default Meta Keywords', 'gp'),
				'desc'		=> __('Add default meta keywords. Separate keywords with commas.', 'gp'),
				'type'		=> 'textarea',
				'std'		=> ''
			);
			
			$options[] = array(
				'section'	=> 'general',
				'id'		=> GP_SHORTNAME . '_meta_description_default',
				'title'		=> __('Default Meta Description', 'gp'),
				'desc'		=> __('Add default meta description.', 'gp'),
				'type'		=> 'textarea',
				'std'		=> ''
			);
			
		}
		
		/*
		----------------------------------------------------------------------------------------------------
		Styling Tab
		----------------------------------------------------------------------------------------------------
		*/
	
		$options[] = array(
			'section'	=> 'styling',
			'id'		=> GP_SHORTNAME . '_font_face',
			'title'		=> __('Custom Google Font', 'gp'),
			'desc'		=> __('Fill the full name of the font that you\'d like using from Google Font API: <a href="http://www.google.com/webfonts" target="_blank">
	http://www.google.com/webfonts</a>.<br /> For example: Racing Sans One<br /> Empty field = Default font', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'styling',
			'id'		=> GP_SHORTNAME . '_custom_css',
			'title'		=> __('Custom CSS', 'gp'),
			'desc'		=> __('Here you can specify a custom CSS section of code. This code will be given priority over other CSS styles.', 'gp'),
			'type'		=> 'textarea',
			'std'		=> ''
		);
		
		/*
		----------------------------------------------------------------------------------------------------
		Reading Tab
		----------------------------------------------------------------------------------------------------
		*/
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_date_format',
			'title'		=> __('Date', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_date_format',
			'title'		=> __('Select Date Format', 'gp'),
			'desc'		=> __('Please select a date format for the events and albums.<br /> d m Y = 01 02 2000<br /> m d Y = 02 01 2000<br /> Y m d = 2000 02 01<br /> Y d m = 2000 01 02<br /> F j, Y = January 1, 2000<br /> j M, Y = 1 Jan, 2000', 'gp'),
			'type'		=> 'select-text',
			'std'		=> '',
			'choices'	=> array(
				__('d m Y', 'gp') . '|d m Y',
				__('m d Y', 'gp') . '|m d Y',
				__('Y m d', 'gp') . '|Y m d',
				__('Y d m', 'gp') . '|Y d m',
				__('F j, Y (Delimiter ignored)', 'gp') . '|F j, Y',
				__('j M, Y (Delimiter ignored)', 'gp') . '|j M, Y'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_date_delimiter',
			'title'		=> __('Select Date Delimiter', 'gp'),
			'desc'		=> __('Please elect delimiter what want to use between the characters of date.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> '/',
			'choices'	=> array(
				__('Space [ ]', 'gp') . '| ',
				__('Slash [/]', 'gp') . '|/',
				__('Dash [-]', 'gp') . '|-',
				__('Dot [.]', 'gp') . '|.'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_posts_homepage',
			'title'		=> __('Posts on Homepage', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_callout_homepage',
			'title'		=> __('Callouts', 'gp'),
			'desc'		=> __('Enable / disable callout blocks on homepage.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_post_homepage',
			'title'		=> __('Posts', 'gp'),
			'desc'		=> __('Enable / Disable homepage posts.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_post_homepage_title',
			'title'		=> __('Posts Title', 'gp'),
			'desc'		=> __('Fill the homepage posts title.', 'gp'),
			'type'		=> 'input',
			'std'		=> __('Recent posts', 'gp')
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_post_homepage_title_show',
			'title'		=> __('Posts Title Show', 'gp'),
			'desc'		=> __('Enable / Disable homepage posts title.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_homepage',
			'title'		=> __('Events', 'gp'),
			'desc'		=> __('Enable / Disable latest events on homepage.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_homepage_date',
			'title'		=> __('Events Date', 'gp'),
			'desc'		=> __('Enable / disable post date on homepage.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_homepage_title',
			'title'		=> __('Events Title', 'gp'),
			'desc'		=> __('Fill the homepage events title.', 'gp'),
			'type'		=> 'input',
			'std'		=> __('Upcoming events', 'gp')
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_homepage_title_show',
			'title'		=> __('Events Title Show', 'gp'),
			'desc'		=> __('Enable / Disable homepage events title.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_blog',
			'title'		=> __('Blog', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_blog_view',
			'title'		=> __('Blog View Type', 'gp'),
			'desc'		=> __('Select <strong>Blog</strong> view type.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'grid',
			'choices'	=> array(
				__('Grid', 'gp') . '|grid',
				__('List', 'gp') . '|list'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_blog_sidebar',
			'title'		=> __('Blog Sidebar', 'gp'),
			'desc'		=> __('Select the sidebar location of the blog templates.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Right', 'gp') . '|right',
				__('Left', 'gp') . '|left'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_menus',
			'title'		=> __('Menus', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_menus_type',
			'title'		=> __('Menu Type', 'gp'),
			'desc'		=> __('Select <strong>Menus</strong> view type.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'new',
			'choices'	=> array(
				__('Menus', 'gp') . '|new',
				__('Foods, Breakfasts, Lunches, Dinners, Drinks, Wines', 'gp') . '|old'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_menus_view',
			'title'		=> __('Menus View Type', 'gp'),
			'desc'		=> __('Select <strong>Menus</strong> view type.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'list',
			'choices'	=> array(
				__('List', 'gp') . '|list',
				__('Grid', 'gp') . '|grid'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_menus_sidebar',
			'title'		=> __('Menus Sidebar', 'gp'),
			'desc'		=> __('Select the sidebar location of the menus templates.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Left', 'gp') . '|left',
				__('Right', 'gp') . '|right'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_event',
			'title'		=> __('Events', 'gp'),
			'type'		=> 'heading'
		);
			
        $options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_view',
			'title'		=> __('Events View Type', 'gp'),
			'desc'		=> __('Select <strong>Events</strong> view type.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'grid',
			'choices'	=> array(
				__('Grid', 'gp') . '|grid',
				__('List', 'gp') . '|list'
			)
		);
        
        $options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_past_view',
			'title'		=> __('Past Events View Type', 'gp'),
			'desc'		=> __('Select <strong>Past Events</strong> view type.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'grid',
			'choices'	=> array(
				__('Grid', 'gp') . '|grid',
				__('List', 'gp') . '|list'
			)
		);
        
        $options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_thumbnail',
			'title'		=> __('Thumbnails on Events Page', 'gp'),
			'desc'		=> __('Enable / disable thumbnails on the <strong>Events</strong> page template.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_single',
			'title'		=> __('Event Single Page', 'gp'),
			'desc'		=> __('Enable / disable event single page.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);

		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_per_page',
			'title'		=> __('Upcoming Events per Page', 'gp'),
			'desc'		=> __('Fill the number of upcoming events displayed per page. Default: -1 (all).', 'gp'),
			'type'		=> 'input',
			'std'		=> '-1'
		);
			
        $options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_past_per_page',
			'title'		=> __('Past Events per Page', 'gp'),
			'desc'		=> __('Fill the number of past events displayed per page. Default: -1 (all).', 'gp'),
			'type'		=> 'input',
			'std'		=> '-1'
		);
			
        $options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_event_sidebar',
			'title'		=> __('Events Sidebar', 'gp'),
			'desc'		=> __('Select the sidebar location of the events templates.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Left', 'gp') . '|left',
				__('Right', 'gp') . '|right'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_page',
			'title'		=> __('Pages', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_page_sidebar',
			'title'		=> __('Pages Sidebar', 'gp'),
			'desc'		=> __('Select the sidebar location of the page templates.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Right', 'gp') . '|right',
				__('Left', 'gp') . '|left'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_video',
			'title'		=> __('Videos', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_video_per_page',
			'title'		=> __('Videos per Page', 'gp'),
			'desc'		=> __('Fill the number of videos displayed per page. Default: -1 (all).', 'gp'),
			'type'		=> 'input',
			'std'		=> '-1'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_video_sidebar',
			'title'		=> __('Videos Sidebar', 'gp'),
			'desc'		=> __('Select the sidebar location of the video templates.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Left', 'gp') . '|left',
				__('Right', 'gp') . '|right'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_gallery',
			'title'		=> __('Galleries', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_gallery_per_page',
			'title'		=> __('Galleries per Page', 'gp'),
			'desc'		=> __('Fill the number of galleries displayed per page. Default: -1 (all).', 'gp'),
			'type'		=> 'input',
			'std'		=> '-1'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_gallery_sidebar',
			'title'		=> __('Gallery Sidebar', 'gp'),
			'desc'		=> __('Select the sidebar location of the gallery templates.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Left', 'gp') . '|left',
				__('Right', 'gp') . '|right'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_reservation',
			'title'		=> __('Reservation', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_reservation_sidebar',
			'title'		=> __('Reservation Sidebar', 'gp'),
			'desc'		=> __('Select the sidebar location of the reservation template.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Left', 'gp') . '|left',
				__('Right', 'gp') . '|right'
			)
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_contact',
			'title'		=> __('Contact', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_contact_sidebar',
			'title'		=> __('Contact Sidebar', 'gp'),
			'desc'		=> __('Select the sidebar location of the contact template.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Left', 'gp') . '|left',
				__('Right', 'gp') . '|right'
			)
		);
		
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) { // Check if WooCommerce is Active
		
            $options[] = array(
                'section'	=> 'reading',
                'id'		=> GP_SHORTNAME . '_heading_shop',
                'title'		=> __('Shop', 'gp'),
                'type'		=> 'heading'
            );
            
            $options[] = array(
                'section'	=> 'reading',
                'id'		=> GP_SHORTNAME . '_shop_sidebar',
                'title'		=> __('Shop Sidebar', 'gp'),
                'desc'		=> __('Select the sidebar location of the shop (WooCommerce) templates.', 'gp'),
                'type'		=> 'select-text',
                'std'		=> 'true',
                'choices'	=> array(
                    __('Left', 'gp') . '|left',
				    __('Right', 'gp') . '|right'
                )
            );
		
        }
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_heading_footer',
			'title'		=> __('Footer', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'reading',
			'id'		=> GP_SHORTNAME . '_footer_copyright',
			'title'		=> __('Footer Copyright', 'gp'),
			'desc'		=> __('Fill the text appeared instead copyright in footer.', 'gp'),
			'type'		=> 'textarea',
			'std'		=> ''
		);
		
		/*
		----------------------------------------------------------------------------------------------------
		Socials Tab
		----------------------------------------------------------------------------------------------------
		*/
	
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_target',
			'title'		=> __('Open Links in New Window', 'gp'),
			'desc'		=> __('Enable / disable opening of the link in new window. Enabled = Open in new window/tab, Disabled = Open in actual window/tab', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_heading_social_profiles',
			'title'		=> __('Social Profiles', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_twitter',
			'title'		=> __('Twitter', 'gp'),
			'desc'		=> __('Fill the absolute path to your Twitter account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_facebook',
			'title'		=> __('Facebook', 'gp'),
			'desc'		=> __('Fill the absolute path to your Facebook account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_googleplus',
			'title'		=> __('Google+', 'gp'),
			'desc'		=> __('Fill the absolute path to your Google+ account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_pinterest',
			'title'		=> __('Pinterest', 'gp'),
			'desc'		=> __('Fill the absolute path to your Pinterest account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_tripadvisor',
			'title'		=> __('TripAdvisor', 'gp'),
			'desc'		=> __('Fill the absolute path to your TripAdvisor account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_foursquare',
			'title'		=> __('Foursquare', 'gp'),
			'desc'		=> __('Fill the absolute path to your Foursquare account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_yelp',
			'title'		=> __('Yelp', 'gp'),
			'desc'		=> __('Fill the absolute path to your Yelp account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_xing',
			'title'		=> __('Xing', 'gp'),
			'desc'		=> __('Fill the absolute path to your Xing account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_pinterest',
			'title'		=> __('Pinterest', 'gp'),
			'desc'		=> __('Fill the absolute path to your Pinterest account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_qype',
			'title'		=> __('Qype', 'gp'),
			'desc'		=> __('Fill the absolute path to your Qype account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_zagat',
			'title'		=> __('Zagat', 'gp'),
			'desc'		=> __('Fill the absolute path to your Zagat account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_youtube',
			'title'		=> __('YouTube', 'gp'),
			'desc'		=> __('Fill the absolute path to your YouTube account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_vimeo',
			'title'		=> __('Vimeo', 'gp'),
			'desc'		=> __('Fill the absolute path to your Vimeo account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_flickr',
			'title'		=> __('Flickr', 'gp'),
			'desc'		=> __('Fill the absolute path to your Flickr account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_tumblr',
			'title'		=> __('Tumblr', 'gp'),
			'desc'		=> __('Fill the absolute path to your Tumblr account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_instagram',
			'title'		=> __('Instagram', 'gp'),
			'desc'		=> __('Fill the absolute path to your Instagram account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_socials_amazon',
			'title'		=> __('Amazon', 'gp'),
			'desc'		=> __('Fill the absolute path to your Amazon account.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_heading_sharing_box',
			'title'		=> __('Sharing Box', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_share_twitter',
			'title'		=> __('Twitter Button', 'gp'),
			'desc'		=> __('Enable / disable Twitter button for post sharing.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_share_facebook',
			'title'		=> __('Facebook Button', 'gp'),
			'desc'		=> __('Enable / disable Facebook button for post sharing.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_share_googleplus',
			'title'		=> __('Google+ Button', 'gp'),
			'desc'		=> __('Enable / disable Google+ button for post sharing.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_share_pinterest',
			'title'		=> __('Pinterest Button', 'gp'),
			'desc'		=> __('Enable / disable Pinterest button for post sharing.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'true',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
        
        $options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_heading_twitter_api',
			'title'		=> __('Twitter API', 'gp'),
			'type'		=> 'heading'
		);
        
        $options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_twitter_api_consumer_key',
			'title'		=> __('Consumer Key', 'gp'),
			'desc'		=> __('Fill the consumer key of your Twitter application. Twitter application you can create on <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a>.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
	   
        $options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_twitter_api_consumer_secret',
			'title'		=> __('Consumer Secret', 'gp'),
			'desc'		=> __('Fill the consumer secret of your Twitter application. Twitter application you can create on <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a>.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
	   
        $options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_twitter_api_access_token',
			'title'		=> __('Access Token', 'gp'),
			'desc'		=> __('Fill the access token of your Twitter application. Twitter application you can create on <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a>.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
	   
        $options[] = array(
			'section'	=> 'socials',
			'id'		=> GP_SHORTNAME . '_twitter_api_access_token_secret',
			'title'		=> __('Access Secret', 'gp'),
			'desc'		=> __('Fill the access secret of your Twitter application. Twitter application you can create on <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a>.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
	   
		/*
		----------------------------------------------------------------------------------------------------
		Forms Tab
		----------------------------------------------------------------------------------------------------
		*/
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_heading_contact_form',
			'title'		=> __('Contact Form', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_contact_email',
			'title'		=> __('Email Address for Receiving Emails', 'gp'),
			'desc'		=> __('Fill your email address in this format: john@doe.com', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_contact_subject',
			'title'		=> __('Subject of Received Emails', 'gp'),
			'desc'		=> __('Fill the subject of the email. Something as: Name of the site - Contact form.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_heading_reservation_form',
			'title'		=> __('Reservation Form', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_reservation_email',
			'title'		=> __('Email Address for Receiving Emails', 'gp'),
			'desc'		=> __('Fill your email address in this format: john@doe.com', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_reservation_subject',
			'title'		=> __('Subject of Received Emails', 'gp'),
			'desc'		=> __('Fill the subject of the email. Something as: Name of the site - Reservation form.', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_reservation_date_format',
			'title'		=> __('Datepicker Date Format', 'gp'),
			'desc'		=> __('Fill the date format of datepicker input. Default: mm/dd/yy.<br />  More infomation: <a href="http://api.jqueryui.com/datepicker/#option-dateFormat" target="_blank">http://api.jqueryui.com/datepicker/#option-dateFormat</a>.', 'gp'),
			'type'		=> 'input',
			'std'		=> 'mm/dd/yy'
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_reservation_date_max',
			'title'		=> __('Datepicker Max Date', 'gp'),
			'desc'		=> __('Fill the maximum selectable date in a number of days from today or in a string. "14" = 14 days, "21" = 21 days, "+1m" = 1 month, "+1w" = 1 week, "+1d" = 1 day, "+1m +1w" = 1 month and 1 week. Default: null (no maximum).<br /> More infomation: <a href="http://api.jqueryui.com/datepicker/#option-maxDate" target="_blank">http://api.jqueryui.com/datepicker/#option-maxDate</a>.', 'gp'),
			'type'		=> 'input',
			'std'		=> 'null'
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_heading_recaptcha',
			'title'		=> __('reCaptcha', 'gp'),
			'type'		=> 'heading'
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_recaptcha',
			'title'		=> __('reCaptcha', 'gp'),
			'desc'		=> __('Enable / disable reCaptcha for contact form.', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'false',
			'choices'	=> array(
				__('Enabled', 'gp') . '|true',
				__('Disabled', 'gp') . '|false'
			)
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_recaptcha_theme',
			'title'		=> __('reCaptcha Theme', 'gp'),
			'desc'		=> __('Select reCaptcha theme. Available themes you can see on: <a href="https://developers.google.com/recaptcha/docs/customization">https://developers.google.com/recaptcha/docs/customization</a>', 'gp'),
			'type'		=> 'select-text',
			'std'		=> 'clean',
			'choices'	=> array(
				__('Clean', 'gp') . '|clean',
				__('Red', 'gp') . '|red',
				__('White', 'gp') . '|white',
				__('Blackglass', 'gp') . '|blackglass'
			)
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_recaptcha_public_key',
			'title'		=> __('Public Key [REQUIRED]', 'gp'),
			'desc'		=> __('Fill the public key. Keys you can get on: <a href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		$options[] = array(
			'section'	=> 'forms',
			'id'		=> GP_SHORTNAME . '_form_recaptcha_private_key',
			'title'		=> __('Private Key [REQUIRED]', 'gp'),
			'desc'		=> __('Fill the private key. Keys you can get on: <a href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>', 'gp'),
			'type'		=> 'input',
			'std'		=> ''
		);
		
		/*
		----------------------------------------------------------------------------------------------------
		Tracking Tab
		----------------------------------------------------------------------------------------------------
		*/
	
		$options[] = array(
			'section'	=> 'tracking',
			'id'		=> GP_SHORTNAME . '_tracking_code',
			'title'		=> __('Tracking Code', 'gp'),
			'desc'		=> __('Paste your Google Analytics (or other) tracking code. It will be inserted before the closing body tag of your theme.', 'gp'),
			'type'		=> 'textarea',
			'std'		=> ''
		);
		
		return $options;
			
	}

}

?>