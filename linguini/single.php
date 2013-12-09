<?php

/*

@name			Single Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/ 

// Sidebar
if (gp_option('gp_blog_sidebar')) {
	
	$sidebar		= gp_option('gp_blog_sidebar');	
	
} else {
	
	$sidebar		= 'right';
	
}

// Content & Grid Classes
if (is_active_sidebar('widget-area-blog')) {
	
	$content_class	= 'content-blog content-sidebar content-sidebar-' . $sidebar;
	$grid_class		= 'grid-tiles-sidebar';
	
} else {
	
	$content_class	= 'content';
	$grid_class		= 'grid-tiles';
	
}

get_header();
?>

	<?php get_template_part('title'); ?>
 
    <?php gp_start('div', 'canvas'); ?>

        <?php
            if ($sidebar == 'left') {
                if (is_active_sidebar('widget-area-blog')) {
                    get_sidebar('blog');
                }
            }
        ?>
        
        <div class="content-blog single-blog <?php echo $content_class; ?>" role="main">

            <?php 
                if (have_posts()) { 
                    while (have_posts()) {
                        the_post();
                        
                        // Post Format
                        if (!get_post_format()) {
                            $post_format = 'format-standard';
                        } else {
                            $post_format = 'format-' . get_post_format();
                        }
                        
                        // Post Class
                        if (has_post_thumbnail()) {
                            $post_class = array('has-post-thumbnail', 'post', $post_format);
                        } else {
                            $post_class = array('post', $post_format);
                        }
                        ?>
                        
                            <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                            
                                <?php
                                    if (!get_post_format()) {
                                        get_template_part('content', 'standard');
                                    } else {
                                        get_template_part('content', get_post_format());
                                    }
                                ?>
                                
                            </article>
                        
                            <?php wp_link_pages(); ?>
                        
                        <?php
                    } //while
                } //if
                wp_reset_query();
            ?>
            
            <?php
                if (comments_open()) {
                ?>
                
                    <div class="single-content">    
                
                        <?php comments_template(); ?>
                    
                    </div><!-- END // single-content -->
                    
                <?php   
                } 
            ?>
            
        </div><!-- END // content -->
        
        <?php
            if ($sidebar == 'right') {
                if (is_active_sidebar('widget-area-blog')) {
                    get_sidebar('blog');
                }
            }
        ?>

	<?php gp_end('div', 'canvas'); ?>
        
<?php
get_footer();