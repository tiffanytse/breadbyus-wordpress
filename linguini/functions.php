<?php

/*

@name			Theme Functions
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/ 

/*
====================================================================================================
Frontend Setup
====================================================================================================
*/

if (!function_exists('gp_frontend_setup')) {

	function gp_frontend_setup() {
		
		// Add Post Thumbnails Support
		add_theme_support('post-thumbnails');
		
		// Add Automatic Feed Links Support
		add_theme_support('automatic-feed-links');
		
		// Editor Stylesheet
		add_editor_style('backend/styles/style-editor.min.css');
		
		// WooCommerce Support
		add_theme_support('woocommerce');
		
		// WooCommerce Default Colors
		if (function_exists('woocommerce_compile_less_styles')) {
            
            $default_colors = get_option('woocommerce_frontend_css_colors');

            if (!$default_colors || !$default_colors['primary'] || $default_colors['primary'] == '#ad74a2') {
                
                update_option('woocommerce_frontend_css_colors', array(
                    'primary'           => get_theme_mod('gp_color_secondary'),
                    'secondary'         => get_theme_mod('gp_color_primary'),
                    'highlight'         => get_theme_mod('gp_color_secondary'),
                    'content_bg'        => get_background_color(),
                    'subtext'           => get_theme_mod('gp_color_text'),
                ));
                
                woocommerce_compile_less_styles();
                
            }
        }
		
	}
	
	add_action('after_setup_theme', 'gp_frontend_setup');

}

/*
====================================================================================================
Add Custom Hooks
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Meta Head Hook
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_meta_head')) {

	function gp_meta_head() { 
	
		do_action('gp_meta_head');
	
	}

}

/*
----------------------------------------------------------------------------------------------------
Footer Hook
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_footer')) {

	function gp_footer() { 
	
		do_action('gp_footer');
	
	}

}

/*
----------------------------------------------------------------------------------------------------
Submit Before Hook
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_submit_before')) {

	function gp_submit_before() { 
	
		do_action('gp_submit_before');
	
	}

}

/*
====================================================================================================
Add Thumbnail Sizes
====================================================================================================
*/

// Thumbnails > Post Thumbnail Size
set_post_thumbnail_size(1180, '');

// Thumbnails > Default
add_image_size('thumbnail', 120, '', true);
add_image_size('thumbnail-fixed', 120, 90, true);

add_image_size('small', 480, '', true);
add_image_size('small-fixed', 480, 240, true);

add_image_size('medium', 750, '', true);
add_image_size('medium-fixed', 750, 425, true);

add_image_size('large', 1180, '', true);
add_image_size('large-fixed', 1180, 680, true);
add_image_size('large-wide', 1180, 300, true);

/*
====================================================================================================
Frontend Scripts
====================================================================================================
*/

