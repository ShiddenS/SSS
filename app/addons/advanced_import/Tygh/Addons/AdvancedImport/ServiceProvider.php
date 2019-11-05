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

namespace Tygh\Addons\AdvancedImport;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tygh\Addons\AdvancedImport\Presets\Manager as PresetsManager;
use Tygh\Addons\AdvancedImport\Modifiers\Parsers\SinglePassModifierParser as PresetModifierParser;
use Tygh\Addons\AdvancedImport\Modifiers\Parsers\CachingModifierParser as PresetCachingModifierParser;
use Tygh\Addons\AdvancedImport\Presets\Importer as PresetsImporter;
use Tygh\Addons\AdvancedImport\Readers\Factory as ReadersFactory;
use Tygh\Registry;

class ServiceProvider implements ServiceProviderInterface
{
    /** @inheritdoc */
    public function register(Container $app)
    {
        $app['addons.advanced_import.presets.manager'] = function (Container $app) {
            $company_id = fn_get_runtime_company_id();

            $presets_manager = new PresetsManager(
                $app['db'],
                $company_id,
                (int) Registry::get('settings.Appearance.admin_elements_per_page'),
                DESCR_SL,
                $app['addons.advanced_import.schemas_manager']
            );

            return $presets_manager;
        };

        $app['addons.advanced_import.presets.importer'] = function (Container $app) {
            $presets_importer = new PresetsImporter(
                $app['addons.advanced_import.schemas_manager'],
                $app['addons.advanced_import.modifiers.caching_modifier_parser']
            );

            return $presets_importer;
        };

        $app['addons.advanced_import.modifiers.single_pass_modifier_parser'] = function (Container $app) {
            $modifier_parser = new PresetModifierParser();

            return $modifier_parser;
        };

        $app['addons.advanced_import.modifiers.caching_modifier_parser'] = function (Container $app) {
            $caching_modifier_parser = new PresetCachingModifierParser($app['addons.advanced_import.modifiers.single_pass_modifier_parser']);

            return $caching_modifier_parser;
        };

        $app['addons.advanced_import.schemas_manager'] = function (Container $app) {

            return new SchemasManager();
        };

        $app['addons.advanced_import.readers.factory'] = function (Container $app) {

            $company_id = fn_get_runtime_company_id();

            return new ReadersFactory($company_id);
        };

        $app['addons.advanced_import.features_mapper'] = function (Container $app) {

            return new FeaturesMapper();
        };
    }
}