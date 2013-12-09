<?php

/*

Template Name:	Breakfasts

@name			Breakfasts Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Menu Type
$menutype           = 'breakfast';

// Post Type
$posttype           = 'menu-breakfast';

// Taxonomy
$taxonomy           = 'menu-breakfast-categories';

// Get Menu Template
get_template_part('loop', 'menu');