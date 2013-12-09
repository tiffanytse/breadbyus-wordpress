<?php

/*

@name			GPanel Taxonomy Images Init
@package		GPanel WordPress Framework
@since			3.0.4
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Get Taxonomy Images
====================================================================================================
*/

/* Get the source URL of the requested taxonomy term image */

function gp_get_taxonomy_image_src($tax_term, $size = 'thumbnail') {
    
    if (!is_object($tax_term)) return false;
    
    $src = get_option('gp_tax_image_' . $tax_term->taxonomy . '_' . $tax_term->term_id);
    $tmp = false;
    
    if (is_numeric($src)) {
        
        $tmp = wp_get_attachment_image_src( $src, $size );
        
        if ($tmp && !is_wp_error($tmp) && is_array($tmp) && count($tmp) >= 3) {
            $tmp = array('ID' => $src, 'src' => $tmp[0], 'width' => $tmp[1], 'height' => $tmp[2]);
        } else {
            return false;
        }
        
    } else if (!empty($src)) {
        
        $tmp = array('src' => $src);
        
    }
    
    if ($tmp && !is_wp_error($tmp) && is_array($tmp) && isset($tmp['src'])) {
        return $tmp;
    } else {
        return false;
    }
    
}

/* Get the html needed to display the taxonomy term image */

function gp_get_taxonomy_image($tax_term, $size = 'thumbnail') {
    
    $image = gp_get_taxonomy_image_src($tax_term, $size);
    
    if (!$image) return false;
    
    return '<img src="' . $image['src'] . '" alt="' . $tax_term->name . '" class="taxonomy-term-image" width="' . (($image['width']) ? $image['width'] : '') . '" height="' . (($image['height']) ? $image['height'] : '') . '" />';
    
}

/* Echo out the html needed to display the taxonomy term image */

function gp_taxonomy_image($tax_term, $size = 'thumbnail') {
    
    $img = gp_get_taxonomy_image($tax_term, $size);
    
    if ($img) echo $img;
    
}