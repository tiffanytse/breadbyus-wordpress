<?php

/*

@name 			Dinner Taxonomy
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

if (!function_exists('gp_register_taxonomy_dinner')) {

    function gp_register_taxonomy_dinner() {
        
        register_taxonomy('menu-dinner-categories', 'menu-dinner',
            array(
                'labels' => array(
                    'name'                  => __('Dinner Categories', 'gp'),
                    'singular_name'         => __('Dinner Category', 'gp'),
                    'search_items'          => __('Search Dinner Category', 'gp'),
                    'popular_items'         => __('Popular Dinner Categories', 'gp'),
                    'all_items'             => __('All Dinner Categories', 'gp'),
                    'parent_item'           => __('Parent Dinner Category', 'gp'),
                    'parent_item_colon'     => __('Parent Dinner Category:', 'gp'),
                    'edit_item'             => __('Edit Dinner Category', 'gp'),
                    'update_item'           => __('Update Dinner Category', 'gp'),
                    'add_new_item'          => __('Add New Dinner Category', 'gp'),
                    'new_item_name'         => __('New Dinner Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'dinner-category',
                    'with_front'            => false
                ),
                'label'                 => __('Dinner Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_dinner');

}