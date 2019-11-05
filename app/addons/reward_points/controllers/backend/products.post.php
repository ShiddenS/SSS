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

/* POST data processing */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //
    // Processing multiple updating of product elements
    //
    if ($mode == 'do_m_update') {

        if (isset($_REQUEST['reward_points'])) {
            foreach ((array) $_REQUEST['reward_points'] as $product_id => $v) {
                foreach ((array) $v as $usergroup_id => $amount) {
                    $data = array(
                        'amount' => $amount,
                        'usergroup_id' => $usergroup_id
                    );
                    fn_add_reward_points($data, $product_id, PRODUCT_REWARD_POINTS);
                }
            }
        }

    //
    // Override multiple products with the one value
    //
    } elseif ($mode == 'do_m_override') {
        if (!empty($_REQUEST['product_ids'])) {
            foreach ($_REQUEST['product_ids'] as $product_id => $value) {
                if (isset($_REQUEST['override_products_points']['point_price'])) {
                    fn_add_price_in_points(array('point_price' => $_REQUEST['override_products_points']['point_price']), $product_id);
                }
                if (isset($_REQUEST['override_reward_points'])) {
                    foreach ((array) $_REQUEST['override_reward_points'] as $usergroup_id => $amount) {
                        $data = array(
                            'amount' => $amount,
                            'usergroup_id' => $usergroup_id
                        );
                        fn_add_reward_points($data, $product_id, PRODUCT_REWARD_POINTS);
                    }
                }
            }
        }
    }

    return;
}

//
// 'Management' page
//
if ($mode == 'm_update') {

    $selected_fields = Tygh::$app['session']['selected_fields'];

    $field_groups = Tygh::$app['view']->getTemplateVars('field_groups');
    $filled_groups = Tygh::$app['view']->getTemplateVars('filled_groups');
    $field_names = Tygh::$app['view']->getTemplateVars('field_names');

    if (!empty($selected_fields['data']['is_pbp'])) {
        $field_groups['C']['is_pbp'] = 'products_data';
        $filled_groups['C']['is_pbp'] = __('pay_by_points');
    }

    if (!empty($selected_fields['data']['is_oper'])) {
        $field_groups['C']['is_oper'] = 'products_data';
        $filled_groups['C']['is_oper'] = __('override_per');
    }

    if (!empty($selected_fields['product_point_prices']['point_price'])) {
        $field_groups['B']['point_price'] = 'products_data';
        $filled_groups['B']['point_price'] = __('price_in_points');
    }

    if (!empty($selected_fields['data']['is_op'])) {
        $field_groups['C']['is_op'] = 'products_data';
        $filled_groups['C']['is_op'] = __('override_gc_points_brief');
    }

    if (isset($field_names['is_pbp'])) {
        unset($field_names['is_pbp']);
    }

    if (isset($field_names['is_oper'])) {
        unset($field_names['is_oper']);
    }

    if (isset($field_names['is_op'])) {
        unset($field_names['is_op']);
    }

    Tygh::$app['view']->assign('field_groups', $field_groups);
    Tygh::$app['view']->assign('filled_groups', $filled_groups);
    Tygh::$app['view']->assign('field_names', $field_names);

} elseif ($mode == 'update') {

    Registry::set('navigation.tabs.reward_points', array (
        'title' => __('reward_points'),
        'js' => true
    ));

    Tygh::$app['view']->assign('reward_points', fn_get_reward_points($_REQUEST['product_id'], PRODUCT_REWARD_POINTS));
    Tygh::$app['view']->assign('object_type', PRODUCT_REWARD_POINTS);

} elseif ($mode == 'add') {

    // Add new tab to page sections
    // [Page sections]
    Registry::set('navigation.tabs.reward_points', array (
        'title' => __('reward_points'),
        'js' => true
    ));
    // [/Page sections]

    Tygh::$app['view']->assign('object_type', PRODUCT_REWARD_POINTS);

}

Tygh::$app['view']->assign(
    'reward_usergroups',
    fn_get_usergroups(
        array(
            'type'            => 'C',
            'status'          => array('A', 'H'),
            'include_default' => true
        )
    )
);
