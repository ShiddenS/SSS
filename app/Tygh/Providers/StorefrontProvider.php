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
use Tygh\Registry;
use Tygh\Storefront\DataLoader;
use Tygh\Storefront\Factory;
use Tygh\Storefront\Normalizer;
use Tygh\Storefront\Repository;

class StorefrontProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $app['storefront.repository'] = function (Container $app) {
            return new Repository($app['db'], $app['storefront.factory'], $app['storefront.normalizer']);
        };

        $app['storefront.factory'] = function (Container $app) {
            return new Factory($app['db'], $app['storefront.data_loader'], $app['storefront.normalizer']);
        };

        $app['storefront.normalizer'] = function (Container $app) {
            return new Normalizer();
        };

        $app['storefront.data_loader'] = function (Container $app) {
            return new DataLoader($app['db']);
        };

        $app['storefront'] = function (Container $app) {
            /** @var \Tygh\Storefront\Repository $repository */
            $repository = $app['storefront.repository'];

            $host = REAL_HOST;
            $path = isset($_SERVER['REQUEST_URI'])
                ? $_SERVER['REQUEST_URI']
                : '';

            $url = $host . $path;

            $storefront = $repository->findByUrl($url);
            if (!$storefront) {
                $storefront = $repository->findDefault();
            }

            return $storefront;
        };
    }
}
