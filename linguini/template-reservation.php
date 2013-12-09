<?php

/*

Template Name:	Reservation	

@name			Reservation Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Sidebar
if (gp_option('gp_reservation_sidebar')) {
	
	$sidebar		= gp_option('gp_reservation_sidebar');
		
} else {
	
	$sidebar		= 'left';
	
}

// Content Class
if (is_active_sidebar('widget-area-reservation')) {
	
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
	
} else {
	
	$content_class	= 'content';
	
}

// Error Messages
$reservation_datepicker_error       = __('Please select a date.', 'gp');
$reservation_time_error             = __('Please fill the time.', 'gp');
$reservation_persons_error          = __('Please fill the number of persons.', 'gp');
$reservation_name_error             = __('Please fill your name.', 'gp');
$reservation_phone_error            = __('Please fill your phone number.', 'gp');
$reservation_email_error            = __('Please fill your email address.', 'gp');
$reservation_email_invalid_error    = __('Please fill the valid email address.', 'gp');
$reservation_captcha_error			= __('Please fill the valid captcha.', 'gp');

// reCaptcha Keys
$gp_recaptcha					    = gp_option('gp_form_recaptcha');
$gp_recaptcha_public_key		    = gp_option('gp_form_recaptcha_public_key');
$gp_recaptcha_private_key		    = gp_option('gp_form_recaptcha_private_key');

// If WP-reCAPTCHA Plugin Active
if (!is_plugin_active('wp-recaptcha/wp-recaptcha.php') && !class_exists('reCAPTCHA')) {
    
    get_template_part('forms/lib', 'recaptcha');
    
}

// reCaptcha Theme
if (gp_option('gp_form_recaptcha_theme')) {
    $gp_recaptcha_theme             = gp_option('gp_form_recaptcha_theme');
} else {
    $gp_recaptcha_theme             = 'clean';
}

if(isset($_POST['reservation_submitted'])) {
    
    // Date Validation
	if (trim($_POST['reservation_datepicker']) === '') {
		
		$error_message['reservation_datepicker_error'] = $reservation_datepicker_error;
		$has_reservation_error = true;
		
	} else {
		
		$date_field = trim($_POST['reservation_datepicker']);
		
	}
	
	// Time Validation
	if (trim($_POST['reservation_time']) === '') {
		
		$error_message['reservation_time_error'] = $reservation_time_error;
		$has_reservation_error = true;
		
	} else {
		
		$time_field = trim($_POST['reservation_time']);
		
	}
	
	// Persons Validation
	if (trim($_POST['reservation_persons']) === '') {
		
		$error_message['reservation_persons_error'] = $reservation_persons_error;
		$has_reservation_error = true;
		
	} else {
		
		$persons_field = trim($_POST['reservation_persons']);
		
	}
	
	// Name Validation
	if (trim($_POST['reservation_name']) === '') {
		
		$error_message['reservation_name_error'] = $reservation_name_error;
		$has_reservation_error = true;
		
	} else {
		
		$name_field = trim($_POST['reservation_name']);
		
	}
	
	// Phone Validation
	if (trim($_POST['reservation_phone']) === '') {
		
		$error_message['reservation_phone_error'] = $reservation_phone_error;
		$has_reservation_error = true;
		
	} else {
		
		$phone_field = trim($_POST['reservation_phone']);
		
	}
    
    // Email Validation
	if (trim($_POST['reservation_email']) === '') {
		
		$error_message['reservation_email_error'] = $reservation_email_error;
		$has_reservation_error = true;
		
	} else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['reservation_email']))) {
		
		$error_message['reservation_email_invalid_error'] = $reservation_email_invalid_error;
		$has_reservation_error = true;
		
	} else {
		
		$email_field = trim($_POST['reservation_email']);
		
	}
    
    // Message Validation
	if (function_exists('stripslashes')) {
		
		$message_field = stripslashes(trim($_POST['reservation_message']));
		
	} else {
		
		$message_field = trim($_POST['reservation_message']);
		
	}

	// reCaptcha Validation
	if ($gp_recaptcha == 'true' && !empty($gp_recaptcha_public_key) && !empty($gp_recaptcha_private_key)) {

		$resp = recaptcha_check_answer(
			$gp_recaptcha_private_key,
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]
		);
		
		if (!$resp->is_valid) {
			
			$error = $resp->error;
			$has_captcha_error = true;
			$error_message['reservation_captcha_error'] = $reservation_captcha_error;
			
		}
		
	}
	
	// Send Email If Has No Errors
	if (!isset($has_reservation_error) && !isset($has_captcha_error)) {
		
		$date_title           = __('Date and time:', 'gp');
		$persons_title        = __('Number of persons:', 'gp');
		$name_title           = __('Name:', 'gp');
		$phone_title          = __('Phone:', 'gp');
		$email_title          = __('Email:', 'gp');
		$message_title        = __('Message:', 'gp');
	
		$to = gp_option('gp_form_reservation_email');
		
		if (!isset($to) || ($to == '') ){
			
			$to = gp_option('admin_email');
			
		}
		
		if (gp_option('gp_form_reservation_subject')) {
			
			$subject = gp_option('gp_form_reservation_subject');
				
		} else {
			
			$subject = __('Reservation Form', 'gp');
			
		}
		
		// Email Template
		$body = "

		<html>
		<body style='font-family:Arial, Verdana, Tahoma, sans-serif;margin:0;padding:0;font-size:12px;color:#50505a;'>
		
			<table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#f5f5fa'>
	
				<tr>
					<td style='background:#f5f5fa;' align='center'>
						
						<table width='600' border='0' cellspacing='0' cellpadding='0' bgcolor='#ffffff' style='padding:15px 30px 30px 30px; margin:30px 0;'>
				
							<tr>
								<th colspan='2' style='text-align: left;'><h1 style='font-size:22px;padding-bottom:10px;'>$subject</h1></th>
							</tr>
							
							<tr> 
								<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
									$date_title
								</th>
								<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
									$date_field, $time_field
								</td>
							</tr>
							
							<tr> 
								<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
									$persons_title
								</th>
								<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
									$persons_field
								</td>
							</tr>
							
							<tr> 
								<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
									$name_title
								</th>
								<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
									$name_field
								</td>
							</tr>
							
							<tr> 
								<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
									$phone_title
								</th>
								<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
									$phone_field
								</td>
							</tr>
							
							<tr> 
								<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
									$email_title
								</th>
								<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
									$email_field
								</td>
							</tr>
						
							<tr> 
								<th valign='top' style='text-align:left;width:150px;padding: 7px 0;'>
									$message_title
								</th>
								<td style='padding:7px 0;'> 
									$message_field
								</td>
							</tr>
							
						</table>
						
					</td>
				</tr>
			
			</table>
		
		</body>
		</html>
		
		";
		
		$headers = array('From: ' . $name_field . ' <' . $email_field . '>', 'Content-Type: text/html', 'Reply-To:' . $email_field);
		$h = implode("\r\n", $headers) . "\r\n";

		wp_mail($to, $subject, $body, $h);
		$has_reservation_sent = true;
		
	}
}

get_header();
?>
    
    <?php get_template_part('title'); ?>

	<?php gp_start('div', 'canvas'); ?>

        <?php
            if ($sidebar == 'left') {
                if (is_active_sidebar('widget-area-reservation')) {
                    get_sidebar('reservation');
                }
            }
        ?>
    
        <div class="content-reservation <?php echo $content_class; ?>" role="main">

            <?php
                // Loop
                if (have_posts()) { 
                    while (have_posts()) { 
                        the_post();
                        ?>
                            
                            <?php if (!empty($post->post_content)) { ?>
                            
                                <div class="page-content">
                                
                                    <?php the_content(); ?>
                                
                                </div><!-- END // page-content -->
                            
                            <?php } ?>
                            
                            <?php if (isset($has_reservation_sent) && $has_reservation_sent == true) { ?>
                                        
                                <div class="alert success">
                                    
                                    <h5>
                                        <?php _e('Thank you. Email has been sent. Our staff will confirm you the booking by email.', 'gp'); ?>
                                    </h5>
                                    
                                    <span class="close">&times;</span>
                                    
                                </div><!-- END // alert -->
                                
                            <?php } else {  ?>
                            
                                <?php if (isset($has_reservation_error)) { ?>
                                
                                    <div class="alert error">
                                        
                                        <h5>
                                            <?php _e('Sorry, an error occurred, email hasn\'t been sent.', 'gp'); ?>
                                        </h5>
                                        
                                        <span class="close">&times;</span>
                                        
                                    </div><!-- END // alert -->
                                    
                                <?php } else if (isset($has_captcha_error)) { ?>
                                    
                                    <div class="alert error">
                                        
                                        <h5>
                                            <?php _e('Please fill the valid captcha.', 'gp'); ?>
                                        </h5>
                                        
                                        <span class="close">&times;</span>
                                        
                                    </div><!-- END // alert -->
                                    
                                <?php } ?>
    
                                <form action="<?php the_permalink(); ?>" id="form-reservation" class="form" method="post">
                                    
                                    <fieldset>
    
                                        <h2 class="form-header"><?php _e('Reservation information', 'gp'); ?></h2>
                                            
                                        <div class="grid">
                                    
                                            <div class="input-block one-third">
                                            
                                                <label for="reservation_datepicker" ><?php _e('Date', 'gp'); ?> <span class="required-star">*</span></label>
                                                
                                                <input name="reservation_datepicker" id="reservation_datepicker" class="required<?php if (isset($error_message['reservation_datepicker_error'])) { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_datepicker'])) { echo $_POST['reservation_datepicker']; } ?>" />
                                                
                                                <?php if (isset($error_message['reservation_datepicker_error'])) { ?>
                                                    
                                                    <label for="reservation_datepicker" class="error"><?php echo $error_message['reservation_datepicker_error']; ?></label>
                                                    
                                                <?php } ?>
                                                
                                            </div><!-- END // input-block -->
                                            
                                            <div class="input-block one-third">
                                            
                                                <label for="reservation_time"><?php _e('Time', 'gp'); ?> <span class="required-star">*</span></label>
                                                
                                                <input name="reservation_time" id="reservation_time" class="required<?php if (isset($error_message['reservation_time_error'])) { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_time'])) { echo $_POST['reservation_time']; } ?>" />
                                                
                                                <?php if (isset($error_message['reservation_time_error'])) { ?>
                                                    
                                                    <label for="reservation_time" class="error"><?php echo $error_message['reservation_time_error'] ?></label>
                                                    
                                                <?php } ?>
                                            
                                            </div><!-- END // input-block -->
                                            
                                            <div class="input-block one-third">
                                            
                                                <label for="reservation_persons"><?php _e('Number of persons', 'gp'); ?> <span class="required-star">*</span></label>
                                                
                                                <input name="reservation_persons" id="reservation_persons" class="required number<?php if (isset($error_message['reservation_persons_error'])) { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_persons'])) { echo $_POST['reservation_persons']; } ?>" />
                                                
                                                <?php if (isset($error_message['reservation_persons_error'])) { ?>
                                                    
                                                    <label for="reservation_persons" class="error"><?php echo $error_message['reservation_persons_error'] ?></label>
                                                    
                                                <?php } ?>
                                                
                                            </div><!-- END // input-block -->
                                            
                                        </div><!-- END // grid -->
                                        
                                        <h2 class="form-header"><?php _e('Personal information', 'gp'); ?></h2>
                                        
                                        <div class="grid">
                                            
                                            <div class="input-block one-third">
                                            
                                                <label for="reservation_name"><?php _e('Name', 'gp'); ?> <span class="required-star">*</span></label>
                                                
                                                <input name="reservation_name" id="reservation_name" class="required<?php if (isset($error_message['reservation_name_error'])) { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_name'])) { echo $_POST['reservation_name']; } ?>" />
                                                
                                                <?php if (isset($error_message['reservation_name_error'])) { ?>
                                                    
                                                    <label for="reservation_name" class="error"><?php echo $error_message['reservation_name_error'] ?></label>
                                                    
                                                <?php } ?>
                                                
                                            </div><!-- END // input-block -->
                                            
                                            <div class="input-block one-third">
                                            
                                                <label for="reservation_phone"><?php _e('Phone', 'gp'); ?> <span class="required-star">*</span></label>
                                                
                                                <input name="reservation_phone" id="reservation_phone" class="required<?php if (isset($error_message['reservation_phone_error'])) { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_phone'])) { echo $_POST['reservation_phone']; } ?>" />
                                                
                                                <?php if (isset($error_message['reservation_phone_error'])) { ?>
                                                    
                                                    <label for="reservation_phone" class="error"><?php echo $error_message['reservation_phone_error'] ?></label>
                                                    
                                                <?php } ?>
                                                
                                            </div><!-- END // input-block -->
                                            
                                            <div class="input-block one-third">
                                            
                                                <label for="reservation_email"><?php _e('Email', 'gp'); ?> <span class="required-star">*</span></label>
                                                
                                                <input name="reservation_email" id="reservation_email" class="required email<?php if (isset($error_message['reservation_email_error']) ||  isset($error_message['reservation_email_invalid_error'])) { ?> error<?php } ?>" type="text" value="<?php if(isset($_POST['reservation_email'])) { echo $_POST['reservation_email']; } ?>" />
                                                
                                                <?php if (isset($error_message['reservation_email_error'])) { ?>
                                                    
                                                    <label for="reservation_email" class="error"><?php echo $error_message['reservation_email_error'] ?></label>
                                                    
                                                <?php } ?>
                                                
                                                <?php if (isset($error_message['reservation_email_invalid_error'])) { ?>
                                                    
                                                    <label for="reservation_email" class="error"><?php echo $error_message['reservation_email_invalid_error'] ?></label>
                                                    
                                                <?php } ?>
                                                
                                            </div><!-- END // input-block -->
                                        
                                            <div class="textarea-block one-entire clearfix">
                                            
                                                <label for="reservation_message"><?php _e('Message', 'gp'); ?></label>
                                                
                                                <textarea name="reservation_message" id="reservation_message" class="<?php if (isset($error_message['reservation_message_error'])) { ?> error<?php } ?>" cols="110" rows="5"><?php if (isset($_POST['reservation_message'])) { if (function_exists('stripslashes')) { echo stripslashes($_POST['reservation_message']); } else { echo $_POST['reservation_message']; } } ?></textarea>
                                                
                                                <?php if (isset($error_message['reservation_message_error'])) { ?>
                                                
                                                    <label for="reservation_message" class="error"><?php echo $error_message['reservation_message_error']; ?></label>
                                                    
                                                <?php } ?>
                                                
                                            </div><!-- END // input-block -->
    
                                        </div><!-- END // grid -->
                                        
                                        <?php gp_submit_before(); ?>

                                        <div class="buttons one-entire clearfix">
    
                                            <input type="hidden" name="reservation_submitted" id="reservation_submitted" value="true" />
                                            
                                            <button type="submit" name="button-submit" class="button">
                                                <?php _e('Make a reservation', 'gp'); ?>
                                            </button>
                                            
                                            <div class="required-star-info float-right"><span class="required-star">*</span> <?php _e('Required fields', 'gp'); ?></div>
                                            
                                        </div><!-- END // buttons -->
    
                                    </fieldset>
                                    
                                </form>
                        
                            <?php } ?>
                        
                        <?php
                    } //while
                } //if
                wp_reset_query();
            ?>

        </div><!-- END // content -->
        
        <?php
            if ($sidebar == 'right') {
                if (is_active_sidebar('widget-area-reservation')) {
                    get_sidebar('reservation');
                }
            }
        ?>
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();