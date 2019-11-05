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

$_REQUEST['promotion_id'] = empty($_REQUEST['promotion_id']) ? 0 : $_REQUEST['promotion_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    fn_trusted_vars('promotion_data', 'promotions');
    $suffix = '';

    //
    // Update promotion
    //
    if ($mode == 'update') {
        if (fn_allowed_for('ULTIMATE') && Registry::get('runtime.company_id')) {
            if (!empty($_REQUEST['promotion_id']) && !fn_check_company_id('promotions', 'promotion_id', $_REQUEST['promotion_id'])) {
                fn_company_access_denied_notification();

                return array(CONTROLLER_STATUS_OK, 'promotions.update?promotion_id=' . $_REQUEST['promotion_id']);
            }
            if (!empty($_REQUEST['promotion_id'])) {
                unset($_REQUEST['promotion_data']['company_id']);
            }
        }

        $promotion_id = fn_update_promotion($_REQUEST['promotion_data'], $_REQUEST['promotion_id'], DESCR_SL);

        $suffix = ".update?promotion_id=$promotion_id";
    }

    //
    // Delete selected promotions
    //
    if ($mode == 'm_delete') {

        if (!empty($_REQUEST['promotion_ids'])) {
            fn_delete_promotions($_REQUEST['promotion_ids']);
        }

        $suffix = ".manage";
    }

    if ($mode == 'delete') {

        if (!empty($_REQUEST['promotion_id'])) {
            fn_delete_promotions($_REQUEST['promotion_id']);
        }

        $suffix = ".manage";
    }

    return array(CONTROLLER_STATUS_OK, 'promotions' . $suffix);
}

// ----------------------------- GET routines -------------------------------------------------

// promotion data
if ($mode == 'update') {

    Registry::set('navigation.tabs', array (
        'details' => array (
            'title' => __('general'),
            'href' => "promotions.update?promotion_id=$_REQUEST[promotion_id]&selected_section=details",
            'js' => true
        ),
        'conditions' => array (
            'title' => __('conditions'),
            'href' => "promotions.update?promotion_id=$_REQUEST[promotion_id]&selected_section=conditions",
            'js' => true
        ),
        'bonuses' => array (
            'title' => __('bonuses'),
            'href' => "promotions.update?promotion_id=$_REQUEST[promotion_id]&selected_section=bonuses",
            'js' => true
        ),
    ));

    $promotion_data = fn_get_promotion_data($_REQUEST['promotion_id']);

    if (empty($promotion_data)) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    Tygh::$app['view']->assign('promotion_data', $promotion_data);

    Tygh::$app['view']->assign('zone', $promotion_data['zone']);
    Tygh::$app['view']->assign('schema', fn_promotion_get_schema());

    if (fn_allowed_for('ULTIMATE') && !Registry::get('runtime.company_id')) {
        Tygh::$app['view']->assign('picker_selected_companies', fn_ult_get_controller_shared_companies($_REQUEST['promotion_id']));
    }

// Add promotion
} elseif ($mode == 'add') {

    $zone = !empty($_REQUEST['zone']) ? $_REQUEST['zone'] : 'catalog';

    if (fn_allowed_for('ULTIMATE:FREE') && $zone == 'cart') {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    Registry::set('navigation.tabs', array (
        'details' => array (
            'title' => __('general'),
            'href' => "promotions.add?selected_section=details",
            'js' => true
        ),
        'conditions' => array (
            'title' => __('conditions'),
            'href' => "promotions.add?selected_section=conditions",
            'js' => true
        ),
        'bonuses' => array (
            'title' => __('bonuses'),
            'href' => "promotions.add?selected_section=bonuses",
            'js' => true
        ),
    ));

    Tygh::$app['view']->assign('zone', $zone);
    Tygh::$app['view']->assign('schema', fn_promotion_get_schema());

} elseif ($mode == 'dynamic') {
    Tygh::$app['view']->assign('schema', fn_promotion_get_schema());
    Tygh::$app['view']->assign('prefix', $_REQUEST['prefix']);
    Tygh::$app['view']->assign('elm_id', $_REQUEST['elm_id']);

    if (!empty($_REQUEST['zone'])) {
        Tygh::$app['view']->assign('zone', $_REQUEST['zone']);
    }

    if (!empty($_REQUEST['condition'])) {
        Tygh::$app['view']->assign('condition_data', array('condition' => $_REQUEST['condition']));

    } elseif (!empty($_REQUEST['bonus'])) {
        Tygh::$app['view']->assign('bonus_data', array('bonus' => $_REQUEST['bonus']));
    }

    if (fn_allowed_for('ULTIMATE') && !Registry::get('runtime.company_id')) {
        Tygh::$app['view']->assign('picker_selected_companies', fn_ult_get_controller_shared_companies($_REQUEST['promotion_id'], 'promotions', 'update'));
    }

// promotions list
} elseif ($mode == 'manage') {

    list($promotions, $search) = fn_get_promotions($_REQUEST, Registry::get('settings.Appearance.admin_elements_per_page'), DESCR_SL);

    Tygh::$app['view']->assign('search', $search);
    Tygh::$app['view']->assign('promotions', $promotions);

}