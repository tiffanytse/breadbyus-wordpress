<?php

/*

@name			Title Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/ 

?>

<header class="page-header">
    
    <h1>
		<?php
            if (is_home()) {
                
                bloginfo('name');
                
            } else if (is_category()) {
                
                single_cat_title();
                
            } else if (is_single()) {
                
                single_post_title();
                
            } else if (is_page()) {
                
                single_post_title();
                
            } else if (is_tax()) {
                
                single_term_title() . 'hovno';
                
            } else {
                
                wp_title('', true);
                
            }
        ?>
    	
        <?php
            if (current_user_can('edit_post', $post->ID) && !is_tax()) {
                
                edit_post_link(__('[edit]', 'gp'), '<span class="edit-post-link">', '</span>');
                 
            }
		?>    
    </h1>
    
</header><!-- END // page-header -->