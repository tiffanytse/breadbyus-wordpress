<?php

/*

@name 			Breakfast Taxonomy
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

if (!function_exists('gp_register_taxonomy_breakfast')) {

    function gp_register_taxonomy_breakfast() {
        
        register_taxonomy('menu-breakfast-categories', 'menu-breakfast',
            array(
                'labels' => array(
                    'name'                  => __('Breakfast Categories', 'gp'),
                    'singular_name'         => __('Breakfast Category', 'gp'),
                    'search_items'          => __('Search Breakfast Category', 'gp'),
                    'popular_items'         => __('Popular Breakfast Categories', 'gp'),
                    'all_items'             => __('All Breakfast Categories', 'gp'),
                    'parent_item'           => __('Parent Breakfast Category', 'gp'),
                    'parent_item_colon'     => __('Parent Breakfast Category:', 'gp'),
                    'edit_item'             => __('Edit Breakfast Category', 'gp'),
                    'update_item'           => __('Update Breakfast Category', 'gp'),
                    'add_new_item'          => __('Add New Breakfast Category', 'gp'),
                    'new_item_name'         => __('New Breakfast Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'breakfast-category',
                    'with_front'            => false
                ),
                'label'                 => __('Breakfast Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_breakfast');

}