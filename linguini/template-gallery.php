<?php

/*

Template Name:	Galleries

@name			Gallery Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Sidebar
if (gp_option('gp_gallery_sidebar')) {
	
	$sidebar        = gp_option('gp_gallery_sidebar');	
	
} else {
	
	$sidebar        = 'left';
	
}

// Content & Grid Classes
if (get_terms('category-gallery') || is_active_sidebar('widget-area-gallery')) {
	
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
	$grid_class		= 'grid-tiles-sidebar';
	
} else {
	
	$content_class	= 'content';
	$grid_class		= 'grid-tiles';
	
}

get_header();
?>
    
    <?php get_template_part('title'); ?>
    
    <?php gp_start('div', array('canvas', 'canvas-full'), false); ?>

        <?php
            if ($sidebar == 'left') {
                if (get_terms('category-gallery') || is_active_sidebar('widget-area-gallery')) {
                    get_sidebar('gallery');
                }
            }
        ?>
        
        <div class="content-gallery <?php echo $content_class; ?>" role="main">
        
            <?php
                // Loop
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        
                        if (!empty($post->post_content)) {
                        ?>
                
                            <div class="page-content">
                            
                                <?php the_content(); ?>
                            
                            </div><!-- END // page-content -->
                                
                        <?php
                        } //if
                    } //while
                } //if
                wp_reset_query();
            ?>

            <div class="grid-gallery grid-merge clearfix <?php echo $grid_class; ?>">

                <?php
                    global $post;
                    
                    // Counter
                    $post_count = 1;
                    
                    // Posts per Page
                    if (gp_option('gp_gallery_per_page')) {
                        $posts_per_page = gp_option('gp_gallery_per_page');
                    } else {
                        $posts_per_page = '-1';
                    }

                    // Query
                    $gp_query_args = array(
                        'post_type'             => 'gallery',
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
        
                                            <div class="post-image overlay">
                                                
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
                        
                        <div class="page-content align-center">
                            
                            <p><?php _e('No galleries were found.', 'gp'); ?></p>
                            
                        </div><!-- END // page-content -->

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
                if (get_terms('category-gallery') || is_active_sidebar('widget-area-gallery')) {
                    get_sidebar('gallery');
                }
            }
        ?>

	<?php gp_end('div', array('canvas', 'canvas-full'), false); ?>

<?php
get_footer();