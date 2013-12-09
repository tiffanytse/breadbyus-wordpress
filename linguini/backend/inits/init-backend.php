<?php

/*

@name			GPanel Backend Init
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
GPanel (Theme Options) Settings
====================================================================================================
*/

if (!function_exists('gp_options_settings')) {

	function gp_options_settings() {
		
		$output = array();
		
		$output['gp_options_name']		= 'gp_theme_options';
		$output['gp_options_title']		= __('Theme Options', 'gp');
		$output['gp_options_sections']	= gp_theme_options_sections();
		$output['gp_options_fields']	= gp_theme_options_fields();
		
		return $output;
	
	}

}

/*
====================================================================================================
Create GPanel Fields
====================================================================================================
*/

if (!function_exists('gp_create_fields')) {

	function gp_create_fields($args = array()) {
	
		$defaults = array(
			'id'			=> '',
			'title'			=> '',
			'desc'			=> '',
			'std'			=> '',
			'type'			=> '',
			'section'		=> '',
			'choices'		=> array(),
			'class'			=> ''
		);
		
		extract(wp_parse_args($args, $defaults));
		
		$field_args = array(
			'type'			=> $type,
			'id'			=> $id,
			'desc'			=> $desc,
			'std'			=> $std,
			'choices'		=> $choices,
			'label_for'		=> $id,
			'class'			=> $class
		);
	
		add_settings_field($id, $title, 'gp_options_create_fields', __FILE__, $section, $field_args);
	
	}

}

/*
====================================================================================================
Register GPanel Settings
====================================================================================================
*/

if (!function_exists('gp_register_settings')) {

	function gp_register_settings(){
		
		$gp_options_settings_output = gp_options_settings();
		$gp_options_name = $gp_options_settings_output['gp_options_name'];
		
		register_setting($gp_options_name, $gp_options_name, 'gp_options_validate');
		
		if(!empty($gp_options_settings_output['gp_options_sections'])){
			foreach ($gp_options_settings_output['gp_options_sections'] as $id => $title) {
				add_settings_section($id, $title, 'gp_options_section_description', __FILE__);
			}
		}
		
		if(!empty($gp_options_settings_output['gp_options_fields'])){
			foreach ($gp_options_settings_output['gp_options_fields'] as $option) {
				gp_create_fields($option);
			}
		}
		
	}
	
	add_action('admin_init', 'gp_register_settings');

}

// Section Description
if (!function_exists('gp_options_section_description')) {

	function gp_options_section_description($desc) {
		echo '';
	}

}

/*
====================================================================================================
Add Menu
====================================================================================================
*/

if (!function_exists('gp_add_menu')) {

	function gp_add_menu(){
		global $gp_options_settings_page;
		
		$gp_options_settings_output = gp_options_settings();
		$gp_options_settings_page = add_theme_page(
			__('Theme Options', 'gp'),
			__('Theme Options', 'gp'),
			'edit_theme_options',
			GP_BASENAME,
			'gp_options_settings_page'
		);
	
	}
	
	add_action('admin_menu', 'gp_add_menu');

}

/*
====================================================================================================
Form Fields
====================================================================================================
*/

