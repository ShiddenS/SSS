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
 * Class NotifyDepartmentMessage represents a message that is sent to the department on an order status change.
 *
 * @package Tygh\Events\Messages\Order\StatusChanged
 */
class AdminMailMessage extends MailMessage
{
    protected $to = 'default_company_orders_department';

    protected $from = 'default_company_orders_department';

    protected $legacy_template = 'orders/order_notification.tpl';

    protected $area = 'A';

    public static function createFromOrder($order)
    {
        $lang_code = Registry::get('settings.Appearance.backend_default_language');

        $order = static::initOrderInfo($order, $lang_code);

        $order_status = self::initOrderStatus($order, $lang_code);

        $shipments = static::initShipments($order['order_id']);

        $use_shipments = static::initUseShipments($shipments);

        $payment_method = static::initPaymentMethod($order, $lang_code);

        $profile_fields = static::initProfileFeilds($lang_code);

        $secondary_currency = static::initSecondaryCurrency($order, Registry::get('currencies'));

        $message = new self(
            $order,
            $lang_code,
            $shipments,
            $use_shipments,
            $order_status,
            $payment_method,
            $profile_fields,
            $secondary_currency
        );

        return $message;
    }

    public function __construct(
        $order_info,
        $lang_code,
        $shipments,
        $use_shipments,
        $order_status,
        $payment_method,
        $profile_fields,
        $secondary_currency
    ) {
        $this->language_code = $lang_code;
        $this->template_code = $this->initTemplateCode($order_info['status']);
        $this->reply_to = $order_info['email'];
        $this->company_id = $order_info['company_id'];

        $this->data = [
            'order_info'         => $order_info,
            'shipments'          => $shipments,
            'use_shipments'      => $use_shipments,
            'order_status'       => $order_status,
            'payment_method'     => $payment_method,
            'status_settings'    => $order_status['params'],
            'profile_fields'     => $profile_fields,
            'secondary_currency' => $secondary_currency,
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

    protected static function initPaymentMethod($order_info, $lang_code)
    {
        $payment_id = !empty($order_info['payment_method']['payment_id'])
            ? $order_info['payment_method']['payment_id']
            : 0;

        $payment_method = [];
        if ($payment_id) {
            $payment_method = fn_get_payment_data($payment_id, $order_info['order_id'], $lang_code);
        }

        return $payment_method;
    }

    protected static function initProfileFeilds($lang_code)
    {
        $profile_fields = fn_get_profile_fields('I', '', $lang_code);

        return $profile_fields;
    }

    protected static function initSecondaryCurrency($order_info, $currencies)
    {
        $secondary_currency = '';

        if (!empty($order_info['secondary_currency']) && isset($currencies[$order_info['secondary_currency']])) {
            $secondary_currency = $order_info['secondary_currency'];
        }

        return $secondary_currency;
    }

    protected function initTemplateCode($status)
    {
        $template_code = 'order_notification.' . strtolower($status);

        return $template_code;
    }

    protected static function initOrderInfo($order_info, $lang_code)
    {
        fn_add_user_data_descriptions($order_info, $lang_code);

        fn_translate_products($order_info['products'], '', $lang_code, true);

        return $order_info;
    }

    protected static function initOrderStatus($order, $lang_code)
    {
        $order_statuses = fn_get_statuses(STATUSES_ORDER, [], true, false, $lang_code, $order['company_id']);

        $status = $order_statuses[$order['status']];

        return $status;
    }
}
