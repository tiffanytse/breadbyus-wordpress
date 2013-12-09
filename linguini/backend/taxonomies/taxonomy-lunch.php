<?php

/*

@name 			Lunch Taxonomy
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

if (!function_exists('gp_register_taxonomy_lunch')) {

    function gp_register_taxonomy_lunch() {
        
        register_taxonomy('menu-lunch-categories', 'menu-lunch',
            array(
                'labels' => array(
                    'name'                  => __('Lunch Categories', 'gp'),
                    'singular_name'         => __('Lunch Category', 'gp'),
                    'search_items'          => __('Search Lunch Category', 'gp'),
                    'popular_items'         => __('Popular Lunch Categories', 'gp'),
                    'all_items'             => __('All Lunch Categories', 'gp'),
                    'parent_item'           => __('Parent Lunch Category', 'gp'),
                    'parent_item_colon'     => __('Parent Lunch Category:', 'gp'),
                    'edit_item'             => __('Edit Lunch Category', 'gp'),
                    'update_item'           => __('Update Lunch Category', 'gp'),
                    'add_new_item'          => __('Add New Lunch Category', 'gp'),
                    'new_item_name'         => __('New Lunch Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'lunch-category',
                    'with_front'            => false
                ),
                'label'                 => __('Lunch Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_lunch');

}