<?php

/*

@name			Standard Post Format Content Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

global $view_type, $view_page, $post_count;

// Original Image
$original_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');

// !Single
if (!is_single()) {
    if ($view_type == 'grid') {
    ?>

        <?php
            if (has_post_thumbnail()) {
            ?>
    
                <div class="post-image overlay">
                    
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                        <?php
                            if ($view_page == 'home') {
                                the_post_thumbnail('small-fixed');
                            } else {
                                if ($post_count == 1) {
                                    the_post_thumbnail('medium');
                                } else {
                                    the_post_thumbnail('small');
                                }
                            }
                        ?>
                        <span class="overlay-block"><span class="overlay-icon"></span></span>
                    </a>
                    
                </div><!-- END // post-image -->
    
            <?php
            }
        ?>
    
        <div class="post-content">
                                            
            <h2 class="post-header">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2><!-- END // post-header -->
                                            
            <?php get_template_part('meta'); ?>
            
            <?php if (!empty($post->post_content)) { ?>
            
                <div class="post-excerpt">
                    
                    <?php the_excerpt(); ?>
                    
                </div><!-- END // post-excerpt -->
            
            <?php } ?>
    
            <div class="post-more">
                <a href="<?php the_permalink(); ?>" title="<?php _e('Read more ...', 'gp'); ?> <?php the_title(); ?>">
                    <?php _e('Read more ...', 'gp'); ?>
                </a>
            </div><!-- END // post-more -->
        
        </div><!-- END // post-content -->
    
    <?php
    } else if ($view_type == 'list') {
    ?>
        
        <?php
            if (has_post_thumbnail()) {
            ?>
    
                <div class="post-image overlay">
                    
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                        <?php the_post_thumbnail('large-wide'); ?>
                        <span class="overlay-block"><span class="overlay-icon"></span></span>
                    </a>
                    
                </div><!-- END // post-image -->
    
            <?php
            }
        ?>
        
        <?php get_template_part('meta'); ?>

        <h2 class="post-header">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
            </a>
        </h2><!-- END // post-header -->
        
        <?php if (!empty($post->post_content)) { ?>
        
            <div class="post-excerpt">
                
                <?php the_excerpt(); ?>
                
            </div><!-- END // post-excerpt -->
        
        <?php } ?>
        
        <div class="post-footer clearfix">
            
            <div class="post-taxonomies float-left two-third">
                
                <?php the_taxonomies(); ?>
                
            </div><!-- END // post-taxonomies -->
        
            <div class="post-more float-right one-third">
                
                <a href="<?php the_permalink(); ?>" title="<?php _e('Read more ...', 'gp'); ?> <?php the_title(); ?>">
                    <?php _e('Read more ...', 'gp'); ?>
                </a>
                
            </div><!-- END // post-more -->
            
        </div><!-- END // post-footer -->
        
    <?php  
    }
// Single
} else if (is_single()) {
?>

    <?php if (has_post_thumbnail()) { ?>

        <div class="post-image lightbox overlay">
            
            <a href="<?php echo $original_image_url[0]; ?>" title="<?php the_title(); ?>">
                <?php the_post_thumbnail('large-post'); ?>
                <span class="overlay-block"><span class="overlay-icon"></span></span>
            </a>
            
        </div><!-- END // post-image -->
    
    <?php } ?>
    
    <?php get_template_part('meta'); ?>

    <?php if (!empty($post->post_content)) { ?>
        
        <div class="single-post-content">
        
            <?php the_content(); ?>
            
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