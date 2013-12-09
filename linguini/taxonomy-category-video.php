<?php

/*

@name			Video Taxonomy Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Sidebar
if (gp_option('gp_video_sidebar') == 'right') {
	$sidebar = 'right';
} else {
	$sidebar = 'left';
}

// Content & Grid Classes
if (get_terms('category-video')) {
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
	$grid_class		= 'grid-tiles-sidebar';
} else {
	$content_class	= 'one-entire';
	$grid_class		= 'grid-tiles';
}

get_header();
?>

	<?php get_template_part('title'); ?>
    
	<?php gp_start('div', array('canvas', 'canvas-full'), false); ?>
        		
		<div class="grid">
        
        	<?php
                if ($sidebar == 'left') {
                    get_sidebar('video');
                }
			?>
            
            <div class="content <?php echo $content_class; ?>" role="main">
            	
            	<?php
                    if (term_description()) {
                    ?>
                        
                        <div class="page-content">
                            
                            <?php echo term_description(); ?>
                            
                        </div>
                        
                    <?php
                    }
                ?>
            	
            	<div class="grid-video grid-merge clearfix <?php echo $grid_class; ?>">

					<?php
                        global $post;
                        
                        // Counter
                        $post_count = 1;
                        
                        // Posts per Page
                        if (gp_option('gp_video_number')) {
                            $posts_per_page = gp_option('gp_video_number');
                        } else {
                            $posts_per_page = '-1';
                        }
                        
                        // Get Terms
                        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                        $term_slug = is_object($term) ? $term->slug : $term['slug'];
    
                        // Query
                        $gp_query_args = array(
                            'post_type'             => 'video',
                            'taxonomy'			    => 'category-video',
                            'term'                  => $term_slug,
                            'post_status'           => 'publish',
                            'order'				    => 'DESC',
                            'orderby'               => 'date',
                            'ignore_sticky_posts'   => 1,
                            'paged'                 => $paged,
                            'posts_per_page'        => $posts_per_page
                        );
    
                        query_posts($gp_query_args);
                        
                        // Loop
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
    
                                $block_class = array('tile', 'post', 'post-' . $post_count, 'align-center');
                                ?>
                                
                                    <article <?php post_class($block_class); ?>>
                                        
                                        <div class="tile-block">
                                        
                                            <?php if (has_post_thumbnail()) { ?>
                
                                                <div class="post-image overlay-video overlay">
                                                    
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                                        <?php the_post_thumbnail('medium-gallery'); ?>
                                                        <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                    </a>
                                                    
                                                </div><!-- END // post-image -->
                                            
                                            <?php } ?>
        
                                            <div class="post-content">
    
                                                <h2 class="post-header">
                                                    
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                    
                                                </h2><!-- END // post-header -->
                                                
                                                <?php get_template_part('meta'); ?>
                                                
                                            </div><!-- END // post-content -->
                                            
                                        </div><!-- END // tile-block -->
        
                                    </article><!-- END // tile -->
    
                                <?php 
                            } //while
                        } else {
                        ?>
    
                            <p>
                                <?php _e('No videos were found.', 'gp'); ?>
                            </p>
    
                        <?php 
                        } //if
                    ?>

                </div><!-- END // grid classes -->
                
                <?php
                    // Pagination
                    if (function_exists('gp_pagination')) { gp_pagination(); }
                    
                    wp_reset_query();
                ?>
                
            </div><!-- END // content -->
            
            <?php
                if ($sidebar == 'right') {
                    get_sidebar('video');
                }
			?>

        </div><!-- END // grid -->
        
	<?php gp_end('div', array('canvas', 'canvas-full'), false); ?>

<?php
get_footer();