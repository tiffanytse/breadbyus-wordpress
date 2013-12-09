<?php

/*

@name 			Drink Taxonomy
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

if (!function_exists('gp_register_taxonomy_drink')) {

    function gp_register_taxonomy_drink() {
        
        register_taxonomy('menu-drink-categories', 'menu-drink',
            array(
                'labels' => array(
                    'name'                  => __('Drink Categories', 'gp'),
                    'singular_name'         => __('Drink Category', 'gp'),
                    'search_items'          => __('Search Drink Category', 'gp'),
                    'popular_items'         => __('Popular Drink Categories', 'gp'),
                    'all_items'             => __('All Drink Categories', 'gp'),
                    'parent_item'           => __('Parent Drink Category', 'gp'),
                    'parent_item_colon'     => __('Parent Drink Category:', 'gp'),
                    'edit_item'             => __('Edit Drink Category', 'gp'),
                    'update_item'           => __('Update Drink Category', 'gp'),
                    'add_new_item'          => __('Add New Drink Category', 'gp'),
                    'new_item_name'         => __('New Drink Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'drink-category',
                    'with_front'            => false
                ),
                'label'                 => __('Drink Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_drink');

}