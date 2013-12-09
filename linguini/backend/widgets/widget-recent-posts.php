<?php

/*

@name 			Recent Posts Widget
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Widget Recent Posts
====================================================================================================
*/

class gp_Widget_Recent_Posts extends WP_Widget {
	
	function __construct() {
		
		$widget_options = array(
			'classname'								=> 'widget_recent_posts',
			'description'							=> __('Widget that displays recent posts.', 'gp')
		);
		
		$control_options = array(
			'id_base'								=> 'widget_recent_posts'
		);
		
		$this->WP_Widget('widget_recent_posts', __('Linguini: Recent Posts', 'gp'), $widget_options, $control_options);
		
	}
	
	function widget($args, $instance) {
		
		extract($args);
		
		$widget_title								= apply_filters('widget_title', $instance[__('widget_title')]);
		$post_number								= $instance['post_number'];
		
		echo $before_widget;
		
		if ($widget_title) {
			echo $before_title . $widget_title . $after_title;
		}

		$gp_query_args = array(
			'ignore_sticky_posts'	=> 1,
			'posts_per_page'		=> $post_number
		);
		query_posts($gp_query_args);

        if (have_posts()) {
            while (have_posts()) {
                the_post();
		?>
			
			<div class="post">
            
            	<div class="post-date">
					<?php the_time(); ?>
				</div><!-- END // post-date -->
                
                <h5 class="post-title">
                	<a class="underline" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_title(); ?>
                    </a>
				</h5><!-- END // post-title -->
                
                <div class="post-excerpt">
                
                    <?php the_excerpt(); ?>
                    
                </div><!-- END // post-excerpt -->
                
            </div><!-- END // recent-post -->
				
		<?php
			} // while
		} // if
		wp_reset_query();
	
		echo $after_widget;
		
	}
	
	function update($new_instance, $old_instance) {
		
		$instance									= $old_instance;
		$instance									= $new_instance;
		
		$instance['widget_title']					= strip_tags($new_instance['widget_title']);
		$instance['post_number']					= strip_tags($new_instance['post_number']);
		
		return $instance;
		
	}
	
	function form($instance) {
		
		$defaults = array(
			'widget_title'							=> __('Recent Posts', 'gp'),
			'post_number'							=> '3'
		);
		
		$instance									= wp_parse_args((array) $instance, $defaults);
		 
		$widget_title								= isset($instance['widget_title']) ? esc_attr($instance['widget_title']) : '';
		$post_number								= isset($instance['post_number']) ? esc_attr($instance['post_number']) : '';
		
		?>

            <p>
            
                <label for="<?php echo $this->get_field_id('widget_title'); ?>">
					<?php _e('Title', 'gp'); ?>
				</label>
                
                <input type="text" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" value="<?php echo $widget_title; ?>" />
                
            </p>
    
            <p>
            
                <label for="<?php echo $this->get_field_id('post_number'); ?>">
					<?php _e('Number of Posts', 'gp'); ?>
                </label> 
                
                <input type="text" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo $post_number; ?>" />
                
            </p>
        
		<?php
		
	}
	
}