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
	
	var file_frame;
	
	jQuery('.upload_button').live('click', function( event ){
		
		upload_field = jQuery(this).closest('td').find('input.upload_field:first');
		upload_preview = jQuery(this).closest('td').find('img.upload_preview:first');
	
		event.preventDefault();
		
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}
		
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: jQuery( this ).data( 'uploader_title' ),
		  button: {
		      text: jQuery( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false  // Set to true to allow multiple files to be selected
		});
		
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  // We set multiple to false so only get one image from the uploader
		  attachment = file_frame.state().get('selection').first().toJSON();
		
		  upload_field.val(attachment.url);
		  upload_preview.attr('src', attachment.url);
		  
		});
		
		// Finally, open the modal
		file_frame.open();
		
	});

	jQuery('.clear_button').live('click', function(e) {
		jQuery(this).closest('td').find('input.upload_field:first').val('');
		jQuery(this).closest('td').find('img.upload_preview:first').hide();
		return false;
	});
	
});