if (!function_exists('gp_options_create_fields')) {

	function gp_options_create_fields($args = array()) {
		
		extract($args);
	
		$gp_options_settings_output = gp_options_settings();
		$gp_options_name = $gp_options_settings_output['gp_options_name'];
		$options = get_option($gp_options_name);
	
		if (!isset($options[$id]) && 'type' != 'checkbox') {
			$options[$id] = $std;
		}
		
		$field_class = ($class != '') ? ' ' . $class : '';
		
		$tab_number = 1;
	
		switch ($type) {
			
			// Input
			case 'heading':
	
				echo ($desc != '') ? "<tr class='subsection-content'><td colspan='3'><p class='subsection-description'>$desc</p></td></tr>" : "";
				
			break;
			
			// Input
			case 'input':
			
				$options[$id] = stripslashes($options[$id]);
				$options[$id] = esc_attr($options[$id]);
				
				echo "<input type='text' class='regular-text$field_class' id='$id' name='" . $gp_options_name . "[$id]' value='$options[$id]' />";
				echo "</td>";
				echo "<td>";
				echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
				
			break;
			
			// Input with Color Picker
			case 'input-picker':
			
				$options[$id] = stripslashes($options[$id]);
				$options[$id] = esc_attr($options[$id]);
				
				echo "<input type='text' class='color_picker regular-text$field_class' id='$id' name='" . $gp_options_name . "[$id]' value='$options[$id]' />";
				echo "</td>";
				echo "<td>";
				echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
				
			break;
			
			// Input with Upload Button
			case 'input-upload':
			
				$options[$id] = stripslashes($options[$id]);
				$options[$id] = esc_attr($options[$id]);
	
				echo (!empty($options[$id])) ? "<div class='gp-upload-preview'><img class='upload_preview' src='$options[$id]' alt='' /></div>" : "";
				echo "<input type='text' class='upload_field regular-text$field_class' id='$id' name='" . $gp_options_name . "[$id]' value='$options[$id]' />";
				echo "<input type='button' class='button upload_button' value='" . __('Upload', 'gp'). "' />";
				echo "<input type='button' class='button clear_button' value='" . __('Remove', 'gp'). "' />";
				echo "</td>";
				echo "<td>";
				echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
				
			break;
			
			// Input Group
			case "input-group":
			  
				foreach($choices as $item) {
					$item = explode("|",$item);
					$item[0] = esc_html($item[0]);
					if (!empty($options[$id])) {
						foreach ($options[$id] as $option_key => $option_val) {
							if ($item[1] == $option_key) {
								$value = $option_val;
							}
						}
					} else {
						$value = '';
					}
					echo "<div class='small-label'>$item[0]</div><input class='$field_class' type='text' id='$id|$item[1]' name='" . $gp_options_name . "[$id|$item[1]]' value='$value' /><br/>";
				}
				echo "<br />";
				echo "</td>";
				echo "<td>";
				echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
			break; 
			
			// Textarea
			case 'textarea':
			
				$options[$id] = stripslashes($options[$id]);
				$options[$id] = esc_html( $options[$id]);
				echo "<textarea class='textarea$field_class' id='$id' name='" . $gp_options_name . "[$id]' rows='5' cols='30'>$options[$id]</textarea>";
				echo "</td>";
				echo "<td>";
				echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; 	
					
			break;
			
			// Select
			case 'select-number':
			
				echo "<select id='$id' class='select$field_class' name='" . $gp_options_name . "[$id]'>";
					foreach($choices as $item) {
						$value = esc_attr($item, 'gp');
						$item = esc_html($item, 'gp');
						
						$selected = ($options[$id]==$value) ? 'selected="selected"' : '';
						echo "<option value='$value' $selected>$item</option>";
					}
				echo "</select>";
				echo "</td>";
				echo "<td>";
				echo ($desc != '') ? "<p class='description'>$desc</p>" : ""; 
				
			break;
			
			// Select 2
			case 'select-text':
			
				echo "<select id='$id' class='select$field_class' name='" . $gp_options_name . "[$id]'>";
				foreach($choices as $item) {
					
					$item = explode("|", $item);
					$item[0] = esc_html($item[0], 'gp');
					
					$selected = ($options[$id] == $item[1]) ? 'selected="selected"' : '';
					echo "<option value='$item[1]' $selected>$item[0]</option>";
				}
				echo "</select>";
				echo "</td>";
				echo "<td>";
				echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
				
			break;
			
			// Checkbox
			case 'checkbox':
			
				echo "<label for='$id' class='checkbox-label'><input class='checkbox$field_class' type='checkbox' id='$id' name='" . $gp_options_name . "[$id]' value='1' " . checked( $options[$id], 1, false ) . " /></label>";
				echo "</td>";
				echo "<td>";
				echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
				
			break;
			
			// Checkbox Group
			case "checkbox-group":
			
				foreach($choices as $item) {
					
					$item = explode("|",$item);
					$item[0] = esc_html($item[0]);
					
					$checked = '';
					
					if ( isset($options[$id][$item[1]]) ) {
						if ( $options[$id][$item[1]] == 'true') {
							$checked = 'checked="checked"';
						}
					}
					
					echo "<label for='$id|$item[1]' class='checkbox-label'><input class='checkbox$field_class' type='checkbox' id='$id|$item[1]' name='" . $gp_options_name . "[$id|$item[1]]' value='1' $checked />$item[0]</label>";
					
				}
				
				echo "</td>";
				echo "<td>";
				echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
				
			break;
			
		}
	}

}

