<?php

/*

@name			GPanel Functions Init
@package		GPanel WordPress Framework
@since			3.0.1
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Backend Options
====================================================================================================
*/

if (!function_exists('gp_backend_init')) {

    function gp_backend_init() {
        
        // Get theme and framework info
        $data = get_option('gpanel_options');
        
        if (function_exists('wp_get_theme')) {
            
            if (is_child_theme()) {
                
                $temp_data  = wp_get_theme();
                $theme_data = wp_get_theme($temp_data->get('Template'));
                
            } else {
                
                $theme_data = wp_get_theme();
                   
            }
            
            $data['theme_name']     = $theme_data->get('Name');
            $data['theme_version']  = $theme_data->get('Version');
            
        }
    
        update_option('gpanel_options', $data);
        
        // Incase it is first install and option doesn't exist
        $gpanel_values = get_option('gpanel_values');
        
        if(!is_array($gpanel_values)) {
            
            update_option('gpanel_values', array());
            
        }
        
    }
    
    add_action('init', 'gp_backend_init', 2);

}

/*
====================================================================================================
Backend Scripts
====================================================================================================
*/

if (!function_exists('gp_backend_scripts')) {

	function gp_backend_scripts() {
		global $wp_version;

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		
		if ($wp_version < 3.5) {
			
			// Enqueue Upload for WordPress 3.4 and lower
			wp_register_script('gp-upload', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.upload.js', array('jquery', 'media-upload', 'thickbox'), GP_VERSION, true);
			wp_enqueue_script('gp-upload');
			
		} else {
			
			// Enqueue Media
			if (!did_action('wp_enqueue_media')) {
   				wp_enqueue_media();	
			}
			// Enqueue Upload for WordPress 3.5 and higher
			wp_register_script('gp-upload-3.5', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.upload.3.5.js', array('jquery', 'media-upload', 'thickbox'), GP_VERSION, true);
			wp_enqueue_script('gp-upload-3.5');
		
		}
		
		// Plupload
		wp_enqueue_script('plupload-all');

		// Color Picker
		wp_register_script('gp-colorpicker', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.colorpicker.js', 'jquery', GP_VERSION, true);
		wp_enqueue_script('gp-colorpicker');
		
		// Cookie
		wp_register_script('gp-cookie', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.cookie.min.js', 'jquery', GP_VERSION, true);
		wp_enqueue_script('gp-cookie');
        
		// Custom
		wp_register_script('gp-backend', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.backend.js', 'jquery', GP_VERSION, true);
		wp_enqueue_script('gp-backend');
		
	}
	
	add_action('admin_enqueue_scripts', 'gp_backend_scripts');

}

// Datepicker Scripts for Event
if (!function_exists('gp_backend_datepicker_scripts')) {

	function gp_backend_datepicker_scripts() {
		global $post_type;
		
		if (empty($post_type) && !empty($_GET['post'])) {
			$post = get_post($_GET['post']);
			$post_type = $post->post_type;
		}
	
		if ($post_type == 'event' || $post_type == 'album') {
		?>
		
			<script type="text/javascript">
			//<![CDATA[
				jQuery(document).ready(function() {
	
					jQuery(".gp-datepicker").datepicker({ 
						firstDay: 1,
						dateFormat: "yy/mm/dd",
						dayNames: [
							'<?php _e('Sunday', 'gp'); ?>',
							'<?php _e('Monday', 'gp'); ?>',
							'<?php _e('Tuesday', 'gp'); ?>',
							'<?php _e('Wednesday', 'gp'); ?>',
							'<?php _e('Thursday', 'gp'); ?>',
							'<?php _e('Friday', 'gp'); ?>',
							'<?php _e('Saturday', 'gp'); ?>'
						],
						dayNamesMin: [
							'<?php _e('Su', 'gp'); ?>',
							'<?php _e('Mo', 'gp'); ?>',
							'<?php _e('Tu', 'gp'); ?>',
							'<?php _e('We', 'gp'); ?>',
							'<?php _e('Th', 'gp'); ?>',
							'<?php _e('Fr', 'gp'); ?>',
							'<?php _e('Sa', 'gp'); ?>'
						],
						monthNames: [
							'<?php _e('January', 'gp'); ?>',
							'<?php _e('February', 'gp'); ?>',
							'<?php _e('March', 'gp'); ?>',
							'<?php _e('April', 'gp'); ?>',
							'<?php _e('May', 'gp'); ?>',
							'<?php _e('June', 'gp'); ?>',
							'<?php _e('July', 'gp'); ?>',
							'<?php _e('August', 'gp'); ?>',
							'<?php _e('September', 'gp'); ?>',
							'<?php _e('October', 'gp'); ?>',
							'<?php _e('November', 'gp'); ?>',
							'<?php _e('December', 'gp'); ?>'
						],
						nextText: '<?php _e('Next', 'gp'); ?>',
						prevText: '<?php _e('Prev', 'gp'); ?>'
					});
				});
			//]]>
			</script>
	
		<?php
		}
		
	}
	
	add_action('admin_print_footer_scripts', 'gp_backend_datepicker_scripts');

}

/*
====================================================================================================
Backend Styles
====================================================================================================
*/

if (!function_exists('gp_backend_styles')) {

	function gp_backend_styles() {
		
		// Thickbox Stylesheet
		wp_enqueue_style('thickbox');
		
		// Core Backend Stylesheet
		wp_enqueue_style('gp-style', trailingslashit(get_template_directory_uri()) . 'backend/styles/style.min.css');
		
		// Widget Stylesheet
		wp_enqueue_style('gp-style-widget', trailingslashit(get_template_directory_uri()) . 'backend/styles/style-widget.min.css');
		
		// Metabox Stylesheet
		wp_enqueue_style('gp-style-metabox', trailingslashit(get_template_directory_uri()) . 'backend/styles/style-metabox.min.css');
		
		// Components Stylesheet
		wp_enqueue_style('gp-style-components', trailingslashit(get_template_directory_uri()) . 'backend/styles/style-components.min.css');
		
		// Open Sans Condensed [Google Font API]
		wp_enqueue_style('gp-style-font-opensanscondensed', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic&subset=latin,cyrillic-ext,greek-ext,latin-ext,cyrillic,greek,vietnamese');
		
	}
	
	add_action('admin_print_styles', 'gp_backend_styles');

}

/*
====================================================================================================
Theme Customizer
====================================================================================================
*/

if (!function_exists('gp_theme_customize_register')) {

	function gp_theme_customize_register($wp_customize) {
	
		/*
		--------------------------------------------------
		Add Sections
		--------------------------------------------------
		*/
		
		// Colors
		$wp_customize->add_section('colors', array(
			'title'			=> __('Colors', 'gp'),
			'priority'		=> 30
		));
		
		/*
		--------------------------------------------------
		Add Settings
		--------------------------------------------------
		*/
        
        // Background Color
        $wp_customize->add_setting('gp_color_background', array(
            'default'		=> '#2d1912',
            'transport'		=> 'refresh'
        ));
        
        // Text Color
        $wp_customize->add_setting('gp_color_text', array(
            'default'		=> '#ffffff',
            'transport'		=> 'refresh'
        ));
        
        // Primary Color
        $wp_customize->add_setting('gp_color_primary', array(
            'default'		=> '#d2462d',
            'transport'		=> 'refresh'
        ));
        
        // Secondary Color
        $wp_customize->add_setting('gp_color_secondary', array(
            'default'		=> '#2e8489',
            'transport'		=> 'refresh'
        ));
        
        // Tertiary Color
        $wp_customize->add_setting('gp_color_tertiary', array(
            'default'		=> '#4f241c',
            'transport'		=> 'refresh'
        ));
        
        // Navigation Primary Color
        $wp_customize->add_setting('gp_color_navigation_primary', array(
            'default'		=> '#d2462d',
            'transport'		=> 'refresh'
        ));
        
        // Navigation Secondary Color
        $wp_customize->add_setting('gp_color_navigation_secondary', array(
            'default'		=> '#2e8489',
            'transport'		=> 'refresh'
        ));
		
		/*
		--------------------------------------------------
		Add Controls
		--------------------------------------------------
		*/
        
        // Background Color
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_backround', array(
                    'label'			=> __('Background Color', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_background',
                    'priority'		=> 1
                )
            )
        );
        
        // Text Color
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_text', array(
                    'label'			=> __('Text Color', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_text',
                    'priority'		=> 10
                )
            )
        );
		
		// Primary Color
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_primary', array(
                    'label'			=> __('Primary Color', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_primary',
                    'priority'		=> 11
                )
            )
        );
		
		// Secondary Color
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_secondary', array(
                    'label'			=> __('Secondary Color', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_secondary',
                    'priority'		=> 12
                )
            )
        );
		
		// Tertiary Color
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_tertiary', array(
                    'label'			=> __('Tertiary Color', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_tertiary',
                    'priority'		=> 13
                )
            )
        );
        
        // Navigation Primary Color
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_navigation_primary', array(
                    'label'			=> __('Navigation Primary Color', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_navigation_primary',
                    'priority'		=> 14
                )
            )
        );
        
        // Navigation Secondary Color
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_navigation_secondary', array(
                    'label'			=> __('Navigation Secondary Color', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_navigation_secondary',
                    'priority'		=> 15
                )
            )
        );
	
	}
	
	add_action('customize_register', 'gp_theme_customize_register');

}

