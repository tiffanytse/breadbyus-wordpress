<?php

/*

@name 			Event Taxonomy
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

if (!function_exists('gp_register_taxonomy_event')) {

    function gp_register_taxonomy_event() {
        
        register_taxonomy('category-event', 'event',
            array(
                'labels' => array(
                    'name'                  => __('Categories', 'gp'),
                    'singular_name'         => __('Event Category', 'gp'),
                    'search_items'          => __('Search Event Category', 'gp'),
                    'popular_items'         => __('Popular Event Categories', 'gp'),
                    'all_items'             => __('All Event Categories', 'gp'),
                    'parent_item'           => __('Parent Event Category', 'gp'),
                    'parent_item_colon'     => __('Parent Event Category:', 'gp'),
                    'edit_item'             => __('Edit Event Category', 'gp'),
                    'update_item'           => __('Update Event Category', 'gp'),
                    'add_new_item'          => __('Add New Event Category', 'gp'),
                    'new_item_name'         => __('New Event Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'event-category',
                    'with_front'            => false
                ),
                'label'                 => __('Event Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_event');

}