/*
====================================================================================================
Fields Validation
====================================================================================================
*/

if (!function_exists('gp_options_validate')) {

	function gp_options_validate($input) {
		
		$valid_input = array();
		
		$gp_options_settings_output = gp_options_settings();
		$options = $gp_options_settings_output['gp_options_fields'];
		
		foreach ($options as $option) {
			switch ($option['type']) {
				
				// Input
				case 'input':
					switch (isset($option['class'])) {
						
						// Numeric Input
						case 'numeric':
							
							$input[$option['id']] = trim($input[$option['id']]);
							$valid_input[$option['id']] = (is_numeric($input[$option['id']])) ? $input[$option['id']] : 'Expecting a Numeric value!';
							
							if (is_numeric($input[$option['id']]) == FALSE) {
								add_settings_error($option['id'], GP_SHORTNAME . '_txt_numeric_error', __('Expecting a Numeric value! Please fix.', 'gp'), 'error');
							}
							
						break;
						
						// Multi-numeric Input (Saparated by Comma)
						case 'multi-numeric':
						
							$input[$option['id']] = trim($input[$option['id']]);
							
							if ($input[$option['id']] != '') {
								$valid_input[$option['id']] = (preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) == 1) ? $input[$option['id']] : __('Expecting comma separated numeric values', 'gp');
							} else {
								$valid_input[$option['id']] = $input[$option['id']];
							}
							
							if ($input[$option['id']] !='' && preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) != 1) {
								add_settings_error($option['id'], GP_SHORTNAME . '_txt_multinumeric_error', __('Expecting comma separated numeric values! Please fix.', 'gp'), 'error');
							}
							
						break;
						
						// No-HTML
						case 'no-html':
						
							$input[$option['id']] = sanitize_text_field($input[$option['id']]);
							$valid_input[$option['id']] = addslashes($input[$option['id']]);
							
						break;
						
						// URL
						case 'url':
						
							$input[$option['id']] = trim($input[$option['id']]);
							$valid_input[$option['id']] = esc_url_raw($input[$option['id']]);
							
						break;
						
						// Email
						case 'email':
							
							$input[$option['id']] = trim($input[$option['id']]);
							
							if ($input[$option['id']] != '') {
								$valid_input[$option['id']] = (is_email($input[$option['id']])!== FALSE) ? $input[$option['id']] : __('Invalid email! Please re-enter!', 'gp');
							} else if ($input[$option['id']] == '') {
								$valid_input[$option['id']] = __('This setting field cannot be empty! Please enter a valid email address.', 'gp');
							}
							
							if (is_email($input[$option['id']])== FALSE || $input[$option['id']] == '') {
								add_settings_error($option['id'], GP_SHORTNAME . '_txt_email_error', __('Please enter a valid email address.', 'gp'), 'error');
							}
							
						break;
						
						// Default
						default:
						
							$allowed_html = array(
								'a' => array('href' => array (),'title' => array ()),
								'b' => array(),
								'em' => array (), 
								'i' => array (),
								'strong' => array()
							);
							
							$input[$option['id']] = trim($input[$option['id']]);
							$input[$option['id']] = force_balance_tags($input[$option['id']]);
							$input[$option['id']] = wp_kses( $input[$option['id']], $allowed_html);
							$valid_input[$option['id']] = addslashes($input[$option['id']]); 
						
						break;
	
					}
	
				break;
				
				// Input with Color Picker
				case 'input-picker':
					
					$input[$option['id']] = trim($input[$option['id']]);
					$valid_input[$option['id']] = addslashes($input[$option['id']]);
	
				break;
				
				// Input with Upload Button
				case 'input-upload':
				
					$input[$option['id']] = trim($input[$option['id']]);
					$valid_input[$option['id']] = addslashes($input[$option['id']]);
	
				break;
				
				// Input Group
				case "input-group":
				
					unset($textarray);
					
					$text_values = array();
					foreach ($option['choices'] as $k => $v) {
						$pieces = explode("|", $v);
						$text_values[] = $pieces[1];
					}
					
					foreach ($text_values as $v) {		
						
						if (!empty($input[$option['id'] . '|' . $v])) {
							switch ($option['class']) {
								
								// Numeric
								case 'numeric':
								
									$input[$option['id'] . '|' . $v]= trim($input[$option['id'] . '|' . $v]);
									$input[$option['id'] . '|' . $v]= (is_numeric($input[$option['id'] . '|' . $v])) ? $input[$option['id'] . '|' . $v] : '';
								
								break;
								
								// Default
								default:
								
									$input[$option['id'] . '|' . $v]= sanitize_text_field($input[$option['id'] . '|' . $v]);
									$input[$option['id'] . '|' . $v]= addslashes($input[$option['id'] . '|' . $v]);
								
								break;
								
							}
							
							$textarray[$v] = $input[$option['id'] . '|' . $v];
						
						} else {
							
							$textarray[$v] = '';
							
						}
					}
	
					if (!empty($textarray)) {
						$valid_input[$option['id']] = $textarray;
					}
	
				break;
				
				// Textarea
				case 'textarea':
					switch ( $option['class'] ) {
						
						// Inline HTML
						case 'inline-html':
						
							$input[$option['id']] = trim($input[$option['id']]);
							$input[$option['id']] = force_balance_tags($input[$option['id']]);
							$input[$option['id']] = addslashes($input[$option['id']]);
							$valid_input[$option['id']] = wp_filter_kses($input[$option['id']]);
						
						break;
						
						// No HTML
						case 'no-html':
						
							$input[$option['id']] = sanitize_text_field($input[$option['id']]);
							$valid_input[$option['id']] = addslashes($input[$option['id']]);
						
						break;
						
						// Allow Line Breaks
						case 'allowlinebreaks':
						
							$input[$option['id']] 		= wp_strip_all_tags($input[$option['id']]);
							$valid_input[$option['id']]	= addslashes($input[$option['id']]);
							
						break;
						
						// Default
						default:
	
							$allowed_html = array(
								'a'				=> array('href' => array(), 'title' => array(), 'target' => array()),
								'b'				=> array(),
								'blockquote'	=> array('cite' => array()),
								'br'			=> array(),
								'dd'			=> array(),
								'dl'			=> array(),
								'dt'			=> array(),
								'em'			=> array(), 
								'i'				=> array(),
								'li'			=> array(),
								'ol'			=> array(),
								'p'				=> array(),
								'q'				=> array('cite' => array()),
								'strong'		=> array(),
								'ul'			=> array(),
								'h1'			=> array('align' => array(), 'class' => array(), 'id' => array(), 'style' => array()),
								'h2'			=> array('align' => array(), 'class' => array(), 'id' => array(), 'style' => array()),
								'h3'			=> array('align' => array(), 'class' => array(), 'id' => array(), 'style' => array()),
								'h4'			=> array('align' => array(), 'class' => array(), 'id' => array(), 'style' => array()),
								'h5'			=> array('align' => array(), 'class' => array(), 'id' => array(), 'style' => array()),
								'h6'			=> array('align' => array(), 'class' => array(), 'id' => array(), 'style' => array()),
								'script'		=> array('type' => array())
							);
							
							$input[$option['id']] 		= trim($input[$option['id']]);
							$input[$option['id']] 		= force_balance_tags($input[$option['id']]);
							$input[$option['id']] 		= wp_kses( $input[$option['id']], $allowed_html);
							$valid_input[$option['id']] = addslashes($input[$option['id']]);		
												
						break;
						
					}
					
				break;
				
				// Select
				case 'select-number':
	
					$valid_input[$option['id']] = (in_array( $input[$option['id']], $option['choices']) ? $input[$option['id']] : '');
	
				break;
				
				// Select 2
				case 'select-text':
	
					$select_values = array();
					foreach ($option['choices'] as $k => $v) {
						$pieces = explode("|", $v);							
						$select_values[] = $pieces[1];
					}
						
					$valid_input[$option['id']] = (in_array( $input[$option['id']], $select_values) ? $input[$option['id']] : '' );
	
				break;
				
				// Checkbox				
				case 'checkbox':
	
					if (!isset($input[$option['id']])) {
						$input[$option['id']] = null;
					}
	
					$valid_input[$option['id']] = ($input[$option['id']] == 1 ? 1 : 0);
	
				break;
				
				// Checkbox Group
				case 'checkbox-group':
				
					unset($checkboxarray);
					$check_values = array();
					foreach ($option['choices'] as $k => $v) {
						$pieces = explode("|", $v);
						$check_values[] = $pieces[1];
					}
					
					foreach ($check_values as $v) {		
						if (!empty($input[$option['id'] . '|' . $v])) {
							$checkboxarray[$v] = 'true';
						} else {
							$checkboxarray[$v] = 'false';
						}
					}
	
					if (!empty($checkboxarray)) {
						$valid_input[$option['id']] = $checkboxarray;
					}
	
				break;
				
			}
		}
			
		return $valid_input;
		
	}

}

