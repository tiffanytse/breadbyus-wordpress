/*
====================================================================================================
@name 			jQuery Date Picker
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
====================================================================================================
*/

function gp_update_date_picker() {
	
	var $ = jQuery;

	$('.gp-datepicker').each( function() {
		var $this = $(this),
			options = $this.data('options');

		$this.siblings('.ui-datepicker-append').remove();
		$this.removeClass('hasDatepicker').attr('id', '').datepicker(options);
	});
	
}

jQuery(document).ready(function() {
	gp_update_date_picker();
});