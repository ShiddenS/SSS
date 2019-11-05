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

if ($mode == 'options') {
    define('GET_OPTIONS', true);
    $_auth = $auth;
    $params = $_REQUEST;

    // Apply the specific block template settings
    if (!empty($params['appearance'])) {
        foreach ($params['appearance'] as $setting => $value) {
            Tygh::$app['view']->assign($setting, $value);
        }
    }

    Tygh::$app['view']->assign('show_images', true);
    Tygh::$app['view']->assign('no_capture', true);

    if (!fn_get_data_of_changed_product($params, $_auth, $mode)) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    exit;
}

if ($mode == 'picker') {

    $params = $_REQUEST;
    $params['extend'] = array('description');
    $params['skip_view'] = 'Y';
    $params['is_picker'] = true;

    list($products, $search) = fn_get_products($params, AREA == 'C' ? Registry::get('settings.Appearance.products_per_page') : Registry::get('settings.Appearance.admin_elements_per_page'));

    fn_gather_additional_products_data($products, [
        'get_icon'      => true,
        'get_detailed'  => true,
        'get_options'   => !empty($_REQUEST['display']) || AREA === 'C',
        'get_discounts' => true
    ]);

    if (!empty($params['is_order_management'])) {
        Tygh::$app['view']->assign(array(
            'is_order_management'    => $params['is_order_management'],
            'default_product_amount' => 1,
        ));
    }

    Tygh::$app['view']->assign(array(
        'products' => $products,
        'search'   => $search,
    ));

    if (isset($_REQUEST['company_id'])) {
        Tygh::$app['view']->assign('picker_selected_company', $_REQUEST['company_id']);
    }
    if (!empty($_REQUEST['company_ids'])) {
        Tygh::$app['view']->assign('picker_selected_companies', $_REQUEST['company_ids']);
    }

    Tygh::$app['view']->display('pickers/products/picker_contents.tpl');
    exit;

}
