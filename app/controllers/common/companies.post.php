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

use Tygh\Enum\StorefrontStatuses;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

// Ajax content
if ($mode == 'get_companies_list') {

    // Check if we trying to get list by non-ajax
    if (!defined('AJAX_REQUEST')) {
        return array(CONTROLLER_STATUS_REDIRECT, fn_url());
    }

    //TODO make single function

    $params = array_merge(array(
        'render_html' => 'Y'
    ), $_REQUEST);

    $condition = '';
    $pattern = !empty($params['pattern']) ? $params['pattern'] : '';
    $start = !empty($params['start']) ? $params['start'] : 0;
    $limit = (!empty($params['limit']) ? $params['limit'] : 10) + 1;

    if (AREA == 'C') {
        $condition = " AND status = 'A' ";
    }

    fn_set_hook('get_companies_list', $condition, $pattern, $start, $limit, $params);

    $objects = db_get_hash_array("SELECT company_id, company_id as value, company AS name, CONCAT('switch_company_id=', company_id) as append FROM ?:companies WHERE 1 $condition AND company LIKE ?l ORDER BY company LIMIT ?i, ?i", 'value', $pattern . '%', $start, $limit);

    if (fn_allowed_for('ULTIMATE')) {
        foreach ($objects as &$object) {
            $object['storefront_status'] = fn_ult_get_storefront_status($object['company_id']);
        }
        unset($object);
    }

    if (defined('AJAX_REQUEST') && sizeof($objects) < $limit) {
        Tygh::$app['ajax']->assign('completed', true);
    } else {
        array_pop($objects);
    }

    if (empty($params['start']) && empty($params['pattern'])) {
        $all_vendors = array();

        if (!empty($params['show_all']) && $params['show_all'] == 'Y') {
            $all_vendors[0] = array(
                'name' => empty($params['default_label']) ? __('all_vendors') : __($params['default_label']),
                'value' => (!empty($params['search']) && $params['search'] == 'Y') ? '' : 0,
            );
        }

        $objects = $all_vendors + $objects;
    }

    Tygh::$app['ajax']->assign('objects', $objects);

    if (defined('AJAX_REQUEST') && !empty($params['action'])) {
        Tygh::$app['ajax']->assign('action', $params['action']);
    }

    if (!empty($params['onclick'])) {
        Tygh::$app['view']->assign('onclick', $params['onclick']);
    }

    Tygh::$app['view']->assign(array(
        'objects'     => $objects,
        'id'          => !empty($params['result_ids']) ? $params['result_ids'] : '',
        'object_type' => 'companies',
    ));

    if ($params['render_html'] === 'Y') {
        Tygh::$app['view']->display('common/ajax_select_object.tpl');
    }
    exit;
}