/*
====================================================================================================
Admin Notices
====================================================================================================
*/

// Show Notices
if (!function_exists('gp_options_show_notices')) {

	function gp_options_show_notices($message, $message_class = 'info') {
		
		echo "<div id='message' class='$message_class'>$message</div>";
		
	}

}

// Notices
if (!function_exists('gp_options_admin_notices')) {

	function gp_options_admin_notices() {
		
		$page = isset($_GET['page']) ? $_GET['page'] : NULL;
		$gp_options_settings_page = strpos($page, GP_BASENAME);
		$set_errors = get_settings_errors(); 
		
		if (current_user_can('edit_theme_options') && $gp_options_settings_page !== FALSE && !empty($set_errors)) {
			if ($set_errors[0]['code'] == 'settings_updated' && isset($_GET['settings-updated'])) {
				gp_options_show_notices("<p>" . $set_errors[0]['message'] . "</p>", 'updated');
			} else {
				foreach ($set_errors as $set_error) {
					gp_options_show_notices("<p class='setting-error-message' title='" . $set_error['setting'] . "'>" . $set_error['message'] . "</p>", 'error');
				}
			}
		}
		
	}
	
	add_action('admin_notices', 'gp_options_admin_notices');

}

/*
====================================================================================================
Settings Sections
====================================================================================================
*/

