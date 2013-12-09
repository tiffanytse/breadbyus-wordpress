<?php

/*

@name			Metabox Class
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Prevent loading this file directly
defined('ABSPATH') || exit;

/*
====================================================================================================
Metabox Class
====================================================================================================
*/

if (!class_exists('gp_Metabox')) {

	class gp_Metabox {

		var $meta_box;
		var $fields;
		var $types;
		var $validation;
		
		// Metabox Construct
		function __construct($meta_box) {
			
			if (!is_admin()) {
				return;
			}

			$this->meta_box = self::normalize( $meta_box );
			$this->fields = &$this->meta_box['fields'];
			$this->validation = &$this->meta_box['validation'];

			add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));

			foreach ($this->fields as $field) {
				
				$class = self::get_class_name($field);
				
				if (method_exists($class, 'add_actions')) {
					call_user_func(array($class, 'add_actions'));
				}
				
			}

			foreach ($this->meta_box['pages'] as $page) {
				
				add_action("add_meta_boxes_{$page}", array($this, 'add_meta_boxes'));
				
			}
			
			add_action('save_post', array($this, 'save_post'));
			
		} // _construct end

		function admin_enqueue_scripts() {
			
			$screen = get_current_screen();

			if ('post' != $screen->base || !in_array($screen->post_type, $this->meta_box['pages'])) {
				return;
			}

			$has_clone = false;
			foreach ($this->fields as $field) {
				
				if ($field['clone']) {
					$has_clone = true;
				}

				$class = self::get_class_name($field);
				
				if (method_exists($class, 'admin_enqueue_scripts')) {
					call_user_func(array($class, 'admin_enqueue_scripts'));
				}
				
			}

			if ($has_clone) {
				wp_enqueue_script('gp-clone', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.clone.js', array('jquery'), GP_VERSION, true);
			}

			if ($this->validation) {
				wp_enqueue_script('gp-validate-jquery', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.validate.min.js', array('jquery'), GP_VERSION, true);
				wp_enqueue_script('gp-validate', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.validate.js', array('gp-validate-jquery'), GP_VERSION, true);
			}
			
		}
		
		// Metabox Add		
		function add_meta_boxes() {
			
			foreach ($this->meta_box['pages'] as $page) {

				$show = true;
				$show = apply_filters('gp_show', $show, $this->meta_box);
				$show = apply_filters("gp_show_{$this->meta_box['id']}", $show, $this->meta_box);
				
				if (!$show) {
					continue;
				}

				add_meta_box(
					$this->meta_box['id'],
					$this->meta_box['title'],
					array($this, 'show'),
					$page,
					$this->meta_box['context'],
					$this->meta_box['priority']
				);
				
			}
		}

		// Metabox Render
		public function show() {
			global $post;

			$saved = self::has_been_saved($post->ID, $this->fields);

			wp_nonce_field("gp-save-{$this->meta_box['id']}", "nonce_{$this->meta_box['id']}");

			do_action('gp_before');
			do_action("gp_before_{$this->meta_box['id']}");

			foreach ($this->fields as $field) {
				
				$group = '';
				$type = $field['type'];
				$id = $field['id'];
				
				$meta = self::apply_field_class_filters($field, 'meta', '', $post->ID, $saved);
				
				$meta = apply_filters("gp_{$type}_meta", $meta);
				$meta = apply_filters("gp_{$id}_meta", $meta);

				$begin = self::apply_field_class_filters($field, 'begin_html', '', $meta);
				
				$begin = apply_filters('gp_begin_html', $begin, $field, $meta);
				$begin = apply_filters("gp_{$type}_begin_html", $begin, $field, $meta);
				$begin = apply_filters("gp_{$id}_begin_html", $begin, $field, $meta);


				if ($field['clone']) {
					
					if (isset( $field['clone-group'])) {
						$group = " clone-group='{$field['clone-group']}'";
					}

					$meta = (array) $meta;
					$field_html = '';

					foreach ($meta as $index => $meta_data) {
						
						$sub_field = $field;
						$sub_field['field_name'] = $field['field_name'] . "[{$index}]";
						
						if ($field['multiple']) {
							$sub_field['field_name'] .= '[]';
						}

						add_filter("gp_{$id}_html", array($this, 'add_clone_buttons'), 10, 3);

						$input_html = '<div class="gp-clone clearfix">';
						$input_html .= self::apply_field_class_filters($sub_field, 'html', '', $meta_data);

						$input_html = apply_filters("gp_{$type}_html", $input_html, $field, $meta_data);
						$input_html = apply_filters("gp_{$id}_html", $input_html, $field, $meta_data);

						$input_html .= '</div>';
						$field_html .= $input_html;
						
					}
					
				} else {
					
					$field_html = self::apply_field_class_filters($field, 'html', '', $meta);
					
					$field_html = apply_filters("gp_{$type}_html", $field_html, $field, $meta);
					$field_html = apply_filters("gp_{$id}_html", $field_html, $field, $meta);
					
				}

				$end = self::apply_field_class_filters($field, 'end_html', '', $meta);

				$end = apply_filters('gp_end_html', $end, $field, $meta);
				$end = apply_filters("gp_{$type}_end_html", $end, $field, $meta);
				$end = apply_filters("gp_{$id}_end_html", $end, $field, $meta);

				$html = apply_filters("gp_{$type}_wrapper_html", "{$begin}{$field_html}{$end}", $field, $meta);
				$html = apply_filters("gp_{$id}_wrapper_html", $html, $field, $meta);

				$classes = array('gp-block', "gp-{$field['type']}-wrapper", 'clearfix');
				if ('hidden' === $field['type']) {
					$classes[] = 'hidden';
				}
				if (!empty( $field['required'])) {
					$classes[] = 'required';
				}
				if (!empty( $field['class'])) {
					$classes[] = $field['class'];
				}

				printf(
					'<div class="%s"%s>%s</div>',
					implode(' ', $classes),
					$group,
					$html
				);
				
			}

			if (isset($this->validation) && $this->validation) {
				echo '
					<script type="text/javascript">
						if (typeof gp == "undefined") {
							var gp = {
								validationOptions : jQuery.parseJSON(\'' . json_encode($this->validation) . '\'),
								summaryMessage : "' . __('Please correct the errors highlighted below and try again.', 'gp') . '"
							};
						} else {
							var tempOptions = jQuery.parseJSON(\'' . json_encode($this->validation) . '\');
							jQuery.extend(true, gp.validationOptions, tempOptions);
						};
					</script>
				';
			}

			do_action('gp_after');
			do_action("gp_after_{$this->meta_box['id']}");
			
		}

		static function begin_html($html, $meta, $field) {
			
			if (empty($field['name'])) {
				return '<div class="gp-input">';
			}

			return sprintf(
				'<div class="gp-label">
					<label for="%s">%s</label>
				</div>
				<div class="gp-field">',
				$field['id'],
				$field['name']
			);
			
		}

		static function end_html($html, $meta, $field) {
			
			$id = $field['id'];

			$button = '';
			if ($field['clone']) {
				$button = '<a href="#" class="gp-button-primary add-clone">' . __('+', 'gp') . '</a>';
			}

			$desc = !empty($field['desc']) ? "<p id='{$id}_description' class='description'>{$field['desc']}</p>" : '';

			$html = "{$button}{$desc}</div>";

			return $html;
			
		}

		static function add_clone_buttons($html, $field, $meta_data) {
			
			$button = '<a href="#" class="gp-button-secondary remove-clone">' . __('&#8211;', 'gp') . '</a>';

			return "{$html}{$button}";
			
		}

		static function meta($meta, $post_id, $saved, $field) {
			
			$meta = get_post_meta( $post_id, $field['id'], !$field['multiple']);
			$meta = (!$saved && '' === $meta || array() === $meta) ? $field['std'] : $meta;

			if ('wysiwyg' !== $field['type']) {
				$meta = is_array($meta) ? array_map('esc_attr', $meta) : esc_attr($meta);
			}

			return $meta;
			
		}

		function save_post($post_id) {

			$post_type = null;
			$post = get_post($post_id);

			if ($post) {
				$post_type = $post->post_type;
			} else if (isset($_POST['post_type']) && post_type_exists($_POST['post_type'])) {
				$post_type = $_POST['post_type'];
			}

			$post_type_object = get_post_type_object($post_type);

			if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( !isset($_POST['post_ID']) || $post_id != $_POST['post_ID']) || (!in_array($post_type, $this->meta_box['pages'])) || ( !current_user_can($post_type_object->cap->edit_post, $post_id))) {
				return $post_id;
			}
			
			// Verify
			check_admin_referer("gp-save-{$this->meta_box['id']}", "nonce_{$this->meta_box['id']}");

			foreach ($this->fields as $field) {
				
				$name = $field['id'];
				$old  = get_post_meta($post_id, $name, !$field['multiple']);
				$new  = isset($_POST[$name]) ? $_POST[$name] : ($field['multiple'] ? array() : '');
				$new = self::apply_field_class_filters($field, 'value', $new, $old, $post_id);

				$new = apply_filters("gp_{$field['type']}_value", $new, $field, $old);
				$new = apply_filters("gp_{$name}_value", $new, $field, $old);

				self::do_field_class_actions($field, 'save', $new, $old, $post_id);
				
			}
			
		}

		static function save($new, $old, $post_id, $field) {
			
			$name = $field['id'];

			if ('' === $new || array() === $new) {
				delete_post_meta($post_id, $name);
				return;
			}

			if ($field['multiple']) {
				
				foreach ($new as $new_value) {
					if (!in_array($new_value, $old)) {
						add_post_meta($post_id, $name, $new_value, false);
					}
				}
				
				foreach ($old as $old_value) {
					if (!in_array( $old_value, $new)) {
						delete_post_meta($post_id, $name, $old_value);
					}
				}
				
			} else {
				
				update_post_meta($post_id, $name, $new);
				
			}
			
		}

		static function normalize($meta_box) {

			$meta_box = wp_parse_args( $meta_box, array(
				'id'			=> sanitize_title($meta_box['title']),
				'context'		=> 'normal',
				'priority'		=> 'high',
				'pages'			=> array('post')
			) );

			foreach ($meta_box['fields'] as &$field) {
				
				$field = wp_parse_args($field, array(
					'multiple'		=> false,
					'clone'			=> false,
					'std'			=> '',
					'desc'			=> '',
					'format'		=> '',
				));

				$field = self::apply_field_class_filters($field, 'normalize_field', $field);

				if (!isset($field['field_name'])) {
					$field['field_name'] = $field['id'];
				}
				
			}

			return $meta_box;
			
		}

		static function get_class_name($field) {
			
			$type = ucwords($field['type']);
			$class = "gp_Metabox_{$type}";

			if (class_exists($class)) {
				return $class;
			}

			return false;
			
		}

		static function apply_field_class_filters($field, $method_name, $value) {

			$args = array_slice(func_get_args(), 2);
			$args[] = $field;

			$class = self::get_class_name($field);
			if (method_exists($class, $method_name)) {
				$value = call_user_func_array(array($class, $method_name), $args);
			} else if ( method_exists(__CLASS__, $method_name)) {
				$value = call_user_func_array(array(__CLASS__, $method_name), $args);
			}

			return $value;
			
		}

		static function do_field_class_actions($field, $method_name) {
			
			$args = array_slice(func_get_args(), 2);
			$args[] = $field;

			$class = self::get_class_name($field);
			if (method_exists($class, $method_name)) {
				call_user_func_array(array($class, $method_name), $args);
			} else if (method_exists(__CLASS__, $method_name)) {
				call_user_func_array(array(__CLASS__, $method_name), $args);
			}
			
		}

		static function ajax_response($message, $status) {
			
			$response = array('what' => 'meta-box');
			$response['data'] = 'error' === $status ? new WP_Error('error', $message) : $message;
			$x = new WP_Ajax_Response($response);
			$x->send();
			
		}

		static function has_been_saved($post_id, $fields) {
			
			$saved = false;
			
			foreach ($fields as $field) {

				if (get_post_meta($post_id, $field['id'], !$field['multiple'])) {
					$saved = true;
					break;
				}

			}
			
			return $saved;
			
		}
		
	}
	
}