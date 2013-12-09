<?php

/*

@name			Reservation Sidebar Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Sidebar Class
if (gp_option('gp_reservation_sidebar')) {
    
    $sidebar = gp_option('gp_reservation_sidebar');
    
} else {
    
    $sidebar = 'left';
    
}
?>

<div class="sidebar-reservation sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">

    <?php dynamic_sidebar('widget-area-reservation'); ?>
    
</div><!-- END // sidebar -->