if (!function_exists('gp_frontend_scripts')) {

    function gp_frontend_scripts() {
        
        if (!is_admin()) {
        
            // jQuery
			wp_enqueue_script('jquery');
            
            // jQuery UI
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-tabs');
            
            // Homepage Scripts
            if (is_page_template('template-home.php')) {
                
                // jQuery Easing
                wp_register_script('gp-easing', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.easing.min.js', array('jquery'), '1.3', true);
                wp_enqueue_script('gp-easing');
                
                // jQuery RoyalSlider
                wp_register_script('gp-slider', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.royalslider.min.js', array('jquery', 'gp-easing'), '9.5.0', true);
                wp_enqueue_script('gp-slider');
            
            }
            
            // Reservation Scripts
            if (is_page_template('template-reservation.php')) {
            
                wp_enqueue_script('jquery-ui-datepicker');
            
            }
            
            // jQuery Isotope
            wp_register_script('gp-isotope', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.isotope.min.js', array('jquery'), '1.5.21', true);
            wp_enqueue_script('gp-isotope');
            
            // jQuery Image Loader
            wp_register_script('gp-loadimages', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.loadimages.min.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('gp-loadimages');
            
            // jQuery FitVids
            wp_register_script('gp-fitvids', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.fitvids.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('gp-fitvids');
            
            // jQuery jPlayer
            wp_register_script('gp-jplayer', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.jplayer.min.js', array('jquery'), '2.4.1', true);
            wp_enqueue_script('gp-jplayer');
            
            // jQuery jPlayer Playlist
            wp_register_script('gp-jplayer-playlist', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.jplayer.playlist.min.js', array('jquery', 'gp-jplayer'), '2.3.0', true);
            wp_enqueue_script('gp-jplayer-playlist');
            
            // jQuery Backstretch
            wp_register_script('gp-backstretch', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.backstretch.min.js', array('jquery'), '2.0.4', true);
            wp_enqueue_script('gp-backstretch');
            
            // jQuery Respond
            wp_register_script('gp-respond', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.respond.min.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('gp-respond');
            
            // jQuery Lightbox
            wp_register_script('gp-lightbox', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.touchtouch.min.js', array('jquery'), '1.1.1', true);
            wp_enqueue_script('gp-lightbox');
            
            // Contact & Reservation Scripts
            if (is_page_template('template-contact.php') || is_page_template('template-reservation.php')) {

                // jQuery Validate
                wp_register_script('gp-validate', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.validate.min.js', array('jquery'), '1.11.1', true);
                wp_enqueue_script('gp-validate');
            
            }
            
            // jQuery Frontend
            wp_register_script('gp-frontend', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.frontend.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('gp-frontend');
            
        }
        
        if (is_singular() && get_option('thread_comments') && comments_open()) { 
            
            // Comment Reply JavaScript
            wp_enqueue_script('comment-reply'); 
            
        }
        
    }
    
    add_action('wp_enqueue_scripts', 'gp_frontend_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Homepage
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_homepage_scripts')) {

    function gp_frontend_homepage_scripts() {
    
        if (is_page_template('template-home.php')) {
        
            // Variables
			if (gp_option('gp_slideshow_loop') == 'true') {
				$loop = 'true';
			} else {
				$loop = 'false';
			}
            if (gp_option('gp_slideshow_nav') == 'false') {
                $arrowsnav = 'false';
            } else {
                $arrowsnav = 'true';
            }
            if (gp_option('gp_slideshow_nav_autohide') == 'true') {
                $arrowsnavautohide = 'true';
            } else {
                $arrowsnavautohide = 'false';
            }
            if (gp_option('gp_slideshow_nav_touch') == 'true') {
                $arrowsnavhideontouch = 'true';
            } else {
                $arrowsnavhideontouch = 'false';
            }
            if (gp_option('gp_slideshow_drag') == 'false' || wp_count_posts('slide')->publish == 1) {
                $sliderdrag = 'false';
            } else {
                $sliderdrag = 'true';
            }
            if (gp_option('gp_slideshow_touch') == 'false' || wp_count_posts('slide')->publish == 1) {
                $slidertouch = 'false';
            } else {
                $slidertouch = 'true';
            }
            if (gp_option('gp_slideshow_nav_by_click') == 'false' || wp_count_posts('slide')->publish == 1) {
                $navigatebyclick = 'false';
            } else {
                $navigatebyclick = 'true';
            }
            if (gp_option('gp_slideshow_transition_type')) {
                $transitiontype = gp_option('gp_slideshow_transition_type');
            } else {
                $transitiontype = 'move';
            }
            if (gp_option('gp_slideshow_slides_orientation')) {
                $slidesorientation = gp_option('gp_slideshow_slides_orientation');
            } else {
                $slidesorientation = 'horizontal';
            }
            if (is_numeric(gp_option('gp_slideshow_transition_speed'))) {
                $transitionspeed = gp_option('gp_slideshow_transition_speed');
            } else {
                $transitionspeed = '1000';
            }
            if (gp_option('gp_slideshow_autoplay') == 'true') {
                $autoplay = 'true';
            } else {
                $autoplay = 'false';
            }
            if (is_numeric(gp_option('gp_slideshow_delay'))) {
                $delay = gp_option('gp_slideshow_delay');
            } else {
                $delay = '5000';
            }
            
            if (get_posts('post_type=slide')) {
            ?>
        
                <script type="text/javascript">
                
                    //<![CDATA[
                    
                        function slideshowHeight() {
                                
                            var window_height = jQuery(window).height(),
                                toolbar_shop_height = jQuery('.toolbar-shop').height(),
                                header_height = jQuery('.header').height(),
                                navigation_height = jQuery('.navigation').height(),
                                slideshow_height = window_height - toolbar_shop_height - header_height - navigation_height,
                                slideshow_height_device = '500';
                            
                            jQuery('.slideshow').css('height', slideshow_height);
                            
                        }
                        
                        function calloutMargin() {
                            
                            if ((jQuery(window).width() > 480)) {
                                jQuery('.grid-callout-home .post').each(
                                    function () {
                                        var post_header_height = jQuery(this).find('.post-header').height();
                                        jQuery(this).css('margin-top', - post_header_height);
                                    }
                                );
                            } else {
                                jQuery('.grid-callout-home .post').each(
                                    function () {
                                        jQuery(this).css('margin-top', '2em');
                                    }
                                );
                            }
                            
                        }
                        
                        jQuery(document).ready(slideshowHeight);
                        jQuery(window).resize(slideshowHeight);
                        
                        jQuery(document).ready(calloutMargin);
                        jQuery(window).resize(calloutMargin);
                        
                    
                        jQuery(document).ready(function () {
                            "use strict";
    
                            // Slideshow
                            jQuery('.slideshow-container').royalSlider({
                                loop: <?php echo $loop; ?>,
                                keyboardNavEnabled: true,
                                controlsInside: false,
                                imageScaleMode: 'fill',
                                arrowsNav: <?php echo $arrowsnav; ?>,
                                arrowsNavAutoHide: <?php echo $arrowsnavautohide; ?>,
                                arrowsNavHideOnTouch: <?php echo $arrowsnavhideontouch ?>,
                                sliderDrag: <?php echo $sliderdrag; ?>,
                                sliderTouch: <?php echo $slidertouch; ?>,
                                autoScaleSlider: false,
                                controlNavigation: 'none',
                                navigateByClick: <?php echo $navigatebyclick; ?>,
                                transitionType: '<?php echo $transitiontype; ?>',
                                slidesOrientation: '<?php echo $slidesorientation; ?>',
                                transitionSpeed: <?php echo $transitionspeed; ?>,
                                slidesSpacing: 0,
                                numImagesToPreload: 3,
                                globalCaption: false,
                                allowCSS3: false,
                                block: {
                                    fadeEffect: false,
                                    moveEffect: 'bottom'
                                },
                                autoPlay: {
                                    enabled: <?php echo $autoplay; ?>,
                                    pauseOnHover: false,
                                    delay: <?php echo $delay; ?>
                                },
                                video: {
                                    autoHideArrows: true,
                                    autoHideControlNav: true,
                                    autoHideBlocks: true,
                                    youTubeCode:'<iframe type="text/html" width="100%" height="100%" src="http://www.youtube.com/embed/%id%?wmode=opaque&amp;autoplay=1&amp;enablejsapi=1&modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=dark" frameborder="0" allowfullscreen></iframe>'	
                                }
                            });
                            
                            var slider = jQuery('.slideshow-container').data('royalSlider'),
                                window_width = jQuery(window).width(),
                                window_height = jQuery(window).height();
                            
                            slider.ev.on('rsVideoPlay', function() {
                                jQuery('.grid-callout-home .post').css('margin-top', '0');
                                jQuery('.grid-callout-home .post-header').hide();
                            });
                            
                            slider.ev.on('rsVideoStop', function() {
                                calloutMargin();
                                jQuery('.grid-callout-home .post-header').show();
                            });
                            
                        });
                        
                    //]]>
                
                </script>

            <?php
            }
            
        }
        
    }
    
    add_action('wp_print_footer_scripts', 'gp_frontend_homepage_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Global
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_global_scripts')) {

	function gp_frontend_global_scripts() {
	?>
			
		<script type="text/javascript">
		
			//<![CDATA[

				jQuery(document).ready(function() {
					"use strict";
					
					// Load Images
					jQuery(".canvas").loadImages();
	
					// Fit Videos
					jQuery(".canvas").fitVids();
				 
				});
				
				<?php
                    if (gp_option('gp_image_background')) {
                        
                        $background_image			 = gp_option('gp_image_background');
                        $background_color            = '#' . get_background_color();
                        
                        if (gp_option('gp_image_background_opacity') == '' || gp_option('gp_image_background_opacity') == '1') {
                            $background_opacity		 = '1';
                        } else {
                            $background_opacity		 = gp_option('gp_image_background_opacity');
                        }
                        ?>
                    
                            // Backstretch Background
                            jQuery(document).ready(function() {
                                "use strict";
                                
                                jQuery(".body-background").css('background-color', '<?php echo $background_color; ?>');
                                jQuery(".body-background").backstretch('<?php echo $background_image; ?>').css('opacity', '<?php echo $background_opacity; ?>');
                             
                            });
        
                    
                        <?php
                    }
				?>
				
			//]]>
			
		</script>
			
	<?php
	}
	
	add_action('wp_print_footer_scripts', 'gp_frontend_global_scripts');

}

/*
Form Scripts
*/

if (!function_exists('gp_captcha_scripts')) {

	function gp_captcha_scripts() {
    
        // reCaptcha Keys
        $gp_recaptcha					    = gp_option('gp_form_recaptcha');
        $gp_recaptcha_public_key		    = gp_option('gp_form_recaptcha_public_key');
        $gp_recaptcha_private_key		    = gp_option('gp_form_recaptcha_private_key');
        // reCaptcha Theme
        if (gp_option('gp_form_recaptcha_theme')) {
            $gp_recaptcha_theme             = gp_option('gp_form_recaptcha_theme');
        } else {
            $gp_recaptcha_theme             = 'clean';
        }
        ?>
	
            <?php if ($gp_recaptcha == 'true' && !empty($gp_recaptcha_public_key) && !empty($gp_recaptcha_private_key)) { ?>
                                            
                <?php if ($gp_recaptcha == 'true') { ?>
                    
                    <script type="text/javascript">
                        var RecaptchaOptions = {
                            theme: '<?php echo $gp_recaptcha_theme; ?>'
                        };
                    </script>
                
                <?php } ?>

                <div class="input-captcha one-third<?php if (isset($error_message['contact_captcha_error'])) { ?> error<?php }?>">

                    <?php echo recaptcha_get_html($gp_recaptcha_public_key); ?>
                    
                    <?php if (isset($error_message['contact_captcha_error'])) { ?>
                    
                        <label for="recaptcha_response_field" class="error"><?php echo $error_message['contact_captcha_error']; ?></label>
                        
                    <?php } ?>
                    
                </div>
                    
            <?php } ?>
			
        <?php
	}
	
	add_action('gp_submit_before', 'gp_captcha_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Contact
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_contact_scripts')) {

	function gp_frontend_contact_scripts() {
			
		if (is_page_template('template-contact.php')) { 
		?>
	
			<script type="text/javascript">
				
				//<![CDATA[
				
					jQuery(document).ready(function() {
						"use strict";
						
						jQuery("#form-contact").validate({
							messages: {
								name: '<?php _e('Please fill your name.', 'gp'); ?>',
								email: {
									required: '<?php _e('Please fill your email address.', 'gp'); ?>',
									email: '<?php _e('Please fill the valid email address.', 'gp'); ?>'
								},
								message: '<?php _e('Please fill your message.', 'gp'); ?>',
								captcha: '<?php _e('Please fill valid captcha.', 'gp'); ?>'
							}
						});
						
					});
				
				//]]>
				
			</script>
			
		<?php
		}
	}
	
	add_action('wp_print_footer_scripts', 'gp_frontend_contact_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Reservation
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_reservation_scripts')) {

	function gp_frontend_reservation_scripts() {
			
		if (is_page_template('template-reservation.php')) {
		
            if (gp_option('gp_reservation_date_format')) {
                $date_format = gp_option('gp_reservation_date_format');
            } else {
                $date_format = 'mm/dd/yy';
            }
            if (gp_option('gp_reservation_date_max')) {
                $date_max = gp_option('gp_reservation_date_max');
            } else {
                $date_max = '20';
            }
            ?>
	
                <script type="text/javascript">
                
                    //<![CDATA[
                        
                        jQuery(document).ready(function() {
                            "use strict";
                            
                            jQuery("#form-reservation").validate({
                                messages: {
                                    reservation_datepicker: '<?php _e('Please select a date.', 'gp'); ?>',
                                    reservation_time: '<?php _e('Please fill the time.', 'gp'); ?>',
                                    reservation_persons: '<?php _e('Please fill the number of persons.', 'gp'); ?>',
                                    reservation_name: '<?php _e('Please fill your name.', 'gp'); ?>',
                                    reservation_phone: '<?php _e('Please fill your phone number.', 'gp'); ?>',
                                    reservation_email: {
                                        required: '<?php _e('Please fill your email address.', 'gp'); ?>',
                                        email: '<?php _e('Please fill the valid email address.', 'gp'); ?>'
                                    }
                                }
                            });
                            
                            jQuery("#reservation_datepicker").datepicker({
                                firstDay: 1,
                                dateFormat: '<?php echo $date_format; ?>',
                                maxDate: '<?php echo $date_max; ?>',
                                minDate: '0',
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
	
	add_action('wp_print_footer_scripts', 'gp_frontend_reservation_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Audio Post Format
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_audio_scripts')) {

	function gp_frontend_audio_scripts() {
		global $post_id;
	
		if (have_posts()) { 
			while (have_posts()) { 
				the_post();
				
				// Get Files
				$files = gp_meta('gp_post_mp3', 'type=upload_plupload');
				
				foreach ($files as $file) {
					$audio_url = $file['url'];
				}
				
				if (get_post_format() == 'audio' && $files != NULL) {
                ?>
	
					<script type="text/javascript">
						
						//<![CDATA[
						
							jQuery(document).ready(function() {
								"use strict";
									
								jQuery('.player-<?php the_ID(); ?>').jPlayer({
									ready: function () {
										jQuery(this).jPlayer('setMedia', {
											mp3: '<?php echo $audio_url; ?>'
										});
									},
									play: function() {
										jQuery(this).jPlayer('pauseOthers');
									},
									swfPath: '<?php echo get_template_directory_uri(); ?>/javascripts',
									supplied: 'mp3',
									solution: 'html, flash',
									volume: 0.8,
									cssSelectorAncestor: '.player-container-<?php the_ID(); ?>',
									cssSelector: {
										play: '.player-play',
										pause: '.player-pause',
										stop: '.player-stop',
										mute: '.player-mute',
										unmute: '.player-unmute',
										seekBar: '.player-seek-bar',
										playBar: '.player-play-bar',
										volumeBar: '.player-volume',
										volumeBarValue: '.player-volume-value'
									}
								});
								
							});
						
						//]]>
						
					</script>
			
                <?php
				}
			}
		}
	}
	
	add_action('wp_print_footer_scripts', 'gp_frontend_audio_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Search
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_search_scripts')) {

	function gp_frontend_search_scripts() {
	?>
	
		<script type="text/javascript">
			
			//<![CDATA[
			
				jQuery(document).ready(function() {
		
					jQuery('input[name=s]').focus(function() {
						"use strict";
						
						if (jQuery(this).val() === '<?php _e('Search ...', 'gp'); ?>') {
							jQuery(this).val('');
						}
						
					});
					
					jQuery('input[name=s]').blur(function() {
						"use strict";
						
						if (jQuery(this).val() === '') {
							jQuery(this).val('<?php _e('Search ...', 'gp'); ?>'); 
						}
						
					});
				
				});
	
			//]]>
			
		</script>
			
	<?php
	}
	
	add_action('wp_print_footer_scripts', 'gp_frontend_search_scripts');

}

/*
====================================================================================================
Frontend Styles
====================================================================================================
*/

if (!function_exists('gp_frontend_styles')) {

	function gp_frontend_styles() {
			
		if (!is_admin()) {
			
			// Core Stylesheet
			wp_enqueue_style('gp-style', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array(), '', 'all');
			
			// Font Face Stylesheet [Google Font API]
			if (gp_option('gp_font_face') != '') {
				
				$font_face = gp_option('gp_font_face');
				$font_face = str_replace(' ', '+', $font_face);
				
				// Google Font Face Stylesheet
				wp_enqueue_style('gp-style-font-' . strtolower($font_face), 'http://fonts.googleapis.com/css?family=' . $font_face);
				
			} else {
			
                wp_enqueue_style('gp-style-font-opensanscondensed', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic&subset=latin,cyrillic-ext,greek-ext,latin-ext,cyrillic,greek,vietnamese');
            
            }
			
			// Open Sans Stylesheet [Google Font API]
			wp_enqueue_style('gp-style-font-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic');
			
		}
		
	}
	
	add_action('wp_enqueue_scripts', 'gp_frontend_styles');

}

/*
----------------------------------------------------------------------------------------------------
Init Dynamic Frontend Style
----------------------------------------------------------------------------------------------------
*/

get_template_part('style');

/*
----------------------------------------------------------------------------------------------------
Global Styles
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_global_styles')) {

	function gp_frontend_global_styles() {
		
		if (gp_option('gp_image_background')) {
		?>
		
            <style type="text/css">
                body.custom-background { background-image: none !important; }
                .footer .footer-block { background-color: transparent !important; }
            </style>
		
		<?php
		}
			
	}
	
	add_action('wp_head', 'gp_frontend_global_styles');

}

/*
====================================================================================================
Navigation
====================================================================================================
----------------------------------------------------------------------------------------------------
Primary Navigation
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_navigation')) {

	function gp_navigation() {
	
		wp_nav_menu(
			array(
				'theme_location'	=> 'primary_navigation',
				'menu_class'        => 'navigation-primary',
				'menu_id'           => 'navigation-primary',
				'container'         => false,
				'depth'				=> 3
			)
		);
		
	}

}

/*
----------------------------------------------------------------------------------------------------
Categories Navigation
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_categories')) {

    function gp_categories($type) {
	
		if (get_terms($type)) {
        ?>
                        
            <nav class="navigation-categories categories-<?php echo $type; ?> one-entire clearfix">
                <ul>
                    <?php
                        $gp_categories_args = array(
                            'taxonomy'            => $type,
                            'orderby'             => 'none',
                            'order'               => 'ASC',
                            'show_count'          => 0,
                            'pad_counts'          => 0,
                            'depth'               => 3,
                            'hide_empty'          => 0,
                            'use_desc_for_title'  => 0,
                            'title_li'            => '',
                            'show_option_none'    => ''
                        );
                        wp_list_categories($gp_categories_args);
                    ?>
                </ul>
            </nav>
            
        <?php 
        }
		
	}

}

/*
----------------------------------------------------------------------------------------------------
Remove current_page_item Class of Blog Page
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_current_page_item_remove')) {

	function gp_current_page_item_remove($classes, $item) {
	
		$post_type = get_query_var('post_type');
	
		if (get_post_type() == $post_type) {
			$classes = array_filter($classes, "get_current_value");
		}
		
		if (is_search()) {
			$classes = array_filter($classes, "get_current_value");
		}
	
		return $classes;
		
	}
	
	function get_current_value($element) {
		return ($element != "current_page_parent");
	}
	
	add_filter('nav_menu_css_class', 'gp_current_page_item_remove', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Add current_page_item Class for CPT Menu Item
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_current_page_item_add')) {

	function gp_current_page_item_add($classes = array(), $menu_item = false){
	
		$post_type = get_post_type();
		$page_template = get_post_meta($menu_item->object_id, '_wp_page_template', true);
        
        if (is_single() && $post_type == 'menu' && $page_template == 'template-menu.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('menu-types') && $page_template == 'template-menu.php') {
			$classes[] = 'current_page_item';
		}
        
        if (is_single() && $post_type == 'menu-food' && $page_template == 'template-menu-food.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('menu-food-categories') && $page_template == 'template-menu-food.php') {
			$classes[] = 'current_page_item';
		}
        
        // Breakfast
		if (is_single() && $post_type == 'menu-breakfast' && $page_template == 'template-menu-breakfast.php' || is_single() && $post_type == 'menu-breakfast' && $page_template == 'template-menu-breakfast-all.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('menu-breakfast-categories') && $page_template == 'template-menu-breakfast.php') {
			$classes[] = 'current_page_item';
		}
		
		// Lunch
		if (is_single() && $post_type == 'menu-lunch' && $page_template == 'template-menu-lunch.php' || is_single() && $post_type == 'menu-lunch' && $page_template == 'template-menu-lunch-all.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('menu-lunch-categories') && $page_template == 'template-menu-lunch.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_single() && $post_type == 'menu-dinner' && $page_template == 'template-menu-dinner.php' || is_single() && $post_type == 'menu-dinner' && $page_template == 'template-menu-dinner-all.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('menu-dinner-categories') && $page_template == 'template-menu-dinner.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_single() && $post_type == 'menu-drink' && $page_template == 'template-menu-drink.php' || is_single() && $post_type == 'menu-drink' && $page_template == 'template-menu-drink-all.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('menu-drink-categories') && $page_template == 'template-menu-drink.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_single() && $post_type == 'menu-wine' && $page_template == 'template-menu-wine.php' || is_single() && $post_type == 'menu-wine' && $page_template == 'template-menu-wine-all.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('menu-wine-categories') && $page_template == 'template-menu-wine.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_single() && $post_type == 'event' && $page_template == 'template-event.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('category-event') && $page_template == 'template-event.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_single() && $post_type == 'gallery' && $page_template == 'template-gallery.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('category-gallery') && $page_template == 'template-gallery.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_single() && $post_type == 'video' && $page_template == 'template-video.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('category-video') && $page_template == 'template-video.php') {
			$classes[] = 'current_page_item';
		}
		
		return $classes;
		
	}
	
	add_filter('nav_menu_css_class', 'gp_current_page_item_add', 10, 2);

}

/*
====================================================================================================
Layout
====================================================================================================
*/

if (!function_exists('gp_start')) {

	function gp_start($type, $class, $container = true) {
        
        if (is_array($class)) {
            $class_container = implode('-container ', $class);
            $class = implode(' ', $class);
        } else {
            $class_container = $class;
        }
        
        if (!$type) {
            $type = 'div';
        }
        ?>
        
            <<?php echo $type; ?> class="<?php echo $class; ?> clearfix">
                
                <?php if ($container == true) { ?>
                    <div class="<?php echo $class_container; ?>-container clearfix">
                <?php } ?>
        
    <?php
    }
    
}

if (!function_exists('gp_end')) {

	function gp_end($type, $class, $container = true) {
    
        if (is_array($class)) {
            $class_container = implode('-container ', $class);
            $class = implode(' ', $class);
        } else {
            $class_container = $class;
        }
        
        if (!$type) {
            $type = 'div';
        }
        ?>
            
                <?php if ($container == true) { ?>
                </div><!-- END // <?php echo $class_container; ?>-container -->
                <?php } ?>
        
            </<?php echo $type; ?>><!-- END // <?php echo $class; ?> -->
        
        <?php
    }
    
}

/*
====================================================================================================
Pagination
====================================================================================================
*/

if (!function_exists('gp_pagination')) {

	function gp_pagination() {
		global $wp_query;
	
		$big = 999999999;
		?>
		
            <div class="pagination clearfix">
                
                <?php
                    echo paginate_links(
                        array(
                            'base'		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format'	=> '?paged=%#%',
                            'current'	=> max(1, get_query_var('paged')),
                            'total'		=> $wp_query->max_num_pages
                        )
                    );
                ?>
            
            </div><!-- END // pagination -->
            
		<?php
	}

}

/*
====================================================================================================
Pagination for Posts
====================================================================================================
*/

if (!function_exists('gp_pagination_post')) {

	function gp_pagination_post($defaults) {
		
		$args = array(
			'before'		=> '<div class="pagination-post">',
			'after'			=> '</div><!-- END // pagination-post -->',
		);
		
		$r = wp_parse_args($args, $defaults);
		
		return $r;
		
	}
	
	add_filter('wp_link_pages_args', 'gp_pagination_post');

}

/*
====================================================================================================
Time
====================================================================================================
*/

if (!function_exists('gp_time_ago')) {

	function gp_time_ago() {
		global $post;
	
		$date = get_post_time('G', true, $post);
		$chunks = array(
			array(60 * 60 * 24 * 365, __('year', 'gp'), __('years', 'gp')),
			array(60 * 60 * 24 * 30, __('month', 'gp'), __('months', 'gp')),
			array(60 * 60 * 24 * 7, __('week', 'gp'), __('weeks', 'gp')),
			array(60 * 60 * 24, __('day', 'gp'), __('days', 'gp')),
			array(60 * 60, __('hour', 'gp'), __('hours', 'gp')),
			array(60, __('minute', 'gp'), __('minutes', 'gp')),
			array(1, __('second', 'gp'), __('seconds', 'gp'))
		);
	 
		if (!is_numeric($date)) {
			$time_chunks		= explode(':', str_replace(' ', ':', $date));
			$date_chunks		= explode('-', str_replace(' ', '-', $date));
			$date				= gmmktime((int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0]);
		}
	 
		$current_time		= current_time('mysql', $gmt = get_option('gmt_offset'));
		$newer_date			= strtotime($current_time);
		$since				= $newer_date - $date;
	 
		if ($since < 0) {
			return __('sometime', 'gp');
		}
	
		for ($i = 0, $j = count($chunks); $i < $j; $i++) {
			$seconds = $chunks[$i][0];
	 
			if (($count = floor($since / $seconds)) != 0) {
				break;
			}
		}
	
		$output = ($count == 1) ? '1 ' . $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
	
		if (!(int)trim($output)) {
			$output = '0 ' . __('seconds', 'gp');
		}
		
		$output .= __(' ago', 'gp');
	 
		return $output;
		
	}
	
	add_filter('the_time', 'gp_time_ago');

}

/*
====================================================================================================
Social Sharing
====================================================================================================
*/

if (!function_exists('gp_share')) {

	function gp_share() {
		global $post_id;
		
		$title = get_the_title();
		$original_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		
		if (gp_option('gp_share_twitter') != 'false' || gp_option('gp_share_facebook') || 'false' && gp_option('gp_share_googleplus') != 'false' || gp_option('gp_share_pinterest') != 'false') {
		?>
		
		<div class="post-share">
	
			<h4><?php _e('Share', 'gp'); ?></h4>
	
			<ul>
			
				<?php if (gp_option('gp_share_twitter') != 'false') { ?>
			
					<li class="share-twitter social-twitter">
						<a href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo str_replace(" ", "%20", $title); ?>" title="<?php _e('Tweet This', 'gp'); ?>" target="_blank"></a>
					</li>
				
				<?php } ?>
				
				<?php if (gp_option('gp_share_facebook') != 'false') { ?>
			
					<li class="share-facebook social-facebook">
						<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;title=<?php echo str_replace(" ", "%20", $title); ?>" title="<?php _e('Share on Facebook', 'gp'); ?>" target="_blank"></a>
					</li>
				
				<?php } ?>
				
				<?php if (gp_option('gp_share_googleplus') != 'false') { ?>
			
					<li class="share-googleplus social-googleplus">
						<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" title="<?php _e('Share on Google+', 'gp'); ?>" target="_blank"></a>
					</li>
				
				<?php } ?>
				
				<?php if (gp_option('gp_share_pinterest') != 'false') { ?>
			
					<li class="share-pinterest social-pinterest">
						<a href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());" title="<?php _e('Pin it', 'gp'); ?>" target="_blank"></a>
					</li>
				
				<?php } ?>
	
			</ul>
			
		</div>
		
		<?php
		}
		
	}

}

/*
====================================================================================================
Audio Player
====================================================================================================
*/

if (!function_exists('gp_player')) {

	function gp_player() {
        global $post_id;
        ?>
		
            <div class="player-<?php the_ID(); ?>"></div>
                                            
            <div class="player">
            
                <div class="player-container-<?php the_ID(); ?> player-container">
            
                    <div class="player-progress">
                        <div class="player-seek-bar">
                            <div class="player-play-bar"></div>
                        </div>
                    </div><!-- END // player-progress -->
            
                    <div class="player-controls">
                
                        <ul>
                            <li><a href="javascript:;" class="player-play" tabindex="1">Play</a></li>
                            <li><a href="javascript:;" class="player-pause" tabindex="1">Pause</a></li>
                            <li><a href="javascript:;" class="player-stop" tabindex="1">Stop</a></li>
                            <li><a href="javascript:;" class="player-mute" tabindex="1">Mute</a></li>
                            <li><a href="javascript:;" class="player-unmute" tabindex="1">Unmute</a></li>
                        </ul><!-- END // player-controls -->
                        
                        <div class="player-volume">
                            <div class="player-volume-container">
                                <div class="player-volume-value"></div>
                            </div>
                        </div><!-- END // player-volume -->
                    
                    </div><!-- END // player-controls -->
            
                </div><!-- END // player-container -->
            
            </div><!-- END // player -->
		
        <?php
	}

}

/*
====================================================================================================
Third Party SEO Plugins
====================================================================================================
*/

if (!function_exists('gp_seo_third_party')) {

	function gp_seo_third_party() {
		
		include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		
		if (is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')) {
			return true;
		}
		
		if (is_plugin_active('wordpress-seo/wp-seo.php')) {
			return true;
		}
		
		return false;
		
	}

}

/*
====================================================================================================
Title
====================================================================================================
*/

if (!function_exists('gp_title')) {

	function gp_title($title) {
		global $post_id;
		
		if (!gp_seo_third_party()){
			if (is_front_page() && get_bloginfo('description')) {
				return get_bloginfo('name') . ' &rsaquo; ' . get_bloginfo('description'); 
			} else if (is_front_page()) {
				return get_bloginfo('name'); 
			} else if (is_feed()) {
				return trim($title); 
			} else {
				return trim($title) . ' &lsaquo; ' . get_bloginfo('name'); 
			}
		}
	
		return $title;
	
	}
	
	add_filter('wp_title', 'gp_title');

}

/*
====================================================================================================
Add Meta
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Add Keywords
----------------------------------------------------------------------------------------------------
*/

if (!gp_seo_third_party()) {
	
	if (!function_exists('gp_meta_keywords')) {

		function gp_meta_keywords() {
			global $post_id, $wp_query;
            
            if ($wp_query->is_404 != true) {
                if (gp_meta('gp_page_keywords')) {
                ?>
                <meta name="keywords" content="<?php echo gp_meta('gp_page_keywords'); ?>" />
                <?php
                } else if (gp_option('gp_meta_keywords_default')) {
                ?>
                <meta name="keywords" content="<?php echo gp_option('gp_meta_keywords_default'); ?>" />
                <?php 
                }
            }
			
		}
		
		add_action('gp_meta_head', 'gp_meta_keywords');
        	
	}

}

/*
----------------------------------------------------------------------------------------------------
Add Description
----------------------------------------------------------------------------------------------------
*/

if (!gp_seo_third_party()) {
	
	if (!function_exists('gp_meta_description')) {

		function gp_meta_description() {
			global $post_id, $wp_query;
            
            if ($wp_query->is_404 != true) {
                if (gp_meta('gp_page_description') != '') {
                ?>
                <meta name="description" content="<?php echo gp_meta('gp_page_description'); ?>" />
                <?php
                } else if (gp_option('gp_meta_description_default') != '') {
                ?>
                <meta name="description" content="<?php echo gp_option('gp_meta_description_default'); ?>" />
                <?php 
                }
            }
			
		}
		
		add_action('gp_meta_head', 'gp_meta_description');
	
	}

}

/*
====================================================================================================
Footer Tracking
====================================================================================================
*/

if (!function_exists('gp_footer_tracking')) {

	function gp_footer_tracking() {
	
		if (gp_option('gp_tracking_code')) { 
			echo stripslashes(gp_option('gp_tracking_code'));
		}
		
	}
	
	add_action('gp_footer', 'gp_footer_tracking');

}

/*
====================================================================================================
Toolbar Body Class
====================================================================================================
*/

if (!function_exists('gp_body_class_toolbar')) {

	function gp_body_class_toolbar($classes) {
		
		if (gp_option('gp_socials_header') != 'false' || function_exists('qtrans_generateLanguageSelectCode') || gp_option('gp_search') != 'false') {
			$classes[] = 'toolbar-active';
		}
		
		return $classes;
		
	}
	
	add_filter('body_class', 'gp_body_class_toolbar');

}

/*
====================================================================================================
Add Custom Icons
====================================================================================================
*/

// Browser Favicon 32x32
if (!function_exists('gp_favicon')) {

	function gp_favicon() {
			
		if (gp_option('gp_image_favicon')) { 
		?>
		<link rel="shortcut icon" href="<?php echo gp_option('gp_image_favicon'); ?>" />
		<?php } else { ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
		<?php 
		}
		
	}
	
	add_action('wp_head', 'gp_favicon');

}

// Apple Touch Icon 57x57 /  For non-retina iPhone, iPod Touch and Android 2.1+ devices
if (!function_exists('gp_touch_icon')) {

	function gp_touch_icon() {
			
		if (gp_option('gp_image_touch_icon')) { 
		?>
		<link rel="apple-touch-icon-precomposed" href="<?php echo gp_option('gp_image_touch_icon'); ?>" />
		<?php } else { ?>
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-precomposed.png" />
		<?php 
		}
		
	}
	
	add_action('wp_head', 'gp_touch_icon');

}

// Apple Touch Icon 72x72 / For first and second iPad generation
if (!function_exists('gp_touch_icon_72')) {

	function gp_touch_icon_72() {
			
		if (gp_option('gp_image_touch_icon_72')) { 
		?>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo gp_option('gp_image_touch_icon_72'); ?>" />
		<?php } else { ?>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-72x72-precomposed.png" />
		<?php 
		}
		
	}
	
	add_action('wp_head', 'gp_touch_icon_72');

}

// Apple Touch Icon 114x114 / For iPhone with high-resolution retina display
if (!function_exists('gp_touch_icon_114')) {

	function gp_touch_icon_114() {
			
		if (gp_option('gp_image_touch_icon_114')) { 
		?>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo gp_option('gp_image_touch_icon_114'); ?>" />
		<?php } else { ?>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-114x114-precomposed.png" />
		<?php 
		}
		
	}
	
	add_action('wp_head', 'gp_touch_icon_114');

}

// Apple Touch Icon 144x144 / For third iPad generation with high-resolution retina display
if (!function_exists('gp_touch_icon_144')) {

	function gp_touch_icon_144() {
			
		if (gp_option('gp_image_touch_icon_144')) { 
		?>
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo gp_option('gp_image_touch_icon_144'); ?>" />
		<?php } else { ?>
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-144x144-precomposed.png" />
		<?php 
		}
		
	}
	
	add_action('wp_head', 'gp_touch_icon_144');

}

/*
====================================================================================================
Custom Excerpt
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Remove Excerpt Metabox from WordPress
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_remove_excerpt_metabox')) {

	function gp_remove_excerpt_metabox() {
	
		remove_meta_box('postexcerpt', 'post', 'normal');
	
	}
	
	add_action('admin_menu', 'gp_remove_excerpt_metabox');

}

/*
----------------------------------------------------------------------------------------------------
Custom Excerpt
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_excerpt')) {

	function gp_excerpt($text) {
			global $post;
			
			if ($text == '') {
				$text = get_the_content('');
				$text = apply_filters('the_content', $text);
				$text = str_replace('\]\]\>', ']]&gt;', $text);
				$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
				$text = strip_tags($text, '<p>');
				$excerpt_length = 30;
				$words = explode(' ', $text, $excerpt_length + 1);
				if (count($words)> $excerpt_length) {
					array_pop($words);
					array_push($words, '...');
					$text = implode(' ', $words);
				}
			}
			
			return $text;
			
	}
	
	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'gp_excerpt');

}

/*
====================================================================================================
Set Max Content Width
====================================================================================================
*/

if (!isset($content_width)) {

	$content_width = 1180;

}

/*
====================================================================================================
Add to RSS
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Add to RSS > Custom Post Types
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_add_posttypes_to_rss')) {

	function gp_add_posttypes_to_rss($qv) {
			
		if (isset($qv['feed']) && !isset($qv['post_type']) ) {
			$qv['post_type'] = array('post', 'event');
		}
		return $qv;
		
	}
	
	add_filter('request', 'gp_add_posttypes_to_rss');

}

/*
----------------------------------------------------------------------------------------------------
Add to RSS > Thumbnails
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_add_thumbnails_to_rss')) {

	function gp_add_thumbnails_to_rss($content) {
		
		global $post;
		
		if (has_post_thumbnail($post->ID)) {
			$content = '' . $content;
		}
		
		return $content;
		
	}
	
	add_filter('the_excerpt_rss', 'gp_add_thumbnails_to_rss');
	add_filter('the_content_feed', 'gp_add_thumbnails_to_rss');

}

/*
====================================================================================================
Comments List
====================================================================================================
*/

if (!function_exists('gp_comments_list')) {

	function gp_comments_list($comment, $args, $depth) {
	   $globals['comment'] = $comment;
	?>
	
		<div <?php comment_class(); ?>>
	   
			<div id="comment-<?php comment_ID(); ?>">
		 
				<div class="comment-avatar float-left">
					
					<?php echo get_avatar($comment, $size='50'); ?>
					
				</div><!-- END // comment-avatar -->
				
				<div class="comment-body">
				
					<div class="comment-meta clearfix">
	
						<h5 class="float-left">
							<?php echo get_comment_author_link(); ?>
						</h5>
						
						<div class="comment-date float-right">
							<a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s at %2$s', 'gp'), get_comment_date(), get_comment_time()); ?></a>
							<?php edit_comment_link(__('[edit]', 'gp'),'',''); ?>
						</div>
	
					</div><!-- END // comment-meta -->
					
					<?php if ($comment->comment_approved == '0') { ?>
					
						<div class="alert notice corner"><?php _e('Your comment is awaiting moderation.', 'gp'); ?></div>
					
					<?php } ?>
					
					<div class="comment-content">
						
						<div class="comment-text">
							<?php comment_text() ?>
						</div><!-- END // comment-text -->
						
						<div class="comment-reply button">
							<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
						</div><!-- END // comment-reply -->
						
					</div><!-- END // comment-content -->
					
				</div><!-- END // comment-body -->
				
			</div><!-- END // comment -->
	
	<?php
	}

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

/*
====================================================================================================
Init GPanel
====================================================================================================
*/

get_template_part('backend/init', 'gpanel');