<?php

/*

@name			Left Toolbar Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

?>
    
    <?php gp_start('div', array('toolbar', 'toolbar-left')); ?>
        
        <?php if (gp_option('gp_toolbar_left') != '') { ?>
        
            <?php echo stripslashes(gp_option('gp_toolbar_left')); ?>
        
        <?php } ?>

    <?php gp_end('div', array('toolbar', 'toolbar-left')); ?>
