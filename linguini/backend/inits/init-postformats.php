<?php

/*

@name			GPanel Post Formats Init
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

if (!function_exists('gp_add_post_formats_support')) {

	function gp_add_post_formats_support() {
		
		// Add Post Formats Support
		add_theme_support(
			'post-formats', 
			array(
				'audio',
				'gallery',
				'video',
				'quote'
			)
		);
		
	}
	
	add_action('after_setup_theme', 'gp_add_post_formats_support');

}

/*
====================================================================================================
Post Format Metabox by Post Format Change
====================================================================================================
*/

if (!function_exists('gp_postformat_metabox')) {

	function gp_postformat_metabox() {
		
		if (get_post_type() == "post") {
		?>
		
			<script type="text/javascript">
			// <![CDATA[
			
				jQuery(document).ready(function() {
	
					function postFormatMetabox() {
						
						if (jQuery('#post-format-audio').is(":checked")) {
							
							jQuery('#gp-metabox-audio').css('display', 'block');
							jQuery('#gp-metabox-gallery').css('display', 'none');
							jQuery('#gp-metabox-video').css('display', 'none');
							jQuery('#gp-metabox-quote').css('display', 'none');
							
						} else if (jQuery('#post-format-gallery').is(":checked")) {
							
							jQuery('#gp-metabox-audio').css('display', 'none');
							jQuery('#gp-metabox-gallery').css('display', 'block');
							jQuery('#gp-metabox-video').css('display', 'none');
							jQuery('#gp-metabox-quote').css('display', 'none');
						
						} else if (jQuery('#post-format-video').is(":checked")) {
							
							jQuery('#gp-metabox-audio').css('display', 'none');
							jQuery('#gp-metabox-gallery').css('display', 'none');
							jQuery('#gp-metabox-video').css('display', 'block');
							jQuery('#gp-metabox-quote').css('display', 'none');
							
						} else if (jQuery('#post-format-quote').is(":checked")) {
							
							jQuery('#gp-metabox-audio').css('display', 'none');
							jQuery('#gp-metabox-gallery').css('display', 'none');
							jQuery('#gp-metabox-video').css('display', 'none');
							jQuery('#gp-metabox-quote').css('display', 'block');
							
						} else {
							
							jQuery('#gp-metabox-audio').css('display', 'none');
							jQuery('#gp-metabox-gallery').css('display', 'none');
							jQuery('#gp-metabox-video').css('display', 'none');
							jQuery('#gp-metabox-quote').css('display', 'none');
							
						}
						
					}
					
					postFormatMetabox();
				
					jQuery('.post-format').change(function() {
						
						postFormatMetabox();
						
					});
					
				});
	
			// ]]>
			</script>
			
		<?php
		}
	}
	
	add_action('admin_print_scripts', 'gp_postformat_metabox', 1000);

}

/*
====================================================================================================
Register Post Format Metaboxes
====================================================================================================
*/

if (!function_exists('gp_register_metabox_post_format')) {

	function gp_register_metabox_post_format() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Post Format Audio
		--------------------------------------------------
		*/
		
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-audio',
			'title'				=> __('Audio Settings', 'gp'),
			'pages'				=> array('post'),
			'fields'			=> array(
				array(
					'name'				=> __('MP3 File Upload', 'gp'),
					'desc'				=> __('Click to upload the *.mp3 audio file.', 'gp'),
					'id'				=> GP_SHORTNAME . '_post_mp3',
					'type'				=> 'upload_plupload',
					'filters'			=> 'mp3',
					'max_file_uploads'	=> 1
				)
			)
		);
		
		/*
		--------------------------------------------------
		Post Format Gallery
		--------------------------------------------------
		*/
		
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-gallery',
			'title'				=> __('Gallery Settings', 'gp'),
			'pages'				=> array('post'),
			'fields'			=> array(
				array(
					'name'				=> __('Upload Gallery Images', 'gp'),
					'desc'				=> __('Click to upload images.', 'gp'),
					'id'				=> GP_SHORTNAME . '_post_gallery',
					'type'				=> 'upload_plupload'
				)
			)
		);
	
		/*
		--------------------------------------------------
		Post Format Video
		--------------------------------------------------
		*/
		
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-video',
			'title'				=> __('Video Settings', 'gp'),
			'pages'				=> array('post'),
			'fields'			=> array(
				array(
					'name'				=> __('YouTube Embed Code', 'gp'),
					'desc'				=> __('Add YouTube Video Embed Code. For Example: http://www.youtube.com/watch?v=<strong>12345abcdef</strong>.', 'gp'),
					'id'				=> GP_SHORTNAME . '_post_youtube_code',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Vimeo Embed Code', 'gp'),
					'desc'				=> __('Add Vimeo Video Embed Code. For example: http://vimeo.com/<strong>123456789</strong>.', 'gp'),
					'id'				=> GP_SHORTNAME . '_post_vimeo_code',
					'type'				=> 'input'
				)
			)
		);
		
		/*
		--------------------------------------------------
		Post Format Quote
		--------------------------------------------------
		*/
		
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-quote',
			'title'				=> __('Quote Settings', 'gp'),
			'pages'				=> array('post'),
			'fields'			=> array(
				array(
					'name'				=> __('The Quote', 'gp'),
					'desc'				=> __('Input your quote.', 'gp'),
					'id'				=> GP_SHORTNAME . '_post_quote',
					'type'				=> 'textarea'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_post_format');

}

/*
====================================================================================================
Quote Output
====================================================================================================
*/

if (!function_exists('gp_quote_content')) {

	function gp_quote_content($content) {
	
		if (has_post_format('quote')) {
	
			preg_match('/<blockquote.*?>/', $content, $matches);
	
			if (empty($matches)) {
				$content = "<blockquote>{$content}</blockquote>";
			}
			
		}
		
		return $content;
		
	}
	
	add_filter('the_content', 'gp_quote_content');

}