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

namespace Tygh\Api\Entities\v40;

use Tygh\Api\Entities\Products;
use Tygh\Enum\Addons\Discussion\DiscussionObjectTypes;

/**
 * Class SraProducts implements API entity to provide products data.
 *
 * @package Tygh\Api\Entities
 */
class SraProducts extends Products
{
    protected $icon_size_small = [500, 500];

    protected $icon_size_big = [1000, 1000];

    /** @inheritdoc */
    public function index($id = 0, $params = [])
    {
        $result = parent::index($id, $params);
        $lang_code = $this->getLanguageCode($params);

        $is_discussion_enabled = SraDiscussion::isAddonEnabled();

        $params['icon_sizes'] = $this->safeGet($params, 'icon_sizes', [
            'main_pair'   => [$this->icon_size_big, $this->icon_size_small],
            'image_pairs' => [$this->icon_size_small],
        ]);

        $products = [];
        if ($id && !empty($result['data'])) {
            $products = [$result['data']['product_id'] => $result['data']];
        } elseif (!empty($result['data']['products'])) {
            $products = $result['data']['products'];
        }

        foreach ($products as &$product) {
            $amount = $this->getRequestedProductAmount($params, $product['product_id']);
            if ($amount > 1) {
                $product['price'] = fn_get_product_price($product['product_id'], $amount, $this->auth);
            }
        }
        unset($product);

        fn_gather_additional_products_data($products, [
            'get_options'         => true,
            'get_features'        => true,
            'get_detailed'        => true,
            'get_icon'            => true,
            'get_additional'      => true,
            'get_discounts'       => true,
            'features_display_on' => 'A',
        ]);

        foreach ($products as &$product) {
            $amount = $this->getRequestedProductAmount($params, $product['product_id']);
            if ($amount > 1) {
                $product = $this->calculateQuantityPrice($product, $amount);
            }

            $product = fn_storefront_rest_api_format_product_prices($product);

            if ($is_discussion_enabled) {
                $product = SraDiscussion::setDiscussionType($product, DiscussionObjectTypes::PRODUCT);
            }

            $product = fn_storefront_rest_api_set_product_icons($product, $params['icon_sizes']);
        }
        unset($product);

        if ($id) {
            $result['data'] = reset($products);
        } else {
            $result['data']['products'] = $products;
            $result['data']['filters'] = fn_get_filters_products_count($result['data']['params'], $lang_code);
        }

        return $result;
    }

    /**
     * Gets requested amount of a product.
     *
     * @param array $params     Request parameters
     * @param int   $product_id Product ID
     *
     * @return int
     */
    protected function getRequestedProductAmount($params, $product_id)
    {
        $amount = 1;
        if (isset($params['amount'][$product_id])) {
            $amount = (int) $params['amount'][$product_id];
        } elseif (isset($params['amount'])) {
            $amount = (int) $params['amount'];
        }

        return $amount;
    }

    /**
     * Calculates cost of the specified amount of products with both promotions and quantity discounts applied.
     *
     * FIXME: Must be implemented in fn_gather_additional_products_data
     *
     * @param array $product Product data
     * @param int   $amount  Product amount
     *
     * @return array
     */
    protected function calculateQuantityPrice($product, $amount)
    {
        if (isset($product['discount']) && isset($product['base_price'])) {
            $product['price'] = $product['base_price'] - $product['discount'];
        }
        foreach (['price', 'list_price', 'base_price'] as $price) {
            if (isset($product[$price])) {
                $product[$price] *= $amount;
            }
        }

        return $product;
    }
}
