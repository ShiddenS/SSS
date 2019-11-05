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

namespace Tygh\Notifications\Messages\Order;

use Tygh\Notifications\Messages\MailMessage;

class EdpMailMessage extends MailMessage
{
    protected $area = 'C';

    protected $from = 'company_orders_department';

    protected $template_code = 'edp_access';

    protected $legacy_template = 'orders/edp_access.tpl';

    public static function createFromOrder($order, $edp_data)
    {
        $lang_code = empty($order['lang_code'])
            ? CART_LANGUAGE
            : $order['lang_code'];

        $message = new self($order, $lang_code, $edp_data);

        return $message;
    }

    public function __construct($order_info, $lang_code, $edp_data)
    {
        $this->language_code = $lang_code;
        $this->to = $order_info['email'];
        $this->company_id = $order_info['company_id'];

        $this->data = [
            'order_files_list_url' => $this->initFilesListUrl($order_info['order_id']),
            'order_info'           => $order_info,
            'edp_data'             => $edp_data,
        ];
    }

    protected function initFilesListUrl($order_id)
    {
        $url = fn_url("orders.order_downloads&order_id={$order_id}", $this->area);

        return $url;
    }
}
