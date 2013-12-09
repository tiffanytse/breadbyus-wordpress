<?php

/*

@name			Food Taxonomy Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Menu Type
$menutype           = 'food';

// Post Type
$posttype           = 'menu-food';

// Taxonomy
$taxonomy           = 'menu-food-categories';

// Get Menu Categories Template
get_template_part('loop', 'menu-categories');