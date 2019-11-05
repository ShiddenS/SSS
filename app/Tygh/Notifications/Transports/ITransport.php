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

/**
 * Interface ITransport describes a transport that processes event messages.
 *
 * @package Tygh\Events\Transports
 */
interface ITransport
{
    /**
     * Provides transport ID.
     *
     * @return string
     */
    public static function getId();

    /**
     * Processes a message of an event.
     *
     * @param \Tygh\Notifications\Messages\IMessage $message Message
     *
     * @return bool Whether a message was successfully processed
     */
    public function process($message);
}
