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

use Tygh\Enum\ProductFeatures;
use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

$_REQUEST['variant_id'] = empty($_REQUEST['variant_id']) ? 0 : $_REQUEST['variant_id'];

if (empty($action)) {
    $action = 'show_all';
}

$list = 'features';

if (empty(Tygh::$app['session']['excluded_features'])) {
    Tygh::$app['session']['excluded_features'] = array();
}

if (empty(Tygh::$app['session']['excluded_features'])) {
    Tygh::$app['session']['excluded_features'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Add feature to comparison list
    if ($mode == 'add_feature') {
        if (!empty($_REQUEST['add_features'])) {
            Tygh::$app['session']['excluded_features'] = array_diff(Tygh::$app['session']['excluded_features'], $_REQUEST['add_features']);
        }
    }

    return array(CONTROLLER_STATUS_OK);
}

// Add product to comparison list
if ($mode == 'add_product') {
    if (empty(Tygh::$app['session']['comparison_list'])) {
        Tygh::$app['session']['comparison_list'] = array();
    }

    $p_id = $_REQUEST['product_id'];

    if (!in_array($p_id, Tygh::$app['session']['comparison_list'])) {
        array_unshift(Tygh::$app['session']['comparison_list'], $p_id);
        $product_data = fn_get_product_data($p_id, $auth);
        fn_gather_additional_product_data($product_data, true, true);

        $product_data['amount'] = 1;
        $product_data['display_price'] = $product_data['price'];

        $added_products = array(
            $p_id => $product_data
        );
        Tygh::$app['view']->assign('added_products', $added_products);

        fn_set_notification(
            'I',
            __('product_added_to_cl'),
            Tygh::$app['view']->fetch('views/product_features/components/product_notification.tpl'),
            'I'
        );
    } else {
        fn_set_notification('W', __('notice'), __('product_in_comparison_list'));
    }

    return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'clear_list') {
    unset(Tygh::$app['session']['comparison_list']);
    unset(Tygh::$app['session']['excluded_features']);

    if (defined('AJAX_REQUEST')) {
        Tygh::$app['view']->assign('compared_products', array());
        Tygh::$app['view']->display('blocks/static_templates/feature_comparison.tpl');
        exit;
    }

    return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'delete_product' && !empty($_REQUEST['product_id'])) {
    $key = array_search ($_REQUEST['product_id'], Tygh::$app['session']['comparison_list']);
    unset(Tygh::$app['session']['comparison_list'][$key]);

    return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'delete_feature') {
    Tygh::$app['session']['excluded_features'][] = $_REQUEST['feature_id'];

    return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'compare') {
    fn_add_breadcrumb(__('feature_comparison'));
    if (!empty(Tygh::$app['session']['comparison_list'])) {
        Tygh::$app['view']->assign('comparison_data', fn_get_product_data_for_compare(Tygh::$app['session']['comparison_list'], $action));
        Tygh::$app['view']->assign('total_products', count(Tygh::$app['session']['comparison_list']));
    }
    Tygh::$app['view']->assign('list', $list);
    Tygh::$app['view']->assign('action', $action);

    if (!empty(Tygh::$app['session']['continue_url'])) {
        Tygh::$app['view']->assign('continue_url', Tygh::$app['session']['continue_url']);
    }
}

if ($mode == 'view_all') {

    $filter_id = !empty($_REQUEST['filter_id']) ? $_REQUEST['filter_id'] : 0;

    if (empty($filter_id)) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    list($filters) = fn_get_filters_products_count($_REQUEST);

    if (empty($filters[$filter_id]) || $filters[$filter_id]['feature_type'] != ProductFeatures::EXTENDED) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    fn_add_breadcrumb($filters[$filter_id]['filter']);

    $variants = array();
    if (!empty($filters[$filter_id]['variants'])) {
        foreach ($filters[$filter_id]['variants'] as $variant) {
            $variants[fn_substr($variant['variant'], 0, 1)][] = $variant;
        }
    }
    ksort($variants);

    Tygh::$app['view']->assign('variants', $variants);

} elseif ($mode == 'view') {

    $variant_data = fn_get_product_feature_variant($_REQUEST['variant_id']);
    $variant_id = $_REQUEST['variant_id'];
    $status_variant = db_get_field("SELECT ?:product_features.status FROM ?:product_features INNER JOIN ?:product_feature_variants ON ?:product_features.feature_id = ?:product_feature_variants.feature_id WHERE ?:product_feature_variants.variant_id = ?i", $variant_id);
    $disabled = 'D';

    if (empty($variant_data) || $status_variant == $disabled) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    } else {
        $feature_data = fn_get_product_feature_data($variant_data['feature_id']);
        if (empty($feature_data)) {
            return array(CONTROLLER_STATUS_NO_PAGE);
        }
    }

    Tygh::$app['view']->assign('variant_data', $variant_data);

    fn_add_breadcrumb($variant_data['variant']);

    // Override meta description/keywords
    if (!empty($variant_data['meta_description']) || !empty($variant_data['meta_keywords'])) {
        Tygh::$app['view']->assign('meta_description', $variant_data['meta_description']);
        Tygh::$app['view']->assign('meta_keywords', $variant_data['meta_keywords']);
    }

    // Override page title
    if (!empty($variant_data['page_title'])) {
        Tygh::$app['view']->assign('page_title', $variant_data['page_title']);
    }

    $params = $_REQUEST;
    $params['extend'] = array('description');

    if ($items_per_page = fn_change_session_param(Tygh::$app['session']['search_params'], $_REQUEST, 'items_per_page')) {
        $params['items_per_page'] = $items_per_page;
    }
    if ($sort_by = fn_change_session_param(Tygh::$app['session']['search_params'], $_REQUEST, 'sort_by')) {
        $params['sort_by'] = $sort_by;
    }
    if ($sort_order = fn_change_session_param(Tygh::$app['session']['search_params'], $_REQUEST, 'sort_order')) {
        $params['sort_order'] = $sort_order;
    }

    list($products, $search) = fn_get_products($params, Registry::get('settings.Appearance.products_per_page'));

    if (defined('AJAX_REQUEST') && (!empty($params['features_hash']) && !$products)) {
        fn_filters_not_found_notification();
        exit;
    }

    fn_gather_additional_products_data($products, array(
        'get_icon' => true,
        'get_detailed' => true,
        'get_options' => true,
        'get_discounts' => true,
        'get_features' => false
    ));

    $selected_layout = fn_get_products_layout($_REQUEST);

    Tygh::$app['view']->assign('products', $products);
    Tygh::$app['view']->assign('search', $search);
    Tygh::$app['view']->assign('selected_layout', $selected_layout);
}

