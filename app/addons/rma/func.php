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
use Tygh\Enum\Addons\Rma\ReturnOperationStatuses;
use Tygh\Enum\Addons\Rma\RecalculateOperations;
use Tygh\Enum\Addons\Rma\InventoryOperations;
use Tygh\Enum\YesNo;


if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_get_rma_properties($type = RMA_REASON, $lang_code = CART_LANGUAGE)
{
    $status = (AREA == 'A') ? '' : " AND a.status = 'A'";

    return db_get_hash_array("SELECT a.*, b.property FROM ?:rma_properties AS a LEFT JOIN ?:rma_property_descriptions AS b ON a.property_id = b.property_id AND b.lang_code = ?s WHERE a.type = ?s $status ORDER BY a.position ASC", 'property_id', $lang_code, $type);
}

function fn_rma_delete_property($property_id)
{
    db_query("DELETE FROM ?:rma_properties WHERE property_id = ?i", $property_id);
    db_query("DELETE FROM ?:rma_property_descriptions WHERE property_id = ?i", $property_id);
}

function fn_is_returnable_product($product_id)
{
    $return_info = db_get_row("SELECT is_returnable, return_period  FROM ?:products WHERE product_id = ?i", $product_id);

    return (!empty($return_info) && YesNo::toBool($return_info['is_returnable']) && !empty($return_info['return_period'])) ? $return_info['return_period'] : false;
}

function fn_rma_add_to_cart(&$cart, &$product_id, &$_id)
{
    $return_period = fn_is_returnable_product($product_id);
    if ($return_period && !empty($cart['products'][$_id]['product_id'])) {
        $cart['products'][$_id]['return_period'] = $cart['products'][$_id]['extra']['return_period'] = $return_period;
    }
}

function fn_rma_get_product_data(&$product_id, &$field_list, &$join)
{
    $field_list .= ", ?:products.is_returnable, ?:products.return_period";
}

function fn_check_product_return_period($return_period, $timestamp)
{
    $weekdays = 0;
    $round_the_clock = 60 * 60 * 24;

    if (YesNo::toBool(Registry::get('addons.rma.dont_take_weekends_into_account'))) {
        $passed_days = floor((TIME - $timestamp) / $round_the_clock);
        for ($i = 1; $i <= $passed_days; $i++) {
            if (strstr(SATURDAY.SUNDAY, strftime("%w", $timestamp + $i * $round_the_clock))) {
                $weekdays++;
            }
        }
    }

    return ((($return_period + $weekdays) * $round_the_clock + $timestamp) > TIME) ? true : false;
}

function fn_get_order_returnable_products($order_items, $timestamp)
{
    $item_returns_info = array();
    foreach ((array) $order_items as $k => $v) {
        if (isset($v['extra']['return_period']) &&  true == fn_check_product_return_period($v['extra']['return_period'], $timestamp)) {
            if (!isset($v['extra']['exclude_from_calculate'])) {
                $order_items[$k]['price'] = fn_format_price($v['subtotal'] / $v['amount']);
            }
            if (isset($v['extra']['returns'])) {
                foreach ((array) $v['extra']['returns'] as $return_id => $value) {
                    $item_returns_info[$k][$value['status']] = (isset($item_returns_info[$k][$value['status']]) ? $item_returns_info[$k][$value['status']] : 0) + $value['amount'];
                }
                if (0 >= $order_items[$k]['amount'] = $v['amount'] - array_sum($item_returns_info[$k])) {
                    unset($order_items[$k]);
                }
            }
        } else {
            unset($order_items[$k]);
        }
    }

    return array(
        'items'	            => $order_items,
        'item_returns_info' => $item_returns_info
    );
}

function fn_rma_generate_sections($section)
{
    Registry::set('navigation.dynamic.sections', array (
        'requests' => array (
            'title' => __('return_requests'),
            'href' => "rma.returns",
        ),
    ));

    Registry::set('navigation.dynamic.active_section', $section);

    return true;
}

function fn_rma_get_order_info(&$order, &$additional_data)
{
    if (!empty($order)) {
        $status_data = fn_get_status_params($order['status'], STATUSES_ORDER);

        if (!empty($status_data) && (!empty($status_data['allow_return']) && YesNo::toBool($status_data['allow_return'])) && isset($additional_data[ORDER_DATA_PRODUCTS_DELIVERY_DATE])) {
            $order_returnable_products = fn_get_order_returnable_products($order['products'], $additional_data[ORDER_DATA_PRODUCTS_DELIVERY_DATE]);
            if (!empty($order_returnable_products['items'])) {
                $order['allow_return'] = 'Y';
            }
            if (!empty($order_returnable_products['item_returns_info'])) {
                foreach ($order_returnable_products['item_returns_info'] as $item_id => $returns_info) {
                    $order['products'][$item_id]['returns_info'] = $returns_info;
                }
            }
        }

        if (!empty($additional_data[ORDER_DATA_PRODUCTS_DELIVERY_DATE])) {
            $order['products_delivery_date'] = $additional_data[ORDER_DATA_PRODUCTS_DELIVERY_DATE];
        }

        if (!empty($additional_data[ORDER_DATA_RETURN])) {
            $order_return_info = @unserialize($additional_data[ORDER_DATA_RETURN]);
            $order['return'] = @$order_return_info['return'];
            $order['returned_products'] = @$order_return_info['returned_products'];

            foreach ((array) $order['returned_products'] as $k => $v) {
                $v['product'] = !empty($v['extra']['product']) ? $v['extra']['product'] : fn_get_product_name($v['product_id'], CART_LANGUAGE);
                if (empty($v['product'])) {
                    $v['product'] = strtoupper(__('deleted_product'));
                }
                $v['discount'] = (!empty($v['extra']['discount']) && floatval($v['extra']['discount'])) ? $v['extra']['discount'] : 0 ;

                if (!empty($v['extra']['product_options_value'])) {
                    $v['product_options'] = $v['extra']['product_options_value'];
                }
                $v['subtotal'] = ($v['price'] * $v['amount'] - $v['discount']);
                $order['returned_products'][$k] = $v;
            }
        }

        if (0 < $returns_count = db_get_field("SELECT COUNT(*) FROM ?:rma_returns WHERE order_id = ?i", $order['order_id'])) {
            $order['isset_returns'] = 'Y';
        }
    }
}

