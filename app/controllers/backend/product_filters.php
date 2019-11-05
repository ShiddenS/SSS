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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $return_url = 'product_filters.manage';

    if ($mode == 'update') {
        $filter_id = fn_update_product_filter($_REQUEST['filter_data'], $_REQUEST['filter_id'], DESCR_SL);
        $return_url = 'product_filters.update&filter_id=' . $filter_id;
    }

    if ($mode == 'delete') {
        if (!empty($_REQUEST['filter_id'])) {
            if (fn_allowed_for('ULTIMATE')) {
                if (!fn_check_company_id('product_filters', 'filter_id', $_REQUEST['filter_id'])) {
                    fn_company_access_denied_notification();

                    return array(CONTROLLER_STATUS_REDIRECT, 'product_filters.manage');
                }
            }

            fn_delete_product_filter($_REQUEST['filter_id']);
        }
    }

   

    if(!empty($_REQUEST['return_url'])) {
        $return_url = $_REQUEST['return_url'];
    }

    return array(CONTROLLER_STATUS_OK, $return_url);
}

if ($mode == 'manage' || $mode == 'picker') {

    $params = $_REQUEST;
    $params['get_descriptions'] = true;

    list($filters, $search) = fn_get_product_filters($params, Registry::get('settings.Appearance.admin_elements_per_page'));

    Tygh::$app['view']->assign('filters', $filters);
    Tygh::$app['view']->assign('search', $search);

    if ($mode == 'manage') {
        $company_id = fn_get_runtime_company_id();
        $fields = fn_get_product_filter_fields();

        if (!empty($company_id)) {
            $field_filters = db_get_fields("SELECT field_type FROM ?:product_filters WHERE field_type != '' GROUP BY field_type");

            foreach ($fields as $key => $field) {
                if (in_array($key, $field_filters)) {
                    unset($fields[$key]);
                }
            }
        }

        Tygh::$app['view']->assign('filter_fields', $fields);

        if (empty($filters) && defined('AJAX_REQUEST')) {
            Tygh::$app['ajax']->assign('force_redirection', fn_url('product_filters.manage'));
        }

        $params = array(
            'variants' => true,
            'plain' => true,
            'feature_types' => array(ProductFeatures::SINGLE_CHECKBOX, ProductFeatures::TEXT_SELECTBOX, ProductFeatures::EXTENDED, ProductFeatures::NUMBER_SELECTBOX, ProductFeatures::MULTIPLE_CHECKBOX, ProductFeatures::NUMBER_FIELD, ProductFeatures::DATE),
            'exclude_group' => true,
            'exclude_filters' => !empty($company_id)
        );

        list($filter_features) = fn_get_product_features($params, 0, DESCR_SL);

        Tygh::$app['view']->assign('filter_features', $filter_features);
    }

    if ($mode == 'picker') {
        Tygh::$app['view']->display('pickers/filters/picker_contents.tpl');
        exit;
    }

} elseif ($mode == 'update') {

    $params = $_REQUEST;
    $params['get_variants'] = true;

    $fields = fn_get_product_filter_fields();
    list($filters) = fn_get_product_filters($params);
    foreach ($filters as &$filter) {
        $filter['slider'] = fn_get_filter_is_numeric_slider($filter);
    }

    Tygh::$app['view']->assign('filter', array_shift($filters));
    Tygh::$app['view']->assign('filter_fields', $fields);
    Tygh::$app['view']->assign('in_popup', !empty($_REQUEST['in_popup']));

    if (fn_allowed_for('ULTIMATE') && !Registry::get('runtime.company_id')) {
        Tygh::$app['view']->assign('picker_selected_companies', fn_ult_get_controller_shared_companies($_REQUEST['filter_id']));
    }

}