if (!function_exists('gp_do_settings_sections')) {

	function gp_do_settings_sections($page) {
		global $wp_settings_sections, $wp_settings_fields;
	
		if (!isset($wp_settings_sections) || !isset($wp_settings_sections[$page])) {
			return;
		}
		
		$tab_count = 1;
	
		foreach ((array) $wp_settings_sections[$page] as $section) {
			if ($section['title']) {
				call_user_func($section['callback'], $section);
				if (!isset($wp_settings_fields) || !isset($wp_settings_fields[$page]) || !isset($wp_settings_fields[$page][$section['id']])) {
					continue;
				}
				?>
				
				<div id="tab<?php echo $tab_count; ?>" class="clearfix">
				
					<h2 class="section-heading"><?php echo $section['title'];?></h2>
					
					<table class="form-table clearfix">
				
						<?php gp_do_settings_fields($page, $section['id']); ?>
					
					</table>
					
				</div>
	
				<?php
				$tab_count++;
			}
		}
	}
		
	add_filter('do_settings_sections', 'gp_do_settings_sections');

}

/*
====================================================================================================
Settings Fields
====================================================================================================
*/

if (!function_exists('gp_do_settings_fields')) {

	function gp_do_settings_fields($page, $section) {
		global $wp_settings_fields;
	
		if (!isset($wp_settings_fields) || !isset($wp_settings_fields[$page]) || !isset($wp_settings_fields[$page][$section])) {
			return;	
		}
	
		foreach ((array) $wp_settings_fields[$page][$section] as $field) {
			
			if (!empty($field['args']['label_for']) && $field['args']['type'] != 'heading') {
				
				echo '<tr class="subsection-field">';	
				echo '<th scope="row"><label for="' . $field['args']['label_for'] . '">' . $field['title'] . '</label></th>';
				echo '<td>';
				call_user_func($field['callback'], $field['args']);
				echo '</td>';
				echo '</tr>';
				
			} else if ($field['args']['type'] === 'heading') {
				
				if (!empty($field['args']['desc'])) {
					echo '<tr class="subsection-heading with-description">';
				} else {
					echo '<tr class="subsection-heading">';
				}
				
				echo '<td colspan="3"><h3>' . $field['title'] . '</h3></td>';
				echo '</tr>';
				call_user_func($field['callback'], $field['args']);
				
			}
			
		}
	}
	
	add_filter('do_settings_fields', 'gp_do_settings_fields');

}

