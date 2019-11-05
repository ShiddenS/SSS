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

namespace Tygh\Notifications;

use Tygh\Notifications\Messages\IMessage;
use Tygh\Notifications\Transports\ITransportFactory;
use Tygh\Exceptions\DeveloperException;

/**
 * Class EventDispatcher provides event dispatching functionality.
 *
 * @package Tygh\Events
 */
class EventDispatcher
{
    /**
     * Schema of events from ('notifications', 'events')
     *
     * @var array
     */
    protected $events_schema;

    /**
     * User notifications settings from DB
     *
     * @var array
     */
    protected $notification_settings;

    /**
     * @var \Tygh\Notifications\Transports\ITransportFactory
     */
    protected $transport_factory;

    public function __construct(
        array $events_schema,
        array $notification_settings,
        ITransportFactory $transport_factory
    ) {
        $this->events_schema = $events_schema;
        $this->notification_settings = $notification_settings;
        $this->transport_factory = $transport_factory;
    }

    /**
     * @param string $event_id
     * @param mixed  ...$data
     *
     * @throws \Tygh\Exceptions\DeveloperException
     */
    public function dispatch($event_id, ...$data)
    {
        if (!isset($this->events_schema[$event_id])) {
            return;
        }

        foreach ($this->events_schema[$event_id] as $transport_id => $notification_group) {

            foreach ($notification_group as $receiver => $message_provider) {

                if (empty($this->notification_settings[$event_id][$transport_id][$receiver])) {
                    continue;
                }

                $message = call_user_func_array($message_provider, $data);
                if (!$message instanceof IMessage) {
                    throw new DeveloperException();
                }

                $transport = $this->transport_factory->create($transport_id);
                $transport->process($message);
            }
        }
    }
}
