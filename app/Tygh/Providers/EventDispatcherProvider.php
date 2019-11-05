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

namespace Tygh\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tygh\Notifications\EventDispatcher;
use Tygh\Notifications\Transports\InternalTransport;
use Tygh\Notifications\Transports\MailTransport;
use Tygh\Notifications\Transports\TransportFactory;

class EventDispatcherProvider implements ServiceProviderInterface
{
    /** @inheritdoc */
    public function register(Container $app)
    {
        $app['event.events_schema'] = function (Container $app) {
            $events_schema = fn_get_schema('notifications', 'events');

            return $events_schema;
        };

        $app['event.notification_settings'] = function (Container $app) {
            $notification_settings = $app['event.events_schema'];

            foreach ($notification_settings as $event => &$transports) {
                foreach ($transports as &$group) {
                    foreach ($group as &$message_provider) {
                        $message_provider = true;
                    }
                }
            }

            return $notification_settings;
        };

        $app['event.dispatcher'] = function (Container $app) {
            $dispatcher = new EventDispatcher(
                $app['event.events_schema'],
                $app['event.notification_settings'],
                $app['event.transport_factory']
            );

            return $dispatcher;
        };

        $app['event.transport_factory'] = function (Container $app) {
            $factory = new TransportFactory($app);

            return $factory;
        };

        $app['event.transports.mail'] = function (Container $app) {
            return new MailTransport($app['mailer']);
        };

        $app['event.transports.internal'] = function (Container $app) {
            return new InternalTransport(
                $app['notifications_center'],
                $app['db'],
                $app['notifications_center.factory']
            );
        };
    }
}
