<?php

/*

@name			Single Video Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

get_header();
?>
    
    <?php get_template_part('title'); ?>
    
	<?php gp_start('div', 'canvas'); ?>
				
		<div class="grid">

            <div class="content single-video" role="main">

                <?php get_template_part('meta'); ?>

                <?php 
                    if (have_posts()) { 
                        while (have_posts()) {
                            the_post();
                            
                            $block_class				= 'post post-video';
                            
                            $video_youtube_code			= __(gp_meta('gp_video_youtube_code'));
                            $video_vimeo_code			= __(gp_meta('gp_video_vimeo_code'));
                            ?>
                            
                                <div class="single-content">
                                    
                                    <?php if (!empty($video_youtube_code)) { ?>
                                    
                                        <div class="single-post-video">
                                        
                                            <iframe src="http://www.youtube.com/embed/<?php echo $video_youtube_code; ?>?wmode=opaque&amp;autoplay=0&amp;enablejsapi=1&modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=dark" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                                        
                                        </div><!-- END // post-video -->
                                        
                                    <?php } else if (!empty($video_vimeo_code)) { ?>
                                    
                                        <div class="single-post-video">
                                        
                                            <iframe src="http://player.vimeo.com/video/<?php echo $video_vimeo_code; ?>?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                        
                                        </div><!-- END // post-video -->
                                        
                                    <?php } ?>
                                    
                                    <div class="single-post-content">
                                    
                                        <?php the_content(); ?>
                                    
                                    </div><!-- END // single-post-content -->
                                
                                    <?php if (function_exists('gp_share')) { gp_share(); } ?>
                                
                                </div><!-- END // single-content -->
                            
                            <?php
                        } //while
                    } //if
                    wp_reset_query();
                ?>

                <?php
                    if (comments_open()) {
                        comments_template(); 
                    } 
				?>
                
			</div><!-- END // content -->

        </div><!-- END // grid -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();