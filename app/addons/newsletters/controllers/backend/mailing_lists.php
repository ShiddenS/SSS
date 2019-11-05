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

use Tygh\Languages\Languages;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD']	== 'POST') {

    if ($mode == 'update') {
        fn_update_mailing_list($_REQUEST['mailing_list_data'], $_REQUEST['list_id'], DESCR_SL);
    }

    if ($mode == 'delete') {
        if (!empty($_REQUEST['list_id'])) {
            db_query("DELETE FROM ?:common_descriptions WHERE object_id = ?i AND object_holder = 'mailing_lists'", $_REQUEST['list_id']);
            db_query("DELETE FROM ?:mailing_lists WHERE list_id = ?i", $_REQUEST['list_id']);
            db_query("DELETE FROM ?:user_mailing_lists WHERE list_id = ?i", $_REQUEST['list_id']);
            list($_mailing_lists) = fn_get_mailing_lists(array('only_available' => false), 0, DESCR_SL);
            if (empty($_mailing_lists)) {
                Tygh::$app['view']->display('addons/newsletters/views/mailing_lists/manage.tpl');
            }
        }
        exit;
    }

    return array(CONTROLLER_STATUS_OK, 'mailing_lists.manage');
}

if ($mode == 'update') {
    list($autoresponders) = fn_get_newsletters(array('type' => NEWSLETTER_TYPE_AUTORESPONDER, 'only_available' => false), 0, DESCR_SL);
    Tygh::$app['view']->assign('autoresponders', $autoresponders);
    Tygh::$app['view']->assign('mailing_list', fn_get_mailing_list_data($_REQUEST['list_id'], DESCR_SL));

} elseif ($mode == 'manage') {
    $params = $_REQUEST;
    $params['only_available'] = false;

    list($mailing_lists) = fn_get_mailing_lists($params, 0, DESCR_SL);

    $subscribers = db_get_hash_array("SELECT * FROM ?:subscribers", 'subscriber_id');
    foreach ($mailing_lists as &$list) {
        $list['subscribers_num'] = db_get_field("SELECT COUNT(*) FROM ?:user_mailing_lists WHERE list_id = ?i", $list['list_id']);
    }

    list($autoresponders) = fn_get_newsletters(array('type' => NEWSLETTER_TYPE_AUTORESPONDER, 'only_available' => false), 0, DESCR_SL);
    Tygh::$app['view']->assign('mailing_lists', $mailing_lists);
    Tygh::$app['view']->assign('autoresponders', $autoresponders);
    Tygh::$app['view']->assign('subscribers', $subscribers);

    fn_newsletters_generate_sections('mailing_lists');
}

function fn_update_mailing_list($mailing_list_data, $list_id, $lang_code = DESCR_SL)
{
    if (empty($list_id)) {
        $list_id = db_query("INSERT INTO ?:mailing_lists ?e", $mailing_list_data);

        $_data = $mailing_list_data;
        $_data['object_id'] = $list_id;
        $_data['object_holder'] = 'mailing_lists';
        $_data['object'] = $_data['name'];

        foreach (Languages::getAll() as $_data['lang_code'] => $v) {
            db_query("REPLACE INTO ?:common_descriptions ?e", $_data);
        }
    } else {
        db_query("UPDATE ?:mailing_lists SET ?u WHERE list_id = ?i", $mailing_list_data, $list_id);

        $_data = $mailing_list_data;
        $_data['object_id'] = $list_id;
        $_data['object_holder'] = 'mailing_lists';
        $_data['object'] = $_data['name'];

        $_where = array(
            'object_id' => $list_id,
            'object_holder' => 'mailing_lists',
            'lang_code' => $lang_code
        );

        db_query("UPDATE ?:common_descriptions SET ?u WHERE ?w", $_data, $_where);
    }

    if (!empty($mailing_list_data['add_subscribers'])) {
        foreach ($mailing_list_data['add_subscribers'] as $subscriber) {
            $exists = db_get_field("SELECT subscriber_id FROM ?:subscribers WHERE email=?s", $subscriber['email']);

            // check if subscriber exists already
            if (!$exists) {
                $_data = $subscriber;
                $_data['timestamp'] = TIME;
                $subscriber_id  = db_query("INSERT INTO ?:subscribers ?e", $_data);
            }

            // mark mailing list as active for this subscriber
            $_data = array(
                'subscriber_id' => $subscriber_id,
                'list_id' => $list_id,
                'confirmed' => $subscriber['confirmed'],
                'timestamp' => TIME
            );

            db_replace_into('user_mailing_lists', $_data);
        }
    }

    return $list_id;
}

/** /Body **/
