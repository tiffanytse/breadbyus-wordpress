<?php

/*

@name 			Wine Taxonomy
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

if (!function_exists('gp_register_taxonomy_wine')) {

    function gp_register_taxonomy_wine() {
        
        register_taxonomy('menu-wine-categories', 'menu-wine',
            array(
                'labels' => array(
                    'name'                  => __('Wine Categories', 'gp'),
                    'singular_name'         => __('Wine Category', 'gp'),
                    'search_items'          => __('Search Wine Category', 'gp'),
                    'popular_items'         => __('Popular Wine Categories', 'gp'),
                    'all_items'             => __('All Wine Categories', 'gp'),
                    'parent_item'           => __('Parent Wine Category', 'gp'),
                    'parent_item_colon'     => __('Parent Wine Category:', 'gp'),
                    'edit_item'             => __('Edit Wine Category', 'gp'),
                    'update_item'           => __('Update Wine Category', 'gp'),
                    'add_new_item'          => __('Add New Wine Category', 'gp'),
                    'new_item_name'         => __('New Wine Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'wine-category',
                    'with_front'            => false
                ),
                'label'                 => __('Wine Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_wine');

}