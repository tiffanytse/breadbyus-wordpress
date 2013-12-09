<?php

/*

Template Name:	Menus

@name			Menus Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Menu Type
$menutype           = 'menu';

// Post Type
$posttype           = 'menu';

// Taxonomy
$taxonomy           = 'menu-type';

// Get Menu Template
get_template_part('loop', 'menu');