function fn_get_return_info($return_id)
{
    if (!empty($return_id)) {
        $return = db_get_row("SELECT * FROM ?:rma_returns WHERE return_id = ?i", $return_id);

        if (empty($return)) {
            return array();
        }

        $return['items'] = db_get_hash_multi_array("SELECT ?:rma_return_products.*, ?:products.product_id as original_product_id FROM ?:rma_return_products LEFT JOIN ?:products ON ?:rma_return_products.product_id = ?:products.product_id WHERE ?:rma_return_products.return_id = ?i", array('type', 'item_id'), $return_id);
        foreach ($return['items'] as $type => $value) {
            foreach ($value as $k => $v) {
                if (0 == floatval($v['price'])) {
                    $return['items'][$type][$k]['price'] = '';
                }

                if (empty($v['original_product_id'])) {
                    $return['items'][$type][$k]['deleted_product'] = true;
                }

                if (empty($v['product'])) {
                    $v['product'] = strtoupper(__('deleted_product'));
                }

                $return['items'][$type][$k]['product_options'] = !empty($return['items'][$type][$k]['product_options']) ? unserialize($return['items'][$type][$k]['product_options']) : array();
            }
        }

        return $return;
    }

    return false;
}

function fn_return_product_routine($return_id, $item_id, $item, $direction)
{

    $reverse = array(
        ReturnOperationStatuses::APPROVED => ReturnOperationStatuses::DECLINED,
        ReturnOperationStatuses::DECLINED => ReturnOperationStatuses::APPROVED
    );

    if (!empty($return_id) && !empty($item_id) && !empty($direction) && !empty($item)) {
        $is_amount = db_get_field("SELECT amount FROM ?:rma_return_products WHERE return_id = ?i AND item_id = ?i AND type = ?s", $return_id, $item_id, $direction);
        if (($item['previous_amount'] - $item['amount']) <= 0) {
            if (empty($is_amount)) {
                db_query('UPDATE ?:rma_return_products SET ?u WHERE return_id = ?i AND item_id = ?i AND type = ?s', array('type' => $direction), $return_id, $item_id, $reverse[$direction]);
            } else {
                db_query("DELETE FROM ?:rma_return_products WHERE return_id = ?i AND item_id = ?i AND type = ?s", $return_id, $item_id, $reverse[$direction]);
            }
        } else {
            $_data = db_get_row("SELECT * FROM ?:rma_return_products WHERE return_id = ?i AND item_id = ?i AND type = ?s", $return_id, $item_id, $reverse[$direction]);
            db_query('UPDATE ?:rma_return_products SET ?u WHERE return_id = ?i AND item_id = ?i AND type = ?s', array('amount' => $_data['amount'] - $item['amount']), $return_id, $item_id, $reverse[$direction]);

            if (empty($is_amount)) {
                $_data['amount'] = $item['amount'];
                $_data['type'] = $direction;
                db_query("REPLACE INTO ?:rma_return_products ?e", $_data);
            }
        }
        if (!empty($is_amount)) {
            db_query('UPDATE ?:rma_return_products SET ?u WHERE return_id = ?i AND item_id = ?i AND type = ?s', array('amount' => $is_amount + $item['amount']), $return_id, $item_id, $direction);
        }
    }

    return false;
}

function fn_delete_return($return_id)
{

    $items = db_get_array("SELECT item_id, ?:order_details.extra, ?:order_details.order_id FROM ?:order_details LEFT JOIN ?:rma_returns ON ?:order_details.order_id = ?:rma_returns.order_id WHERE  return_id = ?i", $return_id);
    foreach ($items as $item) {
        $extra = unserialize($item['extra']);
        if (isset($extra['returns'])) {
            unset($extra['returns']);
        }
        db_query('UPDATE ?:order_details SET ?u WHERE item_id = ?i AND order_id = ?i', array('extra' => serialize($extra)), $item['item_id'],  $item['order_id']);
    }

    db_query("DELETE FROM ?:rma_returns WHERE return_id = ?i", $return_id);
    db_query("DELETE FROM ?:rma_return_products WHERE return_id = ?i", $return_id);
}

