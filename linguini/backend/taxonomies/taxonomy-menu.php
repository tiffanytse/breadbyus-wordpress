<?php

/*

@name 			Menu Taxonomy
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

if (!function_exists('gp_register_taxonomy_menu')) {

    function gp_register_taxonomy_menu() {
        
        register_taxonomy('menu-type', 'menu',
            array(
                'labels' => array(
                    'name'                  => __('Menus', 'gp'),
                    'singular_name'         => __('Menu', 'gp'),
                    'search_items'          => __('Search Menus', 'gp'),
                    'popular_items'         => __('Popular Menus', 'gp'),
                    'all_items'             => __('All Menus', 'gp'),
                    'parent_item'           => __('Parent Menu', 'gp'),
                    'parent_item_colon'     => __('Parent Menu:', 'gp'),
                    'edit_item'             => __('Edit Menu', 'gp'),
                    'update_item'           => __('Update Menu', 'gp'),
                    'add_new_item'          => __('Add New Menu', 'gp'),
                    'new_item_name'         => __('New Menu Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'menu',
                    'with_front'            => false
                ),
                'label'                 => __('Menus', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_menu');

}