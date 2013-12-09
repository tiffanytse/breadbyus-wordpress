<?php

/*

@name			Gallery Sidebar Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Sidebar Class
if (gp_option('gp_gallery_sidebar')) {
    
    $sidebar = gp_option('gp_gallery_sidebar');
    
} else {
    
    $sidebar = 'left';
    
}
?>

<div class="sidebar-gallery sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">
    
    <?php gp_categories('category-gallery'); ?>
    
    <?php dynamic_sidebar('widget-area-gallery'); ?>
    
</div><!-- END // sidebar -->