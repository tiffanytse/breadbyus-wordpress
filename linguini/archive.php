<?php

/*

@name			Archive Template
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

// View Type
if (gp_option('gp_blog_view') == 'list') {
	
	$view_type		= 'list';
	
} else {
	
	$view_type		= 'grid';
	
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

    <header class="page-header">
    
        <?php
        $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
        ?>
        <?php
            // Category Archive
            if (is_category()) {
            ?>
            
                <h1><?php printf(__('All posts in %s', 'gp'), single_cat_title('', false)); ?></h1>
            
            <?php
            // Tag Archive
            } else if (is_tag()) {
            ?>
        
                <h1><?php printf(__('All posts tagged %s', 'gp'), single_tag_title('', false)); ?></h1>
            
            <?php
            // Author Archive
            } else if (is_author()) {
            ?>
        
                <h1><?php printf(__('All posts by %s', 'gp'), $curauth->nickname); ?></h1>
            
            <?php
            // Day Archive
            } else if (is_day()) {
            ?>
        
                <h1><?php _e('Archive for', 'gp'); ?> <?php the_time(__('F jS, Y', 'gp')); ?></h1>
        
            <?php
            // Month Archive
            } else if (is_month()) {
            ?>
            
                <h1><?php _e('Archive for', 'gp'); ?> <?php the_time(__('F, Y', 'gp')); ?></h1>
        
            <?php
            // Year Archive
            } else if (is_year()) {
            ?>
        
                <h1><?php _e('Archive for', 'gp'); ?> <?php the_time(__('Y', 'gp')); ?></h1>
        
            <?php
            // Post Format Archive
            } else if (get_post_format()) {
            ?>
        
                <h1><?php printf(__('Archive for %s', 'gp'), get_post_format()); ?></h1>
        
            <?php
            // Paged Archive
            } else if (isset($_GET['paged']) && !empty($_GET['paged'])) {
            ?>
            
                <h1><?php _e('Blog archives', 'gp'); ?></h1>
        
            <?php
            }
        ?>
        
    </header><!-- page-header -->

    <?php
        if ($view_type == 'grid') {
            gp_start('div', array('canvas', 'canvas-full'), false);
        } else {
            gp_start('div', 'canvas');
        }
    ?>

        <?php
            if ($sidebar == 'left') {
                if (is_active_sidebar('widget-area-blog')) {
                    get_sidebar('blog');
                }
            }
        ?>
    
        <div class="content-blog <?php echo $content_class; ?>" role="main">
        
            <?php
                if (category_description()) {
                ?>
            
                    <div class="content-page">
                    
                        <?php echo category_description(); ?>
                        
                    </div><!-- content-page -->
                
                <?php
                }
            ?>

            <?php if ($view_type == 'grid') { ?>
            
                <div class="grid-post clearfix <?php echo $grid_class; ?>">
                
            <?php } else if ($view_type == 'list') { ?>
                    
                <div class="list-post clearfix">
                        
            <?php } ?>

                <?php
                    // Counter
                    $post_count = 1;
                    
                    // Loop
                    if (have_posts()) { 
                        while (have_posts()) { 
                            the_post();
                            
                            // Post Format Class
                            if (!get_post_format()) {
                                $post_format = 'format-standard';
                            } else {
                                $post_format = 'format-' . get_post_format();
                            }
                            
                            // Post View Type
                            if ($view_type == 'grid') {
                                $post_view_type = 'tile';
                            } else {
                                $post_view_type = 'list-item';
                            }
                            
                            // Post Class
                            if (has_post_thumbnail()) {
                                $post_class = array('has-post-thumbnail', 'post', 'post-' . $post_count, 'clearfix', $post_view_type, $post_format);
                            } else {
                                $post_class = array('post', 'post-' . $post_count, 'clearfix', $post_view_type, $post_format);
                            }
                            ?>
                        
                                <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                                    
                                    <?php if ($view_type == 'grid') { ?>
                                    
                                        <div class="tile-block">
                                    
                                    <?php } ?>
                                    
                                    <?php
                                        if (!get_post_format()) {
                                            get_template_part('content', 'standard');
                                        } else {
                                            get_template_part('content', get_post_format());
                                        }
                                    ?>
                                        
                                    <?php if ($view_type == 'grid') { ?>
    
                                        </div><!-- END // tile-block -->
                                    
                                    <?php } ?>
                                
                                </article><!-- END // post -->
                            
                            <?php
                            $post_count++;
                        } //while
                    } //if
                    wp_reset_query();
                ?>

            </div><!-- END // grid-blog / list-blog -->
            
            <?php if (function_exists('gp_pagination')) { gp_pagination(); } ?>
        
        </div><!-- END // content -->
        
        <?php
            if ($sidebar == 'right') {
                if (is_active_sidebar('widget-area-blog')) {
                    get_sidebar('blog');
                }
            }
        ?>

	<?php
        if ($view_type == 'grid') {
            gp_end('div', array('canvas', 'canvas-full'), false);
        } else {
            gp_end('div', 'canvas');
        }
    ?>

<?php
get_footer();