function fn_send_return_mail(&$return_info, &$order_info, $force_notification = array(), $area = AREA)
{
    $return_statuses = fn_get_statuses(STATUSES_RETURN);
    $status_params = $return_statuses[$return_info['status']]['params'];

    $notify_user = isset($force_notification['C']) ? $force_notification['C'] : (!empty($status_params['notify']) && YesNo::toBool($status_params['notify']));
    $notify_department = isset($force_notification['A']) ? $force_notification['A'] : (!empty($status_params['notify_department']) && YesNo::toBool($status_params['notify_department']));
    $notify_vendor = isset($force_notification['V']) ? $force_notification['V'] : (!empty($status_params['notify_vendor']) && YesNo::toBool($status_params['notify_vendor']));

    if ($notify_user || $notify_department || $notify_vendor) {
        /** @var \Tygh\Mailer\Mailer $mailer */
        $mailer = Tygh::$app['mailer'];

        // Notify customer
        if ($notify_user) {

            $rma_reasons = fn_get_rma_properties(RMA_REASON, $order_info['lang_code']);
            $rma_actions = fn_get_rma_properties(RMA_ACTION, $order_info['lang_code']);

            $mailer->send(array(
                'to' => $order_info['email'],
                'from' => 'company_orders_department',
                'data' => array(
                    'order_info' => $order_info,
                    'return_info' => $return_info,
                    'reasons' => $rma_reasons,
                    'actions' => $rma_actions,
                    'return_status' => fn_get_status_data($return_info['status'], STATUSES_RETURN, $return_info['return_id'], $order_info['lang_code'])
                ),
                'template_code' => 'rma_slip_notification',
                'tpl' => 'addons/rma/slip_notification.tpl', // this parameter is obsolete and is used for back compatibility
                'company_id' => $order_info['company_id'],
            ), 'C', $order_info['lang_code']);
        }

        if ($notify_vendor) {
            if (fn_allowed_for('MULTIVENDOR') && !empty($order_info['company_id'])) {
                $company_language = fn_get_company_language($order_info['company_id']);

                $rma_reasons = fn_get_rma_properties(RMA_REASON, $company_language);
                $rma_actions = fn_get_rma_properties(RMA_ACTION, $company_language);

                $mailer->send(array(
                    'to' => 'company_orders_department',
                    'from' => 'default_company_orders_department',
                    'data' => array(
                        'order_info' => $order_info,
                        'return_info' => $return_info,
                        'reasons' => $rma_reasons,
                        'actions' => $rma_actions,
                        'return_status' => fn_get_status_data($return_info['status'], STATUSES_RETURN, $return_info['return_id'], $company_language)
                    ),
                    'template_code' => 'rma_slip_notification',
                    'tpl' => 'addons/rma/slip_notification.tpl', // this parameter is obsolete and is used for back compatibility
                    'company_id' => $order_info['company_id'],
                ), 'A', $company_language);
            }
        }

        // Notify administrator (only if the changes performed from the frontend)
        if ($notify_department) {

            $rma_reasons = fn_get_rma_properties(RMA_REASON, Registry::get('settings.Appearance.backend_default_language'));
            $rma_actions = fn_get_rma_properties(RMA_ACTION, Registry::get('settings.Appearance.backend_default_language'));

            $mailer->send(array(
                'to' => 'company_orders_department',
                'from' => 'default_company_orders_department',
                'reply_to' => Registry::get('settings.Company.company_orders_department'),
                'data' => array(
                    'order_info' => $order_info,
                    'return_info' => $return_info,
                    'reasons' => $rma_reasons,
                    'actions' => $rma_actions,
                    'return_status' => fn_get_status_data($return_info['status'], STATUSES_RETURN, $return_info['return_id'], Registry::get('settings.Appearance.backend_default_language'))
                ),
                'template_code' => 'rma_slip_notification',
                'tpl' => 'addons/rma/slip_notification.tpl', // this parameter is obsolete and is used for back compatibility
                'company_id' => $order_info['company_id'],
            ), 'A', Registry::get('settings.Appearance.backend_default_language'));

        }

    }
}

