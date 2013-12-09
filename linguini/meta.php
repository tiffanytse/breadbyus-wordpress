<?php

/*

@name			Post Meta Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Post Format
if (!get_post_format()) {
    $post_format = 'format-standard';
} else {
    $post_format = 'format-' . get_post_format();
}

if ($post_format != 'format-quote') {
?>

    <div class="post-meta clearfix">
                    
        <div class="float-left">
            
            <span class="post-date">
                
                <?php the_time(); ?>
                
            </span><!-- END // post-date -->
            
        </div>
        
        <div class="float-right">

            <?php if (comments_open()) { ?>
                
                <span class="post-comments">
                    
                    <a href="<?php comments_link(); ?>">
                        <span class="icon-comment corner-small transition"></span> <?php comments_number(__('0', 'gp'), __('1', 'gp'), __('%', 'gp')); ?>
                    </a>
                    
                </span><!-- END // post-comments -->
                
            <?php } ?>
                
            <?php if (function_exists('zilla_likes')) { ?>
                
                <span class="post-likes">
                    
                    <?php zilla_likes(); ?>
                    
                </span><!-- END // post-likes -->
                
            <?php } ?>
                
        </div>
        
    </div><!-- END // post-meta -->

<?php
} else if ($post_format == 'format-quote') {
?>

    <div class="post-meta clearfix">

        <?php if (comments_open() && get_comments_number() != 0) { ?>
            
            <span class="post-comments">
                
                <a href="<?php comments_link(); ?>">
                    <span class="icon-comment corner-small transition"></span> <?php comments_number(__('0', 'gp'), __('1', 'gp'), __('%', 'gp')); ?>
                </a>
                
            </span>
            
        <?php } ?>
        
        <?php if (function_exists('zilla_likes')) { ?>
            
            <span class="post-likes">
                
                <?php zilla_likes(); ?>
            
            </span>
            
        <?php } ?>

    </div><!-- END // post-meta -->

<?php
}