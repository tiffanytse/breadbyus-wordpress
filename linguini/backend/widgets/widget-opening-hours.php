<?php

/*

@name 			Opening Hours Widget
@package		GPanel WordPress Framework
@since			3.0.3
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Widget Opening Hours
====================================================================================================
*/

class gp_Widget_Opening_Hours extends WP_Widget {

	function __construct() {
		
		$widget_options = array(
			'classname'								=> 'widget_opening_hours',
			'description'							=> __('Widget that displays opening hours.', 'gp')
		);
		
		$control_options = array(
			'id_base'								=> 'widget_opening_hours'
		);
		
		$this->WP_Widget('widget_opening_hours', __('Linguini: Opening Hours', 'gp'), $widget_options, $control_options);

	}
	
	function widget($args, $instance) {
		
		extract($args);
		
		$widget_title 								= apply_filters('widget_title', $instance[__('widget_title')]);
		$widget_content 							= '<div class="widget-content clearfix">' . do_shortcode($instance[__('widget_content')]) . '</div>';
		
		echo $before_widget;
		
		if ($widget_title) {
			echo $before_title . $widget_title . $after_title;
        }
        
        if ($widget_content) {
			printf(__('%1$s', 'gp'), $widget_content);
        }
        
		if (!empty($instance['monday'])) {
        ?>
			<div class="day float-left"><strong class="float-left"><?php _e('Monday', 'gp'); ?></strong> <span class="float-right"><?php echo $instance['monday'] ?></span></div>
        <?php
        }
        
		if (!empty($instance['tuesday'])) {
        ?>
			<div class="day float-left"><strong class="float-left"><?php _e('Tuesday', 'gp'); ?></strong> <span class="float-right"><?php echo $instance['tuesday'] ?></span></div>
        <?php
        }
        
		if (!empty($instance['wednesday'])) {
        ?>
			<div class="day float-left"><strong class="float-left"><?php _e('Wednesday', 'gp'); ?></strong> <span class="float-right"><?php echo $instance['wednesday'] ?></span></div>
        <?php
        }
        
		if (!empty($instance['thursday'])) {
        ?>
			<div class="day float-left"><strong class="float-left"><?php _e('Thursday', 'gp'); ?></strong> <span class="float-right"><?php echo $instance['thursday'] ?></span></div>
        <?php
        }
        
		if (!empty($instance['friday'])) {
        ?>
			<div class="day float-left"><strong class="float-left"><?php _e('Friday', 'gp'); ?></strong> <span class="float-right"><?php echo $instance['friday'] ?></span></div>
        <?php
        }
        
		if (!empty($instance['saturday'])) {
        ?>
			<div class="day float-left"><strong class="float-left"><?php _e('Saturday', 'gp'); ?></strong> <span class="float-right"><?php echo $instance['saturday'] ?></span></div>
        <?php
        }
        
		if (!empty($instance['sunday'])) {
        ?>
			<div class="day float-left last"><strong class="float-left"><?php _e('Sunday', 'gp'); ?></strong> <span class="float-right"><?php echo $instance['sunday'] ?></span></div>
        <?php
        }
        
		echo $after_widget;
		
	}
	
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		
		$instance['widget_title']     = $new_instance['widget_title'];
		$instance['widget_content']   = $new_instance['widget_content'];
		$instance['monday']           = $new_instance['monday'];
		$instance['tuesday']          = $new_instance['tuesday'];
		$instance['wednesday']        = $new_instance['wednesday'];
		$instance['thursday']         = $new_instance['thursday'];
		$instance['friday']           = $new_instance['friday'];
		$instance['saturday']         = $new_instance['saturday'];
		$instance['sunday']           = $new_instance['sunday'];
		