function fn_rma_update_details($data)
{
    fn_set_hook('rma_update_details_pre', $data);
    $change_return_status = $data['change_return_status'];

    $_data = array();
    $show_confirmation_page = false;
    if (isset($data['comment'])) {
        $_data['comment'] = $data['comment'];
    }

    $is_refund = fn_is_refund_action($change_return_status['action']);
    $confirmed = isset($data['confirmed']) ? $data['confirmed'] : '';
    $st_inv = fn_get_statuses(STATUSES_RETURN);
    $show_confirmation = false;
    if ((
        ($change_return_status['recalculate_order'] == RecalculateOperations::MANUALLY && YesNo::toBool($is_refund)) ||
        $change_return_status['recalculate_order'] == RecalculateOperations::AUTO
    ) &&
        $change_return_status['status_to'] != $change_return_status['status_from'] &&
        !($st_inv[$change_return_status['status_from']]['params']['inventory'] == InventoryOperations::DECREASED && $change_return_status['status_to'] == ReturnOperationStatuses::REQUESTED) &&
        !($st_inv[$change_return_status['status_to']]['params']['inventory'] == InventoryOperations::DECREASED && $change_return_status['status_from'] == ReturnOperationStatuses::REQUESTED)
    ) {
        $show_confirmation = true;
    }

    if ($show_confirmation == true) {
        if (YesNo::toBool($confirmed)) {
            fn_rma_recalculate_order($change_return_status['order_id'], $change_return_status['recalculate_order'], $change_return_status['return_id'], $is_refund, $change_return_status);
            $_data['status'] = $change_return_status['status_to'];
        } else {
            $change_return_status['inventory_to'] = $st_inv[$change_return_status['status_to']]['params']['inventory'];
            $change_return_status['inventory_from'] = $st_inv[$change_return_status['status_from']]['params']['inventory'];
            Tygh::$app['session']['change_return_status'] = $change_return_status;
            $show_confirmation_page = true;
        }
    } else {
        $_data['status'] = $change_return_status['status_to'];
    }

    if (!empty($_data)) {
        db_query("UPDATE ?:rma_returns SET ?u WHERE return_id = ?i", $_data, $change_return_status['return_id']);
    }

    if ((!$show_confirmation || ($show_confirmation && YesNo::toBool($confirmed))) && $change_return_status['status_from'] != $change_return_status['status_to']) {
        $order_items = db_get_hash_single_array("SELECT item_id, extra FROM ?:order_details WHERE ?:order_details.order_id = ?i", array('item_id', 'extra'), $change_return_status['order_id']);

        foreach ($order_items as $item_id => $extra) {
            $extra = @unserialize($extra);
            if (isset($extra['returns'][$change_return_status['return_id']])) {
                $extra['returns'][$change_return_status['return_id']]['status'] = $change_return_status['status_to'];
                db_query('UPDATE ?:order_details SET ?u WHERE item_id = ?i AND order_id = ?i', array('extra' => serialize($extra)), $item_id, $change_return_status['order_id']);
            }
        }

        $return_info = fn_get_return_info($change_return_status['return_id']);
        $order_info = fn_get_order_info($change_return_status['order_id']);
        fn_send_return_mail($return_info, $order_info, fn_get_notification_rules($change_return_status));

        if (fn_allowed_for('MULTIVENDOR') && YesNo::toBool($is_refund) && $change_return_status['status_to'] == ReturnOperationStatuses::COMPLETED) {
            $payout_data = $payout_data = array(
                'order_id' => $change_return_status['order_id'],
                'company_id' => $order_info['company_id'],
                'payout_type' => \Tygh\Enum\VendorPayoutTypes::ORDER_REFUNDED,
                'approval_status' => \Tygh\Enum\VendorPayoutApprovalStatuses::COMPLETED,
            );

            // create payout
            if (!\Tygh\VendorPayouts::instance()->getSimple($payout_data)) {
                $payout_amount = 0;
                if (!empty($return_info['items']['A'])) {
                    foreach ($return_info['items']['A'] as $cart_id => $product_info) {
                        $payout_amount -= $product_info['amount'] * $product_info['price'];
                    }
                }
                $payout_data['order_amount'] = $payout_amount;

                /**
                 * Executes before creating a payout based on the return request, allows to modify the payout data.
                 *
                 * @param array $data        Request parameters
                 * @param array $order_info  Order information from ::fn_get_orders()
                 * @param array $return_info Return request from ::fn_get_return_info()
                 * @param array $payout_data Payout data to be stored in the DB
                 */
                fn_set_hook('rma_update_details_create_payout', $data, $order_info, $return_info, $payout_data);

                \Tygh\VendorPayouts::instance()->update($payout_data);
            }
        }
    }

    fn_set_hook('rma_update_details_post', $data, $show_confirmation_page, $show_confirmation, $is_refund, $_data, $confirmed);

    return $show_confirmation_page;
}

function fn_is_refund_action($action)
{
    return 	db_get_field("SELECT update_totals_and_inventory FROM ?:rma_properties WHERE property_id = ?i", $action);
}

function fn_rma_delete_gift_certificate(&$gift_cert_id, &$extra)
{

    $potentional_certificates = array();

    if (isset($extra['return_id'])) {
        $potentional_certificates[$extra['return_id']] = db_get_field("SELECT extra FROM ?:rma_returns WHERE return_id = ?i", $extra['return_id']);
    } else {
        $potentional_certificates = db_get_hash_single_array("SELECT return_id, extra FROM ?:rma_returns WHERE extra IS NOT NULL", array('return_id', 'extra'));
    }

    if (!empty($potentional_certificates)) {
        foreach ($potentional_certificates as $return_id => $return_extra) {
            $return_extra = @unserialize($return_extra);
            if (isset($return_extra['gift_certificates'])) {
                foreach ((array) $return_extra['gift_certificates'] as $k => $v) {
                    if ($k == $gift_cert_id) {
                        unset($return_extra['gift_certificates'][$k]);
                        if (empty($return_extra['gift_certificates'])) {
                            unset($return_extra['gift_certificates']);
                        }
                        db_query('UPDATE ?:rma_returns SET ?u WHERE return_id = ?i', array('extra' => serialize($return_extra)), $return_id);
                        break;
                    }
                }
            }
        }
    }
}

function fn_rma_declined_product_correction($order_id, $item_id, $available_amount, $amount)
{
    $declined_items_amount = db_get_field("SELECT SUM(?:rma_return_products.amount) FROM ?:rma_return_products LEFT JOIN ?:rma_returns ON ?:rma_returns.return_id = ?:rma_return_products.return_id AND ?:rma_returns.order_id = ?i  WHERE ?:rma_return_products.item_id = ?i AND ?:rma_return_products.type = ?s GROUP BY ?:rma_return_products.item_id", $order_id, $item_id, ReturnOperationStatuses::DECLINED);
    if ($available_amount - $amount >= $declined_items_amount) {
        return true;
    } else {
        $declined_items	 = db_get_hash_array("SELECT ?:rma_return_products.return_id, item_id, amount FROM ?:rma_return_products LEFT JOIN ?:rma_returns ON ?:rma_returns.return_id = ?:rma_return_products.return_id AND ?:rma_returns.order_id = ?i WHERE ?:rma_return_products.item_id = ?i AND ?:rma_return_products.type = ?s", 'return_id', $order_id, $item_id, ReturnOperationStatuses::DECLINED);
        foreach ($declined_items as $return_id => $v) {
            $difference = $v['amount'] - $amount;
            if ($difference > 0) {
                db_query('UPDATE ?:rma_return_products SET ?u WHERE return_id = ?i AND item_id = ?i AND type = ?s', array('amount' => $difference), $return_id, $v['item_id'], ReturnOperationStatuses::DECLINED);

                return true;
            } elseif ($difference <= 0) {
                db_query("DELETE FROM ?:rma_return_products WHERE return_id = ?i AND item_id = ?i AND type = ?s", $return_id, $v['item_id'], ReturnOperationStatuses::DECLINED);
                if ($difference == 0) {
                    return true;
                }
            }
        }
    }
}

