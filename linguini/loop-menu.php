<?php

/*

@name			Loop Menu Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

global $menutype, $posttype, $taxonomy;

// Content & Grid Classes
$content_class      = 'content';

get_header();
?>

	<?php get_template_part('title'); ?>

    <?php gp_start('div', 'canvas'); ?>

        <div class="content-menu <?php echo $content_class; ?>" role="main">

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
            
            <div class="navigation-terms grid-tiles-narrow grid-merge">
                            
                <?php
                    // Counter
                    $term_count = 0;
                    
                    // Get Terms
                    $gp_terms_args = array(
                        'orderby'             => 'none',
                        'order'               => 'ASC',
                        'hide_empty'          => 0,
                        'parent'              => 0
                    );
                    $terms = get_terms($taxonomy, $gp_terms_args);

                    if ($terms) {
                        foreach ($terms as $term) {
                            
                            $term_id = $term->term_id;
                            $term_class = 'tile term term-' . $term->slug . ' number-' . $term_count;
                            $term_image = gp_get_taxonomy_image_src($term, 'small-fixed');
                            ?>

                                <div class="<?php echo $term_class; ?>">
                                
                                    <div class="tile-block">
                                
                                    <?php if ($term_image['src']) { ?>
                                
                                        <div class="term-image overlay">
                                
                                            <a href="<?php echo get_term_link($term->slug, $taxonomy); ?>" title="<?php echo __($term->name); ?>">
                                                
                                                <img src="<?php echo $term_image['src']; ?>" alt="<?php echo __($term->name); ?>" />
                                                <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                
                                            </a>
                                        
                                        </div>
                                        
                                        <h2 class="term-header align-center">
                                            <a href="<?php echo get_term_link($term->slug, $taxonomy); ?>" title="<?php echo __($term->name); ?>">
                                                <?php echo __($term->name); ?>
                                            </a>
                                        </h2>
                                    
                                    <?php } else { ?>

                                        <h2 class="term-header term-header-blank align-center">
                                            <a href="<?php echo get_term_link($term->slug, $taxonomy); ?>" title="<?php echo __($term->name); ?>">
                                                <?php echo __($term->name); ?>
                                            </a>
                                        </h2>
                                    
                                    <?php } ?>

                                    <?php
                                        // Children
                                        // Count
                                        $children_count = 1;
                                        
                                        $gp_children_args = array(
                                            'orderby'             => 'name',
                                            'order'               => 'ASC',
                                            'child_of'            => $term_id,
                                            'parent'              => $term_id,
                                            'hide_empty'          => 0
                                        );
                                        $children = get_terms($taxonomy, $gp_children_args);
                                        
                                        if ($children) {
                                        ?>
                                            
                                            <ul class="children align-center">  
                                            
                                                <?php
                                                    foreach ($children as $child) {
                                                        
                                                        $child_id = $child->term_id;
                                                        $child_class = 'term-child term-child-' . $child->slug . ' one-entire term-id-' . $term_id;
                                                        ?>

                                                            <li class="<?php echo $child_class; ?>">
                                                                
                                                                <a href="<?php echo get_term_link($child->slug, $taxonomy); ?>" title="<?php echo __($child->name); ?>">
                                                                    <?php echo __($child->name); ?>
                                                                </a>
                                                                
                                                                <?php
                                                                    $gp_children_children_args = array(
                                                                        'orderby'             => 'name',
                                                                        'order'               => 'ASC',
                                                                        'child_of'            => $child_id,
                                                                        'parent'              => $child_id,
                                                                        'hide_empty'          => 0
                                                                    );
                                                                    $children_children = get_terms($taxonomy, $gp_children_children_args);
                                                                    
                                                                    if ($children_children) {
                                                                    ?>
                                                                        
                                                                        <ul class="children">
                                                                        
                                                                            <?php
                                                                                foreach ($children_children as $child_child) {
                                                                                ?>
                                                                    
                                                                                    <li class="<?php echo $child_class; ?>">
                                                                                        <a href="<?php echo get_term_link($child_child->slug, $taxonomy); ?>" title="<?php echo __($child_child->name); ?>">
                                                                                            <?php echo __($child_child->name); ?>
                                                                                        </a>                                                                                    
                                                                                    </li>
                                                                                
                                                                                <?php    
                                                                                $children_count++;
                                                                                } //foreach
                                                                            ?>
                                                                        
                                                                        </ul>
                                                                        
                                                                    <?php
                                                                    } //if
                                                                ?>
                                                                
                                                            </li>
                                                            
                                                        <?php
                                                        $children_count++;
                                                    } //foreach
                                                ?>
                                            
                                            </ul>
                                            
                                        <?php
                                        } //if
                                    ?>
                                    
                                    </div><!-- END // tile-block -->

                                </div><!-- END // tile -->
                                
                            <?php
                            $term_count++;
                        } //foreach
                    } else {
                    ?>
                        
                        <div class="page-content align-center">
                            
                            <p><?php printf(__('No %1$s categories were found.', 'gp'), $menutype); ?></p>
                            
                        </div><!-- END // page-content -->
                        
                    <?php
                    } //if

                ?>

        </div><!-- END // content -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();