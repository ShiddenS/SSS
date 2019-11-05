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
use Tygh\Languages\Languages;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($mode == 'update') {

        $rule_id = fn_update_access_restriction_rule($_REQUEST['rule_data'], 0, DESCR_SL);

        if (empty($rule_id)) {
            fn_delete_notification('changes_saved');
        }
    }

    if ($mode == 'm_update') {
        foreach ($_REQUEST['items_data'] as $k => $v) {
            db_query("UPDATE ?:access_restriction SET ?u WHERE item_id = ?i", $v, $k);
            db_query("UPDATE ?:access_restriction_reason_descriptions SET ?u WHERE item_id = ?i AND type = ?s AND lang_code = ?s", $v, $k, $v['type'], DESCR_SL);
        }
    }

    if ($mode == 'm_delete') {
        foreach ($_REQUEST['item_ids'] as $v) {
            db_query("DELETE FROM ?:access_restriction WHERE item_id = ?i", $v);
        }
    }

    if ($mode == 'make_permanent') {
        if ($_REQUEST['selected_section'] == 'ip' || $_REQUEST['selected_section'] == 'admin_panel') {
            $new_type = ($_REQUEST['selected_section'] == 'ip') ? 'ips' : 'aas';
            $old_type = ($_REQUEST['selected_section'] == 'ip') ? 'ipb' : 'aab';
            foreach ($_REQUEST['item_ids'] as $v) {
                if ($items_data[$v]['type'] == $old_type) {
                    db_query("UPDATE ?:access_restriction SET ?u WHERE item_id = ?i", array('type' => $new_type, 'expires' => 0), $v);
                    db_query("UPDATE ?:access_restriction_reason_descriptions SET ?u WHERE item_id = ?i AND type = ?s AND lang_code = ?s", array('type' => $new_type), $v, $old_type, DESCR_SL);
                }
            }
        }
    }

    if ($mode == 'delete') {
        if (!empty($_REQUEST['item_id'])) {
            db_query("DELETE FROM ?:access_restriction WHERE item_id = ?i", $_REQUEST['item_id']);
        }

        return array(CONTROLLER_STATUS_REDIRECT, 'access_restrictions.manage?selected_section=' . $_REQUEST['selected_section']);
    }

    return array(CONTROLLER_STATUS_OK, 'access_restrictions.manage');
}

// ---------------------- GET routines ---------------------------------------

if ($mode == 'manage') {
    $prefix = "access_restrictions.manage?selected_section";

    Registry::set('navigation.tabs', array (
        'ip' => array (
            'href' => $prefix . '=ip',
            'title' => __('ip')
        ),
        'domain' => array (
            'href' => $prefix . '=domain',
            'title' => __('domain')
        ),
        'email' => array (
            'href' => $prefix . '=email',
            'title' => __('email')
        ),
        'credit_card' => array (
            'href' => $prefix . '=credit_card',
            'title' => __('credit_card')
        ),
        'admin_panel' => array (
            'href' => $prefix . '=admin_panel',
            'title' => __('admin_panel')
        ),
    ));

    $ip = fn_get_ip(true);
    list($rules, $search) = fn_access_restrictions_get_rules($_REQUEST, Registry::get('settings.Appearance.admin_elements_per_page'));

    Tygh::$app['view']->assign('show_mp', db_get_field("SELECT item_id FROM ?:access_restriction WHERE type = ?s", (($search['selected_section'] == 'ip') ? 'ipb' : 'aab')));
    Tygh::$app['view']->assign('rules', $rules);
    Tygh::$app['view']->assign('search', $search);
    Tygh::$app['view']->assign('selected_section', $search['selected_section']);
    Tygh::$app['view']->assign('host_ip', $ip['host']);
}

