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

use Tygh\Notifications\Messages\Order\EdpMailMessage;
use Tygh\Notifications\Messages\Order\StatusChanged\AdminMailMessage;
use Tygh\Notifications\Messages\Order\StatusChanged\CustomerMailMessage;
use Tygh\Notifications\Messages\Order\StatusChanged\VendorMailMessage;
use Tygh\Notifications\Transports\MailTransport;

defined('BOOTSTRAP') or die('Access denied');

$schema = [
    'order.status_changed'      => [
        MailTransport::getId()     => [
            'customer' => [CustomerMailMessage::class, 'createFromOrder'],
            'admin'    => [AdminMailMessage::class, 'createFromOrder'],
        ],
    ],
    'order.edp'                 => [
        MailTransport::getId()     => [
            'customer' => [EdpMailMessage::class, 'createFromOrder'],
        ],
    ],
];

if (fn_allowed_for('MULTIVENDOR')) {
    $schema['order.status_changed'][MailTransport::getId()]['vendor'] = [VendorMailMessage::class, 'createFromOrder'];
}

return $schema;