function fn_rma_change_order_status(&$status_to, &$status_from, &$order_info)
{

    $status_data = fn_get_status_params($status_to, STATUSES_ORDER);

    if (!empty($status_data) && (!empty($status_data['allow_return']) && YesNo::toBool($status_data['allow_return']))) {
        $_data = array(
            'order_id' => $order_info['order_id'],
            'type' => ORDER_DATA_PRODUCTS_DELIVERY_DATE,
            'data' => TIME
        );
        db_query("REPLACE INTO ?:order_data ?e", $_data);
    } else {
        db_query("DELETE FROM ?:order_data WHERE order_id = ?i AND type = ?s", $order_info['order_id'], ORDER_DATA_PRODUCTS_DELIVERY_DATE);
    }
}

/**
 * Updates taxes amounts and order totals when recalculating an order on the refund.
 *
 * @param array        $taxes_list     Stored taxes list from an order
 * @param int          $item_id        Cart ID of the product
 * @param int          $old_amount     Old product amount
 * @param int          $new_amount     New product amount
 * @param array        $current_order  Current order totals
 * @param float|null   $price          Returned product price
 * @param float[]|null $original_order Original order totals
 *
 * @return bool Always true
 */
function fn_rma_update_order_taxes(
    &$taxes_list,
    $item_id,
    $old_amount,
    $new_amount,
    &$current_order,
    $price = null,
    array $original_order = null
) {
    static $original_taxes_list;
    if (is_array($taxes_list)) {
        if ($original_taxes_list === null) {
            $original_taxes_list = $taxes_list;
        }
        foreach ($taxes_list as $k => &$tax) {
            if (isset($tax['applies']['P_' . $item_id])) {
                $old_tax_amount = $tax['applies']['P_' . $item_id];
                $new_tax_amount = fn_format_price($old_tax_amount * $new_amount / $old_amount);
                $tax['applies']['P_' . $item_id] = $new_tax_amount;
                $tax['tax_subtotal'] -=  ($old_tax_amount - $new_tax_amount);
            } elseif (isset($original_taxes_list[$k]['applies']['P'])
                && !empty($original_taxes_list[$k]['applies']['items']['P'][$item_id])
                && $price !== null
                && $original_order !== null
            ) {
                $price_percentage = $price / $original_order['subtotal'];
                $old_tax_amount = fn_format_price(
                    $original_taxes_list[$k]['applies']['P']
                    * $price_percentage
                    * $old_amount
                );
                $new_tax_amount = fn_format_price(
                    $original_taxes_list[$k]['applies']['P']
                    * $price_percentage
                    * $new_amount
                );
                $tax['applies']['P'] -= ($old_tax_amount - $new_tax_amount);
                $tax['tax_subtotal'] -= ($old_tax_amount - $new_tax_amount);
                if ($new_amount == 0) {
                    unset($tax['applies']['items']['P'][$item_id]);
                }
            }
            if ($tax['price_includes_tax'] == 'N' && isset($new_tax_amount) && isset($old_tax_amount)) {
                $current_order['subtotal'] -= ($old_tax_amount - $new_tax_amount);
                $current_order['total'] -= ($old_tax_amount - $new_tax_amount);
            }
        }
        unset($tax, $old_tax_amount, $new_tax_amount);
    }

    return true;
}

//
// This function updates shipping costs and their taxes taxes.
//
function fn_update_shipping_taxes(&$tax_data, &$shipping_cost, &$order)
{
    if (is_array($tax_data) && is_array($shipping_cost)) {
        foreach ($shipping_cost as $shipping_id => $sh_data) {
            foreach ($sh_data['rates'] as $s_id => $rate) {
                foreach ($tax_data as $k => $tax) {
                    if (isset($tax['applies']['S_' . $shipping_id . '_' . $s_id])) {

                        if ($tax['rate_type'] == 'P') { // Percent dependence
                            // If tax is included into the price
                            if (YesNo::toBool($tax['price_includes_tax'])) {
                                $_tax = fn_format_price($rate - $rate / (1 + ($tax['rate_value'] / 100)));
                                // If tax is NOT included into the price
                            } else {
                                $_tax = fn_format_price($rate * ($tax['rate_value'] / 100));
                            }

                        } else {
                            $_tax = fn_format_price($tax['rate_value']);
                        }

                        $tax_data[$k]['applies']['S_' . $shipping_id . '_' . $s_id] = $_tax;
                        $tax_data[$k]['tax_subtotal'] = array_sum($tax_data[$k]['applies']);

                        if ($tax['price_includes_tax'] === 'N') {
                            $order['subtotal'] += ($_tax - $tax['applies']['S_' . $shipping_id . '_' . $s_id]);
                            $order['total'] += ($_tax - $tax['applies']['S_' . $shipping_id . '_' . $s_id]);
                        }
                    }
                }
            }
        }
    }

    return true;
}

