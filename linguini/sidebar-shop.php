<?php

/*

@name			WooCommerce Sidebar Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Sidebar Class
if (gp_option('gp_shop_sidebar')) {
    
    $sidebar = gp_option('gp_shop_sidebar');
    
} else {
    
    $sidebar = 'left';
    
}
?>

<div class="sidebar-shop sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">

    <?php dynamic_sidebar('widget-area-shop'); ?>
    
</div><!-- END // sidebar -->