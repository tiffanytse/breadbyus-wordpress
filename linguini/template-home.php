<?php

/*

Template Name:	Homepage

@name			Homepage Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/ 

get_header(); 
?>

    <div class="canvas-home clearfix">
    
        <?php if (get_posts('post_type=slide')) { ?>

            <div class="slideshow">
            
                <div class="slideshow-container royalSlider gp-theme">
                    
                    <?php
                        global $post;
                                    
                        // Counter
                        $slide_count = 1;
                
                        // Query
                        $gp_query_args = array(
                            'post_type'              => 'slide',
                            'posts_per_page'         => -1
                        );
                        query_posts($gp_query_args);
                
                        // Loop
                        if (have_posts()) { 
                            while (have_posts()) {
                                the_post();
                
                                $slide_image_helper	= get_template_directory_uri() . '/images/bg-helper-00050a.png';
                                $slide_title = __(gp_meta('gp_slide_title'));
                                $slide_caption = __(gp_meta('gp_slide_caption'));
                                $slide_url = __(gp_meta('gp_slide_url'));
                                $slide_youtube_code	= __(gp_meta('gp_slide_youtube_code'));
                                $slide_vimeo_code = __(gp_meta('gp_slide_vimeo_code'));
                                
                                $slide_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    
                                if (!empty($slide_youtube_code)) {
                                ?>
                            
                                    <div class="slide-<?php echo $slide_count; ?> rsContent">
                                    
                                        <a class="rsImg" data-rsVideo="http://www.youtube.com/watch?v=<?php echo $slide_youtube_code; ?>" href="<?php if (has_post_thumbnail()) { echo $slide_image_url[0]; } else { echo $slide_image_helper; } ?>"></a>
                                        
                                            
                                        <div class="slide-caption rsABlock" data-fade-effect="true" data-move-effect="bottom" data-move-offset="100" data-speed="300" data-delay="0" data-easing="easeOutSine">
                                            <?php 
                                                if ($slide_title != '0') {
                                                    if (!empty($slide_url)) {
                                                    ?>
                                                    
                                                        <h2 class="link rsNoDrag">
                                                            <a href="<?php echo $slide_url; ?>" title="<?php the_title_attribute(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>
                                                        
                                                    <?php
                                                    } else {
                                                    ?>
                                                    
                                                        <h2>
                                                            <?php the_title(); ?>
                                                        </h2>
                                                
                                                    <?php
                                                    }
                                                }
                                            ?>
                                            
                                            <?php if (!empty($slide_caption)) { ?> 
                                            
                                                <p><?php echo $slide_caption; ?></p>
                                                
                                            <?php } ?>
                                            
                                        </div><!-- END // slide-caption -->
                
                                    </div><!-- END // slide -->
                        
                                <?php
                                } else if (!empty($slide_vimeo_code)) {
                                ?>
                        
                                    <div class="slide-<?php echo $slide_count; ?> rsContent">
                                    
                                        <a class="rsImg" data-rsVideo="https://vimeo.com/<?php echo $slide_vimeo_code; ?>" href="<?php if (has_post_thumbnail()) { echo $slide_image_url[0]; } else { echo $slide_image_helper; } ?>"></a>
                                        
                                        <div class="slide-caption rsABlock" data-fade-effect="true" data-move-effect="bottom" data-move-offset="100" data-speed="300" data-delay="0" data-easing="easeOutSine">
                                            <?php 
                                                if ($slide_title != '0') {
                                                    if (!empty($slide_url)) {
                                                    ?>
                                                    
                                                        <h2 class="link rsNoDrag">
                                                            <a href="<?php echo $slide_url; ?>" title="<?php the_title_attribute(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>
                                                    
                                                    <?php
                                                    } else {
                                                    ?>
                                                    
                                                        <h2>
                                                            <?php the_title(); ?>
                                                        </h2>
                                                
                                                    <?php
                                                    }
                                                }
                                            ?>
                                            
                                            <?php if (!empty($slide_caption)) { ?> 
                                            
                                                <p><?php echo $slide_caption; ?></p>
                                                
                                            <?php } ?>
                                            
                                        </div><!-- END // slide-caption -->
                
                                    </div><!-- END // slide -->
                            
                                <?php
                                } else if (has_post_thumbnail()) {
                                ?>
                        
                                    <div class="slide-<?php echo $slide_count; ?> rsContent">
                                    
                                        <img class="rsImg" src="<?php echo $slide_image_url[0]; ?>" alt="<?php echo $slide_title; ?>" />
                
                                        <div class="slide-caption rsABlock" data-fade-effect="true" data-move-effect="bottom" data-move-offset="100" data-speed="300" data-delay="0" data-easing="easeOutSine">
                                            <?php 
                                                if ($slide_title != '0') {
                                                    if (!empty($slide_url)) {
                                                    ?>
                                                    
                                                        <h2 class="link rsNoDrag">
                                                            <a href="<?php echo $slide_url; ?>" title="<?php the_title_attribute(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>
                                                    
                                                    <?php
                                                    } else {
                                                    ?>
                                                    
                                                        <h2>
                                                            <?php the_title(); ?>
                                                        </h2>
                                                
                                                    <?php
                                                    }
                                                }
                                            ?>
                                            
                                            <?php if (!empty($slide_caption)) { ?> 
                
                                                <p><?php echo $slide_caption; ?></p>
                                                
                                            <?php } ?>
                                            
                                        </div><!-- END // slide-caption -->
                
                                    </div><!-- END // slide -->
                        
                                <?php
                                } //if
    
                            $slide_count++;
                            } //while
                        } //if
                        wp_reset_query();
                    ?>
                
                </div><!-- END // slideshow -->
            
            </div><!-- END // slideshow-container -->
        
        <?php } ?>
    
        <div class="canvas-container clearfix">
            
            <?php
                if (get_posts('post_type=callout') && gp_option('gp_callout_homepage') != 'false') {
        
                    if (wp_count_posts('callout')->publish == 1) {
                        $callout_number = 1;
                    } else if (wp_count_posts('callout')->publish == 2) {
                        $callout_number = 2;
                    } else if (wp_count_posts('callout')->publish == 3) {
                        $callout_number = 3;
                    } else if (wp_count_posts('callout')->publish == 4) {
                        $callout_number = 4;
                    } else if (wp_count_posts('callout')->publish > 4) {
                        $callout_number = 4;
                    } else {
                        $callout_number = 4;
                    }
                    ?>
                
                    <div class="grid-callout-home grid posts-no-<?php echo $callout_number; ?><?php if (!get_posts('post_type=slide')) { ?> no-slides<?php }?>">
                    
                        <?php
                            global $post;
                            
                            // Counter
                            $callout_count = 1;
                    
                            // Query
                            $gp_query_args = array(
                                'post_type'              => 'callout',
                                'posts_per_page'         => $callout_number
                            );
                    
                            query_posts($gp_query_args);
                    
                            // Loop
                            if (have_posts()) { 
                                while (have_posts()) {
                                    the_post();
                                    
                                    if (has_post_thumbnail()) {
                                        $class_thumbnail = 'has-post-thumbnail';
                                    } else {
                                        $class_thumbnail = 'no-post-thumbnail';
                                    }
                                    
                                    if (gp_meta('gp_callout_url')) {
                                        $class_url = 'has-url';
                                    } else {
                                        $class_url = 'no-url';
                                    }
                                    
                                    $callout_title = __(gp_meta('gp_callout_title'));
                                    $callout_url = __(gp_meta('gp_callout_url'));
                                    $callout_description = __(gp_meta('gp_callout_description'));
                                    
                                    $callout_class = array('post', 'post-no-' . $callout_count, $class_thumbnail, $class_url);
                                    ?>
                            
                                        <article <?php post_class($callout_class); ?>>
                                            
                                            <?php if ($callout_title != '0') { ?>
                                            
                                                <h3 class="post-header transition corner-top">
                                                    
                                                    <span class="post-title">
                                                    
                                                        <?php
                                                            if (!empty($callout_url)) {
                                                            ?>
                                                            
                                                                <a class="corner-top" href="<?php echo $callout_url; ?>" title="<?php the_title_attribute(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            
                                                            <?php
                                                            } else {
                                                            
                                                                the_title();
                                                            
                                                            } 
                                                        ?>
                                                    
                                                    </span>
        
                                                </h3><!-- END // post-header -->
                                                
                                            <?php } ?>
                
                                            <?php if (has_post_thumbnail()) { ?>
                                            
                                                <div class="post-image overlay<?php if (empty($callout_description)) { ?> no-excerpt<?php } ?>">
                                                    
                                                    <?php
                                                        if (!empty($callout_url)) {
                                                        ?>
                                                        
                                                            <a href="<?php echo $callout_url; ?>" title="<?php the_title_attribute(); ?>">
                                                                <?php the_post_thumbnail('small-fixed'); ?>
                                                                <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                            </a>
                                                        
                                                        <?php
                                                        } else {
                                                        
                                                            the_post_thumbnail('small-fixed');
                                                        
                                                        } 
                                                    ?>
                                                    
                                                </div><!-- END // post-image -->
                                                
                                            <?php } ?>
                                            
                                            <?php if ($callout_description) { ?>
                                                    
                                                <div class="post-content corner-bottom">
                                                
                                                    <?php echo do_shortcode($callout_description); ?>
                                                
                                                </div><!-- END // post-excerpt -->
                                                    
                                            <?php } ?>
                    
                                        </article><!-- END // post -->
                            
                                    <?php
                                    $callout_count++;
                                } // while
                            } // if
                            wp_reset_query();
                        ?>
            
                    </div><!-- END // grid-callout-home -->
            
                <?php 
                } // if
            ?>
            
            <?php 
                if (gp_option('gp_post_homepage') != 'false') {
                
                    if (wp_count_posts()->publish == 1) {
                        $post_number = 1;
                    } else if (wp_count_posts()->publish == 2) {
                        $post_number = 2;
                    } else if (wp_count_posts()->publish == 3) {
                        $post_number = 3;
                    } else if (wp_count_posts()->publish == 4) {
                        $post_number = 4;
                    } else if (wp_count_posts()->publish > 4) {
                        $post_number = 4;
                    } else {
                        $post_number = 4;
                    }
                    
                    // Title
                    if (gp_option('gp_post_homepage_title')) {
                        $post_title = gp_option('gp_post_homepage_title');
                    } else {
                        $post_title = __('Recent posts', 'gp');
                    }
                    ?>
                    
                    <?php if (gp_option('gp_post_homepage_title_show') != 'false') { ?>
                    
                        <h2 class="home-header align-center">
                            <?php echo $post_title; ?>
                        </h2>
                    
                    <?php } ?>
                
                    <div class="grid-post-home grid posts-no-<?php echo $post_number; ?>">
                    
                        <?php
                            global $post;
                                
                            // Counter
                            $post_count = 1;
                            
                            // View Type
                            $view_type = 'grid';
                            $view_page = 'home';
                    
                            // Query
                            $gp_query_args = array(
                                'ignore_sticky_posts'	=> 1,
                                'posts_per_page'		=> $post_number
                            );
                    
                            query_posts($gp_query_args);
                    
                            // Loop
                            if (have_posts()) { 
                                while (have_posts()) {
                                    the_post();
                                    
                                    // Post Format
                                    if (!get_post_format()) {
                                        $post_format = 'format-standard';
                                    } else {
                                        $post_format = 'format-' . get_post_format();
                                    }
                                    
                                    $post_class = array('post-no-' . $post_count, $post_format);
                                    ?>
                                
                                        <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                                            
                                            <?php
                                                if (!get_post_format()) {
                                                    get_template_part('content', 'standard');
                                                } else {
                                                    get_template_part('content', get_post_format());
                                                }
                                            ?>
                                        
                                        </article><!-- END // post -->
                                    
                                    <?php
                                    $post_count++;
                                } // while
                            } // if
                            wp_reset_query();
                        ?>
            
                    </div><!-- END // grid-post-home -->
                    
                <?php
                } // if
            ?>
            
            <?php 
                if (get_posts('post_type=event') && gp_option('gp_event_homepage') != 'false') {
                
                    if (wp_count_posts('event')->publish == 1) {
                        $event_number = 1;
                    } else if (wp_count_posts('event')->publish == 2) {
                        $event_number = 2;
                    } else if (wp_count_posts('event')->publish == 3) {
                        $event_number = 3;
                    } else if (wp_count_posts('event')->publish == 4) {
                        $event_number = 4;
                    } else if (wp_count_posts('event')->publish > 4) {
                        $event_number = 4;
                    } else {
                        $event_number = 4;
                    }
                    
                    // Title
                    if (gp_option('gp_event_homepage_title')) {
                        $event_title = gp_option('gp_event_homepage_title');
                    } else {
                        $event_title = __('Upcoming events', 'gp');
                    }
                    ?>
                    
                    <?php if (gp_option('gp_event_homepage_title_show') != 'false') { ?>
                    
                        <h2 class="home-header align-center">
                            <?php echo $event_title; ?>
                        </h2>
                    
                    <?php } ?>
                
                    <div class="grid-post-home grid-event-home grid-event-upcoming grid posts-no-<?php echo $event_number; ?>">
                    
                        <?php
                            global $post;
                                
                            // Counter
                            $event_count = 1;
                    
                            // Query
                            $gp_query_args = array(
                                'post_type'             => 'event',
                                'meta_key'              => 'gp_event_date',
                                'meta_value'            => date('Y/m/d'),
                                'meta_compare'          => '>=',
                                'orderby'               => 'meta_value',
                                'order'                 => 'ASC',
                                'posts_per_page'        => $event_number
                            );
                    
                            query_posts($gp_query_args);
                    
                            // Loop
                            if (have_posts()) { 
                                while (have_posts()) {
                                    the_post();
                                    
                                    $event_time					= __(gp_meta('gp_event_time'));
                                    $event_venue				= __(gp_meta('gp_event_venue'));
                                    $event_venue_url			= __(gp_meta('gp_event_location_url'));
                                    $event_location				= __(gp_meta('gp_event_location'));
                                    $event_status				= __(gp_meta('gp_event_status'));
                                    $event_buy_text_1			= __(gp_meta('gp_event_buy_text_1'));
                                    $event_buy_url_1			= __(gp_meta('gp_event_buy_url_1'));
                                    $event_buy_text_2			= __(gp_meta('gp_event_buy_text_2'));
                                    $event_buy_url_2			= __(gp_meta('gp_event_buy_url_2'));
                                    
                                    $original_image_url 		= wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                                    
                                    // Has Info
                                    if (!empty($event_venue) || !empty($event_location)) {
                                        $event_info_class = 'has-info';
                                    } else {
                                        $event_info_class = 'no-info';
                                    }
                                    
                                    // Has Status
                                    if (!empty($event_status)) {
                                        $event_status_class = 'has-status';
                                    } else {
                                        $event_status_class = 'no-status';
                                    }
                                    
                                    // Has Action
                                    if (!empty($event_buy_text_1) && !empty($event_buy_url_1) || !empty($event_buy_text_2) && !empty($event_buy_url_2)) {
                                        $event_action_class = 'has-action';
                                    } else {
                                        $event_action_class = 'no-action';
                                    }
                                    
                                    $post_class = array('event-upcoming', 'post', 'post-' . $event_count);
                                    ?>
                                
                                        <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                                            
                                            <?php
                                                if (gp_option('gp_event_thumbnail') != 'false') {
                                                    if (has_post_thumbnail()) { 
                                                    ?>
                                            
                                                        <div class="post-image transition overlay">
                                                        
                                                            <?php if (gp_option('gp_event_single') != 'false') { ?>
                                                                
                                                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                    <?php the_post_thumbnail('small-fixed'); ?>
                                                                    <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                                </a>
                                                                
                                                            <?php } else if (gp_option('gp_event_single') == 'false' || gp_option('gp_event_single') == '' && has_post_thumbnail()) { ?>
                                                                
                                                                <span class="lightbox">
                                                                    <a href="<?php echo $original_image_url[0]; ?>" title="<?php the_title_attribute(); ?>">
                                                                        <?php the_post_thumbnail('small-fixed'); ?>
                                                                        <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                                    </a>
                                                                </span>
                                                                
                                                            <?php } else { ?>
                                                                
                                                                <?php the_post_thumbnail('small-fixed'); ?>
                                                                <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                                
                                                            <?php } ?>
            
                                                        </div><!-- END // post-image -->
                                                
                                                    <?php
                                                    }
                                                } 
                                            ?>
                                                
                                            <div class="post-content">

                                                <h5 class="post-date">
                                                    
                                                    <?php get_template_part('date', 'event'); ?>
                                                    
                                                    <?php if (!empty($event_time)) { ?>
                                                        
                                                        <small class="post-time">
                                                            <?php echo $event_time; ?>                             
                                                        </small><!-- END // post-time -->
                                                        
                                                    <?php } ?>
                                                    
                                                </h5><!-- END // post-date -->
    
                                                <h2 class="post-header">
                                                    
                                                    <?php if (gp_option('gp_event_single') != 'false') { ?>
                                                        
                                                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                        
                                                    <?php } else { ?>
                                                        
                                                        <?php the_title(); ?>
                                                        
                                                    <?php } ?>
                                                    
                                                </h2><!-- END // post-header -->
                                            
                                                <?php if (!empty($event_venue)) { ?>
                                                    
                                                    <?php if (!empty($event_venue_url)) { ?>
                                                
                                                        <div class="post-venue">
                                                            <a href="<?php echo $event_venue_url; ?>" title="<?php echo $event_venue; ?>" target="_blank">
                                                                <?php echo $event_venue; ?>
                                                            </a>
                                                        </div><!-- END // post-venue -->
                                                    
                                                    <?php } else { ?>
                                                    
                                                        <div class="post-venue">
                                                            <?php echo $event_venue; ?>
                                                        </div><!-- END // post-venue -->
                                                    
                                                    <?php } ?>
                                                    
                                                <?php } ?>
                                                
                                                <?php if (!empty($event_location)) { ?>
        
                                                    <div class="post-location">
                                                        <?php echo $event_location; ?>
                                                    </div><!-- END // post-location -->
        
                                                <?php } ?>
                                                
                                                <?php if ($post_count == 1 && ($paged == '' || $paged < 2)) { ?>
                                                
                                                    <div class="post-excerpt">
                                                        <?php the_excerpt(); ?>   
                                                    </div><!-- END // post-excerpt -->
                                                
                                                <?php } ?>
                                                
                                                <?php if (!empty($event_status)) { ?>
                                                
                                                    <div class="post-status">
                                                        <?php echo $event_status; ?>
                                                    </div><!-- END // post-status -->
                                                    
                                                <?php } ?>
                                                
                                                <?php if (!empty($event_buy_text_1) && !empty($event_buy_url_1) || !empty($event_buy_text_2) && !empty($event_buy_url_2)) { ?>
                                                
                                                    <div class="post-footer">
    
                                                        <?php if (!empty($event_buy_text_1) && !empty($event_buy_url_1)) { ?>
                                                            
                                                            <div class="post-buy">
                                                                <a href="<?php echo $event_buy_url_1; ?>" title="<?php echo $event_buy_text_1; ?>" target="_blank">
                                                                    <?php echo $event_buy_text_1; ?>
                                                                </a>
                                                            </div>
                                                            
                                                        <?php } ?>
                                                        
                                                        <?php if (!empty($event_buy_text_2) && !empty($event_buy_url_2)) { ?>
                                                            
                                                            <div class="post-buy">
                                                                <a href="<?php echo $event_buy_url_2; ?>" title="<?php echo $event_buy_text_2; ?>" target="_blank">
                                                                    <?php echo $event_buy_text_2; ?>
                                                                </a>
                                                            </div>
                                                            
                                                        <?php } ?>
                                                        
                                                    </div><!-- END // post-footer -->
                                                
                                                <?php } ?>
                                                
                                                <?php
                                                    if (function_exists('zilla_likes')) {
                                                    ?>
                                                        
                                                        <div class="post-likes">
                                                            <?php zilla_likes(); ?>
                                                        </div><!-- END // post-likes -->
                                                        
                                                    <?php
                                                    }
                                                ?>
                                            
                                            </div><!-- END // post-content -->
                                            
                                        </article>
                                    
                                    <?php
                                    $event_count++;
                                } // while
                            } // if
                            wp_reset_query();
                        ?>
            
                    </div><!-- END // grid-event-home -->
                    
                <?php
                } // if
            ?>
    
        </div><!-- END // canvas-container -->
    
    </div><!-- END // canvas-home -->
    
<?php
get_footer();