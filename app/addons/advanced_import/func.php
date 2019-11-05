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

defined('BOOTSTRAP') or die('Access denied');

use Tygh\Addons\AdvancedImport\Presets\Manager as PresetsManager;
use Tygh\Enum\Addons\AdvancedImport\ImportStrategies;
use Tygh\Tools\SecurityHelper;
use Tygh\Registry;

/**
 * Obtains list of product features for fields mapping.
 *
 * @param \Tygh\Addons\AdvancedImport\Presets\Manager $presets_manager Presets manager instance
 * @param array                                       $schema          Relations schema
 *
 * @return mixed
 */
function fn_advanced_import_get_product_features_list(PresetsManager $presets_manager, array $schema)
{
    list($features, $search,) = fn_get_product_features(
        array(
            'plain'         => true,
            'exclude_group' => true,
        ),
        0,
        $presets_manager->getLangCode()
    );

    foreach ($features as &$feature) {
        $feature['show_description'] = true;
        $feature['show_name'] = false;
    }
    unset($feature);

    return $features;
}

/**
 * Aggregates product features values into a single field when importing a product.
 *
 * @param array $item            Imported product item
 * @param array $aggregated_data Aggregated features values
 *
 * @return array Array containing feature IDs as array keys and feature values as values
 */
function fn_advanced_import_aggregate_features(array $item, array $aggregated_data)
{
    foreach ($aggregated_data['values'] as $key => $value) {
        unset($aggregated_data['values'][$key]);
        if (fn_string_not_empty($value)) {
            list(, $key) = explode('_', $key);
            $aggregated_data['values'][$key] = $value;
        }
    }

    return $aggregated_data['values'];
}

/**
 * Updates product features in the database when importing a product.
 *
 * @param int    $product_id         Product ID
 * @param array  $features_list      Features list from ::fn_advanced_import_aggregate_features()
 * @param string $variants_delimiter Feature variants delimiter
 */
function fn_advanced_import_set_product_features($product_id, $features_list, $variants_delimiter = '///')
{
    if (!$features_list || !is_array($features_list)) {
        return;
    }

    static $features_cache = array();

    /** @var \Tygh\Addons\AdvancedImport\FeaturesMapper $features_mapper */
    $features_mapper = Tygh::$app['addons.advanced_import.features_mapper'];

    $main_lang = $features_mapper->getMainLanguageCode($features_list);

    $features_list = $features_mapper->remap($features_list, $variants_delimiter);

    if ($missing_features = array_diff(array_keys($features_list), array_keys($features_cache))) {
        $features_cache += db_get_hash_array(
            'SELECT feature_id, company_id, feature_type AS type FROM ?:product_features WHERE feature_id IN (?n)',
            'feature_id',
            $missing_features
        );
    }

    foreach ($features_list as $feature_id => &$feature) {
        $feature = array_merge($feature, $features_cache[$feature_id]);
    }
    unset($feature);

    if ($features_list) {
        return fn_exim_save_product_features_values($product_id, $features_list, $main_lang, false);
    }

    return [];
}

/**
 * Updates product images when importing a product.
 *
 * @param int          $product_id        Product ID
 * @param array|string $images            Images from import file
 * @param string       $images_path       Default dir to search files on server
 * @param string       $images_delimiter  Images delimiter
 * @param string       $remove_images     Whether to remove additional images
 * @param array        $preset            Import preset data
 */
function fn_advanced_import_set_product_images($product_id, $images, $images_path, $images_delimiter, $remove_images, $preset)
{
    if (is_string($images) && !fn_string_not_empty($images)
        || is_array($images) && !$images
    ) {
        return;
    }

    if (is_string($images)) {
        $images = explode($images_delimiter, $images);
    }

    foreach ($images as $i => $image) {
        $type = $i === 0 ? 'M' : 'A';

        $image = trim($image);
        if (!$image) {
            continue;
        }

        $options = array(
            'remove_images'     => $remove_images,
            'images_company_id' => $preset['company_id'],
        );
        
        fn_exim_import_images(
            $images_path,
            false,
            $image,
            $i * 10,
            $type,
            $product_id,
            'product',
            $options
        );
    }
}

/**
 * Hook handler: stores import results in the runtime to store them as the import result.
 *
 * @param array $pattern        Import/export pattern
 * @param array $import_data    Imported data
 * @param array $options        Import options
 * @param bool  $result         Import result
 * @param array $processed_data Import results
 */
function fn_advanced_import_import_post($pattern, $import_data, $options, $result, $processed_data)
{
    $processed_data = array_merge(
        Registry::ifGet('runtime.advanced_import.result', array()),
        $processed_data
    );

    Registry::set('runtime.advanced_import.result', $processed_data, true);
}