/*
====================================================================================================
Add Appearance Links
====================================================================================================
*/

// Add Support Link
if (!function_exists('gp_appearance_support_link')) {

	function gp_appearance_support_link() {
	
		add_theme_page( 
			esc_html__('Theme Support', 'gp'),
			esc_html__('Theme Support', 'gp'),
			'edit_theme_options',
			'gp-support',
			'gp_init_support'
		);
		
	}
	
	add_action('admin_menu', 'gp_appearance_support_link', 10);

}

// Add Documentation Link
if (!function_exists('gp_appearance_documentation_link')) {

	function gp_appearance_documentation_link() {
	
		add_theme_page( 
			esc_html__('Theme Docs', 'gp'),
			esc_html__('Theme Docs', 'gp'),
			'edit_theme_options',
			'gp-documentation',
			'gp_init_documentation'
		);
		
	}
	
	add_action('admin_menu', 'gp_appearance_documentation_link', 10);

}

/*
====================================================================================================
Add Featured Image Description
====================================================================================================
*/

if (!function_exists('gp_featured_image_description')) {

	function gp_featured_image_description($content) {
		
		$content .= '<p>';
		$content .= __('The Featured Image is an image that is chosen as the representative image for the post. Click the link above to upload the image for this post.', 'gp');
		$content .= '</p>';
		
		return $content;
		
	}
	
	add_filter('admin_post_thumbnail_html', 'gp_featured_image_description');

}

