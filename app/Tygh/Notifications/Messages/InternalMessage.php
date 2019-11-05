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
 * Class InternalMessage implements Notifications center message.
 *
 * @package Tygh\Notifications\Messages
 */
abstract class InternalMessage implements IMessage
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $severity;

    /**
     * @var string
     */
    protected $section;

    /**
     * @var string
     */
    protected $area;

    /**
     * @var string
     */
    protected $action_url;

    /**
     * @var bool
     */
    protected $is_read;

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @var string
     * @see \Tygh\Enum\RecipientSearchMethods
     */
    protected $recipient_search_method;

    /**
     * @var string
     */
    protected $recipient_search_criteria;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getSeverity()
    {
        return $this->severity;
    }

    /**
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @return string
     */
    public function getActionUrl()
    {
        return $this->action_url;
    }

    /**
     * @return bool
     */
    public function getIsRead()
    {
        return $this->is_read;
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getRecipientSearchCriteria()
    {
        return $this->recipient_search_criteria;
    }

    /**
     * @return string
     */
    public function getRecipientSearchMethod()
    {
        return $this->recipient_search_method;
    }
}