/**
* $type values
*
* M-O+   change main and optional data
* O-     change optional data
* M+     change main data
*
*/
function fn_rma_recalculate_order_routine(&$order, &$item, $mirror_item, $type = '', $ex_data = array())
{
    $amount = 0;
    if (!isset($item['extra']['exclude_from_calculate'])) {
        if (in_array($type, array('M+', 'M-O+'))) {
            $sign = ($type == 'M+') ? 1 : -1;

            $delta = ($mirror_item['price'] * $mirror_item['extra']['returns'][$ex_data['return_id']]['amount']);
            $order['subtotal'] = $order['subtotal'] + $sign * $delta;
            $order['total'] = $order['total'] + $sign * $delta;

            $_discount = isset($mirror_item['extra']['discount']) ? $mirror_item['extra']['discount'] : (isset($item['extra']['discount']) ? $item['extra']['discount'] : 0);
            $order['discount'] = $order['discount'] + $sign * $_discount * $item['amount'];
            unset($mirror_item['extra']['discount'], $item['extra']['discount']);
        }
        if (in_array($type, array('O-', 'M-O+'))) {
            $amount = fn_rma_recalculate_product_amount($item['item_id'], $item['product_id'], @$item['extra']['product_options'], $type, $ex_data);
        }
    } else {
        if (in_array($type, array('O-', 'M-O+'))) {
            fn_rma_recalculate_product_amount($item['item_id'], $item['product_id'], @$item['extra']['product_options'], $type, $ex_data);
        }
    }

    fn_set_hook('rma_recalculate_order', $item, $mirror_item, $type, $ex_data, $amount);
}

function fn_rma_recalculate_product_amount($item_id, $product_id, $product_options, $type, $ex_data)
{

    $sign = ($type == 'O-') ? '-' : '+';
    $amount = db_get_field("SELECT amount FROM ?:rma_return_products WHERE return_id = ?i AND item_id = ?i AND type = ?s", $ex_data['return_id'], $item_id, ReturnOperationStatuses::APPROVED);
    fn_update_product_amount($product_id, $amount, $product_options, $sign);

    return $amount;
}

