<?php

/*

@name			Meta Helper
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Get Post Meta Values (gp_meta)
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Shortcode to Display Meta Values
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_meta_shortcode')) {

	function gp_meta_shortcode($atts) {
		
		$atts = wp_parse_args($atts, array(
			'type'    => 'text',
			'post_id' => get_the_ID(),
		));
		
		if (empty($atts['meta_key'])) {
			return '';
		}
	
		$meta = gp_meta($atts['meta_key'], $atts, $atts['post_id']);
	
		if ('upload' == $atts['type']) {
			
			$content = '<ul>';
			foreach ($meta as $file) {
				
				$content .= sprintf(
					'<li><a href="%s" title="%s">%s</a></li>',
					$file['url'],
					$file['title'],
					$file['name']
				);
				
			}
			
			$content .= '</ul>';
			
		} else if (in_array($atts['type'], array('upload_image', 'upload_plupload', 'upload_thickbox'))) {
			
			$content = '<ul>';
			foreach ($meta as $image) {
	
				if (isset($atts['link']) && $atts['link']) {
					
					$content .= sprintf(
						'<li><a href="%s" title="%s"><img src="%s" alt="%s" title="%s" /></a></li>',
						$image['full_url'],
						$image['title'],
						$image['url'],
						$image['alt'],
						$image['title']
					);
					
				} else {
					
					$content .= sprintf(
						'<li><img src="%s" alt="%s" title="%s" /></li>',
						$image['url'],
						$image['alt'],
						$image['title']
					);
					
				}
				
			}
			
			$content .= '</ul>';
			
		} else if (is_array($meta)) {
			
			$content = '<ul><li>' . implode('</li><li>', $meta) . '</li></ul>';
			
		} else {
			
			$content = $meta;
			
		}
	
		return apply_filters( __FUNCTION__, $content );
		
	}

}

/*
----------------------------------------------------------------------------------------------------
Get Post Meta
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_meta')) {

	function gp_meta($key, $args = array(), $post_id = null) {
		
		$post_id = empty( $post_id ) ? get_the_ID() : $post_id;
	
		$args = wp_parse_args($args, array(
			'type' => 'input',
		));
	
		$args['multiple'] = in_array($args['type'], array('checkbox_list', 'upload', 'upload_image', 'upload_plupload', 'upload_thickbox'));
	
		$meta = get_post_meta($post_id, $key, !$args['multiple']);
	
		if ('upload' == $args['type']) {
			
			if (is_array($meta) && !empty($meta)) {
				$files = array();
				foreach ($meta as $id) {
					$files[$id] = gp_upload_info($id);
				}
				$meta = $files;
			}
			
		} else if (in_array($args['type'], array('upload_image', 'upload_plupload', 'upload_thickbox'))) {
	
			if (is_array($meta) && !empty($meta)) {
				global $wpdb;
	
				$meta = implode(',', $meta);
	
				$meta = $wpdb->get_col("
					SELECT ID FROM {$wpdb->posts}
					WHERE post_type = 'attachment'
					AND ID in ({$meta})
					ORDER BY menu_order ASC
				");
	
				$images = array();
				foreach ($meta as $id) {
					$images[$id] = gp_upload_info($id, $args);
				}
				
				$meta = $images;
				
			}
	
		}
	
		return apply_filters(__FUNCTION__, $meta);
		
	}
	
	add_shortcode('gp_meta', 'gp_meta_shortcode');

}

/*
----------------------------------------------------------------------------------------------------
Get Uploaded File Information
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_upload_info')) {

	function gp_upload_info($id, $args = array()) {
		
		$args = wp_parse_args($args, array(
			'size' => 'medium',
		));
	
		$image_src = wp_get_attachment_image_src($id, $args['size']);
		$attachment = &get_post($id);
		$path = get_attached_file($id);
		
		return array(
			'name'					=> basename($path),
			'title'					=> get_the_title($id),
			'path'					=> $path,
			'url'					=> wp_get_attachment_url($id),
			'image_full_url'		=> wp_get_attachment_url($id),
			'image_url'         	=> $image_src[0],
			'image_width'       	=> $image_src[1],
			'image_height'      	=> $image_src[2],
			'image_title'			=> $attachment->post_title,
			'image_caption'			=> $attachment->post_excerpt,
			'image_description'		=> $attachment->post_content,
			'image_alt'				=> get_post_meta($id, '_wp_attachment_image_alt', true)
		);
		
	}

}