function fn_get_product_data_for_compare($product_ids, $action)
{
    $auth = & Tygh::$app['session']['auth'];

    $comparison_data = array(
        'product_features' => array(0 => array())
    );
    $tmp = array();
    foreach ($product_ids as $product_id) {
        $product_data = fn_get_product_data($product_id, $auth, CART_LANGUAGE, '', false, true, false, false, false, false);
        $product_data['detailed_params']['features_compare'] = true;

        $params = array(
            'get_icon' => true,
            'get_detailed' => true,
            'get_options' => true,
            'get_discounts' => true,
            'get_features' => true,
            'features_display_on' => 'A'
        );
        fn_gather_additional_products_data($product_data, $params);

        if (!empty($product_data['product_features'])) {
            foreach ($product_data['product_features'] as $k => $v) {
                if (!empty($v['variants'])) {
                    foreach ($v['variants'] as $key => $variant) {
                        $product_data['product_features'][$k]['variants'][$key]['selected'] = $variant['variant_id'];
                    }
                }

                if ($v['display_on_product'] === 'N' && $v['display_on_catalog'] == 'N' && $v['display_on_header'] == 'N') {
                    continue;
                }

                if ($v['feature_type'] == ProductFeatures::GROUP && empty($v['subfeatures'])) {
                    continue;
                }
                $_features = ($v['feature_type'] == ProductFeatures::GROUP) ? $v['subfeatures'] : array($k => $v);
                $group_id = ($v['feature_type'] == ProductFeatures::GROUP) ? $k : 0;
                $comparison_data['feature_groups'][$k] = $v['description'];
                foreach ($_features as $_k => $_v) {
                    if (in_array($_k, Tygh::$app['session']['excluded_features'])) {
                        if (empty($comparison_data['hidden_features'][$_k])) {
                            $comparison_data['hidden_features'][$_k] = $_v['description'];
                        }
                        continue;
                    }

                    if (empty($comparison_data['product_features'][$group_id][$_k])) {
                        $comparison_data['product_features'][$group_id][$_k] = $_v['description'];
                    }
                }
            }
        }

        $comparison_data['products'][] = $product_data;
        unset($product_data);
    }

    if ($action != 'show_all' && !empty($comparison_data['product_features'])) {
        $value = '';

        foreach ($comparison_data['product_features'] as $group_id => $v) {
            foreach ($v as $feature_id => $_v) {
                unset($value);
                $c = ($action == 'similar_only') ? true : false;
                foreach ($comparison_data['products'] as $product) {
                    $features = !empty($group_id) && isset($product['product_features'][$group_id]['subfeatures']) ? $product['product_features'][$group_id]['subfeatures'] : $product['product_features'];
                    if (empty($features[$feature_id])) {
                        $c = !$c;
                        break;
                    }
                    if (!isset($value)) {
                        $value = fn_get_feature_selected_value($features[$feature_id]);
                        continue;
                    } elseif ($value != fn_get_feature_selected_value($features[$feature_id])) {
                        $c = !$c;
                        break;
                    }
                }

                if ($c == false) {
                    unset($comparison_data['product_features'][$group_id][$feature_id]);
                }
            }
        }
    }

    return $comparison_data;
}

function fn_get_feature_selected_value($feature)
{
    $value = null;

    if (strpos(ProductFeatures::getSelectable(), $feature['feature_type']) !== false) {
        if ($feature['feature_type'] == ProductFeatures::MULTIPLE_CHECKBOX) {
            foreach ($feature['variants'] as $v) {
                if ($v['selected']) {
                    $value[] = $v['variant_id'];
                }
            }
        } else {
            $value = $feature['variant_id'];
        }

    } elseif (strpos(ProductFeatures::NUMBER_FIELD . ProductFeatures::DATE, $feature['feature_type']) !== false) {
        $value = $feature['value_int'];
    } else {
        $value = $feature['value'];
    }

    return $value;
}
