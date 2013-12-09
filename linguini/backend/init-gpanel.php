<?php

/*

@name			GPanel Init
@package		GPanel WordPress Framework
@since			3.0.2
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

====================================================================================================
Define Constants
====================================================================================================
*/

define('GP_VERSION', '3.0.4');
define('GP_SHORTNAME', 'gp');
define('GP_BASENAME', 'gp-theme-options');

/*
====================================================================================================
Load GPanel Components
====================================================================================================
----------------------------------------------------------------------------------------------------
Load Classes
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/classes/class', 'metabox');
get_template_part('backend/classes/class', 'fields');
get_template_part('backend/classes/class', 'taxonomy');
get_template_part('backend/classes/class', 'twitter'); // Twitter
get_template_part('backend/classes/class', 'twitteroauth'); // Twitter Oauth

/*
----------------------------------------------------------------------------------------------------
Load Helpers
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/helpers/gp', 'option');
get_template_part('backend/helpers/gp', 'meta');

/*
----------------------------------------------------------------------------------------------------
Load Inits
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/inits/init', 'backend');
// Theme Options
get_template_part('backend/inits/init', 'options');
// Backend Functions
get_template_part('backend/inits/init', 'functions');
get_template_part('backend/inits/init', 'navigation');
get_template_part('backend/inits/init', 'postformats');
get_template_part('backend/inits/init', 'shortcodes');
get_template_part('backend/inits/init', 'support');
get_template_part('backend/inits/init', 'documentation');
get_template_part('backend/inits/init', 'taxonomy');
get_template_part('backend/inits/init', 'tweets');
get_template_part('backend/inits/init', 'widgets');

/*
----------------------------------------------------------------------------------------------------
Load Custom Post Types
----------------------------------------------------------------------------------------------------
*/

/*
--------------------------------------------------
Load Menu Post Types
--------------------------------------------------
*/

if (gp_option('gp_menus_type') == 'old') {
    
    get_template_part('backend/posttypes/posttype', 'food');
    get_template_part('backend/posttypes/posttype', 'breakfast'); // From Version 2.0.0
    get_template_part('backend/posttypes/posttype', 'lunch');
    get_template_part('backend/posttypes/posttype', 'dinner');
    get_template_part('backend/posttypes/posttype', 'drink');
    get_template_part('backend/posttypes/posttype', 'wine');
    
} else {
    
    get_template_part('backend/posttypes/posttype', 'menu'); // From Version 2.0.0
    
}

get_template_part('backend/posttypes/posttype', 'slide');
get_template_part('backend/posttypes/posttype', 'callout');

get_template_part('backend/posttypes/posttype', 'event');
get_template_part('backend/posttypes/posttype', 'gallery');
get_template_part('backend/posttypes/posttype', 'video');

/*
----------------------------------------------------------------------------------------------------
Load Custom Taxonomies
----------------------------------------------------------------------------------------------------
*/

/*
--------------------------------------------------
Load Menu Taxonomies
--------------------------------------------------
*/

if (gp_option('gp_menus_type') == 'old') {
    
    get_template_part('backend/taxonomies/taxonomy', 'food');
    get_template_part('backend/taxonomies/taxonomy', 'breakfast'); // From Version 2.0.0
    get_template_part('backend/taxonomies/taxonomy', 'lunch');
    get_template_part('backend/taxonomies/taxonomy', 'dinner');
    get_template_part('backend/taxonomies/taxonomy', 'drink');
    get_template_part('backend/taxonomies/taxonomy', 'wine');
    
} else {
    
    get_template_part('backend/taxonomies/taxonomy', 'menu');
    
}

get_template_part('backend/taxonomies/taxonomy', 'event');
get_template_part('backend/taxonomies/taxonomy', 'gallery');
get_template_part('backend/taxonomies/taxonomy', 'video');

/*
----------------------------------------------------------------------------------------------------
Load Widgets
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/widgets/widget', 'about');
get_template_part('backend/widgets/widget', 'categories-event');
get_template_part('backend/widgets/widget', 'categories-gallery');
get_template_part('backend/widgets/widget', 'categories-video');
get_template_part('backend/widgets/widget', 'opening-hours');
get_template_part('backend/widgets/widget', 'recent-events');
get_template_part('backend/widgets/widget', 'recent-posts');
get_template_part('backend/widgets/widget', 'recent-tweet');
get_template_part('backend/widgets/widget', 'recent-videos');
get_template_part('backend/widgets/widget', 'subpages');
get_template_part('backend/widgets/widget', 'tweets');

/*
----------------------------------------------------------------------------------------------------
Load Shortcodes
----------------------------------------------------------------------------------------------------
*/

get_template_part('backend/shortcodes/short', 'codes');

/*
----------------------------------------------------------------------------------------------------
Load Metaboxes
----------------------------------------------------------------------------------------------------
*/

if (!gp_seo_third_party()) {
	get_template_part('backend/metaboxes/metabox', 'global');
}

?>