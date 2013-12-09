/*
====================================================================================================
@name 			jQuery Plupload
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
====================================================================================================
*/

jQuery(document).ready(function($) {

	var gp_image_uploaders = {},
		max;

	$('.gp-uploaded').each(function() {
		
		var $this = $(this),
			$lis = $this.children(),
			$title = $this.siblings('.gp-uploaded-title');
		
		if (0 == $lis.length) {
			$title.addClass('hidden');
			$this.addClass('hidden');
		}
		
	});

	$('.gp-images').on('click', '.gp-delete-file', function() {

		var $images = $(this).parents('.gp-images'),
			uploaded = $images.children().length - 1,
			$dragndrop = $images.siblings('.gp-drag-drop');

		if (0 == uploaded) {
			$images.siblings('.gp-uploaded-title').addClass('hidden');
			$images.addClass('hidden');
		}

		$dragndrop.show();
		
	});

	$('input:hidden.gp-image-prefix').each(function() {
		var prefix = $(this).val(),
			nonce = $('#nonce-upload-images_' + prefix ).val();
			
		var container = prefix + '-container';
			browse_button = prefix + '-browse-button';
			drop_element = prefix + '-dragdrop';
			filters = $('#' + container + ' .filters').val();
		
		gp_plupload_init = $.extend({
			container    	: container,
			browse_button	: browse_button,
			drop_element 	: drop_element,
			filters 		: [{ title : "Allowed Files", extensions : filters }]
		}, gp_plupload_defaults);
		
		gp_plupload_init['multipart_params'] = {
			action  : 'gp_plupload_image_upload',
			field_id: prefix,
			_wpnonce: nonce,
			post_id : $('#post_ID').val(),
			force_delete: $(this).data('force_delete')
		};

		gp_image_uploaders[prefix] = new plupload.Uploader(gp_plupload_init);
		gp_image_uploaders[prefix].init();

		gp_image_uploaders[prefix].bind('FilesAdded', function(up, files) {
			
			var max_file_uploads = $('#' + this.settings.container + ' .max_file_uploads').val(),
				uploaded = $('#' + this.settings.container + ' .gp-uploaded').children().length,
				msg = 'You may only upload ' + max_file_uploads + ' file';
			
			if (max_file_uploads > 1) {
				msg += 's';
			}

			if ((uploaded + files.length) > max_file_uploads) {
				for (var i = files.length; i--;) {
					up.removeFile(files[i]);
				}
				alert(msg);
				return false;
			}

			if ((uploaded + files.length) == max_file_uploads) {
				$('#' + this.settings.container).find('.gp-drag-drop').hide();
			}

			max = parseInt(up.settings.max_file_size, 10);

			plupload.each(files, function(file) {
				add_loading( up, file );
				add_throbber( file );
				if ( file.size >= max )
					remove_error( file );
			});
			
			up.refresh();
			up.start();
			
		});

		gp_image_uploaders[prefix].bind('Error', function(up, e) {
			add_loading(up, e.file);
			remove_error(e.file);
			up.removeFile(e.file);
		});

		gp_image_uploaders[prefix].bind('UploadProgress', function(up, file) {
			
			var $uploaded = $('#' + this.settings.container + ' .gp-uploaded'),
				$uploaded_title = $('#' + this.settings.container + ' .gp-uploaded-title');

			$('div.gp-image-uploading-bar', 'li#' + file.id).css('height', file.percent + '%');

			$uploaded.removeClass('hidden');
			$uploaded_title.removeClass('hidden');
			
		});

		gp_image_uploaders[prefix].bind('FileUploaded', function(up, file, response) {
			var res = wpAjax.parseAjaxResponse($.parseXML( response.response ), 'ajax-response');
			false === res.errors ? $('li#' + file.id).replaceWith(res.responses[0].data) : remove_error(file);
		});
		
	});

	function remove_error(file) {
		$('li#' + file.id)
			.addClass('gp-image-error')
			.delay(1600)
			.fadeOut('slow', function()	{
				$(this).remove();
			}
		);
	}

	function add_loading(up, file) {
		$list = $('#' + up.settings.container).find('ul');
		$list.append("<li id='" + file.id + "'><div class='gp-image-uploading-bar'></div><div id='" + file.id + "-throbber' class='gp-image-uploading-status'></div></li>");
	}

	function add_throbber(file) {
		$('#' + file.id + '-throbber').html("<img class='gp-loader' height='64' width='64' src='" + GP.url + "images/loading.gif' />");
	}
} );
