<?php

/*

@name			Loop Menu All Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

global $menutype, $posttype, $taxonomy;

// Sidebar
if (gp_option('gp_menus_sidebar')) {
	
	$sidebar		= gp_option('gp_menus_sidebar');
		
} else {
	
	$sidebar		= 'left';
	
}

// View Type
if (gp_option('gp_menus_view') == 'grid') {
	
	$view_type		= 'grid';
	$block_class	= 'grid-menu-all grid-menu grid';
	
} else {
	
	$view_type		= 'list';
	$block_class	= 'list-menu-all list-menu list';
	
}
	
// Content & Grid Classes
if (is_active_sidebar('widget-area-' . $posttype)) {
	
	$content_class	= 'content-' . $posttype . ' content-sidebar content-sidebar-' . $sidebar;
	$grid_class		= 'grid-tiles-sidebar';
	
} else {
	
	$content_class	= 'content-' . $posttype . ' content';
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

        <?php if ($sidebar == 'left' && is_active_sidebar('widget-area-' . $posttype)) { ?>
        
            <div class="sidebar-<?php echo $posttype; ?> sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">

                <?php
                    if (is_active_sidebar('widget-area-'. $posttype)) {
                        get_sidebar($posttype);
                    }
                ?>
                
            </div><!-- END // sidebar -->
        
        <?php } ?>
        
        <div class="<?php echo $content_class; ?>" role="main">
            
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
                        } 
                    } 
                }
                wp_reset_query();
            ?>
            
            <div class="<?php echo $block_class; ?>">

                <?php
                    global $post;
                    
                    // Counter
                    $term_count = 1;
                    
                    // Get Terms
                    $gp_terms_args = array(
                        'orderby'             => 'none',
                        'order'               => 'ASC',
                        'hide_empty'          => 1,
                        'parent'              => 0
                    );
                    $terms = get_terms($taxonomy, $gp_terms_args);

                    if ($terms) {
                        foreach ($terms as $term) {
                            
                            // Counter
                            $post_count = 1;
                            
                            // Query
                            $gp_query_args = array(
                                'post_type'             => $posttype,
                                'taxonomy'			    => $taxonomy,
                                'term'                  => $term->slug,
                                'post_status'           => 'publish',
                                'orderby'			    => 'date',
                                'order'				    => 'ASC',
                                'ignore_sticky_posts'   => 1,
                                'paged'                 => $paged,
                                'posts_per_page'        => -1
                            );
                            query_posts($gp_query_args);
                            ?>
                        
                                <div class="term-block term-no-<?php echo $term_count; ?>">
                                    
                                    <div class="term-header">
                                    
                                        <h2 class="<?php if ($view_type == 'grid' && is_active_sidebar('widget-area-' . $posttype)) { ?>align-left<?php } ?>"><?php single_term_title(); ?></h2>
                                        
                                        <?php if (!empty($term->description)) { ?>
                                            
                                            <div class="term-description<?php if ($view_type == 'grid' && is_active_sidebar('widget-area-' . $posttype)) { ?> align-left<?php } ?>">
                                                <?php echo $term->description; ?>
                                            </div>
                                            
                                        <?php } ?>
                                    
                                    </div><!-- END // term-header -->
                                    
                                    <?php if ($view_type == 'grid') { ?>
                                    
                                    <div class="<?php echo $grid_class; ?>">
                                    
                                    <?php } ?>
                                
                                    <?php
                                        // Loop
                                        if (have_posts()) {
                                            while (have_posts()) {
                                                the_post();
                                                
                                                // If Thumbnail
                                                if (has_post_thumbnail()) {
                                                    $has_thumbnail = 'has-post-thumbnail';
                                                } else {
                                                    $has_thumbnail = 'no-post-thumbnail';
                                                }
                                                
                                                if ($view_type == 'grid') {
                                                    $post_class = array('tile', 'post', 'post-' . $post_count, $has_thumbnail, 'corner', 'align-center');
                                                } else {
                                                    $post_class = array('post', 'post-' . $post_count, $has_thumbnail, 'clearfix');
                                                }
                                                
                                                // Variables
                                                $description        = __(gp_meta('gp_menu_' . $menutype . '_description'));
                                                $prices             = gp_meta('gp_menu_' . $menutype . '_price');
                                                $ingredients        = gp_meta('gp_menu_' . $menutype . '_ingredients');
                                                
                                                // Clean Prices
                                                if ($prices) {
                                                    foreach ($prices as $price => $item) {
                                                        if (preg_replace('/\s/', '', $item) === '') {
                                                            unset($prices[$price]);
                                                        }
                                                    }
                                                }
                                                
                                                // Clean Ingredients
                                                if ($ingredients) {
                                                    foreach ($ingredients as $ingredient => $item) {
                                                        if (preg_replace('/\s/', '', $item) === '') {
                                                            unset($ingredients[$ingredient]);
                                                        }
                                                    }
                                                }
                                                
                                                // Single Page
                                                if (gp_meta('gp_menu_' . $menutype . '_single') != '0') {
                                                    $single = 'true';
                                                } else {
                                                    $single = 'false';
                                                }
                                                
                                                // Original Image for Lightbox
                                                $original_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                                ?>
                                            
                                                    <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                                                        
                                                        <?php if ($view_type == 'grid') { ?>
                                                            
                                                            <div class="tile-block">
                                                            
                                                                <?php if (has_post_thumbnail()) { ?>
                        
                                                                    <div class="post-image overlay">
                                                                    
                                                                        <?php if ($single != 'false') { ?>
                                                                    
                                                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                                                <?php the_post_thumbnail('small'); ?>
                                                                                <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                                            </a>
                                                                        
                                                                        <?php } else { ?>
                                                                            
                                                                            <a data-gallery="gallery" class="lightbox" href="<?php echo $original_image_url[0]; ?>" title="<?php the_title_attribute(); ?>">
                                                                                <?php the_post_thumbnail('small'); ?>
                                                                                <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                                            </a>
                                                                            
                                                                        <?php } ?>
                                                                        
                                                                    </div><!-- END // post-image -->
                                                                    
                                                                <?php } ?>
                                                                
                                                                <div class="post-content">
                                                                
                                                                    <h3 class="post-header">
                                                                        
                                                                        <?php if ($single != 'false') { ?>
                                                                        
                                                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                                <?php the_title(); ?>
                                                                            </a>
                                                                            
                                                                        <?php } else { ?>
                                                                        
                                                                            <?php the_title(); ?>
                                                                        
                                                                        <?php } ?>
                                                                        
                                                                    </h3><!-- END // post-header -->
                                                                    
                                                                    <?php if (!empty($description)) { ?>
                                                                    
                                                                        <div class="post-description description one-entire clearfix">
                                                                            
                                                                            <?php echo stripslashes($description); ?>
                                                                            
                                                                        </div><!-- END // description -->
                                                                        
                                                                    <?php } ?>
                    
                                                                    <?php
                                                                        if (!empty($ingredients)) {
                                                                        ?>
                                                                            
                                                                            <div class="post-description ingredients one-entire clearfix">
                                                                                
                                                                                <?php echo implode(', ', $ingredients); ?>
                                                                                
                                                                            </div><!-- END // ingredients -->
                                                                            
                                                                        <?php
                                                                        }
                                                                    ?>
                                                                    
                                                                    <?php
                                                                        if (!empty($prices)) {
                                                                        ?>
                                                                            
                                                                            <ul class="post-price align-center one-entire clearfix">
                                                                                
                                                                                <?php
                                                                                    foreach ($prices as $price) {
                                                                                    ?>
                                                                                            
                                                                                        <li class="price">
                                                                                            <?php echo $price; ?>
                                                                                        </li><!-- END // price -->
                                                                                            
                                                                                    <?php
                                                                                    }
                                                                                ?>
                                                                                
                                                                            </ul><!-- END // post-price -->
                                                                            
                                                                        <?php
                                                                        }
                                                                    ?>
                                                                    
                                                                    <?php if (function_exists('zilla_likes')) { ?>
                                                                            
                                                                        <div class="post-likes">
                                                                            
                                                                            <?php zilla_likes(); ?>
                                                                            
                                                                        </div>
                                                                        
                                                                    <?php } ?>
                                                                
                                                                </div><!-- END // post-content -->
                                                            
                                                            </div><!-- END // tile-block -->
                                                            
                                                        <?php } else { ?>
                                                        
                                                            <?php if (has_post_thumbnail()) { ?>
                    
                                                                <div class="post-image overlay one-sixth">
                                                                
                                                                    <?php if ($single != 'false') { ?>
                                                                
                                                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                                            <?php the_post_thumbnail('small-fixed'); ?>
                                                                            <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                                        </a>
                                                                    
                                                                    <?php } else { ?>
                                                                        
                                                                        <a data-gallery="gallery" class="lightbox" href="<?php echo $original_image_url[0]; ?>" title="<?php the_title_attribute(); ?>">
                                                                            <?php the_post_thumbnail('small-fixed'); ?>
                                                                            <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                                        </a>
                                                                        
                                                                    <?php } ?>
                                                                    
                                                                </div><!-- END // post-image -->
                    
                                                            <?php } ?>
                                                            
                                                            <?php
                                                                if (has_post_thumbnail()) {
                                                                    $post_block_class = 'four-sixth';
                                                                } else if (!empty($prices) || function_exists('zilla_likes')) {
                                                                    $post_block_class = 'five-sixth';
                                                                } else {
                                                                    $post_block_class = 'one-entire';
                                                                }
                                                            ?>
                                                            <div class="post-block <?php echo $post_block_class; ?>">
                                                        
                                                                <h3 class="post-header">
                                                                    
                                                                    <?php if ($single != 'false') { ?>
                                                                    
                                                                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                            <?php the_title(); ?>
                                                                        </a>
                                                                        
                                                                    <?php } else { ?>
                                                                    
                                                                        <?php the_title(); ?>
                                                                    
                                                                    <?php } ?>
                                                                    
                                                                </h3><!-- END // post-header -->
                
                                                                <?php if (!empty($description)) { ?>
                                                                    
                                                                    <div class="post-description description one-entire">
                                                                        
                                                                        <?php echo stripslashes($description); ?>
                                                                        
                                                                    </div><!-- END // description -->
                                                                    
                                                                <?php } ?>
                
                                                                <?php
                                                                    if (!empty($ingredients)) {
                                                                    ?>
                                                                        
                                                                        <div class="post-description ingredients one-entire">
                                                                            
                                                                            <?php echo implode(', ', $ingredients); ?>
                                                                            
                                                                        </div><!-- END // ingredients -->
                                                                        
                                                                    <?php
                                                                    }
                                                                ?>
                                                                    
                                                            </div><!-- END // post-block -->
                                                            
                                                            <?php
                                                                if (!empty($prices) || function_exists('zilla_likes')) {
                                                                ?>
                                                            
                                                                    <div class="post-block one-sixth">
                    
                                                                        <?php
                                                                            if (!empty($prices)) {
                                                                            ?>
                                                                                
                                                                                <ul class="post-price align-right float-right">
                                                                                    
                                                                                    <?php
                                                                                        foreach ($prices as $price) {
                                                                                        ?>
                                                                                                
                                                                                            <li class="price corner float-right">
                                                                                                <?php echo $price; ?>
                                                                                            </li><!-- END // price -->
                                                                                                
                                                                                        <?php
                                                                                        }
                                                                                    ?>
                                                                                    
                                                                                </ul><!-- END // post-price -->
                                                                                
                                                                            <?php
                                                                            }
                                                                        ?>
                                                                        
                                                                        <?php if (function_exists('zilla_likes')) { ?>
                                                                            
                                                                            <div class="post-likes align-right float-right">
                                                                                
                                                                                <?php zilla_likes(); ?>
                                                                                
                                                                            </div>
                                                                            
                                                                        <?php } ?>
                                                                        
                                                                    </div><!-- END // post-block -->
                                                            
                                                                <?php
                                                                } //if
                                                            ?>
                                                            
                                                        <?php } ?>
                        
                                                    </article><!-- END // post -->
                
                                                <?php
                                            $post_count++;
                                            $term_count++;
                                            } //while
                                        } else {
                                        ?>
                
                                            <div class="page-content align-center">
                            
                                                <p><?php printf(__('No %1$s items were found.', 'gp'), $menutype); ?></p>
                                                
                                            </div><!-- END // page-content -->
                
                                        <?php 
                                    } //if
                                    ?>
                                    
                                    <?php if ($view_type == 'grid') { ?>
                                    
                                    </div><!-- END // grid-tiles -->
                                    
                                    <?php } ?>
                                 
                                </div><!-- END // term-block -->
                                          
                            <?php
                        } //foreach
                    } //if
                    wp_reset_query();
                ?>
                
            </div><!-- END // grid -->
            
        </div><!-- END // content -->
        
        <?php if ($sidebar == 'right' && is_active_sidebar('widget-area-'. $posttype)) { ?>
        
            <div class="sidebar-<?php echo $posttype; ?> sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">

                <?php
                    if (is_active_sidebar('widget-area-'. $posttype)) {
                        get_sidebar($posttype);
                    }
                ?>
                
            </div><!-- END // sidebar -->
        
        <?php } ?>
        
	<?php
        if ($view_type == 'grid') {
            gp_end('div', array('canvas', 'canvas-full'), false);
        } else {
            gp_end('div', 'canvas');
        }
    ?>

<?php
get_footer();