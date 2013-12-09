<?php

/*

@name			Loop Menu Single Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

global $menutype, $posttype, $taxonomy;

get_header();
?>

	<?php get_template_part('title'); ?>
	
	<?php gp_start('div', 'canvas'); ?>

        <div class="content single-menu" role="main">

            <?php
                // Loop 
                if (have_posts()) { 
                    while (have_posts()) {
                        the_post();
                            
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
                        } else if (gp_option('gp_menus_single') != 'false') {
                            $single = 'true';
                        } else {
                            $single = 'false';
                        }
                        
                        // Original Image for Lightbox
                        $original_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                        
                        // Post Class
                        $post_class = array('clearfix');
                        ?>
                
                            <article <?php post_class($post_class); ?>>
                            
                                <?php if (has_post_thumbnail()) { ?>
                                
                                    <div class="single-post-image post-image overlay one-half">
                                            
                                        <a data-gallery="gallery" class="lightbox" href="<?php echo $original_image_url[0]; ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                            <span class="overlay-block"><span class="overlay-icon"></span></span>
                                        </a>

                                    </div><!-- END // post-image -->
                                    
                                <?php } ?>
                            
                                <?php
                                    if (has_post_thumbnail()) {
                                        $post_block_class = 'inner-left one-half';
                                    } else {
                                        $post_block_class = 'one-entire';
                                    }
                                ?>
                                <div class="single-post-block post-block <?php echo $post_block_class; ?>">

                                    <?php
                                        if (!empty($prices)) {
                                        ?>
                                            
                                            <ul class="single-post-price post-price">
                                                
                                                <?php
                                                    foreach ($prices as $price) {
                                                    ?>
                                                            
                                                        <li class="single-price price">
                                                            
                                                            <?php echo $price; ?>
                                                            
                                                        </li><!-- END // price -->
                                                            
                                                    <?php
                                                    }
                                                ?>
                                                
                                            </ul><!-- END // post-price -->
                                            
                                        <?php
                                        }
                                    ?>

                                    <?php if (!empty($post->post_content)) { ?>
                                    
                                        <div class="single-post-content post-content">
                                        
                                            <?php the_content(); ?>
                                        
                                        </div><!-- END // post-content -->
                                    
                                    <?php } ?>
                                    
                                    <?php
                                        if (!empty($ingredients)) {
                                        ?>
                                            
                                            <div class="single-post-description post-description">
                                                
                                                <h3><?php _e('Ingredients', 'gp'); ?></h3>
                                                
                                                <div class="ingredients">
                                                    <?php echo implode(', ', $ingredients); ?>
                                                </div>
                                                
                                            </div><!-- END // post-description -->
                                            
                                        <?php
                                        }
                                    ?>
                                    
                                    <?php if (function_exists('gp_share')) { gp_share(); } ?>
                                
                                </div><!-- END // post-block -->
                                
                            </article><!-- END // post -->
                        
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

	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();