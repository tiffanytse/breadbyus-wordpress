<?php

/*

Template Name:	Drinks

@name			Drinks Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Menu Type
$menutype           = 'drink';

// Post Type
$posttype           = 'menu-drink';

// Taxonomy
$taxonomy           = 'menu-drink-categories';

// Get Menu Template
get_template_part('loop', 'menu');