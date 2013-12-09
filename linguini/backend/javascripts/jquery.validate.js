/*
====================================================================================================
@name 			jQuery Validate
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
====================================================================================================
*/

jQuery(document).ready(function($) {
	
	var $form = $('#post');

	$.each(gp.validationOptions.rules, function(k, v) {
		if (v['required']) {
			$('#' + k).parent().siblings('.gp-label').addClass('required').append('<span>*</span>');
		}
	});

	gp.validationOptions.invalidHandler = function(form, validator) {
		$('#publish').removeClass('button-primary-disabled');
		$('#ajax-loading').attr('style', '');
		$form.siblings('#message').remove();
		$form.before('<div id="message" class="error"><p>' + gp.summaryMessage + '</p></div>');
	};

	$form.validate(gp.validationOptions);

});