/**
 * Hook handler: stores notifications in the runtime to store them as the import result.
 *
 * @param string $type          Notification type
 *                              (E - error, W - warning, N - notice, O - order error on checkout, I - information)
 * @param string $title         Notification title
 * @param string $message       Notification message
 * @param string $message_state S - notification will be displayed unless it's closed, K - only once,
 *                              I - will be closed by timer
 * @param mixed  $extra         Extra data to save with notification
 * @param bool   $init_message  $title and $message will be processed by __ function if true
 */
function fn_advanced_import_set_notification_pre($type, $title, $message, $message_state, $extra, $init_message)
{
    if (AREA !== 'A' || $type !== 'E' || !Registry::get('runtime.advanced_import.in_progress')) {
        return;
    }

    $messages_list = Registry::ifGet('runtime.advanced_import.result.msg', array());

    $messages_list[] = $message;

    $messages_list = array_unique($messages_list);

    Registry::set('runtime.advanced_import.result.msg', $messages_list, true);
}

/**
 * Hook handler: removes company presets upon its removal.
 *
 * @param int  $company_id Company ID
 * @param bool $result     Whether company was removed
 */
function fn_advanced_import_delete_company($company_id, $result)
{
    if ($result) {
        /** @var \Tygh\Addons\AdvancedImport\Presets\Manager $presets_manager */
        $presets_manager = Tygh::$app['addons.advanced_import.presets.manager'];

        list($presets_list,) = $presets_manager->find(
            false,
            array('ip.company_id' => $company_id),
            false,
            array('ip.preset_id' => 'preset_id')
        );

        foreach ($presets_list as $preset_id => $preset) {
            $presets_manager->delete($preset_id);
        }
    }
}

/**
 * Wrapper for $presets_manager->find for the LastView functionality
 *
 * @param  array $params Params passed to the find method. Can be all standard search & sorting params.
 *                       E.g.
 *                       [
 *                          'items_per_page' => 10,
 *                          'page'=> 15,
 *                          'object_type' => 'products',
 *                          'preset_id' => 75,
 *                          'sort_by' => 'status',
 *                          'sort_order' => 'asc',
 *                       ]
 *                       See \Tygh\Addons\AdvancedImport\Presets\Manager::find() for reference.
 *
 * @return array        Array with two values: presets list and search parameters for templates
 */
function fn_get_import_presets(array $params)
{
    /** @var \Tygh\Addons\AdvancedImport\Presets\Manager $preset_manager */
    $preset_manager = Tygh::$app['addons.advanced_import.presets.manager'];

    $limit = array();
    if (!empty($params['items_per_page'])) {
        $limit['items_per_page'] = $params['items_per_page'];
    }
    if (!empty($params['page'])) {
        $limit['page'] = $params['page'];
    }
    if (empty($limit)) {
        $limit = false;
    }

    if (!empty($params['object_type'])) {
        $condition = array('ip.object_type' => $params['object_type']);
    }
    if (!empty($params['preset_id'])) {
        $condition = array('ip.preset_id' => $params['preset_id']);
    }
    $sorting = array();
    $sorting['sort_by'] = !empty($params['sort_by']) ? $params['sort_by'] : '';

    if (!empty($params['sort_order'])) {
        $sorting['sort_order'] = $params['sort_order'];
    }
    list($presets, $search) = $preset_manager->find(
        $limit,
        $condition,
        null,
        array('*'),
        $sorting
    );

    return array($presets, $search);
}

/**
 * Wrapper for $preset_manager->getName for the LastView functionality
 *
 * @param  int $preset_id
 *
 * @return bool|string
 */
function fn_get_import_preset_name($preset_id)
{
    $result = false;

    if (!$preset_id
        || !isset(Tygh::$app['addons.advanced_import.presets.manager'])
    ) {
        return $result;
    }

    $preset_manager = Tygh::$app['addons.advanced_import.presets.manager'];
    $result = $preset_manager->getName($preset_id);

    return $result ? $result : false;
}

/**
 * Fetches array of paths to import image directory
 *
 * @param integer $company_id Company id
 * @param string  $path       User specified path
 *
 * @return array
 */
function fn_advanced_import_get_import_images_directory($company_id, $path = '')
{
    if ($path) {
        $path = fn_advanced_import_filter_user_path($path);
    }

    $files_dir = Registry::get('config.dir.files');

    $result = array(
        'absolute_path' => sprintf('%s%s/%s%s', $files_dir, $company_id, ADVANCED_IMPORT_PRIVATE_IMAGES_RELATIVE_PATH, $path),
        'relative_path' => sprintf('%s%s/%s%s', ltrim(fn_get_rel_dir($files_dir), '/'), $company_id, ADVANCED_IMPORT_PRIVATE_IMAGES_RELATIVE_PATH, $path),
        'exim_path' => sprintf('%s%s', ADVANCED_IMPORT_PRIVATE_IMAGES_RELATIVE_PATH, $path),
        'filemanager_path' => sprintf('%s%s', ADVANCED_IMPORT_PRIVATE_IMAGES_RELATIVE_PATH, $path),
    );

    if (!Registry::get('runtime.company_id')) {
        $result['filemanager_path'] = sprintf('%s/%s', $company_id, $result['filemanager_path']);
    }

    return $result;
}