/*
====================================================================================================
Remove "View" Button for slides, callouts
====================================================================================================
*/

if (!function_exists('gp_posttype_admin_css')) {

    function gp_posttype_admin_css() {
        global $post_type;
        
        if ($post_type == 'slide' || $post_type == 'callout') {
            ?>
            <style type="text/css" media="screen">
                #view-post-btn, #preview-action .preview.button { display: none; }
            </style>
            <?php
        }
    
    }
    
    add_action('admin_head', 'gp_posttype_admin_css');

}

/*
====================================================================================================
Slug
====================================================================================================
*/

function gp_slug($str) {
	
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	return $str;
	
}

/*
====================================================================================================
Add WP Login Logo
====================================================================================================
*/

if (!function_exists('gp_custom_login_logo')) {

	function gp_custom_login_logo() {
	
		if (gp_option('gp_image_login_logo')) {
		?>
	
            <style type="text/css">
                #login h1 a {
                    background-image: url("<?php echo gp_option('gp_image_login_logo'); ?>") !important;
                    background-size: 274px 100px;
                    height: 100px;
                }
            </style>
		
		<?php
		}
	}
	
	add_action('login_head', 'gp_custom_login_logo');

}

/*
====================================================================================================
Remove WordPress Version to Increase Security
====================================================================================================
*/

