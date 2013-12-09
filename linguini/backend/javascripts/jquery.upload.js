/*
====================================================================================================
@name 			jQuery Upload
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
====================================================================================================
*/

jQuery(document).ready(function() {
	
	var upload_field, upload_preview;
	
	if (jQuery('.upload_button').length) {
		
		jQuery('.upload_button').live('click', function(e) {
			upload_field = jQuery(this).closest('td').find('input.upload_field:first');
			upload_preview = jQuery(this).closest('td').find('img.upload_preview:first');
			window.send_to_editor=window.send_to_editor_clone;
			tb_show('','media-upload.php?TB_iframe=true');
			return false;
		});
		
		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor_clone = function(html) {
			file_url = jQuery('img',html).attr('src');
			if (!file_url) { file_url = jQuery(html).attr('href'); }
			tb_remove();
			upload_field.val(file_url);
			upload_preview.attr('src', file_url);
		}
		
	}

	jQuery('.clear_button').live('click', function(e) {
		jQuery(this).closest('td').find('input.upload_field:first').val('');
		jQuery(this).closest('td').find('img.upload_preview:first').hide();
		return false;
	});
	
});