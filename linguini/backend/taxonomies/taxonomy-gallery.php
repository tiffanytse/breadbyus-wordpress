<?php

/*

@name 			Gallery Taxonomy
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

if (!function_exists('gp_register_taxonomy_gallery')) {

    function gp_register_taxonomy_gallery() {
        
        register_taxonomy('category-gallery', 'gallery',
            array(
                'labels' => array(
                    'name'                  => __('Categories', 'gp'),
                    'singular_name'         => __('Gallery Category', 'gp'),
                    'search_items'          => __('Search Gallery Category', 'gp'),
                    'popular_items'         => __('Popular Gallery Categories', 'gp'),
                    'all_items'             => __('All Gallery Categories', 'gp'),
                    'parent_item'           => __('Parent Gallery Category', 'gp'),
                    'parent_item_colon'     => __('Parent Gallery Category:', 'gp'),
                    'edit_item'             => __('Edit Gallery Category', 'gp'),
                    'update_item'           => __('Update Gallery Category', 'gp'),
                    'add_new_item'          => __('Add New Gallery Category', 'gp'),
                    'new_item_name'         => __('New Gallery Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'gallery-category',
                    'with_front'            => false
                ),
                'label'                 => __('Gallery Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_gallery');

}