function fn_rma_recalculate_order($order_id, $recalculate_type, $return_id, $is_refund,  $ex_data)
{
    if (empty($recalculate_type) || empty($return_id) || empty($order_id) || !is_array($ex_data) || ($recalculate_type == RecalculateOperations::MANUALLY && !isset($ex_data['total']))) {
        return false;
    }

    $original_order_data = $order = db_get_row("SELECT total, subtotal, discount, shipping_cost, status FROM ?:orders WHERE order_id = ?i", $order_id);
    $order_items = db_get_hash_array("SELECT * FROM ?:order_details WHERE ?:order_details.order_id = ?i", 'item_id', $order_id);
    $additional_data = db_get_hash_single_array("SELECT type, data FROM ?:order_data WHERE order_id = ?i", array('type', 'data'), $order_id);
    $order_return_info = @unserialize(@$additional_data[ORDER_DATA_RETURN]);
    $order_tax_info = @unserialize(@$additional_data['T']);
    $status_order = $order['status'];
    unset($order['status']);
    if ($recalculate_type == RecalculateOperations::AUTO) {
        $product_groups = @unserialize(@$additional_data['G']);
        if (YesNo::toBool($is_refund)) {
            $sign = ($ex_data['inventory_to'] == InventoryOperations::INCREASED) ? -1 : 1;
            // What for is this section ???
            if (!empty($order_return_info['returned_products'])) {
                foreach ($order_return_info['returned_products'] as $item_id => $item) {
                    if (isset($item['extra']['returns'][$return_id])) {
                        $r_item = $o_item = $item;
                        unset($r_item['extra']['returns'][$return_id]);
                        $r_item['amount'] = $item['amount'] - $item['extra']['returns'][$return_id]['amount'];
                        fn_rma_recalculate_order_routine($order, $r_item, $item, 'O-', $ex_data);
                        if (empty($r_item['amount'])) {
                            unset($order_return_info['returned_products'][$item_id]);
                        } else {
                            $order_return_info['returned_products'][$item_id] = $r_item;
                        }

                        $o_item['primordial_amount'] = (isset($order_items[$item_id]) ? $order_items[$item_id]['amount'] : 0) + $item['extra']['returns'][$return_id]['amount'];
                        $o_item['primordial_discount'] = @$o_item['extra']['discount'];
                        fn_rma_recalculate_order_routine($order, $o_item, $item, 'M+', $ex_data);
                        $o_item['amount'] = (isset($order_items[$item_id]) ? $order_items[$item_id]['amount'] : 0) + $item['extra']['returns'][$return_id]['amount'];

                        if (isset($order_items[$item_id]['extra'])) {
                            $o_item['extra'] = @unserialize($order_items[$item_id]['extra']);
                        }
                        $o_item['extra']['returns'][$return_id] = $item['extra']['returns'][$return_id];

                        $o_item['extra'] = serialize($o_item['extra']);
                        if (!isset($order_items[$item_id])) {
                            db_query("REPLACE INTO ?:order_details ?e", $o_item);
                        } else {
                            db_query("UPDATE ?:order_details SET ?u WHERE item_id = ?i AND order_id = ?i", $o_item, $item_id, $order_id);
                        }

                    }
                }
            }

            // Check all the products and update their amount and cost.
            foreach ($order_items as $item_id => $item) {
                $item['extra'] = @unserialize($item['extra']);

                if (isset($item['extra']['returns'][$return_id])) {
                    $o_item = $item;
                    $o_item['amount'] = $o_item['amount'] + $sign * $item['extra']['returns'][$return_id]['amount'];
                    unset($o_item['extra']['returns'][$return_id]);
                    if (empty($o_item['extra']['returns'])) {
                        unset($o_item['extra']['returns']);
                    }

                    fn_rma_recalculate_order_routine($order, $o_item, $item, '', $ex_data);
                    if (empty($o_item['amount'])) {
                        db_query("DELETE FROM ?:order_details WHERE item_id = ?i AND order_id = ?i", $item_id, $order_id);
                    } else {
                        $o_item['extra'] = serialize($o_item['extra']);
                        db_query("UPDATE ?:order_details SET ?u WHERE item_id = ?i AND order_id = ?i", $o_item, $item_id, $order_id);
                    }

                    if (!isset($order_return_info['returned_products'][$item_id])) {
                        $r_item = $item;
                        unset($r_item['extra']['returns']);
                        $r_item['amount'] = $item['extra']['returns'][$return_id]['amount'];
                    } else {
                        $r_item = $order_return_info['returned_products'][$item_id];
                        $r_item['amount'] = $r_item['amount'] + $item['extra']['returns'][$return_id]['amount'];
                    }
                    fn_rma_recalculate_order_routine($order, $r_item, $item, 'M-O+', $ex_data);
                    $r_item['extra']['returns'][$return_id] = $item['extra']['returns'][$return_id];
                    $order_return_info['returned_products'][$item_id] = $r_item;
                    fn_rma_update_order_taxes(
                        $order_tax_info,
                        $item_id,
                        $item['amount'],
                        $o_item['amount'],
                        $order,
                        $item['price'],
                        $original_order_data
                    );
                }
            }

            $_ori_data = array(
                'order_id' => $order_id,
                'type' 	   => ORDER_DATA_RETURN,
                'data'     => $order_return_info
            );
        }

        $shipping_info = array();
        if ($product_groups) {

            $_total = 0;

            foreach ($product_groups as $key_group => $group) {
                if (isset($group['chosen_shippings'])) {
                    foreach ($group['chosen_shippings'] as $key_shipping => $shipping) {
                        $_total += $shipping['rate'];
                    }
                }
            }

            foreach ($product_groups as $key_group => $group) {
                if (isset($group['chosen_shippings'])) {
                    foreach ((array) $ex_data['shipping_costs'] as $shipping_id => $cost) {
                        foreach ($group['chosen_shippings'] as $key_shipping => $shipping) {
                            $shipping_id = $shipping['shipping_id'];
                            $product_groups[$key_group]['chosen_shippings'][$key_shipping]['rate'] = fn_format_price($_total ? (($shipping['rate'] / $_total) * $cost) : ($cost / count($product_groups)));
                            $product_groups[$key_group]['shippings'][$shipping_id]['rate'] = fn_format_price($_total ? (($shipping['rate'] / $_total) * $cost) : ($cost / count($product_groups)));
                            if (empty($shipping_info[$shipping_id])) {
                                $shipping_info[$shipping_id] = $product_groups[$key_group]['shippings'][$shipping_id];
                            }
                            $shipping_info[$shipping_id]['rates'][$key_group] = $product_groups[$key_group]['shippings'][$shipping_id]['rate'];
                        }
                    }
                }
            }
            db_query("UPDATE ?:order_data SET ?u WHERE order_id = ?i AND type = 'G'", array('data' => serialize($product_groups)), $order_id);

            fn_update_shipping_taxes($order_tax_info, $shipping_info, $order);
        }

        $order['total'] -= $order['shipping_cost'];
        $order['shipping_cost'] = isset($ex_data['shipping_costs']) ? array_sum($ex_data['shipping_costs']) : $order['shipping_cost'];
        $order['total'] += $order['shipping_cost'];

        $order['total'] = ($order['total'] < 0) ? 0 : $order['total'];

        if (!empty($order_tax_info)) {
            db_query("UPDATE ?:order_data SET ?u WHERE order_id = ?i AND type = 'T'", array('data' => serialize($order_tax_info)), $order_id);
        }

    } elseif ($recalculate_type == RecalculateOperations::MANUALLY) {
        $order['total'] = $order['total'] + isset($ex_data['total']) ? $ex_data['total'] : 0;
        $_ori_data = array(
            'order_id' => $order_id,
            'type'     =>  ORDER_DATA_RETURN,
            'data'     => array(
                'return' 			=> fn_format_price(((isset($order_return_info['return']) ? $order_return_info['return'] : 0) - isset($ex_data['total']) ? $ex_data['total'] : 0)),
                'returned_products' => (isset($order_return_info['returned_products'])) ? $order_return_info['returned_products'] : ''
            )
        );

        $return_products = db_get_hash_array("SELECT * FROM ?:rma_return_products WHERE return_id = ?i AND type = ?s", 'item_id', $return_id, ReturnOperationStatuses::APPROVED);
        foreach ((array) $return_products as $item_id => $v) {
            $v['extra']['product_options'] = @unserialize($v['extra']['product_options']);
            if ($ex_data['inventory_to'] == InventoryOperations::DECREASED || $ex_data['status_to'] == ReturnOperationStatuses::REQUESTED) {
                fn_update_product_amount($v['product_id'], $v['amount'], @$v['extra']['product_options'], '-', true, $order);
            } elseif ($ex_data['inventory_to'] == InventoryOperations::INCREASED) {
                fn_update_product_amount($v['product_id'], $v['amount'], $v['extra']['product_options'], '+', true, $order);
            }
        }
    }

    if (YesNo::toBool($is_refund)) {
        if (isset($_ori_data['data']['return']) && floatval($_ori_data['data']['return']) == 0) {
            unset($_ori_data['data']['return']);
        }
        if (empty($_ori_data['data']['returned_products'])) {
            unset($_ori_data['data']['returned_products']);
        }

        if (!empty($_ori_data['data'])) {
            $_ori_data['data'] = serialize($_ori_data['data']);
            db_query("REPLACE INTO ?:order_data ?e", $_ori_data);
        } else {
            db_query("DELETE FROM ?:order_data WHERE order_id = ?i AND type = ?s", $order_id, ORDER_DATA_RETURN);
        }
    }

    foreach ($order as $k => $v) {
        $order[$k] = fn_format_price($v);
    }

    db_query("UPDATE ?:orders SET ?u WHERE order_id = ?i", $order, $order_id);

    if (fn_allowed_for('MULTIVENDOR')) {
        Tygh::$app['session']['cart'] = isset(Tygh::$app['session']['cart']) ? Tygh::$app['session']['cart'] : array();
        $cart = & Tygh::$app['session']['cart'];
        $auth = & Tygh::$app['session']['auth'];

        $action = 'save';
        fn_mve_place_order($order_id, $action, $status_order, $cart, $auth);
    }
}

