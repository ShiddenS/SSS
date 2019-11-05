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
 * 'copyright.txt' FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
 ****************************************************************************/

use Tygh\Addons\ProductVariations\Product\Group\Repository AS GroupRepository;
use Tygh\Addons\ProductVariations\Product\Repository as ProductRepository;
use Tygh\Addons\ProductVariations\Product\Group\Group;
use Tygh\Addons\ProductVariations\Product\FeaturePurposes;
use Tygh\Enum\ProductFeatures;
use Tygh\Registry;
use Tygh\Addons\ProductVariations\ServiceProvider;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

define('PRODUCT_VARIATION_EXIM_CODE_FIELD', 'Variation group code');
define('PRODUCT_VARIATION_EXIM_ID_FIELD', 'Variation group id');
define('PRODUCT_VARIATION_EXIM_PARENT_PRODUCT_ID', 'Variation parent product id');
define('PRODUCT_VARIATION_EXIM_DEFAULT_VARIATION', 'Variation set as default');
define('PRODUCT_VARIATION_EXIM_SUB_GROUP_ID', 'Variation sub group id');
define('PRODUCT_VARIATION_EXIM_FEATURE_FIELD_TEMPLATE', '%s (Variation feature)');

function fn_product_variations_exim_pre_processing(&$pattern, $export_fields)
{
    $feature_ids = [];

    foreach ($export_fields as $field) {
        if (isset($pattern['export_fields'][$field]['feature_id'])) {
            $feature_id = (int) $pattern['export_fields'][$field]['feature_id'];
            $feature_ids[$feature_id] = $feature_id;
        }
    }

    Registry::set('runtime.exim.exported_variation_feature_ids', $feature_ids);

    if (!in_array(PRODUCT_VARIATION_EXIM_CODE_FIELD, $export_fields, true)
        && !in_array(PRODUCT_VARIATION_EXIM_ID_FIELD, $export_fields, true)
        && !isset($export_fields[PRODUCT_VARIATION_EXIM_CODE_FIELD])
        && !isset($export_fields[PRODUCT_VARIATION_EXIM_ID_FIELD])
        && empty($pattern['is_data_feeds'])
    ) {
        return;
    }

    $pattern['references'][GroupRepository::TABLE_GROUP_PRODUCTS] = [
        'reference_fields'          => [
            'product_id' => '#key'
        ],
        'join_type'                 => 'LEFT',
        'import_skip_db_processing' => true
    ];

    $pattern['references'][GroupRepository::TABLE_GROUPS] = [
        'reference_fields'          => [
            'id' => sprintf('#%s.group_id', GroupRepository::TABLE_GROUP_PRODUCTS)
        ],
        'join_type'                 => 'LEFT',
        'import_skip_db_processing' => true
    ];

    $pattern['export_fields'][PRODUCT_VARIATION_EXIM_CODE_FIELD] = [
        'table'    => GroupRepository::TABLE_GROUPS,
        'db_field' => 'code',
    ];

    $pattern['export_fields'][PRODUCT_VARIATION_EXIM_ID_FIELD] = [
        'table'    => GroupRepository::TABLE_GROUPS,
        'db_field' => 'id',
    ];

    $pattern['export_fields'][PRODUCT_VARIATION_EXIM_PARENT_PRODUCT_ID] = [
        'table'    => GroupRepository::TABLE_GROUP_PRODUCTS,
        'db_field' => 'parent_product_id',
    ];
}

function fn_product_variations_exim_pre_export_process($pattern, &$table_fields)
{
    if (!isset($pattern['references'][GroupRepository::TABLE_GROUPS])) {
        return;
    }

    $field_id = sprintf('%s.id', GroupRepository::TABLE_GROUPS);
    $field_code = sprintf('%s.code', GroupRepository::TABLE_GROUPS);
    $field_product_id = sprintf('%s.product_id', GroupRepository::TABLE_GROUP_PRODUCTS);
    $field_parent_id = sprintf('%s.parent_product_id', GroupRepository::TABLE_GROUP_PRODUCTS);
    $field_default_variation = sprintf('%s.variation_set_as_default', GroupRepository::TABLE_GROUP_PRODUCTS);
    $field_sub_group_id = sprintf('%s.variation_sub_group_id', GroupRepository::TABLE_GROUP_PRODUCTS);

    $table_fields[$field_id] = sprintf("%s AS '%s'", $field_id, 'variation_group_id');
    $table_fields[$field_code] = sprintf("%s AS '%s'", $field_code, 'variation_group_code');
    $table_fields[$field_parent_id] = sprintf("%s AS '%s'", $field_parent_id, 'variation_parent_product_id');
    $table_fields[$field_default_variation] = sprintf("(CASE WHEN %s THEN 'N' ELSE 'Y' END) AS '%s'", $field_parent_id, 'variation_set_as_default');
    $table_fields[$field_sub_group_id] = sprintf("CONCAT(%s, '_', (CASE WHEN %s THEN %s ELSE %s END)) AS '%s'",
        $field_id,
        $field_parent_id,
        $field_parent_id,
        $field_product_id,
        'variation_sub_group_id'
    );

}

