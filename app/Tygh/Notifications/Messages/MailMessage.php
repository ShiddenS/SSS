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

namespace Tygh\Notifications\Messages;

/**
 * Class MailMessage implements a message that is sent via MailTransport
 *
 * @package Tygh\Notifications\Messages
 */
abstract class MailMessage implements IMessage
{
    /**
     * @var array|string
     */
    protected $to;

    /**
     * @var array|string
     */
    protected $from;

    /**
     * @var string|null
     */
    protected $reply_to = null;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $template_code;

    /**
     * @var string
     */
    protected $legacy_template;

    /**
     * @var string
     */
    protected $language_code;

    /**
     * @var int
     */
    protected $company_id;

    /**
     * @var string
     */
    protected $area;

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return string|null
     */
    public function getReplyTo()
    {
        return $this->reply_to;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getTemplateCode()
    {
        return $this->template_code;
    }

    /**
     * @return string
     */
    public function getLegacyTemplate()
    {
        return $this->legacy_template;
    }

    /**
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->language_code;
    }

    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }
}
