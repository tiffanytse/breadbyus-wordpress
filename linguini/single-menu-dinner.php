<?php

/*

@name			Single Dinner Template
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

// Get Menu Single Template
get_template_part('loop', 'menu-single');