if (!function_exists('gp_kill_wp_version')) {

	function gp_kill_wp_version() {
		
		return '';
		
	}
	
	add_filter('the_generator', 'gp_kill_wp_version');

}

/*
====================================================================================================
Browser Body Class
====================================================================================================
*/

if (!function_exists('gp_body_class')) {

	function gp_body_class($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
		if ($is_lynx) { 
			$classes[] = 'lynx';
		} else if ($is_gecko) {
			$classes[] = 'gecko';
		} else if ($is_opera) {
			$classes[] = 'opera';
		} else if ($is_NS4) {
			$classes[] = 'ns4';
		} else if ($is_safari) {
			$classes[] = 'safari';
		} else if ($is_chrome) {
			$classes[] = 'chrome';
		} else if ($is_IE) {
			$classes[] = 'ie';
		} else {
			$classes[] = 'unknown';
		}
		
		if ($is_iphone) {
			$classes[] = 'iphone';
		}
		
		return $classes;
		
	}
	
	add_filter('body_class', 'gp_body_class');

}

/*
====================================================================================================
Remove Page Templates from Select
====================================================================================================
*/

if (!function_exists('gp_remove_page_template')) {
    
    function gp_remove_page_template() {
        global $pagenow;
        
        if (in_array( $pagenow, array('post-new.php', 'post.php', 'edit.php')) && get_post_type() == 'page' ) {
        ?>
            
                <script type="text/javascript">
                    
                    jQuery(document).ready(function(){
                        
                        <?php if (gp_option('gp_menus_type') == 'old') { ?>
                            
                            jQuery('select[name="page_template"]  option[value="template-menu.php"]').remove();
                            
                            jQuery('select[name="page_template"]  option[value="template-menu-all.php"]').remove();
                            
                        <?php } else { ?>
                            
                            jQuery('select[name="page_template"] option[value="template-menu-food.php"]').remove();
                            jQuery('select[name="page_template"] option[value="template-menu-breakfast.php"]').remove();
                            jQuery('select[name="page_template"] option[value="template-menu-lunch.php"]').remove();
                            jQuery('select[name="page_template"] option[value="template-menu-dinner.php"]').remove();
                            jQuery('select[name="page_template"] option[value="template-menu-drink.php"]').remove();
                            jQuery('select[name="page_template"] option[value="template-menu-wine.php"]').remove();
                            
                            jQuery('select[name="page_template"] option[value="template-menu-food-all.php"]').remove();
                            jQuery('select[name="page_template"] option[value="template-menu-breakfast-all.php"]').remove();
                            jQuery('select[name="page_template"] option[value="template-menu-lunch-all.php"]').remove();
                            jQuery('select[name="page_template"] option[value="template-menu-dinner-all.php"]').remove();
                            jQuery('select[name="page_template"] option[value="template-menu-drink-all.php"]').remove();
                            jQuery('select[name="page_template"] option[value="template-menu-wine-all.php"]').remove();
                        
                        <?php } ?>
                        
                    });
                    
                </script>
    
        <?php
        }
    }
    
    add_action('admin_footer', 'gp_remove_page_template', 10);
    
}

/*
====================================================================================================
Flush Rewrite
====================================================================================================
*/

if (!function_exists('gp_rewrite_flush')) {

    function gp_rewrite_flush() {
        
        flush_rewrite_rules();
        
    }
    
    add_action('after_switch_theme', 'gp_rewrite_flush');
    
}

/*
====================================================================================================
Add Translation Text Domain
====================================================================================================
*/

if (!function_exists('gp_textdomain')) {

	function gp_textdomain() {
			
		load_theme_textdomain('gp', trailingslashit(get_template_directory()) . 'languages');
		
	}
	
	add_action('after_setup_theme', 'gp_textdomain');

}

?>