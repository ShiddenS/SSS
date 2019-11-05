<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

$schema = array(
    'section' => 'products',
    'name' => __('images'),
    'pattern_id' => 'product_images',
    'key' => array('product_id'),
    'order' => 2,
    'table' => 'products',
    'permissions' => array(
        'import' => 'manage_catalog',
        'export' => 'view_catalog',
    ),
    'references' => array(
        'images_links' => array(
            'reference_fields' => array('object_id' => '#key', 'object_type' => 'product'),
            'join_type' => 'LEFT',
            'import_skip_db_processing' => true
        ),
    ),
    'update_only' => true,
    'range_options' => array(
        'selector_url' => 'products.manage',
        'object_name' => __('products'),
    ),
    'notes' => array(
        'text_exim_import_images_note',
    ),
    'condition' => array(
        'use_company_condition' => true,
    ),
    'options' => array(
        'images_path' => array(
            'title' => 'images_directory',
            'description' => 'text_images_directory',
            'type' => 'input',
            'default_value' => 'exim/backup/images/',
            'notes' => __('text_file_editor_notice', array('[href]' => fn_url('file_editor.manage?path=/'))),
        ),
        'remove_images' => array(
            'title' => 'exim_remove_additional_images',
            'description' => 'text_remove_additional_images',
            'type' => 'checkbox',
            'import_only' => true
        ),
    ),
    'import_get_primary_object_id' => array(
        'fill_primary_object_company_id' => array(
            'function' => 'fn_exim_apply_company',
            'args' => array('$pattern', '$alt_keys', '$object', '$skip_get_primary_object_id'),
            'import_only' => true,
        ),
    ),
    'export_fields' => array(
        'Product code' => array(
            'required' => true,
            'alt_key' => true,
            'db_field' => 'product_code'
        ),
        'Pair type' => array(
            'db_field' => 'type',
            'table' => 'images_links',
            'required' => true
        ),
        'Thumbnail' => array(
            'process_get' => array('fn_exim_export_image', '#this', 'product', '@images_path'),
            'table' => 'images_links',
            'db_field' => 'image_id',
            'use_put_from' => '%Detailed image%'
        ),
        'Detailed image' => array(
            'process_get' => array('fn_exim_export_image', '#this', 'detailed', '@images_path'),
            'db_field' => 'detailed_id',
            'table' => 'images_links',
            'process_put' => array('fn_exim_import_images', '@images_path', '%Thumbnail%', '#this', '%Position%', '%Pair type%', '#key', 'product')
        ),
        'Position' => array(
            'db_field' => 'position',
            'table' => 'images_links',
            'use_put_from' => '%Detailed image%',
        ),
    ),
);

if (fn_allowed_for('ULTIMATE')) {
    $schema['import_process_data']['check_product_company_id'] = array(
        'function' => 'fn_import_check_product_company_id',
        'args' => array('$primary_object_id', '$object', '$pattern', '$options', '$processed_data', '$processing_groups', '$skip_record'),
        'import_only' => true,
    );
}

return $schema;