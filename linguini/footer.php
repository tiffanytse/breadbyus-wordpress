<?php

/*

@name			Footer Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/ 

?>

	<?php gp_start('footer', 'footer', false); ?>
    
    	<?php if (is_active_sidebar('widget-area-footer-full')) { ?>
        
            <?php gp_start('div', 'footer-block'); ?>
        
                <div class="wa-footer-full one-entire">
                
                    <?php dynamic_sidebar('widget-area-footer-full'); ?>

                </div><!-- END // wa-footer-full -->

            <?php gp_end('div', 'footer-block'); ?>
		
		<?php } ?>
        
        <?php
            if (is_active_sidebar('widget-area-footer-first') &&
                is_active_sidebar('widget-area-footer-second') &&
                is_active_sidebar('widget-area-footer-third')) {
                $area_class = 'one-third';
            } else
            if (is_active_sidebar('widget-area-footer-first') &&
                is_active_sidebar('widget-area-footer-second')) {
                $area_class = 'one-half';
            } else
            if (is_active_sidebar('widget-area-footer-first')) {
                $area_class = 'one-entire align-center';
            }
            
            if (is_active_sidebar('widget-area-footer-first') ||
                is_active_sidebar('widget-area-footer-second') ||
                is_active_sidebar('widget-area-footer-third')) {
            ?>
            
                <?php gp_start('div', 'footer-block'); ?>

                    <?php if (is_active_sidebar('widget-area-footer-first')) { ?>
            
                        <div class="wa-footer-first wa-footer-block <?php echo $area_class; ?>">
                        
                            <?php dynamic_sidebar('widget-area-footer-first'); ?>
                            
                        </div><!-- END // wa-footer-first -->
                        
                    <?php } ?>
                        
                    <?php if (is_active_sidebar('widget-area-footer-second')) { ?>
            
                        <div class="wa-footer-second wa-footer-block <?php echo $area_class; ?>">
                            
                            <?php dynamic_sidebar('widget-area-footer-second'); ?>
                            
                        </div><!-- END // wa-footer-second -->
                        
                    <?php } ?>
                    
                    <?php if (is_active_sidebar('widget-area-footer-third')) { ?>
            
                        <div class="wa-footer-third wa-footer-block <?php echo $area_class; ?>">
                            
                            <?php dynamic_sidebar('widget-area-footer-third'); ?>
                            
                        </div><!-- END // wa-footer-third -->
                        
                    <?php } ?>

                <?php gp_end('div', 'footer-block'); ?>
        
            <?php
            } //if
        ?>
        
        <?php
            if (gp_option('gp_toolbar_footer') != 'false') {
                
                gp_start('div', array('footer-block', 'footer-block-toolbar'));
                
                get_template_part('toolbar', 'left');
                get_template_part('toolbar', 'right');
                
                gp_end('div', array('footer-block', 'footer-block-toolbar'));
                
            }
        ?>
        
        <?php  ?>

        <?php gp_start('div', array('footer-copyright')); ?>
            
            <?php
                if (gp_option('gp_footer_copyright')) {
                    
                    echo stripslashes(gp_option('gp_footer_copyright'));
                
                } else {
                ?>
            
                    <?php _e('Copyright &copy;', 'gp') ?> <?php echo date('Y'); ?> <a class="underline" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>"><?php echo get_bloginfo('name'); ?></a>
            
                <?php
                }
            ?>
            
        <?php gp_end('div', array('footer-copyright')); ?>
    
    <?php gp_end('footer', 'footer', false); ?>
    
    <div class="back-to-top corner-left" title="Back to Top"></div><!-- END // back-to-top -->

	<?php gp_footer(); ?>
    <?php wp_footer(); ?>

</body>
</html>