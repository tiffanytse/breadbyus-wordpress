<?php

/*

@name			Metabox Class
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

// Prevent loading this file directly
defined('ABSPATH') || exit;

/*
====================================================================================================
Metabox Class
====================================================================================================
*/

if (!class_exists('gp_Taxonomy_Images')) {

    class gp_Taxonomy_Images {
        
        function __construct() {
    
            add_action('admin_head', array($this, 'init'));
            add_action('edit_term', array($this, 'save_fields'), 10, 3);
            add_action('create_term', array($this, 'save_fields'), 10, 3);
            
        }
    
        function init() {
            
            $taxes = array(
                'menu-type',
                'menu-food-categories',
                'menu-breakfast-categories',
                'menu-lunch-categories',
                'menu-dinner-categories',
                'menu-drink-categories',
                'menu-wine-categories'
            );
            
            if (is_array($taxes)) {
                
                foreach ($taxes as $tax) {
                    add_action($tax . '_add_form_fields', array($this, 'add_fields'));
                    add_action($tax . '_edit_form_fields', array($this, 'edit_fields'));
                    add_filter("manage_edit-{$tax}_columns", array($this, 'add_taxonomy_column'));
                    add_filter("manage_{$tax}_custom_column", array($this, 'edit_taxonomy_columns'), 10, 3);
                }
                
            }
            
        }
    
        function add_fields() {
            global $wp_version;
            
            $this->setup_field_scripts();
    
            $before_3_5 = false;
            
            if (version_compare($wp_version, '3.5', '<')) {
                $before_3_5 = true;
            }
            ?>
            
                <div class="form-field" style="overflow: hidden;">
                    
                    <label><?php _e('Image', 'gp'); ?></label>
                    <input type="hidden" name="gp_tax_image" id="gp_tax_image" value="" />
                    <input type="hidden" name="gp_tax_image_classes" id="gp_tax_image_classes" value="" />
                    <br/>
                    <img src="" id="gp_tax_image_preview" style="max-width:300px;max-height:300px;float:left;display:none;padding:0 10px 5px 0;" />
                    <a href="#" class="<?php echo ($before_3_5) ? '' : 'button'; ?>" id="gp_tax_add_image"><?php _e('Add / Change Image', 'gp'); ?></a>
                    <a href="#" class="<?php echo ($before_3_5) ? '' : 'button'; ?>" id="gp_tax_remove_image" style="display: none;"><?php _e('Remove Image', 'gp'); ?></a>

                </div>
            
            <?php
        }
    
        function edit_fields($taxonomy) {
            
            $this->setup_field_scripts();
            ?>
            
                <tr class="form-field">
                    <th><label for="gp_tax_image"><?php _e('Image', 'gp'); ?></label></th>
                    <td>
                        <?php $image = gp_get_taxonomy_image_src($taxonomy, 'full'); ?>
                        <input type="hidden" name="gp_tax_image" id="gp_tax_image" value="<?php echo ($image)?$image['src']:''; ?>" />
                        <input type="hidden" name="gp_tax_image_classes" id="gp_tax_image_classes" value="" />
                        <?php $image = gp_get_taxonomy_image_src($taxonomy);  ?>
                        <img src="<?php echo ($image)?$image['src']:''; ?>" id="gp_tax_image_preview" style="max-width: 300px;max-height: 300px;float:left;display: <?php echo($image['src'])?'block':'none'; ?>;padding: 0 10px 5px 0;" />
                        <a href="#" class="button" id="gp_tax_add_image" style=""><?php _e('Add / Change Image', 'gp'); ?></a>
                        <a href="#" class="button" id="gp_tax_remove_image" style="display: <?php echo ( $image['src'] ) ? 'inline-block' : 'none'; ?>;"><?php _e('Remove Image', 'gp'); ?></a>
                    </td>
                </tr>
            
            <?php
        }
    
        function setup_field_scripts() {
            global $wp_version;
            
            if ($wp_version < 3.5) {
			
                // Enqueue Upload for WordPress 3.4 and lower
                wp_enqueue_style('thickbox');
                wp_enqueue_script('gp-taxonomy-images', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.taxonomy.js', array('jquery', 'thickbox'));
                
            } else {
                
                // Enqueue Media
                if (!did_action('wp_enqueue_media')) {
                    wp_enqueue_media();	
                }
                // Enqueue Upload for WordPress 3.5 and higher
                wp_enqueue_media();
                wp_enqueue_script('gp-taxonomy-images', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.taxonomy.3.5.js', array('jquery'));
            
            }

        }
    
        function save_fields($term_id, $tt_id = null, $taxonomy = null) {
            
            $option = "gp_tax_image_{$taxonomy}_{$term_id}";
            
            if (isset($_POST['gp_tax_image']) && ($src = $_POST['gp_tax_image'])) {
                
                if ($src != '') {
                    
                    if (isset($_POST['gp_tax_image_classes']) && preg_match('/wp-image-([0-9]{1,99})/', $_POST['gp_tax_image_classes'], $matches)) {
                    
                        update_option($option, $matches[1]);
                        
                    } else {
                        
                        global $wpdb;
                        
                        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", $src));
                        
                        if (0 < absint( $attachment[0])) {
                            update_option($option, $attachment[0]);
                        } else {
                            update_option($option, $src);
                        }
                        
                    }
                    
                } else {
                    
                    $test = get_option($option);
                    if ($test) {
                        delete_option($option);
                    }
                    
                }
                
            } else {
                
                $test = get_option($option);
                
                if ($test) {
                    delete_option($option);
                }
                
            }
            
        }
    
        function add_taxonomy_column($columns) {
            
            $columns['gp_tax_image_thumb'] = __('Image', 'gp');
            
            return $columns;
            
        }
    
        function edit_taxonomy_columns($out, $column_name, $term_id) {
            
            if ($column_name != 'gp_tax_image_thumb') return $out;
            
            $term = get_term($term_id, $_GET['taxonomy']);
            $image = gp_get_taxonomy_image($term, array(50, 50));
            
            if ($image) $out = $image;
            
            return $out;
            
        }
    
    }

    new gp_Taxonomy_Images;

}