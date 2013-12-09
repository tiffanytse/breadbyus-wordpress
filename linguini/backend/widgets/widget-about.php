<?php

/*

@name 			About Widget
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Widget About
====================================================================================================
*/

class gp_Widget_About extends WP_Widget {

	function __construct() {
		
		$widget_options = array(
			'classname'								=> 'widget_about',
			'description'							=> __('Widget that displays information about you.', 'gp')
		);
		
		$control_options = array(
			'width'									=> 400,
			'id_base'								=> 'widget_about'
		);
		
		$this->WP_Widget('widget_about', __('Linguini: About', 'gp'), $widget_options, $control_options);

	}
	
	function widget($args, $instance) {
		
		extract($args);
		
		$widget_title 								= apply_filters('widget_title', $instance[__('widget_title')]);
		$widget_content 							= '<div class="widget-content clearfix">' . do_shortcode($instance[__('widget_content')]) . '</div>';
		$continue_button_text						= $instance[__('continue_button_text')];
		$continue_button_link						= $instance[__('continue_button_link')];
		
		echo $before_widget;
		
		if ($widget_title) {
			echo $before_title . $widget_title . $after_title;
		}
		
		if ($widget_content) {
			printf(__('%1$s', 'gp'), $widget_content);
        }

        if (!empty($instance['continue_button'])) {
		?>
        
            <div class="button-standard button">
            
                <a href="<?php echo $continue_button_link; ?>" title="<?php echo $continue_button_text; ?>">
                    <?php echo $continue_button_text; ?> &rsaquo;
                </a>
                
            </div>
        
		<?php    
		}
		
		echo $after_widget;
		
	}
	
	function update($new_instance, $old_instance) {
		
		$instance 									= $old_instance;
		$instance 									= $new_instance;
		
		$instance['widget_title'] 					= strip_tags($new_instance['widget_title']);
		$instance['widget_content'] 				= $new_instance['widget_content'];
		$instance['continue_button'] 				= $new_instance['continue_button'];
		$instance['continue_button_text'] 			= strip_tags($new_instance['continue_button_text']);
		$instance['continue_button_link'] 			= strip_tags($new_instance['continue_button_link']);
		
		return $instance;
		
	}
	
	function form($instance) {
		
		$defaults = array(
			'widget_title'							=> __('About Us', 'gp'),
			'continue_button_text'					=> __('More about us', 'gp'),
			'continue_button_link'					=> '/'
		);
		
		$instance									= wp_parse_args((array) $instance, $defaults);
		 
		$widget_title								= isset($instance['widget_title']) ? esc_attr($instance['widget_title']) : '';
		$widget_content								= isset($instance['widget_content']) ? esc_attr($instance['widget_content']) : '';
		$continue_button							= isset($instance['continue_button']) ? esc_attr($instance['continue_button']) : '';
		$continue_button_text						= isset($instance['continue_button_text']) ? esc_attr($instance['continue_button_text']) : '';
		$continue_button_link						= isset($instance['continue_button_link']) ? esc_attr($instance['continue_button_link']) : '';
		
		?>

            <p>
                
                <label for="<?php echo $this->get_field_id('widget_title'); ?>">
					<?php _e('Title', 'gp'); ?>
				</label>
                
                <input type="text" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" value="<?php echo $widget_title; ?>" />
                
            </p>
            
            <p>
                
                <label for="<?php echo $this->get_field_id('widget_content'); ?>">
					<?php _e('Content', 'gp'); ?>
				</label>
                
                <textarea id="<?php echo $this->get_field_id('widget_content'); ?>" name="<?php echo $this->get_field_name('widget_content'); ?>"><?php echo $widget_content; ?></textarea>
                
            </p>
            
            <p>
            	
                <input type="checkbox" id="<?php echo $this->get_field_id('continue_button'); ?>" name="<?php echo $this->get_field_name('continue_button'); ?>"<?php if ($continue_button) { ?> checked="checked"<?php } ?> />
                
                <label for="<?php echo $this->get_field_id('continue_button'); ?>">
					<?php _e('Show button?', 'gp'); ?>
				</label>
                
            </p>
            
            <p>
            
                <label for="<?php echo $this->get_field_id('continue_button_text'); ?>">
					<?php _e('Button text', 'gp'); ?>
				</label>
            
                <input type="text" id="<?php echo $this->get_field_id('continue_button_text'); ?>" name="<?php echo $this->get_field_name('continue_button_text'); ?>" value="<?php echo $continue_button_text; ?>" />
            
            </p>
            
            <p>
            
                <label for="<?php echo $this->get_field_id('continue_button_link'); ?>">
					<?php _e('Button URL', 'gp'); ?>
                </label>
                
                <input type="text" id="<?php echo $this->get_field_id('continue_button_link'); ?>" name="<?php echo $this->get_field_name('continue_button_link'); ?>" value="<?php echo $continue_button_link; ?>" />
            
            </p>
	
    	<?php
		
	}
	
}