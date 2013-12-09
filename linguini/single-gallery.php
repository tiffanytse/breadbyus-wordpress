<?php

/*

@name			Single Gallery Template
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
$content_class      = 'content';
$grid_class         = 'grid-tiles';

// Get Images
$images = gp_meta('gp_gallery_images', 'type=upload_plupload');

get_header();
?>
    
    <?php get_template_part('title'); ?>
    
	<?php gp_start('div', array('canvas', 'canvas-full'), false); ?>
        
        <div class="content-gallery single-gallery <?php echo $content_class; ?>" role="main">
        
            <div class="canvas-container">

                <?php get_template_part('meta'); ?>

            </div><!-- END // canvas-container -->
            
            <div class="grid-single-gallery lightbox clearfix <?php echo $grid_class; ?>">
                        
                <?php 
                    if (have_posts()) { 
                        while (have_posts()) {
                            the_post();
                            
                            $block_class = 'tile';
                            ?>
                            
                            <?php
                                foreach ($images as $image) {
                                ?>
                                
                                    <div class="<?php echo $block_class; ?>">
                                    
                                        <div class="tile-block">
                                        
                                            <div class="post-image overlay">
    
                                                <a data-gallery="gallery" href="<?php echo $image['image_full_url']; ?>" title="<?php echo $image['image_title']; ?>">
                                                    <img src="<?php echo $image['image_url']; ?>" alt="<?php echo $image['image_title']; ?>" />
                                                    <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                </a>
                                            
                                            </div><!-- END // post-image -->
                                        
                                        </div>
    
                                    </div><!-- END // tile -->
                                        
                                <?php
                                } //foreach
                            ?>
                            
                            <?php
                        } //while
                    } //if
                    wp_reset_query();
                ?>
                
            </div><!-- END // grid classes -->

            <?php 
                if (have_posts()) { 
                    while (have_posts()) {
                        the_post();
                        ?>
                        
                            <div class="canvas-container">

                                <div class="single-post-content">
                                    
                                    <?php the_content(); ?>
                                    
                                </div><!-- END // single-post-content -->
                                
                                <?php if (function_exists('gp_share')) { gp_share(); } ?>
                            
                            </div><!-- END // single-content -->
                            
                        <?php
                    } //while
                } //if
                wp_reset_query();
                
                if (comments_open()) {
                ?>
                
                    <div class="canvas-container">
                
                        <?php comments_template(); ?>
                    
                    </div><!-- END // single-content -->
                    
                <?php   
                } 
            ?>

        </div><!-- END // content -->

	<?php gp_end('div', array('canvas', 'canvas-full'), false); ?>

<?php
get_footer();