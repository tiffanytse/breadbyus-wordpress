<?php

/*

Template Name:	Lunches

@name			Lunches Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Menu Type
$menutype           = 'lunch';

// Post Type
$posttype           = 'menu-lunch';

// Taxonomy
$taxonomy           = 'menu-lunch-categories';

// Get Menu Template
get_template_part('loop', 'menu');