<?php

/*

@name 			Food Taxonomy
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

if (!function_exists('gp_register_taxonomy_food')) {

    function gp_register_taxonomy_food() {
        
        register_taxonomy('menu-food-categories', 'menu-food',
            array(
                'labels' => array(
                    'name'                  => __('Food Categories', 'gp'),
                    'singular_name'         => __('Food Category', 'gp'),
                    'search_items'          => __('Search Food Category', 'gp'),
                    'popular_items'         => __('Popular Food Categories', 'gp'),
                    'all_items'             => __('All Food Categories', 'gp'),
                    'parent_item'           => __('Parent Food Category', 'gp'),
                    'parent_item_colon'     => __('Parent Food Category:', 'gp'),
                    'edit_item'             => __('Edit Food Category', 'gp'),
                    'update_item'           => __('Update Food Category', 'gp'),
                    'add_new_item'          => __('Add New Food Category', 'gp'),
                    'new_item_name'         => __('New Food Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'food-category',
                    'with_front'            => false
                ),
                'label'                 => __('Food Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_food');

}