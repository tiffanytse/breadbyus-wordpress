<?php

/*

Template Name:	Menu with All Items

@name			Menu with All Items Template
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

// Get Menu All Template
get_template_part('loop', 'menu-all');