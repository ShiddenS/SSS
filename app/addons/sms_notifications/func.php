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

use Tygh\Http;
use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_sms_notifications_place_order(&$order_id, &$action, &$fake1, &$cart)
{
    if ($action !== 'save' && Registry::get('addons.sms_notifications.sms_new_order_placed') == 'Y') {
        Tygh::$app['view']->assign('order_id', $order_id);
        Tygh::$app['view']->assign('total', $cart['total']);

        $send_info = Registry::get('addons.sms_notifications.sms_send_payment_info');
        $send_email = Registry::get('addons.sms_notifications.sms_send_customer_email');
        $send_min_amount = Registry::get('addons.sms_notifications.sms_send_min_amout');
        $send_shippings = Registry::get('addons.sms_notifications.sms_send_shipping');

        if (!is_array($send_shippings)) {
            $send_shippings = array ();
        }

        Tygh::$app['view']->assign('send_info', $send_info == 'Y' ? true : false);
        Tygh::$app['view']->assign('send_email', $send_email == 'Y' ? true : false);
        Tygh::$app['view']->assign('send_min_amount', $send_min_amount == 'Y' ? true : false);

        $order = fn_get_order_info($order_id);

        Tygh::$app['view']->assign('order_email', $order['email']);
        Tygh::$app['view']->assign('order_payment_info', $order['payment_method']['payment']);

        if (count($send_shippings) && !isset($send_shippings['N'])) {
            $in_shipping = false;

            if (!empty($order['shipping'])) {
                foreach ($order['shipping'] as $data) {
                    $id = $data['shipping_id'];
                    if (isset($send_shippings[$id]) && $send_shippings[$id] == 'Y') {
                        $in_shipping = true;
                        break;
                    }
                }
            }
        } else {
            $in_shipping = true;
        }

        if ($in_shipping && $order['subtotal'] > doubleval($send_min_amount)) {
            $body = Tygh::$app['view']->fetch('addons/sms_notifications/views/sms/components/order_sms.tpl');
            fn_send_sms_notification($body);
        }
    }
}

function fn_sms_notifications_update_profile(&$action, &$user_data)
{
    if ($action == 'add' && AREA == 'C' && Registry::get('addons.sms_notifications.sms_new_cusomer_registered') == 'Y') {
        Tygh::$app['view']->assign('customer', $user_data['email']);
        $body = Tygh::$app['view']->fetch('addons/sms_notifications/views/sms/components/new_profile_sms.tpl');
        fn_send_sms_notification($body);
    }
}

function fn_sms_notifications_update_product_amount(&$new_amount, &$product_id)
{
    if ($new_amount <= Registry::get('settings.General.low_stock_threshold') && Registry::get('addons.sms_notifications.sms_product_negative_amount') == 'Y') {
        $lang_code = Registry::get('settings.Appearance.backend_default_language');

        Tygh::$app['view']->assign('product_id', $product_id);
        Tygh::$app['view']->assign('product', db_get_field("SELECT product FROM ?:product_descriptions WHERE product_id = ?i AND lang_code = ?s", $product_id, $lang_code));
        $body = Tygh::$app['view']->fetch('addons/sms_notifications/views/sms/components/low_stock_sms.tpl');
        fn_send_sms_notification($body);
    }
}

function fn_send_sms_notification($body)
{
    $addon_settings = Registry::get('addons.sms_notifications');
    $api_key        = $addon_settings['clickatel_api_id'];
    $to             = $addon_settings['phone_number'];
    $concat         = $addon_settings['clickatel_concat'];
    $unicode        = $addon_settings['clickatel_unicode'] == 'Y' ? 1 : 0;

    if (fn_is_empty($api_key) || empty($to)) {
        return false;
    }

    //get the last symbol
    if (!empty($concat)) {
        $concat = intval($concat[strlen($concat)-1]);
    }
    if (!in_array($concat, array('1', '2', '3'))) {
        $concat = 1;
    }

    $sms_length = $unicode ? SMS_NOTIFICATIONS_SMS_LENGTH_UNICODE : SMS_NOTIFICATIONS_SMS_LENGTH;
    if ($concat > 1) {
        $sms_length *= $concat;
        $sms_length -= ($concat * SMS_NOTIFICATIONS_SMS_LENGTH_CONCAT); // If a message is concatenated, it reduces the number of characters contained in each message by 7
    }

    $body = html_entity_decode($body, ENT_QUOTES, 'UTF-8');
    $body = fn_substr($body, 0, $sms_length);
    $body = strip_tags($body);

    $data = array(
        'apiKey'  => $api_key,
        'to'      => $to,
        'content' => $body,
    );

    Http::get(SMS_NOTIFICATIONS_API_URL, $data);
}
