/*
====================================================================================================
@name 			jQuery Upload
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
====================================================================================================
*/

jQuery(document).ready(function($) {

	$('.gp-add-file').click(function() {
		
		var $this = $(this), $first = $this.parent().find('.gp-upload:first');
		$first.clone().insertBefore($this);
		return false;
		
	});

	$('.gp-uploaded').delegate('.gp-delete-file', 'click', function() {
		
		var $this = $(this),
			$parent = $this.parents('li'),
			field_id = $this.data('field_id'),
			data = {
				action       : 'gp_delete_file',
				_wpnonce     : $('#nonce-delete-file_' + field_id).val(),
				post_id      : $('#post_ID').val(),
				field_id     : field_id,
				attachment_id: $this.data('attachment_id'),
				force_delete : $this.data('force_delete')
			};

		$.post(ajaxurl, data, function(r) {
			var res = wpAjax.parseAjaxResponse(r, 'ajax-response');
			if (res.errors) {
				alert(res.responses[0].errors[0].message);
			} else {
				$parent.remove();
			}
		}, 'xml');

		return false;

	});
	
});