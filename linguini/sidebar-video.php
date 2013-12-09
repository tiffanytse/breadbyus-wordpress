<?php

/*

@name			Video Sidebar Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Sidebar Class
if (gp_option('gp_video_sidebar')) {
    
    $sidebar = gp_option('gp_video_sidebar');
    
} else {
    
    $sidebar = 'left';
    
}
?>

<div class="sidebar-video sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">
    
    <?php gp_categories('category-video'); ?>
    
    <?php dynamic_sidebar('widget-area-video'); ?>
    
</div><!-- END // sidebar -->