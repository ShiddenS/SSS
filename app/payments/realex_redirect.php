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

/**
 * @var string $mode
 * @var string $order_id
 * @var array $order_info
 * @var array $processor_data
 */

use Tygh\Registry;
use Tygh\Enum\ProfileFieldLocations;

defined('BOOTSTRAP') or die('Access denied');

if (!defined('PAYMENT_NOTIFICATION')) {
    $currency_settings = Registry::get('currencies.' . $processor_data['processor_params']['currency']);
    if (empty($currency_settings)) {
        $currency_settings = Registry::get('currencies.' . CART_PRIMARY_CURRENCY);
    }
    $timestamp = date('Ymdhis');

    $location_manager = Tygh::$app['location'];
    $billing_country = $location_manager->getLocationField($order_info, 'country', '', BILLING_ADDRESS_PREFIX);
    $phone_masks = fn_get_phone_masks(false);
    $local_number = preg_replace('/[^\d]/', '', $location_manager->getLocationField($order_info, 'phone', '', BILLING_ADDRESS_PREFIX));

    foreach ($phone_masks as $key => $country_data) {
        if ($country_data['cc'] === $billing_country || (is_array($country_data['cc']) && array_search($billing_country, $country_data['cc']) !== false)) {
            $country_code = preg_replace('/[^\d]/', '', $country_data['mask']);
            break;
        }
    }

    if (isset($country_code) && substr($local_number, 0, strlen($country_code)) === $country_code) {
        $format_phone_number = $country_code . '|' . substr($local_number, strlen($country_code));
    } else {
        $format_phone_number = substr($local_number, 0, 1) . '|' . substr($local_number, 1);
    }

    // The payment requires ISO 3166-1 numeric three-digit country code
    $billing_country_num = db_get_field('SELECT code_N3 FROM ?:countries WHERE code = ?s', $billing_country);
    $shipping_country_num = db_get_field('SELECT code_N3 FROM ?:countries WHERE code = ?s', $location_manager->getLocationField($order_info, 'country', '', SHIPPING_ADDRESS_PREFIX));

    $post_data = [
        'ORDER_ID'              => $order_id . $timestamp,
        'MERCHANT_ID'           => $processor_data['processor_params']['merchant_id'],
        'ACCOUNT'               => $processor_data['processor_params']['account'],
        'CURRENCY'              => $currency_settings['currency_code'],
        'AMOUNT'                => fn_format_price(
                $order_info['total'] / $currency_settings['coefficient'],
                $currency_settings['currency_code']
            ) * 100,
        'TIMESTAMP'             => $timestamp,
        'AUTO_SETTLE_FLAG'      => (int)($processor_data['processor_params']['settlement'] == 'auto'),
        'RETURN_TSS'            => '1',
        'MERCHANT_RESPONSE_URL' => fn_url(
            "payment_notification.process&payment=realex_redirect&order_id={$order_id}",
            AREA,
            'current'
        ),
        'HPP_VERSION' => 2, // This must be set to 2.
        'HPP_CUSTOMER_EMAIL' => $order_info['email'],
        'HPP_CUSTOMER_PHONENUMBER_MOBILE' => $format_phone_number,
        'HPP_BILLING_STREET1' => $location_manager->getLocationField($order_info, 'address', '', BILLING_ADDRESS_PREFIX),
        'HPP_BILLING_STREET2' => $location_manager->getLocationField($order_info, 'address_2', '', BILLING_ADDRESS_PREFIX), // Second line of the customer's billing address. Can be submitted as blank if not relevant for the particular customer.
        'HPP_BILLING_STREET3' => '', // Third line of the customer's billing address. Can be submitted as blank if not relevant for the particular customer.
        'HPP_BILLING_CITY' => $location_manager->getLocationField($order_info, 'city', '', BILLING_ADDRESS_PREFIX),
        'HPP_BILLING_POSTALCODE' => $location_manager->getLocationField($order_info, 'zipcode', '', BILLING_ADDRESS_PREFIX),
        'HPP_BILLING_COUNTRY' => $billing_country_num,
        'HPP_SHIPPING_STREET1' => $location_manager->getLocationField($order_info, 'address', '', SHIPPING_ADDRESS_PREFIX),
        'HPP_SHIPPING_STREET2' => $location_manager->getLocationField($order_info, 'address_2', '', SHIPPING_ADDRESS_PREFIX),
        'HPP_SHIPPING_STREET3' => '',
        'HPP_SHIPPING_CITY' => $location_manager->getLocationField($order_info, 'city', '', SHIPPING_ADDRESS_PREFIX),
        'HPP_SHIPPING_STATE' => $location_manager->getLocationField($order_info, 'state', '', SHIPPING_ADDRESS_PREFIX),
        'HPP_SHIPPING_POSTALCODE' => $location_manager->getLocationField($order_info, 'zipcode', '', SHIPPING_ADDRESS_PREFIX),
        'HPP_SHIPPING_COUNTRY' => $shipping_country_num,
        'HPP_ADDRESS_MATCH_INDICATOR' => fn_check_shipping_billing($order_info, fn_get_profile_fields(ProfileFieldLocations::CHECKOUT_FIELDS)) ? 'FALSE' : 'TRUE', // Indicates whether the shipping address matches the billing address.
        'HPP_CHALLENGE_REQUEST_INDICATOR' => 'NO_PREFERENCE' // Indicates whether a challenge is requested for this transaction. NO_PREFERENCE - No preference as to whether the customer is challenged.
    ];

    $post_data['SHA1HASH'] = sha1(
        strtolower(
            sha1(
                $post_data['TIMESTAMP'] . '.'
                . $post_data['MERCHANT_ID'] . '.'
                . $post_data['ORDER_ID'] . '.'
                . $post_data['AMOUNT'] . '.'
                . $post_data['CURRENCY']
            )
        ) . '.' . $processor_data['processor_params']['secret_word']
    );

    fn_create_payment_form(
        ($processor_data['processor_params']['mode'] == 'test')
            ? "https://hpp.sandbox.realexpayments.com/pay"
            : "https://hpp.realexpayments.com/pay",
        $post_data,
        'Realex Payments',
        false
    );
} else {
    if ($mode == 'process') {
        if (fn_check_payment_script('realex_redirect.php', $_REQUEST['order_id'], $processor_data)) {
            $avs = array(
                'M' => __('payments.realex.avs.matched'),
                'N' => __('payments.realex.avs.not_matched'),
                'I' => __('payments.realex.avs.problem_with_check'),
                'U' => __('payments.realex.avs.unable_to_check'),
                'P' => __('payments.realex.avs.partial_match'),
            );
            $pp_response = array(
                'order_status'         => 'F',
                'reason_text'          => 'Your transaction was unsuccessful. There was a problem with your order, please return to the checkout and try again.',
                'payments.realex.transaction_order_id' => isset($_REQUEST['ORDER_ID']) ? $_REQUEST['ORDER_ID'] : 'N/A',
                'payments.realex.transaction_pasref'   => isset($_REQUEST['PASREF']) ? $_REQUEST['PASREF'] : 'N/A',
                'payments.realex.result_code'          => isset($_REQUEST['RESULT']) ? $_REQUEST['RESULT'] : 'N/A',
                'payments.realex.result_message'       => isset($_REQUEST['MESSAGE']) ? $_REQUEST['MESSAGE'] : 'N/A',
                '3d_secure'            => (isset($_REQUEST['XID']) || isset($_REQUEST['CAVV']) || isset($_REQUEST['ECI']))
                    ? __('enabled')
                    : __('disabled'),
                'payments.realex.xid'                  => isset($_REQUEST['XID']) ? $_REQUEST['XID'] : 'N/A',
                'payments.realex.cavv'                 => isset($_REQUEST['CAVV']) ? $_REQUEST['CAVV'] : 'N/A',
                'payments.realex.eci'                  => isset($_REQUEST['ECI']) ? $_REQUEST['ECI'] : 'N/A',
                'payments.realex.tss_result'           => isset($_REQUEST['TSS']) ? $_REQUEST['TSS'] : 'N/A',
                'payments.realex.avs_address'          => (isset($_REQUEST['AVSADDRESSRESULT'], $avs[$_REQUEST['AVSADDRESSRESULT']]))
                    ? $avs[$_REQUEST['AVSADDRESSRESULT']]
                    : 'N/A',
                'payments.realex.avs_postcode'         => (isset($_REQUEST['AVSPOSTCODERESULT'], $avs[$_REQUEST['AVSPOSTCODERESULT']]))
                    ? $avs[$_REQUEST['AVSPOSTCODERESULT']]
                    : 'N/A',
            );

            $order_info = fn_get_order_info($_REQUEST['order_id']);

            if (empty($processor_data)) {
                $processor_data = fn_get_processor_data($order_info['payment_id']);
            }

            $realex_statuses = $processor_data['processor_params']['statuses'];
            $realex_response_code = $_REQUEST['RESULT'];

            if ($realex_response_code == '00') {
                // Successful – the transaction has processed and you may proceed with the sale.
                $pp_response['order_status'] = $realex_statuses['successful'];
                $pp_response['reason_text'] = __('successful');
            } elseif ($realex_response_code == 101) {
                // Declined by Bank – generally insufficient funds or incorrect expiry date.
                $pp_response['order_status'] = $realex_statuses['declined'];
                $pp_response['reason_text'] = __('declined');
            } elseif ($realex_response_code == 102) {
                // Referral by Bank (treat as decline in automated system such as internet)
                $pp_response['order_status'] = $realex_statuses['refferal'];
                $pp_response['reason_text'] = __('payments.realex.refferal');
            } elseif ($realex_response_code == 103) {
                // Card reported lost or stolen
                $pp_response['order_status'] = $realex_statuses['card_lost_or_stolen'];
                $pp_response['reason_text'] = __('payments.realex.card_lost_or_stolen');
            } elseif (floor($realex_response_code / 100) == 2) {
                // Error with bank systems – generally you can tell the customer to try again later.
                // The resolution time depends on the issue.
                $pp_response['order_status'] = $realex_statuses['bank_error'];
                $pp_response['reason_text'] = __('payments.realex.bank_error');
            } elseif (floor($realex_response_code / 100) == 3) {
                // Error with Realex Payments systems – generally you can tell the customer to try again later.
                // The resolution time depends on the issue.
                $pp_response['order_status'] = $realex_statuses['realex_error'];
                $pp_response['reason_text'] = __('payments.realex.realex_error');
            } elseif (floor($realex_response_code / 100) == 5) {
                // Incorrect XML message formation or content. These are either development errors,
                // configuration errors or customer errors
                $pp_response['order_status'] = $realex_statuses['incorrect_request'];
                $pp_response['reason_text'] = __('payments.realex.incorrect_request');
            } elseif (floor($realex_response_code / 100) == 6) {
                // Client deactivated – your Realex account has been suspended. Contact Realex support for further information.
                $pp_response['order_status'] = $realex_statuses['connector_error'];
                $pp_response['reason_text'] = __('payments.realex.connector_error');
            }

            fn_finish_payment($_REQUEST['order_id'], $pp_response);

            if ($realex_response_code == '00') {
                $result = "<strong>Your transaction was successful</strong><br>To complete your order you must follow the link below.<br> Click <a href='" . fn_url(
                        "payment_notification.notify&payment=realex_redirect&order_id=$_REQUEST[order_id]",
                        AREA,
                        'current'
                    ) . "'>here</a> to complete checkout";
            } else {
                $result = "<strong>Your transaction was unsuccessful.</strong><br> There was a problem with your order, please return to the checkout and try again.<br>Click <a href='" . fn_url(
                        "payment_notification.cancel&payment=realex_redirect&order_id=$_REQUEST[order_id]",
                        AREA,
                        'current'
                    ) . "'>here</a> to return";
            }

            echo $result;
            exit;
        }
    } elseif ($mode == 'notify') {
        fn_order_placement_routines('route', $_REQUEST['order_id'], false);
    } elseif ($mode == 'cancel') {
        fn_order_placement_routines('checkout_redirect', $_REQUEST['order_id'], false);
    }
}