<?php

/*

@name			Right Toolbar Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Target
if (gp_option('gp_socials_target') != 'false') {
	$target = ' target="_blank"';
} else {
	$target = ' target="_self"';
}

?>

    <?php gp_start('div', array('toolbar', 'toolbar-right')); ?>
        
        <ul class="socials">
        
            <?php if (gp_option('gp_socials_twitter')) { ?>
                <li class="social-twitter">
                    <a class="corner" href="<?php echo gp_option('gp_socials_twitter'); ?>" title="<?php _e('Twitter', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Twitter', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_facebook')) { ?>
                <li class="social-facebook">
                    <a class="corner" href="<?php echo gp_option('gp_socials_facebook'); ?>" title="<?php _e('Facebook', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Facebook', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_googleplus')) { ?>
                <li class="social-googleplus">
                    <a class="corner" href="<?php echo gp_option('gp_socials_googleplus'); ?>" title="<?php _e('Google+', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Google+', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_pinterest')) { ?>
                <li class="social-pinterest">
                    <a class="corner" href="<?php echo gp_option('gp_socials_pinterest'); ?>" title="<?php _e('Pinterest', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Pinterest', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_tripadvisor')) { ?>
                <li class="social-tripadvisor">
                    <a class="corner" href="<?php echo gp_option('gp_socials_tripadvisor'); ?>" title="<?php _e('TripAdvisor', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('TripAdvisor', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_foursquare')) { ?>
                <li class="social-foursquare">
                    <a class="corner" href="<?php echo gp_option('gp_socials_foursquare'); ?>" title="<?php _e('Foursquare', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Foursquare', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_yelp')) { ?>
                <li class="social-yelp">
                    <a class="corner" href="<?php echo gp_option('gp_socials_yelp'); ?>" title="<?php _e('Yelp', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Yelp', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_xing')) { ?>
                <li class="social-xing">
                    <a class="corner" href="<?php echo gp_option('gp_socials_xing'); ?>" title="<?php _e('Xing', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Xing', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_qype')) { ?>
                <li class="social-qype">
                    <a class="corner" href="<?php echo gp_option('gp_socials_qype'); ?>" title="<?php _e('Qype', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Qype', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_zagat')) { ?>
                <li class="social-zagat">
                    <a class="corner" href="<?php echo gp_option('gp_socials_zagat'); ?>" title="<?php _e('Zagat', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Zagat', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_youtube')) { ?>
                <li class="social-youtube">
                    <a class="corner" href="<?php echo gp_option('gp_socials_youtube'); ?>" title="<?php _e('YouTube', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('YouTube', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_vimeo')) { ?>
                <li class="social-vimeo">
                    <a class="corner" href="<?php echo gp_option('gp_socials_vimeo'); ?>" title="<?php _e('Vimeo', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Vimeo', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_flickr')) { ?>
                <li class="social-flickr">
                    <a class="corner" href="<?php echo gp_option('gp_socials_flickr'); ?>" title="<?php _e('Flickr', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Flickr', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_tumblr')) { ?>
                <li class="social-tumblr">
                    <a class="corner" href="<?php echo gp_option('gp_socials_tumblr'); ?>" title="<?php _e('Tumblr', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Tumblr', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_instagram')) { ?>
                <li class="social-instagram">
                    <a class="corner" href="<?php echo gp_option('gp_socials_instagram'); ?>" title="<?php _e('Instagram', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Instagram', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_socials_amazon')) { ?>
                <li class="social-amazon">
                    <a class="corner" href="<?php echo gp_option('gp_socials_amazon'); ?>" title="<?php _e('Amazon', 'gp'); ?>"<?php echo $target; ?>>
                        <?php _e('Amazon', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if (gp_option('gp_search') != 'false') { ?>
                <li class="modal-search-button">
                    <a href="javascript:;" class="corner" title="<?php _e('Search ...', 'gp'); ?>">
                        <?php _e('Search ...', 'gp'); ?>
                    </a>
                </li>
            <?php } ?>
            
        </ul><!-- END // socials -->
        
        <?php
            if (function_exists('qtrans_generateLanguageSelectCode')) {
                echo qtrans_generateLanguageSelectCode('image');
            }
        ?>
            
    <?php gp_end('div', array('toolbar', 'toolbar-right')); ?>