<?php

/*

@name			404 Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/ 

get_header();
?>

	<header class="page-header">
    
        <h1>
            <?php _e('Page not Found', 'gp'); ?>
        </h1>
        
    </header><!-- END // page-header -->
    
	<?php gp_start('div', 'canvas'); ?>
		
        <div class="content-404 content align-center" role="main">
                            
			<?php 
                $blog_title = get_bloginfo('name'); 
                $blog_url = home_url();
            ?>
            
            <h2><?php _e('Sorry, this page was not found.', 'gp'); ?></h2>
            
            <p><?php printf(__('You can try to return to the <a title="%1$s homepage" href="%2$s">%1$s homepage</a> and start fresh.', 'gp'), $blog_title, $blog_url); ?></p>
            
		</div><!-- END // content -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();