<?php

/*

@name 			Subpages Widget
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Widget Subpages
====================================================================================================
*/

class gp_Widget_Subpages extends WP_Widget {

	function __construct() {
		
		$widget_options = array(
			'classname'								=> 'widget_subpages',
			'description'							=> __('Widget that displays the sub-pages of the current page. Widget only appears if there are sub-pages of the current page.', 'gp')
		);
		
		$control_options = array(
			'width'									=> 400,
			'id_base'								=> 'widget_subpages'
		);
		
		$this->WP_Widget('widget_subpages', __('Linguini: Subpages', 'gp'), $widget_options, $control_options);

	}
	
	function widget($sidebar, $instance) {
		
		extract($sidebar);
		
		if (!is_page()) {
			return;
		}

		$post = get_queried_object();

		if (0 >= $post->post_parent) {
			$children = wp_list_pages(array('child_of' => get_queried_object_id(), 'echo' => false, 'title_li' => false));
		} else if ($post->ancestors) {
			$ancestors = $post->ancestors;
			$ancestors = end($ancestors);
			$children = wp_list_pages(array('child_of' => $ancestors, 'title_li' => false, 'echo' => false));
		}

		if (empty($children)) {
			return;
		}

		echo $before_widget;

		if (!empty($instance['widget_title'])) {
			echo $before_title . apply_filters('widget_title', $instance[__('widget_title')], $instance, $this->id_base) . $after_title;
		}

		echo '<ul class="xoxo">' . $children . '</ul>';

		echo $after_widget;
		
	}
	
	function update($new_instance, $old_instance) {
		
		$instance 									= $old_instance;
		$instance									= $new_instance;

		$instance['title']							= strip_tags($new_instance['title']);

		return $instance;
		
	}
	
	function form($instance) {
		
		$defaults = array(
			'widget_title'							=> __('Sub Pages', 'gp')
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