function fn_product_variations_exim_get_features()
{
    list($features) = fn_get_product_features([
        'exclude_group' => true,
        'purpose'       => FeaturePurposes::getAll(),
        'feature_types' => [
            ProductFeatures::TEXT_SELECTBOX,
            ProductFeatures::NUMBER_SELECTBOX
        ]
    ]);

    return $features;
}

function fn_product_variations_exim_set_variation_group_code($row, $key)
{
    if (isset($row[$key])) {
        return trim($row[$key]);
    } else {
        return null;
    }
}

function fn_product_variations_exim_post_processing($primary_object_ids, $import_data, $processed_data, &$final_import_notification)
{
    $has_variation_group_code = false;
    $has_product_with_zero_quantity = false;

    foreach ($import_data as $item) {
        $item = reset($item);

        if (isset($item['variation_group_code'])) {
            $has_variation_group_code = true;
        }

        if (isset($item['amount']) && (int) $item['amount'] === 0) {
            $has_product_with_zero_quantity = true;
        }

        if ($has_product_with_zero_quantity && $has_variation_group_code) {
            break;
        }
    }

    if ($has_variation_group_code) {
        fn_product_variations_exim_update_variation_groups($primary_object_ids, $import_data, $processed_data, $final_import_notification);
    }

    if ($has_product_with_zero_quantity) {
        fn_product_variations_exim_update_default_variations($primary_object_ids, $import_data, $processed_data, $final_import_notification);
    }
}

function fn_product_variations_exim_update_variation_groups($primary_object_ids, $import_data, $processed_data, &$final_import_notification)
{
    $group_repository = ServiceProvider::getGroupRepository();
    $service = ServiceProvider::getService();

    $product_ids = array_filter(array_column($primary_object_ids, 'product_id'));

    $products_group_info = $group_repository->findGroupInfoByProductIds($product_ids);

    $default_product_ids = [];
    $product_group_ids = [];
    $on_remove_list = [];
    $on_update_list = [];
    $on_move_list = [];
    $on_create_list = [];
    $products_feature_values = [];
    $counter = [
        'created' => 0,
        'removed' => 0,
        'updated' => 0
    ];

    foreach ($import_data as $key => $items) {
        if (empty($primary_object_ids[$key]['product_id'])) {
            continue;
        }

        $product = reset($items);
        $product_id = $primary_object_ids[$key]['product_id'];
        $variation_group = isset($products_group_info[$product_id]) ? $products_group_info[$product_id] : null;
        $variation_set_as_default = $product['variation_set_as_default'] == 'Y' ?  true : false;
        if ($variation_set_as_default) {
            $default_product_ids[] = $product_id;
        }

        $product['variation_group'] = $variation_group;
        $product['product_id'] = $product_id;

        if (empty($product['variation_group_code']) && !empty($variation_group)) {
            $on_remove_list[$variation_group['id']][$product_id] = $product_id;
        } elseif (!empty($product['variation_group_code']) && empty($variation_group)) {
            $on_create_list[$product['variation_group_code']][$product_id] = $product;
        } elseif (!empty($product['variation_group_code']) && !empty($variation_group)
            && $product['variation_group_code'] === $variation_group['code']
        ) {
            $on_update_list[$variation_group['id']][$product_id] = $product;
        } elseif (!empty($product['variation_group_code']) && !empty($variation_group)
            && $product['variation_group_code'] !== $variation_group['code']
        ) {
            $on_move_list[$product['variation_group_code']][$product_id] = $product;
        }

        $product_features = isset($product['product_features']) ? $product['product_features'] : [];
        $products_feature_values[$product_id] = $product_features;
    }

    foreach ($on_remove_list as $group_id => $product_ids) {
        $result = $service->detachProductsFromGroup($group_id, $product_ids);
        $result->showNotifications();

        $counter['removed'] += count($product_ids);
    }

    foreach ($on_move_list as $group_code => $products) {
        $group_id = $group_repository->findGroupIdByCode($group_code);

        if ($group_id) {
            $result = $service->moveProductsToGroup($group_id, array_keys($products), array_intersect_key($products_feature_values, $products));
        } else {
            $result = $service->moveProductsToNewGroup($group_code, array_keys($products), array_intersect_key($products_feature_values, $products));
        }

        $product_group = $result->getData('group', []);
        $product_group_id  = $product_group ? $product_group->getId() : 0;

        $result->showNotifications();

        foreach ($result->getData('products_status', []) as $product_id => $status) {
            if (!Group::isResultError($status)) {
                if ($product_group_id) {
                    $product_group_ids[$product_id] = $product_group_id;
                }
                $counter['updated']++;
            }
        }
    }

    foreach ($on_update_list as $group_id => $products) {
        $result = $service->changeProductsFeatureValues($group_id, array_intersect_key($products_feature_values, $products));

        $result->showNotifications();

        foreach ($result->getData('products_status', []) as $product_id => $status) {
            if (!Group::isResultError($status)) {
                $product_group_ids[$product_id] = $group_id;
                $counter['updated']++;
            }
        }
    }

    foreach ($on_create_list as $group_code => $products) {
        $group_id = $group_repository->findGroupIdByCode($group_code);

        if ($group_id) {
            $result = $service->attachProductsToGroup($group_id, array_keys($products));
        } else {
            $product = reset($products);
            $group_product_ids = array_merge([$product['product_id']], array_keys($products));
            $result = $service->createGroup($group_product_ids, $group_code);
        }

        $product_group = $result->getData('group', []);
        $product_group_id  = $product_group ? $product_group->getId() : 0;

        $result->showNotifications();

        foreach ($result->getData('products_status', []) as $product_id => $status) {
            if (!Group::isResultError($status)) {
                if ($product_group_id) {
                    $product_group_ids[$product_id] = $product_group_id;
                }
                $counter['created']++;
            }
        }
    }

    foreach ($default_product_ids as $default_product_id) {
        if (!empty($product_group_ids[$default_product_id])) {
            $service->setDefaultProduct($product_group_ids[$default_product_id], $default_product_id);
        }
    }

    $final_import_notification = __('product_variations.exim.result_notice', [
        '[new]'               => $processed_data['N'],
        '[exist]'             => $processed_data['E'],
        '[skipped]'           => $processed_data['S'],
        '[total]'             => $processed_data['E'] + $processed_data['N'] + $processed_data['S'],
        '[variation_created]' => $counter['created'],
        '[variation_updated]' => $counter['updated'],
        '[variation_removed]' => $counter['removed'],
    ]);
}