function fn_rma_get_status_params_definition(&$status_params, &$type)
{
    if ($type == STATUSES_ORDER) {
        $status_params['allow_return'] = array (
                'type' => 'checkbox',
                'label' => 'allow_return_registration'
        );

    } elseif ($type == STATUSES_RETURN) {
        $status_params = array (
            'inventory' => array (
                'type' => 'select',
                'label' => 'inventory',
                'variants' => array (
                    'I' => 'increase',
                    'D' => 'decrease',
                ),
                'not_default' => true
            )
        );
    }

    return true;
}

function fn_rma_delete_order(&$order_id)
{
    $return_ids = db_get_fields("SELECT return_id FROM ?:rma_returns WHERE order_id = ?i", $order_id);
    if (!empty($return_ids)) {
        foreach ($return_ids as $return_id) {
            fn_delete_return($return_id);
        }
    }
}

/**
 * Gets html packing slip.
 *
 * @param array     $return_ids List of return identifiers
 * @param array     $auth       Auth data
 * @param string    $area       Current area
 * @param string    $lang_code  Language code
 *
 * @return string Return html
 */
function fn_rma_print_packing_slips($return_ids, $auth, $area = AREA, $lang_code = CART_LANGUAGE)
{
    /** @var Smarty $view */
    $view = Tygh::$app['view'];
    $html = array();

    if (!is_array($return_ids)) {
        $return_ids = array($return_ids);
    }

    if (Registry::get('settings.Appearance.email_templates') == 'old') {
        $view->assign('reasons', fn_get_rma_properties(RMA_REASON, $lang_code));
        $view->assign('actions', fn_get_rma_properties(RMA_ACTION, $lang_code));
        $view->assign('order_status_descr', fn_get_simple_statuses(STATUSES_RETURN, false, false, $lang_code));
    }

    foreach ($return_ids as $return_id) {
        $return_info = fn_get_return_info($return_id);

        if (empty($return_info)
            || ($area == 'C'
                && ($return_info['user_id'] != $auth['user_id']
                    || !fn_is_order_allowed($return_info['order_id'], $auth)
                ))
        ) {
            continue;
        }

        if (Registry::get('settings.Appearance.email_templates') == 'old') {
            $order_info = fn_get_order_info($return_info['order_id'], false, true, false, true, $lang_code);

            if (empty($order_info)) {
                continue;
            }

            $view->assign('return_info', $return_info);
            $view->assign('order_info', $order_info);
            $view->assign('company_data', fn_get_company_placement_info($order_info['company_id'], $lang_code));

            $html[] = $view->displayMail('addons/rma/print_slip.tpl', false, $area, $order_info['company_id'], $lang_code);
        } else {
            /** @var \Tygh\Addons\Rma\Documents\PackingSlip\Type $rma_packing_slip */
            $rma_packing_slip = Tygh::$app['template.document.rma_packing_slip.type'];
            $result = $rma_packing_slip->renderByReturnId($return_id, 'default', $lang_code);

            if (!$result) {
                continue;
            }

            $view->assign('content', $result);
            $result = $view->displayMail('common/wrap_document.tpl', false, 'A');

            $html[] = $result;
        }

        if ($return_id != end($return_ids)) {
            $html[] = "<div style='page-break-before: always;'>&nbsp;</div>";
        }
    }

    return implode("\n", $html);
}

/**
 * Gets return request name
 *
 * @param int return_id Return identifier
 * @return string Return title
 */
function fn_rma_get_return_name($return_id)
{
    return $return_id;
}

function fn_rma_paypal_get_ipn_order_ids(&$data, &$order_ids)
{
    if (!isset($data['txn_type']) && fn_allowed_for('MULTIVENDOR')) {
        //in MVE we should process refund ipn only for those orders, which was requested and approved by admin
        $child_orders_ids = db_get_fields("SELECT order_id FROM ?:orders WHERE parent_order_id = ?i", $order_ids[0]);
        if (!empty($child_orders_ids)) {
            $orders_to_be_canceled = db_get_fields(
                'SELECT order_id'
                . ' FROM ?:rma_returns'
                . ' WHERE status IN ('
                . ' SELECT ?:statuses.status'
                . ' FROM ?:statuses'
                . ' INNER JOIN ?:status_data'
                . ' ON ?:status_data.status_id = ?:statuses.status_id'
                . ' WHERE type = ?s'
                . ' AND param = ?s'
                . ' AND value = ?s'
                . ' AND ?:statuses.status != ?s)'
                . ' AND order_id in (?n)',
                STATUSES_RETURN,
                'inventory',
                'I',
                ReturnOperationStatuses::REQUESTED,
                $child_orders_ids
            );

            $order_ids = !empty($orders_to_be_canceled) ? $orders_to_be_canceled : $order_ids;
        }
    }
}

/**
 * Hook handler: on reorder product.
 */
function fn_rma_reorder_product($order_info, &$cart, $auth, $product, $amount, $price, $zero_price_action, $k)
{
    unset($cart['products'][$k]['extra']['returns']);
}
