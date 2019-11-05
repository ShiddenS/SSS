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

namespace Tygh\Addons\GeoMaps;

use Tygh\Shippings\Shippings;
use Illuminate\Support\Collection;
use Tygh\Enum\Addons\GeoMaps\ShippingGroupTypes;

/**
 * Class ShippingRates provides shipping rates estimation
 * for provided product identifier and location.
 *
 * @package Tygh\Addons\GeoMaps
 */
class ShippingEstimator
{
    /** @var array $cart Shopping cart data */
    protected static $cart;

    /** @var array $auth Customer authentication data */
    protected static $auth;

    /** @var array $location User location data */
    protected static $location;

    /**
     * Calculates shipping rates for a product based on provided location data
     *
     * @param int   $product_id Product identifier
     * @param array $location   User location data
     * @param array $auth       User authorization data
     *
     * @return array
     */
    public static function getShippingEstimation($product_id, $location, $auth)
    {
        self::$cart = [];
        self::$auth = $auth;
        self::$location = $location;
        self::setCartUserData();

        $product_data = self::getProductData((int) $product_id);
        self::addProductToCart($product_data);

        $shipping_methods = self::getShippingMethods($product_data);
        list($shipping_methods, $shippings_summary) = self::prepareShippingsSummary($shipping_methods);

        return [$shipping_methods, $shippings_summary];
    }

    /**
     * Sets user data to shopping cart
     */
    protected static function setCartUserData()
    {
        self::$cart['user_data'] = [
            'b_country' => isset(self::$location['country']) ? self::$location['country'] : '',
            'b_state'   => isset(self::$location['state']) ? self::$location['state'] : '',
            'b_city'    => isset(self::$location['city']) ? self::$location['city'] : '',
            's_country' => isset(self::$location['country']) ? self::$location['country'] : '',
            's_state'   => isset(self::$location['state']) ? self::$location['state'] : '',
            's_city'    => isset(self::$location['city']) ? self::$location['city'] : '',
            'zipcode'   => isset(self::$location['zipcode']) ? self::$location['zipcode'] : '',
        ];
    }

    /**
     * Fetches product data
     *
     * @param int $product_id Product identifier
     *
     * @return array
     */
    protected static function getProductData($product_id)
    {
        $product_data[$product_id] = fn_get_product_data($product_id, self::$auth);
        if (!empty($product_data[$product_id]['shipping_params'])) {
            $product_data[$product_id]['shipping_params'] = unserialize($product_data[$product_id]['shipping_params']);
        }
        $product_data[$product_id]['amount'] = 1;

        return $product_data;
    }

    /**
     * Adds product to cart
     *
     * @param array $product_data Product data
     */
    protected static function addProductToCart($product_data)
    {
        $cart = &self::$cart;
        $cart['geo_maps_shipping_estimation'] = true;
        fn_add_product_to_cart($product_data, $cart, self::$auth);

        $product_id = key($product_data);
        $product_price = $product_data[$product_id]['price'];
        $cart = array_merge($cart, [
            'total'             => $product_price,
            'original_subtotal' => $product_price,
            'display_subtotal'  => $product_price,
            'subtotal'          => $product_price,
            'amount'            => 1,
        ]);
    }

