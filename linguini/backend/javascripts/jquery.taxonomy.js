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
    
    var tbframe_interval;

    $('#gp_tax_add_image').click(function() {
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        tbframe_interval = setInterval(function() {$('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
        return false;
    });

    $('#gp_tax_remove_image').click(function() {
        $('#gp_tax_image').val('');
        $('#gp_tax_image_classes').val('');
        $('#gp_tax_image_preview').css('display', 'none');
        $('#gp_tax_add_image').css('display', 'inline-block');
        $('#gp_tax_remove_image').css('display', 'none');
    });

    window.send_to_editor = function(html) {
        clearInterval(tbframe_interval);
        img = $(html).find('img').andSelf().filter('img');
        imgurl = img.attr('src');
        imgclass = img.attr('class');
        $('#gp_tax_image').val(imgurl);
        $('#gp_tax_image_classes').val(imgclass);
        $('#gp_tax_image_preview').attr('src', imgurl).css('display', 'block');
        $('#gp_tax_add_image').css('display', 'none');
        $('#gp_tax_remove_image').css('display', 'inline-block');
        tb_remove();
    };
    
});
