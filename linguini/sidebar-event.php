<?php

/*

@name			Event Sidebar Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Sidebar
if (gp_option('gp_event_sidebar')) {
    
    $sidebar = gp_option('gp_event_sidebar');
    
} else {
    
    $sidebar = 'right';
    
}
?>

<div class="sidebar-contact sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">

    <?php gp_categories('category-event'); ?>

    <?php dynamic_sidebar('widget-area-event'); ?>
    
</div><!-- END // sidebar -->