		return $instance;
		
	}

	function form($instance) {
		
		$defaults = array(
			'widget_title'   => __('Opening hours', 'gp'),
			'monday'         => '12:00 - 24:00',
			'tuesday'        => '12:00 - 24:00',
			'wednesday'      => '12:00 - 24:00',
			'thursday'       => '12:00 - 24:00',
			'friday'         => '12:00 - 24:00',
			'saturday'       => '12:00 - 24:00',
			'sunday'         => '12:00 - 24:00',
		);
		
		$instance = wp_parse_args((array) $instance, $defaults);
		 
		$widget_title     = isset($instance['widget_title']) ? esc_attr($instance['widget_title']) : '';
		$widget_content   = isset($instance['widget_content']) ? esc_attr($instance['widget_content']) : '';
		$monday           = isset($instance['monday']) ? esc_attr($instance['monday']) : '';
		$tuesday          = isset($instance['tuesday']) ? esc_attr($instance['tuesday']) : '';
		$wednesday        = isset($instance['wednesday']) ? esc_attr($instance['wednesday']) : '';
		$thursday         = isset($instance['thursday']) ? esc_attr($instance['thursday']) : '';
		$friday           = isset($instance['friday']) ? esc_attr($instance['friday']) : '';
		$saturday         = isset($instance['saturday']) ? esc_attr($instance['saturday']) : '';
		$sunday           = isset($instance['sunday']) ? esc_attr($instance['sunday']) : '';
		
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
                
                <label for="<?php echo $this->get_field_id('monday'); ?>">
                    <?php _e('Monday\'s time', 'gp'); ?>
                </label>
                
                <input type="text" id="<?php echo $this->get_field_id('monday'); ?>" name="<?php echo $this->get_field_name('monday'); ?>" value="<?php echo $monday; ?>" />
                
            </p>
            
            <p>
                
                <label for="<?php echo $this->get_field_id('tuesday'); ?>">
                    <?php _e('Tuesday\'s time', 'gp'); ?>
                </label>
                
                <input type="text" id="<?php echo $this->get_field_id('tuesday'); ?>" name="<?php echo $this->get_field_name('tuesday'); ?>" value="<?php echo $tuesday; ?>" />
            
            </p>
            
            <p>
                
                <label for="<?php echo $this->get_field_id('wednesday'); ?>">
                    <?php _e('Wednesday\'s time', 'gp'); ?>
                </label>
                
                <input type="text" id="<?php echo $this->get_field_id('wednesday'); ?>" name="<?php echo $this->get_field_name('wednesday'); ?>" value="<?php echo $wednesday; ?>" />
            
            </p>
            
            <p>
                
                <label for="<?php echo $this->get_field_id('thursday'); ?>">
                    <?php _e('Thursday\'s time', 'gp'); ?>
                </label>
                
                <input type="text" id="<?php echo $this->get_field_id('thursday'); ?>" name="<?php echo $this->get_field_name('thursday'); ?>" value="<?php echo $thursday; ?>" />
            
            </p>
            
            <p>
                
                <label for="<?php echo $this->get_field_id('friday'); ?>">
                    <?php _e('Friday\'s time', 'gp'); ?>
                </label>
                
                <input type="text" id="<?php echo $this->get_field_id('friday'); ?>" name="<?php echo $this->get_field_name('friday'); ?>" value="<?php echo $friday; ?>" />
            
            </p>
            
            <p>
                
                <label for="<?php echo $this->get_field_id('saturday'); ?>">
                    <?php _e('Saturday\'s time', 'gp'); ?>
                </label>
                
                <input type="text" id="<?php echo $this->get_field_id('saturday'); ?>" name="<?php echo $this->get_field_name('saturday'); ?>" value="<?php echo $saturday; ?>" />
            
            </p>
            
            <p>
                
                <label for="<?php echo $this->get_field_id('sunday'); ?>">
                    <?php _e('Sunday\'s time', 'gp'); ?>
                </label>
                
                <input type="text" id="<?php echo $this->get_field_id('sunday'); ?>" name="<?php echo $this->get_field_name('sunday'); ?>" value="<?php echo $sunday; ?>" />
            
            </p>
	
    	<?php
	}
}