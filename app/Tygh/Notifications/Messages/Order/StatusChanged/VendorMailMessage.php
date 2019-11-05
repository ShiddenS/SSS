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

use Tygh\Registry;

/**
 * Class NotifyVendorMessage represents a message that is sent to the vendor on an order status change.
 *
 * @package Tygh\Events\Messages\Order\StatusChanged
 */
class VendorMailMessage extends AdminMailMessage
{
    protected $to = 'company_orders_department';

    public static function createFromOrder($order)
    {
        $lang_code = fn_get_company_language($order['company_id']);

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
}
