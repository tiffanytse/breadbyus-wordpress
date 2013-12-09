<?php

/*

@name 			Video Taxonomy
@package		GPanel WordPress Framework
@since			3.0.3
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Taxonomy Register
====================================================================================================
*/

if (!function_exists('gp_register_taxonomy_video')) {

    function gp_register_taxonomy_video() {
        
        register_taxonomy('category-video', 'video',
            array(
                'labels' => array(
                    'name'                  => __('Categories', 'gp'),
                    'singular_name'         => __('Video Category', 'gp'),
                    'search_items'          => __('Search Video Category', 'gp'),
                    'popular_items'         => __('Popular Video Categories', 'gp'),
                    'all_items'             => __('All Video Categories', 'gp'),
                    'parent_item'           => __('Parent Video Category', 'gp'),
                    'parent_item_colon'     => __('Parent Video Category:', 'gp'),
                    'edit_item'             => __('Edit Video Category', 'gp'),
                    'update_item'           => __('Update Video Category', 'gp'),
                    'add_new_item'          => __('Add New Video Category', 'gp'),
                    'new_item_name'         => __('New Video Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'video-category',
                    'with_front'            => false
                ),
                'label'                 => __('Video Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_video');

}