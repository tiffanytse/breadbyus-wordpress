<?php

/*

@name 			Tweets Widget
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Widget Tweets
====================================================================================================
*/

class gp_Widget_Tweets extends WP_Widget {
    
	function gp_Widget_Tweets() {

		$widget_options = array(
			'classname'								=> 'widget_tweets',
			'description'							=> __('Widget that displays latest tweets from the Twitter account. Required settings of connection to Twitter API in Appearance > Theme Options > Socials.', 'gp')
		);
		
		$control_options = array(
			'id_base'								=> 'widget_tweets'
		);

		$this->WP_Widget('widget_tweets', __('Linguini: Tweets', 'gp'), $widget_options, $control_options);

	}

	function widget($args, $instance) {
		
		extract($args);
        
        $widget_title             = apply_filters('widget_title', $instance[__('widget_title')]);

		$twitter_username         = $instance['twitter_username'];
		$twitter_tweets           = $instance['twitter_tweets'];
		$twitter_button_show      = $instance['twitter_button_show'];
		$twitter_button_text      = $instance[__('twitter_button_text')];
		
		echo $before_widget;
		
		if (!empty($widget_title)) {
			
			echo $before_title . $widget_title . $after_title;
			
		}
        
        // Get Tweets
        $tweets = gp_tweets($twitter_tweets, $twitter_username);
        ?>
        
            <ul id="tweets">
            
                <?php
                if (is_array($tweets)) {
                    foreach($tweets as $tweet) {
                        
                        // Variables
                        $tweet_text = gp_tweet_links(is_object($tweet) ? $tweet->text : $tweet['text']);
                        $tweet_id_str = is_object($tweet) ? $tweet->id_str : $tweet['id_str'];
                        $tweet_created_at = is_object($tweet) ? $tweet->created_at : $tweet['created_at'];
                        
                        $tweet_time = date_parse($tweet_created_at);
                        $tweet_utime = mktime($tweet_time['hour'], $tweet_time['minute'], $tweet_time['second'], $tweet_time['month'], $tweet_time['day'], $tweet_time['year']);
                        ?>
                        
                        <li>
                            <p>
                                <span class="tweet-text"><?php echo $tweet_text; ?></span>
                                <span class="tweet-time">
                                    <a href="http://twitter.com/<?php echo $twitter_username; ?>/status/<?php echo $tweet_id_str; ?>" target="_blank">
                                        <?php echo human_time_diff($tweet_utime, current_time('timestamp', $gmt = get_option('gmt_offset'))); ?> <?php _e('ago', 'gp'); ?>
                                    </a>
                                </span>
                            </p>
                        </li>
                        
                        <?php
                    }
                }
                ?>
                
            </ul>
        
        <?php
        
        // Button
        if ($twitter_button_show && $twitter_button_text) {
        
			echo '<div class="button"><a href="' . esc_url('http://twitter.com/' . $twitter_username) . '" target="_blank">' . esc_html($twitter_button_text) . '</a></div>';
			
		}

		echo $after_widget;
		
	}
	
	function update($new_instance, $old_instance) {
		
		delete_transient($old_instance['twitter_username'] . '-' . $old_instance['twitter_tweets']);
		
		$instance = $old_instance;

		$instance['widget_title']			= $new_instance['widget_title'];
		$instance['twitter_username']		= $new_instance['twitter_username'];
		$instance['twitter_tweets']			= $new_instance['twitter_tweets'];
		$instance['twitter_button_show']    = $new_instance['twitter_button_show'];
		$instance['twitter_button_text']    = $new_instance['twitter_button_text'];

		return $instance;
		
	}

	function form($instance) {

		$defaults = array(
			'widget_title'					=> __('Latest Tweets', 'gp'),
			'twitter_username'				=> '',
			'twitter_tweets'				=> 3,
			'twitter_button_show'			=> true,
			'twitter_button_text'			=> __('Follow Us on Twitter', 'gp'),
		);
		
		$instance = wp_parse_args((array) $instance, $defaults);
		
		$widget_title						= isset($instance['widget_title']) ? esc_attr($instance['widget_title']) : '';
		$twitter_username					= isset($instance['twitter_username']) ? esc_attr($instance['twitter_username']) : '';
		$twitter_tweets						= isset($instance['twitter_tweets']) ? esc_attr($instance['twitter_tweets']) : '';
		$twitter_button_show		        = isset($instance['twitter_button_show']) ? esc_attr($instance['twitter_button_show']) : '';
		$twitter_button_text		        = isset($instance['twitter_button_text']) ? esc_attr($instance['twitter_button_text']) : '';

	?>

		<p>
            
            <label for="<?php echo $this->get_field_id('widget_title'); ?>">
                <?php _e('Title', 'gp'); ?>
            </label>
            
            <input type="text" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" value="<?php echo $widget_title; ?>" />
            
        </p>

		<p>
            
            <label for="<?php echo $this->get_field_id('twitter_username'); ?>">
                <?php _e('Twitter Username', 'gp'); ?>
            </label>
            
            <input type="text" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo $twitter_username; ?>" />
            
        </p>
        
        <p>
            
            <label for="<?php echo $this->get_field_id('twitter_tweets'); ?>">
                <?php _e('Number of Tweets', 'gp'); ?>
            </label>
            
            <input type="text" id="<?php echo $this->get_field_id('twitter_tweets'); ?>" name="<?php echo $this->get_field_name('twitter_tweets'); ?>" type="text" value="<?php echo $twitter_tweets; ?>" />
            
        </p>
        
        <p>
        
        	<input class="checkbox" type="checkbox" <?php if ($twitter_button_show) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('twitter_button_show'); ?>" name="<?php echo $this->get_field_name('twitter_button_show'); ?>">
            
			<label for="<?php echo $this->get_field_id('twitter_button_show'); ?>">
            	<?php _e('Display Button', 'gp'); ?>
            </label>
            
		</p>
        
        <p>
            
            <label for="<?php echo $this->get_field_id('twitter_button_text'); ?>">
                <?php _e('Button Text', 'gp'); ?>
            </label>
            
            <input type="text" id="<?php echo $this->get_field_id('twitter_button_text'); ?>" name="<?php echo $this->get_field_name('twitter_button_text'); ?>" type="text" value="<?php echo $twitter_button_text; ?>" />
        
        </p>

	<?php
	}

}