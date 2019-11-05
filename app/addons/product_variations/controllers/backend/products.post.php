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

use Tygh\Registry;
use Tygh\Addons\ProductVariations\Product\Type\Type;
use Tygh\Addons\ProductVariations\ServiceProvider;
use Tygh\Addons\ProductVariations\Product\Group\GroupFeatureCollection;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

/**
 * @var string $mode
 * @var string $action
 * @var array $auth
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    return [CONTROLLER_STATUS_OK];
}

if ($mode == 'add') {
    /** @var \Tygh\SmartyEngine\Core $view */
    $view = Tygh::$app['view'];

    $view->assign('product_type', Type::create(Type::PRODUCT_TYPE_SIMPLE));
} elseif ($mode == 'update') {
    /** @var \Tygh\SmartyEngine\Core $view */
    $view = Tygh::$app['view'];

    /** @var array $product_data */
    $product_data = $view->getTemplateVars('product_data');

    $tabs = Registry::get('navigation.tabs');

    $index = array_search('options', array_keys($tabs)) + 1;

    $tabs = array_merge(
        array_slice($tabs, 0, $index, true),
        [
            'variations' => [
                'title' => __('product_variations.variations'),
                'href'  => 'product_variations.manage?product_id=' . $product_data['product_id'],
                'ajax'  => true
            ]
        ],
        array_slice($tabs, $index, null, true)
    );

    Registry::set('navigation.tabs', $tabs);

    $product_repository = ServiceProvider::getProductRepository();
    $group_repository = ServiceProvider::getGroupRepository();

    $product_data = $product_repository->loadProductGroupInfo($product_data);

    if ($product_data['parent_product_id'] && isset($product_data['variation_feature_collection'])) {
        $parent_product_data = fn_get_product_data($product_data['parent_product_id'], $auth, CART_LANGUAGE, '', false, false, false, false, false, false);

        if ($parent_product_data) {
            $parent_product_data = $product_repository->loadProductFeatures($parent_product_data, GroupFeatureCollection::createFromFeatureList($product_data['variation_feature_collection']));
            $parent_product_data = $product_repository->loadProductVariationName($parent_product_data);

            $view->assign('parent_product_data', $parent_product_data);
        }
    }

    $view->assign('product_type', Type::createByProduct($product_data));
    $view->assign('product_data', $product_data);


    ServiceProvider::notifyIfProductIsOldProductVariation($product_data);

} elseif ($mode == 'm_update') {
    /** @var \Tygh\SmartyEngine\Core $view */
    $view = Tygh::$app['view'];

    /** @var array $products */
    $products = $view->getTemplateVars('products_data');

    $product_repository = ServiceProvider::getProductRepository();

    $products = $product_repository->loadProductsGroupInfo($products);

    foreach ($products as &$product) {
        $product['type'] = Type::createByProduct($product);
    }
    unset($product);

    $view->assign('products_data', $products);
}
