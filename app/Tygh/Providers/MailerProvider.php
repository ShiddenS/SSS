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
use Tygh\Mailer\Mailer;
use Tygh\Mailer\MessageBuilderFactory;
use Tygh\Mailer\MessageStyleFormatter;
use Tygh\Mailer\TransportFactory;
use Tygh\Registry;
use Tygh\Settings;

/**
 * The provider class that registers the components for sending messages in the Tygh::$app container.
 * 
 * @package Tygh\Providers
 */
class MailerProvider implements ServiceProviderInterface
{
    /**
     * @inheritDoc
     */
    public function register(Container $app)
    {
        $app['mailer'] = function ($app) {
            $settings = Registry::get('settings');
            $emails_settings = $settings['Emails'];

            if (fn_allowed_for('ULTIMATE') && !Registry::get('runtime.company_id') && !Registry::get('runtime.simple_ultimate')) {
                $company_id = fn_get_default_company_id();
                $emails_settings = Settings::instance($company_id)->getValues('Emails');
            }

            $mailer = new Mailer(
                $app['mailer.message_builder_factory'],
                $app['mailer.transport_factory'],
                $emails_settings,
                $settings['Appearance']['email_templates'] == 'new',
                CART_LANGUAGE
            );

            return $mailer;
        };

        $app['mailer.message_builder_factory'] = function ($app) {
            return new MessageBuilderFactory($app);
        };

        $app['mailer.transport_factory'] = function ($app) {
            return new TransportFactory();
        };

        $app['mailer.message_style_formatter'] = function ($app) {
            return new MessageStyleFormatter();
        };
    }
}