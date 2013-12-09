<?php

/*

@name 			Recent Events Widget
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Widget Recent Events
====================================================================================================
*/

class gp_Widget_Recent_Events extends WP_Widget {
	
	function __construct() {
		
		$widget_options = array(
			'classname'								=> 'widget_recent_events',
			'description'							=> __('Widget that displays recent events.', 'gp')
		);
		
		$control_options = array(
			'id_base'								=> 'widget_recent_events'
		);
		
		$this->WP_Widget('widget_recent_events', __('Linguini: Recent Events', 'gp'), $widget_options, $control_options);
		
	}
	
	function widget($args, $instance) {
		
		extract($args);
		
		$widget_title								= apply_filters('widget_title', $instance[__('widget_title')]);
		$post_number								= $instance['post_number'];
		
		echo $before_widget;
		
		if ($widget_title) {
			echo $before_title . $widget_title . $after_title;
		}
		
		//Query
		$gp_query_args = array(
			'post_type'			=> 'event',
			'meta_key'			=> 'gp_event_date',
			'meta_value'		=> date('Y/m/d'),
			'meta_compare'		=> '>=',
			'orderby'			=> 'meta_value',
			'order'				=> 'ASC',
			'posts_per_page'	=> $post_number
		);
		query_posts($gp_query_args);

        if (have_posts()) {
            while (have_posts()) {
                the_post();
				
				$event_venue				= __(gp_meta('gp_event_venue'));
				$event_venue_url			= __(gp_meta('gp_event_location_url'));
				$event_location				= __(gp_meta('gp_event_location'));
		?>
			
			<div class="post event">
            
            	<h4 class="post-date">
					<?php get_template_part('date', 'event'); ?>
				</h4><!-- END // post-date -->
                
                <h5 class="post-title">
                	<a class="underline" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_title(); ?>
                    </a>
				</h5><!-- END // post-title -->
                
                <?php
				if (!empty($event_venue)) {
					if (!empty($event_venue_url)) {
				?>
				
					<div class="post-venue">
						<a class="underline" href="<?php echo $event_venue_url; ?>" title="<?php echo $event_venue; ?>" target="_blank">
							<?php echo $event_venue; ?>
						</a>
					</div><!-- END // post-venue -->
					
					<?php
					} else {
					?>
					
					<div class="post-venue">
						<?php echo $event_venue; ?>
					</div><!-- END // post-venue -->
					
				<?php
					}
				}
				?>
				
				<?php if (!empty($event_location)) { ?>
					<div class="post-location">
						<?php echo $event_location; ?>
					</div><!-- END // post-location -->
				<?php } ?>
                
            </div><!-- END // recent-event -->
				
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
			'widget_title'							=> __('Recent Events', 'gp'),
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
					<?php _e('Number of Events', 'gp'); ?>
                </label> 
                
                <input type="text" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo $post_number; ?>" />
                
            </p>
        
		<?php
		
	}
	
}