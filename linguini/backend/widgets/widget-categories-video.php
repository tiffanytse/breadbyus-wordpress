<?php

/*

@name 			Video Categories Widget
@package		GPanel WordPress Framework
@since			3.0.3
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Widget Video Categories
====================================================================================================
*/

class gp_Widget_Categories_Video extends WP_Widget {

	function __construct() {
		
		$widget_options = array(
			'classname'								=> 'widget_categories',
			'description'							=> __('Widget that displays the categories of videos. Widget only appears if there are categories.', 'gp')
		);
		
		$control_options = array(
			'width'									=> 400,
			'id_base'								=> 'widget_categories_video'
		);
		
		$this->WP_Widget('widget_categories_video', __('Linguini: Video Categories', 'gp'), $widget_options, $control_options);

	}
	
	function widget($sidebar, $instance) {
		
		extract($sidebar);
		
		if (get_terms('category-video')) {

            echo $before_widget;
    
            if (!empty($instance['widget_title'])) {
                echo $before_title . apply_filters('widget_title', $instance[__('widget_title')], $instance, $this->id_base) . $after_title;
            }
            ?>
                
                <ul>
                    <?php
                        $gp_categories_args = array(
                            'taxonomy'            => 'category-video',
                            'orderby'             => 'name',
                            'order'               => 'ASC',
                            'show_count'          => 1,
                            'pad_counts'          => 0,
                            'title_li'            => '',
                            'depth'               => 1,
                            'hide_empty'          => 1,
                            'use_desc_for_title'  => 0,
                            'show_option_none'    => ''
                        );
                        wp_list_categories($gp_categories_args);
                    ?>
                </ul>
                
            <?php       
            echo $after_widget;
		
        }
		
	}
	
	function update($new_instance, $old_instance) {
		
		$instance 									= $old_instance;
		$instance									= $new_instance;

		$instance['title']							= strip_tags($new_instance['title']);

		return $instance;
		
	}
	
	function form($instance) {
		
		$defaults = array(
			'widget_title'							=> __('Video Categories', 'gp')
		);
		
		$instance									= wp_parse_args((array) $instance, $defaults);
		 
		$widget_title								= isset($instance['widget_title']) ? esc_attr($instance['widget_title']) : '';
		
		?>

            <p>
                
                <label for="<?php echo $this->get_field_id('widget_title'); ?>">
					<?php _e('Title', 'gp'); ?>
				</label>
                
                <input type="text" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" value="<?php echo $widget_title; ?>" />
                
            </p>
	
    	<?php
		
	}
	
}