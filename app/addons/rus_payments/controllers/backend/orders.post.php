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
use Tygh\Http;
use Tygh\Payments\Processors\YandexMoneyMWS\Client as MWSClient;
use Tygh\Payments\Processors\YandexMoneyMWS\Exception as MWSException;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($mode == 'rus_payments_refund' && !empty($_REQUEST['refund_data'])) {
        $refund_data = $_REQUEST['refund_data'];
        $refund_data['amount'] = fn_format_price($refund_data['amount'], CART_PRIMARY_CURRENCY, 2, false);
        $refund_data['products'] = empty($refund_data['products']) ? array() : $refund_data['products'];

        $order_id = isset($_REQUEST['refund_data']['order_id']) ? $_REQUEST['refund_data']['order_id'] : $_REQUEST['order_id'];

        $order_info = fn_get_order_info($order_id);
        $payment_info = $order_info['payment_info'];
        $pdata = $order_info['payment_method'];

        if (fn_check_payment_script('yandex_money.php', $order_id) && $pdata['processor_params']['returns_enabled'] == 'Y') {

            try {
                if (empty($payment_info['yandex_merchant_order_id']) && empty($payment_info['yandex_invoice_id'])) {
                    throw new \Exception(__('addons.rus_payments.yandex_money_not_order_yandex'));
                }

                if  (empty($pdata['processor_params']['certificate_filename'])) {
                    throw new \Exception(__('addons.rus_payments.yandex_money_not_certificate'));
                }

                $params = array();

                if (!empty($payment_info['yandex_invoice_id'])) {
                    $params['invoice_id'] = $payment_info['yandex_invoice_id'];
                }

                if (!empty($payment_info['yandex_order_number'])) {
                    $params['order_number'] = $payment_info['yandex_order_number'];

                } elseif (!empty($payment_info['yandex_merchant_order_id'])) {
                    $chunks = explode('_', $payment_info['yandex_merchant_order_id'], 3);
                    $params['order_number'] = $chunks[0] . '_' . $chunks[1];
                }

                $cert = $pdata['processor_params']['certificate_filename'];

                $mws_client = new MWSClient();
                $mws_client->authenticate(array(
                    'pkcs12_file' => Registry::get('config.dir.certificates') . $cert,
                    'pass' => $pdata['processor_params']['p12_password'],
                    'shop_id' => $pdata['processor_params']['shop_id'],
                    'is_test_mode' => $pdata['processor_params']['mode'] == 'test',
                ));

                $orders = $mws_client->getOrders($params);

                if (empty($orders) || empty($orders['orderCount'])) {
                    throw new \Exception(__('addons.rus_payments.yandex_money_not_data_order'));
                }

                // indicates that receipt for an order was sent
                $is_receipt_sent = !empty($payment_info['yandex_checkpoint_receipt_sent']);

                // indicates that refund is partial
                $is_partial_refund = fn_yandex_checkpoint_is_partial_refund($refund_data, $order_info);

                $receipt = null;
                if (fn_is_yandex_checkpoint_receipt_required($pdata)
                    && ($is_partial_refund || !$is_receipt_sent)
                ) {
                    $receipt = fn_yandex_checkpoint_get_refund_receipt($refund_data, $order_info, $pdata['processor_params']['currency']);
                }

                $mws_client->returnPayment(
                    $order_info['order_id'],
                    $orders->order[0]['invoiceId'],
                    $refund_data['amount'],
                    !empty($refund_data['cause']) ? $refund_data['cause'] : '#',
                    MWSClient::YANDEX_CHECKPOINT_RUB,
                    $receipt
                );

                fn_change_order_status($order_info['order_id'], $pdata['processor_params']['returned_order_status']);

                $payment_info['yandex_refunded_time'] = date('c');
                $payment_info['yandex_refund_amount'] = $refund_data['amount'];
                fn_update_order_payment_info($order_info['order_id'], $payment_info);

            } catch (\Exception $e) {
                $message = __('addons.rus_payments.yandex_money_mws_operation_error');
                $message .= "<br />Tech message: " . $e->getMessage();
                fn_set_notification('E', __('error'), $message);
            }

        } elseif (fn_check_payment_script('avangard.php', $order_id) && $pdata['processor_params']['returns_enabled'] == 'Y' && !empty($payment_info['avangard_ticket'])) {

            $url = "https://www.avangard.ru/iacq/h2h/reverse_order";

            $dom = new DOMDocument('1.0', 'utf-8');
            $dom->formatOutput = true;

            $order = $dom->createElement('reverse_order');
            $order->appendChild($dom->createElement('ticket', $payment_info['avangard_ticket']));
            $order->appendChild($dom->createElement('shop_id', $pdata['processor_params']['shop_id']));
            $order->appendChild($dom->createElement('shop_passwd', $pdata['processor_params']['password']));

            if ($refund_data['amount'] != $order_info['total']) {
                $order->appendChild($dom->createElement('amount', $refund_data['amount'] * 100));
            }

            $dom->appendChild($order);

            $extra = array(
                'headers' => array(
                    'Content-type: application/x-www-form-urlencoded;charset=utf-8',
                    'Expect:'
                )
            );

            $result_xml = Http::post($url, array('xml' => $dom->saveXML()), $extra);
            $xml_data = @simplexml_load_string($result_xml);

            if (!empty($xml_data->response_message)) {

                if ($xml_data->response_code == 0) {
                    fn_set_notification('N', __('notify'), $xml_data->response_message);

                    $payment_info['avangard_refunded_transaction_id'] = strval($xml_data->id);
                    $payment_info['avangard_refunded_time'] = date('c');
                    $payment_info['avangard_refund_amount'] = $refund_data['amount'];

                    if (!empty($refund_data['cause'])) {
                        $payment_info['avangard_refund_cause'] = $refund_data['cause'];
                    }

                    fn_update_order_payment_info($order_info['order_id'], $payment_info);
                    fn_change_order_status($order_info['order_id'], $pdata['processor_params']['returned_order_status']);

                } else {
                    fn_set_notification('E', __('error'), $xml_data->response_message);
                }
            }
        }

        return array(CONTROLLER_STATUS_OK, 'orders.details?order_id=' . $order_id);
    }
}