function fn_product_variations_exim_update_default_variations($primary_object_ids, $import_data, $processed_data, &$final_import_notification)
{
    $service = ServiceProvider::getService();
    $product_id_map = ServiceProvider::getProductIdMap();

    $product_ids = array_filter(array_column($primary_object_ids, 'product_id'));
    $product_id_map->addProductIdsToPreload($product_ids);

    foreach ($import_data as $key => $item) {
        if (empty($primary_object_ids[$key]['product_id'])) {
            continue;
        }

        $product_id = $primary_object_ids[$key]['product_id'];
        $item = reset($item);

        if (isset($item['amount']) && (int) $item['amount'] === 0) {
            $service->onChangedProductQuantityInZero($product_id);
        }
    }
}

function fn_product_variations_exim_get_variation_feature_value($product_id, $feature_id)
{
    static $feature_ids;
    static $products_feature_values = [];

    if ($feature_ids === null) {
        $feature_ids = Registry::get('runtime.exim.exported_variation_feature_ids');
    }

    if (!in_array($feature_id, $feature_ids)) {
        return null;
    }

    if (!isset($products_feature_values[$product_id])) {
        $query = ServiceProvider::getQueryFactory()->createQuery(
            ProductRepository::TABLE_PRODUCT_FEATURE_VALUES,
            ['product_id' => $product_id, 'feature_id' => $feature_ids, 'lang_code' => CART_LANGUAGE],
            ['fvd.variant', 'pfv.feature_id'],
            'pfv'
        );

        $query->addInnerJoin('fvd', ProductRepository::TABLE_PRODUCT_FEATURE_VARIANT_DESCRIPTIONS, ['variant_id' => 'variant_id'], ['lang_code' => CART_LANGUAGE]);

        $products_feature_values[$product_id] = $query->column(['feature_id', 'variant']);
    }

    return isset($products_feature_values[$product_id][$feature_id]) ? $products_feature_values[$product_id][$feature_id] : null;
}

function fn_product_variations_exim_get_variation_sub_group_id($data)
{
    return $data['variation_sub_group_id'];
}

function fn_product_variations_exim_get_variation_set_as_default($data)
{
    return $data['variation_group_id'] ? $data['variation_set_as_default'] : '';
}

function fn_product_variations_exim_set_variation_set_as_default($row, $key)
{
    if (isset($row[$key])) {
        return trim($row[$key]);
    } else {
        return null;
    }
}