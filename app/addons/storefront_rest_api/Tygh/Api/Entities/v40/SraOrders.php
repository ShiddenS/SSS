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

use Tygh\Api\Entities\Orders;

/**
 * Class SraOrders
 *
 * @package Tygh\Api\Entities
 */
class SraOrders extends Orders
{
    protected $icon_size_small = [500, 500];

    protected $icon_size_big = [1000, 1000];

    /**
     * @inheritdoc
     */
    public function index($id = 0, $params = [])
    {
        $result = parent::index($id, $params);

        $currency = $this->safeGet($params, 'currency', CART_PRIMARY_CURRENCY);

        $params['icon_sizes'] = $this->safeGet($params, 'icon_sizes', [
            'main_pair'   => [$this->icon_size_big, $this->icon_size_small],
            'image_pairs' => [$this->icon_size_small],
        ]);

        if ($id && !empty($result['data'])) {
            $result['data'] = fn_storefront_rest_api_format_order_prices($result['data'], $currency);
            foreach ($result['data']['product_groups'] as &$product_group) {
                $product_group['products'] = fn_storefront_rest_api_set_products_icons(
                    $product_group['products'],
                    $params['icon_sizes']
                );
            }
            unset($product_group);
        } elseif (!empty($result['data']['orders'])) {
            foreach ($result['data']['orders'] as &$order) {
                $order = fn_storefront_rest_api_format_order_prices($order, $currency);
            }
            unset($order);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function create($params)
    {
        $params['action'] = $this->safeGet($params, 'action', '');

        return parent::create($params);
    }
}
