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

namespace Tygh\Notifications\Transports;

use Tygh\Mailer\Mailer;

/**
 * Class MailerTransport implements a transport that send emails based on an event message.
 *
 * @package Tygh\Events\Transports
 */
class MailTransport implements ITransport
{
    /**
     * @var \Tygh\Mailer\Mailer
     */
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getId()
    {
        return 'mail';
    }

    /**
     * @param \Tygh\Notifications\Messages\MailMessage $message
     *
     * @return bool
     */
    public function process($message)
    {
        return $this->mailer->send([
            'to'            => $message->getTo(),
            'from'          => $message->getFrom(),
            'reply_to'      => $message->getReplyTo(),
            'data'          => $message->getData(),
            'template_code' => $message->getTemplateCode(),
            'tpl'           => $message->getLegacyTemplate(),
            'company_id'    => $message->getCompanyId(),
        ], $message->getArea(), $message->getLanguageCode());
    }
}