if ($mode == 'details') {
    $order_info = Tygh::$app['view']->getTemplateVars('order_info');

    if ($order_info && !empty($order_info['payment_method']['processor_id'])) {
        $processor_id = $order_info['payment_method']['processor_id'];
        $processor_script = db_get_field("SELECT processor_script FROM ?:payment_processors WHERE processor_id = ?i", $processor_id);

        Tygh::$app['view']->assign('processor_script', $processor_script);

        $pdata = $order_info['payment_method'];

        if(isset($pdata['processor_params']['returns_enabled'])) {

            $pinfo = $order_info['payment_info'];

            $payment_info_required_fields = array(
                'yandex_confirmed_time',
                'yandex_postponed_payment',
                'yandex_canceled_time',
                'yandex_refunded_time',
                'avangard_canceled_time',
                'avangard_ticket'
            );
            foreach ($payment_info_required_fields as $field_name) {
                if (!isset($pinfo[$field_name])) {
                    $pinfo[$field_name] = null;
                }
            }

            $show_refund = $show_detailed_refund = false;

            if (fn_check_payment_script('yandex_money.php', $order_info['order_id'])) {
                $show_refund = $show_refund || $pdata['processor_params']['returns_enabled'] == 'Y' && ($pinfo['yandex_confirmed_time'] || !$pinfo['yandex_postponed_payment']) && !$pinfo['yandex_canceled_time'] && !$pinfo['yandex_refunded_time'];
                $show_detailed_refund = fn_is_yandex_checkpoint_receipt_required($pdata);

                if ($show_detailed_refund) {
                    $order_info = Tygh::$app['view']->getTemplateVars('order_info');
                    $order_info = fn_yandex_checkpoint_get_refunded_order($order_info);

                    Tygh::$app['view']->assign('returned_order_info', $order_info);
                }
            }

            if (fn_check_payment_script('avangard.php', $order_info['order_id'])) {
                $show_refund = $show_refund || !$pinfo['avangard_canceled_time'] && !$pinfo['avangard_refunded_time'] && $pinfo['avangard_ticket'];
            }

            Tygh::$app['view']->assign('show_refund', $show_refund);
            Tygh::$app['view']->assign('show_detailed_refund', $show_detailed_refund);
        }
    }
}
