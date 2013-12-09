/*
====================================================================================================
@name 			jQuery Taxonomy Image Upload
@package		GPanel WordPress Framework
@since			3.0.4
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
====================================================================================================
*/

jQuery(document).ready(function($) {
    
    var file_frame;
	
	jQuery('#gp_tax_add_image').live('click', function(event){
		
		event.preventDefault();
		
		if (file_frame) {
            file_frame.open();
            return;
		}
		
		file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select An Image',
            button: { text: 'Use Image' },
            class: $(this).attr('id')
		});
		
		file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
            $('#gp_tax_image_preview').attr('src', attachment.url).css('display', 'block');
            $('#gp_tax_image').attr('value', attachment.id);
            $('#gp_tax_remove_image').css('display', 'inline-block');
		});
		
		file_frame.open();
		
	});
    
    $('#gp_tax_remove_image').on('click', function(e) {
        e.preventDefault();
        $(this).css('display', 'none');
        $('#gp_tax_image_preview').css('display', 'none');
        $('#gp_tax_image').attr('value', '');
    });
    
});
