<?php

/*

@name			Events Taxonomy Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// View Type
if (gp_option('gp_event_view')) {
	
	$view_type		= gp_option('gp_event_view');
	
} else {
	
	$view_type		= 'grid';
	
}

// Sidebar
if (gp_option('gp_event_sidebar')) {
	
	$sidebar        = gp_option('gp_event_sidebar');
	
} else {
	
	$sidebar        = 'left';
	
}

// Content & Grid Classes
if (get_terms('category-event') || is_active_sidebar('widget-area-event')) {
	
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
	$grid_class		= 'grid-tiles-sidebar';
	
} else {
	
	$content_class	= 'content';
	$grid_class		= 'grid-tiles';
	
}

get_header();
?>

	<?php get_template_part('title'); ?>
    
	<?php
        if ($view_type == 'grid') {
            gp_start('div', array('canvas', 'canvas-full'), false);
        } else {
            gp_start('div', 'canvas');
        }
    ?>

        <?php
            if ($sidebar == 'left') {
                if (get_terms('category-event') || is_active_sidebar('widget-area-event')) {
                    get_sidebar('event');
                }
            }
        ?>
        
        <div class="content-event <?php echo $content_class; ?>" role="main">
            
            <?php
                if (term_description()) {
                ?>
                    
                    <div class="page-content">
                        
                        <?php echo term_description(); ?>
                        
                    </div><!-- END // page-content -->
                    
                <?php
                }
            ?>
            
            <?php if ($view_type == 'grid') { ?>
            
               <div class="grid-event grid-event-upcoming grid-merge clearfix <?php echo $grid_class; ?>">
                
            <?php } else if ($view_type == 'list') { ?>
            
                <div class="list-event list-event-upcoming clearfix">
                        
            <?php } ?>
                
            <?php
                global $post;
                
                // Counter
                $post_count = 1;
                
                // Posts per Page
                if (gp_option('gp_event_per_page')) {
                    $posts_per_page = gp_option('gp_event_per_page');
                } else {
                    $posts_per_page = '-1';
                }
                
                // Get Terms
                $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                $term_slug = is_object($term) ? $term->slug : $term['slug'];

                // Query
                $gp_query_args = array(
                    'post_type'             => $posttype,
                    'taxonomy'			    => $taxonomy,
                    'term'                  => $term_slug,
                    'meta_key'			    => 'gp_event_date',
                    'meta_value'		    => date('Y/m/d'),
                    'meta_compare'		    => '>=',
                    'order'			        => 'ASC',
                    'orderby'			    => 'meta_value',
                    'ignore_sticky_posts'   => 1,
                    'paged'                 => $paged,
                    'posts_per_page'        => $posts_per_page
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
                        
                        // Post Class
                        if ($view_type == 'grid') {

                            if (has_post_thumbnail()) {
                                $post_class = array('tile', 'event-upcoming', 'has-post-thumbnail', 'post', 'post-' . $post_count, 'align-center');
                            } else {
                                $post_class = array('tile', 'event-upcoming', 'post', 'post-' . $post_count, 'align-center');
                            }
                            
                        } else if ($view_type == 'list') {
                            
                            if (has_post_thumbnail()) {
                                $post_class = array('event-upcoming', 'has-post-thumbnail', 'post', 'post-' . $post_count, 'one-entire', $event_info_class, $event_status_class, $event_action_class, 'clearfix');
                            } else {
                                $post_class = array('event-upcoming', 'post', 'post-' . $post_count, 'one-entire', $event_info_class, $event_status_class, $event_action_class, 'clearfix');
                            }
                            
                        }
                        ?>
                        
                            <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                                
                                <?php if ($view_type == 'grid') { ?>
                                
                                    <div class="tile-block">

                                        <?php
                                            if (gp_option('gp_event_thumbnail') != 'false') {
                                                if (has_post_thumbnail()) { 
                                                ?>
                                        
                                                    <div class="post-image transition overlay">
                                                    
                                                        <?php if (gp_option('gp_event_single') != 'false') { ?>
                                                            
                                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                <?php the_post_thumbnail('small'); ?>
                                                                <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                            </a>
                                                            
                                                        <?php } else if (gp_option('gp_event_single') == 'false' || gp_option('gp_event_single') == '' && has_post_thumbnail()) { ?>
                                                            
                                                            <span class="lightbox">
                                                                <a href="<?php echo $original_image_url[0]; ?>" title="<?php the_title_attribute(); ?>">
                                                                    <?php the_post_thumbnail('small'); ?>
                                                                    <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                                </a>
                                                            </span>
                                                            
                                                        <?php } else { ?>
                                                            
                                                            <?php the_post_thumbnail('small'); ?>
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
                                            
                                            <?php if (!empty($event_status)) { ?>
                                            
                                                <div class="post-status float-left align-center clearfix">
                                                    
                                                    <?php echo $event_status; ?>
                                                    
                                                </div><!-- END // post-status -->
                                                
                                            <?php } ?>
                                            
                                            <?php if (!empty($event_buy_text_1) && !empty($event_buy_url_1) || !empty($event_buy_text_2) && !empty($event_buy_url_2)) { ?>
                                            
                                                <div class="post-footer">

                                                    <?php if (!empty($event_buy_text_1) && !empty($event_buy_url_1)) { ?>
                                                        
                                                        <div class="post-buy button float-left align-center clearfix">
                                                            
                                                            <a href="<?php echo $event_buy_url_1; ?>" title="<?php echo $event_buy_text_1; ?>" target="_blank">
                                                                <?php echo $event_buy_text_1; ?>
                                                            </a>
                                                            
                                                        </div>
                                                        
                                                    <?php } ?>
                                                    
                                                    <?php if (!empty($event_buy_text_2) && !empty($event_buy_url_2)) { ?>
                                                        
                                                        <div class="post-buy button float-left align-center clearfix">
                                                            
                                                            <a href="<?php echo $event_buy_url_2; ?>" title="<?php echo $event_buy_text_2; ?>" target="_blank">
                                                                <?php echo $event_buy_text_2; ?>
                                                            </a>
                                                            
                                                        </div>
                                                        
                                                    <?php } ?>
                                                    
                                                </div><!-- END // post-footer -->
                                            
                                            <?php } ?>
                                        
                                        </div><!-- END // post-content -->

                                    </div><!-- END // tile-block -->
                                    
                                <?php } else if ($view_type == 'list') { ?>
                                    
                                    <?php if (gp_option('gp_event_thumbnail') != 'false') { ?>
                                            
                                        <?php if (has_post_thumbnail()) { ?>
                                
                                            <div class="post-image overlay">
                                            
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
                                        
                                        <?php } ?>
                                        
                                    <?php } ?>
                                    
                                    <div class="post-header">
                                        
                                        <div class="inner">
        
                                            <h5 class="post-date">
                                                
                                                <?php get_template_part('date', 'event'); ?>
                                                
                                                <?php if (!empty($event_time)) { ?>
                                                    
                                                    <small class="post-time">
                                                        <?php echo $event_time; ?>                             
                                                    </small><!-- END // post-time -->
                                                    
                                                <?php } ?>
                                                
                                            </h5><!-- END // post-date -->
                                            
                                            <h2 class="post-title">
                                                
                                                <?php if (gp_option('gp_event_single') != 'false') { ?>
                                                    
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                    
                                                <?php } else if (gp_option('gp_event_single') == 'false' || gp_option('gp_event_single') == '' && has_post_thumbnail()) { ?>
                                                    
                                                    <span class="lightbox">
                                                        <a href="<?php echo $original_image_url[0]; ?>" title="<?php the_title_attribute(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </span>
                                                    
                                                <?php } else { ?>
                                                    
                                                    <?php the_title(); ?>
                                                    
                                                <?php } ?>
                                                
                                            </h2><!-- END // post-title -->
                                        
                                        </div><!-- END // inner -->
                                    
                                    </div><!-- END // post-header -->
                                    
                                    <?php if (!empty($event_venue) || !empty($event_location)) { ?>
                                    
                                        <div class="post-info align-center">
                                        
                                            <div class="inner">
                                            
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
                                            
                                            </div><!-- END // inner -->
                                            
                                        </div><!-- END // post-info -->
                                    
                                    <?php } //if ?>
                                    
                                    <?php if (!empty($event_status)) { ?>
                                    
                                        <div class="post-status align-center">
                                        
                                            <div class="inner">
                                            
                                                <p class="no-bottom"><?php echo $event_status; ?></p>
                                            
                                            </div><!-- END // inner -->
                                            
                                        </div><!-- END // post-status -->
                                        
                                    <?php } //if ?>
                                    
                                    <?php if (!empty($event_buy_text_1) && !empty($event_buy_url_1) || !empty($event_buy_text_2) && !empty($event_buy_url_2)) { ?>
                                    
                                        <div class="post-action align-center">
                                        
                                            <div class="inner">
                                        
                                                <?php if (!empty($event_buy_text_1) && !empty($event_buy_url_1)) { ?>
                                                    
                                                    <div class="post-buy button float-left">
                                                        <a href="<?php echo $event_buy_url_1; ?>" title="<?php echo $event_buy_text_1; ?>" target="_blank">
                                                            <?php echo $event_buy_text_1; ?>
                                                        </a>
                                                    </div><!-- END // post-buy -->
                                                    
                                                <?php } ?>
                                                
                                                <?php if (!empty($event_buy_text_2) && !empty($event_buy_url_2)) { ?>
                                                    
                                                    <div class="post-buy button float-left">
                                                        <a href="<?php echo $event_buy_url_2; ?>" title="<?php echo $event_buy_text_2; ?>" target="_blank">
                                                            <?php echo $event_buy_text_2; ?>
                                                        </a>
                                                    </div><!-- END // post-buy -->
                                                    
                                                <?php } ?>
        
                                            </div><!-- END // inner -->
                                                
                                        </div><!-- END // post-action -->
                                    
                                    <?php } //if ?>
                                
                                <?php } //if ?>
                                
                            </article><!-- END // tile -->

                        <?php
                        $post_count++;
                        } //while
                    } else {
                    ?>
                        
                        <div class="page-content">
                        
                            <p>
                                <?php _e('No upcoming events were found.', 'gp'); ?>
                            </p>
                        
                        </div><!-- END // page-content -->

                    <?php 
                    } //if
                ?>
                
            </div><!-- END // grid-event-upcoming / list-event-upcoming -->
            
            <?php
                // Pagination
                if (function_exists('gp_pagination')) { gp_pagination(); }
                
                wp_reset_query();
            ?>
                
        </div><!-- END // content -->
        
        <?php
            if ($sidebar == 'right') {
                if (get_terms('category-event') || is_active_sidebar('widget-area-event')) {
                    get_sidebar('event');
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