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

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $suffix = '.manage';

    if ($mode == 'update') {
        // Update supplier data
        $supplier_id = empty($_REQUEST['supplier_id']) ? 0 : $_REQUEST['supplier_id'];
        $supplier_id = fn_update_supplier($supplier_id, $_REQUEST['supplier_data']);

        if ($supplier_id) {
            $suffix = '.update?supplier_id=' . $supplier_id;
        }
    }

    if ($mode == 'm_delete') {

        if (!empty($_REQUEST['supplier_ids'])) {
            foreach ($_REQUEST['supplier_ids'] as $v) {
                fn_delete_supplier($v);
            }
        }

        $suffix = ".manage";
    }

    if ($mode == 'delete') {
        if (!empty($_REQUEST['supplier_id'])) {
            $supplier_data = fn_get_supplier_data($_REQUEST['supplier_id']);
            if (!empty($supplier_data)) {
                $result = fn_delete_supplier($supplier_data['supplier_id']);
                if ($result) {
                    fn_set_notification('N', __('notice'), __('supplier_deleted'));
                }
            }
        }

        $suffix = '.manage';

    }

    if ($mode == 'update_status') {

        $condition = fn_get_company_condition('?:suppliers.company_id');
        $supplier_data = db_get_row("SELECT * FROM ?:suppliers WHERE supplier_id = ?i $condition", $_REQUEST['id']);
        if (!empty($supplier_data)) {
            $result = fn_update_status_supplier($supplier_data['supplier_id'], $_REQUEST['status']);
            if ($result) {
                fn_set_notification('N', __('notice'), __('status_changed'));
            } else {
                fn_set_notification('E', __('error'), __('error_status_not_changed'));
                Tygh::$app['ajax']->assign('return_status', $supplier_data['status']);
            }
        }
        exit;
    }    

    return array(CONTROLLER_STATUS_OK, 'suppliers' . $suffix);
}

if ($mode == 'manage') {
    list($suppliers, $search) = fn_get_suppliers($_REQUEST, Registry::get('settings.Appearance.admin_elements_per_page'));

    $view = Tygh::$app['view'];
    $view->assign('search', $search);
    $view->assign('suppliers', $suppliers);
    $view->assign('countries', fn_get_simple_countries(true, CART_LANGUAGE));
    $view->assign('states', fn_get_all_states());

} elseif ($mode == 'update' || $mode == 'add') {

    $supplier_id = isset($_REQUEST['supplier_id'])
        ? $_REQUEST['supplier_id']
        : null;

    $tabs = [
        'general'   => [
            'title' => __('general'),
            'js'    => true,
        ],
        'products'  => [
            'title' => __('products'),
            'js'    => true,
        ],
    ];

    if ($supplier_id || fn_allowed_for('MULTIVENDOR') || fn_get_runtime_company_id()) {
        $tabs['shippings'] = [
            'title' => __('shippings'),
            'js'    => true,
        ];
    }

    Registry::set('navigation.tabs', $tabs);

    $supplier = $supplier_id
        ? fn_get_supplier_data($supplier_id)
        : [];

    $company_id = Registry::ifGet('runtime.company_id', null);
    $shippings = fn_get_available_shippings($company_id);
    if (fn_allowed_for('ULTIMATE') && !fn_get_runtime_company_id()) {
        $shippings = fn_suppliers_filter_objects_by_sharing(
            $shippings,
            'shippings',
            'shipping_id',
            'suppliers',
            $supplier_id
        );
    }

    /** @var \Tygh\SmartyEngine\Core $view */
    $view = Tygh::$app['view'];

    $view->assign('shippings', $shippings);
    $view->assign('countries', fn_get_simple_countries(true, CART_LANGUAGE));
    $view->assign('states', fn_get_all_states());

    $view->assign('supplier', $supplier);
}
