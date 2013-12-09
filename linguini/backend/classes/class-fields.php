<?php

/*

@name			Field Classes
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Prevent loading this file directly
defined('ABSPATH') || exit;

/*
====================================================================================================
Class Input
====================================================================================================
*/

if (!class_exists('gp_Metabox_Input')) {
	
	class gp_Metabox_Input {

		static function html($html, $meta, $field) {
			
			return sprintf(
				'<input type="text" class="gp-input" name="%s" id="%s" value="%s" size="%s" maxlength="%s" />',
				$field['field_name'],
				$field['id'],
				$meta,
				$field['size'],
				$field['maxlenght']
			);
			
		}

		static function normalize_field($field) {
			
			$field = wp_parse_args($field, array(
				'size' => 30,
				'maxlenght' => 999999,
			));
			
			return $field;
			
		}
		
	}
	
}

/*
====================================================================================================
Class Picker Color
====================================================================================================
*/

if (!class_exists('gp_Metabox_Picker_Color')) {
	
	class gp_Metabox_Picker_Color {

		static function html($html, $meta, $field) {
			
			return sprintf(
				'<input type="text" class="gp-picker color_picker" name="%s" id="%s" value="%s" size="%s" />',
				$field['field_name'],
				$field['id'],
				$meta,
				$field['size']
			);
			
		}

		static function normalize_field($field) {
			
			$field = wp_parse_args($field, array(
				'size' => 30,
			));
			
			return $field;
			
		}
		
	}
	
}

/*
====================================================================================================
Class Picker Date
====================================================================================================
*/

