/*
====================================================================================================
@name			jQuery GPanel Backend
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		2013 Pavel RICHTER
====================================================================================================
*/

/*
====================================================================================================
Init Tabs
----------------------------------------------------------------------------------------------------
@name			jQuery UI
----------------------------------------------------------------------------------------------------
*/

jQuery(document).ready(function() {
	"use strict";
	
	var cookieName = 'activetab',
        $tabs = jQuery('#gp-tabs'),
        $lis = $tabs.find('ul').eq(0).find('li');
	
	jQuery("#gp-tabs").tabs({
		active: ( jQuery.cookies.get( cookieName ) || 0 ),
        activate: function( e, ui )
        {
            jQuery.cookies.set( cookieName, $lis.index(ui.newTab) );
        }
	});
	
});
/*
====================================================================================================
Init Color Picker
----------------------------------------------------------------------------------------------------
@name			jQuery UI
----------------------------------------------------------------------------------------------------
*/

jQuery(document).ready(function() {
	"use strict";
	
	jQuery("input.color_picker").miniColors({
		
		change: function(hex, rgb) {
			console.log(hex);
		}
		
	});
	
});

/*
====================================================================================================
Init Messages
----------------------------------------------------------------------------------------------------
@name			jQuery UI
----------------------------------------------------------------------------------------------------
*/

jQuery(function() {
	"use strict";
	
	var error_msg = jQuery("#message p[class='setting-error-message']");
	if (error_msg.length !== 0) {
		var error_setting = error_msg.attr('title');
		jQuery("label[for='" + error_setting + "']").addClass('error');
		jQuery("input[id='" + error_setting + "']").attr('style', 'border-color: #e1232d !important; color: #e1232d !important;');
	}
	
});