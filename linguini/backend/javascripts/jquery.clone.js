/*
====================================================================================================
@name			jQuery Clone
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		2013 Pavel RICHTER
====================================================================================================
*/

jQuery(document).ready(function($) {
	"use strict";
	
	toggle_remove_buttons();

	function add_cloned_fields($input) {
		
		var $clone_last = $input.find('.gp-clone:last'),
			$clone = $clone_last.clone(),
			$input, name;

		$clone.insertAfter($clone_last);
		$input = $clone.find(':input');

		// Reset value
		$input.val('');

		// Get the field name, and increment
		name = $input.attr('name').replace( /\[(\d+)\]/, function(match, p1) {
			return '[' + ( parseInt( p1 ) + 1 ) + ']';
		});

		// Update the "name" attribute
		$input.attr('name', name);

		// Toggle remove buttons
		toggle_remove_buttons($input);

		// Fix color picker
		if ('function' === typeof gp_update_color_picker)
			gp_update_color_picker();

		// Fix date picker
		if ('function' === typeof gp_update_date_picker)
			gp_update_date_picker();

		// Fix time picker
		if ('function' === typeof gp_update_time_picker)
			gp_update_time_picker();

		// Fix datetime picker
		if ('function' === typeof gp_update_datetime_picker)
			gp_update_datetime_picker();
	}

	// Add more clones
	$('.add-clone').click(function() {
		"use strict";
		
		var $input = $(this).parents('.gp-field'),
			$clone_group = $(this).parents('.gp-block').attr("clone-group");

		// If the field is part of a clone group, get all fields in that
		// group and itterate over them
		if ($clone_group) {
			// Get the parent metabox and then find the matching
			// clone-group elements inside
			var $metabox = $(this).parents('.inside');
			var $clone_group_list = $metabox.find('div[clone-group="' + $clone_group + '"]');

			$.each($clone_group_list.find('.gp-field'),
				function(key, value) {
					add_cloned_fields($(value));
				});
		} else {
			add_cloned_fields($input);
		}

		toggle_remove_buttons($input);

		return false;
		
	});

	// Remove clones
	$('.gp-field').delegate('.remove-clone', 'click', function() {
		"use strict";
		
		var $this = $(this),
			$input = $this.parents('.gp-field'),
			$clone_group = $(this).parents('.gp-block').attr('clone-group');

		// Remove clone only if there're 2 or more of them
		if ($input.find('.gp-clone').length <= 1)
			return false;

		if ($clone_group) {
			// Get the parent metabox and then find the matching
			// clone-group elements inside
			var $metabox = $(this).parents('.inside');
			var $clone_group_list = $metabox.find('div[clone-group="' + $clone_group + '"]');
			var $index = $this.parent().index();

			$.each($clone_group_list.find('.gp-field'),
				function(key, value) {
					$(value).children('.gp-clone').eq( $index ).remove();
					// Toggle remove buttons
					toggle_remove_buttons($(value));
				});
		} else {
			$this.parent().remove();
			// Toggle remove buttons
			toggle_remove_buttons($input);
		}

		return false;
		
	});

	function toggle_remove_buttons($el) {
		"use strict";
		
		var $button;
		if (!$el)
			$el = $('.gp-block');
		$el.each( function() {
			$button = $(this).find('.remove-clone');
			$button.length < 2 ? $button.hide() : $button.show();
		});
	}
	
});