if (!class_exists('gp_Metabox_Picker_Date')) {
	
	class gp_Metabox_Picker_Date {
		
		static function admin_enqueue_scripts() {

			wp_enqueue_script('gp-metabox-datepicker-ui', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/metabox/jquery.datepicker.ui.js', array('jquery-ui-core'), GP_VERSION, true);

		}

		static function html($html, $meta, $field) {
			
			return sprintf(
				'<input type="text" class="gp-datepicker" name="%s" value="%s" id="%s" size="%s" />',
				$field['field_name'],
				$meta,
				isset($field['clone']) && $field['clone'] ? '' : $field['id'],
				$field['size']
			);
			
		}

		static function normalize_field($field) {
			
			$field = wp_parse_args($field, array(
				'size' => 30
			));
			
			return $field;
			
		}
		
	}
	
}

/*
====================================================================================================
Class Textarea
====================================================================================================
*/

if (!class_exists('gp_Metabox_Textarea')) {
	
	class gp_Metabox_Textarea {

		static function html($html, $meta, $field) {
			
			return sprintf(
				'<textarea class="gp-textarea large-text" name="%s" id="%s" cols="%s" rows="%s">%s</textarea>',
				$field['field_name'],
				$field['id'],
				$field['cols'],
				$field['rows'],
				$meta
			);
			
		}

		static function normalize_field($field) {
			
			$field = wp_parse_args($field, array(
				'cols' => 60,
				'rows' => 3,
			));
			
			return $field;
			
		}
		
	}
	
}

/*
====================================================================================================
Class Select
====================================================================================================
*/

if (!class_exists('gp_Metabox_Select')) {
	
	class gp_Metabox_Select {

		static function html($html, $meta, $field) {
			
			$html = sprintf(
				'<select class="gp-select" name="%s" id="%s"%s>',
				$field['field_name'],
				$field['id'],
				$field['multiple'] ? ' multiple="multiple"' : ''
			);
			$option = '<option value="%s" %s>%s</option>';

			foreach ( $field['options'] as $value => $label )
			{
				$html .= sprintf(
					$option,
					$value,
					selected( in_array( $value, $meta ), true, false ),
					$label
				);
			}
			$html .= '</select>';

			return $html;
			
		}
		
		static function meta($meta, $post_id, $saved, $field) {
			
			$single = $field['clone'] || !$field['multiple'];
			$meta = get_post_meta($post_id, $field['id'], $single);
			$meta = (!$saved && '' === $meta || array() === $meta) ? $field['std'] : $meta;

			$meta = array_map('esc_attr', (array) $meta);

			return $meta;
			
		}
		
		static function save($new, $old, $post_id, $field) {
			
			if (!$field['clone']) {
				gp_Metabox::save( $new, $old, $post_id, $field );
				return;
			}

			if (empty($new)) {
				delete_post_meta($post_id, $field['id']);
			} else {
				update_post_meta($post_id, $field['id'], $new);
			}
			
		}

		static function normalize_field($field) {
			
			$field['field_name'] = $field['id'];
			if (!$field['clone'] && $field['multiple']) {
				$field['field_name'] .= '[]';
			}
			
			return $field;
			
		}
		
	}
	
}

/*
====================================================================================================
Class Checkbox
====================================================================================================
*/

if (!class_exists('gp_Metabox_Checkbox')) {
	
	class gp_Metabox_Checkbox {

		static function html($html, $meta, $field) {
			
			return sprintf(
				'<input type="checkbox" class="gp-checkbox" name="%s" id="%s" value="1" %s />',
				$field['field_name'],
				$field['id'],
				checked(!empty($meta), 1, false)
			);
			
		}

		static function value($new, $old, $post_id, $field) {
			
			return empty($new) ? 0 : 1;
			
		}
		
	}
	
}

/*
====================================================================================================
Class Upload
====================================================================================================
*/

if (!class_exists('gp_Metabox_Upload')) {
	
	class gp_Metabox_Upload {

		static function admin_enqueue_scripts() {
			
			wp_enqueue_script('gp-metabox-upload', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/metabox/jquery.upload.js', array('jquery', 'wp-ajax-response'), GP_VERSION, true);
			
		}

		static function add_actions() {

			add_action('post_edit_form_tag', array(__CLASS__, 'post_edit_form_tag'));
			add_action('wp_ajax_gp_delete_file', array(__CLASS__, 'wp_ajax_delete_file'));

		}

		static function post_edit_form_tag() {
			
			echo ' enctype="multipart/form-data"';
			
		}

		static function wp_ajax_delete_file() {
			
			$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
			$field_id = isset($_POST['field_id']) ? $_POST['field_id'] : 0;
			$attachment_id = isset($_POST['attachment_id']) ? intval($_POST['attachment_id']) : 0;
			$force_delete = isset($_POST['force_delete']) ? intval($_POST['force_delete']) : 0;

			check_admin_referer("gp-delete-file_{$field_id}");

			delete_post_meta($post_id, $field_id, $attachment_id);
			$ok = $force_delete ? wp_delete_attachment($attachment_id) : true;

			if ($ok) {
				gp_Metabox::ajax_response('', 'success');
			} else {
				gp_Metabox::ajax_response(__('Error: Cannot delete file', 'gp'), 'error');
			}
		}

		static function html($html, $meta, $field) {
			
			$i18n_delete = __('Delete', 'file upload', 'gp');
			$i18n_title  = __('Upload Files', 'file upload', 'gp');
			$i18n_more   = __('+ Add New File', 'file upload', 'gp');

			$html = wp_nonce_field("gp-delete-file_{$field['id']}", "nonce-delete-file_{$field['id']}", false, false);

			if (!empty($meta)) {
				
				$html .= '<ul class="gp-uploaded">';
				$li = '<li>%s (<a title="%s" class="gp-delete-file" href="#" data-field_id="%s" data-attachment_id="%s" data-force_delete="%s">%s</a>)</li>';

				foreach ($meta as $attachment_id) {
					
					$attachment = wp_get_attachment_link($attachment_id);
					$html .= sprintf(
						$li,
						$attachment,
						$i18n_delete,
						$field['id'],
						$attachment_id,
						$field['force_delete'] ? 1 : 0,
						$i18n_delete
					);
					
				}

				$html .= '</ul>';
			}

			$html .= sprintf(
				'<div class="new-files">
					<div class="gp-upload"><input type="file" name="%s[]" /></div>
					<a class="gp-add-file gp-button-primary" href="#"><strong>%s</strong></a>
				</div>',
				$field['id'],
				$i18n_more
			);

			return $html;
			
		}

		static function value($new, $old, $post_id, $field) {
			
			$name = $field['id'];
			if (empty($_FILES[ $name ])) {
				return $new;
			}

			$new = array();
			$files	= self::fix_file_array($_FILES[$name]);

			foreach ($files as $file_item) {
				
				$file = wp_handle_upload($file_item, array('test_form' => false));

				if (!isset($file['file'])) {
					continue;
				}

				$file_name = $file['file'];

				$attachment = array(
					'post_mime_type' => $file['type'],
					'guid'           => $file['url'],
					'post_parent'    => $post_id,
					'post_title'     => preg_replace('/\.[^.]+$/', '', basename($file_name)),
					'post_content'   => '',
				);
				$id = wp_insert_attachment($attachment, $file_name, $post_id);

				if (!is_wp_error($id)) {

					wp_update_attachment_metadata($id, wp_generate_attachment_metadata($id, $file_name));

					$new[] = $id;

				}
				
			}

			return array_unique(array_merge($old, $new));
			
		}

		static function fix_file_array($files) {
			
			$output = array();
			
			foreach ($files as $key => $list) {
				foreach ($list as $index => $value) {
					$output[$index][$key] = $value;
				}
			}
			
			return $output;
			
		}

		static function normalize_field($field) {
			
			$field = wp_parse_args($field, array(
				'std'          => array(),
				'force_delete' => false,
			));
			$field['multiple'] = true;
			return $field;
			
		}
		
	}
	
}

/*
====================================================================================================
Class Upload Image
====================================================================================================
*/

if (!class_exists('gp_Metabox_Upload_Image')) {
	
	class gp_Metabox_Upload_Image extends gp_Metabox_Upload {

		static function admin_enqueue_scripts() {

			parent::admin_enqueue_scripts();
			wp_enqueue_script('gp-metabox-upload-image', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/metabox/jquery.upload.image.js', array('jquery-ui-sortable', 'wp-ajax-response'), GP_VERSION, true);

		}

		static function add_actions() {

			parent::add_actions();
			add_action('wp_ajax_gp_reorder_images', array(__CLASS__, 'wp_ajax_reorder_images'));

		}

		static function wp_ajax_reorder_images() {
			
			$field_id = isset($_POST['field_id']) ? $_POST['field_id'] : 0;
			$order = isset($_POST['order']) ? $_POST['order'] : 0;

			check_admin_referer("gp-reorder-images_{$field_id}");

			parse_str($order, $items);
			$items = $items['item'];
			$order = 1;

			foreach ($items as $item) {
				wp_update_post(
					array(
						'ID'         => $item,
						'menu_order' => $order++,
					)
				);
			}

			gp_Metabox::ajax_response(__('Order Saved', 'gp'), 'success');
			
		}

		static function html($html, $meta, $field) {
			
			$i18n_title = __('Upload Images', 'image upload', 'gp');
			$i18n_more = __('+ Add New Image', 'image upload', 'gp');

			$html  = wp_nonce_field("gp-delete-file_{$field['id']}", "nonce-delete-file_{$field['id']}", false, false);
			$html .= wp_nonce_field("gp-reorder-images_{$field['id']}", "nonce-reorder-images_{$field['id']}", false, false);
			$html .= "<input type='hidden' class='field-id' value='{$field['id']}' />";

			if (!empty($meta)) {
				$html .= self::get_uploaded_images($meta, $field);
			}

			$html .= sprintf(
				'<div class="new-files">
					<div class="gp-upload"><input type="file" name="%s[]" /></div>
				</div>
				<a class="gp-add-file gp-button-primary" href="#">%s</a>',
				$field['id'],
				$i18n_more
			);

			return $html;
			
		}

		static function get_uploaded_images($images, $field) {
			
			$html = '<ul class="gp-images gp-uploaded clearfix">';

			foreach ($images as $image) {
				$html .= self::img_html($image, $field);
			}

			$html .= '</ul>';

			return $html;
			
		}

		static function img_html($image, $field) {
			
			$i18n_title = wp_get_attachment_link($image, '', false, false, '');
			$i18n_delete = __('Delete', 'image upload', 'gp');
			$i18n_edit = __('Edit', 'image upload', 'gp');
			$li = '
				<li id="item_%s">
					<img src="%s" />
					<div class="gp-image-bar">
						<div class="gp-image-title clearfix">%s</div>
						<div class="gp-image-edit">
							<a title="%s" class="gp-edit-file" href="%s" target="_blank">%s</a> /
							<a title="%s" class="gp-delete-file" href="#" data-field_id="%s" data-attachment_id="%s" data-force_delete="%s">%s</a>
						</div>
					</div>
				</li>
			';

			$src = wp_get_attachment_image_src($image, 'thumbnail');
			if ($src[0] != ''){ $src = $src[0]; } else { $src = trailingslashit(get_template_directory_uri()) . 'backend/images/replacement/replacement150x150.png'; }
			$link = get_edit_post_link($image);

			return sprintf(
				$li,
				$image,
				$src,
				$i18n_title,
				$i18n_edit, $link, $i18n_edit,
				$i18n_delete, $field['id'], $image, $field['force_delete'] ? 1 : 0, $i18n_delete
			);
			
		}

		static function meta($meta, $post_id, $saved, $field) {
			global $wpdb;

			$meta = gp_Metabox::meta($meta, $post_id, $saved, $field);

			if (empty($meta)) {
				return array();
			}

			$meta = implode(',' , $meta);

			$meta = $wpdb->get_col("
				SELECT ID FROM {$wpdb->posts}
				WHERE post_type = 'attachment'
				AND ID in ({$meta})
				ORDER BY menu_order ASC
			");

			return (array) $meta;
			
		}
		
	}
	
}

/*
====================================================================================================
Class Upload - Plupload
====================================================================================================
*/

if (!class_exists('gp_Metabox_Upload_Plupload')) {
	
	class gp_Metabox_Upload_Plupload extends gp_Metabox_Upload_Image {

		static function add_actions() {
			
			parent::add_actions();
			add_action('wp_ajax_gp_plupload_image_upload', array(__CLASS__, 'handle_upload'));
			
		}

		static function handle_upload() {
			
			$post_id = is_numeric($_REQUEST['post_id']) ? $_REQUEST['post_id'] : 0;
			$field_id = isset($_REQUEST['field_id']) ? $_REQUEST['field_id'] : '';

			check_admin_referer("gp-upload-images_{$field_id}");

			$file = $_FILES['async-upload'];
			$file_attr = wp_handle_upload( $file, array('test_form' => false));
			$attachment = array(
				'guid'           => $file_attr['url'],
				'post_mime_type' => $file_attr['type'],
				'post_title'     => preg_replace('/\.[^.]+$/', '', basename( $file['name'])),
				'post_content'   => '',
				'post_status'    => 'inherit',
			);

			$id = wp_insert_attachment($attachment, $file_attr['file'], $post_id);
			if (!is_wp_error($id)){
				
				wp_update_attachment_metadata($id, wp_generate_attachment_metadata($id, $file_attr['file']));

				add_post_meta($post_id, $field_id, $id, false);

				$field = array(
					'id'           => $field_id,
					'force_delete' => isset($_REQUEST['force_delete']) ? intval($_REQUEST['force_delete']) : 0,
				);

				gp_Metabox::ajax_response(self::img_html($id, $field), 'success');
			}

			exit;
			
		}

		static function admin_enqueue_scripts() {

			parent::admin_enqueue_scripts();
			wp_enqueue_script('gp-metabox-upload-image-plupload', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/metabox/jquery.plupload.js', array('jquery-ui-sortable', 'wp-ajax-response', 'plupload-all'), GP_VERSION, true);
			wp_localize_script('gp-metabox-upload-image-plupload', 'GP', array('url' => trailingslashit(get_template_directory_uri()) . 'backend/'));
			wp_localize_script('gp-metabox-upload-image-plupload', 'gp_plupload_defaults', array(
				'runtimes'				=> 'html5,silverlight,flash,html4',
				'file_data_name'		=> 'async-upload',
				'multiple_queues'		=> true,
				'max_file_size'			=> wp_max_upload_size() . 'b',
				'url'					=> admin_url('admin-ajax.php' ),
				'flash_swf_url'			=> includes_url('js/plupload/plupload.flash.swf'),
				'silverlight_xap_url'	=> includes_url('js/plupload/plupload.silverlight.xap'),
				'multipart'				=> true,
				'urlstream_upload'		=> true
			));
			
		}

		static function html($html, $meta, $field) {
			
			if (!is_array($meta)) {
				$meta = (array) $meta;
			}

			$i18n_drop = apply_filters('gp_upload_drop_string', __('Drop Files Here', 'image upload', 'gp'));
			$i18n_or = __('or', 'image upload', 'gp');
			$i18n_select = __('Select Files', 'image upload', 'gp');
			$img_prefix = $field['id'];

			$html  = wp_nonce_field("gp-delete-file_{$field['id']}", "nonce-delete-file_{$field['id']}", false, false);
			$html .= wp_nonce_field("gp-reorder-images_{$field['id']}", "nonce-reorder-images_{$field['id']}", false, false);
			$html .= wp_nonce_field("gp-upload-images_{$field['id']}", "nonce-upload-images_{$field['id']}", false, false);
			$html .= sprintf(
				'<input type="hidden" class="field-id gp-image-prefix" value="%s" data-force_delete="%s" />',
				$field['id'],
				$field['force_delete'] ? 1 : 0
			);

			$html .= "<div id='{$img_prefix}-container'>";

			$classes = array('gp-drag-drop', 'drag-drop', 'hide-if-no-js');
			
			// Define Number of Max File Uploads
			if (!empty($field['max_file_uploads'])) {
				$max_file_uploads = (int) $field['max_file_uploads'];
				$html .= "<input class='max_file_uploads' type='hidden' value='{$max_file_uploads}' />";
				if (count($meta) >= $max_file_uploads) {
					$classes[] = 'hidden';
				}
			}
			
			// Define Upload Formats
			if (!empty($field['filters'])) {
				$filters = $field['filters'];
				$html .= "<input class='filters' type='hidden' value='{$filters}' />";
			} else {
				$filters_default = 'jpg,jpeg,gif,png';
				$html .= "<input class='filters' type='hidden' value='{$filters_default}' />";
			}

			$html .= self::get_uploaded_images($meta, $field);

			$html .= sprintf(
				'<div id="%s-dragdrop" class="%s clearfix">
					<div class = "drag-drop-inside">
						<p class="drag-drop-info">%s</p>
						<p>%s</p>
						<p class="drag-drop-buttons"><input id="%s-browse-button" type="button" value="%s" class="button" /></p>
					</div>
				</div>',
				$img_prefix,
				implode(' ', $classes),
				$i18n_drop,
				$i18n_or,
				$img_prefix,
				$i18n_select
			);

			$html .= '</div>';

			return $html;
			
		}

		static function value($new, $old, $post_id, $field) {
			
			$new = (array) $new;
			return array_unique(array_merge($old, $new));
			
		}
	}
}

?>