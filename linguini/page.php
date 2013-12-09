<?php

/*

@name			Page Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Sidebar
if (gp_option('gp_page_sidebar')) {
	
	$sidebar		= gp_option('gp_page_sidebar');
	
} else {
	
	$sidebar		= 'left';
	
}

// Content Class
if (is_active_sidebar('widget-area-page')) {
	
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
	
} else {
	
	$content_class	= 'content';
	
}

get_header();
?>
    
    <?php get_template_part('title'); ?>
    
	<?php gp_start('div', 'canvas'); ?>

        <?php
            if ($sidebar == 'left') {
                if (is_active_sidebar('widget-area-page')) {
                    get_sidebar();
                }
            }
        ?>
    
        <div class="content-page <?php echo $content_class; ?>" role="main">

            <?php
                // Loop
                if (have_posts()) { 
                    while (have_posts()) { 
                        the_post();
                        ?>
                    
                            <div class="page-content">
                            
                                <?php the_content(); ?>
                            
                            </div><!-- END // page-content -->
                        
                        <?php
                    } //while
                } //if
                wp_reset_query();
            ?>

        </div><!-- END // content -->
        
        <?php
            if ($sidebar == 'right') {
                if (is_active_sidebar('widget-area-page')) {
                    get_sidebar();
                }
            }
        ?>

    <?php gp_end('div', 'canvas'); ?>

<?php
get_footer();