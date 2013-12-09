<?php

/*

Template Name:	Dinners - All Items

@name			Dinners - All Items Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Menu Type
$menutype           = 'dinner';

// Post Type
$posttype           = 'menu-dinner';

// Taxonomy
$taxonomy           = 'menu-dinner-categories';

// Get Menu All Template
get_template_part('loop', 'menu-all');