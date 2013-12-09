<?php

/*

@name			Quote Post Format Content Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

global $view_type, $view_page, $post_count;

// !Single
if (!is_single()) {
    if ($view_type == 'grid') {
    ?>
    
        <div class="post-content">
    
            <blockquote>
                
                <?php
                    if (gp_meta('gp_post_quote')) {
                        echo gp_meta('gp_post_quote');
                    } else {
                        the_content();
                    }
                ?>
                
            </blockquote>
            
            <h3 class="post-title">
    
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
                
            </h3><!-- END // post-title -->
            
            <?php get_template_part('meta'); ?>
            
        </div><!-- END // post-content -->
    
    <?php
    } else if ($view_type == 'list') {
    ?>
    
        <blockquote>
                
            <?php
                if (gp_meta('gp_post_quote')) {
                    echo gp_meta('gp_post_quote');
                } else {
                    the_content();
                }
            ?>
            
        </blockquote>
        
        <div class="post-footer clearfix">
        
            <h3 class="post-title float-left">
    
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
                
            </h3><!-- END // post-title -->
            
            <div class="float-right">
                
                <?php get_template_part('meta'); ?>
                
            </div>
        
        </div><!-- END // post-footer -->
    
    <?php
    }
// Single
} else if (is_single()) {
?>

    <?php if (gp_meta('gp_post_quote')) { ?>
    
        <div class="single-post-content">
            
            <blockquote>
                <?php
                if (gp_meta('gp_post_quote')) {
                    echo gp_meta('gp_post_quote');
                } else {
                    the_content();
                }
                ?>
            </blockquote>
            
        </div><!-- END // post-content -->
    
    <?php } ?>
    
    <?php if (has_tag()) { ?>
    
        <div class="post-tags">
            
            <?php the_tags('', '', ''); ?>
            
        </div><!-- END // post-tags -->
        
    <?php } ?>
    
    <?php if (function_exists('gp_share')) { gp_share(); } ?>

<?php
}