    /**
     * Fetches shipping methods data
     *
     * @param array $product_data Product data
     *
     * @return array
     */
    protected static function getShippingMethods($product_data)
    {
        $cart = &self::$cart;
        $cart['free_shipping'] = $cart['products'] = [];
        $cart['calculate_shipping'] = true;

        if ($cart['subtotal'] >= 0) {
            $cart['applied_promotions'] = fn_promotion_apply('cart', $cart, self::$auth, $cart['products']);
        }

        $location = array_merge(self::$location, fn_get_customer_location(self::$auth, $cart));
        $product_groups = Shippings::groupProductsList($product_data, $location);

        $group = reset($product_groups);
        $key_group = key($product_groups);

        if ($group['shipping_no_required'] === false) {
            $cart['shipping_required'] = true;
        }
        if ($cart['shipping_required'] === false) {
            $group['free_shipping'] = true;
            $group['shipping_no_required'] = true;
        }

        $shippings_group = Shippings::getShippingsList($group);
        foreach ($shippings_group as $shipping_id => &$shipping) {
            $_group = $group;
            if (!empty($shipping['service_params']['max_weight_of_box'])) {
                $_group = Shippings::repackProductsByWeight($group, $shipping['service_params']['max_weight_of_box']);
            }

            $shipping = array_merge($shipping, [
                'package_info'      => $_group['package_info'],
                'package_info_full' => $_group['package_info_full'],
                'keys'              => [
                    'group_key'   => $key_group,
                    'shipping_id' => $shipping_id,
                ],
            ]);

            $group['shippings'][$shipping_id] = array_merge($shipping, [
                'rate'          => 0,
                'free_shipping' => in_array($shipping_id, $cart['free_shipping']) || ($group['free_shipping'] && Shippings::isFreeShipping($shipping)),
            ]);
        }

        if (!empty($cart['calculate_shipping'])) {
            $rates = Shippings::calculateRates($shippings_group);

            foreach ($rates as $rate) {
                $sh_id = $rate['keys']['shipping_id'];
                if ($rate['price'] === false) {
                    unset($group['shippings'][$sh_id]);
                    continue;
                }

                $rate['price'] += !empty($group['package_info']['shipping_freight']) ? $group['package_info']['shipping_freight'] : 0;
                $group['shippings'][$sh_id] = array_merge($group['shippings'][$sh_id], [
                        'rate'                    => empty($group['shippings'][$sh_id]['free_shipping']) ? $rate['price'] : 0,
                        'number_of_pickup_points' => isset($rate['pickup_info']['number_of_pickup_points']) ? $rate['pickup_info']['number_of_pickup_points'] : false,
                        'min_cost'                => isset($rate['pickup_info']['min_cost']) ? $rate['pickup_info']['min_cost'] : false,
                    ]
                );

                if (!empty($group['shippings'][$sh_id]['rate_info']['delivery_time'])) {
                    $group['shippings'][$sh_id]['delivery_time'] = $group['shippings'][$sh_id]['rate_info']['delivery_time'];
                }
                if (!empty($rate['service_delivery_time'])) {
                    $group['shippings'][$sh_id]['service_delivery_time'] = $rate['service_delivery_time'];
                }
            }
        }

        return !empty($group['shippings']) ? $group['shippings'] : [];
    }

    /**
     * Prepares shipping methods data to be displayed
     *
     * @param array $shipping_methods Shipping methods data
     *
     * @return array
     */
    protected static function prepareShippingsSummary($shipping_methods)
    {
        $shippings_summary = (new Collection($shipping_methods))
            ->map(function ($shipping) use (&$shipping_methods) {
                $shipping_id = $shipping['shipping_id'];
                $rate = $shipping_methods[$shipping_id]['rate'] =
                    $shipping['min_cost'] !== false ? $shipping['min_cost'] : $shipping['rate'];

                $type = $shipping_methods[$shipping_id]['type'] =
                    self::isPickupShipping($shipping) ? ShippingGroupTypes::PICKUP : ShippingGroupTypes::DELIVERY;

                return [
                    'rate'                    => $rate,
                    'type'                    => $type,
                    'delivery_time'           => !empty($shipping['service_delivery_time']) ? $shipping['service_delivery_time'] : $shipping['delivery_time'],
                    'number_of_pickup_points' => $shipping['number_of_pickup_points'],
                ];
            })
            ->groupBy('type')
            ->map(function ($group) {
                return $group->reduce(function ($group_summary, $shipping) {
                    if (empty($group_summary) || $shipping['rate'] < $group_summary['rate']) {
                        $group_summary = [
                            'rate'          => $shipping['rate'],
                            'delivery_time' => $shipping['delivery_time'],
                        ];
                        if ($shipping['type'] == ShippingGroupTypes::PICKUP) {
                            $group_summary['number_of_pickup_points'] = $shipping['number_of_pickup_points'];
                        }
                    }

                    return $group_summary;
                }, []);
            })
            ->toArray();

        return [$shipping_methods, $shippings_summary];
    }

    /**
     * Checks if shipping method is pickup
     *
     * @param array $shipping Shipping data
     *
     * @return bool
     */
    protected static function isPickupShipping($shipping)
    {
        return $shipping['is_address_required'] == 'N';
    }
}
