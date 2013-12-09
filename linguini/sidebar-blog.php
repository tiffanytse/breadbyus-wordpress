<?php

/*

@name			Blog Sidebar Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Sidebar
if (gp_option('gp_blog_sidebar')) {
	
	$sidebar = gp_option('gp_blog_sidebar');	
	
} else {
	
	$sidebar = 'right';
	
}
?>

<div class="sidebar-blog sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">

    <?php dynamic_sidebar('widget-area-blog'); ?>
    
</div><!-- END // sidebar -->