/*
====================================================================================================
Add Settings Page
====================================================================================================
*/

if (!function_exists('gp_options_settings_page')) {

function gp_options_settings_page() {

		$gp_options_settings_output = gp_options_settings();
	?>
	
		<div class="gp-theme-options wrap">
		
			<form action="options.php" method="post">
			
				<div id="gp-tabs" class="gp-tabs">
			
					<div class="gp-header">
					
						<div class="gp-header-container">
							<h2><?php echo $gp_options_settings_output['gp_options_title']; ?></h2>
						</div><!-- gp-header-container -->
					
					</div><!-- gp-header -->
					
					<div class="gp-tabs">
						<div class="gp-tabs-container">
							<div class="gp-tabs-insider">
							
								<ul>
									<?php
									$tab_number = 1;
									foreach($gp_options_settings_output['gp_options_sections'] as $section) {
									?>
									
										<li><a href="#tab<?php echo $tab_number; ?>"><?php echo $section; ?></a></li>
										
									<?php
									$tab_number++;
									}
									?>
								</ul>
								
							</div><!-- gp-tabs-insider -->
						</div><!-- gp-tabs-container -->
					</div><!-- gp-tabs -->
					
					<div class="gp-content">
						<div class="gp-content-container">
							<div class="gp-content-insider">
	
								<?php
								settings_fields($gp_options_settings_output['gp_options_name']); // This should match the group name used in register_setting(). 
								gp_do_settings_sections(__FILE__); 
								?>
	
								<div class="gp-save">
									<div class="gp-save-container clearfix">
										<?php submit_button(); ?>
										<div class="gp-version"><?php echo __('Version ', 'gp') . GP_VERSION; ?></div>
									</div><!-- gp-save-container -->
								</div><!-- gp-save -->
					
							</div><!-- gp-content-insider -->    
						</div><!-- gp-content-container -->
					</div><!-- gp-content -->
				</div><!-- gp-tabs -->
				
			</form>
			
		</div><!-- gp-theme-admin -->
		
	<?php 
	}

}

?>