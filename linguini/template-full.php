<?php
/*

Template Name:	Full Width	

@name			Full Width Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

get_header();
?>

	<?php get_template_part('title'); ?>
	
	<?php gp_start('div', 'canvas'); ?>

        <div class="content" role="main">

            <?php
                // Loop
                if (have_posts()) { 
                    while (have_posts()) { 
                        the_post();
                        ?>
                    
                        <div class="content-page">
                        
                            <?php the_content(); ?>
                        
                        </div><!-- END // content-page -->
                        
                        <?php
                    } //while
                } //if
                wp_reset_query();
            ?>

        </div><!-- END // content -->

	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();