function fn_update_access_restriction_rule($rule_data, $rule_id = 0, $lang_code = DESCR_SL)
{
    if ($rule_data['section'] == 'ip' || $rule_data['section'] == 'admin_panel') {
        $visitor_ip = fn_get_ip(true);

        if (!empty($rule_data['range_from']) || !empty($rule_data['range_to'])) {
            $range_from = (empty($rule_data['range_from'])) ? $rule_data['range_to'] : $rule_data['range_from'];
            $range_to = (empty($rule_data['range_to'])) ? $rule_data['range_from'] : $rule_data['range_to'];
            if (fn_validate_ip($range_from, true) && fn_validate_ip($range_to, true)) {
                $type_s = ($rule_data['section'] == 'ip') ? 'ip' : 'aa';
                $_data = array(
                    'ip_from' => sprintf("%u", ip2long($range_from)),
                    'ip_to' => sprintf("%u", ip2long($range_to)),
                    'timestamp' => TIME,
                    'status' => $rule_data['status'],
                    'type' => (($range_from == $range_to) ? ($type_s . 's') : ($type_s . 'r')), // IP range or specific
                );

                // check if user is trying to restrict self access
                $self_block_host = $_data['ip_from'] <= $visitor_ip['host'] && $_data['ip_to'] >= $visitor_ip['host'];
                $self_block_proxy = $visitor_ip['proxy'] && $_data['ip_from'] <= $visitor_ip['proxy'] && $_data['ip_to'] >= $visitor_ip['proxy'];
                if ($rule_data['section'] == 'admin_panel'
                    && Registry::get('addons.access_restrictions.admin_reverse_ip_access') != 'Y'
                    && ($self_block_host || $self_block_proxy)
                ) {
                    fn_set_notification('W', __('warning', '', $lang_code), __('warning_of_ip_adding', array(
                        '[entered_ip]' => long2ip($_data['ip_from']) . ($_data['ip_from'] == $_data['ip_to'] ? '' : '-' . long2ip($_data['ip_to'])),
                        '[your_ip]' => $self_block_host ? long2ip($visitor_ip['host']) : long2ip($visitor_ip['proxy'])
                    ), $lang_code));
                } else {
                    $rule_id = $_data['item_id'] = db_query("INSERT INTO ?:access_restriction ?e", $_data);
                    $_data['reason'] = $rule_data['reason'];
                    foreach (Languages::getAll() as $_data['lang_code'] => $v) {
                        db_query("INSERT INTO ?:access_restriction_reason_descriptions ?e", $_data);
                    }
                }
            }
        }

    // Add domains
    } elseif ($rule_data['section'] == 'domain') {
        if (fn_validate_domain_name($rule_data['value'], true)) {
            $rule_data['type'] = 'd'; // Domain
            $rule_data['timestamp'] = TIME;
            $rule_id = $rule_data['item_id'] = db_query("INSERT INTO ?:access_restriction ?e", $rule_data);

            foreach (Languages::getAll() as $rule_data['lang_code'] => $v) {
                db_query("INSERT INTO ?:access_restriction_reason_descriptions ?e", $rule_data);
            }
        }

    // Add emails
    } elseif ($rule_data['section'] == 'email') {
        if (strstr($rule_data['value'], '@') && strpos($rule_data['value'], '*@') !== 0) {
            if (fn_validate_email($rule_data['value'], true) && fn_validate_domain_name(substr($rule_data['value'], strpos($rule_data['value'], '@')), true)) {
                $rule_data['type'] = 'es'; // specific E-Mail
                $rule_data['timestamp'] = TIME;
                $rule_id = $rule_data['item_id'] = db_query("INSERT INTO ?:access_restriction ?e", $rule_data);

                foreach (Languages::getAll() as $rule_data['lang_code'] => $v) {
                    db_query("INSERT INTO ?:access_restriction_reason_descriptions ?e", $rule_data);
                }
            }
        } else {
            $_domain = (strpos($rule_data['value'], '*@') === 0) ? substr($rule_data['value'], 2) : $rule_data['value'];
            if (fn_validate_domain_name($_domain, true)) {
                $rule_data['type'] = 'ed'; // E-Mail domain
                $rule_data['timestamp'] = TIME;
                $rule_id = $rule_data['item_id'] = db_query("INSERT INTO ?:access_restriction ?e", $rule_data);

                foreach (Languages::getAll() as $rule_data['lang_code'] => $v) {
                    db_query("INSERT INTO ?:access_restriction_reason_descriptions ?e", $rule_data);
                }
            }
        }

    // Add credit cards
    } elseif ($rule_data['section'] == 'credit_card') {
        if (fn_validate_cc_number($rule_data['value'], true)) {
            $rule_data['type'] = 'cc'; // specific Credit Card Number
            $rule_data['timestamp'] = TIME;
            $rule_id = $rule_data['item_id'] = db_query("INSERT INTO ?:access_restriction ?e", $rule_data);

            foreach (Languages::getAll() as $rule_data['lang_code'] => $v) {
                db_query("INSERT INTO ?:access_restriction_reason_descriptions ?e", $rule_data);
            }
        }
    }

    return $rule_id;
}

function fn_access_restrictions_get_rules($params, $items_per_page, $lang_code = DESCR_SL)
{
    // Set default values to input params
    $default_params = array (
        'selected_section' => 'ip',
        'page' => 1,
        'items_per_page' => $items_per_page
    );

    $params = array_merge($default_params, $params);

    $types = array (
        'ip' => array("ips", "ipr", "ipb"),
        'domain' => array("d"),
        'email' => array("es", "ed"),
        'credit_card' => array("cc"),
        'admin_panel' => array("aas", "aar", "aab"),
    );

    // Select sorting
    if ($params['selected_section'] == 'ip' || $params['selected_section'] == 'admin_panel') {
        $sortings = array (
            'ip' => 'a.ip_from',
            'reason' => 'b.reason',
            'created' => 'a.timestamp',
            'expires' => 'a.expires',
            'status' => 'a.status'
        );
    } else {
        $sortings = array (
            'value' => 'a.value',
            'reason' => 'b.reason',
            'created' => 'a.timestamp',
            'status' => 'a.status'
        );
    }

    $sorting = db_sort($params, $sortings, 'created', 'desc');

    $limit = '';
    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field("SELECT COUNT(a.item_id) FROM ?:access_restriction as a WHERE a.type IN (?a)", $types[$params['selected_section']]);
        $limit = db_paginate($params['page'], $params['items_per_page'], $params['total_items']);
    }

    $rules = db_get_array("SELECT a.*, b.reason FROM ?:access_restriction as a LEFT JOIN ?:access_restriction_reason_descriptions as b ON a.item_id = b.item_id AND b.type = a.type AND lang_code = ?s WHERE a.type IN (?a) $sorting $limit", $lang_code, $types[$params['selected_section']]);

    return array($rules, $params);
}