/**
 * Sanitizes user specified path
 *
 * @param string $path User specified path
 *
 * @return string
 */
function fn_advanced_import_filter_user_path($path)
{
    $parts = explode('/', $path);

    foreach ($parts as $key => &$item) {
        $item = SecurityHelper::sanitizeFileName(trim($item, '.'));

        if (!$item) {
            unset($parts[$key]);
        }
    }
    unset($item);

    return implode('/', $parts);
}

/**
 * Fetches array of paths to images directory for each existing company
 *
 * @param string $path user specified path
 *
 * @return array
 */
function fn_advanced_import_get_companies_import_images_directory($path = '')
{
    $result = array();
    $company_ids = fn_get_available_company_ids();

    foreach ($company_ids as $company_id) {
        $result[$company_id] = fn_advanced_import_get_import_images_directory($company_id, $path);
    }

    return $result;
}

/**
 * Decides whether to skip updating existing or creating new products when importing products.
 *
 * @param array $primary_object_id
 * @param array $options
 * @param bool  $skip_record
 */
function fn_advanced_import_skip_updating_or_creating_new_products(
    $primary_object_id,
    $options,
    &$skip_record
) {
    $skip_creating =
        !empty($options['skip_creating_new_products'])
        && $options['skip_creating_new_products'] == 'Y'
        ||
        !empty($options['import_strategy'])
        && $options['import_strategy'] == ImportStrategies::UPDATE_EXISTING;

    $skip_updating =
        !empty($options['import_strategy'])
        && $options['import_strategy'] == ImportStrategies::CREATE_NEW;

    if ($primary_object_id && $skip_updating
        || !$primary_object_id && $skip_creating
    ) {
        $skip_record = true;
    }
}

/**
 * Decides whether to stop products import when test amount of products is imported.
 *
 * @param array $pattern
 * @param array $options
 * @param array $processed_data
 * @param bool  $skip_record
 * @param bool  $stop_import
 */
function fn_advanced_import_test_import(
    $pattern,
    $options,
    $processed_data,
    &$skip_record,
    &$stop_import
) {
    // created and updated
    if (isset($processed_data['by_types'])) {
        $affected_products = 0;
        foreach ($processed_data['by_types'] as $type => $type_processed_data) {
            $affected_products += $type_processed_data['N'] + $type_processed_data['E'];
        }
    } else {
        $affected_products = $processed_data['N'] + $processed_data['E'];
    }

    if (!empty($options['test_import'])
        && $options['test_import'] == 'Y'
        && $affected_products >= $pattern['options']['test_import']['sampling_size']
    ) {
        $skip_record = true;
        $stop_import = true;
    }
}

/**
 * Converts legacy `skip_creating_new_products` option value into the new `import_strategy` one.
 *
 * @param array $option_definition Preset option
 * @param array $preset            Preset definition
 *
 * @return array Preset option with converted value
 */
function fn_advanced_import_set_import_strategy_option_value(array $option_definition, array $preset)
{
    if ($option_definition['selected_value'] !== null) {
        return $option_definition;
    }

    if (isset($preset['options']['skip_creating_new_products']['selected_value'])
        && $preset['options']['skip_creating_new_products']['selected_value'] == 'Y'
    ) {
        $option_definition['selected_value'] = ImportStrategies::UPDATE_EXISTING;
    } else {
        $option_definition['selected_value'] = ImportStrategies::IMPORT_ALL;
    }

    return $option_definition;
}

/**
 * Converts `Import strategy` to `Upgrade only existing products` option when saving a preset.
 *
 * @param string $option_id Option name
 * @param array $option_data Option description
 * @param array $pattern_options Pattern options schema
 * @param array $preset_options Options
 * @param string|null $initial_value Initial option value
 *
 * @return string `Upgrade only existing products` option value to save
 */
function fn_advanced_import_convert_import_strategy_to_set_skip_creating_new_products_option(
    $option_id,
    $option_data,
    $pattern_options,
    $preset_options,
    $initial_value
) {
    if (isset($preset_options['import_strategy'])
        && $preset_options['import_strategy'] == ImportStrategies::UPDATE_EXISTING
    ) {
        return 'Y';
    }

    if ($initial_value !== null) {
        return $initial_value;
    }

    return 'N';
}

/**
 * Get file extension by mime type or name
 *
 * @param string $file_name File Name
 * @param string $file_type File Mime Type
 * 
 * @return string File extension
 */
function fn_advanced_import_get_file_extension_by_mimetype($file_name, $file_type) 
{
    $mime_types_list = fn_get_ext_mime_types('mime');
    $path_info = fn_pathinfo($file_name);
    $ext = strtolower($path_info['extension']);
    
    if (!in_array($ext, $mime_types_list)) {
        $ext = isset($mime_types_list[$file_type]) ? $mime_types_list[$file_type] : null;
    }
    
    return $ext;
}
