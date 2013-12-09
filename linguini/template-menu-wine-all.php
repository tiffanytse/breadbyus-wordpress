<?php

/*

Template Name:	Wines - All Items

@name			Wines - All Items Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Menu Type
$menutype           = 'wine';

// Post Type
$posttype           = 'menu-wine';

// Taxonomy
$taxonomy           = 'menu-wine-categories';

// Get Menu All Template
get_template_part('loop', 'menu-all');