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

namespace Tygh\Notifications\Messages\Order\StatusChanged;

use Tygh\Notifications\Messages\MailMessage;
use Tygh\Registry;

/**
 * Class NotifyCustomerMessage represents a message that is sent to the customer on an order status change.
 *
 * @package Tygh\Events\Messages\Order\StatusChanged
 */
class CustomerMailMessage extends MailMessage
{
    protected $from = 'company_orders_department';

    protected $area = 'C';

    protected $legacy_template = 'orders/order_notification.tpl';

    public static function createFromOrder($order)
    {
        $lang_code = empty($order['lang_code'])
            ? CART_LANGUAGE
            : $order['lang_code'];

        $order_status = static::initOrderStatus($order, $lang_code);
        $payment_method = static::initPaymentMethod($order);

        $shipments = static::initShipments($order['order_id']);
        $use_shipments = static::initUseShipments($shipments);
        $tracking_numbers = static::initTrackingNumbers($order, $shipments, $use_shipments);
        $shipping_methods = static::initShippingMethods($order);

        $profile_files = static::initProfileFeilds($lang_code);

        $secondary_currency = static::initSecondaryCurrency($order, Registry::get('currencies'));

        $take_surcharge_from_vendor = static::initTakeSurchargeFromVendor($order['products']);

        $message = new self(
            $order,
            $lang_code,
            $shipments,
            $tracking_numbers,
            $shipping_methods,
            $order_status,
            $payment_method,
            $profile_files,
            $secondary_currency,
            $take_surcharge_from_vendor
        );

        return $message;
    }

    public function __construct(
        $order_info,
        $lang_code,
        $shipments,
        $tracking_numbers,
        $shipping_methods,
        $order_status,
        $payment_method,
        $profile_fields,
        $secondary_currency,
        $take_surcharge_from_vendor
    ) {
        $this->language_code = $lang_code;
        $this->to = $order_info['email'];
        $this->template_code = $this->initTemplateCode($order_info['status']);
        $this->company_id = $order_info['company_id'];

        $this->data = [
            'order_info'                 => $order_info,
            'shipments'                  => $shipments,
            'tracking_numbers'           => $tracking_numbers,
            'shipping_methods'           => $shipping_methods,
            'order_status'               => $order_status,
            'payment_method'             => $payment_method,
            'status_settings'            => $order_status['params'],
            'profile_fields'             => $profile_fields,
            'profields'                  => $this->initProfields($profile_fields),
            'secondary_currency'         => $secondary_currency,
            'take_surcharge_from_vendor' => $take_surcharge_from_vendor,
        ];
    }

    protected static function initShipments($order_id)
    {
        list($shipments) = fn_get_shipments_info(['order_id' => $order_id, 'advanced_info' => true]);

        return $shipments;
    }

    protected static function initUseShipments($shipments)
    {
        $use_shipments = !fn_one_full_shipped($shipments);

        return $use_shipments;
    }

    protected static function initTrackingNumbers($order_info, $shipments, $use_shipments)
    {
        $tracking_numbers = [];

        if (!empty($order_info['shipping'])) {
            foreach ($order_info['shipping'] as $shipping) {
                if (!$use_shipments && !empty($shipments[$shipping['group_key']]['tracking_number'])) {
                    $tracking_numbers[] = $shipments[$shipping['group_key']]['tracking_number'];
                }
            }
        }

        $tracking_numbers = implode(', ', $tracking_numbers);

        return $tracking_numbers;
    }

    protected static function initShippingMethods($order_info)
    {
        $shipping_methods = [];

        if (!empty($order_info['shipping'])) {
            foreach ($order_info['shipping'] as $shipping) {
                $shipping_methods[] = $shipping['shipping'];
            }
        }

        $shipping_methods = implode(', ', $shipping_methods);

        return $shipping_methods;
    }

    protected static function initPaymentMethod($order_info)
    {
        $payment_id = !empty($order_info['payment_method']['payment_id'])
            ? $order_info['payment_method']['payment_id']
            : 0;

        $payment_method = [];
        if ($payment_id) {
            $payment_method = fn_get_payment_data($payment_id, $order_info['order_id'], $order_info['lang_code']);
        }

        return $payment_method;
    }

    protected static function initProfileFeilds($lang_code)
    {
        $profile_fields = fn_get_profile_fields('I', '', $lang_code);

        return $profile_fields;
    }

    protected function initProfields(array $profile_fields)
    {
        $profields = [];
        foreach ($profile_fields as $section => $fields) {
            $profields[$section] = fn_fields_from_multi_level($fields, 'field_name', 'field_id');
        }

        return $profields;
    }

    protected static function initSecondaryCurrency($order_info, $currencies)
    {
        $secondary_currency = '';

        if (!empty($order_info['secondary_currency']) && isset($currencies[$order_info['secondary_currency']])) {
            $secondary_currency = $order_info['secondary_currency'];
        }

        return $secondary_currency;
    }

    protected static function initTakeSurchargeFromVendor($products)
    {
        $take_surcharge_from_vendor = fn_allowed_for('MULTIVENDOR')
            ? fn_take_payment_surcharge_from_vendor($products)
            : false;

        return $take_surcharge_from_vendor;
    }

    protected function initTemplateCode($status)
    {
        $template_code = 'order_notification.' . strtolower($status);

        return $template_code;
    }

    protected static function initOrderStatus($order, $lang_code)
    {
        $order_statuses = fn_get_statuses(STATUSES_ORDER, [], true, false, $lang_code, $order['company_id']);

        $status = $order_statuses[$order['status']];

        return $status;
    }
}
